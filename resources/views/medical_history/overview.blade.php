@extends('layouts.app')

@section('content')
<div class="container">
    <h2 class="mb-4">📋 All Residents – Medical History Overview</h2>

    <!-- 🔍 Filter + Search Form -->
    <form method="GET" action="{{ route('medical-history.overview') }}" class="row g-3 align-items-end mb-4">
        <div class="col-md-4">
            <label for="type" class="form-label fw-bold">Filter by Type</label>
            <select name="type" id="type" class="form-select">
                <option value="">All Types</option>
                <option value="illness" {{ request('type') == 'illness' ? 'selected' : '' }}>🧪 Illness</option>
                <option value="surgery" {{ request('type') == 'surgery' ? 'selected' : '' }}>🛠️ Surgery</option>
                <option value="injury" {{ request('type') == 'injury' ? 'selected' : '' }}>🦴 Injury</option>
                <option value="allergy" {{ request('type') == 'allergy' ? 'selected' : '' }}>🌿 Allergy</option>
            </select>
        </div>
        <div class="col-md-4">
            <label for="search" class="form-label fw-bold">Search by Name</label>
            <input type="text" name="search" id="search" class="form-control" value="{{ request('search') }}" placeholder="e.g. John, Smith...">
        </div>
        <div class="col-md-4 d-flex justify-content-start gap-2">
            <button type="submit" class="btn btn-primary mt-4">Apply Filters</button>
            @if(request('type') || request('search'))
                <a href="{{ route('medical-history.overview') }}" class="btn btn-outline-secondary mt-4">Reset</a>
            @endif
        </div>
    </form>

    <!-- 🔁 Resident Cards -->
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
                <h5 class="fw-bold mb-1">{{ $resident->firstname }} {{ $resident->lastname }}</h5>
                <p class="text-muted mb-1">🛏️ Room {{ $resident->roomnumber ?? 'N/A' }}</p>
                <p class="text-muted mb-3">
                    🎂 Age: {{ $resident->dateofbirth ? \Carbon\Carbon::parse($resident->dateofbirth)->age : 'Unknown' }}
                    | 👤 {{ $resident->gender }}
                </p>

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
</div>
@endsection
