@extends('layouts.app')

@section('content')
@php
    use Illuminate\Support\Str;

    function cleanStart($text, $keyword) {
        $text = preg_replace('/[\x{200B}\x{00A0}]/u', '', $text);
        $text = trim($text);
        return preg_replace('/^' . preg_quote($keyword, '/') . '[:\s]*/i', '', $text);
    }

    function highlightWarnings($text) {
        $keywords = [
            'stop use', 'ask a doctor', 'overdose', 'emergency', 'seek medical help',
            'heart attack', 'stroke', 'bleeding', 'serious', 'liver damage'
        ];
        foreach ($keywords as $word) {
            $text = preg_replace("/($word)/i", '<span class="text-danger fw-bold">$1</span>', $text);
        }
        return $text;
    }

    function formatDosageToBullets($text) {
        $lines = preg_split('/(?<=\.|\:|\;|\!|\?)\s+|\n+/', $text); // split by sentence end
        $items = array_filter(array_map('trim', $lines));
        return '<ul>' . implode('', array_map(fn($item) => "<li>$item</li>", $items)) . '</ul>';
    }
@endphp

<div class="container">
    <h2 class="mb-4">💊 Medication Lookup</h2>

    <form method="GET" action="{{ url('/staff/medication-search') }}" class="mb-4">
        <div class="input-group">
            <input type="text" name="drugName" class="form-control" placeholder="Enter medication name..." value="{{ old('drugName', $drugName ?? '') }}">
            <button type="submit" class="btn btn-primary">🔍 Search</button>
        </div>
    </form>

    @if($drugData)
        <div class="card shadow-sm">
            <div class="card-header bg-success text-white">
                <h4 class="mb-0">✅ {{ $drugName }}</h4>
            </div>
            <div class="card-body">

                @if(isset($drugData['indications_and_usage']))
                    <p><strong>Usage:</strong></p>
                    <p>{!! highlightWarnings(cleanStart($drugData['indications_and_usage'][0], 'Uses')) !!}</p>
                @endif

                @if(isset($drugData['dosage_and_administration']))
                    <p><strong>Dosage:</strong></p>
                    {!! formatDosageToBullets(cleanStart($drugData['dosage_and_administration'][0], 'Directions')) !!}
                @endif

                @if(isset($drugData['warnings']))
                    <p><strong>Warnings:</strong></p>
                    <p>{!! highlightWarnings(cleanStart($drugData['warnings'][0], 'Warnings')) !!}</p>
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
