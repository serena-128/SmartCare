<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class ContactMail extends Mailable
{
    use Queueable, SerializesModels;

    public $details;  // Holds the submitted form data

    public function __construct($details)
    {
        $this->details = $details;  // Store form data
    }

    public function build()
    {
        return $this->subject('New Contact Form Message')
                    ->view('emails.contact');  // Email template
    }
}
