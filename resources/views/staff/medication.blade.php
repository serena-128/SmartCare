@extends('layouts.app')

@section('content')
@php
    use Illuminate\Support\Str;

    $activeTab = request()->has('drugName') ? 'lookup' : 'residents';

    function clean($text, $keyword) {
        $text = preg_replace('/[\x{200B}\x{00A0}]/u', '', $text);
        $text = trim($text);
        return preg_replace('/^' . preg_quote($keyword, '/') . '[:\s]*/i', '', $text);
    }

    function highlightWarnings($text) {
        $keywords = [
            'heart attack',
            'stroke',
            'allergic reaction',
            'bleeding',
            'vomit blood',
            'faint',
            'bloody or black stools',
            'liver damage',
            'rash',
            'skin reaction',
            'seek medical help',
            'stop use',
            'overdose',
        ];

        foreach ($keywords as $word) {
            $pattern = '/' . preg_quote($word, '/') . '/i';
            $text = preg_replace($pattern, '<strong class="text-danger">⚠️ $0</strong>', $text);
        }

        return $text;
    }
@endphp

<div class="d-flex justify-content-end mb-3">
    <button class="btn btn-outline-dark position-relative" id="toggleCart">
        🛒 Cart
        <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger" id="cartCount">
            {{ session('cart') ? count(session('cart')) : 0 }}
        </span>
    </button>
</div>

<h2 class="mb-4">💊 Medication Center</h2>

<!-- Tabs -->
<!-- Tabs -->
<ul class="nav nav-tabs" id="medTab" role="tablist">
    <li class="nav-item">
        <a class="nav-link {{ $activeTab === 'residents' ? 'active' : '' }}" data-bs-toggle="tab" href="#residents" role="tab">🧑‍⚕️ Resident Medications</a>
    </li>
    <li class="nav-item">
        <a class="nav-link {{ $activeTab === 'lookup' ? 'active' : '' }}" data-bs-toggle="tab" href="#lookup" role="tab">🔍 Medication Lookup</a>
    </li>
    <li class="nav-item">
        <a class="nav-link {{ $activeTab === 'pharmacy' ? 'active' : '' }}" data-bs-toggle="tab" href="#pharmacy" role="tab">🏪 Pharmacy Info</a>
    </li>
</ul>



<div class="tab-content mt-4" id="medTabContent">
<!-- Resident Medications Tab -->
<div class="tab-pane fade {{ $activeTab === 'residents' ? 'show active' : '' }}" id="residents" role="tabpanel">
    @if($residents->count())
        <table class="table table-hover table-bordered align-middle">
            <thead class="table-success text-center">
                <tr>
                    <th>👤 Resident Name</th>
                    <th>💊 Medications</th>
                    <th>⚠️ Allergies</th>
                    <th>✏️ Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach($residents as $resident)
                    <tr>
                        <td class="fw-semibold">{{ $resident->firstname }} {{ $resident->lastname }}</td>

                        {{-- Medications --}}
                        <td>
                            @php $meds = array_filter(array_map('trim', explode(',', $resident->medications))); @endphp
                            @if(count($meds))
                                <ul class="list-unstyled mb-0">
                                    @foreach($meds as $med)
                                        <li><span class="badge bg-primary">{{ $med }}</span></li>
                                    @endforeach
                                </ul>
                            @else
                                <span class="text-muted">No meds listed</span>
                            @endif
                        </td>

                        {{-- Allergies --}}
                        <td>
                            @php $allergies = array_filter(array_map('trim', explode(',', $resident->allergies))); @endphp
                            @if(count($allergies))
                                <ul class="list-unstyled mb-0">
                                    @foreach($allergies as $allergy)
                                        <li><span class="badge bg-danger">{{ $allergy }}</span></li>
                                    @endforeach
                                </ul>
                            @else
                                <span class="text-muted">No allergies listed</span>
                            @endif
                        </td>

                        {{-- Actions --}}
                        <td class="text-center">
                            <button class="btn btn-outline-success btn-sm" data-bs-toggle="modal" data-bs-target="#editModal{{ $resident->id }}">Edit</button>
                        </td>
                    </tr>

                    {{-- Modal for editing meds/allergies --}}
                    <div class="modal fade" id="editModal{{ $resident->id }}" tabindex="-1" aria-labelledby="editLabel{{ $resident->id }}" aria-hidden="true">
                        <div class="modal-dialog">
                            <form method="POST" action="{{ route('residents.updateMedications', $resident->id) }}">
                                @csrf
                                @method('PUT')
                                <div class="modal-content">
                                    <div class="modal-header bg-info text-white">
                                        <h5 class="modal-title" id="editLabel{{ $resident->id }}">Edit {{ $resident->firstname }}'s Info</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                    </div>
                                    <div class="modal-body">
                                        <label class="form-label">Medications (comma-separated):</label>
                                        <input type="text" name="medications" class="form-control mb-3" value="{{ $resident->medications }}">

                                        <label class="form-label">Allergies (comma-separated):</label>
                                        <input type="text" name="allergies" class="form-control" value="{{ $resident->allergies }}">
                                    </div>
                                    <div class="modal-footer">
                                        <button type="submit" class="btn btn-success">Save</button>
                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                @endforeach
            </tbody>
        </table>
    @else
        <p class="text-muted">No resident data available.</p>
    @endif
