<!-- Firstname Field -->
<div class="form-group col-sm-6">
    {!! Form::label('firstname', 'Firstname:') !!}
    {!! Form::text('firstname', null, ['class' => 'form-control']) !!}
</div>

<!-- Lastname Field -->
<div class="form-group col-sm-6">
    {!! Form::label('lastname', 'Lastname:') !!}
    {!! Form::text('lastname', null, ['class' => 'form-control']) !!}
</div>

<!-- Roletype Field -->
<div class="form-group col-sm-6">
    {!! Form::label('roletype', 'Roletype:') !!}
    {!! Form::text('roletype', null, ['class' => 'form-control']) !!}
</div>

<!-- Contactnumber Field -->
<div class="form-group col-sm-6">
    {!! Form::label('contactnumber', 'Contactnumber:') !!}
    {!! Form::text('contactnumber', null, ['class' => 'form-control']) !!}
</div>

<!-- Email Field -->
<div class="form-group col-sm-6">
    {!! Form::label('email', 'Email:') !!}
    {!! Form::email('email', null, ['class' => 'form-control']) !!}
</div>

<!-- Employmentstartdate Field -->
<div class="form-group col-sm-6">
    {!! Form::label('employmentstartdate', 'Employmentstartdate:') !!}
    {!! Form::date('employmentstartdate', null, ['class' => 'form-control']) !!}
</div>

<!-- Submit Field -->
<div class="form-group col-sm-12">
    {!! Form::submit('Save', ['class' => 'btn btn-primary']) !!}
    <a href="{!! route('roles.index') !!}" class="btn btn-default">Cancel</a>
</div>
