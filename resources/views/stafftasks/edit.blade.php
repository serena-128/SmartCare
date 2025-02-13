@extends('layouts.app')

@section('content')
    <section class="content-header">
        <h1>
            stafftask
        </h1>
    </section>
    <div class="content">
       @include('basic-template::common.errors')
       <div class="box box-primary">
           <div class="box-body">
               <div class="row">
                   {!! Form::model($stafftask, ['route' => ['stafftasks.update', $stafftask->id], 'method' => 'patch']) !!}

                        @include('stafftasks.fields')

                   {!! Form::close() !!}
               </div>
           </div>
       </div>
    </div>
@endsection