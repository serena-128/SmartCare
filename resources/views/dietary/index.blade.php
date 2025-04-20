@extends('layouts.app')

@section('content')
@php
    $active = $activeTab ?? 'preferences';
@endphp

<div class="container">
  <h2 class="mb-4">Dietary Management</h2>

  <!-- Nav tabs -->
  <ul class="nav nav-tabs" id="dietaryTab" role="tablist">
    <li class="nav-item">
      <a class="nav-link {{ $active==='preferences'?'active':'' }}"
         id="resident-preferences-tab"
         data-bs-toggle="tab"
         href="#resident-preferences"
         role="tab"
         aria-controls="resident-preferences"
         aria-selected="{{ $active==='preferences'?'true':'false' }}">
        Resident Preferences
      </a>
    </li>
    <li class="nav-item">
      <a class="nav-link {{ $active==='allergies'?'active':'' }}"
         id="resident-allergies-tab"
         data-bs-toggle="tab"
         href="#resident-allergies"
         role="tab"
         aria-controls="resident-allergies"
         aria-selected="{{ $active==='allergies'?'true':'false' }}">
        Allergies
      </a>
    </li>
    <li class="nav-item">
      <a class="nav-link {{ $active==='meal-plan'?'active':'' }}"
         id="meal-plan-tab"
         data-bs-toggle="tab"
         href="#meal-plan"
         role="tab"
         aria-controls="meal-plan"
         aria-selected="{{ $active==='meal-plan'?'true':'false' }}">
        Meal Plan
      </a>
    </li>
    <li class="nav-item">
      <a class="nav-link {{ $active==='food-search'?'active':'' }}"
         id="food-search-tab"
         data-bs-toggle="tab"
         href="#food-search"
         role="tab"
         aria-controls="food-search"
         aria-selected="{{ $active==='food-search'?'true':'false' }}">
        Food Search
      </a>
    </li>
    <li class="nav-item">
      <a class="nav-link {{ $active==='meal-history'?'active':'' }}"
         id="meal-history-tab"
         data-bs-toggle="tab"
         href="#meal-history"
         role="tab"
         aria-controls="meal-history"
         aria-selected="{{ $active==='meal-history'?'true':'false' }}">
        Meal History
      </a>
    </li>
  </ul>

  <!-- Tab panes -->
  <div class="tab-content mt-4" id="dietaryTabContent">

    <!-- 1) Resident Preferences -->
    <div class="tab-pane fade {{ $active==='preferences'?'show active':'' }}"
         id="resident-preferences"
         role="tabpanel"
         aria-labelledby="resident-preferences-tab">
      <h5 class="mb-3">Resident Preferences</h5>
      <div class="row g-4">
        @foreach($residents as $resident)
          <div class="col-12 col-md-6">
            <div class="card h-100 shadow-sm">
              <div class="card-header bg-primary text-white">
                <h6 class="mb-0">{{ $resident->full_name }}</h6>
                <small>Room {{ $resident->roomnumber }}</small>
              </div>
              <div class="card-body">
                <p><strong>Allergies:</strong> {{ $resident->allergies ?? 'None' }}</p>
                <p><strong>Food Restrictions:</strong> {{ $resident->dietaryRestrictions->foodrestrictions ?? 'None' }}</p>
                <p><strong>Food Preferences:</strong> {{ $resident->dietaryRestrictions->foodpreferences ?? 'None' }}</p>
                <p><strong>Notes:</strong> {{ $resident->dietaryRestrictions->notes ?? 'None' }}</p>
              </div>
            </div>
          </div>
        @endforeach
      </div>
    </div>

    <!-- 2) Allergies Lookup -->
    <div class="tab-pane fade {{ $active==='allergies'?'show active':'' }}"
         id="resident-allergies"
         role="tabpanel"
         aria-labelledby="resident-allergies-tab">
      @include('dietary.allergies')
    </div>

    <!-- 3) Meal Planning -->
