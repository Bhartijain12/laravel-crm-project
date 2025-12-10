<x-app-layout>
<x-slot name="header">
    <h2 class="text-xl font-bold">Edit Order</h2>
</x-slot>

@php
    // Staff restriction: redirect if user is not admin
    if(auth()->user()->role !== 'admin') {
        echo "<script>window.location='".route('orders.index')."';</script>";
        exit;
    }
@endphp

<div class="p-6">

<form action="{{ route('orders.update', $order->id) }}" method="POST" style="max-width:400px;">
    @csrf
    @method('PUT')

    <label>Customer</label><br>
    <select name="customer_id" required style="width:100%;padding:8px;margin-bottom:10px;">
        @foreach($customers as $customer)
            <option value="{{ $customer->id }}" @if($order->customer_id == $customer->id) selected @endif>
                {{ $customer->name }}
            </option>
        @endforeach
    </select>

    <label>Product</label>
    <input type="text" name="product_name" value="{{ $order->product_name }}" required
           style="width:100%;padding:8px;margin-bottom:10px;">

    <label>Quantity</label>
    <input type="number" name="quantity" value="{{ $order->quantity }}" required
           style="width:100%;padding:8px;margin-bottom:10px;">

    <label>Price</label>
    <input type="number" name="price" step="0.01" value="{{ $order->price }}" required
           style="width:100%;padding:8px;margin-bottom:15px;">

    <button type="submit"
            style="background:#2563eb;color:white;padding:10px 16px;border:none;border-radius:6px;cursor:pointer;">
        Update Order
    </button>

</form>

</div>
</x-app-layout>
