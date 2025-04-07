<table class="table table-responsive" id="diagnoses-table">
    <thead>
        <th>Residentid</th>
        <th>Diagnosis</th>
        <th>Vitalsigns</th>
        <th>Treatment</th>
        <th>Testresults</th>
        <th>Notes</th>
        <th>Lastupdatedby</th>
        <th colspan="3">Action</th>
    </thead>
    <tbody>
    @foreach($diagnoses as $diagnosis)
        <tr>
            <td>{!! $diagnosis->residentid !!}</td>
            <td>{!! $diagnosis->diagnosis !!}</td>
            <td>{!! $diagnosis->vitalsigns !!}</td>
            <td>{!! $diagnosis->treatment !!}</td>
            <td>{!! $diagnosis->testresults !!}</td>
            <td>{!! $diagnosis->notes !!}</td>
            <td>{!! $diagnosis->lastupdatedby !!}</td>
            <td>
                {!! Form::open(['route' => ['diagnoses.destroy', $diagnosis->id], 'method' => 'delete']) !!}
                <div class='btn-group'>
                    <a href="{!! route('diagnoses.show', [$diagnosis->id]) !!}" class='btn btn-default btn-xs'><i class="far fa-eye"></i></i></a>
                    <a href="{!! route('diagnoses.edit', [$diagnosis->id]) !!}" class='btn btn-default btn-xs'><i class="far fa-edit"></i></i></a>
                    {!! Form::button('<i class="far fa-trash-alt"></i></i>', ['type' => 'submit', 'class' => 'btn btn-danger btn-xs', 'onclick' => "return confirm('Are you sure?')"]) !!}
                </div>
                {!! Form::close() !!}
            </td>
        </tr>
    @endforeach
    </tbody>
</table>