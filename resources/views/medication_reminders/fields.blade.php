<!-- Resident Id Field -->
<div class="form-group col-sm-6">
    {!! Form::label('resident_id', 'Resident Id:') !!}
    {!! Form::number('resident_id', null, ['class' => 'form-control']) !!}
</div>

<!-- Staffmember Id Field -->
<div class="form-group col-sm-6">
    {!! Form::label('staffmember_id', 'Staffmember Id:') !!}
    {!! Form::number('staffmember_id', null, ['class' => 'form-control']) !!}
</div>

<!-- Medication Name Field -->
<div class="form-group col-sm-6">
    {!! Form::label('medication_name', 'Medication Name:') !!}
    {!! Form::text('medication_name', null, ['class' => 'form-control']) !!}
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

<!-- Time For Administration Field -->
<div class="form-group col-sm-6">
    {!! Form::label('time_for_administration', 'Time For Administration:') !!}
    {!! Form::text('time_for_administration', null, ['class' => 'form-control']) !!}
</div>

<!-- Submit Field -->
<div class="form-group col-sm-12">
    {!! Form::submit('Save', ['class' => 'btn btn-primary']) !!}
    <a href="{!! route('medicationReminders.index') !!}" class="btn btn-default">Cancel</a>
</div>
