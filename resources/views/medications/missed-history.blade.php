@extends('layouts.app')

@section('content')
<div class="container mt-4">
    <h2 class="mb-4">💊 Missed Dosages History</h2>

    {{-- Filter Dropdown --}}
    <form method="GET" action="{{ route('medications.missedHistory') }}" class="mb-3">
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

    {{-- ✅ Export Button --}}
    <a href="{{ route('medications.export', ['resident_id' => request('resident_id')]) }}"
       class="btn btn-outline-primary mb-3">
        📥 Download Excel
    </a>

    {{-- Missed Medications --}}
    @if ($missed->isEmpty())
        <div class="alert alert-info">No missed medications older than 2 days.</div>
    @else
        @foreach ($missed as $residentId => $medications)
            <div class="card mb-3">
                <div class="card-header bg-dark text-white">
                    👤 {{ $medications->first()->resident->full_name ?? 'Unknown Resident' }}
                </div>
                <div class="card-body">
                    <table class="table table-sm table-striped">
                        <thead>
                            <tr>
                                <th>💊 Medication</th>
                                <th>⏰ Last Missed</th>
                                <th>📊 Total Missed</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($medications->groupBy('medication_name') as $medName => $group)
                                <tr>
                                    <td>{{ $medName }}</td>
                                    <td>{{ \Carbon\Carbon::parse($group->max('scheduled_time'))->diffForHumans() }}</td>
                                    <td>{{ $group->count() }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        @endforeach
    @endif
</div>
@endsection
