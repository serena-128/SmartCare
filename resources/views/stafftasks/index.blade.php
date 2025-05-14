@extends('layouts.app')

@section('content')
<div class="container mt-4">

    <!-- Header -->
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h4 class="mb-0 text-primary">📋 Tasks</h4>
        <a href="{{ route('stafftasks.create') }}" class="btn btn-success">➕ Add New Task</a>
    </div>

    <!-- Task Table -->
    <div class="table-responsive">
        <table class="table table-striped table-hover align-middle" id="stafftasks-table">
            <thead class="table-light">
                <tr>
                    <th>👤 Staff Member</th>
                    <th>📅 Date</th>
                    <th>⏰ Time</th>
                    <th>📝 Description</th>
                    <th class="text-end">⚙️ Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach($stafftasks as $stafftask)
                    <tr id="task-row-{{ $stafftask->id }}">
                        <td>{{ $stafftask->staff->firstname }} {{ $stafftask->staff->lastname }}</td>
                        <td>{{ \Carbon\Carbon::parse($stafftask->date)->format('d M Y') }}</td>
                        <td>{{ \Carbon\Carbon::parse($stafftask->time)->format('H:i') }}</td>
                        <td>{{ $stafftask->description }}</td>
                        <td class="text-end">
                            <div class="btn-group btn-group-sm">
                                <button class="btn btn-outline-primary" onclick="openEditModal({{ $stafftask->id }})" title="Edit">
                                    <i class="fas fa-edit"></i>
                                </button>
                                <button class="btn btn-outline-danger" onclick="deleteTask({{ $stafftask->id }})" title="Delete">
                                    <i class="fas fa-trash-alt"></i>
                                </button>
                            </div>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>

<!-- Edit Task Modal -->
<div class="modal fade" id="editTaskModal" tabindex="-1" aria-labelledby="editTaskLabel" aria-hidden="true">
  <div class="modal-dialog">
    <form id="editTaskForm">
      @csrf
      @method('PUT')
      <input type="hidden" id="editTaskId">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title">Edit Task</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
        </div>
        <div class="modal-body">
          <div class="mb-3">
            <label class="form-label">Date</label>
            <input type="date" name="date" id="editDate" class="form-control">
          </div>
          <div class="mb-3">
            <label class="form-label">Time</label>
            <input type="time" name="time" id="editTime" class="form-control">
          </div>
          <div class="mb-3">
            <label class="form-label">Description</label>
            <textarea name="description" id="editDescription" class="form-control" rows="3"></textarea>
          </div>
        </div>
        <div class="modal-footer">
          <button type="submit" class="btn btn-primary">Update</button>
        </div>
      </div>
    </form>
  </div>
</div>
@endsection

@push('scripts')
<!-- SweetAlert2 -->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script>
function openEditModal(id) {
    fetch(`/stafftasks/${id}/edit`)
        .then(response => response.json())
        .then(data => {
            document.getElementById('editTaskId').value = data.id;
            document.getElementById('editDate').value = data.date;
            document.getElementById('editTime').value = data.time;
            document.getElementById('editDescription').value = data.description;
            new bootstrap.Modal(document.getElementById('editTaskModal')).show();
        });
}

document.getElementById('editTaskForm').addEventListener('submit', function(e) {
    e.preventDefault();

    Swal.fire({
        title: 'Confirm Update',
        text: "Are you sure you want to update this task?",
        icon: 'question',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#aaa',
        confirmButtonText: 'Yes, update it!'
    }).then((result) => {
        if (result.isConfirmed) {
            const id = document.getElementById('editTaskId').value;
            const data = {
                _token: '{{ csrf_token() }}',
                _method: 'PUT',
                date: document.getElementById('editDate').value,
                time: document.getElementById('editTime').value,
                description: document.getElementById('editDescription').value,
            };

            fetch(`/stafftasks/${id}`, {
                method: 'POST',
                headers: {'Content-Type': 'application/json'},
                body: JSON.stringify(data)
            }).then(res => res.json())
              .then(res => {
                  if (res.success) {
                      Swal.fire('Updated!', 'Task has been updated.', 'success')
                          .then(() => location.reload());
                  } else {
                      Swal.fire('Error', 'Failed to update task.', 'error');
                  }
              });
        }
    });
});

function deleteTask(id) {
    Swal.fire({
        title: 'Are you sure?',
        text: "This task will be permanently deleted.",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#dc3545',
        cancelButtonColor: '#6c757d',
        confirmButtonText: 'Yes, delete it!'
    }).then((result) => {
        if (result.isConfirmed) {
            fetch(`/stafftasks/${id}`, {
                method: 'DELETE',
                headers: {
                    'X-CSRF-TOKEN': '{{ csrf_token() }}',
                    'Accept': 'application/json'
                }
            }).then(response => {
                if (response.ok) {
                    document.getElementById(`task-row-${id}`).remove();
                    Swal.fire('Deleted!', 'Task has been removed.', 'success');
                } else {
                    Swal.fire('Error', 'Could not delete the task.', 'error');
                }
            });
        }
    });
}
</script>
@endpush
