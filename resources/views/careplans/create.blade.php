@extends('layouts.app')

@section('content')
<div class="container mt-2 mb-4">
    <!-- Logo -->
    <div class="text-center mb-1 mt-1">
        <img src="{{ asset('images/carehome_logo.png') }}" alt="SmartCare Logo" style="max-width: 120px;">
    </div>

    <h4 class="text-center text-purple mb-3">Create New Care Plan</h4>

    <div class="card shadow-sm border-0" style="border-radius: 8px;">
        <div class="card-body bg-light-purple px-3 py-3">
            <form action="{{ route('careplans.store') }}" method="POST">
                @csrf

                <div class="row g-3">
                    <div class="col-md-6">
                        <label class="form-label small fw-semibold">Resident Name</label>
                        <select class="form-select form-select-sm" name="residentid" required>
                            <option value="" disabled selected>Select a resident</option>
                            @foreach($residents as $resident)
                                <option value="{{ $resident->id }}">
                                    {{ $resident->firstname }} {{ $resident->lastname }} (Room: {{ $resident->roomnumber }})
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <div class="col-md-6">
                        <label class="form-label small fw-semibold">Assigned Staff Member</label>
                        <select class="form-select form-select-sm" name="staffmemberid" required>
                            <option value="" disabled selected>Select a staff member</option>
                            @foreach($staffMembers as $staff)
                                <option value="{{ $staff->id }}">
                                    {{ $staff->firstname }} {{ $staff->lastname }} - {{ $staff->staff_role }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <div class="col-md-6">
                        <label class="form-label small fw-semibold">Care Goals</label>
                        <input type="text" name="caregoals" class="form-control form-control-sm" required placeholder="Enter care goals">
                    </div>

                    <div class="col-md-6">
                        <label class="form-label small fw-semibold">Care Treatment</label>
                        <input type="text" name="caretreatment" class="form-control form-control-sm" required placeholder="Enter treatment">
                    </div>

                    <div class="col-12">
                        <label class="form-label small fw-semibold">Notes</label>
                        <textarea name="notes" class="form-control form-control-sm" rows="2" required></textarea>
                    </div>

                    <div class="col-12">
                        <label class="form-label small fw-semibold">Assessment Summary</label>
                        <textarea name="assessment_summary" class="form-control form-control-sm" rows="2" required></textarea>
                    </div>

                    <div class="col-md-6">
                        <label class="form-label small fw-semibold">Diagnosis</label>
                        <textarea name="diagnosis" class="form-control form-control-sm" rows="2" required></textarea>
                    </div>

                    <div class="col-md-6">
                        <label class="form-label small fw-semibold">Evaluation Notes</label>
                        <textarea name="evaluation_notes" class="form-control form-control-sm" rows="2" required></textarea>
                    </div>

                    <div class="col-md-4">
                        <label class="form-label small fw-semibold">Status</label>
                        <select name="status" class="form-select form-select-sm" required>
                            <option value="Active" selected>Active</option>
                            <option value="Inactive">Inactive</option>
                            <option value="Completed">Completed</option>
                        </select>
                    </div>
                </div>

                <div class="text-center mt-4">
                    <button type="submit" class="btn btn-success btn-sm px-4">Save</button>
                    <a href="{{ route('careplans.index') }}" class="btn btn-secondary btn-sm px-4">Cancel</a>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Slim styling -->
<style>
    .bg-light-purple {
        background-color: #f7ecff;
    }
    .text-purple {
        color: #6a0dad;
    }
</style>
@endsection
