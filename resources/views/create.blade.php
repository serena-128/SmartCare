@extends('layouts.app')

@section('content')
<div class="max-w-4xl mx-auto bg-white p-6 rounded-lg shadow-md">
    <h2 class="text-2xl font-bold mb-4">Create Care Plan</h2>

    <form action="{{ route('care-plans.store') }}" method="POST">
        @csrf

        <label class="block mb-2">Select Resident:</label>
        <select name="resident_id" class="w-full p-2 border rounded">
            @foreach($residents as $resident)
                <option value="{{ $resident->id }}">{{ $resident->name }}</option>
            @endforeach
        </select>

        <label class="block mt-4">Medical History:</label>
        <textarea name="medical_history" class="w-full p-2 border rounded"></textarea>

        <label class="block mt-4">Medications:</label>
        <textarea name="medications" class="w-full p-2 border rounded"></textarea>

        <label class="block mt-4">Treatments:</label>
        <textarea name="treatments" class="w-full p-2 border rounded"></textarea>

        <label class="block mt-4">Dietary Needs:</label>
        <textarea name="dietary" class="w-full p-2 border rounded"></textarea>

        <label class="block mt-4">Preferences:</label>
        <textarea name="preferences" class="w-full p-2 border rounded"></textarea>

        <button type="submit" class="mt-4 bg-blue-500 text-white p-2 rounded-lg hover:bg-blue-700">
            Save Care Plan
        </button>
    </form>
</div>
@endsection
