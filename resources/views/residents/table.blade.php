<table class="table table-responsive" id="residents-table">
    <thead>
        <th>Firstname</th>
        <th>Lastname</th>
        <th>Dateofbirth</th>
        <th>Gender</th>
        <th>Roomnumber</th>
        <th>Admissiondate</th>
        <th colspan="3">Action</th>
    </thead>
    <tbody>
    @foreach($residents as $resident)
        <tr>
            <td>{!! $resident->firstname !!}</td>
            <td>{!! $resident->lastname !!}</td>
            <td>{!! $resident->dateofbirth !!}</td>
            <td>{!! $resident->gender !!}</td>
            <td>{!! $resident->roomnumber !!}</td>
            <td>{!! $resident->admissiondate !!}</td>
            <td>
                {!! Form::open(['route' => ['residents.destroy', $resident->id], 'method' => 'delete']) !!}
                <div class='btn-group'>
                    <a href="{!! route('residents.show', [$resident->id]) !!}" class='btn btn-default btn-xs'><i class="far fa-eye"></i></i></a>
                    <a href="{!! route('residents.edit', [$resident->id]) !!}" class='btn btn-default btn-xs'><i class="far fa-edit"></i></i></a>
                    {!! Form::button('<i class="far fa-trash-alt"></i></i>', ['type' => 'submit', 'class' => 'btn btn-danger btn-xs', 'onclick' => "return confirm('Are you sure?')"]) !!}
                </div>
                {!! Form::close() !!}
            </td>
        </tr>
    @endforeach
    </tbody>
</table>