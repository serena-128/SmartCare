<ul class="list-group">
  @php $total = 0; @endphp
  @foreach($items as $item)
    @php $line = $item['price'] * $item['quantity']; $total += $line; @endphp
    <li class="list-group-item d-flex justify-content-between">
      {{ $item['name'] }} x {{ $item['quantity'] }}
      <span>€{{ number_format($line, 2) }}</span>
    </li>
  @endforeach
  <li class="list-group-item text-end">
    <strong>Total: €{{ number_format($total, 2) }}</strong>
  </li>
</ul>