</div>

    <!-- Medication Lookup Tab -->
    <div class="tab-pane fade {{ $activeTab === 'lookup' ? 'show active' : '' }}" id="lookup" role="tabpanel">
        <form method="GET" action="{{ url('/staff/medication-search') }}" class="mb-3">
            <div class="input-group">
                <input type="text" name="drugName" class="form-control"
                    placeholder="Enter medication name..." value="{{ old('drugName', $drugName ?? '') }}">
                <button type="submit" class="btn btn-primary">Search</button>
            </div>
        </form>

        @if($drugData)
            <div class="card">
                <div class="card-header bg-success text-white">
                    <strong>✅ {{ $drugName }}</strong>
                </div>
                <div class="card-body">
                    @if(isset($drugData['indications_and_usage']))
                        <p><strong>Usage:</strong></p>
                        <p>{{ clean($drugData['indications_and_usage'][0], 'Uses') }}</p>
                    @endif

                    @if(isset($drugData['dosage_and_administration']))
                        <p><strong>Dosage:</strong></p>
                        <ul>
                            @foreach(preg_split('/\r\n|\n|\r/', clean($drugData['dosage_and_administration'][0], 'Directions')) as $line)
                                @if(Str::length(trim($line)) > 0)
                                    <li>{{ $line }}</li>
                                @endif
                            @endforeach
                        </ul>
                    @endif

                    @if(isset($drugData['warnings']))
                        <p><strong>Warnings:</strong></p>
                        <div class="alert alert-danger">
                            {!! highlightWarnings(clean($drugData['warnings'][0], 'Warnings')) !!}
                        </div>
                    @endif
                </div>
            </div>
        @elseif(request()->has('drugName'))
            <div class="alert alert-warning">
                No results found for <strong>{{ $drugName }}</strong>.
            </div>
        @endif
    </div>

    <!-- Pharmacy Tab -->
    <div class="tab-pane fade" id="pharmacy" role="tabpanel">
        <h4 class="mb-3">🛍 Available Medications</h4>

        @if(session('success'))
    <script>
        Swal.fire({
            title: 'Order Placed!',
            text: '{{ session('success') }}',
            icon: 'success',
            confirmButtonColor: '#28a745'
        }).then(() => {
            // Optional: reload page after confirming
            location.href = window.location.pathname + "#pharmacy";
            location.reload();
        });
    </script>
