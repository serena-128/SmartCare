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
    <table class="table table-bordered">
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
       <tr 
    @if($alert->status === 'Resolved')
        style="background-color: #e6f4ea; color: #256029;" {{-- ✅ Greenish --}}
    @elseif($alert->urgency === 'High')
        style="background-color: #fdecea; color: #b71c1c;" {{-- 🔴 Soft red --}}
    @elseif($alert->urgency === 'Medium')
        style="background-color: #fff4e5; color: #e65100;" {{-- 🟠 Soft orange --}}
    @elseif($alert->urgency === 'Low')
        style="background-color: #fefae0; color: #a88700;" {{-- 🟡 Soft yellow --}}
    @endif
>


            <td>{{ $alert->resident->firstname ?? 'N/A' }} {{ $alert->resident->lastname ?? '' }}</td>
            <td>{{ $alert->alerttype }}</td>
            <td>
            @if($alert->urgency === 'High')
                🔴 High
            @elseif($alert->urgency === 'Medium')
                🟠 Medium
            @elseif($alert->urgency === 'Low')
                🟡 Low
            @else
                {{ $alert->urgency }}
            @endif
        </td>

            <td>{{ $alert->details }}</td>
            <td>{{ $alert->triggeredBy->firstname ?? 'N/A' }} {{ $alert->triggeredBy->lastname ?? '' }}</td>
            <td>{{ $alert->alerttimestamp }}</td>

            <td>
                @if ($alert->status === 'Resolved')
                    <span class="badge badge-success">Resolved</span>
                @elseif ($alert->status === 'In Progress')
                    <span class="badge badge-warning text-dark">In Progress</span>
                @else
                    <span class="badge badge-danger">Pending</span>
                @endif
            </td>

            <td>{{ $alert->resolvedBy->firstname ?? 'N/A' }} {{ $alert->resolvedBy->lastname ?? '' }}</td>

            <td>
                <button class="btn btn-info btn-sm alert-options-btn"
                        data-id="{{ $alert->id }}"
                        data-resident="{{ $alert->resident->firstname }}"
                        data-alerttype="{{ $alert->alerttype }}"
                        data-urgency="{{ $alert->urgency }}"
                        data-details="{{ $alert->details }}"
                        data-edit-url="{{ route('emergencyalerts.update', $alert->id) }}"
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
        const alertType = $(this).data('alerttype');
        const urgency = $(this).data('urgency');
        const details = $(this).data('details');

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
            footer: `<button id="inline-edit-btn" class="btn btn-sm btn-primary">✏️ Edit this Alert</button>`,
            customClass: {
                confirmButton: 'btn btn-success',
                denyButton: 'btn btn-danger',
                cancelButton: 'btn btn-secondary'
            },
            buttonsStyling: false,
            didOpen: () => {
                document.getElementById('inline-edit-btn').addEventListener('click', () => {
                    Swal.fire({
                        title: 'Edit Alert Details',
                        html: `
                            <input id="edit-alerttype" class="swal2-input" placeholder="Alert Type" value="${alertType}">
                            <input id="edit-urgency" class="swal2-input" placeholder="Urgency" value="${urgency}">
                            <textarea id="edit-details" class="swal2-textarea" placeholder="Details">${details}</textarea>
                        `,
                        focusConfirm: false,
                        showCancelButton: true,
                        confirmButtonText: 'Save Changes',
                        preConfirm: () => {
                            return {
                                alerttype: document.getElementById('edit-alerttype').value,
                                urgency: document.getElementById('edit-urgency').value,
                                details: document.getElementById('edit-details').value
                            };
                        }
                    }).then((editResult) => {
                        if (editResult.isConfirmed) {
                            $.ajax({
                                url: editUrl,
                                method: 'POST',
                                data: {
                                    _token: '{{ csrf_token() }}',
                                    _method: 'PUT',
                                    alerttype: editResult.value.alerttype,
                                    urgency: editResult.value.urgency,
                                    details: editResult.value.details
                                },
                                success: function () {
                                    Swal.fire('Updated!', 'The alert has been updated.', 'success').then(() => {
                                        location.reload();
                                    });
                                },
                                error: function () {
                                    Swal.fire('Error', 'Failed to update alert.', 'error');
                                }
                            });
                        }
                    });
                });
            }
        }).then((result) => {
            if (result.isConfirmed) {
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
                Swal.fire({
                    title: 'Are you sure?',
                    text: "This alert will be permanently deleted.",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#d33',
                    cancelButtonColor: '#3085d6',
                    confirmButtonText: 'Yes, delete it!'
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
                                Swal.fire({
                                    title: 'Deleted!',
                                    text: 'The alert has been deleted.',
                                    icon: 'success',
                                    timer: 1500,
                                    showConfirmButton: false
                                }).then(() => {
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
