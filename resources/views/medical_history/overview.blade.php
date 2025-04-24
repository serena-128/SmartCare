@extends('layouts.app')

@section('content')
<div class="container">
    <h2 class="mb-4">📜 All Residents - Medical History</h2>

    @forelse ($residents as $resident)
        <div class="card mb-3 shadow-sm">
            <div class="card-body">
                <h5 class="card-title">
                    {{ $resident->firstname }} {{ $resident->lastname }}
                    <a href="{{ route('medical-history.index', $resident->id) }}" class="btn btn-sm btn-outline-primary float-end">
                        View Details →
                    </a>
                </h5>

                @if ($resident->medicalHistories->count() > 0)
                    <ul class="list-group list-group-flush">
                        @foreach ($resident->medicalHistories->take(2) as $entry)
                            <li class="list-group-item">
                                <strong>{{ $entry->title }}</strong> 
                                <small class="text-muted">({{ ucfirst($entry->type) }}) - {{ $entry->diagnosed_at ?? 'N/A' }}</small>
                            </li>
                        @endforeach
                    </ul>
                @else
                    <p class="text-muted">No medical history added yet.</p>
                @endif
            </div>
        </div>
    @empty
        <p>No residents found.</p>
    @endforelse
</div>
@endsection
