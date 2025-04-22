@extends('layouts.app')

@section('content')
<div class="container mt-4">
    <h2>Conversation Thread</h2>
    
    <!-- Display Original Message -->
    <div class="card mb-3">
        <div class="card-header bg-info text-white">
            <strong>{{ $conversation->sender }}</strong> (Original)
        </div>
        <div class="card-body">
            <p>{{ $conversation->message }}</p>
            <small class="text-muted">{{ $conversation->created_at->diffForHumans() }}</small>
        </div>
    </div>
    
    <!-- Display Replies -->
    @if($conversation->replies->isNotEmpty())
        <h4>Replies</h4>
        @foreach($conversation->replies as $reply)
            <div class="card mb-2">
                <div class="card-header bg-secondary text-white">
                    <strong>{{ $reply->sender }}</strong> (Reply)
                </div>
                <div class="card-body">
                    <p>{{ $reply->message }}</p>
                    <small class="text-muted">{{ $reply->created_at->diffForHumans() }}</small>
                </div>
            </div>
        @endforeach
    @else
        <p>No replies yet.</p>
    @endif

<!-- Reply Form -->
<div class="mt-4">
    <h4>Reply</h4>
    <form action="{{ route('staff.reply', $conversation->id) }}" method="POST">
        @csrf
        <!-- Hidden field for sender -->
        <input type="hidden" name="sender" value="{{ Auth::user()->name }}">
        <textarea name="reply" rows="4" class="form-control" placeholder="Type your reply here..." required></textarea>
        <button type="submit" class="btn btn-primary mt-2">Send Reply</button>
    </form>
</div>
</div>
@endsection
