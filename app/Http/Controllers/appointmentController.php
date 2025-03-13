<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use App\Http\Requests\CreateappointmentRequest;
use App\Http\Requests\UpdateappointmentRequest;
use App\Repositories\appointmentRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Flash;
use Response;

class appointmentController extends AppBaseController
{
    /** @var appointmentRepository $appointmentRepository*/
    private $appointmentRepository;

    public function __construct(appointmentRepository $appointmentRepo)
    {
        $this->appointmentRepository = $appointmentRepo;
    }

    /**
     * Display a listing of the appointment.
     *
     * @param Request $request
     *
     * @return Response
     */
    public function index(Request $request)
    {
        $appointments = $this->appointmentRepository->all();

        return view('appointments.index')
            ->with('appointments', $appointments);
    }

    /**
     * Show the form for creating a new appointment.
     *
     * @return Response
     */
    public function create()
    {
        return view('appointments.create');
    }

    /**
     * Store a newly created appointment in storage.
     *
     * @param CreateappointmentRequest $request
     *
     * @return Response
     */
    public function store(CreateappointmentRequest $request)
    {
        $input = $request->all();

        $appointment = $this->appointmentRepository->create($input);

        Flash::success('Appointment saved successfully.');

        return redirect(route('appointments.index'));
    }

    /**
     * Display the specified appointment.
     *
     * @param int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $appointment = $this->appointmentRepository->find($id);

        if (empty($appointment)) {
            Flash::error('Appointment not found');

            return redirect(route('appointments.index'));
        }

        return view('appointments.show')->with('appointment', $appointment);
    }

    /**
     * Show the form for editing the specified appointment.
     *
     * @param int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $appointment = $this->appointmentRepository->find($id);

        if (empty($appointment)) {
            Flash::error('Appointment not found');

            return redirect(route('appointments.index'));
        }

        return view('appointments.edit')->with('appointment', $appointment);
    }

    /**
     * Update the specified appointment in storage.
     *
     * @param int $id
     * @param UpdateappointmentRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateappointmentRequest $request)
    {
        $appointment = $this->appointmentRepository->find($id);

        if (empty($appointment)) {
            Flash::error('Appointment not found');

            return redirect(route('appointments.index'));
        }

        $appointment = $this->appointmentRepository->update($request->all(), $id);

        Flash::success('Appointment updated successfully.');

        return redirect(route('appointments.index'));
    }

    /**
     * Remove the specified appointment from storage.
     *
     * @param int $id
     *
     * @throws \Exception
     *
     * @return Response
     */
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
    public function fetchAppointments(Request $request)
{
    // Get the logged-in Next-of-Kin (using your custom guard)
    $nextOfKin = Auth::guard('nextofkin')->user();

    // If there's no Next-of-Kin or resident assigned, return empty JSON
    if (!$nextOfKin || !$nextOfKin->residentid) {
        return response()->json([]);
    }

    // Get the appointments for the assigned resident
    $appointments = \App\Models\Appointment::where('residentid', $nextOfKin->residentid)->get();

    // Format the appointments for FullCalendar
    // Adjust field names as necessary (ensure date/time are in ISO format)
    $formattedAppointments = $appointments->map(function ($appointment) {
        // Combine date and time if needed:
        $start = $appointment->date; // assuming 'date' contains date
        // Optionally, if you store time separately:
        if($appointment->time) {
            $start .= 'T' . $appointment->time;
        }
        return [
            'title' => $appointment->reason, // Or any field you want as title
            'start' => $start,
            // You can add extra properties:
            'description' => $appointment->location ?? '',
        ];
    });

    return response()->json($formattedAppointments);
}

}
