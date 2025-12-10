<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-bold">Customers</h2>
    </x-slot>

    <div class="p-6">

        <!-- Top Buttons -->
        <div style="margin-bottom:15px; display:flex; gap:10px; flex-wrap:wrap; align-items:center;">
            <a href="{{ route('customers.create') }}" class="btn btn-green">Add Customer</a>
            <a href="{{ route('customers.export.csv') }}" class="btn btn-blue">Export CSV</a>
            <a href="{{ route('customers.export.pdf') }}" class="btn btn-teal">Export PDF</a>
        </div>

        <!-- Table -->
        <table border="1" cellpadding="10" style="margin-top:15px;width:100%;border-collapse:collapse;">
            <tr style="background:#f3f4f6;">
                <th>Profile</th>
                <th>Name</th>
                <th>Email</th>
                <th>Phone</th>
                <th>Action</th>
            </tr>

            @foreach($customers as $customer)
                <tr>
                    <!-- Profile Image -->
                    <td>
                        @if($customer->profile_image)
                            <img src="{{ asset('uploads/customers/' . $customer->profile_image) }}" 
                                 alt="Profile Image" width="50" height="50" style="border-radius:50%;">
                        @else
                            N/A
                        @endif
                    </td>

                    <td>{{ $customer->name }}</td>
                    <td>{{ $customer->email }}</td>
                    <td>{{ $customer->phone }}</td>

                    <!-- Action Buttons -->
                    <td style="display:flex; gap:8px; justify-content:center; align-items:center;">
                        <a href="{{ route('customers.edit', $customer->id) }}" class="btn btn-blue">Edit</a>

                        <form action="{{ route('customers.destroy', $customer->id) }}" method="POST" style="margin:0;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-red">Delete</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </table>

        <!-- Pagination -->
        <div style="margin-top:12px;">
            {{ $customers->links() }}
        </div>
    </div>

    <!-- Button Styles -->
    <style>
        .btn {
            padding: 8px 14px;
            border-radius: 6px;
            color: white;
            text-decoration: none;
            display: inline-block;
            font-weight: 500;
        }
        .btn-green { background:#16a34a; }
        .btn-blue { background:#2563eb; }
        .btn-teal { background:#10b981; }
        .btn-red { background:#dc2626; border:none; cursor:pointer; }
    </style>
</x-app-layout>
