<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use App\Http\Requests\CreateappointmentRequest;
use App\Http\Requests\UpdateappointmentRequest;
use App\Repositories\appointmentRepository;
use App\Models\Appointment;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use App\Models\Resident;
use App\Models\Staffmember;
use Illuminate\Support\Facades\Session;
use Flash;
use Response;
use App\Models\AppointmentRsvp;

class appointmentController extends AppBaseController
{
    private $appointmentRepository;

    public function __construct(appointmentRepository $appointmentRepo)
    {
        $this->appointmentRepository = $appointmentRepo;
    }

    // ✅ Display all appointments with relationships
    public function index(Request $request)
{
    // Set default date filter to 'today' if not specified
    $dateFilter = $request->date_filter ?? 'today';

    $appointments = Appointment::with(['resident', 'staffmember'])
        ->when($request->resident, function ($query) use ($request) {
            $query->whereHas('resident', function ($q) use ($request) {
                $q->where('firstname', 'like', "%{$request->resident}%")
                  ->orWhere('lastname', 'like', "%{$request->resident}%");
            });
        })
        ->when($request->staff, function ($query) use ($request) {
            $query->whereHas('staffmember', function ($q) use ($request) {
                $q->where('firstname', 'like', "%{$request->staff}%")
                  ->orWhere('lastname', 'like', "%{$request->staff}%");
            });
        })
        ->when($dateFilter == 'today', function ($query) {
            $query->whereDate('date', now()->toDateString());
        })
        ->when($dateFilter == 'past', function ($query) {
            $query->whereDate('date', '<', now()->toDateString());
        })
        ->when($dateFilter == 'today', fn($q) =>
    $q->whereDate('date', now()->toDateString())
)
->when($dateFilter == 'past', fn($q) =>
    $q->whereDate('date', '<', now()->toDateString())
)
->when($dateFilter == 'future', fn($q) =>
    $q->whereDate('date', '>', now()->toDateString())
)
->when(str_starts_with($dateFilter, 'year_'), function ($q) use ($dateFilter) {
    $year = str_replace('year_', '', $dateFilter);
    $q->whereYear('date', $year);
})

        
        ->orderBy('date')
        ->paginate(10);

    return view('appointments.index', compact('appointments'));
}



    public function create()
    {
        $residents = \App\Models\Resident::all(); // Fetch all residents
        $staffmembers = \App\Models\Staffmember::all(); // ← Make sure this model exists
    
        return view('appointments.create', compact('residents', 'staffmembers'));
    }
    

    public function store(CreateappointmentRequest $request)
    {
        $input = $request->all();
        $appointment = $this->appointmentRepository->create($input);
        Flash::success('Appointment saved successfully.');
        return redirect(route('appointments.index'));
    }

    public function show($id)
    {
        $appointment = $this->appointmentRepository->find($id);

        if (empty($appointment)) {
            Flash::error('Appointment not found');
            return redirect(route('appointments.index'));
        }

        return view('appointments.show')->with('appointment', $appointment);
    }

    public function edit($id)
    {
        $appointment = Appointment::findOrFail($id);
        $residents = Resident::all();
        $staffmembers = Staffmember::all();
    
        return view('appointments.edit', compact('appointment', 'residents', 'staffmembers'));
    }
    

    public function update($id, UpdateappointmentRequest $request)
    {
        $appointment = $this->appointmentRepository->find($id);

        if (empty($appointment)) {
            Flash::error('Appointment not found');
            return redirect(route('appointments.index'));
        }

        $this->appointmentRepository->update($request->all(), $id);
        Flash::success('Appointment updated successfully.');
        return redirect(route('appointments.index'));
    }

    public function destroy($id)
    {
        $appointment = $this->appointmentRepository->find($id);

        if (empty($appointment)) {
            Flash::error('Appointment not found');
            return redirect(route('appointments.index'));
        }

        $this->appointmentRepository->delete($id);
        Flash::success('Appointment deleted successfully.');
        return redirect(route('appointments.index'));
    }

    // ✅ JSON calendar feed for FullCalendar
    public function fetchAppointments(Request $request)
    {
        $nextOfKin = Auth::guard('nextofkin')->user();

        if (!$nextOfKin || !$nextOfKin->residentid) {
            return response()->json([]);
        }

        $appointments = Appointment::where('residentid', $nextOfKin->residentid)->get();

        $formatted = $appointments->map(function ($appointment) {
            $start = \Carbon\Carbon::parse($appointment->date);
            if ($appointment->time) {
                $start->setTimeFromTimeString($appointment->time);
            }
            return [
                'id' => $appointment->id,
                'title' => $appointment->reason,
                'start' => $start->toIso8601String(),
                'description' => $appointment->location ?? '',
            ];
        });

        return response()->json($formatted);
    }

