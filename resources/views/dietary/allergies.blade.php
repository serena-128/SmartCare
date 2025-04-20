
<div class="p-3">
  {{-- Search form --}}
  <form action="{{ route('dietary.searchAllergy') }}" method="GET" class="mb-4">
    <div class="input-group">
      <input type="text"
             name="allergy"
             class="form-control"
             placeholder="e.g. Gluten, Peanuts…"
             value="{{ request('allergy') }}">
      <button class="btn btn-primary">Lookup</button>
    </div>
    @error('allergy')
      <div class="text-danger mt-1">{{ $message }}</div>
    @enderror
  </form>

  {{-- Display results if we have them --}}
  @if(! is_null($allergyInfo))
    <div class="card mb-4">
      @if($allergyInfo['thumbnail'])
        <img src="{{ $allergyInfo['thumbnail'] }}"
             class="card-img-top"
             style="max-height:200px; object-fit:cover">
      @endif
      <div class="card-body">
        <h5 class="card-title">{{ $allergyInfo['title'] }}</h5>
        <p class="card-text">{{ $allergyInfo['extract'] }}</p>
        @if($allergyInfo['url'])
          <a href="{{ $allergyInfo['url'] }}" target="_blank" class="btn btn-outline-secondary">
            Read more on Wikipedia
          </a>
        @endif
      </div>
    </div>
  @endif
</div>
