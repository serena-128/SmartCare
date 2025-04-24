@extends('layouts.app')

@section('content')
<div class="container">
    <h2 class="mb-4">📋 All Residents – Medical History Overview</h2>

@forelse ($residents as $resident)
    @php
        $recentEntry = $resident->medicalHistories
            ->where('diagnosed_at', '>=', now()->subYears(10))
            ->sortByDesc('diagnosed_at')
            ->first();

        $typeIcon = match(optional($recentEntry)->type) {
            'illness' => '🧪',
            'surgery' => '🛠️',
            'injury' => '🦴',
            'allergy' => '🌿',
            default => '❓'
        };
    @endphp

    <div class="card mb-4 shadow-sm border-0">
        <div class="card-body">
            <!-- Top: Name and details -->
            <h5 class="fw-bold mb-1">{{ $resident->firstname }} {{ $resident->lastname }}</h5>
            <p class="text-muted mb-1">🛏️ Room {{ $resident->roomnumber ?? 'N/A' }}</p>
            <p class="text-muted mb-3">
                🎂 Age: {{ $resident->dateofbirth ? \Carbon\Carbon::parse($resident->dateofbirth)->age : 'Unknown' }}
                | 👤 {{ $resident->gender }}
            </p>

            <!-- Middle: Most recent history -->
            @if ($recentEntry)
                <div class="bg-light p-3 rounded">
                    <p class="mb-1">
                        {{ $typeIcon }} <strong>{{ $recentEntry->title }}</strong>
                        <small class="text-muted">({{ ucfirst($recentEntry->type) }}, 
                        {{ \Carbon\Carbon::parse($recentEntry->diagnosed_at)->format('M Y') }})</small>
                    </p>
                    <p class="text-muted small mb-0">{{ Str::limit($recentEntry->description, 100) }}</p>
                </div>
            @else
                <p class="text-muted">No medical history in the past 10 years.</p>
            @endif

            <!-- Bottom: Buttons -->
            <div class="d-flex justify-content-end gap-2 mt-3">
                <a href="{{ route('medical-history.index', $resident->id) }}" class="btn btn-sm btn-outline-secondary">
                    📄 View Details
                </a>
                <a href="{{ route('medical-history.timeline', $resident->id) }}" class="btn btn-sm btn-outline-dark">
                    🗓️ View Timeline
                </a>
            </div>
        </div>
    </div>
@empty
    <div class="alert alert-warning">No residents found.</div>
@endforelse
