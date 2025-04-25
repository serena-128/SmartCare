@extends('layouts.app')

@section('content')
    <section class="content-header">
    <div class="d-flex align-items-center mb-4">
    <span style="font-size: 2rem; margin-right: 10px;">📩</span>
    <h2 class="mb-0 fw-bold">Feedback</h2>
</div>

    </section>
    <div class="content">
        @include('basic-template::common.errors')
        <div class="box box-primary">

            <div class="box-body">
                <div class="row">
                {!! Form::open(['route' => 'feedback.store', 'files' => true]) !!}

                    {!! Form::open(['route' => 'feedback.store']) !!}

                        @include('feedback.fields')

                    {!! Form::close() !!}
                </div>
            </div>
        </div>
    </div>
@endsection
