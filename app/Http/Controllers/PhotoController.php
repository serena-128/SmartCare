<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Photo;  // Ensure you have a Photo model with fillable fields

class PhotoController extends Controller
{
    public function create()
    {
        return view('photo-form'); // Adjust the view path if needed
    }

    public function store(Request $request)
    {
        // Validate the file upload
        $request->validate([
            'photo' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $file = $request->file('photo');
        $filename = time() . '_' . $file->getClientOriginalName();
        // Move the file to a public directory (e.g., public/uploads)
        $file->move(public_path('uploads'), $filename);

        // Save the file path in the database
        Photo::create([
            'filename' => 'uploads/' . $filename,
        ]);

        return redirect()->back()->with('success', 'Photo uploaded successfully.');
    }
}
