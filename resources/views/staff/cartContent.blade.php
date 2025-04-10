@if($cart)
    <ul class="list-group">
        @php $total = 0; @endphp
        @foreach($cart as $item)
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
