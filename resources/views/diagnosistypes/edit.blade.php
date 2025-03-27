@extends('layouts.app')

@section('content')
    <section class="content-header">
        <h1>
            diagnosistype
        </h1>
    </section>
    <div class="content">
       @include('basic-template::common.errors')
       <div class="box box-primary">
           <div class="box-body">
               <div class="row">
                   {!! Form::model($diagnosistype, ['route' => ['diagnosistypes.update', $diagnosistype->id], 'method' => 'patch']) !!}

                        @include('diagnosistypes.fields')

                   {!! Form::close() !!}
               </div>
           </div>
       </div>
    </div>
@endsection