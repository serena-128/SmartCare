<table class="table table-responsive" id="nextofkins-table">
    <thead>
        <th>Residentid</th>
        <th>Firstname</th>
        <th>Lastname</th>
        <th>Relationshiptoresident</th>
        <th>Contactnumber</th>
        <th>Email</th>
        <th>Address</th>
        <th colspan="3">Action</th>
    </thead>
    <tbody>
    @foreach($nextofkins as $nextofkin)
        <tr>
            <td>{!! $nextofkin->residentid !!}</td>
            <td>{!! $nextofkin->firstname !!}</td>
            <td>{!! $nextofkin->lastname !!}</td>
            <td>{!! $nextofkin->relationshiptoresident !!}</td>
            <td>{!! $nextofkin->contactnumber !!}</td>
            <td>{!! $nextofkin->email !!}</td>
            <td>{!! $nextofkin->address !!}</td>
            <td>
                {!! Form::open(['route' => ['nextofkins.destroy', $nextofkin->id], 'method' => 'delete']) !!}
                <div class='btn-group'>
                    <a href="{!! route('nextofkins.show', [$nextofkin->id]) !!}" class='btn btn-default btn-xs'><i class="far fa-eye"></i></i></a>
                    <a href="{!! route('nextofkins.edit', [$nextofkin->id]) !!}" class='btn btn-default btn-xs'><i class="far fa-edit"></i></i></a>
                    {!! Form::button('<i class="far fa-trash-alt"></i></i>', ['type' => 'submit', 'class' => 'btn btn-danger btn-xs', 'onclick' => "return confirm('Are you sure?')"]) !!}
                </div>
                {!! Form::close() !!}
            </td>
        </tr>
    @endforeach
    </tbody>
</table>