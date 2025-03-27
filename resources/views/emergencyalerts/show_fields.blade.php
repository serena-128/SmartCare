<!-- Residentid Field -->
<div class="form-group">
    {!! Form::label('residentid', 'Residentid:') !!}
    <p>{!! $emergencyalert->residentid !!}</p>
</div>

<!-- Triggeredbyid Field -->
<div class="form-group">
    {!! Form::label('triggeredbyid', 'Triggeredbyid:') !!}
    <p>{!! $emergencyalert->triggeredbyid !!}</p>
</div>

<!-- Alerttype Field -->
<div class="form-group">
    {!! Form::label('alerttype', 'Alerttype:') !!}
    <p>{!! $emergencyalert->alerttype !!}</p>
</div>

<!-- Alerttimestamp Field -->
<div class="form-group">
    {!! Form::label('alerttimestamp', 'Alerttimestamp:') !!}
    <p>{!! $emergencyalert->alerttimestamp !!}</p>
</div>

<!-- Status Field -->
<div class="form-group">
    {!! Form::label('status', 'Status:') !!}
    <p>{!! $emergencyalert->status !!}</p>
</div>

<!-- Resolvedbyid Field -->
<div class="form-group">
    {!! Form::label('resolvedbyid', 'Resolvedbyid:') !!}
    <p>{!! $emergencyalert->resolvedbyid !!}</p>
</div>

