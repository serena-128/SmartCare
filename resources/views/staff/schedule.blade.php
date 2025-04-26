@extends('layouts.app')

@section('content')
<style>
    .nav-tabs {
        background: #f8f9fa;
        border-bottom: 2px solid #dee2e6;
        border-radius: 0.5rem;
        overflow-x: auto;
        white-space: nowrap;
    }
    .nav-tabs .nav-link {
        margin: 5px;
        border: none;
        border-radius: 30px;
        background: #e9ecef;
        color: #333;
        padding: 8px 20px;
        font-weight: 600;
        transition: 0.3s;
    }
    .nav-tabs .nav-link:hover {
        background: #d6d8db;
    }
    .nav-tabs .nav-link.active {
        background: #6f42c1;
        color: white;
    }
    .week-title {
        margin-top: 1.5rem;
        color: #6f42c1;
        font-weight: bold;
    }
    .day-title {
        font-weight: bold;
        margin-top: 1.5rem;
        color: #495057;
    }
    .shift-table th {
        background: #f1f1f1;
        text-align: center;
        font-size: 0.9rem;
    }
    .shift-table td {
        text-align: center;
        vertical-align: middle;
        font-family: monospace;
    }
    .container {
        max-width: 950px;
    }
</style>

<div class="container">
    <h1 class="mb-4 text-center">📅 My Weekly Schedule</h1>

    @php
        $groupedWeeks = $schedules->groupBy(function($s) {
            return \Carbon\Carbon::parse($s->shiftdate)->startOfWeek()->format('d M Y');
        });
        $weekKeys = $groupedWeeks->keys();
    @endphp

    <!-- TABS -->
    <ul class="nav nav-tabs justify-content-center mb-4" id="weekTab" role="tablist">
        @foreach($weekKeys as $i => $week)
            <li class="nav-item" role="presentation">
                <button class="nav-link {{ $i == 0 ? 'active' : '' }}" id="week-{{ $i }}-tab" data-bs-toggle="tab" data-bs-target="#week-{{ $i }}" type="button" role="tab">
                    📅 {{ $week }}
                </button>
            </li>
        @endforeach
    </ul>

    <!-- TAB CONTENT -->
    <div class="tab-content" id="weekTabContent">
        @foreach($groupedWeeks as $week => $weekSchedules)
            <div class="tab-pane fade {{ $loop->first ? 'show active' : '' }}" id="week-{{ $loop->index }}" role="tabpanel">
                
                @php
                    $days = $weekSchedules->groupBy('shiftdate');
                @endphp

                @foreach($days as $date => $entries)
                    <h5 class="day-title">{{ \Carbon\Carbon::parse($date)->format('l d F Y') }}</h5>

                    @php
                        $shift = $entries->where('shifttype', 'shift')->first();
                        $lunch = $entries->where('shifttype', 'lunch')->first();
                        $break = $entries->where('shifttype', 'break')->first();
                    @endphp

                    <div class="table-responsive mb-4">
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
                                    <td>
                                        @if($break)
                                            {{ \Carbon\Carbon::parse($break->starttime)->format('H:i') }}–{{ \Carbon\Carbon::parse($break->endtime)->format('H:i') }}
                                        @else
                                            -
                                        @endif
                                    </td>
                                    <td>
                                        @if($lunch)
                                            {{ \Carbon\Carbon::parse($lunch->starttime)->format('H:i') }}–{{ \Carbon\Carbon::parse($lunch->endtime)->format('H:i') }}
                                        @else
                                            -
                                        @endif
                                    </td>
                                    <td>{{ $shift ? \Carbon\Carbon::parse($shift->endtime)->format('H:i') : '-' }}</td>
                                </tr>
                            </tbody>
                        </table>
                        <div class="text-center mb-4">
                    <button class="btn btn-outline-primary" onclick="openShiftChangeModal('{{ $date }}')">
                        📝 Request Shift Change
                    </button>
                </div>

                    </div>
                @endforeach

            </div>
        @endforeach
    </div>
</div>

@endsection
<!-- Shift Change Modal -->
<div class="modal fade" id="shiftChangeModal" tabindex="-1" aria-labelledby="shiftChangeModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <form id="shiftChangeForm">
      @csrf
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="shiftChangeModalLabel">Request Shift Change</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
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
@push('scripts')
<script>
 function openShiftChangeModal(date) {
    document.getElementById('currentShiftDate').value = date;

    // Fetch available shifts from the server
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
                    select.innerHTML += `<option value="${shift.id}">
                        ${shift.date} (${shift.start} - ${shift.end})
                    </option>`;
                });
            }
        });

    var myModal = new bootstrap.Modal(document.getElementById('shiftChangeModal'));
    myModal.show();
}

document.getElementById('shiftChangeForm').addEventListener('submit', function (e) {
    e.preventDefault();
    
    const formData = {
        _token: '{{ csrf_token() }}',
        currentShiftDate: document.getElementById('currentShiftDate').value,
        requestedShiftId: document.getElementById('requestedShiftId').value,
        requestReason: document.getElementById('requestReason').value
    };

    fetch('/staff/request-shift-change', {
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
            Swal.fire('Success', 'Shift change request sent!', 'success')
                .then(() => location.reload());
        } else {
            Swal.fire('Error', 'Something went wrong.', 'error');
        }
    });
});
   
</script>
@endpush