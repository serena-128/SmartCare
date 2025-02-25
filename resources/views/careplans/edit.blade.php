@extends('layouts.app')

@section('content')
    <section class="content-header">
        <h1>
            careplan
        </h1>
    </section>
    <div class="content">
       @include('basic-template::common.errors')
       <div class="box box-primary">
           <div class="box-body">
               <div class="row">
                   {!! Form::model($careplan, ['route' => ['careplans.update', $careplan->id], 'method' => 'patch']) !!}

                        @include('careplans.fields')

                   {!! Form::close() !!}
               </div>
           </div>
       </div>
    </div>
@endsection