@extends('layouts.app')

@section('content')
<div class="container">
    <h2 class="mb-4">
        🧬 Medical Timeline: {{ $resident->firstname }} {{ $resident->lastname }}
        <a href="{{ route('medical-history.overview') }}" class="btn btn-outline-secondary btn-sm float-end">← Back to Medical History</a>


    </h2>

    @if ($resident->medicalHistories->isEmpty())
        <p>No medical history entries found.</p>
    @else
        <div class="timeline-container">
            @foreach ($resident->medicalHistories as $entry)
                <div class="timeline-item">
                    <div class="timeline-date">
                        {{ \Carbon\Carbon::parse($entry->diagnosed_at)->format('Y') }}
                    </div>
                    <div class="timeline-content border-start ps-3">
                        <h5 class="mb-1">{{ $entry->title }}</h5>
                        <span class="badge bg-info text-dark mb-2">{{ ucfirst($entry->type) }}</span>
                        <p class="mb-1">{{ $entry->description }}</p>
                        <small class="text-muted">
                            Source: {{ $entry->source ?? 'N/A' }}
                            <!-- Visibility is hidden, so this line is removed or commented out -->
                            <!-- | Visibility: {{ $entry->visibility }} -->
                        </small>
                    </div>
                </div>
            @endforeach
        </div>
    @endif
</div>

<style>
.timeline-container {
    position: relative;
    margin-left: 1rem;
    border-left: 3px solid #ccc;
    padding-left: 1.5rem;
}
.timeline-item {
    position: relative;
    margin-bottom: 2rem;
}
.timeline-date {
    position: absolute;
    left: -4rem;
    top: 0;
    background: #f0f0f0;
    padding: 0.25rem 0.5rem;
    border-radius: 4px;
    font-weight: bold;
    font-size: 0.9rem;
}
.timeline-content {
    background: #f9f9f9;
    padding: 1rem;
    border-radius: 8px;
}
</style>
@endsection
