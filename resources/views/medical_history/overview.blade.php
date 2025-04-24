@extends('layouts.app')

@section('content')
<div class="container">
    <h2 class="mb-4">📋 All Residents – Medical History Overview</h2>

    <!-- 🔍 Filter + Search Form -->
    <form method="GET" action="{{ route('medical-history.overview') }}" class="row g-3 align-items-end mb-4">
        <div class="col-md-3">
            <label for="type" class="form-label fw-bold">Filter by Type</label>
            <select name="type" id="type" class="form-select">
                <option value="">All Types</option>
                <option value="illness" {{ request('type') == 'illness' ? 'selected' : '' }}>🧪 Illness</option>
                <option value="surgery" {{ request('type') == 'surgery' ? 'selected' : '' }}>🛠️ Surgery</option>
                <option value="injury" {{ request('type') == 'injury' ? 'selected' : '' }}>🦴 Injury</option>
                <option value="allergy" {{ request('type') == 'allergy' ? 'selected' : '' }}>🌿 Allergy</option>
            </select>
        </div>

        <div class="col-md-3">
            <label for="search" class="form-label fw-bold">Search by Name</label>
            <input type="text" name="search" id="search" class="form-control" value="{{ request('search') }}" placeholder="e.g. John, Smith...">
        </div>

        <div class="col-md-3">
            <label for="from" class="form-label fw-bold">From Date</label>
            <input type="date" name="from" id="from" class="form-control" value="{{ request('from') }}">
        </div>

        <div class="col-md-3">
            <label for="to" class="form-label fw-bold">To Date</label>
            <input type="date" name="to" id="to" class="form-control" value="{{ request('to') }}">
        </div>

        <div class="col-md-12 d-flex justify-content-start gap-2 mt-2">
            <button type="submit" class="btn btn-primary">Apply Filters</button>
            @if(request()->anyFilled(['type', 'search', 'from', 'to']))
                <a href="{{ route('medical-history.overview') }}" class="btn btn-outline-secondary">Reset</a>
            @endif
        </div>
    </form>

    <!-- 🔁 Resident Cards -->
@forelse ($residents as $resident)
    @php
        // Get the most recent medical history for the resident
        $recentEntry = $resident->medicalHistories->first(); // This will be the latest due to ordering
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
            @endif

            <div class="d-flex justify-content-end gap-2 mt-3">
                <a href="{{ route('medical-history.index', $resident->id) }}" class="btn btn-sm btn-outline-secondary">
                    📄 View Details
                </a>
                <a href="{{ route('medical-history.timeline', $resident->id) }}" class="btn btn-sm btn-outline-dark">
                    🗓️ View Timeline
                </a>
                <!-- Add the PDF export button -->
                <a href="{{ route('medical-history.export-pdf', $resident->id) }}" class="btn btn-outline-primary btn-sm">
                📥 Export to PDF
            </a>
                    </div>
        </div>
    </div>
@empty
    <div class="alert alert-warning">No residents found.</div>
@endforelse

</div>
@endsection
