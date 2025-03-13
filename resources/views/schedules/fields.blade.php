{!! Form::hidden('schedule_id', $schedule->id ?? '') !!}

<div class="row">
    <div class="form-group col-md-6">
        {!! Form::label('shiftdate', 'Shift Date:', ['class' => 'font-weight-bold']) !!}
        {!! Form::date('shiftdate', $schedule->shiftdate ?? '', ['class' => 'form-control']) !!}
    </div>
    
<div class="form-group col-md-6">
    {!! Form::label('staffmemberid', 'Staff Member:', ['class' => 'font-weight-bold']) !!}
    {!! Form::select('staffmemberid', $staffMembers->pluck('name', 'id') ?? [], null, ['class' => 'form-control', 'required']) !!}
</div>


    <div class="form-group col-md-6">
        {!! Form::label('starttime', 'Start Time:', ['class' => 'font-weight-bold']) !!}
        {!! Form::time('starttime', $schedule->starttime ?? '', ['class' => 'form-control']) !!}
    </div>

    <div class="form-group col-md-6">
        {!! Form::label('endtime', 'End Time:', ['class' => 'font-weight-bold']) !!}
        {!! Form::time('endtime', $schedule->endtime ?? '', ['class' => 'form-control']) !!}
    </div>

    <div class="form-group col-md-6">
        {!! Form::label('shifttype', 'Shift Type:', ['class' => 'font-weight-bold']) !!}
        {!! Form::text('shifttype', $schedule->shifttype ?? '', ['class' => 'form-control']) !!}
    </div>
</div>

<div class="form-group">
    {!! Form::label('request_reason', 'Reason for Shift Change:', ['class' => 'font-weight-bold']) !!}
    {!! Form::textarea('request_reason', null, ['class' => 'form-control', 'rows' => 4, 'required']) !!}
</div>

<!-- Submit Button -->
<div class="text-center mt-3">
    {!! Form::submit('Request Shift Change', ['class' => 'btn btn-primary btn-lg']) !!}
</div>
