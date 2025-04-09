@extends('layouts.app')

@section('content')
<div class="container">
    <h2 class="mb-4">🏪 Pharmacy Center</h2>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @elseif(session('error'))
        <div class="alert alert-danger">{{ session('error') }}</div>
    @endif

    <!-- Product Catalog -->
    <h4>🛒 Available Products</h4>
    <table class="table">
        <thead><tr><th>Name</th><th>Stock</th><th>Price</th><th>Order</th></tr></thead>
        <tbody>
            @foreach($products as $product)
            <tr>
                <td><strong>{{ $product->name }}</strong><br><small>{{ $product->description }}</small></td>
                <td>{{ $product->stock }}</td>
                <td>€{{ $product->price }}</td>
                <td>
                    <form method="POST" action="{{ route('pharmacy.order') }}">
                        @csrf
                        <input type="hidden" name="product_id" value="{{ $product->id }}">
                        <input type="number" name="quantity" class="form-control mb-1" min="1" max="{{ $product->stock }}" style="width:80px;" required>
                        <button class="btn btn-sm btn-primary">Buy</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>

    <!-- Orders Section -->
    <h4 class="mt-5">📦 My Orders</h4>
    <table class="table">
        <thead><tr><th>Product</th><th>Qty</th><th>Status</th><th>Action</th></tr></thead>
        <tbody>
            @forelse($orders as $order)
            <tr>
                <td>{{ $order->product->name }}</td>
                <td>{{ $order->quantity }}</td>
                <td>{{ $order->status }}</td>
                <td>
                    @if($order->status == 'Ordered')
                        <form action="{{ route('pharmacy.ship', $order->id) }}" method="POST">
                            @csrf
                            <button class="btn btn-sm btn-success">Mark Shipped</button>
                        </form>
                    @else
                        <span class="badge bg-success">✅ Shipped</span>
                    @endif
                </td>
            </tr>
            @empty
                <tr><td colspan="4">No orders yet.</td></tr>
            @endforelse
        </tbody>
    </table>
</div>
@endsection
