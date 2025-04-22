<?php

namespace App\Exports;

use App\Models\Medication;
use App\Models\Resident;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;

class MissedMedicationsExport implements FromView
{
    protected $residentId;

    public function __construct($residentId = null)
    {
        $this->residentId = $residentId;
    }

    public function view(): View
    {
        $query = Medication::with('resident')
            ->where('taken', false)
            ->where('scheduled_time', '<', now()->subDays(2));

        if ($this->residentId) {
            $query->where('resident_id', $this->residentId);
        }

        $missed = $query->get()->groupBy('resident_id');
        $allResidents = Resident::orderBy('lastname')->get();

        return view('exports.missed-medications', compact('missed', 'allResidents'));
    }
}
