@extends('layouts.app')

@section('content')
<div class="container mt-4">
    <div class="text-center mb-4">
        <h2 class="fw-bold text-primary">📝 Assign Task to Staff</h2>
        <p class="text-muted">Fill in the task details below and assign it to a team member.</p>
    </div>

    @include('basic-template::common.errors')

    <div class="card shadow-sm border-0">
        <div class="card-body p-4">
            {!! Form::open(['route' => 'stafftasks.store']) !!}

            <div class="row g-3">
                <!-- Staff Member -->
                <div class="col-md-6">
                    {!! Form::label('staff_id', '👤 Staff Member', ['class' => 'form-label fw-semibold']) !!}
                    {!! Form::select('staff_id', $staffMembers, null, ['class' => 'form-select', 'placeholder' => 'Select Staff']) !!}
                </div>

                <!-- Date -->
                <div class="col-md-3">
                    {!! Form::label('date', '📅 Date', ['class' => 'form-label fw-semibold']) !!}
                    {!! Form::date('date', \Carbon\Carbon::now(), ['class' => 'form-control']) !!}
                </div>

                <!-- Time -->
                <div class="col-md-3">
                    {!! Form::label('time', '⏰ Time', ['class' => 'form-label fw-semibold']) !!}
                    {!! Form::time('time', \Carbon\Carbon::now()->format('H:i'), ['class' => 'form-control']) !!}
                </div>

                <!-- Description -->
                <div class="col-12">
                    {!! Form::label('description', '📝 Task Description', ['class' => 'form-label fw-semibold']) !!}
                    {!! Form::textarea('description', null, ['class' => 'form-control', 'rows' => 4, 'placeholder' => 'Describe the task clearly...']) !!}
                </div>

                <!-- Actions -->
                <div class="col-12 text-end mt-3">
                    {!! Form::submit('✅ Save Task', ['class' => 'btn btn-success me-2']) !!}
                    <a href="{{ route('stafftasks.index') }}" class="btn btn-outline-secondary">Cancel</a>
                </div>
            </div>

            {!! Form::close() !!}
        </div>
    </div>
</div>
@endsection
