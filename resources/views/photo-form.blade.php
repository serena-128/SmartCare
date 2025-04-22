@extends('layouts.app')

@section('content')
<div class="container">
    <div class="card mt-4">
        <div class="card-header purple-bg text-white">
            <i class="fas fa-camera"></i> Upload Photo to Gallery
        </div>

        @if(session('success'))
            <div class="alert alert-success text-center mt-4">
                {{ session('success') }}
            </div>
        @endif

        <div class="card-body">
            <div class="text-center mb-4">
                <img src="{{ asset('pictures/carehome_logo.png') }}" alt="SmartCare Logo" class="upload-logo" style="width: 200px; height: auto; margin: 40px 0;">
            </div>

            <form action="{{ route('photo.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="mb-4">
                    <label for="photo" class="form-label">Choose a Photo</label>
                    <input type="file" class="form-control" id="photo" name="photo" required>
                </div>

                <!-- ✅ Image Preview Section -->
                <div class="text-center mb-4">
                    <img id="preview-image" src="#" alt="Image Preview" style="max-width: 200px; display: none; border-radius: 10px; border: 2px dashed #800080;" />
                </div>

                <button type="submit" class="btn btn-purple w-100">
                    <i class="fas fa-upload"></i> Upload Photo
                </button>
            </form>
        </div>
    </div>
</div>
@endsection

@push('styles')
<style>
    .purple-bg {
        background-color: #800080;
        border-radius: 15px 15px 0 0;
    }

    .btn-purple {
        background-color: #800080;
        border: none;
        border-radius: 10px;
        color: white;
        font-weight: 600;
        padding: 12px;
    }

    .btn-purple:hover {
        background-color: #6a006a;
        color: white;
    }

    .upload-logo {
        max-width: 140px;
        margin: 20px 0;
    }
    .container {
  max-width: 800px;
  margin-top: 0px;
}

    }

    .card {
        border-radius: 15px;
        box-shadow: 0 10px 20px rgba(0, 0, 0, 0.1);
    }
</style>
@endpush

@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function () {
        const input = document.getElementById('photo');
        const preview = document.getElementById('preview-image');

        input.addEventListener('change', function (event) {
            const file = event.target.files[0];

            if (file) {
                const reader = new FileReader();
                reader.onload = function (e) {
                    preview.src = e.target.result;
                    preview.style.display = 'block';
                }
                reader.readAsDataURL(file);
            } else {
                preview.src = '';
                preview.style.display = 'none';
            }
        });
    });
</script>
@endpush
