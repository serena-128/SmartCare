@extends('layouts.app')

@section('content')
<div class="container mt-4">
    <h2 class="mb-4 text-center text-primary">👪 Next of Kin Information</h2>

    <div class="card shadow border-0">
        <div class="card-header bg-primary text-white">
            <strong>List of Next of Kin & Residents</strong>
        </div>

        <div class="card-body">
            @if($nextOfKinData->isEmpty())
                <p class="text-muted">No next of kin information available.</p>
            @else
                <table class="table table-bordered table-hover table-striped align-middle">
                    <thead class="table-light">
                        <tr class="text-center">
                            <th>First Name</th>
                            <th>Last Name</th>
                            <th>Relationship</th>
                            <th>Contact</th>
                            <th>Resident</th>
                            <th>Room #</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($nextOfKinData as $kin)
                            <tr>
                                <td>{{ $kin->firstname }}</td>
                                <td>{{ $kin->lastname }}</td>
                                <td>{{ $kin->relationshiptoresident }}</td>
                                <td>{{ $kin->contactnumber }}</td>
                                <td>
                                    @if($kin->resident)
                                        {{ $kin->resident->firstname }} {{ $kin->resident->lastname }}
                                    @else
                                        <span class="text-danger">N/A</span>
                                    @endif
                                </td>
                                <td>{{ $kin->resident?->roomnumber ?? 'N/A' }}</td>
                                <td class="text-center">
                                    <button class="btn btn-sm btn-warning" data-bs-toggle="modal" data-bs-target="#editModal{{ $kin->id }}">
                                        ✏️ Edit
                                    </button>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            @endif
        </div>
    </div>
</div>

<!-- ✅ Place modals here OUTSIDE the table -->
@foreach($nextOfKinData as $kin)
    @include('staff.nextofkin._edit_modal', ['kin' => $kin])
@endforeach


@endsection

@push('scripts')
<script>
$(document).ready(function() {
    $('.editNextOfKinForm').on('submit', function(e) {
        e.preventDefault();
        
        var form = $(this);
        var id = form.data('id');
        var url = '/staff/nextofkin/' + id + '/update';
        
        $.ajax({
            url: url,
            type: 'PUT',
            data: form.serialize(),
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            success: function(response) {
    // Hide the modal after success
    form.closest('.modal').modal('hide');

    // Show success message
    alert(response.message);

    // Reload the page to refresh the table
    location.reload();
},

            error: function(xhr) {
                console.log(xhr.responseText);
                alert('Something went wrong.');
            }
        });
    });
});
</script>
@endpush
