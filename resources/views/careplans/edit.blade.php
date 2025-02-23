@extends('layouts.app')

@section('content')
    <section class="content-header">
        <h1>Edit Care Plan</h1>
    </section>

    <div class="content">
        @include('basic-template::common.errors')
        <div class="box box-primary">
            <div class="box-body">
                <div class="row">
                    {!! Form::model($carePlan, ['route' => ['careplans.update', $carePlan->id], 'method' => 'patch']) !!}
                        @include('careplans.fields') {{-- Ensure this file exists --}}
                    {!! Form::close() !!}
                </div>
            </div>
        </div>
    </div>

    {{-- Loop through all care plans and display details with Edit button --}}
    <div class="container">
        @foreach($carePlans as $carePlan)
            <div class="card mb-2">
                <div class="card-body">
                    <p>{{ $carePlan->plan_details }}</p>

                    @can('update', $carePlan)
                        <a href="{{ route('careplans.edit', $carePlan->id) }}" class="btn btn-warning">Edit</a>
                    @endcan
                </div>
            </div>
        @endforeach
    </div>
@endsection
