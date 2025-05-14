<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Schedule;
use Carbon\Carbon;

class StaffScheduleController extends Controller
{
    public function index()
    {
        $staffId = session('staff_id');

        $schedules = Schedule::where('staffmemberid', $staffId)
            ->where('shift_status', 'approved')
            ->whereDate('shiftdate', '>=', now())
            ->whereDate('shiftdate', '<=', now()->addMonth())
            ->orderBy('shiftdate')
            ->get();

        // Create strict weekly buckets
        $weeks = collect();
        $currentWeek = now()->startOfWeek();
        $endDate = now()->addMonth()->endOfWeek();

        while ($currentWeek->lte($endDate)) {
            $weekStart = $currentWeek->copy();
            $weekEnd = $weekStart->copy()->endOfWeek();

            $weekShifts = $schedules->filter(function ($shift) use ($weekStart, $weekEnd) {
                return Carbon::parse($shift->shiftdate)->between($weekStart, $weekEnd);
            });

            if ($weekShifts->isNotEmpty()) {
                $weeks->push([
                    'start' => $weekStart,
                    'end' => $weekEnd,
                    'shifts' => $weekShifts,
                ]);
            }

            $currentWeek->addWeek();
        }

        return view('staff.schedule', compact('weeks'));
    }

    public function getAvailableShifts(Request $request)
    {
        $date = $request->query('date');
        $startOfWeek = Carbon::parse($date)->startOfWeek();
        $endOfWeek = Carbon::parse($date)->endOfWeek();

        $availableShifts = Schedule::whereNull('staffmemberid')
            ->where('shifttype', 'shift')
            ->whereBetween('shiftdate', [$startOfWeek, $endOfWeek])
            ->where('shift_status', 'approved')
            ->orderBy('shiftdate')
            ->get()
            ->map(function ($shift) {
                return [
                    'id' => $shift->id,
                    'date' => Carbon::parse($shift->shiftdate)->format('D d M'),
                    'start' => Carbon::parse($shift->starttime)->format('H:i'),
                    'end' => Carbon::parse($shift->endtime)->format('H:i'),
                ];
            });

        return response()->json($availableShifts);
    }

    public function requestShiftChange(Request $request)
    {
        $validated = $request->validate([
            'currentShiftDate' => 'required|date',
            'requestedShiftId' => 'required|exists:schedule,id',
            'requestReason' => 'required|string',
        ]);

        $staffId = session('staff_id');

        $originalShift = Schedule::where('staffmemberid', $staffId)
            ->where('shiftdate', $validated['currentShiftDate'])
            ->where('shifttype', 'shift')
            ->where('shift_status', 'approved')
            ->first();

        if (!$originalShift) {
            return response()->json(['success' => false, 'message' => 'Original shift not found.'], 404);
        }

        Schedule::create([
            'staffmemberid' => $staffId,
            'shifttype' => 'shift',
            'shiftdate' => $validated['currentShiftDate'],
            'starttime' => $originalShift->starttime,
            'endtime' => $originalShift->endtime,
            'requested_shift_id' => $validated['requestedShiftId'],
            'request_reason' => $validated['requestReason'],
            'shift_status' => 'unapproved',
        ]);

        return response()->json(['success' => true]);
    }
}
