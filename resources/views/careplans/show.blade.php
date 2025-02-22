@extends('layouts.app')

@section('content')
    <section class="content-header">
        <h1>Care Plan</h1>
    </section>

    <div class="content">
        <div class="box box-primary">
            <div class="box-body">
                <div class="row" style="padding-left: 20px">
                    @include('careplans.show_fields')
                    <a href="{!! route('careplans.index') !!}" class="btn btn-default">Back</a>

                    @can('update', $carePlan)
                        <a href="{{ route('care-plans.edit', $carePlan->id) }}" class="btn btn-warning">Edit Care Plan</a>
                    @endcan
                </div>
            </div>
        </div>
    </div>
@endsection
