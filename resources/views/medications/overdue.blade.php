@extends('layouts.app')

@section('content')
    <div class="container mt-4">
        <h2 class="mb-4">📋 Overdue Medications</h2>

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

        {{-- ✅ Flash message --}}
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
                <table class="table table-bordered table-striped">
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
                                            <button type="submit" class="btn btn-success btn-sm">
                                                Mark as Taken
                                            </button>
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
