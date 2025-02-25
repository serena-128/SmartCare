@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Role Management</h2>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <form action="{{ route('roles.store') }}" method="POST">
        @csrf
        <input type="text" name="name" placeholder="New Role Name" required class="form-control">
        <button type="submit" class="btn btn-primary mt-2">Add Role</button>
    </form>

    <table class="table mt-4">
        <thead>
            <tr>
                <th>Role Name</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach($roles as $role)
                <tr>
                    <td>{{ $role->name }}</td>
                    <td>
                        <form action="{{ route('roles.destroy', $role->id) }}" method="POST">
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
