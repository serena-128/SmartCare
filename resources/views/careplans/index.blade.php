@extends('layouts.app')

@section('content')
<div class="container mt-4">
    <h2 class="text-center text-purple mb-4">📝 Resident Care Plans</h2>

    <div class="mb-3 text-end">
        <a href="{{ route('careplans.create') }}" class="btn btn-success btn-sm">➕ Add New Care Plan</a>
    </div>

    <!-- Filter Dropdown -->
    <form method="GET" action="{{ route('careplans.index') }}" class="mb-3">
        <div class="row justify-content-end">
            <div class="col-md-4">
                <select name="status" class="form-select form-select-sm" onchange="this.form.submit()">
                    <option value="">Filter by Status</option>
                    <option value="Active" {{ request('status') == 'Active' ? 'selected' : '' }}>Active</option>
                    <option value="Completed" {{ request('status') == 'Completed' ? 'selected' : '' }}>Completed</option>
                    <option value="Inactive" {{ request('status') == 'Inactive' ? 'selected' : '' }}>Inactive</option>
                </select>
            </div>
        </div>
    </form>

    @forelse($careplans as $plan)
        <div class="card mb-4 shadow-sm border-0 bg-light-purple">
            <div class="card-body">
                <h5 class="text-purple mb-2">
                    {{ $plan->resident->firstname }} {{ $plan->resident->lastname }} 
                    <small class="text-muted">(Room: {{ $plan->resident->roomnumber }})</small>
                </h5>

                <p><strong>Assigned Staff:</strong> {{ $plan->staffMember->firstname }} {{ $plan->staffMember->lastname }}</p>
                
                <hr>

                <p><strong>Care Goals:</strong> {{ $plan->caregoals }}</p>
                <p><strong>Care Treatment:</strong> {{ $plan->caretreatment }}</p>
                <p><strong>Notes:</strong> {{ $plan->notes }}</p>
                <p><strong>Assessment Summary:</strong> {{ $plan->assessment_summary }}</p>
                <p><strong>Diagnosis:</strong> {{ $plan->diagnosis }}</p>
                <p><strong>Evaluation Notes:</strong> {{ $plan->evaluation_notes }}</p>

                <div class="d-flex justify-content-between align-items-center mt-3">
                    <span class="badge {{ $plan->status === 'Active' ? 'bg-success' : 'bg-secondary' }}">
                        {{ $plan->status }}
                    </span>
                    <div>
                        <a href="{{ route('careplans.edit', $plan->id) }}" class="btn btn-sm btn-outline-warning me-1">Edit</a>
                        <form action="{{ route('careplans.destroy', $plan->id) }}" method="POST" class="d-inline">
                            @csrf @method('DELETE')
                            <button type="submit" class="btn btn-sm btn-outline-danger">Delete</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    @empty
        <p class="text-muted text-center">No care plans found.</p>
    @endforelse
</div>

<style>
    .bg-light-purple {
        background-color: #f6f0fc;
        border-radius: 12px;
    }
    .text-purple {
        color: #6a0dad;
    }
</style>
@endsection
