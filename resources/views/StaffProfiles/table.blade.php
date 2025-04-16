<table class="table table-responsive" id="staffProfiles-table">
    <thead>
        <th>User Id</th>
        <th>Firstname</th>
        <th>Lastname</th>
        <th>Email</th>
        <th>Phone</th>
        <th>Staff Role</th>
        <th>Profile Picture</th>
        <th>Bio</th>
        <th colspan="3">Action</th>
    </thead>
    <tbody>
    @foreach($staffProfiles as $staffProfiles)
        <tr>
            <td>{!! $staffProfiles->user_id !!}</td>
            <td>{!! $staffProfiles->firstname !!}</td>
            <td>{!! $staffProfiles->lastname !!}</td>
            <td>{!! $staffProfiles->email !!}</td>
            <td>{!! $staffProfiles->phone !!}</td>
            <td>{!! $staffProfiles->staff_role !!}</td>
            <td>{!! $staffProfiles->profile_picture !!}</td>
            <td>{!! $staffProfiles->bio !!}</td>
            <td>
                {!! Form::open(['route' => ['staffProfiles.destroy', $staffProfiles->id], 'method' => 'delete']) !!}
                <div class='btn-group'>
                    <a href="{!! route('staffProfiles.show', [$staffProfiles->id]) !!}" class='btn btn-default btn-xs'><i class="far fa-eye"></i></i></a>
                    <a href="{!! route('staffProfiles.edit', [$staffProfiles->id]) !!}" class='btn btn-default btn-xs'><i class="far fa-edit"></i></i></a>
                    {!! Form::button('<i class="far fa-trash-alt"></i></i>', ['type' => 'submit', 'class' => 'btn btn-danger btn-xs', 'onclick' => "return confirm('Are you sure?')"]) !!}
                </div>
                {!! Form::close() !!}
            </td>
        </tr>
    @endforeach
    </tbody>
</table>