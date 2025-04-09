@extends('layouts.app')

@section('content')
<div class="container">
    <h2 class="mb-4">💊 Medication Center</h2>

    <!-- Tabs -->
    <ul class="nav nav-tabs" id="medTab" role="tablist">
        <li class="nav-item" role="presentation">
            <button class="nav-link active" id="residents-tab" data-bs-toggle="tab" data-bs-target="#residents" type="button" role="tab">
                🧑‍⚕️ Resident Medications
            </button>
        </li>
        <li class="nav-item" role="presentation">
            <button class="nav-link" id="lookup-tab" data-bs-toggle="tab" data-bs-target="#lookup" type="button" role="tab">
                🔍 Medication Lookup
            </button>
        </li>
        <li class="nav-item" role="presentation">
            <button class="nav-link" id="pharmacy-tab" data-bs-toggle="tab" data-bs-target="#pharmacy" type="button" role="tab">
                🏪 Pharmacy Info
            </button>
        </li>
    </ul>

    <div class="tab-content mt-4" id="medTabContent">
        <!-- Resident Medications Tab -->
        <div class="tab-pane fade show active" id="residents" role="tabpanel">
            @if($residents->count())
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>Resident Name</th>
                            <th>Allergies</th>
                            <th>Current Medications</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($residents as $resident)
                            <tr>
                                <td>{{ $resident->firstname }} {{ $resident->lastname }}</td>
                                <td>{{ $resident->allergies ?? 'None' }}</td>
                                <td>{{ $resident->medications ?? 'Not listed' }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            @else
                <p>No resident data available.</p>
            @endif
        </div>

        <!-- Medication Lookup Tab -->
        <div class="tab-pane fade" id="lookup" role="tabpanel">
            <form method="GET" action="{{ url('/staff/medication-search') }}" class="mb-3">
                <div class="input-group">
                    <input type="text" name="drugName" class="form-control" placeholder="Enter medication name..." value="{{ old('drugName', $drugName ?? '') }}">
                    <button type="submit" class="btn btn-primary">Search</button>
                </div>
            </form>

            @if($drugData)
                <div class="card">
                    <div class="card-header bg-success text-white">
                        <strong>✅ {{ $drugName }}</strong>
                    </div>
                    <div class="card-body">
                        @php
                            function clean($text, $keyword) {
                                $text = preg_replace('/[\x{200B}\x{00A0}]/u', '', $text);
                                $text = trim($text);
                                return preg_replace('/^' . preg_quote($keyword, '/') . '[:\s]*/i', '', $text);
                            }
                        @endphp

                        @if(isset($drugData['indications_and_usage']))
                            <p><strong>Usage:</strong></p>
                            <p>{{ clean($drugData['indications_and_usage'][0], 'Uses') }}</p>
                        @endif

                        @if(isset($drugData['dosage_and_administration']))
                            <p><strong>Dosage:</strong></p>
                            <ul>
                                @foreach(preg_split('/\r\n|\n|\r/', clean($drugData['dosage_and_administration'][0], 'Directions')) as $line)
                                    <li>{{ $line }}</li>
                                @endforeach
                            </ul>
                        @endif

                        @if(isset($drugData['warnings']))
                            <p><strong>Warnings:</strong></p>
                            <p>{{ clean($drugData['warnings'][0], 'Warnings') }}</p>
                        @endif
                    </div>
                </div>
            @elseif(request()->has('drugName'))
                <div class="alert alert-warning">
                    No results found for <strong>{{ $drugName }}</strong>.
                </div>
            @endif
        </div>

        <!-- Pharmacy Info Tab -->
        <div class="tab-pane fade" id="pharmacy" role="tabpanel">
            <p>Coming soon: pharmacy contact info, stock availability, or integration with a prescription provider.</p>
        </div>
    </div>
</div>
@endsection
