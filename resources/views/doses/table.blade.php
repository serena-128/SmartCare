<table class="table table-responsive" id="doses-table">
    <thead>
        <th>Residentid</th>
        <th>Name</th>
        <th>Dosage</th>
        <th>Frequency</th>
        <th>Startdate</th>
        <th>Enddate</th>
        <th>Prescribedby</th>
        <th>Notes</th>
        <th colspan="3">Action</th>
    </thead>
    <tbody>
    @foreach($doses as $dose)
        <tr>
            <td>{!! $dose->residentid !!}</td>
            <td>{!! $dose->name !!}</td>
            <td>{!! $dose->dosage !!}</td>
            <td>{!! $dose->frequency !!}</td>
            <td>{!! $dose->startdate !!}</td>
            <td>{!! $dose->enddate !!}</td>
            <td>{!! $dose->prescribedby !!}</td>
            <td>{!! $dose->notes !!}</td>
            <td>
                {!! Form::open(['route' => ['doses.destroy', $dose->id], 'method' => 'delete']) !!}
                <div class='btn-group'>
                    <a href="{!! route('doses.show', [$dose->id]) !!}" class='btn btn-default btn-xs'><i class="far fa-eye"></i></i></a>
                    <a href="{!! route('doses.edit', [$dose->id]) !!}" class='btn btn-default btn-xs'><i class="far fa-edit"></i></i></a>
                    {!! Form::button('<i class="far fa-trash-alt"></i></i>', ['type' => 'submit', 'class' => 'btn btn-danger btn-xs', 'onclick' => "return confirm('Are you sure?')"]) !!}
                </div>
                {!! Form::close() !!}
            </td>
        </tr>
    @endforeach
    </tbody>
</table>