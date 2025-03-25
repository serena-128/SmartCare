@extends('layouts.app')

@section('content')
<div class="container">
    <h2 class="text-center mb-4">All Resident Diagnoses</h2>

    <!-- Flash Messages -->
    @include('flash::message')

    @if($residents->count() > 0)
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
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
            @foreach($residents as $resident)
                @foreach($resident->diagnosistypes as $diagnosis)
                    <tr>
                        <td>{{ $resident->firstname }} {{ $resident->lastname }}</td>
                        <td>{{ $diagnosis->name }}</td>
                        <td>{{ $diagnosis->pivot->vitalsigns }}</td>
                        <td>{{ $diagnosis->pivot->treatment }}</td>
                        <td>{{ $diagnosis->pivot->testresults }}</td>
                        <td>{{ $diagnosis->pivot->notes }}</td>
                        <td>
                            @php
                                $staff = \App\Models\StaffMember::find($diagnosis->pivot->lastupdatedby);
                            @endphp
                            {{ $staff ? $staff->firstname . ' ' . $staff->lastname : 'N/A' }}
                        </td>
                        <td>
                            <!-- Action Buttons -->
                            <div class="btn-group" role="group">
                                <!-- View -->
                                <a href="{{ route('diagnoses.show', $diagnosis->pivot->id) }}"
                                   class="btn btn-info btn-sm" title="View">
                                    <i class="fas fa-eye"></i>
                                </a>

                                <!-- Edit -->
                                <a href="{{ route('diagnoses.edit', $diagnosis->pivot->id) }}"
                                   class="btn btn-warning btn-sm" title="Edit">
                                    <i class="fas fa-edit"></i>
                                </a>

                                <!-- Delete -->
                                {!! Form::open(['route' => ['diagnoses.destroy', $diagnosis->pivot->id],
                                                'method' => 'delete', 'style' => 'display:inline;']) !!}
                                    {!! Form::button('<i class="fas fa-trash-alt"></i>', [
                                        'type' => 'submit',
                                        'class' => 'btn btn-danger btn-sm',
                                        'title' => 'Delete',
                                        'onclick' => "return confirm('Are you sure you want to delete this diagnosis?')"
                                    ]) !!}
                                {!! Form::close() !!}
                            </div>
                        </td>
                    </tr>
                @endforeach
            @endforeach
            </tbody>
        </table>
    @else
        <p class="text-center text-muted">No diagnoses found.</p>
    @endif

    <!-- Back to Dashboard -->
    <div class="mt-4 text-center">
        <a href="{{ route('staffDashboard') }}" class="btn btn-secondary">
            🏠 Back to Dashboard
        </a>
    </div>
</div>
@endsection
