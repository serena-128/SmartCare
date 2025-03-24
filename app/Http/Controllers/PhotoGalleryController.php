<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PhotoGalleryController extends Controller
{
    public function index()
    {
        // Optionally fetch photos from the database.
        // $photos = \App\Models\Photo::all();
        // For now, we'll pass a placeholder array.
        $photos = [
            'photo1.jpg',
            'photo2.jpg',
            'photo3.jpg',
            // Add more if needed...
        ];

        return view('photogallery.index', compact('photos'));
    }
}
