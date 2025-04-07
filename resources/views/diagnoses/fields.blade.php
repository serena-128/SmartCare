<!-- Residentid Field -->
<div class="form-group col-sm-6">
    {!! Form::label('residentid', 'Residentid:') !!}
    {!! Form::number('residentid', null, ['class' => 'form-control']) !!}
</div>

<!-- Diagnosis Field -->
<div class="form-group col-sm-6">
    {!! Form::label('diagnosis', 'Diagnosis:') !!}
    {!! Form::text('diagnosis', null, ['class' => 'form-control']) !!}
</div>

<!-- Vitalsigns Field -->
<div class="form-group col-sm-6">
    {!! Form::label('vitalsigns', 'Vitalsigns:') !!}
    {!! Form::text('vitalsigns', null, ['class' => 'form-control']) !!}
</div>

<!-- Treatment Field -->
<div class="form-group col-sm-6">
    {!! Form::label('treatment', 'Treatment:') !!}
    {!! Form::text('treatment', null, ['class' => 'form-control']) !!}
</div>

<!-- Testresults Field -->
<div class="form-group col-sm-6">
    {!! Form::label('testresults', 'Testresults:') !!}
    {!! Form::text('testresults', null, ['class' => 'form-control']) !!}
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
    <a href="{!! route('diagnoses.index') !!}" class="btn btn-default">Cancel</a>
</div>
