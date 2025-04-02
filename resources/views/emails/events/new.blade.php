@component('mail::message')
Hello,

We're excited to let you know about a new event at SmartCare:

**Event:** {{ $event->title }}

@if(isset($event->date))
**Date:** {{ \Carbon\Carbon::parse($event->date)->format('F j, Y, g:i a') }}
@endif

For more details, please click the button below.

@component('mail::button', ['url' => route('events.show', $event->id)])
View Event Details
@endcomponent

Thank you for being part of SmartCare.

Best regards,  
The SmartCare Team
@endcomponent
