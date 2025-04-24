@extends('layouts.app')

@section('content')
<div class="container mt-4">
    <div class="card shadow-lg">
        <div class="card-header bg-primary text-white">
            <h4 class="mb-0">📝 Feedback Details</h4>
        </div>
        <div class="card-body">
            <p><strong>Subject:</strong> {{ $feedback->subject }}</p>
            <p><strong>Category:</strong> {{ $feedback->category }}</p>
            <p><strong>Message:</strong> <br>{{ $feedback->message }}</p>

            @if($feedback->rating)
                <p><strong>Rating:</strong>
                    @for($i = 0; $i < $feedback->rating; $i++)
                        ⭐
                    @endfor
                    ({{ $feedback->rating }}/5)
                </p>
            @endif

            <p><strong>Submitted:</strong> {{ $feedback->created_at->format('Y-m-d H:i') }}</p>

            @if(!$feedback->is_anonymous && $feedback->staff)
                <p><strong>Submitted By:</strong> {{ $feedback->staff->firstname }} {{ $feedback->staff->lastname }}</p>
            @else
                <p><strong>Submitted By:</strong> Anonymous</p>
            @endif

            @if($feedback->attachment)
                <p><strong>Attachment:</strong> 
                    <a href="{{ asset('storage/' . $feedback->attachment) }}" target="_blank" class="btn btn-outline-info btn-sm">
                        📎 Download File
                    </a>
                </p>
            @endif

            <a href="{{ route('feedback.index') }}" class="btn btn-secondary">⬅️ Back to Feedback List</a>
        </div>
    </div>
</div>
@endsection
