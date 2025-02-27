@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>{{ $event->name }}</h1>
        <p>{{ $event->description }}</p>
        <p>Event Date: {{ $event->event_date }}</p>

        <form action="{{ route('event.rsvp', $event->id) }}" method="POST">
            @csrf
            <label>
                <input type="checkbox" name="rsvp"> RSVP to this event
            </label>
            <button type="submit" class="btn btn-primary">Submit</button>
        </form>

        @if(session('success'))
            <p>{{ session('success') }}</p>
        @endif
    </div>
@endsection
