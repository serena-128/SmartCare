<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\PharmacyOrder;
use Illuminate\Http\Request;

class PharmacyController extends Controller
{
    public function index()
    {
        $products = Product::all();
        $orders = PharmacyOrder::with('product')->get(); // removed auth()->id()
        return view('staff.pharmacy', compact('products', 'orders'));
    }

    public function placeOrder(Request $request)
    {
        $request->validate([
            'product_id' => 'required|exists:products,id',
            'quantity' => 'required|integer|min:1'
        ]);

        $product = Product::find($request->product_id);

        if ($product->stock < $request->quantity) {
            return back()->with('error', 'Not enough stock!');
        }

        PharmacyOrder::create([
            'staffmember_id' => null, // since you said no auth is used
            'product_id' => $product->id,
            'quantity' => $request->quantity,
            'status' => 'Ordered'
        ]);

        $product->stock -= $request->quantity;
        $product->save();

        return back()->with('success', 'Order placed successfully!');
    }

    public function markShipped(PharmacyOrder $order)
    {
        $order->update(['status' => 'Shipped']);
        return back()->with('success', 'Order marked as shipped.');
    }
}
