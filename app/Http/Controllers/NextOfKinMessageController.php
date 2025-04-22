<?php

namespace App\Http\Controllers;

use App\Models\Message;
use App\Models\Staff;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class NextOfKinMessageController extends Controller
{
    public function index()
    {
        $staffMembers = Staff::active()->get();
        $sentMessages = Message::where('sender_id', Auth::id())
            ->where('sender_type', 'nextofkin')
            ->with('recipient')
            ->latest()
            ->paginate(10);
            
        return view('nextofkin.messages', compact('staffMembers', 'sentMessages'));
    }
    
    public function send(Request $request)
    {
        $request->validate([
            'recipient_id' => 'required|exists:staff,id',
            'message' => 'required|string|max:1000'
        ]);
        
        $message = Message::create([
            'sender_id' => Auth::id(),
            'sender_type' => 'nextofkin',
            'recipient_id' => $request->recipient_id,
            'recipient_type' => 'staff',
            'message' => $request->message
        ]);
        
        return back()->with('success', 'Message sent successfully!');
    }
    
    public function conversation(Staff $staff)
    {
        $messages = Message::where(function($query) use ($staff) {
            $query->where('sender_id', Auth::id())
                ->where('sender_type', 'nextofkin')
                ->where('recipient_id', $staff->id)
                ->where('recipient_type', 'staff');
        })->orWhere(function($query) use ($staff) {
            $query->where('sender_id', $staff->id)
                ->where('sender_type', 'staff')
                ->where('recipient_id', Auth::id())
                ->where('recipient_type', 'nextofkin');
        })->orderBy('created_at', 'asc')
        ->get();
        
        // Mark messages as read
        Message::where('sender_id', $staff->id)
            ->where('sender_type', 'staff')
            ->where('recipient_id', Auth::id())
            ->where('recipient_type', 'nextofkin')
            ->whereNull('read_at')
            ->update(['read_at' => now()]);
            
        return view('nextofkin.conversation', compact('staff', 'messages'));
    }
}