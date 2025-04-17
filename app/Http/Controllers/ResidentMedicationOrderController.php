<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Resident;
use App\Models\ResidentMedicationOrder;

class ResidentMedicationOrderController extends Controller
{
    public function index()
    {
        $residents = Resident::all();
        $orders = ResidentMedicationOrder::with('resident')->latest()->get();
        return view('resident_medications.index', compact('residents', 'orders'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'resident_id' => 'required|exists:resident,id',
            'medication_name' => 'required|string|max:255',
            'quantity' => 'required|integer|min:1',
            'price_per_unit' => 'required|numeric|min:0.01',
        ]);

        $resident = Resident::findOrFail($request->resident_id);
        $totalCost = $request->quantity * $request->price_per_unit;

        if ($resident->medication_account_balance < $totalCost) {
            return redirect()->back()->with('error', 'Insufficient medication balance.');
        }

        ResidentMedicationOrder::create([
            'resident_id' => $resident->id,
            'medication_name' => $request->medication_name,
            'quantity' => $request->quantity,
            'price_per_unit' => $request->price_per_unit,
            'total_cost' => $totalCost,
        ]);

        $resident->decrement('medication_account_balance', $totalCost);

        return redirect()->back()->with('success', 'Order placed and charged to resident account.');
    }
}
