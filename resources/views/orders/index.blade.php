<x-app-layout>
<x-slot name="header">
    <h2 class="text-xl font-bold">Orders</h2>
</x-slot>

<div class="p-6">

<!-- Admin-only Add Order Button -->
@if(auth()->user()->role === 'admin')
<div style="margin-bottom:15px;">
    <a href="{{ route('orders.create') }}" class="btn btn-green">Add Order</a>
</div>
@endif

<table style="width:100%; border-collapse:collapse; background:white;">
<thead>
<tr style="background:#f3f4f6; text-align:left;">
    <th style="padding:12px;">Customer</th>
    <th style="padding:12px;">Product</th>
    <th style="padding:12px; text-align:center;">Qty</th>
    <th style="padding:12px; text-align:right;">Price</th>
    <th style="padding:12px; text-align:center;">Status</th>
    @if(auth()->user()->role === 'admin')
        <th style="padding:12px; text-align:center;">Action</th>
    @endif
</tr>
</thead>

<tbody>
@foreach($orders as $order)
<tr style="border-top:1px solid #e5e7eb;">
    <td style="padding:10px;">{{ $order->customer->name }}</td>
    <td style="padding:10px;">{{ $order->product_name }}</td>
    <td style="padding:10px; text-align:center;">{{ $order->quantity }}</td>
    <td style="padding:10px; text-align:right;">{{ number_format($order->price,2) }}</td>
    <td style="padding:10px; text-align:center;">
        <span style="background:#fde68a;padding:4px 10px;border-radius:12px;">
            {{ ucfirst($order->status) }}
        </span>
    </td>

    <!-- Admin-only Actions -->
    @if(auth()->user()->role === 'admin')
    <td style="padding:10px;">
        <div style="display:flex; justify-content:center; gap:8px;">
            <a href="{{ route('orders.edit', $order->id) }}"
               style="background:#2563eb;color:white;padding:6px 12px;border-radius:5px;text-decoration:none;">
               Edit
            </a>

            <form action="{{ route('orders.destroy', $order->id) }}" method="POST" style="margin:0;">
                @csrf
                @method('DELETE')
                <button type="submit"
                    style="background:#dc2626;color:white;padding:6px 12px;border:none;border-radius:5px;cursor:pointer;">
                    Delete
                </button>
            </form>
        </div>
    </td>
    @endif
</tr>
@endforeach
</tbody>
</table>

@if(session('success'))
    <div style="color: green; margin-bottom: 10px;">
        {{ session('success') }}
    </div>
@endif

<!-- Pagination -->
<div style="margin-top:12px;">
    {{ $orders->links() }}
</div>

</div>

<!-- Button Styles -->
<style>
    .btn {
        padding: 6px 12px;
        border-radius: 6px;
        color: white;
        text-decoration: none;
        font-size: 14px;
        display: inline-block;
        border:none;
        cursor:pointer;
        font-weight:500;
    }
    .btn-green { background:#16a34a; }
    .btn-blue { background:#2563eb; }
    .btn-red { background:#dc2626; }
</style>

</x-app-layout>
