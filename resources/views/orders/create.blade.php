<x-app-layout>
<x-slot name="header">
    <h2 class="text-xl font-bold">Add Order</h2>
</x-slot>

@php
    // Staff restriction: redirect if user is not admin
    if(auth()->user()->role !== 'admin') {
        echo "<script>window.location='".route('orders.index')."';</script>";
        exit;
    }
@endphp

<div class="p-6">

@if ($errors->any())
    <div style="color:red;margin-bottom:10px;">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

<form action="{{ route('orders.store') }}" method="POST" style="max-width:400px;">
    @csrf

    <label>Customer</label><br>
    <select name="customer_id" required style="width:100%;padding:8px;margin-bottom:10px;">
        <option value="">Select Customer</option>
        @foreach($customers as $customer)
            <option value="{{ $customer->id }}">{{ $customer->name }}</option>
        @endforeach
    </select>

    <label>Product</label>
    <input type="text" name="product_name" placeholder="Product Name" required
           style="width:100%;padding:8px;margin-bottom:10px;">

    <label>Quantity</label>
    <input type="number" name="quantity" placeholder="Quantity" required
           style="width:100%;padding:8px;margin-bottom:10px;">

    <label>Price</label>
    <input type="number" step="0.01" name="price" placeholder="Price" required
           style="width:100%;padding:8px;margin-bottom:15px;">

    <button type="submit"
            style="background:#16a34a;color:white;padding:10px 18px;border:none;border-radius:8px;cursor:pointer;font-weight:600;">
        Save Order
    </button>
</form>

</div>
</x-app-layout>
