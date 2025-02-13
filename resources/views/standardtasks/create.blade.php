@extends('layouts.app')

@section('content')
    <section class="content-header">
        <h1>
            standardtask
        </h1>
    </section>
    <div class="content">
        @include('basic-template::common.errors')
        <div class="box box-primary">

            <div class="box-body">
                <div class="row">
                    {!! Form::open(['route' => 'standardtasks.store']) !!}

                        @include('standardtasks.fields')

                    {!! Form::close() !!}
                </div>
            </div>
        </div>
    </div>
@endsection
