@extends('layouts.app')

@section('content')
    <section class="content-header">
        <h1>
            Assign Task to Staff
        </h1>
    </section>
    <div class="content">
        @include('basic-template::common.errors')
        <div class="box box-primary">
            <div class="box-body">
                <div class="row">
                    {!! Form::open(['route' => 'stafftasks.store']) !!}

                    <!-- Staff Name Dropdown -->
                    <div class="form-group col-sm-6">
                        {!! Form::label('staff_id', 'Staff Member:') !!}
                       {!! Form::select('staff_id', $staffMembers, null, ['class' => 'form-control', 'placeholder' => 'Select Staff']) !!}

                    </div>

                    <!-- Date -->
                    <div class="form-group col-sm-6">
                        {!! Form::label('date', 'Date:') !!}
                        {!! Form::date('date', \Carbon\Carbon::now(), ['class' => 'form-control']) !!}
                    </div>

                    <!-- Time -->
                    <div class="form-group col-sm-6">
                        {!! Form::label('time', 'Time:') !!}
                        {!! Form::time('time', \Carbon\Carbon::now()->format('H:i'), ['class' => 'form-control']) !!}
                    </div>

                    <!-- Description -->
                    <div class="form-group col-sm-12">
                        {!! Form::label('description', 'Task Description:') !!}
                        {!! Form::textarea('description', null, ['class' => 'form-control', 'rows' => 4]) !!}
                    </div>

                    <!-- Submit -->
                    <div class="form-group col-sm-12">
                        {!! Form::submit('Save Task', ['class' => 'btn btn-primary']) !!}
                        <a href="{{ route('stafftasks.index') }}" class="btn btn-default">Cancel</a>
                    </div>

                    {!! Form::close() !!}
                </div>
            </div>
        </div>
    </div>
@endsection
