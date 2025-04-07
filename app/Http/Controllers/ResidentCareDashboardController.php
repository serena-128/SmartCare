<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Resident;
use App\Models\CareLog;
use Carbon\Carbon;

class ResidentCareDashboardController extends Controller
{
    public function index()
    {
        $totalResidents = Resident::count();
        $recentLogs = CareLog::with('resident')->latest()->limit(5)->get();
        $todayLogsCount = CareLog::whereDate('logged_at', Carbon::today())->count();

        return view('resident_care_dashboard.index', compact('totalResidents', 'recentLogs', 'todayLogsCount'));
    }
}