<div class="tab-pane fade {{ $active==='meal-plan'?'show active':'' }}"
     id="meal-plan" role="tabpanel" aria-labelledby="meal-plan-tab">

  <h5 class="mb-3">Meal Plan</h5>

  <form action="{{ route('dietary.storeMealPlan') }}" method="POST" id="mealPlanForm">
    @csrf
    <div class="row g-3 mb-3">
      {{-- Select Resident --}}
      <div class="col-md-4">
        <label class="form-label">Resident</label>
        <select name="resident_id" class="form-select" id="residentSelect">
          <option value="">— Choose —</option>
          @foreach($residents as $r)
            <option value="{{ $r->id }}"
              {{ (old('resident_id',$selectedResident??'')==$r->id)?'selected':'' }}>
              {{ $r->full_name }}
            </option>
          @endforeach
        </select>
      </div>
      {{-- Choose Date --}}
      <div class="col-md-4">
        <label class="form-label">Date</label>
        <input type="date" name="plan_date" class="form-control"
          value="{{ old('plan_date',$planDate??today()->toDateString()) }}">
      </div>
    </div>

    {{-- Search & Add Meals --}}
    <div class="input-group mb-3">
      <input type="text" id="mealSearch" class="form-control"
             placeholder="Search food to add…">
      <button type="button" class="btn btn-outline-secondary"
              id="addMealBtn">➕ Add</button>
    </div>

    {{-- Current meals list --}}
    <ul class="list-group mb-3" id="mealList">
      @foreach($meals as $item)
        <li class="list-group-item d-flex justify-content-between align-items-center">
          <span>{{ $item['name'] }} × {{ $item['qty'] }}</span>
          <button type="button" class="btn btn-sm btn-outline-danger remove-meal">&times;</button>
          <input type="hidden" name="meals[][name]" value="{{ $item['name'] }}">
          <input type="hidden" name="meals[][qty]"  value="{{ $item['qty'] }}">
        </li>
      @endforeach
    </ul>

    <button class="btn btn-success">Save Meal Plan</button>
  </form>
</div>

{{-- And include somewhere after closing tags: --}}
@push('scripts')
<script>
// Simple in‑page meal add/remove logic
document.getElementById('addMealBtn').onclick = () => {
  const name = document.getElementById('mealSearch').value.trim();
  if (!name) return alert('Enter a meal name.');
  const qty  = 1;
  const list = document.getElementById('mealList');

  // create list item
  const li = document.createElement('li');
  li.className = 'list-group-item d-flex justify-content-between align-items-center';

  li.innerHTML = `
    <span>${name} × ${qty}</span>
    <button type="button" class="btn btn-sm btn-outline-danger remove-meal">&times;</button>
    <input type="hidden" name="meals[][name]" value="${name}">
    <input type="hidden" name="meals[][qty]"  value="${qty}">
  `;

  list.appendChild(li);
  document.getElementById('mealSearch').value = '';
};

// delegate remove
document.getElementById('mealList').addEventListener('click', e => {
  if (e.target.matches('.remove-meal')) {
    e.target.closest('li').remove();
  }
});
</script>
@endpush


    <!-- 4) Food Search Results -->
    <div class="tab-pane fade {{ $active==='food-search'?'show active':'' }}"
         id="food-search"
         role="tabpanel"
         aria-labelledby="food-search-tab">
      <h5 class="mb-3">Food Search Results</h5>
      @if(count($foodItems))
        <ul class="list-unstyled">
          @foreach($foodItems as $food)
            <li class="mb-4">
              <h6>{{ $food['name'] ?? 'Unknown' }}</h6>
              @if(!empty($food['image']))
                <img src="https://spoonacular.com/cdn/ingredients_100x100/{{ $food['image'] }}"
                     alt="{{ $food['name'] }}"
                     class="img-thumbnail mb-2">
              @endif
              <p>{{ $food['description'] ?? 'No description available.' }}</p>
            </li>
          @endforeach
        </ul>
      @else
        <p class="text-muted">No food items found.</p>
      @endif
    </div>

    <!-- 5) Meal History -->
    <div class="tab-pane fade {{ $active==='meal-history'?'show active':'' }}"
         id="meal-history"
         role="tabpanel"
         aria-labelledby="meal-history-tab">
      <h5 class="mb-3">Meal History</h5>
      <p class="text-muted">No meal history available.</p>
    </div>
  </div>
</div>
@endsection

