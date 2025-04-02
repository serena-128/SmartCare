@component('mail::message')
# New Event Added

A new event has been added: **{{ $event->title }}**

@component('mail::button', ['url' => route('events.show', $event->id)])
View Event
@endcomponent

Thanks,<br>
{{ config('app.name') }}
@endcomponent
