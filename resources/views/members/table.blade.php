<table class="table table-responsive" id="members-table">
    <thead>
        <th>Residentid</th>
        <th>Roleid</th>
        <th>Medical History</th>
        <th>Medications</th>
        <th>Dietary Preferences</th>
        <th>Caregoals</th>
        <th>Caretreatment</th>
        <th>Notes</th>
        <th colspan="3">Action</th>
    </thead>
    <tbody>
    @foreach($members as $member)
        <tr>
            <td>{!! $member->residentid !!}</td>
            <td>{!! $member->roleid !!}</td>
            <td>{!! $member->medical_history !!}</td>
            <td>{!! $member->medications !!}</td>
            <td>{!! $member->dietary_preferences !!}</td>
            <td>{!! $member->caregoals !!}</td>
            <td>{!! $member->caretreatment !!}</td>
            <td>{!! $member->notes !!}</td>
            <td>
                {!! Form::open(['route' => ['members.destroy', $member->id], 'method' => 'delete']) !!}
                <div class='btn-group'>
                    <a href="{!! route('members.show', [$member->id]) !!}" class='btn btn-default btn-xs'><i class="far fa-eye"></i></i></a>
                    <a href="{!! route('members.edit', [$member->id]) !!}" class='btn btn-default btn-xs'><i class="far fa-edit"></i></i></a>
                    {!! Form::button('<i class="far fa-trash-alt"></i></i>', ['type' => 'submit', 'class' => 'btn btn-danger btn-xs', 'onclick' => "return confirm('Are you sure?')"]) !!}
                </div>
                {!! Form::close() !!}
            </td>
        </tr>
    @endforeach
    </tbody>
</table>