@endif


    <table class="table table-bordered">
    <thead>
        <tr>
            <th>Product</th>
            <th>In Stock</th>
            <th>Price</th>
            <th>Quantity</th>
        </tr>
    </thead>
    <tbody>
        @foreach($products as $product)
        <tr>
            <td>{{ $product->name }}</td>
            <td>{{ $product->stock }}</td>
            <td>€{{ number_format($product->price, 2) }}</td>
            <td>
                @if($product->stock > 0)
                    <form method="POST" action="{{ route('pharmacy.addToCart') }}">
                        @csrf
                        <input type="hidden" name="product_id" value="{{ $product->id }}">
                        <input type="number" name="quantity" value="1" min="1" max="{{ $product->stock }}" class="form-control mb-1" style="width: 80px;">
                        <button class="btn btn-sm btn-primary">Add to Cart</button>
                    </form>
                @else
                    <button class="btn btn-sm btn-secondary" disabled>Out of Stock</button>
                @endif
            </td>
        </tr>
        @endforeach
    </tbody>
</table>


        <hr>
        <h4 class="mt-4">🚚 Your Orders</h4>
        @if($orders->count())
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>Product</th>
                        <th>Qty</th>
                        <th>Status</th>
                        <th>Ordered At</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($orders->sortByDesc('created_at')->take(5) as $order)
                        <tr>
                            <td>{{ $order->product->name }}</td>
                            <td>{{ $order->quantity }}</td>
                            <td>
                                @if($order->status === 'Shipped')
                                    <span class="badge bg-success">Shipped</span>
                                @else
                                    <span class="badge bg-warning text-dark">Ordered</span>
                                @endif
                            </td>
                            <td>{{ $order->created_at->format('d M Y H:i') }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        @else
            <p>No orders yet.</p>
        @endif
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function () {
    const sidebar = document.getElementById('cartSidebar');
    const closeBtn = document.getElementById('closeCart');
    const toggleCartBtn = document.getElementById('toggleCart');

    if (toggleCartBtn && sidebar && closeBtn) {
        toggleCartBtn.addEventListener('click', function () {
            sidebar.classList.toggle('show');
        });

        closeBtn.addEventListener('click', function () {
            sidebar.classList.remove('show');
        });
    }

    // Handle Add to Cart with AJAX
    document.querySelectorAll('form[action="{{ route('pharmacy.addToCart') }}"]').forEach(form => {
        form.addEventListener('submit', function (e) {
            e.preventDefault();

            const formData = new FormData(form);

            fetch(form.action, {
                method: 'POST',
                headers: {
                    'X-CSRF-TOKEN': document.querySelector('input[name="_token"]').value,
                    'Accept': 'application/json'
                },
                body: formData
            })
            .then(res => res.json())
            .then(data => {
                if (data.count !== undefined && data.html !== undefined) {
                    document.getElementById('cartCount').innerText = data.count;
                    document.getElementById('cartContent').innerHTML = data.html;

                    // Show the clear cart button without page reload
                    const csrfToken = document.querySelector('input[name="_token"]').value;
                    document.getElementById('clearCartWrapper').innerHTML = `
                        <form method="POST" action="{{ route('pharmacy.clearCart') }}">
                            <input type="hidden" name="_token" value="${csrfToken}">
                            <button class="btn btn-danger mt-2 w-100">🗑 Clear Cart</button>
                        </form>
                    `;

                    Swal.fire({
                        title: 'Added to Cart!',
                        text: 'The item was successfully added to your cart.',
                        icon: 'success',
                        confirmButtonColor: '#28a745'
                    });
                } else {
                    console.error('Invalid JSON response:', data);
                    alert('Something went wrong! Check console.');
                }
            })
            .catch(err => {
                console.error('Fetch error:', err);
                alert('An error occurred while adding to cart.');
            });
        });
    });
});
</script>

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
    document.querySelectorAll('.medication-update-form').forEach(form => {
        form.addEventListener('submit', function (e) {
            e.preventDefault();
            Swal.fire({
                title: 'Are you sure?',
                text: "Do you want to save the changes to this resident?",
                icon: 'question',
                showCancelButton: true,
                confirmButtonColor: '#28a745',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, save it!'
            }).then((result) => {
                if (result.isConfirmed) {
                    form.submit();
                }
            });
        });
    });
</script>

<style>
    #cartSidebar {
        transition: transform 0.3s ease-in-out;
        transform: translateX(100%);
    }

    #cartSidebar.show {
        transform: translateX(0);
    }
</style>

