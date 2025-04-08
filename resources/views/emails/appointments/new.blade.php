@component('mail::message')
# New Appointment Scheduled

A new appointment has been scheduled for your resident **{{ $appointment->resident->name }}**:

**{{ $appointment->title }}**

@component('mail::button', ['url' => route('appointments.show', $appointment->id)])
View Appointment
@endcomponent

Thanks,<br>
{{ config('app.name') }}
@endcomponent
