{!! Form::hidden('schedule_id', $schedule->id ?? '') !!}

<div class="form-group col-sm-6">
    {!! Form::label('shiftdate', 'Current Shift Date:') !!}
    {!! Form::date('shiftdate', $schedule->shiftdate ?? '', ['class' => 'form-control', 'readonly']) !!}
</div>

<div class="form-group col-sm-6">
    {!! Form::label('starttime', 'Current Start Time:') !!}
    {!! Form::time('starttime', $schedule->starttime ?? '', ['class' => 'form-control', 'readonly']) !!}
</div>

<div class="form-group col-sm-6">
    {!! Form::label('endtime', 'Current End Time:') !!}
    {!! Form::time('endtime', $schedule->endtime ?? '', ['class' => 'form-control', 'readonly']) !!}
</div>

<div class="form-group col-sm-6">
    {!! Form::label('shifttype', 'Current Shift Type:') !!}
    {!! Form::text('shifttype', $schedule->shifttype ?? '', ['class' => 'form-control', 'readonly']) !!}
</div>

<div class="form-group col-sm-12">
    {!! Form::label('request_reason', 'Reason for Shift Change:') !!}
    {!! Form::textarea('request_reason', null, ['class' => 'form-control', 'required']) !!}
</div>

<!-- Submit Button -->
<div class="form-group col-sm-12">
    {!! Form::submit('Request Shift Change', ['class' => 'btn btn-primary']) !!}
</div>
