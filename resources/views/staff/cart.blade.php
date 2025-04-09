@extends('layouts.app')

@section('content')
<div class="container">
    <h2>🛒 Your Cart</h2>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    @if(count($cart))
        <form method="POST" action="{{ route('cart.checkout') }}">
            @csrf
            <table class="table">
                <thead>
                    <tr>
                        <th>Product</th>
                        <th>Quantity</th>
                        <th>Price</th>
                        <th>Remove</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($products as $product)
                        <tr>
                            <td>{{ $product->name }}</td>
                            <td>{{ $cart[$product->id] }}</td>
                            <td>€{{ number_format($product->price * $cart[$product->id], 2) }}</td>
                            <td>
                                <a href="{{ route('cart.remove', $product->id) }}" class="btn btn-sm btn-danger">Remove</a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>

            <button class="btn btn-success">✔️ Place Order</button>
        </form>
    @else
        <p>Your cart is empty.</p>
    @endif
</div>
@endsection
