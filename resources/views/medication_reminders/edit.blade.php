@extends('layouts.app')

@section('content')
    <section class="content-header">
        <h1>
            medication_reminders
        </h1>
    </section>
    <div class="content">
       @include('basic-template::common.errors')
       <div class="box box-primary">
           <div class="box-body">
               <div class="row">
                   {!! Form::model($medicationReminders, ['route' => ['medicationReminders.update', $medicationReminders->id], 'method' => 'patch']) !!}

                        @include('medicationReminders.fields')

                   {!! Form::close() !!}
               </div>
           </div>
       </div>
    </div>
@endsection