@extends('layouts.app')

@section('content')
    <section class="content-header">
        <h1>
            resident
        </h1>
    </section>
    <div class="content">
       @include('basic-template::common.errors')
       <div class="box box-primary">
           <div class="box-body">
               <div class="row">
                   {!! Form::model($resident, ['route' => ['residents.update', $resident->id], 'method' => 'patch']) !!}

                        @include('residents.fields')

                   {!! Form::close() !!}
               </div>
           </div>
       </div>
    </div>


@endsection