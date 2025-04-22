<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Photo;

class StaffController extends Controller
{
    public function photoGallery()
    {
        $photos = Photo::all(); // or whatever logic you need
        return view('staff.photo_gallery', compact('photos'));
    }
}
