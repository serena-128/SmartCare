@extends('layouts.app')

@section('content')
    <section class="content-header">
        <h1 class="pull-left">Emergency Alerts</h1>
        <h1 class="pull-right">
           <a class="btn btn-primary pull-right" style="margin-top: -10px;margin-bottom: 5px" 
              href="{!! route('emergencyalerts.create') !!}">Add New</a>
        </h1>
    </section>

    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Resident</th>
                <th>Alert Type</th>
                <th>Triggered By</th>
                <th>Alert Time</th>
                <th>Status</th>
                <th>Resolved By</th>
                <th>Last Updated At</th> <!-- New Column -->
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            @foreach($emergencyalerts as $alert)
                <tr>
                    <td>{{ $alert->resident->firstname ?? 'N/A' }}</td>
                    <td>{{ $alert->alerttype }}</td>
                    <td>{{ $alert->triggeredBy->firstname ?? 'N/A' }}</td>
                    <td>{{ $alert->alerttimestamp }}</td>
                    <td>{{ $alert->status }}</td>
                    <td>{{ $alert->resolvedBy->firstname ?? 'N/A' }}</td>
                    <td>{{ $alert->last_updated_at }}</td> <!-- Show Last Updated Time -->
                    <td>
                        <a href="{{ route('emergencyalerts.edit', $alert->id) }}" class="btn btn-warning">Edit</a>
                        <form action="{{ route('emergencyalerts.destroy', $alert->id) }}" method="POST" style="display:inline;">
                            @csrf @method('DELETE')
                            <button type="submit" class="btn btn-danger">Delete</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>

@endsection
