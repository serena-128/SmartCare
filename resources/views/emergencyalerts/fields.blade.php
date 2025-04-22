<!-- Residentid Field -->
<div class="form-group">
    {!! Form::label('residentid', 'Resident') !!}
    {!! Form::select('residentid', $residents, null, ['class' => 'form-control']) !!}
</div>

<div class="form-group">
    {!! Form::label('alerttype', 'Alert Type') !!}
    {!! Form::text('alerttype', null, ['class' => 'form-control']) !!}
</div>

<div class="form-group">
    {!! Form::label('alerttimestamp', 'Timestamp') !!}
    {!! Form::date('alerttimestamp', \Carbon\Carbon::parse($emergencyalert->alerttimestamp)->format('Y-m-d'), ['class' => 'form-control']) !!}
</div>

<div class="form-group">
    {!! Form::label('status', 'Status') !!}
    {!! Form::select('status', ['Pending' => 'Pending', 'Resolved' => 'Resolved'], null, ['class' => 'form-control']) !!}
</div>

<div class="form-group">
    {!! Form::label('resolvedbyid', 'Resolved By') !!}
    {!! Form::number('resolvedbyid', null, ['class' => 'form-control']) !!}
</div>

<!-- Submit Button -->
<div class="form-group text-right">
    {!! Form::submit('Update Alert', ['class' => 'btn btn-primary']) !!}
</div>