@extends('layouts.app')

@section('content')
    <section class="content-header">
        <h1 class="pull-left">Emergency Alerts</h1>
        <h1 class="pull-right">
            <a class="btn btn-primary" style="margin-top: -10px; margin-bottom: 5px" href="{!! route('emergencyalerts.create') !!}">Add New</a>
            <a class="btn btn-danger" style="margin-top: -10px; margin-bottom: 5px" href="{!! route('emergencyalerts.create') !!}">Log Emergency Alert</a>
        </h1>
    </section>
    
    <div class="content">
        <div class="clearfix"></div>

        @include('flash::message')

        <div class="clearfix"></div>
        <div class="box box-primary">
            <div class="box-body">
                @include('emergencyalerts.table')
            </div>
        </div>
    </div>
@endsection
