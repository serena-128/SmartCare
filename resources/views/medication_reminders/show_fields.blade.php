<!-- Resident Id Field -->
<div class="form-group">
    {!! Form::label('resident_id', 'Resident Id:') !!}
    <p>{!! $medicationReminders->resident_id !!}</p>
</div>

<!-- Staffmember Id Field -->
<div class="form-group">
    {!! Form::label('staffmember_id', 'Staffmember Id:') !!}
    <p>{!! $medicationReminders->staffmember_id !!}</p>
</div>

<!-- Medication Name Field -->
<div class="form-group">
    {!! Form::label('medication_name', 'Medication Name:') !!}
    <p>{!! $medicationReminders->medication_name !!}</p>
</div>

<!-- Dosage Field -->
<div class="form-group">
    {!! Form::label('dosage', 'Dosage:') !!}
    <p>{!! $medicationReminders->dosage !!}</p>
</div>

<!-- Frequency Field -->
<div class="form-group">
    {!! Form::label('frequency', 'Frequency:') !!}
    <p>{!! $medicationReminders->frequency !!}</p>
</div>

<!-- Time For Administration Field -->
<div class="form-group">
    {!! Form::label('time_for_administration', 'Time For Administration:') !!}
    <p>{!! $medicationReminders->time_for_administration !!}</p>
</div>

