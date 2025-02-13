@extends('layouts.app')

@section('content')
    <section class="content-header">
        <h1>
            emergencyalert
        </h1>
    </section>
    <div class="content">
       @include('basic-template::common.errors')
       <div class="box box-primary">
           <div class="box-body">
               <div class="row">
                   {!! Form::model($emergencyalert, ['route' => ['emergencyalerts.update', $emergencyalert->id], 'method' => 'patch']) !!}

                        @include('emergencyalerts.fields')

                   {!! Form::close() !!}
               </div>
           </div>
       </div>
    </div>
@endsection