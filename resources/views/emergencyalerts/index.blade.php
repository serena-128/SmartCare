@extends('layouts.app')

@section('content')
<style>
    .badge {
        font-size: 0.9rem;
        padding: 0.5em 0.8em;
        border-radius: 0.5rem;
        font-weight: 500;
    }
    .badge-danger {
        background-color: #dc3545;
        color: #fff;
    }
    .badge-success {
        background-color: #28a745;
        color: #fff;
    }
    .badge-warning {
        background-color: #ffc107;
        color: #000;
    }
</style>

<section class="content-header">
    <h1 class="pull-left">Emergency Alerts</h1>
    <h1 class="pull-right">
        <a class="btn btn-primary pull-right" style="margin-top: -10px; margin-bottom: 5px" 
           href="{{ route('emergencyalerts.create') }}">Add New</a>
    </h1>
</section>

<div class="table-responsive mt-4">
    <table class="table table-bordered table-striped">
        <thead class="thead-dark">
            <tr>
                <th>Resident</th>
                <th>Alert Type</th>
                <th>Urgency</th>
                <th>Details</th>
                <th>Triggered By</th>
                <th>Alert Time</th>
                <th>Status</th>
                <th>Resolved By</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            @foreach($emergencyalerts as $alert)
                <tr>
                    <td>{{ $alert->resident->firstname ?? 'N/A' }}</td>
                    <td>{{ $alert->alerttype }}</td>
                    <td>{{ $alert->urgency }}</td>
                    <td>{{ $alert->details }}</td>
                    <td>{{ $alert->triggeredBy->firstname ?? 'N/A' }}</td>
                    <td>{{ $alert->alerttimestamp }}</td>
                    
                    <!-- Status with styled badge -->
                    <td>
                        @if ($alert->status === 'Resolved')
                            <span class="badge badge-success">Resolved</span>
                        @elseif ($alert->status === 'In Progress')
                            <span class="badge badge-warning text-dark">In Progress</span>
                        @else
                            <span class="badge badge-danger">Pending</span>
                        @endif
                    </td>

                    <td>{{ $alert->resolvedBy->firstname ?? 'N/A' }}</td>
                        <td>
                            <button class="btn btn-info btn-sm alert-options-btn"
                                    data-id="{{ $alert->id }}"
                                    data-resident="{{ $alert->resident->firstname }}"
                                    data-edit-url="{{ route('emergencyalerts.edit', $alert->id) }}"
                                    data-delete-url="{{ route('emergencyalerts.destroy', $alert->id) }}">
                                ⚙️ Actions
                            </button>
                        </td>

                </tr>
            @endforeach
        </tbody>
    </table>
</div>
@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function () {
    $('.alert-options-btn').click(function () {
        const alertId = $(this).data('id');
        const resident = $(this).data('resident');
        const editUrl = $(this).data('edit-url');
        const deleteUrl = $(this).data('delete-url');

        Swal.fire({
            title: `Manage Alert for ${resident}`,
            text: 'Choose an action below.',
            icon: 'info',
            showCancelButton: true,
            confirmButtonText: 'Mark as Resolved',
            cancelButtonText: 'Close',
            showDenyButton: true,
            denyButtonText: 'Delete',
            showCloseButton: true,
            footer: `<a href="${editUrl}" class="swal2-edit-link">✏️ Edit this Alert</a>`,
            customClass: {
                confirmButton: 'btn btn-success',
                denyButton: 'btn btn-danger',
                cancelButton: 'btn btn-secondary'
            },
            buttonsStyling: false
        }).then((result) => {
            if (result.isConfirmed) {
                // Resolve via AJAX
                $.post(`/emergencyalerts/${alertId}/resolve`, {
                    _token: '{{ csrf_token() }}',
                    resolvedbyid: {{ session('staff_id') }}
                }, function (response) {
                    Swal.fire('Resolved!', response.message, 'success').then(() => {
                        location.reload();
                    });
                }).fail(() => {
                    Swal.fire('Error', 'Failed to resolve alert.', 'error');
                });
            } else if (result.isDenied) {
                // Confirm delete
                Swal.fire({
                    title: 'Delete this alert?',
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonText: 'Yes, delete it!',
                }).then((delResult) => {
                    if (delResult.isConfirmed) {
                        $.ajax({
                            url: deleteUrl,
                            method: 'POST',
                            data: {
                                _token: '{{ csrf_token() }}',
                                _method: 'DELETE'
                            },
                            success: function () {
                                Swal.fire('Deleted!', 'The alert has been deleted.', 'success').then(() => {
                                    location.reload();
                                });
                            },
                            error: function () {
                                Swal.fire('Error', 'Failed to delete alert.', 'error');
                            }
                        });
                    }
                });
            }
        });
    });
});
</script>
@endpush

@endsection
