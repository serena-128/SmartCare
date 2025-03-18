@extends('layouts.app')

@section('content')
<div class="container">
    <h2 class="text-dark text-center">🔍 Search Resident Diagnoses</h2>


    <!-- Flash Messages -->
    @if(session('error'))
        <div class="alert alert-danger text-center">{{ session('error') }}</div>
    @endif

    <!-- Search Bar -->
    <form action="{{ route('diagnoses.search') }}" method="GET" class="mb-4">
        <div class="input-group">
            <input type="text" name="query" class="form-control" placeholder="Enter Resident Name" required>
            <button class="btn btn-primary" type="submit">Search</button>
        </div>
    </form>

    <!-- Show Results ONLY If a Search Was Performed -->
    @if(isset($diagnoses) && $diagnoses->isNotEmpty())
        <div class="card shadow-lg">
            <div class="card-body">
                <table class="table table-hover">
                    <thead class="table-light">
                        <tr>
                            <th>Resident</th>
                            <th>Diagnosis</th>
                            <th>Vital Signs</th>
                            <th>Treatment</th>
                            <th>Test Results</th>
                            <th>Notes</th>
                            <th>Last Updated By</th>
                        </tr>
                    </thead>
                    <tbody>
                    @foreach($diagnoses as $diagnosis)
                        <tr>
                            <td>{{ $diagnosis->resident->firstname }} {{ $diagnosis->resident->lastname }}</td>
                            <td>{{ $diagnosis->diagnosis }}</td>
                            <td>{{ $diagnosis->vitalsigns }}</td>
                            <td>{{ $diagnosis->treatment }}</td>
                            <td>{{ $diagnosis->testresults }}</td>
                            <td>{{ $diagnosis->notes }}</td>
                            <td>
                                @if($diagnosis->lastUpdatedBy)
                                    {{ $diagnosis->lastUpdatedBy->firstname }} {{ $diagnosis->lastUpdatedBy->lastname }}
                                @else
                                    <span class="text-muted">N/A</span>
                                @endif
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    @elseif(isset($diagnoses))
        <p class="text-center text-muted">No diagnoses found for this resident.</p>
    @endif

    <!-- Back to Dashboard Button -->
    <div class="mt-4 text-center">
        <a href="{{ route('staffDashboard') }}" class="btn btn-secondary">
            🏠 Back to Dashboard
        </a>
    </div>
</div>
@endsection
