<table class="table table-responsive" id="staffmembers-table">
    <thead>
        <th>Reportsto</th>
        <th>Firstname</th>
        <th>Lastname</th>
        <th>Role</th>
        <th>Contactnumber</th>
        <th>Email</th>
        <th>Startdate</th>
        <th colspan="3">Action</th>
    </thead>
    <tbody>
    @foreach($staffmembers as $staffmember)
        <tr>
            <td>{!! $staffmember->reportsto !!}</td>
            <td>{!! $staffmember->firstname !!}</td>
            <td>{!! $staffmember->lastname !!}</td>
            <td>{!! $staffmember->role !!}</td>
            <td>{!! $staffmember->contactnumber !!}</td>
            <td>{!! $staffmember->email !!}</td>
            <td>{!! $staffmember->startdate !!}</td>
            <td>
                {!! Form::open(['route' => ['staffmembers.destroy', $staffmember->id], 'method' => 'delete']) !!}
                <div class='btn-group'>
                    <a href="{!! route('staffmembers.show', [$staffmember->id]) !!}" class='btn btn-default btn-xs'><i class="far fa-eye"></i></i></a>
                    <a href="{!! route('staffmembers.edit', [$staffmember->id]) !!}" class='btn btn-default btn-xs'><i class="far fa-edit"></i></i></a>
                    {!! Form::button('<i class="far fa-trash-alt"></i></i>', ['type' => 'submit', 'class' => 'btn btn-danger btn-xs', 'onclick' => "return confirm('Are you sure?')"]) !!}
                </div>
                {!! Form::close() !!}
            </td>
        </tr>
    @endforeach
    </tbody>
</table>