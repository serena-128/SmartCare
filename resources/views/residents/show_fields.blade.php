<!-- Firstname Field -->
<div class="form-group">
    {!! Form::label('firstname', 'Firstname:') !!}
    <p>{!! $resident->firstname !!}</p>
</div>

<!-- Lastname Field -->
<div class="form-group">
    {!! Form::label('lastname', 'Lastname:') !!}
    <p>{!! $resident->lastname !!}</p>
</div>

<!-- Dateofbirth Field -->
<div class="form-group">
    {!! Form::label('dateofbirth', 'Dateofbirth:') !!}
    <p>{!! $resident->dateofbirth !!}</p>
</div>

<!-- Gender Field -->
<div class="form-group">
    {!! Form::label('gender', 'Gender:') !!}
    <p>{!! $resident->gender !!}</p>
</div>

<!-- Roomnumber Field -->
<div class="form-group">
    {!! Form::label('roomnumber', 'Roomnumber:') !!}
    <p>{!! $resident->roomnumber !!}</p>
</div>

<!-- Admissiondate Field -->
<div class="form-group">
    {!! Form::label('admissiondate', 'Admissiondate:') !!}
    <p>{!! $resident->admissiondate !!}</p>
</div>

