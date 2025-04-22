<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Bulletin;  // Ensure you have a Bulletin model with fillable fields

class BulletinController extends Controller
{
    public function create()
    {
        return view('bulletin-form'); // Adjust the view path if needed
    }

    public function store(Request $request)
    {
        // Validate the form input
        $data = $request->validate([
            'date'    => 'required|date',
            'message' => 'required|string',
        ]);

        // Save the bulletin record
        Bulletin::create($data);

        return redirect()->back()->with('success', 'Bulletin added successfully.');
    }
}
