@extends('layouts.app')

@section('content')
    <h1>Overdue Medications</h1>

    {{-- Optional success message --}}
    @if (session('success'))
        <div style="color: green; margin-bottom: 10px;">
            {{ session('success') }}
        </div>
    @endif

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
                    <th>Action</th>
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
                        <td>{{ $med->taken ? 'Yes' : 'No' }}</td>
                        <td>
                            @if (!$med->taken)
                                <form method="POST" action="{{ route('medications.markTaken', $med->id) }}">
                                    @csrf
                                    @method('PATCH')
                                    <button type="submit" style="background-color: #28a745; color: white; padding: 5px 10px; border: none; border-radius: 4px;">
                                        Mark as Taken
                                    </button>
                                </form>
                            @else
                                ✅
                            @endif
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    @endif
@endsection
