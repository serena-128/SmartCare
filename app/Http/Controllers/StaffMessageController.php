<?php

namespace App\Http\Controllers;

use App\Models\Message;
use App\Models\NextOfKin;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class StaffMessageController extends Controller
{
    public function index()
    {
        $nextOfKins = NextOfKin::withCount(['unreadMessages' => function($query) {
            $query->where('recipient_id', Auth::id())
                ->where('recipient_type', 'staff')
                ->whereNull('read_at');
        }])->has('messages')->get();
        
        return view('staff.messages.index', [
            'nextOfKins' => $nextOfKins,
            'currentKin' => null,
            'messages' => collect()
        ]);
    }
    
    public function conversation(NextOfKin $nextOfKin)
    {
        $messages = Message::where(function($query) use ($nextOfKin) {
            $query->where('sender_id', Auth::id())
                ->where('sender_type', 'staff')
                ->where('recipient_id', $nextOfKin->id)
                ->where('recipient_type', 'nextofkin');
        })->orWhere(function($query) use ($nextOfKin) {
            $query->where('sender_id', $nextOfKin->id)
                ->where('sender_type', 'nextofkin')
                ->where('recipient_id', Auth::id())
                ->where('recipient_type', 'staff');
        })->orderBy('created_at', 'asc')
        ->get();
        
        // Mark messages as read
        Message::where('sender_id', $nextOfKin->id)
            ->where('sender_type', 'nextofkin')
            ->where('recipient_id', Auth::id())
            ->where('recipient_type', 'staff')
            ->whereNull('read_at')
            ->update(['read_at' => now()]);
            
        $nextOfKins = NextOfKin::withCount(['unreadMessages' => function($query) {
            $query->where('recipient_id', Auth::id())
                ->where('recipient_type', 'staff')
                ->whereNull('read_at');
        }])->has('messages')->get();
        
        return view('staff.messages.index', [
            'nextOfKins' => $nextOfKins,
            'currentKin' => $nextOfKin,
            'messages' => $messages
        ]);
    }
    
    public function send(Request $request)
    {
        $request->validate([
            'recipient_id' => 'required|exists:next_of_kin,id',
            'message' => 'required|string|max:1000'
        ]);
        
        $message = Message::create([
            'sender_id' => Auth::id(),
            'sender_type' => 'staff',
            'recipient_id' => $request->recipient_id,
            'recipient_type' => 'nextofkin',
            'message' => $request->message
        ]);
        
        return back()->with('success', 'Message sent successfully!');
    }
}