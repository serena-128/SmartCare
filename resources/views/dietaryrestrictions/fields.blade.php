<!-- Residentid Field -->
<div class="form-group col-sm-6">
    {!! Form::label('residentid', 'Residentid:') !!}
    {!! Form::number('residentid', null, ['class' => 'form-control']) !!}
</div>

<!-- Foodrestrictions Field -->
<div class="form-group col-sm-6">
    {!! Form::label('foodrestrictions', 'Foodrestrictions:') !!}
    {!! Form::text('foodrestrictions', null, ['class' => 'form-control']) !!}
</div>

<!-- Foodpreferences Field -->
<div class="form-group col-sm-6">
    {!! Form::label('foodpreferences', 'Foodpreferences:') !!}
    {!! Form::text('foodpreferences', null, ['class' => 'form-control']) !!}
</div>

<!-- Allergies Field -->
<div class="form-group col-sm-6">
    {!! Form::label('allergies', 'Allergies:') !!}
    {!! Form::text('allergies', null, ['class' => 'form-control']) !!}
</div>

<!-- Notes Field -->
<div class="form-group col-sm-6">
    {!! Form::label('notes', 'Notes:') !!}
    {!! Form::text('notes', null, ['class' => 'form-control']) !!}
</div>

<!-- Lastupdatedby Field -->
<div class="form-group col-sm-6">
    {!! Form::label('lastupdatedby', 'Lastupdatedby:') !!}
    {!! Form::number('lastupdatedby', null, ['class' => 'form-control']) !!}
</div>

<!-- Submit Field -->
<div class="form-group col-sm-12">
    {!! Form::submit('Save', ['class' => 'btn btn-primary']) !!}
    <a href="{!! route('dietaryrestrictions.index') !!}" class="btn btn-default">Cancel</a>
</div>
