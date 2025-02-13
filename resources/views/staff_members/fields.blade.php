<!-- Reportsto Field -->
<div class="form-group col-sm-6">
    {!! Form::label('reportsto', 'Reportsto:') !!}
    {!! Form::number('reportsto', null, ['class' => 'form-control']) !!}
</div>

<!-- Firstname Field -->
<div class="form-group col-sm-6">
    {!! Form::label('firstname', 'Firstname:') !!}
    {!! Form::text('firstname', null, ['class' => 'form-control']) !!}
</div>

<!-- Lastname Field -->
<div class="form-group col-sm-6">
    {!! Form::label('lastname', 'Lastname:') !!}
    {!! Form::text('lastname', null, ['class' => 'form-control']) !!}
</div>

<!-- Staff Role Field -->
<div class="form-group col-sm-6">
    {!! Form::label('staff_role', 'Staff Role:') !!}
    {!! Form::text('staff_role', null, ['class' => 'form-control']) !!}
</div>

<!-- Contactnumber Field -->
<div class="form-group col-sm-6">
    {!! Form::label('contactnumber', 'Contactnumber:') !!}
    {!! Form::text('contactnumber', null, ['class' => 'form-control']) !!}
</div>

<!-- Email Field -->
<div class="form-group col-sm-6">
    {!! Form::label('email', 'Email:') !!}
    {!! Form::email('email', null, ['class' => 'form-control']) !!}
</div>

<!-- Startdate Field -->
<div class="form-group col-sm-6">
    {!! Form::label('startdate', 'Startdate:') !!}
    {!! Form::date('startdate', null, ['class' => 'form-control']) !!}
</div>

<!-- Submit Field -->
<div class="form-group col-sm-12">
    {!! Form::submit('Save', ['class' => 'btn btn-primary']) !!}
    <a href="{!! route('staffMembers.index') !!}" class="btn btn-default">Cancel</a>
</div>
