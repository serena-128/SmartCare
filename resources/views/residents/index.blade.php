@extends('layouts.app')

@section('content')
<div class="container">
    <!-- Page Header with Logo -->
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div class="d-flex align-items-center">
            <h1 class="h3 text-dark ms-3">🏥 Resident Management</h1>
        </div>
        <a class="btn btn-primary btn-lg shadow-sm" href="{!! route('residents.create') !!}">
            ➕ Add New Resident
        </a>
    </div>

    <!-- Flash Messages -->
    @include('flash::message')

    <!-- Resident List -->
    <div class="card shadow-lg">
        <div class="card-header bg-primary text-white">
            <h5 class="mb-0">👨‍⚕️ All Residents</h5>
        </div>
        <div class="card-body">
            @if($residents->count() > 0)
                <table class="table table-hover table-bordered">
                    <thead class="table-light">
                        <tr class="text-center">
                            <th>👤 Firstname</th>
                            <th>📝 Lastname</th>
                            <th>📅 Date of Birth</th>
                            <th>🚻 Gender</th>
                            <th>🏠 Room Number</th>
                            <th>📅 Admission Date</th>
                            <th>⚙️ Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($residents as $resident)
                            <tr class="text-center">
                                <td>{{ $resident->firstname }}</td>
                                <td>{{ $resident->lastname }}</td>
                                <td>{{ \Carbon\Carbon::parse($resident->dateofbirth)->format('d M Y') }}</td>
                                <td>{{ ucfirst($resident->gender) }}</td>

                                <!-- ✅ FIX: Corrected `room_number` to `roomnumber` -->
                                <td>
                                    @if(isset($resident->roomnumber))
                                        <a href="{{ route('residents.show', $resident->id) }}" class="fw-bold text-primary text-decoration-none">
                                            🏠 {{ $resident->roomnumber }}
                                        </a>
                                    @else
                                        <span class="text-muted">N/A</span>
                                    @endif
                                </td>

                                <td>{{ \Carbon\Carbon::parse($resident->admissiondate)->format('d M Y') }}</td>
                                <td>
                                    <div class="btn-group" role="group">
                                        <!-- View -->
                                        <a href="{{ route('residents.show', $resident->id) }}" class="btn btn-info btn-sm" title="View Resident">
                                            <i class="fas fa-eye"></i>
                                        </a>

                                        <!-- Edit -->
                                        <a href="{{ route('residents.edit', $resident->id) }}" class="btn btn-warning btn-sm" title="Edit Resident">
                                            <i class="fas fa-edit"></i>
                                        </a>

                                        <!-- Delete -->
                                        {!! Form::open(['route' => ['residents.destroy', $resident->id], 'method' => 'delete', 'style' => 'display:inline;']) !!}
                                            {!! Form::button('<i class="fas fa-trash-alt"></i>', [
                                                'type' => 'submit',
                                                'class' => 'btn btn-danger btn-sm',
                                                'title' => 'Delete',
                                                'onclick' => "return confirm('Are you sure you want to delete this resident?')"
                                            ]) !!}
                                        {!! Form::close() !!}
                                    </div>
                                </td>
                            </tr>
                        <td>

                        @endforeach
                    </tbody>
                </table>
            @else
                <p class="text-muted text-center">No residents found.</p>
            @endif
        </div>
    </div>


</div>

<!-- Custom Styles -->
<style>
    .logo {
        max-width: 100px;
        margin-right: 15px;
    }
    .table-hover tbody tr:hover {
        background-color: #f8f9fa;
    }
    .table th, .table td {
        vertical-align: middle;
    }
    .btn-group .btn {
        margin: 2px;
    }
    a.text-primary:hover {
        text-decoration: underline;
    }
</style>

@endsection
