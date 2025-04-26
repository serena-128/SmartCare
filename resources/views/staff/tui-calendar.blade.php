@extends('layouts.app')

@section('content')
<div class="container mt-4">
    <h2 class="text-center text-primary mb-4">📅 My Appointment Calendar</h2>
    <div id="calendar" style="height: 800px;"></div>
</div>
@endsection

@push('styles')
<link rel="stylesheet" href="https://uicdn.toast.com/calendar/latest/toastui-calendar.min.css" />
@endpush

@push('js_scripts')
<script src="https://uicdn.toast.com/calendar/latest/toastui-calendar.min.js"></script>
<script>
    document.addEventListener('DOMContentLoaded', function () {
        const calendar = new toastui.Calendar('#calendar', {
            defaultView: 'month',
            usageStatistics: false,
            template: {
                time: function(schedule) {
                    return schedule.title;
                }
            }
        });

        // Add events dynamically (replace with your actual data)
        calendar.createEvents(@json($appointments));
    });
</script>
@endpush
