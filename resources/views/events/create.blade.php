<form action="{{ route('event.store') }}" method="POST">
    @csrf
    <label for="title">Event Title:</label>
    <input type="text" name="title" required>

    <label for="event_date">Event Date:</label>
    <input type="date" name="event_date" required>

    <label for="event_time">Event Time:</label>
    <input type="time" name="event_time" required>

    <label for="location">Location:</label>
    <input type="text" name="location" required>

    <label for="description">Description:</label>
    <textarea name="description"></textarea>

    <button type="submit">Add Event</button>
</form>
