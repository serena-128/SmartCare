<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreatescheduleRequest;
use App\Http\Requests\UpdatescheduleRequest;
use App\Repositories\ScheduleRepository;
use App\Models\Schedule;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Auth;
use App\Models\StaffMember;

use Flash;
use Response;

class ScheduleController extends AppBaseController
{
    /** @var ScheduleRepository */
    private $scheduleRepository;

    public function __construct(ScheduleRepository $scheduleRepo)
    {
        $this->scheduleRepository = $scheduleRepo;
    }

    /**
     * Display a listing of the schedule.
     */
    public function index(Request $request)
    {
        $schedules = $this->scheduleRepository->all();
        return view('schedules.index')->with('schedules', $schedules);
    }

    /**
     * Show the form for creating a new schedule.
     */
public function create()
{
    $staffMembers = StaffMember::all(); // Fetch all staff members
    $schedule = new Schedule(); // Ensure schedule exists
    $staffMember = StaffMember::find($schedule->staffmemberid); // Fetch assigned staff member

    return view('schedules.create', compact('schedule', 'staffMembers', 'staffMember'));
}




    /**
     * Store a newly created schedule in storage.
     */
    public function store(CreatescheduleRequest $request)
    {
        $input = $request->all();
        $schedule = $this->scheduleRepository->create($input);
        Flash::success('Schedule saved successfully.');
        return redirect(route('schedules.index'));
    }

    /**
     * Display the specified schedule.
     */
    public function show($id)
    {
        $schedule = $this->scheduleRepository->find($id);
        if (empty($schedule)) {
            Flash::error('Schedule not found');
            return redirect(route('schedules.index'));
        }
        return view('schedules.show')->with('schedule', $schedule);
    }

    /**
     * Show the form for editing the specified schedule.
     */
    public function edit($id)
    {
        $schedule = $this->scheduleRepository->find($id);
        if (empty($schedule)) {
            Flash::error('Schedule not found');
            return redirect(route('schedules.index'));
        }
        return view('schedules.edit')->with('schedule', $schedule);
    }

    /**
     * Update the specified schedule in storage.
     */
    public function update($id, UpdatescheduleRequest $request)
    {
        $schedule = $this->scheduleRepository->find($id);
        if (empty($schedule)) {
            Flash::error('Schedule not found');
            return redirect(route('schedules.index'));
        }
        $schedule = $this->scheduleRepository->update($request->all(), $id);
        Flash::success('Schedule updated successfully.');
        return redirect(route('schedules.index'));
    }

    /**
     * Remove the specified schedule from storage.
     */
    public function destroy($id)
    {
        $schedule = $this->scheduleRepository->find($id);
        if (empty($schedule)) {
            Flash::error('Schedule not found');
            return redirect(route('schedules.index'));
        }
        $this->scheduleRepository->delete($id);
        Flash::success('Schedule deleted successfully.');
        return redirect(route('schedules.index'));
    }

    /**
     * Show the Request Shift Change Form.
     */
    public function showRequestChangeForm($id)
    {
        $schedule = Schedule::findOrFail($id);
        return view('schedules.request_change', compact('schedule'));
    }

    /**
     * Handle Shift Change Request.
     */
public function requestChange(Request $request, $id)
{
    $schedule = Schedule::findOrFail($id);
    $staffMember = StaffMember::find($schedule->staffmemberid); // Fetch assigned staff member

    return view('schedules.request_change', compact('schedule', 'staffMember'));
}



    /**
     * Approve Shift Change.
     */
    public function approveChange($id)
    {
        $schedule = Schedule::findOrFail($id);
        $schedule->update([
            'shift_status' => 'Approved',
            'approved_by' => Auth::id(),
            'requested_shift_id' => null,
        ]);

        return redirect()->route('schedules.index')->with('success', 'Shift change approved.');
    }

    /**
     * Deny Shift Change.
     */
    public function denyChange($id)
    {
        $schedule = Schedule::findOrFail($id);
        $schedule->update(['shift_status' => 'Denied']);

        return redirect()->route('schedules.index')->with('error', 'Shift change request denied.');
    }

    /**
     * Show only the logged-in staff member's schedule.
     */
    public function mySchedule(Request $request)
    {
        // Ensure the session contains the staff ID
        if (!Session::has('staff_id')) {
            return redirect()->route('login')->with('error', 'Please log in to view your schedule.');
        }

        // Get staff ID from session
        $staffId = Session::get('staff_id');

        // Fetch staff details
        $staffMember = StaffMember::find($staffId);

        if (!$staffMember) {
            return redirect()->route('login')->with('error', 'No schedule found.');
        }

        // Fetch only the logged-in staff member's schedule
        $schedules = Schedule::where('staffmemberid', $staffId)->get();

        return view('schedules.staff_schedule', compact('schedules'));
    }
public function showRequestDayOffForm($id)
{
    $schedule = Schedule::findOrFail($id);
    return view('schedules.request_day_off', compact('schedule'));
}
public function submitDayOffRequest(Request $request, $id)
{
    // Redirect to a new page that displays "Done"
    return view('schedules.done');
}



}
