<?php

namespace App\Mail;

use App\Models\Photo;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class NewPhotoNotification extends Mailable
{
    use Queueable, SerializesModels;
    
    public $photo;

    public function __construct(Photo $photo)
    {
        $this->photo = $photo;
    }

    public function build()
    {
        return $this->subject('New Photo Added to the Gallery')
                    ->markdown('emails.photos.new');
    }
}
