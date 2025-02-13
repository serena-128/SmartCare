<!-- Residentid Field -->
<div class="form-group col-sm-6">
    {!! Form::label('residentid', 'Residentid:') !!}
    {!! Form::number('residentid', null, ['class' => 'form-control']) !!}
</div>

<!-- Name Field -->
<div class="form-group col-sm-6">
    {!! Form::label('name', 'Name:') !!}
    {!! Form::text('name', null, ['class' => 'form-control']) !!}
</div>

<!-- Dosage Field -->
<div class="form-group col-sm-6">
    {!! Form::label('dosage', 'Dosage:') !!}
    {!! Form::text('dosage', null, ['class' => 'form-control']) !!}
</div>

<!-- Frequency Field -->
<div class="form-group col-sm-6">
    {!! Form::label('frequency', 'Frequency:') !!}
    {!! Form::text('frequency', null, ['class' => 'form-control']) !!}
</div>

<!-- Startdate Field -->
<div class="form-group col-sm-6">
    {!! Form::label('startdate', 'Startdate:') !!}
    {!! Form::date('startdate', null, ['class' => 'form-control']) !!}
</div>

<!-- Enddate Field -->
<div class="form-group col-sm-6">
    {!! Form::label('enddate', 'Enddate:') !!}
    {!! Form::date('enddate', null, ['class' => 'form-control']) !!}
</div>

<!-- Prescribedby Field -->
<div class="form-group col-sm-6">
    {!! Form::label('prescribedby', 'Prescribedby:') !!}
    {!! Form::number('prescribedby', null, ['class' => 'form-control']) !!}
</div>

<!-- Notes Field -->
<div class="form-group col-sm-6">
    {!! Form::label('notes', 'Notes:') !!}
    {!! Form::text('notes', null, ['class' => 'form-control']) !!}
</div>

<!-- Submit Field -->
<div class="form-group col-sm-12">
    {!! Form::submit('Save', ['class' => 'btn btn-primary']) !!}
    <a href="{!! route('doses.index') !!}" class="btn btn-default">Cancel</a>
</div>
