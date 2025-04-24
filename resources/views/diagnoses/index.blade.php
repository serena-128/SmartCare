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
@foreach($diagnoses as $residentId => $residentDiagnoses)
    @php
        $resident = $residentDiagnoses->first()->resident;
    @endphp
    <tr class="table-primary">
        <td colspan="8">
            <div class="d-flex justify-content-between align-items-center">
                <strong>{{ $resident->firstname }} {{ $resident->lastname }}</strong>
                <button class="btn btn-sm btn-outline-secondary" type="button"
                        onclick="toggleRows('{{ $residentId }}')">
                    Toggle Diagnoses
                </button>
            </div>
        </td>
    </tr>

    @foreach($residentDiagnoses as $diagnosis)
    <tr class="resident-rows-{{ $residentId }}">
        <td></td> <!-- Empty since name is above -->
        <td>{{ $diagnosis->diagnosis }}</td>
        <td>{{ $diagnosis->vitalsigns }}</td>
        <td>{{ $diagnosis->treatment }}</td>
        <td>{{ $diagnosis->testresults }}</td>
        <td>{{ $diagnosis->notes }}</td>
        <td>{{ optional($diagnosis->lastUpdatedBy)->firstname }} {{ optional($diagnosis->lastUpdatedBy)->lastname }}</td>
        <td class="text-center">
            <button class="btn btn-sm btn-warning edit-btn"
    data-id="{{ $diagnosis->id }}"
    data-resident="{{ $diagnosis->resident->firstname }}"
    data-diagnosis="{{ $diagnosis->diagnosis }}"
    data-vitalsigns="{{ $diagnosis->vitalsigns }}"
    data-treatment="{{ $diagnosis->treatment }}"
    data-testresults="{{ $diagnosis->testresults }}"
    data-notes="{{ $diagnosis->notes }}">
    Edit
</button>

        </td>
    </tr>
    @endforeach
@endforeach
</tbody>




                </table>
            </div>

            

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
<!-- Shared Edit Diagnosis Modal -->
<div class="modal fade" id="editModal" tabindex="-1" aria-labelledby="editModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <form method="POST" id="editDiagnosisForm">
      @csrf
      @method('PUT')
      <div class="modal-content shadow">
        <div class="modal-header bg-primary text-white">
          <h5 class="modal-title" id="editModalLabel">Edit Diagnosis</h5>
          <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body row g-3">
          <div class="col-md-6">
            <label class="form-label">Diagnosis</label>
            <input type="text" name="diagnosis" id="edit-diagnosis" class="form-control">
          </div>
          <div class="col-md-6">
            <label class="form-label">Vital Signs</label>
            <input type="text" name="vitalsigns" id="edit-vitalsigns" class="form-control">
          </div>
          <div class="col-md-6">
            <label class="form-label">Treatment</label>
            <input type="text" name="treatment" id="edit-treatment" class="form-control">
          </div>
          <div class="col-md-6">
            <label class="form-label">Test Results</label>
            <input type="text" name="testresults" id="edit-testresults" class="form-control">
          </div>
          <div class="col-12">
            <label class="form-label">Notes</label>
            <textarea name="notes" id="edit-notes" class="form-control"></textarea>
          </div>
        </div>
        <div class="modal-footer">
          <button class="btn btn-success">Save Changes</button>
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
        </div>
      </div>
    </form>
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
<script>
function toggleRows(residentId) {
    document.querySelectorAll('.resident-rows-' + residentId).forEach(row => {
        row.style.display = row.style.display === 'none' ? '' : 'none';
    });
}
</script>
<script>
    document.querySelectorAll('.edit-btn').forEach(button => {
        button.addEventListener('click', function () {
            const id = this.dataset.id;
            const form = document.getElementById('editDiagnosisForm');
            form.action = `/diagnoses/${id}`;

            // Fill modal inputs
            document.getElementById('edit-diagnosis').value = this.dataset.diagnosis;
            document.getElementById('edit-vitalsigns').value = this.dataset.vitalsigns;
            document.getElementById('edit-treatment').value = this.dataset.treatment;
            document.getElementById('edit-testresults').value = this.dataset.testresults;
            document.getElementById('edit-notes').value = this.dataset.notes;

            // Optional: Update title with resident name
            document.getElementById('editModalLabel').innerText = `Edit Diagnosis for ${this.dataset.resident}`;

            // Open modal programmatically
            const modal = new bootstrap.Modal(document.getElementById('editModal'));
            modal.show();
        });
    });
</script>

@endpush
