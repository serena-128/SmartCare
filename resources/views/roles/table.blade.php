<table class="table table-responsive" id="roles-table">
    <thead>
        <th>Firstname</th>
        <th>Lastname</th>
        <th>Roletype</th>
        <th>Contactnumber</th>
        <th>Email</th>
        <th>Employmentstartdate</th>
        <th colspan="3">Action</th>
    </thead>
    <tbody>
    @foreach($roles as $role)
        <tr>
            <td>{!! $role->firstname !!}</td>
            <td>{!! $role->lastname !!}</td>
            <td>{!! $role->roletype !!}</td>
            <td>{!! $role->contactnumber !!}</td>
            <td>{!! $role->email !!}</td>
            <td>{!! $role->employmentstartdate !!}</td>
            <td>
                {!! Form::open(['route' => ['roles.destroy', $role->id], 'method' => 'delete']) !!}
                <div class='btn-group'>
                    <a href="{!! route('roles.show', [$role->id]) !!}" class='btn btn-default btn-xs'><i class="far fa-eye"></i></i></a>
                    <a href="{!! route('roles.edit', [$role->id]) !!}" class='btn btn-default btn-xs'><i class="far fa-edit"></i></i></a>
                    {!! Form::button('<i class="far fa-trash-alt"></i></i>', ['type' => 'submit', 'class' => 'btn btn-danger btn-xs', 'onclick' => "return confirm('Are you sure?')"]) !!}
                </div>
                {!! Form::close() !!}
            </td>
        </tr>
    @endforeach
    </tbody>
</table>