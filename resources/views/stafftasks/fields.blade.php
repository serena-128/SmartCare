<!-- Staffmemberid Field -->
<div class="form-group col-sm-6">
    {!! Form::label('staffmemberid', 'Staffmemberid:') !!}
    {!! Form::number('staffmemberid', null, ['class' => 'form-control']) !!}
</div>

<!-- Taskid Field -->
<div class="form-group col-sm-6">
    {!! Form::label('taskid', 'Taskid:') !!}
    {!! Form::number('taskid', null, ['class' => 'form-control']) !!}
</div>

<!-- Roleintask Field -->
<div class="form-group col-sm-6">
    {!! Form::label('roleintask', 'Roleintask:') !!}
    {!! Form::text('roleintask', null, ['class' => 'form-control']) !!}
</div>

<!-- Startdate Field -->
<div class="form-group col-sm-6">
    {!! Form::label('startdate', 'Startdate:') !!}
    {!! Form::date('startdate', null, ['class' => 'form-control']) !!}
</div>

<!-- Enddate Field -->
<div class="form-group col-sm-6">
    {!! Form::label('enddate', 'Enddate:') !!}
    {!! Form::date('enddate', null, ['class' => 'form-control']) !!}
</div>

<!-- Submit Field -->
<div class="form-group col-sm-12">
    {!! Form::submit('Save', ['class' => 'btn btn-primary']) !!}
    <a href="{!! route('stafftasks.index') !!}" class="btn btn-default">Cancel</a>
</div>
