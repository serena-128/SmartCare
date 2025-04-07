<!-- Residentid Field -->
<div class="form-group col-sm-6">
    {!! Form::label('residentid', 'Residentid:') !!}
    {!! Form::number('residentid', null, ['class' => 'form-control']) !!}
</div>

<!-- Triggeredbyid Field -->
<div class="form-group col-sm-6">
    {!! Form::label('triggeredbyid', 'Triggeredbyid:') !!}
    {!! Form::number('triggeredbyid', null, ['class' => 'form-control']) !!}
</div>

<!-- Alerttype Field -->
<div class="form-group col-sm-6">
    {!! Form::label('alerttype', 'Alerttype:') !!}
    {!! Form::text('alerttype', null, ['class' => 'form-control']) !!}
</div>

<!-- Alerttimestamp Field -->
<div class="form-group col-sm-6">
    {!! Form::label('alerttimestamp', 'Alerttimestamp:') !!}
    {!! Form::date('alerttimestamp', null, ['class' => 'form-control']) !!}
</div>

<!-- Status Field -->
<div class="form-group col-sm-6">
    {!! Form::label('status', 'Status:') !!}
    {!! Form::text('status', null, ['class' => 'form-control']) !!}
</div>

<!-- Resolvedbyid Field -->
<div class="form-group col-sm-6">
    {!! Form::label('resolvedbyid', 'Resolvedbyid:') !!}
    {!! Form::number('resolvedbyid', null, ['class' => 'form-control']) !!}
</div>

<!-- Submit Field -->
<div class="form-group col-sm-12">
    {!! Form::submit('Save', ['class' => 'btn btn-primary']) !!}
    <a href="{!! route('emergencyalerts.index') !!}" class="btn btn-default">Cancel</a>
</div>
