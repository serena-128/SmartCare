<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Resident;
use App\Models\Product;
use App\Models\ResidentMedicationOrder;
use Illuminate\Support\Facades\DB;
use App\Models\ResidentOrder;

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
    
    public function showResidentPharmacy()
{
    $residents = Resident::all();
    $products = Product::all();

    return view('staff.medication', compact('residents', 'products'));
}
public function store(Request $request)
{
    $residentId = $request->input('resident_id');
    $orderProducts = $request->input('order_products', []);
    $quantities = $request->input('quantities', []);

    $resident = Resident::findOrFail($residentId);
    $totalCost = 0;

    foreach ($orderProducts as $productId) {
        $quantity = $quantities[$productId] ?? 1;
        $product = Product::findOrFail($productId);
        $cost = $product->price * $quantity;

        // Skip if not enough stock or insufficient balance
        if ($product->stock < $quantity || $resident->medication_account_balance < $cost) {
            continue;
        }

        // Create order
        ResidentOrder::create([
            'resident_id' => $residentId,
            'product_id' => $productId,
            'quantity' => $quantity,
            'status' => 'Ordered',
        ]);

        // Deduct stock
        $product->stock -= $quantity;
        $product->save();

        // Accumulate total cost
        $totalCost += $cost;
    }

    // Deduct total cost from resident balance
    $resident->medication_account_balance -= $totalCost;
    $resident->save();

    return back()->with('success', 'Resident order placed successfully!');
}
    public function checkout(Request $request)
{
    $residentId = $request->input('resident_id');
    $cart = session('resident_cart', []);

    if (!$residentId || empty($cart)) {
        return back()->with('error', 'Please select a resident and add medications.');
    }

    $resident = Resident::findOrFail($residentId);
    $totalCost = 0;

    foreach ($cart as $item) {
        $product = Product::find($item['id']);
        if ($product && $product->stock >= $item['quantity']) {
            $lineCost = $product->price * $item['quantity'];
            $totalCost += $lineCost;

            // Save the order
            ResidentOrder::create([
                'resident_id' => $resident->id,
                'product_id' => $product->id,
                'quantity' => $item['quantity'],
                'status' => 'Ordered',
            ]);

            // Deduct stock
            $product->stock -= $item['quantity'];
            $product->save();
        } else {
            return back()->with('error', 'Not enough stock for ' . $item['name']);
        }
    }

    // Deduct balance
    if ($resident->medication_account_balance >= $totalCost) {
        $resident->medication_account_balance -= $totalCost;
        $resident->save();
    } else {
        return back()->with('error', 'Insufficient balance in resident account.');
    }

    // Clear cart
    Session::forget('resident_cart');

    return back()->with('success', 'Resident medication order placed successfully!');
}


}
