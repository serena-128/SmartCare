<table class="table table-responsive" id="diagnosistypes-table">
    <thead>
        <th>Name</th>
        <th>Description</th>
        <th colspan="3">Action</th>
    </thead>
    <tbody>
    @foreach($diagnosistypes as $diagnosistype)
        <tr>
            <td>{!! $diagnosistype->name !!}</td>
            <td>{!! $diagnosistype->description !!}</td>
            <td>
                {!! Form::open(['route' => ['diagnosistypes.destroy', $diagnosistype->id], 'method' => 'delete']) !!}
                <div class='btn-group'>
                    <a href="{!! route('diagnosistypes.show', [$diagnosistype->id]) !!}" class='btn btn-default btn-xs'><i class="far fa-eye"></i></i></a>
                    <a href="{!! route('diagnosistypes.edit', [$diagnosistype->id]) !!}" class='btn btn-default btn-xs'><i class="far fa-edit"></i></i></a>
                    {!! Form::button('<i class="far fa-trash-alt"></i></i>', ['type' => 'submit', 'class' => 'btn btn-danger btn-xs', 'onclick' => "return confirm('Are you sure?')"]) !!}
                </div>
                {!! Form::close() !!}
            </td>
        </tr>
    @endforeach
    </tbody>
</table>