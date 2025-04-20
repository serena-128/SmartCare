@extends('layouts.app')

@section('content')
<style>
  /* make recipe cards wider but cap their height */
  #recipe-search .recipe-card {
    max-width: 600px;
    height: 280px;
    overflow: hidden;
  }

  /* shrink the top image */
  #recipe-search .recipe-card .card-img-top {
    height: 120px;
    object-fit: cover;
    width: 100%;
  }

  /* let the body scroll if it overflows */
  #recipe-search .recipe-card .card-body {
    height: calc(280px - 120px);
    overflow-y: auto;
  }
</style>
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
<!-- Meal Planning as Calendar -->
<div class="tab-pane fade {{ $active==='meal-plan'?'show active':'' }}"
     id="meal-plan" role="tabpanel" aria-labelledby="meal-plan-tab">

  <div class="mb-3 d-flex align-items-center">
    <label for="residentSelect" class="me-2">Resident:</label>
    <select id="residentSelect" class="form-select w-auto">
      <option value="">— choose resident —</option>
      @foreach($residents as $r)
        <option value="{{ $r->id }}"
          {{ $selectedResident == $r->id ? 'selected' : '' }}>
          {{ $r->full_name }}
        </option>
      @endforeach
    </select>
  </div>

  <div id="mealCalendar"></div>
</div>

<!-- Modal for adding a meal entry -->
<!-- Modal for adding a meal entry -->
<div class="modal fade" id="addMealModal" tabindex="-1" aria-hidden="true">
  <div class="modal-dialog">
    <form id="addMealForm">
      @csrf
      <input type="hidden" name="resident_id" id="modalResident">
      <input type="hidden" name="plan_date"   id="modalDate">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title">Add Meal Entry</h5>
          <button type="button" class="btn-close"
                  data-bs-dismiss="modal"></button>
        </div>
        <div class="modal-body">
          <div class="mb-3">
            <label for="modalCategory" class="form-label">Category</label>
            <select id="modalCategory" name="category"
                    class="form-select" required>
              <option value="breakfast">Breakfast</option>
              <option value="lunch">Lunch</option>
              <option value="dinner">Dinner</option>
              <option value="snacks">Snacks</option>
              <option value="treats">Treats</option>
            </select>
          </div>
          <div class="mb-3">
            <label for="modalName" class="form-label">
              Item Name(s) <small class="text-muted">(comma‑separate)</small>
            </label>
            <input id="modalName" name="name" type="text"
                   class="form-control" placeholder="e.g. Tea, Toast, Orange Juice"
                   required>
          </div>
            <div class="mb-3">
              <label for="modalTime" class="form-label">Time</label>
              <input id="modalTime" name="time" type="time" class="form-control">
            </div>

          <!-- wrap qty so we can toggle it -->
          <div class="mb-3" id="qtyWrapper">
            <label for="modalQty" class="form-label">Quantity</label>
            <input id="modalQty" name="quantity" type="number"
                   min="1" value="1" class="form-control">
          </div>

        </div>
        <div class="modal-footer">
          <button type="submit" class="btn btn-primary">Add</button>
          <button type="button" class="btn btn-secondary"
                  data-bs-dismiss="modal">Cancel</button>
        </div>
      </div>
    </form>
  </div>
</div>




<!-- 4) Food Search Results -->
<div
  class="tab-pane fade {{ $active==='food-search' ? 'show active' : '' }}"
  id="food-search"
  role="tabpanel"
  aria-labelledby="food-search-tab"
