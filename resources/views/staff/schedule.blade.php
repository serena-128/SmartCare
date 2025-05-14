@extends('layouts.app')

@section('content')
<div class="container">
    <h1 class="mb-4 text-center">📅 My Weekly Schedule</h1>

    <!-- WEEK TABS -->
    <ul class="nav nav-tabs justify-content-center mb-4">
        @foreach($weeks as $i => $week)
            <li class="nav-item" role="presentation">
                <button class="nav-link {{ $i == 0 ? 'active' : '' }}" data-bs-toggle="tab" data-bs-target="#week-{{ $i }}">
                    📅 Week of {{ $week['start']->format('d M Y') }}
                </button>
            </li>
        @endforeach
    </ul>

    <!-- TAB CONTENT -->
    <div class="tab-content">
        @foreach($weeks as $i => $week)
            <div class="tab-pane fade {{ $i == 0 ? 'show active' : '' }}" id="week-{{ $i }}">
                @php
                    $days = $week['shifts']->groupBy('shiftdate');
                @endphp

                @foreach($days as $date => $entries)
                    <h5 class="day-title mt-4">{{ \Carbon\Carbon::parse($date)->format('l d F Y') }}</h5>

                    @php
    $shift = $entries->where('shifttype', 'shift')->first();
    $break = $entries->where('shifttype', 'break')->first();
    $lunch = $entries->where('shifttype', 'lunch')->first();

    $hasPendingRequest = false;

    if ($shift) {
        $hasPendingRequest = \App\Models\Schedule::where('staffmemberid', session('staff_id'))
            ->where('shiftdate', $shift->shiftdate)
            ->where('shifttype', 'shift')
            ->where('shift_status', 'unapproved')
            ->whereNotNull('requested_shift_id')
            ->exists();
    }
@endphp


<div class="table-responsive mb-3">
    <table class="table table-bordered shift-table">
        <thead>
            <tr>
                <th>🕒 Start</th>
                <th>☕ Break</th>
                <th>🍴 Lunch</th>
                <th>🕒 End</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td>{{ $shift ? \Carbon\Carbon::parse($shift->starttime)->format('H:i') : '-' }}</td>
                <td>{{ $break ? \Carbon\Carbon::parse($break->starttime)->format('H:i') . '–' . \Carbon\Carbon::parse($break->endtime)->format('H:i') : '-' }}</td>
                <td>{{ $lunch ? \Carbon\Carbon::parse($lunch->starttime)->format('H:i') . '–' . \Carbon\Carbon::parse($lunch->endtime)->format('H:i') : '-' }}</td>
                <td>{{ $shift ? \Carbon\Carbon::parse($shift->endtime)->format('H:i') : '-' }}</td>
            </tr>
        </tbody>
    </table>
</div>

<div class="text-center mb-4">
    @if($hasPendingRequest)
        <button class="btn btn-warning" disabled>⏳ In Progress</button>
    @else
        <button class="btn btn-outline-primary" onclick="openShiftChangeModal('{{ $date }}')">
            📝 Request Shift Change
        </button>
    @endif
</div>


                @endforeach
            </div>
        @endforeach
    </div>
</div>

<!-- Modal -->
<div class="modal fade" id="shiftChangeModal" tabindex="-1" aria-labelledby="shiftChangeModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <form id="shiftChangeForm">
            @csrf
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Request Shift Change</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <input type="hidden" id="currentShiftDate" name="currentShiftDate">
                    <div class="mb-3">
                        <label for="requestedShiftId" class="form-label">Select New Shift</label>
                        <select class="form-select" id="requestedShiftId" name="requestedShiftId" required>
                            <option value="">Loading available shifts...</option>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="requestReason" class="form-label">Reason for Change</label>
                        <textarea class="form-control" id="requestReason" name="requestReason" rows="3" required></textarea>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary">Submit Request</button>
                </div>
            </div>
        </form>
    </div>
</div>
@endsection

@push('scripts')
<script>
function openShiftChangeModal(date) {
    document.getElementById('currentShiftDate').value = date;

    fetch(`/staff/available-shifts?date=${date}`)
        .then(response => response.json())
        .then(data => {
            let select = document.getElementById('requestedShiftId');
            select.innerHTML = '';
            if (data.length === 0) {
                select.innerHTML = '<option value="">No available shifts</option>';
            } else {
                select.innerHTML = '<option value="">-- Select Shift --</option>';
                data.forEach(function(shift) {
                    select.innerHTML += `<option value="${shift.id}">${shift.date} (${shift.start} - ${shift.end})</option>`;
                });
            }
        });

    new bootstrap.Modal(document.getElementById('shiftChangeModal')).show();
}

document.getElementById('shiftChangeForm').addEventListener('submit', function (e) {
    e.preventDefault();

    const formData = {
        _token: '{{ csrf_token() }}',
        currentShiftDate: document.getElementById('currentShiftDate').value,
        requestedShiftId: document.getElementById('requestedShiftId').value,
        requestReason: document.getElementById('requestReason').value
    };

    fetch("/staff/request-shift-change", {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
            'Accept': 'application/json',
            'X-CSRF-TOKEN': formData._token,
        },
        body: JSON.stringify(formData)
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            Swal.fire('Success', 'Shift change request sent!', 'success').then(() => location.reload());
        } else {
            Swal.fire('Error', 'Something went wrong.', 'error');
        }
    });
});
</script>
@endpush