<div id="cartSidebar" class="position-fixed top-0 end-0 bg-light border shadow p-3" style="width: 300px; height: 100vh; z-index: 1050;">
    <button class="btn-close position-absolute top-0 end-0 m-2" id="closeCart" aria-label="Close"></button>
    <h5 class="mb-3">🛒 Cart Items</h5>

    <form method="POST" action="{{ route('pharmacy.checkout') }}" class="ajax-checkout-form">

        @csrf
        <div id="cartContent">
            @if(session('cart'))
                <ul class="list-group">
                    @php $total = 0; @endphp
                    @foreach(session('cart') as $item)
                        <li class="list-group-item d-flex justify-content-between align-items-center">
                            {{ $item['name'] }} x {{ $item['quantity'] }}
                            <span>€{{ number_format($item['price'] * $item['quantity'], 2) }}</span>
                        </li>
                        @php $total += $item['price'] * $item['quantity']; @endphp
                    @endforeach
                    <li class="list-group-item text-end"><strong>Total: €{{ number_format($total, 2) }}</strong></li>
                </ul>
                <button class="btn btn-success mt-3 w-100">✔️ Checkout</button>
            @else
                <p>Your cart is empty.</p>
            @endif
        </div>
{{-- Cart Sidebar Bottom Section --}}
</form>

<div id="clearCartWrapper">
    @if(session('cart'))
        <form method="POST" action="{{ route('pharmacy.clearCart') }}" class="ajax-clear-cart-form">
            @csrf
            <button type="submit" class="btn btn-danger mt-2 w-100">🗑 Clear Cart</button>
        </form>
    @endif
</div>


</div> <!-- End of #cartSidebar -->
<script>
document.addEventListener('DOMContentLoaded', function () {
    // Clear Cart
    document.body.addEventListener('submit', function (e) {
        if (e.target.classList.contains('ajax-clear-cart-form')) {
            e.preventDefault();

            Swal.fire({
                title: 'Clear cart?',
                text: 'This will remove all items.',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonText: 'Yes, clear it!',
                cancelButtonText: 'Cancel'
            }).then((result) => {
                if (result.isConfirmed) {
                    const form = e.target;
                    const url = form.action;

                    fetch(url, {
                        method: 'POST',
                        headers: {
                            'X-CSRF-TOKEN': form.querySelector('input[name="_token"]').value,
                            'Accept': 'application/json'
                        },
                        body: new FormData(form)
                    })
                    .then(res => res.json())
                    .then(data => {
                        document.getElementById('cartContent').innerHTML = `<p>Your cart is empty.</p>`;
                        document.getElementById('cartCount').innerText = 0;
                        document.getElementById('clearCartWrapper').innerHTML = '';

                        Swal.fire('Cart Cleared!', '', 'success');
                    })
                    .catch(() => Swal.fire('Error', 'Could not clear cart.', 'error'));
                }
            });
        }
    });

    // Checkout
    document.body.addEventListener('submit', function (e) {
        if (e.target.classList.contains('ajax-checkout-form')) {
            e.preventDefault();

            Swal.fire({
                title: 'Confirm Order?',
                text: 'Do you want to checkout?',
                icon: 'question',
                showCancelButton: true,
                confirmButtonText: 'Yes, checkout!',
                cancelButtonText: 'Cancel'
            }).then((result) => {
                if (result.isConfirmed) {
                    const form = e.target;
                    const url = form.action;

                    fetch(url, {
                        method: 'POST',
                        headers: {
                            'X-CSRF-TOKEN': form.querySelector('input[name="_token"]').value,
                            'Accept': 'application/json'
                        },
                        body: new FormData(form)
                    })
                    .then(res => res.json())
                    .then(data => {
                        document.getElementById('cartContent').innerHTML = `<p>Your cart is empty.</p>`;
                        document.getElementById('cartCount').innerText = 0;
                        document.getElementById('clearCartWrapper').innerHTML = '';

                        Swal.fire('Order Confirmed!', 'Thank you for your purchase.', 'success');
                    })
                    .catch(() => Swal.fire('Error', 'Could not complete checkout.', 'error'));
                }
            });
        }
    });
});
</script>


@endsection