>
  <h5 class="mb-3">Food Search Results</h5>

  <form method="GET" action="{{ route('dietary.searchOff') }}" class="mb-4">
    <div class="input-group">
      <input
        type="text"
        name="food_item"
        class="form-control"
        placeholder="Search foods (e.g. apple)"
        value="{{ request('food_item') }}"
      >
      <button class="btn btn-primary" type="submit">Search</button>
    </div>
  </form>

  @if(count($foodItems ?? []))
    <div class="row g-4">
      @foreach($foodItems as $i => $food)
        <div class="col-12 col-sm-6 col-md-4">
          <div class="card h-100">
            {{-- clickable image + title --}}
            @if(!empty($food['image_front_small_url']))
              <img
                src="{{ $food['image_front_small_url'] }}"
                class="card-img-top"
                alt="{{ $food['product_name'] }}"
                style="height:150px; object-fit:contain; cursor:pointer;"
                onclick="toggleDetails({{ $i }})"
              >
            @endif
            <div class="card-body text-center py-2" onclick="toggleDetails({{ $i }})" style="cursor:pointer;">
              <h6 class="card-title mb-0">{{ $food['product_name'] ?? 'Unknown' }}</h6>
            </div>

            {{-- collapse panel for details --}}
            <div class="collapse" id="food-details-{{ $i }}">
              <div class="card-body border-top text-start">
                @if(!empty($food['brands']))
                  <p class="mb-1"><strong>Brand:</strong> {{ $food['brands'] }}</p>
                @endif

                @if(!empty($food['generic_name']))
                  <p class="mb-1"><strong>Description:</strong> {{ $food['generic_name'] }}</p>
                @endif

                {{-- Ingredients --}}
                @php
                  $ingredients = collect($food['ingredients'] ?? [])
                                   ->pluck('text')
                                   ->filter()
                                   ->toArray();
                  if (empty($ingredients) && !empty($food['ingredients_text'])) {
                    $ingredients = array_map('trim', explode(',', $food['ingredients_text']));
                  }
                @endphp
                @if(count($ingredients))
                  <p class="mb-1"><strong>Ingredients:</strong></p>
                  <ul class="ps-3 mb-2" style="max-height: 80px; overflow:auto;">
                    @foreach($ingredients as $ing)
                      <li>{{ $ing }}</li>
                    @endforeach
                  </ul>
                @endif

                {{-- Energy values --}}
                @php
                  $energies = collect($food['nutriments'] ?? [])
                    ->filter(function($val,$key){
                      return Str::contains($key,'energy');
                    })
                    ->map(function($val,$key){
                      return ['label'=>ucfirst(str_replace('_',' ',$key)),'value'=>$val];
                    })
                    ->values();
                @endphp
                @if($energies->isNotEmpty())
                  <p class="mb-1"><strong>Energy (per 100 g):</strong></p>
                  <ul class="ps-3 mb-0">
                    @foreach($energies as $e)
                      <li>{{ $e['label'] }}: {{ $e['value'] }} kcal</li>
                    @endforeach
                  </ul>
                @endif
              </div>
            </div>
          </div>
        </div>
      @endforeach
    </div>
  @else
    <p class="text-muted">No food items found.</p>
  @endif
</div>

@push('scripts')
<script>
  function toggleDetails(i) {
    const el = document.getElementById(`food-details-${i}`);
    bootstrap.Collapse.getOrCreateInstance(el).toggle();
  }
</script>
@endpush





    <!-- 5) Recipe Search -->
    <div class="tab-pane fade {{ $active==='recipe-search' ? 'show active' : '' }}"
         id="recipe-search"
         role="tabpanel"
         aria-labelledby="recipe-search-tab">

      <form class="mb-4" method="GET" action="{{ route('dietary.searchRecipe') }}">
        <input type="hidden" name="resident_id" value="{{ $selectedResident }}">
        <input type="hidden" name="plan_date"   value="{{ $planDate }}">
        <div class="input-group">
          <input
            type="text"
            name="recipe"
            class="form-control"
            placeholder="Search recipes (e.g. lasagna)"
            value="{{ request('recipe') }}"
          >
          <button class="btn btn-primary" type="submit">Search</button>
        </div>
      </form>

      @if(count($recipes))
        <div id="recipeCarousel" class="carousel slide" data-bs-interval="false">
          <div class="carousel-inner">
            @foreach($recipes as $i => $r)
              <div class="carousel-item {{ $i===0 ? 'active' : '' }}">
                <div class="card mx-auto" style="max-width:400px;">
                  @if(!empty($r['image']))
                    <img src="{{ $r['image'] }}"
                         class="card-img-top"
                         alt="{{ $r['title'] }}">
                  @endif
                  <div class="card-body">
                    <h5 class="card-title">{{ $r['title'] }}</h5>
                    <p class="card-text">{!! $r['summary'] ?? 'No summary available.' !!}</p>

                    <button class="btn btn-sm btn-outline-secondary mt-2"
                            type="button"
                            data-bs-toggle="collapse"
                            data-bs-target="#details-{{ $r['id'] }}"
                            aria-expanded="false"
                            aria-controls="details-{{ $r['id'] }}">
                      Toggle details
                    </button>

                    <div class="collapse mt-3" id="details-{{ $r['id'] }}">
                      <h6>Ingredients</h6>
                      <ul class="ps-3">
                        @foreach($r['extendedIngredients'] ?? [] as $ing)
                          <li>{{ $ing['original'] }}</li>
                        @endforeach
                      </ul>

                      <h6>Instructions</h6>
                      <p>{!! $r['instructions'] ?? 'No instructions available.' !!}</p>

                      <h6>Dietary Flags</h6>
                      <ul class="list-unstyled">
                        <li><strong>Dish types:</strong> {{ implode(', ', $r['dishTypes'] ?? []) }}</li>
                        <li><strong>Diets:</strong>      {{ implode(', ', $r['diets']      ?? []) }}</li>
                        <li><strong>Gluten‑free:</strong> {{ $r['glutenFree'] ? 'Yes' : 'No' }}</li>
                        <li><strong>Vegan:</strong>       {{ $r['vegan']      ? 'Yes' : 'No' }}</li>
                      </ul>
                    </div>
                  </div>
                </div>
              </div>
            @endforeach
          </div>

          <div class="d-flex justify-content-center gap-2 mt-3">
            <button class="btn btn-secondary"
                    type="button"
                    data-bs-target="#recipeCarousel"
                    data-bs-slide="prev">
              ← Previous
            </button>
            <button class="btn btn-secondary"
                    type="button"
                    data-bs-target="#recipeCarousel"
                    data-bs-slide="next">
              Next →
            </button>
          </div>
        </div>
      @else
        <p class="text-muted">No recipes found for “{{ request('recipe') }}.”</p>
      @endif

    </div>

  <!-- Recipe Search Tab -->
