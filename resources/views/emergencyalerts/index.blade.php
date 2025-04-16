@extends('layouts.app')

@section('content')
<style>
    .badge {
        font-size: 0.9rem;
        padding: 0.5em 0.8em;
        border-radius: 0.5rem;
        font-weight: 500;
    }
    .badge-danger {
        background-color: #dc3545;
        color: #fff;
    }
    .badge-success {
        background-color: #28a745;
        color: #fff;
    }
    .badge-warning {
        background-color: #ffc107;
        color: #000;
    }
</style>

<section class="content-header">
    <h1 class="pull-left">Emergency Alerts</h1>
    <h1 class="pull-right">
        <a class="btn btn-primary pull-right" style="margin-top: -10px; margin-bottom: 5px" 
           href="{{ route('emergencyalerts.create') }}">Add New</a>
    </h1>
</section>

<div class="table-responsive mt-4">
    <table class="table table-bordered table-striped">
        <thead class="thead-dark">
            <tr>
                <th>Resident</th>
                <th>Alert Type</th>
                <th>Urgency</th>
                <th>Details</th>
                <th>Triggered By</th>
                <th>Alert Time</th>
                <th>Status</th>
                <th>Resolved By</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            @foreach($emergencyalerts as $alert)
                <tr>
                    <td>{{ $alert->resident->firstname ?? 'N/A' }}</td>
                    <td>{{ $alert->alerttype }}</td>
                    <td>{{ $alert->urgency }}</td>
                    <td>{{ $alert->details }}</td>
                    <td>{{ $alert->triggeredBy->firstname ?? 'N/A' }}</td>
                    <td>{{ $alert->alerttimestamp }}</td>
                    
                    <!-- Status with styled badge -->
                    <td>
                        @if ($alert->status === 'Resolved')
                            <span class="badge badge-success">Resolved</span>
                        @elseif ($alert->status === 'In Progress')
                            <span class="badge badge-warning text-dark">In Progress</span>
                        @else
                            <span class="badge badge-danger">Pending</span>
                        @endif
                    </td>

                    <td>{{ $alert->resolvedBy->firstname ?? 'N/A' }}</td>

                    <td>
                        <a href="{{ route('emergencyalerts.edit', $alert->id) }}" class="btn btn-warning btn-sm">Edit</a>
                        <form action="{{ route('emergencyalerts.destroy', $alert->id) }}" method="POST" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
