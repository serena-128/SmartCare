@extends('layouts.app')

@section('content')
<div class="container">
    <h2 class="text-center">👤 Resident Profile: {{ $resident->firstname }} {{ $resident->lastname }}</h2>

    <div class="card shadow-lg p-4">
        <!-- Resident Image -->
        <div class="text-center mb-3">
            <img src="{{ asset('images/John_doe.png') }}" alt="Resident Image" class="img-fluid rounded-circle" style="width: 150px; height: 150px; object-fit: cover;">
        </div>

        <!-- Resident Personal Info -->
        <h4 class="text-primary">🏠 Personal Information</h4>
        <p><strong>Name:</strong> {{ $resident->firstname }} {{ $resident->lastname }}</p>
        <p><strong>Date of Birth:</strong> {{ $resident->dateofbirth }}</p>
        <p><strong>Gender:</strong> {{ $resident->gender }}</p>
        <p><strong>Room Number:</strong> {{ $resident->roomnumber }}</p>
        <p><strong>Admission Date:</strong> {{ $resident->admissiondate }}</p>

        <hr>

        <!-- Diagnoses Section -->
        <h4 class="text-danger">🩺 Diagnoses</h4>
        @if($resident->diagnoses->isNotEmpty())
            <ul>
                @foreach($resident->diagnoses as $diagnosis)
                    <li><strong>{{ $diagnosis->diagnosis }}</strong> - {{ $diagnosis->notes }}</li>
                @endforeach
            </ul>
        @else
            <p class="text-muted">No diagnoses recorded.</p>
        @endif
    </div>

    <!-- Care Logs Filter Form -->
    <div class="mt-4">
        <h4>📅 Filter Care Logs</h4>
        <form method="GET" action="{{ route('residents.show', ['resident' => $resident->id]) }}">
            <div class="row">
                <div class="col-md-4">
                    <label for="date">Filter by Date:</label>
                    <input type="date" name="date" class="form-control" value="{{ request('date') }}">
                </div>

                <div class="col-md-4">
                    <label for="caregiver_id">Filter by Caregiver:</label>
                    <select name="caregiver_id" class="form-control">
                        <option value="">All Caregivers</option>
                        @foreach($caregivers as $caregiver)
                            <option value="{{ $caregiver->id }}" @selected(request('caregiver_id') == $caregiver->id)>
                                {{ $caregiver->name }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <div class="col-md-4 d-flex align-items-end">
                    <button type="submit" class="btn btn-primary w-100">🔍 Filter</button>
                </div>
            </div>
        </form>
    </div>

    <!-- Care Logs Display -->
<!-- Care Logs Display -->
<div class="mt-4">
    <h4 class="text-info">📝 Care Logs</h4>
    @if($careLogs->isNotEmpty())
        <ul class="list-group">
            @foreach($careLogs as $log)
                <li class="list-group-item">
                    <strong>{{ $log->activity_type }}</strong> by 
                    <em>{{ $log->caregiver_name ?? 'Unknown' }} ({{ $log->caregiver_type ?? 'N/A' }})</em> 
                    on {{ \Carbon\Carbon::parse($log->logged_at)->format('d-m-Y H:i') }}
                    @if($log->notes)
                        <br><small>{{ $log->notes }}</small>
                    @endif
                </li>
            @endforeach
        </ul>
    @else
        <p class="text-muted">No care logs found for the selected criteria.</p>
    @endif
</div>


    <!-- Log Care Activity Button -->
    <div class="mt-4 text-center">
        <a href="{{ route('care_logs.create', $resident->id) }}" class="btn btn-primary">
            📝 Log Care Activity
        </a>
        <a href="{{ route('residents.index') }}" class="btn btn-secondary">
            🏠 Back to Residents List
        </a>
    </div>

</div>
@endsection
