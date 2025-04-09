@extends('layouts.app')

@section('content')
<div class="container">
    <h2 class="mb-4">💊 Medication Lookup</h2>

    <!-- Search Form -->
    <form method="GET" action="{{ url('/staff/medication-search') }}" class="mb-4">
        <div class="input-group">
            <input type="text" name="drugName" class="form-control" placeholder="Enter medication name..." value="{{ old('drugName', $drugName ?? '') }}">
            <button type="submit" class="btn btn-primary">🔍 Search</button>
        </div>
    </form>

    <!-- Medication Results -->
    @if($drugData)
        <div class="card shadow-sm">
            <div class="card-header bg-success text-white">
                <h4 class="mb-0">✅ {{ $drugName }}</h4>
            </div>
            <div class="card-body">
                @if(isset($drugData['description']))
                    <p><strong>Description:</strong></p>
                    <p>{{ $drugData['description'][0] }}</p>
                @endif

                @if(isset($drugData['indications_and_usage']))
                    <p><strong>Usage:</strong></p>
                    <p>{{ $drugData['indications_and_usage'][0] }}</p>
                @endif

                @if(isset($drugData['dosage_and_administration']))
                    <p><strong>Dosage:</strong></p>
                    <p>{{ $drugData['dosage_and_administration'][0] }}</p>
                @endif

                @if(isset($drugData['warnings']))
                    <p><strong>Warnings:</strong></p>
                    <p>{{ $drugData['warnings'][0] }}</p>
                @endif
            </div>
        </div>
    @elseif(request()->has('drugName'))
        <div class="alert alert-warning">
            😕 No results found for <strong>{{ $drugName }}</strong>.
        </div>
    @endif
</div>
@endsection
