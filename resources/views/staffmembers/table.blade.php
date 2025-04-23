<table class="table table-responsive" id="staffMembers-table">
    <thead>
        <th>Supervisor</th>
        <th>First Name</th>
        <th>Last Name</th>
        <th>Staff Role</th>
        <th>Contact Number</th>
        <th>Email</th>
        <th>Start Date</th>
        <th colspan="3">Action</th>
    </thead>
    <tbody>
    @foreach($staffMembers as $staffMember)

        <tr>
        <td>
    {{ optional($staffMember->supervisor)->firstname ?? 'N/A' }}
    {{ optional($staffMember->supervisor)->lastname ?? '' }}
</td>


            <td>{{ $staffMember->firstname }}</td>
            <td>{{ $staffMember->lastname }}</td>
            <td>{{ $staffMember->staff_role }}</td>
            <td>{{ $staffMember->contactnumber }}</td>
            <td>{{ $staffMember->email }}</td>
            <td>{{ \Carbon\Carbon::parse($staffMember->startdate)->format('Y-m-d') }}</td>
            <td>
                {!! Form::open(['route' => ['staffmembers.destroy', $staffMember->id], 'method' => 'delete']) !!}
                <div class='btn-group'>
                    <a href="{{ route('staff.profile.show', $staffMember->id) }}" class='btn btn-default btn-xs'>
                        <i class="far fa-eye"></i>
                    </a>
                    <a href="{{ route('staffmembers.edit', $staffMember->id) }}" class='btn btn-default btn-xs'>
                        <i class="far fa-edit"></i>
                    </a>
                    {!! Form::button('<i class="far fa-trash-alt"></i>', [
                        'type' => 'submit',
                        'class' => 'btn btn-danger btn-xs',
                        'onclick' => "return confirm('Are you sure?')"
                    ]) !!}
                </div>
                {!! Form::close() !!}
            </td>
        </tr>
    @endforeach
    </tbody>
</table>
