<!-- Assignedto Field -->
<div class="form-group col-sm-6">
    {!! Form::label('assignedto', 'Assignedto:') !!}
    {!! Form::number('assignedto', null, ['class' => 'form-control']) !!}
</div>

<!-- Description Field -->
<div class="form-group col-sm-6">
    {!! Form::label('description', 'Description:') !!}
    {!! Form::text('description', null, ['class' => 'form-control']) !!}
</div>

<!-- Duedate Field -->
<div class="form-group col-sm-6">
    {!! Form::label('duedate', 'Duedate:') !!}
    {!! Form::date('duedate', null, ['class' => 'form-control']) !!}
</div>

<!-- Prioritylevel Field -->
<div class="form-group col-sm-6">
    {!! Form::label('prioritylevel', 'Prioritylevel:') !!}
    {!! Form::text('prioritylevel', null, ['class' => 'form-control']) !!}
</div>

<!-- Completedby Field -->
<div class="form-group col-sm-6">
    {!! Form::label('completedby', 'Completedby:') !!}
    {!! Form::number('completedby', null, ['class' => 'form-control']) !!}
</div>

<!-- Completiondatetime Field -->
<div class="form-group col-sm-6">
    {!! Form::label('completiondatetime', 'Completiondatetime:') !!}
    {!! Form::date('completiondatetime', null, ['class' => 'form-control']) !!}
</div>

<!-- Submit Field -->
<div class="form-group col-sm-12">
    {!! Form::submit('Save', ['class' => 'btn btn-primary']) !!}
    <a href="{!! route('standardtasks.index') !!}" class="btn btn-default">Cancel</a>
</div>
