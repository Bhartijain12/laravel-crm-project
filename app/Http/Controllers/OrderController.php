<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\Customer;


class OrderController extends Controller
{
    public function index()
    {
$orders = Order::whereHas('customer')->with('customer')->latest()->paginate(10);
        return view('orders.index', compact('orders'));
    }

    public function create()
    {
        $customers = Customer::all();
        return view('orders.create', compact('customers'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'customer_id'  => 'required',
            'product_name' => 'required',
            'quantity'     => 'required|integer',
            'price'        => 'required|numeric',
        ]);

        Order::create($request->all());

        return redirect()->route('orders.index')->with('success', 'Order created successfully');
    }
    // Show edit form
public function edit(Order $order)
{
    $customers = Customer::all();
    return view('orders.edit', compact('order', 'customers'));
}

// Update order
public function update(Request $request, Order $order)
{
    $request->validate([
        'customer_id'  => 'required',
        'product_name' => 'required',
        'quantity'     => 'required|integer',
        'price'        => 'required|numeric',
    ]);

    $order->update($request->all());

    return redirect()->route('orders.index')->with('success', 'Order updated successfully');
}

// Delete order
public function destroy(Order $order)
{
    $order->delete();

    return redirect()->route('orders.index')->with('success', 'Order deleted');
}

}
