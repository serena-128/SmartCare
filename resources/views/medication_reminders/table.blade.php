<table class="table table-responsive" id="medicationReminders-table">
    <thead>
        <th>Resident Id</th>
        <th>Staffmember Id</th>
        <th>Medication Name</th>
        <th>Dosage</th>
        <th>Frequency</th>
        <th>Time For Administration</th>
        <th colspan="3">Action</th>
    </thead>
    <tbody>
    @foreach($medicationReminders as $medicationReminders)
        <tr>
            <td>{!! $medicationReminders->resident_id !!}</td>
            <td>{!! $medicationReminders->staffmember_id !!}</td>
            <td>{!! $medicationReminders->medication_name !!}</td>
            <td>{!! $medicationReminders->dosage !!}</td>
            <td>{!! $medicationReminders->frequency !!}</td>
            <td>{!! $medicationReminders->time_for_administration !!}</td>
            <td>
                {!! Form::open(['route' => ['medicationReminders.destroy', $medicationReminders->id], 'method' => 'delete']) !!}
                <div class='btn-group'>
                    <a href="{!! route('medicationReminders.show', [$medicationReminders->id]) !!}" class='btn btn-default btn-xs'><i class="far fa-eye"></i></i></a>
                    <a href="{!! route('medicationReminders.edit', [$medicationReminders->id]) !!}" class='btn btn-default btn-xs'><i class="far fa-edit"></i></i></a>
                    {!! Form::button('<i class="far fa-trash-alt"></i></i>', ['type' => 'submit', 'class' => 'btn btn-danger btn-xs', 'onclick' => "return confirm('Are you sure?')"]) !!}
                </div>
                {!! Form::close() !!}
            </td>
        </tr>
    @endforeach
    </tbody>
</table>