<!-- STAFF NAME (Read-only) -->
<div class="mb-3">
    <label class="form-label fw-bold text-purple">👤 Staff Name:</label>
    <input type="text" class="form-control bg-light"
       value="{{ $staff ? $staff->firstname . ' ' . $staff->lastname : 'Unknown Staff' }}"
       disabled>
<input type="hidden" name="staff_id" value="{{ $staff ? $staff->id : '' }}">

</div>

<!-- CATEGORY -->
<div class="mb-3">
    <label for="category" class="form-label fw-bold text-purple">📝 Feedback Category:</label>
    <select name="category" id="category" class="form-select" required>
        <option value="" disabled selected>Select a category</option>
        <option value="Facility & Environment">Facility & Environment</option>
        <option value="Staff & Service">Staff & Service</option>
        <option value="Technology & Equipment">Technology & Equipment</option>
        <option value="Other">Other (Please Specify)</option>
    </select>
</div>


<!-- SUBJECT -->
<div class="mb-3">
    <label class="form-label fw-bold text-purple">📨 Subject:</label>
    <input type="text" name="subject" class="form-control" placeholder="Enter subject" required>
</div>

<!-- MESSAGE -->
<div class="mb-3">
    <label class="form-label fw-bold text-purple">💬 Message:</label>
    <textarea name="message" class="form-control" rows="5" placeholder="Enter your feedback" required></textarea>
</div>

<!-- RATING -->
<div class="mb-3">
    <label class="form-label fw-bold text-purple">⭐ Rating (1-5):</label>
    <select name="rating" class="form-select">
        <option value="">Optional</option>
        @for ($i = 1; $i <= 5; $i++)
            <option value="{{ $i }}">{{ $i }}</option>
        @endfor
    </select>
</div>

<!-- ATTACHMENT -->
<div class="mb-3">
    <label class="form-label fw-bold text-purple">📎 Attachment (optional):</label>
    <input type="file" name="attachment" class="form-control">
</div>

<!-- Force is_anonymous to false if checkbox is not checked -->
<input type="hidden" name="is_anonymous" value="0">

<!-- Anonymous Checkbox -->
<div class="form-group mb-3">
    <label class="form-label fw-bold text-purple">🙈 Submit Anonymously:</label><br>
    <input type="checkbox" name="is_anonymous" value="1">
</div>


<!-- SUBMIT BUTTON -->
<div class="d-flex justify-content-start gap-3">
    <button type="submit" class="btn btn-purple fw-bold">
        <i class="fas fa-paper-plane"></i> Submit Feedback
    </button>
    <a href="{{ route('feedback.index') }}" class="btn btn-outline-secondary">Cancel</a>
</div>
