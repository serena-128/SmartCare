@extends('layouts.app')

@section('content')
<div class="container">
    <h2 class="mb-4">📋 All Residents – Medical History Overview</h2>

    @forelse ($residents as $resident)
        <div class="card mb-3 shadow">
            <div class="card-body">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <h4 class="mb-1">{{ $resident->firstname }} {{ $resident->lastname }}</h4>
                        <p class="text-muted mb-1">🛏️ Room: {{ $resident->roomnumber ?? 'N/A' }}</p>
                        <p class="text-muted mb-0">
                            🎂 Age: {{ $resident->dateofbirth ? \Carbon\Carbon::parse($resident->dateofbirth)->age : 'Unknown' }}
                            | 👤 Gender: {{ $resident->gender }}
                        </p>

                    </div>

                    <div class="text-end">
                        <a href="{{ route('medical-history.index', $resident->id) }}" class="btn btn-outline-primary btn-sm mb-2">📄 View Details</a>
                        <br>
                        <a href="{{ route('medical-history.timeline', $resident->id) }}" class="btn btn-outline-dark btn-sm">🗓️ View Timeline</a>
                    </div>
                </div>

                @if ($resident->medicalHistories->count() > 0)
                    <hr>
                    <h6 class="text-muted">Recent Entries:</h6>
                    <ul class="list-group list-group-flush">
                        @foreach ($resident->medicalHistories->take(2) as $entry)
                            <li class="list-group-item">
                                <strong>{{ $entry->title }}</strong>
                                <small class="text-muted"> ({{ ucfirst($entry->type) }}, {{ \Carbon\Carbon::parse($entry->diagnosed_at)->format('M Y') ?? 'N/A' }})</small>
                            </li>
                        @endforeach
                    </ul>
                @else
                    <p class="text-muted mt-3">No medical history added yet.</p>
                @endif
            </div>
        </div>
    @empty
        <div class="alert alert-warning">No residents found.</div>
    @endforelse
</div>
@endsection
