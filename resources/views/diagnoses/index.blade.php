@extends('layouts.app')

@section('content')
<div class="container mt-4">
    <div class="card shadow-sm">
        <div class="card-header bg-primary text-white d-flex justify-content-between align-items-center">
            <h4 class="mb-0">All Resident Diagnoses</h4>
            <button type="button" class="btn btn-light btn-sm" data-bs-toggle="modal" data-bs-target="#addDiagnosisModal">
            <i class="fas fa-plus-circle"></i> Add Diagnosis
        </button>

        </div>
        <div class="card-body">
            @include('flash::message')
<!-- Search by Resident -->
<form method="GET" action="{{ route('diagnoses.index') }}" class="row g-3 mb-4">
    <div class="col-md-3">
        <input type="text" name="resident_name" class="form-control" placeholder="Resident name..."
            value="{{ request('resident_name') }}">
    </div>
    <div class="col-md-3">
        <input type="text" name="diagnosis_type" class="form-control" placeholder="Diagnosis..."
            value="{{ request('diagnosis_type') }}">
    </div>
    <div class="col-md-3">
        <select name="staff_id" class="form-select">
            <option value="">Staff member...</option>
            @foreach($staffMembers as $staff)
                <option value="{{ $staff->id }}" {{ request('staff_id') == $staff->id ? 'selected' : '' }}>
                    {{ $staff->firstname }} {{ $staff->lastname }}
                </option>
            @endforeach
        </select>
    </div>
    <div class="col-md-3">
        <button type="submit" class="btn btn-outline-primary w-100">
            <i class="fas fa-filter"></i> Apply Filters
        </button>
    </div>
</form>

            @if($diagnoses->count())
            <div class="table-responsive">
                <table class="table table-hover align-middle">
                    <thead class="table-light">
                        <tr>
                            <th>Resident</th>
                            <th>Diagnosis</th>
                            <th>Vital Signs</th>
                            <th>Treatment</th>
                            <th>Test Results</th>
                            <th>Notes</th>
                            <th>Last Updated By</th>
                            <th class="text-center">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                    @foreach($diagnoses as $diagnosis)
                        @php
                            $urgentConditions = ['Hypertension', 'Anemia', 'Heart Failure', 'Stroke'];
                        @endphp
                        <tr class="{{ in_array($diagnosis->diagnosis, $urgentConditions) ? 'table-danger' : '' }}">
                            <td>{{ optional($diagnosis->resident)->firstname }} {{ optional($diagnosis->resident)->lastname }}</td>
                            <td>{{ $diagnosis->diagnosis }}</td>
                            <td>{{ $diagnosis->vitalsigns }}</td>
                            <td>{{ $diagnosis->treatment }}</td>
                            <td>{{ $diagnosis->testresults }}</td>
                            <td>{{ $diagnosis->notes }}</td>
                            <td>
                            {{ optional($diagnosis->lastUpdatedBy)->firstname }} {{ optional($diagnosis->lastUpdatedBy)->lastname }}
                        </td>


                            <td class="text-center">
                                <div class="btn-group">
                                    <a href="{{ route('diagnoses.show', $diagnosis->id) }}" class="btn btn-outline-info btn-sm"><i class="fas fa-eye"></i></a>
                                    <a href="{{ route('diagnoses.edit', $diagnosis->id) }}" class="btn btn-outline-warning btn-sm"><i class="fas fa-edit"></i></a>
                                    <button class="btn btn-outline-danger btn-sm delete-btn" data-id="{{ $diagnosis->id }}"><i class="fas fa-trash-alt"></i></button>
                                    <form id="delete-form-{{ $diagnosis->id }}" action="{{ route('diagnoses.destroy', $diagnosis->id) }}" method="POST" style="display: none;">
                                        @csrf
                                        @method('DELETE')
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>

            <!-- Pagination -->
            {{ $diagnoses->appends(request()->query())->links() }}

            @else
                <p class="text-center text-muted">No diagnoses found.</p>
            @endif
        </div>
    </div>
</div>
<!-- Add Diagnosis Modal -->
<div class="modal fade" id="addDiagnosisModal" tabindex="-1" aria-labelledby="addDiagnosisModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content shadow">
      <div class="modal-header bg-primary text-white">
        <h5 class="modal-title" id="addDiagnosisModalLabel">Add New Diagnosis</h5>
        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <form method="POST" action="{{ route('diagnoses.store') }}">
        @csrf
        <div class="modal-body">
          <div class="row g-3">
            <div class="col-md-6">
              <label for="residentid" class="form-label">Resident</label>
              <select name="residentid" class="form-select" required>
                <option value="">Select resident...</option>
                @foreach(\App\Models\Resident::all() as $resident)
                  <option value="{{ $resident->id }}">{{ $resident->firstname }} {{ $resident->lastname }}</option>
                @endforeach
              </select>
            </div>
            <div class="col-md-6">
              <label for="diagnosis" class="form-label">Diagnosis</label>
              <input type="text" name="diagnosis" class="form-control" required>
            </div>
            <div class="col-md-6">
              <label for="vitalsigns" class="form-label">Vital Signs</label>
              <input type="text" name="vitalsigns" class="form-control">
            </div>
            <div class="col-md-6">
              <label for="treatment" class="form-label">Treatment</label>
              <input type="text" name="treatment" class="form-control">
            </div>
            <div class="col-md-6">
              <label for="testresults" class="form-label">Test Results</label>
              <input type="text" name="testresults" class="form-control">
            </div>
            <div class="col-md-6">
              <label for="notes" class="form-label">Notes</label>
              <textarea name="notes" class="form-control" rows="2"></textarea>
            </div>
            <input type="hidden" name="lastupdatedby" value="{{ Auth::user()->id }}">
          </div>
        </div>
        <div class="modal-footer">
          <button type="submit" class="btn btn-primary">Save Diagnosis</button>
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
        </div>
      </form>
    </div>
  </div>
</div>

@endsection

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
    document.querySelectorAll('.delete-btn').forEach(button => {
        button.addEventListener('click', function () {
            const id = this.dataset.id;
            Swal.fire({
                title: 'Are you sure?',
                text: "This diagnosis will be permanently deleted!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#dc3545',
                cancelButtonColor: '#6c757d',
                confirmButtonText: 'Yes, delete it!'
            }).then((result) => {
                if (result.isConfirmed) {
                    document.getElementById(`delete-form-${id}`).submit();
                }
            });
        });
    });
</script>
@endpush
