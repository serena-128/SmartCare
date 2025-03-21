@foreach($events as $event)
    <div class="event">
        <h3>{{ $event->title }}</h3>
        <p>{{ $event->event_date }} at {{ $event->event_time }}</p>
        <p>{{ $event->location }}</p>
        <p>{{ $event->description }}</p>

        <form action="{{ route('event.rsvp', $event->id) }}" method="POST">
            @csrf
            <label for="rsvp_status">RSVP:</label>
            <select name="rsvp_status">
                <option value="yes" {{ $event->rsvp_status == 'yes' ? 'selected' : '' }}>Yes</option>
                <option value="no" {{ $event->rsvp_status == 'no' ? 'selected' : '' }}>No</option>
                <option value="maybe" {{ $event->rsvp_status == 'maybe' ? 'selected' : '' }}>Maybe</option>
            </select>
            <button type="submit">RSVP</button>
        </form>
    </div>
@endforeach
