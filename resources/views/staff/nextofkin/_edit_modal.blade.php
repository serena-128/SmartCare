<div class="modal fade" id="editModal{{ $kin->id }}" tabindex="-1" aria-labelledby="editModalLabel{{ $kin->id }}" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <form class="editNextOfKinForm" data-id="{{ $kin->id }}">
        @csrf
        @method('PUT')
        <div class="modal-header bg-primary text-white">
          <h5 class="modal-title" id="editModalLabel{{ $kin->id }}">Edit Next of Kin</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <div class="mb-3">
            <label class="form-label">First Name</label>
            <input type="text" class="form-control" name="firstname" value="{{ $kin->firstname }}" required>
          </div>

          <div class="mb-3">
            <label class="form-label">Last Name</label>
            <input type="text" class="form-control" name="lastname" value="{{ $kin->lastname }}" required>
          </div>

          <div class="mb-3">
            <label class="form-label">Relationship to Resident</label>
            <input type="text" class="form-control" name="relationshiptoresident" value="{{ $kin->relationshiptoresident }}">
          </div>

          <div class="mb-3">
            <label class="form-label">Contact Number</label>
            <input type="text" class="form-control" name="contactnumber" value="{{ $kin->contactnumber }}">
          </div>

          <div class="mb-3">
    <label class="form-label">Linked Resident</label>
    <input type="text" class="form-control" value="{{ $kin->resident ? $kin->resident->firstname . ' ' . $kin->resident->lastname . ' - Room ' . $kin->resident->roomnumber : 'N/A' }}" readonly>
</div>

<!-- Optional: keep the hidden resident_id for backend -->
<input type="hidden" name="resident_id" value="{{ $kin->resident_id }}">

        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
          <button type="submit" class="btn btn-success">Save Changes</button>
        </div>
      </form>
    </div>
  </div>
</div>
