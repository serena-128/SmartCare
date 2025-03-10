<table class="table table-responsive" id="schedules-table">
    <thead>
        <th>Roleid</th>
        <th>Staffmemberid</th>
        <th>Shiftdate</th>
        <th>Starttime</th>
        <th>Endtime</th>
        <th>Shifttype</th>
        <th>Requested Shift Id</th>
        <th>Shift Status</th>
        <th>Request Reason</th>
        <th>Approved By</th>
        <th colspan="3">Action</th>
    </thead>
    <tbody>
    @foreach($schedules as $schedule)
        <tr>
            <td>{!! $schedule->roleid !!}</td>
            <td>{!! $schedule->staffmemberid !!}</td>
            <td>{!! $schedule->shiftdate !!}</td>
            <td>{!! $schedule->starttime !!}</td>
            <td>{!! $schedule->endtime !!}</td>
            <td>{!! $schedule->shifttype !!}</td>
            <td>{!! $schedule->requested_shift_id !!}</td>
            <td>{!! $schedule->shift_status !!}</td>
            <td>{!! $schedule->request_reason !!}</td>
            <td>{!! $schedule->approved_by !!}</td>
            <td>
                {!! Form::open(['route' => ['schedules.destroy', $schedule->id], 'method' => 'delete']) !!}
                <div class='btn-group'>
                    <a href="{!! route('schedules.show', [$schedule->id]) !!}" class='btn btn-default btn-xs'><i class="far fa-eye"></i></i></a>
                    <a href="{!! route('schedules.edit', [$schedule->id]) !!}" class='btn btn-default btn-xs'><i class="far fa-edit"></i></i></a>
                    {!! Form::button('<i class="far fa-trash-alt"></i></i>', ['type' => 'submit', 'class' => 'btn btn-danger btn-xs', 'onclick' => "return confirm('Are you sure?')"]) !!}
                </div>
                {!! Form::close() !!}
            </td>
        </tr>
    @endforeach
    </tbody>
</table>