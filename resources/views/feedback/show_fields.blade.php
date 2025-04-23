<!-- Staff Id Field -->
<div class="form-group">
    {!! Form::label('staff_id', 'Staff Id:') !!}
    <p>{!! $feedback->staff_id !!}</p>
</div>

<!-- Category Field -->
<div class="form-group">
    {!! Form::label('category', 'Category:') !!}
    <p>{!! $feedback->category !!}</p>
</div>

<!-- Subject Field -->
<div class="form-group">
    {!! Form::label('subject', 'Subject:') !!}
    <p>{!! $feedback->subject !!}</p>
</div>

<!-- Message Field -->
<div class="form-group">
    {!! Form::label('message', 'Message:') !!}
    <p>{!! $feedback->message !!}</p>
</div>

<!-- Rating Field -->
<div class="form-group">
    {!! Form::label('rating', 'Rating:') !!}
    <p>{!! $feedback->rating !!}</p>
</div>

<!-- Attachment Field -->
<div class="form-group">
    {!! Form::label('attachment', 'Attachment:') !!}
    <p>{!! $feedback->attachment !!}</p>
</div>

<!-- Is Anonymous Field -->
<div class="form-group">
    {!! Form::label('is_anonymous', 'Is Anonymous:') !!}
    <p>{!! $feedback->is_anonymous !!}</p>
</div>

