@extends('layouts.app')

@section('content')
    <section class="content-header">
        <h1>
            staff_profiles
        </h1>
    </section>
    <div class="content">
        @include('basic-template::common.errors')
        <div class="box box-primary">

            <div class="box-body">
                <div class="row">
                    {!! Form::open(['route' => 'staffProfiles.store']) !!}

                    @include('staff_profiles.fields')


                    {!! Form::close() !!}
                </div>
            </div>
        </div>
    </div>
@endsection
