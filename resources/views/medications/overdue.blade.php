@extends('layouts.app') {{-- Only if you have a layout, otherwise skip this --}}

@section('content')
    <h1>Overdue Medications</h1>

    @if ($medications->isEmpty())
        <p>No overdue medications found.</p>
    @else
        <table border="1" cellpadding="10">
            <thead>
                <tr>
                    <th>Resident</th>
                    <th>Medication</th>
                    <th>Scheduled Time</th>
                    <th>Taken</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($medications as $med)
                    <tr>
                        <td>{{ $med->resident->full_name ?? 'Unknown' }}</td>
                        <td>{{ $med->medication_name }}</td>
                        <td>{{ $med->scheduled_time }}</td>
                        <td>{{ $med->taken ? 'Yes' : 'No' }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    @endif
@endsection
