<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Resident;
use App\Models\Product;
use App\Models\ResidentMedicationOrder;
use Illuminate\Support\Facades\DB;

class ResidentPharmacyController extends Controller
{
    // Show Resident Pharmacy tab view
    public function index()
    {
        $residents = Resident::all();
        $products = Product::where('stock', '>', 0)->get();

        return view('staff.resident-pharmacy', compact('residents', 'products'));
    }

    // Handle order placement
    public function placeOrder(Request $request)
    {
        $request->validate([
            'resident_id' => 'required|exists:resident,id',
            'product_id' => 'required|exists:products,id',
            'quantity' => 'required|integer|min:1',
        ]);

        $resident = Resident::findOrFail($request->resident_id);
        $product = Product::findOrFail($request->product_id);
        $quantity = $request->quantity;
        $totalCost = $product->price * $quantity;

        if ($product->stock < $quantity) {
            return back()->with('error', 'Not enough stock available.');
        }

        if ($resident->medication_account_balance < $totalCost) {
            return back()->with('error', 'Resident does not have enough balance.');
        }

        DB::transaction(function () use ($resident, $product, $quantity, $totalCost) {
            $product->stock -= $quantity;
            $product->save();

            $resident->medication_account_balance -= $totalCost;
            $resident->save();

            ResidentMedicationOrder::create([
                'resident_id' => $resident->id,
                'product_id' => $product->id,
                'quantity' => $quantity,
                'total_cost' => $totalCost,
                'status' => 'Ordered',
            ]);
        });

        return back()->with('success', 'Order placed and charged to resident account.');
    }
}
