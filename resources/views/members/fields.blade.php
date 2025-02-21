<!-- Residentid Field -->
<div class="form-group col-sm-6">
    {!! Form::label('residentid', 'Residentid:') !!}
    {!! Form::number('residentid', null, ['class' => 'form-control']) !!}
</div>

<!-- Roleid Field -->
<div class="form-group col-sm-6">
    {!! Form::label('roleid', 'Roleid:') !!}
    {!! Form::number('roleid', null, ['class' => 'form-control']) !!}
</div>

<!-- Medical History Field -->
<div class="form-group col-sm-12 col-lg-12">
    {!! Form::label('medical_history', 'Medical History:') !!}
    {!! Form::textarea('medical_history', null, ['class' => 'form-control']) !!}
</div>

<!-- Medications Field -->
<div class="form-group col-sm-12 col-lg-12">
    {!! Form::label('medications', 'Medications:') !!}
    {!! Form::textarea('medications', null, ['class' => 'form-control']) !!}
</div>

<!-- Dietary Preferences Field -->
<div class="form-group col-sm-12 col-lg-12">
    {!! Form::label('dietary_preferences', 'Dietary Preferences:') !!}
    {!! Form::textarea('dietary_preferences', null, ['class' => 'form-control']) !!}
</div>

<!-- Caregoals Field -->
<div class="form-group col-sm-12 col-lg-12">
    {!! Form::label('caregoals', 'Caregoals:') !!}
    {!! Form::textarea('caregoals', null, ['class' => 'form-control']) !!}
</div>

<!-- Caretreatment Field -->
<div class="form-group col-sm-12 col-lg-12">
    {!! Form::label('caretreatment', 'Caretreatment:') !!}
    {!! Form::textarea('caretreatment', null, ['class' => 'form-control']) !!}
</div>

<!-- Notes Field -->
<div class="form-group col-sm-12 col-lg-12">
    {!! Form::label('notes', 'Notes:') !!}
    {!! Form::textarea('notes', null, ['class' => 'form-control']) !!}
</div>

<!-- Submit Field -->
<div class="form-group col-sm-12">
    {!! Form::submit('Save', ['class' => 'btn btn-primary']) !!}
    <a href="{!! route('members.index') !!}" class="btn btn-default">Cancel</a>
</div>
