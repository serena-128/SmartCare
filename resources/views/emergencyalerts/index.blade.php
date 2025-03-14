@extends('layouts.app')

@section('content')
    <section class="content-header">
        <h1 class="pull-left">emergencyalerts</h1>
        <h1 class="pull-right">
           <a class="btn btn-primary pull-right" style="margin-top: -10px;margin-bottom: 5px" href="{!! route('emergencyalerts.create') !!}">Add New</a>
        </h1>
    </section>
<table class="table table-bordered">
    <thead>
        <tr>
            <th>Resident</th>
            <th>Triggered By</th>
            <th>Alert Type</th>
            <th>Alert Timestamp</th>
            <th>Status</th>
            <th>Resolved By</th>
            <th>Action</th>
        </tr>
    </thead>
    <tbody>
        @foreach($alerts as $alert)
            <tr>
                <td>{{ $alert->resident->firstname ?? 'Unknown' }} {{ $alert->resident->lastname ?? '' }}</td>
                <td>{{ $alert->triggeredBy->firstname ?? 'Unknown' }} {{ $alert->triggeredBy->lastname ?? '' }}</td>
                <td>{{ $alert->alerttype }}</td>
                <td>{{ $alert->alerttimestamp }}</td>
                <td>
                    <span class="badge 
                        @if($alert->status == 'Resolved') bg-success
                        @elseif($alert->status == 'In Progress') bg-warning
                        @else bg-danger @endif">
                        {{ $alert->status }}
                    </span>
                </td>
                <td>{{ $alert->resolvedBy->firstname ?? 'Pending' }} {{ $alert->resolvedBy->lastname ?? '' }}</td>
                <td>
                    <a href="{{ route('emergencyalerts.show', $alert->id) }}" class="btn btn-info btn-sm">
                        <i class="fas fa-eye"></i>
                    </a>
                    <a href="{{ route('emergencyalerts.edit', $alert->id) }}" class="btn btn-warning btn-sm">
                        <i class="fas fa-edit"></i>
                    </a>
                    <form action="{{ route('emergencyalerts.destroy', $alert->id) }}" method="POST" style="display:inline;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure?')">
                            <i class="fas fa-trash"></i>
                        </button>
                    </form>
                </td>
            </tr>
        @endforeach
    </tbody>
</table>

@endsection

