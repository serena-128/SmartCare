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
    // In your PharmacyController
// Add to cart
public function addToCart(Request $request)
{
    $productId = $request->input('product_id');
    $quantity = (int) $request->input('quantity');

    $cart = session()->get('cart', []);

    $product = Product::findOrFail($productId);

    if (isset($cart[$productId])) {
        $cart[$productId]['quantity'] += $quantity;
    } else {
        $cart[$productId] = [
            'name' => $product->name,
            'price' => $product->price,
            'quantity' => $quantity,
        ];
    }

    session()->put('cart', $cart);

    // Render partial view
    $html = view('partials.cartContent', ['cart' => $cart])->render();

    return response()->json([
        'count' => count($cart),
        'html' => $html
    ]);
}


// Checkout cart
public function checkout()
{
    $cart = session('cart', []);
    if (empty($cart)) return back()->with('error', 'Cart is empty.');

    foreach ($cart as $productId => $item) {
        $product = Product::findOrFail($productId);

        if ($product->stock < $item['quantity']) {
            return back()->with('error', "Not enough stock for {$item['name']}.");
        }

        // Create order
        PharmacyOrder::create([
            'product_id' => $productId,
            'quantity' => $item['quantity'],
            'status' => 'Ordered'
        ]);

        // Update stock
        $product->stock -= $item['quantity'];
        $product->save();
    }

    session()->forget('cart');
    return back()->with('success', 'Order placed successfully!');
}

}
