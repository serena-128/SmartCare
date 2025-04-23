<table class="table table-responsive" id="feedback-table">
    <thead>
        <th>Staff Id</th>
        <th>Category</th>
        <th>Subject</th>
        <th>Message</th>
        <th>Rating</th>
        <th>Attachment</th>
        <th>Is Anonymous</th>
        <th colspan="3">Action</th>
    </thead>
    <tbody>
    @foreach($feedback as $feedback)
        <tr>
            <td>{!! $feedback->staff_id !!}</td>
            <td>{!! $feedback->category !!}</td>
            <td>{!! $feedback->subject !!}</td>
            <td>{!! $feedback->message !!}</td>
            <td>{!! $feedback->rating !!}</td>
            <td>{!! $feedback->attachment !!}</td>
            <td>{!! $feedback->is_anonymous !!}</td>
            <td>
                {!! Form::open(['route' => ['feedback.destroy', $feedback->id], 'method' => 'delete']) !!}
                <div class='btn-group'>
                    <a href="{!! route('feedback.show', [$feedback->id]) !!}" class='btn btn-default btn-xs'><i class="far fa-eye"></i></i></a>
                    <a href="{!! route('feedback.edit', [$feedback->id]) !!}" class='btn btn-default btn-xs'><i class="far fa-edit"></i></i></a>
                    {!! Form::button('<i class="far fa-trash-alt"></i></i>', ['type' => 'submit', 'class' => 'btn btn-danger btn-xs', 'onclick' => "return confirm('Are you sure?')"]) !!}
                </div>
                {!! Form::close() !!}
            </td>
        </tr>
    @endforeach
    </tbody>
</table>