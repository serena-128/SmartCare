<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Photo; // Make sure your Photo model exists and is set up correctly

class PhotoGalleryController extends Controller
{
    public function index()
    {
        // Fetch photos from the database, ordered by newest first
        $photos = Photo::orderBy('created_at', 'desc')->get();
        return view('photogallery', compact('photos'));
    }
}