<!-- Recipe Search Tab -->
<div
  class="tab-pane fade {{ $active==='recipe-search' ? 'show active' : '' }}"
  id="recipe-search"
  role="tabpanel"
  aria-labelledby="recipe-search-tab"
>
  <!-- Search form -->
  <form class="mb-4" method="GET" action="{{ route('dietary.searchRecipe') }}">
    <input type="hidden" name="resident_id" value="{{ $selectedResident }}">
    <input type="hidden" name="plan_date"   value="{{ $planDate }}">
    <div class="input-group">
      <input
        type="text"
        name="recipe"
        class="form-control"
        placeholder="Search recipes (e.g. lasagna)"
        value="{{ request('recipe') }}"
      >
      <button class="btn btn-primary" type="submit">Search</button>
    </div>
  </form>

  @if(count($recipes))
    <div
      id="recipeCarousel"
      class="carousel slide"
      data-bs-interval="false"
    >
      <div class="carousel-inner">
        @foreach($recipes as $i => $r)
          <div class="carousel-item {{ $i===0 ? 'active' : '' }}">
            <div class="card mx-auto" style="max-width:400px;">
              @if(!empty($r['image']))
                <img
                  src="{{ $r['image'] }}"
                  class="card-img-top"
                  alt="{{ $r['title'] }}"
                >
              @endif
              <div class="card-body">
                <h5 class="card-title">{{ $r['title'] }}</h5>
                <p class="card-text">{!! $r['summary'] ?? 'No summary available.' !!}</p>

                <button
                  class="btn btn-sm btn-outline-secondary mt-2"
                  type="button"
                  data-bs-toggle="collapse"
                  data-bs-target="#details-{{ $r['id'] }}"
                  aria-expanded="false"
                  aria-controls="details-{{ $r['id'] }}"
                >
                  Toggle details
                </button>

                <div class="collapse mt-3" id="details-{{ $r['id'] }}">
                  <h6>Ingredients</h6>
                  <ul class="ps-3">
                    @foreach($r['extendedIngredients'] ?? [] as $ing)
                      <li>{{ $ing['original'] }}</li>
                    @endforeach
                  </ul>

                  <h6>Instructions</h6>
                  <p>{!! $r['instructions'] ?? 'No instructions available.' !!}</p>

                  <h6>Dietary Flags</h6>
                  <ul class="list-unstyled">
                    <li><strong>Dish types:</strong> {{ implode(', ', $r['dishTypes'] ?? []) }}</li>
                    <li><strong>Diets:</strong>      {{ implode(', ', $r['diets']      ?? []) }}</li>
                    <li><strong>Gluten‑free:</strong> {{ !empty($r['glutenFree']) ? 'Yes' : 'No' }}</li>
                    <li><strong>Vegan:</strong>      {{ !empty($r['vegan'])      ? 'Yes' : 'No' }}</li>
                  </ul>
                </div>
              </div>
            </div>
          </div>
        @endforeach
      </div>

      <!-- Big, obvious Prev/Next buttons under the cards -->
      <div class="d-flex justify-content-center gap-2 mt-3">
        <button
          class="btn btn-secondary"
          type="button"
          data-bs-target="#recipeCarousel"
          data-bs-slide="prev"
        >
          ← Previous
        </button>
        <button
          class="btn btn-secondary"
          type="button"
          data-bs-target="#recipeCarousel"
          data-bs-slide="next"
        >
          Next →
        </button>
      </div>
    </div>
  @else
    <p class="text-muted">No recipes found for “{{ request('recipe') }}.”</p>
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

