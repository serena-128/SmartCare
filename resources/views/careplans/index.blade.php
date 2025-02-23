@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Care Plans</h2>

    @can('create', App\Models\CarePlan::class)
        <a href="{{ route('careplans.create') }}" class="btn btn-primary mb-3">New Care Plan</a>
    @endcan

    @forelse($carePlans as $plan)
        <div class="card mb-2">
            <div class="card-body">
                <p>{{ $plan->plan_details }}</p>

                @can('update', $plan)
                    <a href="{{ route('careplans.edit', $plan->id) }}" class="btn btn-warning">Edit</a> <!-- Updated route name -->
                @endcan
            </div>
        </div>
    @empty
        <p>No care plans available.</p>
    @endforelse
</div>
@endsection
