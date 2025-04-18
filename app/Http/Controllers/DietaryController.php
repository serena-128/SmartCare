<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DietaryController extends Controller
{
   public function index() {
    return view('dietary.index');
}
public function storeMealPlan(Request $request) {
    $request->validate([
        'food_item' => 'required|string|max:255',
    ]);

    // Example: Store the meal plan
    MealPlan::create([
        'resident_id' => auth()->user()->resident_id,
        'food_item' => $request->food_item,
        'meal_time' => now(),
    ]);

    return redirect()->route('dietary.index')->with('success', 'Meal plan updated.');
}
 //
}
