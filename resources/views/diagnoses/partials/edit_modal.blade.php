<div class="modal fade" id="editModal{{ $diagnosis->id }}" tabindex="-1"
    aria-labelledby="editModalLabel{{ $diagnosis->id }}" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <form action="{{ route('diagnoses.update', $diagnosis->id) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="modal-content">
            <div class="modal-header bg-primary text-white">
                <h5 class="modal-title">Edit Diagnosis for {{ $diagnosis->resident->firstname }}</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body row g-3">
                <div class="col-md-6">
                    <label class="form-label">Diagnosis</label>
                    <input type="text" name="diagnosis" class="form-control" value="{{ $diagnosis->diagnosis }}">
                </div>
                <div class="col-md-6">
                    <label class="form-label">Vital Signs</label>
                    <input type="text" name="vitalsigns" class="form-control" value="{{ $diagnosis->vitalsigns }}">
                </div>
                <div class="col-md-6">
                    <label class="form-label">Treatment</label>
                    <input type="text" name="treatment" class="form-control" value="{{ $diagnosis->treatment }}">
                </div>
                <div class="col-md-6">
                    <label class="form-label">Test Results</label>
                    <input type="text" name="testresults" class="form-control" value="{{ $diagnosis->testresults }}">
                </div>
                <div class="col-12">
                    <label class="form-label">Notes</label>
                    <textarea name="notes" class="form-control">{{ $diagnosis->notes }}</textarea>
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
