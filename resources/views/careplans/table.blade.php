<table class="table table-responsive" id="careplans-table">
    <thead>
        <th>Residentid</th>
        <th>Roleid</th>
        <th>Caregoals</th>
        <th>Caretreatment</th>
        <th>Notes</th>
        <th colspan="3">Action</th>
    </thead>
    <tbody>
    @foreach($careplans as $careplan)
        <tr>
            <td>{!! $careplan->residentid !!}</td>
            <td>{!! $careplan->roleid !!}</td>
            <td>{!! $careplan->caregoals !!}</td>
            <td>{!! $careplan->caretreatment !!}</td>
            <td>{!! $careplan->notes !!}</td>
            <td>
                {!! Form::open(['route' => ['careplans.destroy', $careplan->id], 'method' => 'delete']) !!}
                <div class='btn-group'>
                    <a href="{!! route('careplans.show', [$careplan->id]) !!}" class='btn btn-default btn-xs'><i class="far fa-eye"></i></i></a>
                    <a href="{!! route('careplans.edit', [$careplan->id]) !!}" class='btn btn-default btn-xs'><i class="far fa-edit"></i></i></a>
                    {!! Form::button('<i class="far fa-trash-alt"></i></i>', ['type' => 'submit', 'class' => 'btn btn-danger btn-xs', 'onclick' => "return confirm('Are you sure?')"]) !!}
                </div>
                {!! Form::close() !!}
            </td>
        </tr>
    @endforeach
    </tbody>
</table>