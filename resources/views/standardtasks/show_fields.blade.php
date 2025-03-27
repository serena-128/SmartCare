<!-- Assignedto Field -->
<div class="form-group">
    {!! Form::label('assignedto', 'Assignedto:') !!}
    <p>{!! $standardtask->assignedto !!}</p>
</div>

<!-- Description Field -->
<div class="form-group">
    {!! Form::label('description', 'Description:') !!}
    <p>{!! $standardtask->description !!}</p>
</div>

<!-- Duedate Field -->
<div class="form-group">
    {!! Form::label('duedate', 'Duedate:') !!}
    <p>{!! $standardtask->duedate !!}</p>
</div>

<!-- Prioritylevel Field -->
<div class="form-group">
    {!! Form::label('prioritylevel', 'Prioritylevel:') !!}
    <p>{!! $standardtask->prioritylevel !!}</p>
</div>

<!-- Completedby Field -->
<div class="form-group">
    {!! Form::label('completedby', 'Completedby:') !!}
    <p>{!! $standardtask->completedby !!}</p>
</div>

<!-- Completiondatetime Field -->
<div class="form-group">
    {!! Form::label('completiondatetime', 'Completiondatetime:') !!}
    <p>{!! $standardtask->completiondatetime !!}</p>
</div>

