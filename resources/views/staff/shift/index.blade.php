@extends('layouts.app') 

@section('content')
<div class="container">
    <h2>My Schedule</h2>

    @if($shifts->isEmpty())
        <p>You have no scheduled shifts.</p>
    @else
        <ul>
            @foreach($shifts as $shift)
                <li>
                    {{ $shift->shift_date }} | {{ $shift->start_time }} - {{ $shift->end_time }} ({{ $shift->shift_type ?? 'General' }})
                </li>
            @endforeach
        </ul>
    @endif
</div>
@endsection
