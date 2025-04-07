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
    public function index()
    {
        $appointments = Appointment::with(['resident', 'staffmember'])->get();
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

    public function fetchStaffAppointments()
    {
        $staff = \App\Models\Staffmember::where('email', 'emma.kavanagh@example.com')->first(); // Or session('staff_email')
    
        if (!$staff) {
            return response()->json([]);
        }
    
        $appointments = \App\Models\Appointment::where('staffmemberid', $staff->id)
            ->with('resident')
            ->get();
    
        return response()->json($appointments->map(function ($a) {
            // If `date` is already a datetime field in DB, just combine directly with Carbon:
            $start = \Carbon\Carbon::parse($a->date)->setTimeFromTimeString($a->time)->toIso8601String();
    
            return [
                'title' => $a->reason . ' - ' . ($a->resident->firstname ?? 'Resident'),
                'start' => $start,
                'description' => $a->location ?? '',
            ];
        }));
    }
    
 public function storeRSVP(Request $request)
{
    $validated = $request->validate([
        'appointment_id' => 'required|exists:appointments,id',
        'nextofkin_id' => 'required|exists:next_of_kins,id',
        'rsvp_status' => 'required|in:yes,no',
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

    // Store the RSVP status in the appointment_rsvps table
    AppointmentRsvp::create([
        'appointment_id' => $validated['appointment_id'],
        'nextofkin_id' => $validated['nextofkin_id'],
        'rsvp_status' => $validated['rsvp_status'],
    ]);

    return response()->json(['success' => true]);
}
   
    

}
