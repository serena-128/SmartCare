<?php>

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PharmacyController extends Controller
{
    public function purchase(Request $request)
    {
        $product = $request->input('product');
        $shipped = session()->get('shipped', []);
        $shipped[] = $product;
        session()->put('shipped', $shipped);

        return redirect()->back()->with('success', "$product has been purchased and marked as shipped.");
    }
}
