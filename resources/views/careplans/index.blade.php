@extends('layouts.app')

@section('content')
<div class="container mt-5">
    <!-- SmartCare Logo -->
    <div class="text-center">
        <img src="{{ asset('images/carehome_logo.png') }}" alt="SmartCare Logo" style="max-width: 200px;">
    </div>

    <h2 class="text-center text-purple mt-3">Care Plans</h2>

    <div class="d-flex justify-content-between">
        <a href="{{ route('careplans.create') }}" class="btn btn-primary">Add New</a>
    </div>

    <div class="table-responsive mt-3">
        <table class="table table-bordered table-striped shadow-lg">
            <thead class="bg-light-purple">
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
                        <td>{{ $careplan->staffMember->firstname }} {{ $careplan->staffMember->lastname }}</td>
                        <td>{{ $careplan->staffMember->staff_role }}</td>
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

<!-- Light Purple Theme -->
<style>
    .bg-light-purple {
        background-color: #f4e6ff;
        border-radius: 10px;
    }
    .text-purple {
        color: #6a0dad;
    }
</style>
@endsection
