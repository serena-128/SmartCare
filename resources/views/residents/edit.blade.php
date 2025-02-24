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
<div class="form-group">
    <label for="medical_history">Medical History:</label>
    <textarea name="medical_history" class="form-control">{{ old('medical_history', $resident->medical_history ?? '') }}</textarea>
</div>

<div class="form-group">
    <label for="allergies">Allergies:</label>
    <textarea name="allergies" class="form-control">{{ old('allergies', $resident->allergies ?? '') }}</textarea>
</div>

<div class="form-group">
    <label for="medications">Medications:</label>
    <textarea name="medications" class="form-control">{{ old('medications', $resident->medications ?? '') }}</textarea>
</div>

<div class="form-group">
    <label for="doctor_notes">Doctor's Notes:</label>
    <textarea name="doctor_notes" class="form-control">{{ old('doctor_notes', $resident->doctor_notes ?? '') }}</textarea>
</div>

@endsection