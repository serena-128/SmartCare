@extends('layouts.app')

@section('content')
<style>
    html, body {
        height: 100%;
        margin: 0;
        background-color: #f2eaff;
    }

    .page-wrapper {
        display: flex;
        flex-direction: column;
        min-height: 100vh;
    }

    .content {
        flex: 1;
        padding: 40px 0;
        text-align: center;
    }

    .search-box {
        background: white;
        padding: 30px;
        border-radius: 12px;
        box-shadow: 0 4px 12px rgba(0,0,0,0.1);
        max-width: 600px;
        margin: auto;
    }

    .search-box input {
        margin-bottom: 15px;
    }

    footer {
        background: #fff;
        padding: 15px;
        text-align: center;
        border-top: 1px solid #ccc;
    }
</style>

<div class="page-wrapper">
    <div class="container content">
        <h2 class="mb-4 text-purple">🔍 Search Resident</h2>
        <div class="search-box">
            <form method="GET" action="{{ route('residents.searchResults') }}">
                <div class="form-group">
                    <input type="text" name="query" class="form-control" placeholder="Enter name, room number or date of birth (YYYY-MM-DD)" required>
                </div>
                <button type="submit" class="btn btn-primary mt-2">Search</button>
            </form>
        </div>

        @if(isset($results))
            <div class="mt-4">
                <h5>Search Results:</h5>
                @if(count($results) > 0)
                    <table class="table table-bordered mt-3">
                        <thead>
                            <tr>
                                <th>First Name</th>
                                <th>Last Name</th>
                                <th>Room Number</th>
                                <th>Date of Birth</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($results as $resident)
                                <tr>
                                    <td>{{ $resident->firstname }}</td>
                                    <td>{{ $resident->lastname }}</td>
                                    <td>{{ $resident->roomnumber }}</td>
                                    <td>{{ \Carbon\Carbon::parse($resident->dateofbirth)->format('d M Y') }}</td>
                                    <td><a href="{{ route('residents.show', $resident->id) }}" class="btn btn-info btn-sm">View</a></td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                @else
                    <p class="text-muted">No matching residents found.</p>
                @endif
            </div>
        @endif
    </div>

</div>
@endsection
