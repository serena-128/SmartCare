@extends('layouts.app')

@section('content')
<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card shadow-lg border-0 rounded-lg">
                <div class="card-header bg-primary text-white text-center py-3">
                    <h3 class="mb-0">Request Shift Change</h3>
                </div>
                <div class="card-body">
                    <form action="{{ route('schedules.requestChange', $schedule->id) }}" method="POST">
                        @csrf

                        <div class="mb-3">
                            <label for="requested_shift_id" class="form-label">Preferred Shift</label>
                            <select class="form-select" id="requested_shift_id" name="requested_shift_id" required>
                                @foreach($shifts as $availableShift)
                                    <option value="{{ $availableShift->id }}">{{ $availableShift->shifttype }} ({{ $availableShift->starttime }} - {{ $availableShift->endtime }})</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="mb-3">
                            <label for="request_reason" class="form-label">Reason for Change</label>
                            <textarea class="form-control" id="request_reason" name="request_reason" rows="3" required></textarea>
                        </div>

                        <div class="d-grid">
                            <button type="submit" class="btn btn-primary">Submit Request</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
