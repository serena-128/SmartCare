@extends('layouts.app')

@section('content')
<div class="container mt-5">
    <h2 class="text-center text-purple mb-4">🔔 My Notifications</h2>

    @if(auth()->user()->notifications->count() > 0)
        <ul class="list-group">
            @foreach(auth()->user()->notifications as $notification)
                <li class="list-group-item d-flex justify-content-between align-items-center">
                    <div>
                        <strong>{{ $notification->data['type'] ?? 'Alert' }}:</strong>
                        {{ $notification->data['details'] ?? 'Emergency alert triggered' }}<br>
                        <small class="text-muted">Resident: {{ $notification->data['resident'] ?? 'N/A' }} | Urgency: {{ $notification->data['urgency'] ?? 'N/A' }}</small><br>
                        <small class="text-muted">Time: {{ $notification->data['timestamp'] ?? 'Unknown' }}</small>
                    </div>
                    <span class="badge bg-{{ $notification->read_at ? 'secondary' : 'danger' }}">{{ $notification->read_at ? 'Read' : 'New' }}</span>
                </li>
            @endforeach
        </ul>
    @else
        <div class="alert alert-info text-center">You have no notifications yet.</div>
    @endif
</div>
@endsection
