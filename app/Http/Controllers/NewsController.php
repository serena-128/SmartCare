<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\News;  // Ensure you have a News model with fillable fields

class NewsController extends Controller
{
    public function create()
    {
        return view('news-form'); // Adjust the view path if needed
    }

    public function store(Request $request)
    {
        // Validate the form input
        $data = $request->validate([
            'title'       => 'required|string|max:255',
            'date'        => 'required|date',
            'description' => 'required|string',
        ]);

        // Save the news record
        News::create($data);

        return redirect()->back()->with('success', 'News added successfully.');
    }
}
