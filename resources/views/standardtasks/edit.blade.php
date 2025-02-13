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
                   {!! Form::model($standardtask, ['route' => ['standardtasks.update', $standardtask->id], 'method' => 'patch']) !!}

                        @include('standardtasks.fields')

                   {!! Form::close() !!}
               </div>
           </div>
       </div>
    </div>
@endsection