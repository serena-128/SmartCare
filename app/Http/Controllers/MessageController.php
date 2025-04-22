<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Message;
use Illuminate\Support\Facades\Auth;

class MessageController extends Controller
{
    public function reply(Request $request, $messageId)
{
    $request->validate([
        'reply' => 'required|string',
    ]);

    $message = Message::findOrFail($messageId);

    if (!$message->nextofkin_id) {
        return redirect()->back()->with('error', 'This message is not linked to a Next of Kin.');
    }

    $replyMessage = new Message();
    $replyMessage->message = $request->input('reply');
    $replyMessage->recipient = 'nextofkin';
    $replyMessage->caregiver_id = auth()->user()->id;
    $replyMessage->nextofkin_id = $message->nextofkin_id;
    $replyMessage->sender = auth()->user()->firstname . ' ' . auth()->user()->lastname;
    $replyMessage->parent_id = $message->id;
    $replyMessage->save();

    return redirect()->route('staff.messages')->with('success', 'Reply sent successfully.');
}


    public function showThread($id)
    {
        $conversation = Message::with('replies')->findOrFail($id);
        return view('staff.conversation', compact('conversation'));
    }
}
