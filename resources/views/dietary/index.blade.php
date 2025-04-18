@extends('layouts.app')

@section('content')
    <div class="container">
        <h2>Dietary Management</h2>

        <!-- Nav tabs -->
        <ul class="nav nav-tabs" id="dietaryTab" role="tablist">
            <li class="nav-item">
                <a class="nav-link active" id="meal-plan-tab" data-bs-toggle="tab" href="#meal-plan" role="tab" aria-controls="meal-plan" aria-selected="true">Meal Plan</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" id="food-search-tab" data-bs-toggle="tab" href="#food-search" role="tab" aria-controls="food-search" aria-selected="false">Food Search</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" id="resident-allergies-tab" data-bs-toggle="tab" href="#resident-allergies" role="tab" aria-controls="resident-allergies" aria-selected="false">Resident Allergies</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" id="meal-history-tab" data-bs-toggle="tab" href="#meal-history" role="tab" aria-controls="meal-history" aria-selected="false">Meal History</a>
            </li>
        </ul>

        <!-- Tab content -->
        <div class="tab-content mt-4" id="dietaryTabContent">
            <!-- Meal Plan Tab -->
            <div class="tab-pane fade show active" id="meal-plan" role="tabpanel" aria-labelledby="meal-plan-tab">
                <form action="{{ route('mealPlan.store') }}" method="POST">
                    @csrf
                    <label for="food_item">Search for food</label>
                    <input type="text" name="food_item" id="food_item" class="form-control" placeholder="Search for food">
                    <button type="submit" class="btn btn-primary mt-2">Add to Meal Plan</button>
                </form>
            </div>

            <!-- Food Search Tab -->
            <div class="tab-pane fade" id="food-search" role="tabpanel" aria-labelledby="food-search-tab">
                <p>Food search results will appear here</p>
            </div>

            <!-- Resident Allergies Tab -->
            <div class="tab-pane fade" id="resident-allergies" role="tabpanel" aria-labelledby="resident-allergies-tab">
                <p>List of resident allergies and dietary restrictions will appear here.</p>
            </div>

            <!-- Meal History Tab -->
            <div class="tab-pane fade" id="meal-history" role="tabpanel" aria-labelledby="meal-history-tab">
                <p>Meal history for the selected resident will appear here.</p>
            </div>
        </div>
    </div>
@endsection
