@extends('layouts.app')

@section('content')
<div class="container mt-5">
    <!-- SmartCare Logo -->
    <div class="text-center">
        <img src="{{ asset('images/carehome_logo.png') }}" alt="SmartCare Logo" style="max-width: 200px;">
    </div>

    <h2 class="text-center text-purple mt-3">Resident Care Plan</h2>

    <div class="card shadow-lg border-0">
        <div class="card-body bg-light-purple p-4">
            <div class="row">
                <!-- Resident Picture -->
                <div class="col-md-4 text-center">
                    <img src="{{ asset('images/John_Doe.png') }}" alt="Resident Photo"
                        class="rounded-circle shadow" style="max-width: 150px;">
                    <h4 class="mt-3">{{ $careplan->resident->firstname }} {{ $careplan->resident->lastname }}</h4>
                    <p class="text-muted">Room: {{ $careplan->resident->roomnumber }}</p>
                </div>

                <!-- Care Plan Details -->
                <div class="col-md-8">
                    <table class="table table-bordered">
                        <tbody>
                            <tr>
                                <th class="bg-secondary text-white">Assigned Staff</th>
                                <td>{{ $careplan->staffMember->firstname }} {{ $careplan->staffMember->lastname }} - 
                                    <strong>{{ $careplan->staffMember->staff_role }}</strong>
                                </td>
                            </tr>
                            <tr>
                                <th class="bg-secondary text-white">Care Goals</th>
                                <td>{{ $careplan->caregoals }}</td>
                            </tr>
                            <tr>
                                <th class="bg-secondary text-white">Care Treatment</th>
                                <td>{{ $careplan->caretreatment }}</td>
                            </tr>
                            <tr>
                                <th class="bg-secondary text-white">Notes</th>
                                <td>{{ $careplan->notes }}</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>

            <!-- Back Button -->
            <div class="text-center mt-4">
                <a href="{{ route('careplans.index') }}" class="btn btn-secondary btn-lg">⬅ Back to Care Plans</a>
            </div>
        </div>
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
