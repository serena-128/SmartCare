@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Drug Info: {{ $name }}</h2>
    
    @if(isset($info))
        <p><strong>Purpose:</strong> {{ $info['purpose'][0] ?? 'N/A' }}</p>
        <p><strong>Indications:</strong> {{ $info['indications_and_usage'][0] ?? 'N/A' }}</p>
        <p><strong>Warnings:</strong> {{ $info['warnings'][0] ?? 'N/A' }}</p>
        <p><strong>Dosage & Administration:</strong> {{ $info['dosage_and_administration'][0] ?? 'N/A' }}</p>
    @else
        <p>No data available for this medication.</p>
    @endif

    <a href="{{ url()->previous() }}" class="btn btn-secondary mt-3">← Back</a>
</div>
@endsection
