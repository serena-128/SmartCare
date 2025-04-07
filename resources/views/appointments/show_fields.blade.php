<!-- Residentid Field -->
<div class="form-group">
    {!! Form::label('residentid', 'Residentid:') !!}
    <p>{!! $appointment->residentid !!}</p>
</div>

<!-- Staffmemberid Field -->
<div class="form-group">
    {!! Form::label('staffmemberid', 'Staffmemberid:') !!}
    <p>{!! $appointment->staffmemberid !!}</p>
</div>

<!-- Date Field -->
<div class="form-group">
    {!! Form::label('date', 'Date:') !!}
    <p>{!! $appointment->date !!}</p>
</div>

<!-- Time Field -->
<div class="form-group">
    {!! Form::label('time', 'Time:') !!}
    <p>{!! $appointment->time !!}</p>
</div>

<!-- Reason Field -->
<div class="form-group">
    {!! Form::label('reason', 'Reason:') !!}
    <p>{!! $appointment->reason !!}</p>
</div>

<!-- Location Field -->
<div class="form-group">
    {!! Form::label('location', 'Location:') !!}
    <p>{!! $appointment->location !!}</p>
</div>

