@extends('layouts.app')

@section('content')
<style>
    body {
        background-color: #f2eaff;
    }
    .careplan-hub {
        text-align: center;
        padding: 50px 0;
    }
    .careplan-hub h2 {
        color: #4b0082;
        font-weight: bold;
        margin-bottom: 40px;
    }
    .kpi-card {
        background: white;
        border-radius: 12px;
        box-shadow: 0 4px 12px rgba(0,0,0,0.1);
        padding: 20px;
        margin-bottom: 30px;
    }
    .feature-card {
        background: white;
        border-radius: 12px;
        box-shadow: 0 4px 12px rgba(0,0,0,0.1);
        padding: 30px 20px;
        margin-bottom: 30px;
        transition: transform 0.2s ease-in-out;
        height: 100%;
    }
    .feature-card:hover {
        transform: translateY(-5px);
    }
    .feature-card img {
        max-width: 80px;
        margin-bottom: 15px;
    }
    .feature-card h5 {
        font-weight: bold;
        color: #4b0082;
    }
    .feature-card p {
        font-size: 14px;
        color: #555;
        min-height: 50px;
    }
    .bg-purple {
        background-color: #6a1b9a;
    }
</style>

<div class="container careplan-hub">
    <h2>Care Plan Management Hub</h2>

    <!-- KPIs -->
    <div class="row text-center mb-5">
        <div class="col-md-4">
            <div class="kpi-card">
                <h6 class="text-muted">Total Care Plans</h6>
                <h4 class="text-purple">{{ $totalCarePlans }}</h4>
            </div>
        </div>
        <div class="col-md-4">
            <div class="kpi-card">
                <h6 class="text-muted">Active Plans</h6>
                <h4 class="text-success">{{ $activePlans }}</h4>
            </div>
        </div>
        <div class="col-md-4">
            <div class="kpi-card">
                <h6 class="text-muted">Completed</h6>
                <h4 class="text-danger">{{ $completedPlans }}</h4>
            </div>
        </div>
    </div>

    <!-- Action Cards -->
    <div class="row justify-content-center">
        <div class="col-md-4 d-flex">
            <div class="feature-card w-100">
                <img src="{{ asset('pictures/careplan_list.png') }}" alt="All Care Plans">
                <h5>View Care Plans</h5>
                <p>See all resident care plans in detail.</p>
                <a href="{{ route('careplans.index') }}" class="btn btn-outline-primary">View</a>
            </div>
        </div>
        <div class="col-md-4 d-flex">
            <div class="feature-card w-100">
                <img src="{{ asset('pictures/careplan_add.png') }}" alt="Add Care Plan">
                <h5>Add New Care Plan</h5>
                <p>Create a personalized plan for a resident.</p>
                <a href="{{ route('careplans.create') }}" class="btn btn-outline-success">Add</a>
            </div>
        </div>
    </div>

    <!-- Recently Updated -->
    <div class="row mt-5">
        <div class="col-12">
            <div class="card shadow">
                <div class="card-header bg-purple text-white">
                    <h5 class="mb-0">🕒 Recently Updated Care Plans</h5>
                </div>
                <div class="card-body">
                    @if($recentCarePlans->count() > 0)
                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    <th>Resident</th>
                                    <th>Staff Member</th>
                                    <th>Status</th>
                                    <th>Last Updated</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($recentCarePlans as $plan)
                                    <tr>
                                        <td>{{ $plan->resident->firstname }} {{ $plan->resident->lastname }}</td>
                                        <td>{{ $plan->staffmember->firstname }} {{ $plan->staffmember->lastname }}</td>
                                        <td>
                                            <span class="badge {{ $plan->status == 'active' ? 'bg-success' : 'bg-secondary' }}">
                                                {{ ucfirst($plan->status) }}
                                            </span>
                                        </td>
                                        <td>{{ \Carbon\Carbon::parse($plan->updated_at)->diffForHumans() }}</td>
                                        <td>
                                            <a href="{{ route('careplans.show', $plan->id) }}" class="btn btn-sm btn-info">View</a>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    @else
                        <p class="text-muted">No care plans updated recently.</p>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
