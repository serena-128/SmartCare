<!-- Roleid Field -->
<div class="form-group col-sm-6">
    {!! Form::label('roleid', 'Roleid:') !!}
    {!! Form::number('roleid', null, ['class' => 'form-control']) !!}
</div>

<!-- Staffmemberid Field -->
<div class="form-group col-sm-6">
    {!! Form::label('staffmemberid', 'Staffmemberid:') !!}
    {!! Form::number('staffmemberid', null, ['class' => 'form-control']) !!}
</div>

<!-- Shiftdate Field -->
<div class="form-group col-sm-6">
    {!! Form::label('shiftdate', 'Shiftdate:') !!}
    {!! Form::date('shiftdate', null, ['class' => 'form-control']) !!}
</div>

<!-- Starttime Field -->
<div class="form-group col-sm-6">
    {!! Form::label('starttime', 'Starttime:') !!}
    {!! Form::text('starttime', null, ['class' => 'form-control']) !!}
</div>

<!-- Endtime Field -->
<div class="form-group col-sm-6">
    {!! Form::label('endtime', 'Endtime:') !!}
    {!! Form::text('endtime', null, ['class' => 'form-control']) !!}
</div>

<!-- Shifttype Field -->
<div class="form-group col-sm-6">
    {!! Form::label('shifttype', 'Shifttype:') !!}
    {!! Form::text('shifttype', null, ['class' => 'form-control']) !!}
</div>

<!-- Requested Shift Id Field -->
<div class="form-group col-sm-6">
    {!! Form::label('requested_shift_id', 'Requested Shift Id:') !!}
    {!! Form::number('requested_shift_id', null, ['class' => 'form-control']) !!}
</div>

<!-- Shift Status Field -->
<div class="form-group col-sm-6">
    {!! Form::label('shift_status', 'Shift Status:') !!}
    {!! Form::text('shift_status', null, ['class' => 'form-control']) !!}
</div>

<!-- Request Reason Field -->
<div class="form-group col-sm-12 col-lg-12">
    {!! Form::label('request_reason', 'Request Reason:') !!}
    {!! Form::textarea('request_reason', null, ['class' => 'form-control']) !!}
</div>

<!-- Approved By Field -->
<div class="form-group col-sm-6">
    {!! Form::label('approved_by', 'Approved By:') !!}
    {!! Form::number('approved_by', null, ['class' => 'form-control']) !!}
</div>

<!-- Submit Field -->
<div class="form-group col-sm-12">
    {!! Form::submit('Save', ['class' => 'btn btn-primary']) !!}
    <a href="{!! route('schedules.index') !!}" class="btn btn-default">Cancel</a>
</div>
