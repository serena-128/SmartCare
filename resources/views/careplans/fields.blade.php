<!-- Residentid Field -->
<div class="form-group col-sm-6">
    {!! Form::label('residentid', 'Residentid:') !!}
    {!! Form::number('residentid', null, ['class' => 'form-control']) !!}
</div>

<!-- Staffmemberid Field -->
<div class="form-group col-sm-6">
    {!! Form::label('staffmemberid', 'Staffmemberid:') !!}
    {!! Form::number('staffmemberid', null, ['class' => 'form-control']) !!}
</div>

<!-- Caregoals Field -->
<div class="form-group col-sm-6">
    {!! Form::label('caregoals', 'Caregoals:') !!}
    {!! Form::text('caregoals', null, ['class' => 'form-control']) !!}
</div>

<!-- Caretreatment Field -->
<div class="form-group col-sm-6">
    {!! Form::label('caretreatment', 'Caretreatment:') !!}
    {!! Form::text('caretreatment', null, ['class' => 'form-control']) !!}
</div>

<!-- Notes Field -->
<div class="form-group col-sm-6">
    {!! Form::label('notes', 'Notes:') !!}
    {!! Form::text('notes', null, ['class' => 'form-control']) !!}
</div>

<!-- Submit Field -->
<div class="form-group col-sm-12">
    {!! Form::submit('Save', ['class' => 'btn btn-primary']) !!}
    <a href="{!! route('careplans.index') !!}" class="btn btn-default">Cancel</a>
</div>
