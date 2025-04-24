<div class="modal fade" id="addMedicalHistoryModal" tabindex="-1" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <form method="POST" action="{{ route('medical-history.store') }}">
      @csrf
      <input type="hidden" name="resident_id" value="{{ $residentId }}">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title">Add Medical History</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
        </div>
        <div class="modal-body">
          <div class="mb-3">
            <label class="form-label">Title</label>
            <input name="title" class="form-control" required>
          </div>

          <div class="mb-3">
            <label class="form-label">Type</label>
            <select name="type" class="form-select">
              <option value="illness">Illness</option>
              <option value="surgery">Surgery</option>
              <option value="injury">Injury</option>
              <option value="allergy">Allergy</option>
            </select>
          </div>

          <div class="mb-3">
            <label class="form-label">Diagnosed Date</label>
            <input type="date" name="diagnosed_at" class="form-control">
          </div>

          <div class="mb-3">
            <label class="form-label">Source</label>
            <input name="source" class="form-control" placeholder="e.g. Family, Old GP">
          </div>

          <div class="mb-3">
            <label class="form-label">Visibility</label>
            <select name="visibility" class="form-select">
              <option value="private">Private</option>
              <option value="staff_only">Staff Only</option>
              <option value="admin_only">Admin Only</option>
            </select>
          </div>

          <div class="mb-3">
            <label class="form-label">Description</label>
            <textarea name="description" rows="3" class="form-control"></textarea>
          </div>
        </div>
        <div class="modal-footer">
          <button type="submit" class="btn btn-success">Save</button>
        </div>
      </div>
    </form>
  </div>
</div>
