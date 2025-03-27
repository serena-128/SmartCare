@extends('layouts.app')

@section('content')
    <section class="content-header">
        <h1>
            diagnosis
        </h1>
    </section>
    <div class="content">
       @include('basic-template::common.errors')
       <div class="box box-primary">
           <div class="box-body">
               <div class="row">
                   {!! Form::model($diagnosis, ['route' => ['diagnoses.update', $diagnosis->id], 'method' => 'patch']) !!}

                        @include('diagnoses.fields')

                   {!! Form::close() !!}
               </div>
           </div>
       </div>
    </div>
@endsection