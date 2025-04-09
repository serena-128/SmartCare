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

<div class="container">
    <h2 class="mb-4">💊 Medication Center</h2>

    <!-- Tabs -->
    <ul class="nav nav-tabs" id="medTab" role="tablist">
        <li class="nav-item" role="presentation">
            <button class="nav-link {{ $activeTab === 'residents' ? 'active' : '' }}" id="residents-tab"
                data-bs-toggle="tab" data-bs-target="#residents" type="button" role="tab">
                🧑‍⚕️ Resident Medications
            </button>
        </li>
        <li class="nav-item" role="presentation">
            <button class="nav-link {{ $activeTab === 'lookup' ? 'active' : '' }}" id="lookup-tab"
                data-bs-toggle="tab" data-bs-target="#lookup" type="button" role="tab">
                🔍 Medication Lookup
            </button>
        </li>
        <li class="nav-item" role="presentation">
            <button class="nav-link" id="pharmacy-tab"
                data-bs-toggle="tab" data-bs-target="#pharmacy" type="button" role="tab">
                🏪 Pharmacy Info
            </button>
        </li>
    </ul>

    <div class="tab-content mt-4" id="medTabContent">
        <!-- Resident Medications Tab -->
        <div class="tab-pane fade {{ $activeTab === 'residents' ? 'show active' : '' }}" id="residents" role="tabpanel">
            @if($residents->count())
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>Resident Name</th>
                            <th>Allergies</th>
                            <th>Current Medications</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($residents as $resident)
                            <tr>
                                <td>{{ $resident->firstname }} {{ $resident->lastname }}</td>
                                <td>{{ $resident->allergies ?? 'None' }}</td>
                                <td>{{ $resident->medications ?? 'Not listed' }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            @else
                <p>No resident data available.</p>
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
                <div class="alert alert-success">{{ session('success') }}</div>
            @elseif(session('error'))
                <div class="alert alert-danger">{{ session('error') }}</div>
            @endif

                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>Product</th>
                            <th>In Stock</th>
                            <th>Price</th>
                            <th>Quantity</th>
                            <th>🛒 Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($products as $product)
                        <tr>
                            <td>{{ $product->name }}</td>
                            <td>{{ $product->stock }}</td>
                            <td>€{{ number_format($product->price, 2) }}</td>
                            <td>
                                <form method="POST" action="{{ route('pharmacy.addToCart') }}">
                                    @csrf
                                    <input type="hidden" name="product_id" value="{{ $product->id }}">
                                    <input type="number" name="quantity" value="1" min="1" max="{{ $product->stock }}" class="form-control mb-1" style="width: 80px;">
                                    <button class="btn btn-sm btn-primary">Add to Cart</button>
                                </form>
                            </td>
                        </tr>
                        @endforeach

                    </tbody>
                </table>
            </form>
        @if(session('cart'))
            <hr>
            <h4 class="mt-4">🛒 Your Cart</h4>
            <form method="POST" action="{{ route('pharmacy.checkout') }}">
                @csrf
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>Product</th>
                            <th>Qty</th>
                            <th>Price</th>
                            <th>Total</th>
                        </tr>
                    </thead>
                    <tbody>
                        @php $grandTotal = 0; @endphp
                        @foreach(session('cart') as $item)
                            @php $total = $item['quantity'] * $item['price']; $grandTotal += $total; @endphp
                            <tr>
                                <td>{{ $item['name'] }}</td>
                                <td>{{ $item['quantity'] }}</td>
                                <td>€{{ number_format($item['price'], 2) }}</td>
                                <td>€{{ number_format($total, 2) }}</td>
                            </tr>
                        @endforeach
                        <tr>
                            <td colspan="3" class="text-end"><strong>Grand Total:</strong></td>
                            <td><strong>€{{ number_format($grandTotal, 2) }}</strong></td>
                        </tr>
                    </tbody>
                </table>
                <button type="submit" class="btn btn-success">🧾 Checkout</button>
            </form>
        @endif

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
                        @foreach($orders as $order)
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
</div>
@endsection
