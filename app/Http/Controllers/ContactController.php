<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Mail\ContactMail;

class ContactController extends Controller
{
    public function showForm()
    {
        return view('contact');
    }

    public function submitForm(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:100',
            'email' => 'required|email|max:100',
            'message' => 'required|string|max:500',
        ]);

        // Send email (optional, add Mail configuration in .env)
        Mail::to('admin@smartcare.com')->send(new ContactMail($request->all()));

        return back()->with('success', 'Your message has been sent!');
    }
}
