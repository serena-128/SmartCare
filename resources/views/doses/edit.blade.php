@extends('layouts.app')

@section('content')
    <section class="content-header">
        <h1>
            dose
        </h1>
    </section>
    <div class="content">
       @include('basic-template::common.errors')
       <div class="box box-primary">
           <div class="box-body">
               <div class="row">
                   {!! Form::model($dose, ['route' => ['doses.update', $dose->id], 'method' => 'patch']) !!}

                        @include('doses.fields')

                   {!! Form::close() !!}
               </div>
           </div>
       </div>
    </div>
@endsection