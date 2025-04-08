@extends('layouts.app')

@section('content')
<div class="container mt-4">
    <h2 class="text-dark text-center">📩 Messages</h2>

    <!-- Message List -->
    <div class="card shadow-lg mb-4">
        <div class="card-header bg-info text-white">
            <h5 class="mb-0">Latest Messages</h5>
        </div>
        <div class="card-body">
            @if($messages->isEmpty())
                <p>No new messages.</p>
            @else
                <ul class="list-group">
                    @foreach($messages as $message)
                        <li class="list-group-item">
                            <strong>{{ $message->sender }}:</strong>
                            <p>{{ $message->message }}</p>
                            <small class="text-muted">{{ $message->created_at->diffForHumans() }}</small>
                        </li>
                    @endforeach
                </ul>
            @endif
        </div>
    </div>
</div>
@endsection