@push('scripts')
<!-- SweetAlert2 CDN -->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script>
document.addEventListener('DOMContentLoaded', function() {
  const calendarEl   = document.getElementById('mealCalendar');
  const addModal     = new bootstrap.Modal(document.getElementById('addMealModal'));
  const form         = document.getElementById('addMealForm');
  const catSelect    = document.getElementById('modalCategory');
  const qtyWrapper   = document.getElementById('qtyWrapper');
  let calendar;

  function toggleQtyField() {
    const cat = catSelect.value;
    qtyWrapper.style.display = (cat === 'snacks' || cat === 'treats') ? 'block' : 'none';
  }
  catSelect.addEventListener('change', toggleQtyField);

  function initCalendar(residentId) {
    if (calendar) calendar.destroy();

    calendar = new FullCalendar.Calendar(calendarEl, {
      initialView: 'dayGridMonth',
      initialDate: new Date(),
      validRange: { start: new Date() },
      headerToolbar: {
        left: 'prev,next today',
        center: 'title',
        right: ''
      },
      events: {
        url: '/dietary/calendar',
        extraParams: { resident_id: residentId }
      },
      dateClick: function(info) {
        if (!residentId) return alert('Please pick a resident first.');
        document.getElementById('modalResident').value = residentId;
        document.getElementById('modalDate').value = info.dateStr;
        form.reset();
        toggleQtyField();
        addModal.show();
      },
      eventContent: function(arg) {
        const category = arg.event.extendedProps.category;
        const icons = {
          breakfast: '🍳',
          lunch:     '🥪',
          dinner:    '🍝',
          snacks:    '🍎',
          treats:    '🍩'
        };
        const icon = icons[category] || '';
        return { html: `<div class="fc-event-title">${icon} ${arg.event.title}</div>` };
      },
      eventDidMount: function(info) {
        const colors = {
          breakfast: '#FFE29A',
          lunch:     '#A1E3D8',
          dinner:    '#FFB4A2',
          snacks:    '#BFD7ED',
          treats:    '#DDBDD5'
        };
        const category = info.event.extendedProps.category;
        info.el.style.backgroundColor = colors[category] || '#f8f9fa';
      },
      eventClick: function(info) {
        const meal = info.event.extendedProps;
        const details = `
          <strong>Category:</strong> ${meal.category}<br>
          <strong>Items:</strong> ${meal.meals}<br>
          <strong>Time:</strong> ${meal.time || 'N/A'}<br>
          <strong>Quantity:</strong> ${meal.quantity || 'N/A'}
        `;
        Swal.fire({
          title: info.event.title,
          html: details,
          showCancelButton: true,
          confirmButtonText: 'Edit',
          cancelButtonText: 'Close'
        }).then((result) => {
          if (result.isConfirmed) {
            window.location.href = `/dietary/meal-plans/${info.event.id}/edit`;
          }
        });
      }
    });

    calendar.render();
  }

  // Event listeners
  document.getElementById('residentSelect').addEventListener('change', e => {
    initCalendar(e.target.value);
  });

  initCalendar(document.getElementById('residentSelect').value);

  form.addEventListener('submit', async function(e) {
    e.preventDefault();

    const payload = {
      resident_id: form.resident_id.value,
      plan_date:   form.plan_date.value,
      category:    form.category.value,
      meals:       form.name.value,
      time:        form.time?.value || null,
      quantity:    ['snacks','treats'].includes(form.category.value)
                   ? parseInt(form.quantity.value) || 1
                   : null
    };

    try {
      const resp = await fetch("{{ route('dietary.meal-plans.store') }}", {
        method: 'POST',
        headers: {
          'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
          'Content-Type': 'application/json'
        },
        body: JSON.stringify(payload)
      });

      if (resp.ok) {
        addModal.hide();
        calendar.refetchEvents();
      } else {
        const error = await resp.text();
        console.error(error);
        alert("Error: couldn't save meal. Check console.");
      }
    } catch (err) {
      console.error(err);
      alert("An unexpected error occurred.");
    }
  });
});
</script>
@endpush
