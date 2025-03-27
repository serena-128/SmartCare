<table class="table table-responsive" id="dietaryrestrictions-table">
    <thead>
        <th>Residentid</th>
        <th>Foodrestrictions</th>
        <th>Foodpreferences</th>
        <th>Allergies</th>
        <th>Notes</th>
        <th>Lastupdatedby</th>
        <th colspan="3">Action</th>
    </thead>
    <tbody>
    @foreach($dietaryrestrictions as $dietaryrestriction)
        <tr>
            <td>{!! $dietaryrestriction->residentid !!}</td>
            <td>{!! $dietaryrestriction->foodrestrictions !!}</td>
            <td>{!! $dietaryrestriction->foodpreferences !!}</td>
            <td>{!! $dietaryrestriction->allergies !!}</td>
            <td>{!! $dietaryrestriction->notes !!}</td>
            <td>{!! $dietaryrestriction->lastupdatedby !!}</td>
            <td>
                {!! Form::open(['route' => ['dietaryrestrictions.destroy', $dietaryrestriction->id], 'method' => 'delete']) !!}
                <div class='btn-group'>
                    <a href="{!! route('dietaryrestrictions.show', [$dietaryrestriction->id]) !!}" class='btn btn-default btn-xs'><i class="far fa-eye"></i></i></a>
                    <a href="{!! route('dietaryrestrictions.edit', [$dietaryrestriction->id]) !!}" class='btn btn-default btn-xs'><i class="far fa-edit"></i></i></a>
                    {!! Form::button('<i class="far fa-trash-alt"></i></i>', ['type' => 'submit', 'class' => 'btn btn-danger btn-xs', 'onclick' => "return confirm('Are you sure?')"]) !!}
                </div>
                {!! Form::close() !!}
            </td>
        </tr>
    @endforeach
    </tbody>
</table>