    // ✅ RSVP Form View for Next-of-Kin
    public function rsvpForm()
    {
        $nextOfKin = Auth::guard('nextofkin')->user();

        if (!$nextOfKin || !$nextOfKin->residentid) {
            return redirect()->back()->with('error', 'No resident assigned.');
        }

        $appointments = Appointment::where('residentid', $nextOfKin->residentid)
            ->whereDate('date', '>=', now())
            ->orderBy('date')
            ->get();

        return view('appointments.rsvp', compact('appointments'));
    }

    // ✅ Handle RSVP Submission

public function submitRsvp(Request $request)
{
    $nextOfKin = Auth::guard('nextofkin')->user();

    if (!$nextOfKin) {
        return redirect()->route('appointments.rsvp.form')->with('error', 'You must be logged in to RSVP.');
    }

    // Validate incoming request data.
    $request->validate([
        'appointment_id' => 'required|exists:appointments,id',
        'rsvp_status'    => 'required|in:yes,no,maybe',
        'comments'       => 'nullable|string|max:255',
    ]);

    // Find the appointment using the validated appointment_id.
    $appointment = Appointment::findOrFail($request->appointment_id);

    // Update the appointment's RSVP status and comments.
    $appointment->rsvp_status = $request->rsvp_status;
    $appointment->rsvp_comments = $request->comments;
    $appointment->save();

    // Create an AppointmentRsvp record for tracking the RSVP.
    \App\Models\AppointmentRsvp::create([
        'appointment_id' => $appointment->id,
        'nextofkin_id'   => $nextOfKin->id,
        'rsvp_status'    => $request->rsvp_status,
        'comments'       => $request->comments,
    ]);

    return redirect()->route('appointments.rsvp.form')->with('success', 'RSVP submitted successfully.');
}

 public function storeRSVP(Request $request)
{
    $validated = $request->validate([
    'appointment_id' => 'required|exists:appointment,id',
    'nextofkin_id'   => 'required|exists:nextofkin,id',
    'rsvp_status'    => 'required|in:yes,no',
]);


    // Store the RSVP
    $appointmentRSVP = AppointmentRSVP::create([
        'appointment_id' => $validated['appointment_id'],
        'nextofkin_id' => $validated['nextofkin_id'],
        'rsvp_status' => $validated['rsvp_status']
    ]);

    if ($appointmentRSVP) {
        return response()->json(['success' => true]);
    } else {
        return response()->json(['success' => false]);
    }
}
public function handleRSVP(Request $request)
{
    // Validate the incoming data
    $validated = $request->validate([
        'appointment_id' => 'required|integer',
        'nextofkin_id' => 'required|integer',
        'rsvp_status' => 'required|in:yes,no',
    ]);
    
     // Update the appointment record with the new RSVP status
    $appointment = Appointment::findOrFail($validated['appointment_id']);
    $appointment->rsvp_status = $validated['rsvp_status'];
    $appointment->save();
    
    // Store the RSVP status in the appointment_rsvps table
    AppointmentRsvp::create([
        'appointment_id' => $validated['appointment_id'],
        'nextofkin_id' => $validated['nextofkin_id'],
        'rsvp_status' => $validated['rsvp_status'],
    ]);

    return response()->json(['success' => true]);
}
   

public function fetchStaffAppointments()
{
    try {
        $staffId = session('staff_id');

        if (!$staffId) {
            return response()->json(['error' => 'No staff ID in session'], 403);
        }

        // 👇 Include the resident relationship
        $appointments = Appointment::with('resident')
            ->where('staffmemberid', $staffId)
            ->get();

        $formatted = $appointments->map(function ($appt) {
            if (!$appt->date || !$appt->time) {
                return null;
            }

            $start = \Carbon\Carbon::parse($appt->date)
                ->setTimeFromTimeString($appt->time)
                ->toIso8601String();

            $resident = $appt->resident;
            $residentName = $resident ? "{$resident->firstname} {$resident->lastname}" : 'Unknown';

            return [
                'id' => $appt->id,
                'title' => "{$appt->reason} - $residentName", // 👈 shows in calendar
                'start' => $start,
                'reason' => $appt->reason,
                'location' => $appt->location,
                'resident_name' => $residentName,
            ];
        })->filter();

        return response()->json($formatted);

    } catch (\Throwable $e) {
        logger()->error('Error fetching staff appointments:', ['message' => $e->getMessage()]);
        return response()->json(['error' => 'Server error', 'details' => $e->getMessage()], 500);
    }
}



}
