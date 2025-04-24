@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Medical History</h2>

    <!-- Trigger Modal Button -->
    <button class="btn btn-primary mb-3" data-bs-toggle="modal" data-bs-target="#addMedicalHistoryModal">
        + Add History
    </button>

    <!-- List of Entries -->
    @forelse ($histories as $entry)
        <div class="card mb-3">
            <div class="card-body">
                <h5>{{ $entry->title }} <small class="text-muted">({{ ucfirst($entry->type) }})</small></h5>
                <p>{{ $entry->description }}</p>
                <p><strong>Diagnosed:</strong> {{ $entry->diagnosed_at ?? 'Unknown' }}<br>
                <strong>Source:</strong> {{ $entry->source }}<br>
                <strong>Visibility:</strong> {{ $entry->visibility }}</p>
            </div>
        </div>
    @empty
        <p>No medical history found for this resident.</p>
    @endforelse
</div>

<!-- Include the modal -->
@include('medical_history.modal')
@endsection
