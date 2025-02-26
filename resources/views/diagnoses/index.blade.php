@extends('layouts.app')

@section('content')
<div class="container">
    <!-- Page Header -->
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2 class="text-dark">🩺 Resident Diagnoses</h2>
        <a href="{!! route('diagnoses.create') !!}" class="btn btn-primary">
            ➕ Add New Diagnosis
        </a>
    </div>

    <!-- Flash Messages -->
    @include('flash::message')

    <!-- Diagnoses Table -->
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
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                @foreach($diagnoses as $diagnosis)
                    <tr>
                        <td>
                            @if($diagnosis->resident)
                                {{ $diagnosis->resident->firstname }} {{ $diagnosis->resident->lastname }}
                            @else
                                <span class="text-danger">Unknown Resident</span>
                            @endif
                        </td>
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
                        <td>
                            <!-- Action Buttons -->
                            <div class="btn-group" role="group">
                                <!-- View -->
                                <a href="{!! route('diagnoses.show', [$diagnosis->id]) !!}" class="btn btn-info btn-sm" title="View">
                                    <i class="fas fa-eye"></i>
                                </a>
                                
                                <!-- Edit -->
                                <a href="{!! route('diagnoses.edit', [$diagnosis->id]) !!}" class="btn btn-warning btn-sm" title="Edit">
                                    <i class="fas fa-edit"></i>
                                </a>
                                
                                <!-- Delete -->
                                {!! Form::open(['route' => ['diagnoses.destroy', $diagnosis->id], 'method' => 'delete', 'style' => 'display:inline;']) !!}
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
                </tbody>
            </table>
        </div>
    </div>
</div>

@endsection
