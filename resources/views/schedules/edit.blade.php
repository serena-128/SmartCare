@extends('layouts.app')

@section('content')
    <section class="content-header">
        <h1>
            schedule
        </h1>
    </section>
    <div class="content">
       @include('basic-template::common.errors')
       <div class="box box-primary">
           <div class="box-body">
               <div class="row">
                   {!! Form::model($schedule, ['route' => ['schedules.update', $schedule->id], 'method' => 'patch']) !!}

                        @include('schedules.fields')

                   {!! Form::close() !!}
               </div>
           </div>
       </div>
    </div>
@endsection