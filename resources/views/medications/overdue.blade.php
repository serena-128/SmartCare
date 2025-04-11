@extends('layouts.app')

@section('content')
    <div class="container mt-4">
        <h2 class="mb-4">📋 Overdue Medications</h2>

        {{-- 🔍 Sort by Urgency --}}
        <div class="mb-3 text-end">
            <button class="btn btn-warning" onclick="sortTableByUrgency()">
                🔥 Sort by Urgency
            </button>
        </div>

        {{-- ✅ Filter by Resident --}}
        <form method="GET" action="{{ route('medications.overdue') }}" class="mb-4">
            <div class="row">
                <div class="col-md-4">
                    <select name="resident_id" class="form-select" onchange="this.form.submit()">
                        <option value="">-- Filter by Resident --</option>
                        @foreach($allResidents as $res)
                            <option value="{{ $res->id }}" {{ request('resident_id') == $res->id ? 'selected' : '' }}>
                                {{ $res->full_name }}
                            </option>
                        @endforeach
                    </select>
                </div>
            </div>
        </form>

        {{-- ✅ Flash Message --}}
        @if (session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        {{-- ✅ Medication Table --}}
        @if ($medications->isEmpty())
            <div class="alert alert-info">
                No overdue medications found.
            </div>
        @else
            <div class="table-responsive">
                <table class="table table-bordered table-striped" id="medicationsTable">
                    <thead class="table-dark">
                        <tr>
                            <th>👤 Resident</th>
                            <th>💊 Medication</th>
                            <th>⏰ Scheduled</th>
                            <th>✅ Taken</th>
                            <th>⚙️ Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($medications as $med)
                            <tr>
                                <td>{{ $med->resident->full_name ?? 'Unknown' }}</td>
                                <td>{{ $med->medication_name }}</td>
                                <td title="{{ $med->scheduled_time }}">
                                    {{ \Carbon\Carbon::parse($med->scheduled_time)->diffForHumans() }}
                                </td>
                                <td>
                                    {!! $med->taken ? '<span class="badge bg-success">Yes</span>' : '<span class="badge bg-danger">No</span>' !!}
                                </td>
                                <td>
                                    @if (!$med->taken)
                                        <form method="POST" action="{{ route('medications.markTaken', $med->id) }}">
                                            @csrf
                                            @method('PATCH')
                                            <button type="submit" class="btn btn-success btn-sm">Mark as Taken</button>
                                        </form>
                                    @else
                                        <span class="text-muted">✔ Already Taken</span>
                                    @endif
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        @endif
    </div>
@endsection

@push('scripts')
<script>
    function sortTableByUrgency() {
        const table = document.getElementById("medicationsTable");
        const tbody = table.tBodies[0];
        const rows = Array.from(tbody.rows);

        rows.sort((a, b) => {
            const timeA = parseTimeAgo(a.cells[2].textContent.trim());
            const timeB = parseTimeAgo(b.cells[2].textContent.trim());
            return timeB - timeA; // Most urgent (largest time) first
        });

        rows.forEach(row => tbody.appendChild(row));
    }

    function parseTimeAgo(text) {
        if (text.includes("minute")) return parseInt(text) * 60;
        if (text.includes("hour")) return parseInt(text) * 3600;
        if (text.includes("day")) return parseInt(text) * 86400;
        if (text.includes("second")) return parseInt(text);
        return 0; // fallback
    }
</script>
@endpush
