<?php

namespace App\Mail;

use App\Models\Message;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class MessageReply extends Mailable
{
    use Queueable, SerializesModels;

    public $replyMessage;

    public function __construct(Message $replyMessage)
    {
        $this->replyMessage = $replyMessage;
    }

    public function build()
    {
        return $this->subject('Reply to Your Message')
                    ->view('emails.reply')
                    ->with([
                        'message' => $this->replyMessage->message,
                    ]);
    }
}
