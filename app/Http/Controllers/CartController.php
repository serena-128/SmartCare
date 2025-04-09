<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\PharmacyOrder;
use Illuminate\Http\Request;

class CartController extends Controller
{
    public function addToCart(Request $request)
    {
        $cart = session()->get('cart', []);
        $id = $request->input('product_id');
        $qty = $request->input('quantity', 1);

        if (isset($cart[$id])) {
            $cart[$id] += $qty;
        } else {
            $cart[$id] = $qty;
        }

        session(['cart' => $cart]);
        return back()->with('success', 'Added to cart!');
    }

    public function viewCart()
    {
        $cart = session('cart', []);
        $products = Product::whereIn('id', array_keys($cart))->get();

        return view('staff.cart', compact('cart', 'products'));
    }

    public function checkout()
    {
        $cart = session('cart', []);
        foreach ($cart as $productId => $quantity) {
            $product = Product::find($productId);

            if ($product && $product->stock >= $quantity) {
                PharmacyOrder::create([
                    'staffmember_id' => null,
                    'product_id' => $product->id,
                    'quantity' => $quantity,
                    'status' => 'Ordered'
                ]);
                $product->stock -= $quantity;
                $product->save();
            }
        }

        session()->forget('cart');
        return back()->with('success', 'Order placed successfully!');
    }

    public function removeItem($id)
    {
        $cart = session('cart', []);
        unset($cart[$id]);
        session(['cart' => $cart]);
        return back()->with('success', 'Item removed.');
    }
}
