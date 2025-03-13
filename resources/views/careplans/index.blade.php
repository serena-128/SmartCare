@extends('layouts.app')

@section('content')
<div class="container mt-5">
    <h2 class="text-center">Care Plans</h2>
    
    <!-- Add New Care Plan Button -->
    <a href="{{ route('careplans.create') }}" class="btn btn-primary mb-3">Add New</a>

    <div class="table-responsive">
        <table class="table table-bordered table-striped">
            <thead class="thead-dark">
                <tr>
                    <th>Resident Name</th>
                    <th>Room Number</th>
                    <th>Staff Member</th>
                    <th>Staff Role</th>
                    <th>Care Goals</th>
                    <th>Care Treatment</th>
                    <th>Notes</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach($careplans as $careplan)
                    <tr>
                        <td>{{ $careplan->resident->firstname }} {{ $careplan->resident->lastname }}</td>
                        <td>{{ $careplan->resident->roomnumber }}</td>
                        <td>{{ $careplan->staffmember->firstname }} {{ $careplan->staffmember->lastname }}</td>
                        <td>{{ $careplan->staffmember->staff_role }}</td>
                        <td>{{ $careplan->caregoals }}</td>
                        <td>{{ $careplan->caretreatment }}</td>
                        <td>{{ $careplan->notes }}</td>
                        <td>
                            <a href="{{ route('careplans.show', $careplan->id) }}" class="btn btn-info btn-sm">
                                <i class="fas fa-eye"></i>
                            </a>
                            <a href="{{ route('careplans.edit', $careplan->id) }}" class="btn btn-warning btn-sm">
                                <i class="fas fa-edit"></i>
                            </a>
                            <form action="{{ route('careplans.destroy', $careplan->id) }}" method="POST" class="d-inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-sm">
                                    <i class="fas fa-trash"></i>
                                </button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection
