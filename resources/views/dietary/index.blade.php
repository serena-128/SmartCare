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
  <a class="nav-link {{ $activeTab==='recipe-search'?'active':'' }}"
     id="recipe-search-tab"
     data-bs-toggle="tab"
     href="#recipe-search"
     role="tab"
     aria-controls="recipe-search"
     aria-selected="{{ $activeTab==='recipe-search'?'true':'false' }}">
    Recipe Search
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
<div class="tab-pane fade {{ session('activeTab','preferences')=='meal-plan'?'show active':'' }}"
     id="meal-plan" role="tabpanel">

  <form id="planHeader" class="row g-2 mb-3">
    <div class="col-md-4">
      <select id="residentSelect" class="form-select" name="resident_id">
        <option value="">— Choose resident —</option>
        @foreach($residents as $r)
          <option value="{{ $r->id }}"
            {{ optional($resident)->id==$r->id?'selected':'' }}>
            {{ $r->full_name }}
          </option>
        @endforeach
      </select>
    </div>
    <div class="col-md-3">
      <input type="date" name="plan_date" id="planDate" class="form-control"
             value="{{ $planDate }}">
    </div>
  </form>

  @php
    $categories = ['breakfast','lunch','dinner','snacks','treats'];
  @endphp

  <div class="row">
    @foreach($categories as $cat)
      <div class="col-md-4 mb-4">
        <div class="card h-100">
          <div class="card-header text-capitalize bg-secondary text-white">
            {{ str_replace('-', ' ', $cat) }}
          </div>
          <ul class="list-group list-group-flush" id="{{ $cat }}List">
            @foreach($entriesByCat[$cat] ?? [] as $e)
              <li class="list-group-item d-flex justify-content-between align-items-center"
                  data-id="{{ $e['id'] }}">
                <div>
                  {{ $e['name'] }} × {{ $e['quantity'] }}
                </div>
                <div class="btn-group btn-group-sm">
                  @foreach(['none'=>'⚪','some'=>'🟡','all'=>'🟢'] as $status=>$icon)
                    <button type="button"
                            data-status="{{ $status }}"
                            class="btn btn-outline-dark mark-consumed
                              {{ $e['consumed']==$status?'active':'' }}">
                      {{ $icon }}
                    </button>
                  @endforeach
                  <button type="button"
                          class="btn btn-outline-danger remove-entry">
                    ✖
                  </button>
                </div>
              </li>
            @endforeach
          </ul>
          <div class="card-footer">
            <div class="input-group input-group-sm">
              <input type="text" class="form-control new-name"
                     placeholder="Add item…">
              <input type="number" class="form-control new-qty"
                     value="1" min="1" style="max-width:60px">
              <button class="btn btn-primary add-entry" data-cat="{{ $cat }}">
                ➕
              </button>
            </div>
          </div>
        </div>
      </div>
    @endforeach
  </div>
</div>

@push('scripts')
<script>
  const token = document.querySelector('meta[name="csrf-token"]').content;

  // helpers
  const apiUrl     = url => '/dietary/entry'+url;
  const getHeader  = () => ({
    headers: {
      'X-CSRF-TOKEN': token,
      'Accept': 'application/json',
      'Content-Type': 'application/json'
    }
  });
  const selectedResident = () => document.getElementById('residentSelect').value;
  const planDate         = () => document.getElementById('planDate').value;

  // add entry
  document.querySelectorAll('.add-entry').forEach(btn =>
    btn.onclick = async e => {
      e.preventDefault();
      const cat = btn.dataset.cat;
      const cont = btn.closest('.card');
      const name = cont.querySelector('.new-name').value.trim();
      const qty  = parseInt(cont.querySelector('.new-qty').value,10);
      if (! name || ! selectedResident()) return;
      const body = JSON.stringify({
        resident_id: selectedResident(),
        plan_date:   planDate(),
        category:    cat,
        name, qty
      });
      const resp = await fetch(apiUrl(''), {
        method: 'POST', ...getHeader(), body
      });
      const j = await resp.json();
      // append to list
      const ul = document.getElementById(cat+'List');
      const li = document.createElement('li');
      li.className = 'list-group-item d-flex justify-content-between align-items-center';
      li.dataset.id = j.id;
      li.innerHTML = `
        <div>${j.name} × ${j.quantity}</div>
        <div class="btn-group btn-group-sm">
          <button data-status="none"  class="btn btn-outline-dark mark-consumed active">⚪</button>
          <button data-status="some"  class="btn btn-outline-dark mark-consumed">🟡</button>
          <button data-status="all"   class="btn btn-outline-dark mark-consumed">🟢</button>
          <button class="btn btn-outline-danger remove-entry">✖</button>
        </div>`;
      ul.appendChild(li);
      cont.querySelector('.new-name').value = '';
    }
  );

  // delegate: remove or toggle consumed
  document.querySelector('.tab-pane#meal-plan').addEventListener('click', async e => {
    // remove
    if (e.target.matches('.remove-entry')) {
      const li = e.target.closest('li');
      const id = li.dataset.id;
      await fetch(apiUrl('/'+id), {
        method:'DELETE', ...getHeader()
      });
      li.remove();
    }
    // consumed toggle
    if (e.target.matches('.mark-consumed')) {
      const btn    = e.target;
      const li     = btn.closest('li');
      const id     = li.dataset.id;
      const status = btn.dataset.status;
      // update visuals
      li.querySelectorAll('.mark-consumed').forEach(b=>b.classList.remove('active'));
      btn.classList.add('active');
      // send
      await fetch(apiUrl('/'+id), {
        method:'PATCH',
        ...getHeader(),
        body: JSON.stringify({ consumed: status })
      });
    }
  });

  // when user changes resident or date, reload with query params
  document.getElementById('planHeader').addEventListener('change', () => {
    const rid = selectedResident();
    const dt  = planDate();
    if (! rid) return;
    location.href = `?resident_id=${rid}&plan_date=${dt}&activeTab=meal-plan`;
  });
</script>
@endpush


    <!-- 4) Food Search Results -->
    <div class="tab-pane fade {{ $active==='food-search'?'show active':'' }}"
         id="food-search"
         role="tabpanel"
         aria-labelledby="food-search-tab">
      <h5 class="mb-3">Food Search Results</h5>
      @if(count($foodItems ?? []))

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
      
      <!-- Recipe Search Tab -->
<div class="tab-pane fade {{ $activeTab==='recipe-search'?'show active':'' }}"
     id="recipe-search"
     role="tabpanel"
     aria-labelledby="recipe-search-tab">

  {{-- Search form --}}
  <form class="mb-3" method="GET" action="{{ route('dietary.searchRecipe') }}">
    {{-- preserve resident & date --}}
    <input type="hidden" name="resident_id"  value="{{ $selectedResident }}">
    <input type="hidden" name="plan_date"    value="{{ $planDate }}">

    <div class="input-group">
      <input
        type="text"
        name="recipe"
        class="form-control"
        placeholder="Search recipes (e.g. lasagna)"
        value="{{ request('recipe') }}"
      >
      <button class="btn btn-primary">Search</button>
    </div>
  </form>

  @if(! empty($recipes))
    @foreach($recipes as $r)
      <div class="card mb-4">
        <img
          src="{{ $r['image'] }}"
          class="card-img-top"
          alt="{{ $r['title'] }}"
        >
        <div class="card-body">
          <h5 class="card-title">{{ $r['title'] }}</h5>

          {{-- Summary --}}
            <p>{!! $r['summary'] ?? 'No summary available.' !!}</p>


          {{-- Ingredients --}}
        <p><strong>Ingredients:</strong></p>
        <ul>
          @foreach($r['extendedIngredients'] ?? [] as $ing)
            <li>{{ $ing['original'] }}</li>
          @endforeach
        </ul>


          {{-- Instructions --}}
        <p><strong>Instructions:</strong></p>
        <p>{!! $r['instructions'] ?? 'No instructions available.' !!}</p>


          {{-- Dietary flags --}}
            <p>
              <strong>Dish types:</strong> {{ implode(', ', $r['dishTypes'] ?? []) }}<br>
              <strong>Diets:</strong> {{ implode(', ', $r['diets'] ?? []) }}<br>
              <strong>Gluten‑free:</strong> {{ ($r['glutenFree'] ?? false) ? 'Yes' : 'No' }}<br>
              <strong>Vegan:</strong>      {{ ($r['vegan']      ?? false) ? 'Yes' : 'No' }}
            </p>

        </div>
      </div>
    @endforeach
  @elseif(request()->has('recipe'))
    <p class="text-warning">
      No recipes found for “{{ request('recipe') }}.”
    </p>
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

