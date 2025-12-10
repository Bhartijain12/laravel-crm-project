<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-bold">Dashboard</h2>
    </x-slot>

    <div class="max-w-6xl mx-auto grid grid-cols-3 gap-4 p-4">

        <div class="bg-white p-4 rounded shadow">
            <h3>Total Customers</h3>
            <p class="text-2xl font-bold">{{ $totalCustomers }}</p>
        </div>

        <div class="bg-white p-4 rounded shadow">
            <h3>Total Orders</h3>
            <p class="text-2xl font-bold">{{ $totalOrders }}</p>
        </div>

        <div class="bg-white p-4 rounded shadow">
            <h3>Total Revenue</h3>
            <p class="text-2xl font-bold">₹ {{ $totalRevenue }}</p>
        </div>

    </div>

    <div class="max-w-6xl mx-auto bg-white rounded shadow p-4 mt-4">

        <h3 class="text-lg font-bold mb-2">Recent Customers</h3>

        {{-- Admin-only Actions --}}
        @if(auth()->user()->role === 'admin')
            <div class="mb-4 flex gap-2">
                <a href="{{ route('customers.create') }}" class="bg-black text-white px-3 py-1 rounded">
                    Add Customer
                </a>
                <a href="{{ route('customers.export.csv') }}" class="text-blue-600">Export CSV</a>
                <a href="{{ route('customers.export.pdf') }}" class="text-blue-600">Export PDF</a>
            </div>
        @endif

        <table class="w-full border text-sm text-left">
            <thead>
                <tr>
                    <th class="w-1/4">Name</th>
                    <th class="w-1/2">Email</th>
                    <th class="w-1/4 text-center">Date</th>
                    @if(auth()->user()->role === 'admin')
                        <th class="text-center">Actions</th>
                    @endif
                </tr>
            </thead>

            <tbody>
                @foreach($recentCustomers as $c)
                    <tr>
                        <td class="p-2 border">{{ $c->name }}</td>
                        <td class="p-2 border">{{ $c->email }}</td>
                        <td class="p-2 border text-center">{{ $c->created_at->format('d-m-Y') }}</td>
                        @if(auth()->user()->role === 'admin')
    <td class="p-2 border text-center">
        {{-- Edit --}}
        <a href="{{ route('customers.edit', ['customer' => $c->id]) }}" class="text-blue-600 mr-2">
            Edit
        </a>

        {{-- Delete --}}
        <form action="{{ route('customers.destroy', ['customer' => $c->id]) }}" method="POST" style="display:inline;">
            @csrf
            @method('DELETE')
            <button type="submit" class="text-red-600">Delete</button>
        </form>
    </td>
@endif

                    </tr>
                @endforeach
            </tbody>
        </table>

        {{-- Role Badge --}}
        @if(auth()->user()->role === 'admin')
            <div class="mt-4 text-green-600 font-bold">Admin Access ✅</div>
        @else
            <div class="mt-4 text-blue-600 font-bold">Staff Access ✅</div>
        @endif

    </div>
</x-app-layout>
