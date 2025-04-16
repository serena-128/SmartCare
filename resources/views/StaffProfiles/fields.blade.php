<!-- User Id Field (Hidden) -->
<input type="hidden" name="user_id" value="{{ auth()->id() }}">

<!-- Firstname Field -->
<div class="form-group col-sm-6">
    {!! Form::label('firstname', 'Firstname:') !!}
    {!! Form::text('firstname', old('firstname', auth()->user()->name ?? ''), ['class' => 'form-control']) !!}
</div>

<!-- Lastname Field -->
<div class="form-group col-sm-6">
    {!! Form::label('lastname', 'Lastname:') !!}
    {!! Form::text('lastname', old('lastname'), ['class' => 'form-control']) !!}
</div>

<!-- Email Field -->
<div class="form-group col-sm-6">
    {!! Form::label('email', 'Email:') !!}
    {!! Form::email('email', old('email', auth()->user()->email ?? ''), ['class' => 'form-control']) !!}
</div>

<!-- Phone Field -->
<div class="form-group col-sm-6">
    {!! Form::label('phone', 'Phone:') !!}
    {!! Form::text('phone', old('phone'), ['class' => 'form-control']) !!}
</div>

<!-- Staff Role Field -->
<div class="form-group col-sm-6">
    {!! Form::label('staff_role', 'Staff Role:') !!}
    {!! Form::text('staff_role', old('staff_role'), ['class' => 'form-control']) !!}
</div>

<!-- Profile Picture Field -->
<div class="form-group col-sm-6">
    {!! Form::label('profile_picture', 'Profile Picture:') !!}
    {!! Form::file('profile_picture', ['class' => 'form-control']) !!}
</div>

<!-- Bio Field -->
<div class="form-group col-sm-12 col-lg-12">
    {!! Form::label('bio', 'Bio:') !!}
    {!! Form::textarea('bio', old('bio'), ['class' => 'form-control']) !!}
</div>

<!-- Submit Field -->
<div class="form-group col-sm-12">
    {!! Form::submit('Save', ['class' => 'btn btn-primary']) !!}
    <a href="{!! route('staffProfiles.index') !!}" class="btn btn-default">Cancel</a>
</div>
