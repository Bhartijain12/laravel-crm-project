<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-bold">Customers</h2>
    </x-slot>

    <div class="p-6">

        <!-- Top Buttons -->
        <div style="margin-bottom:15px; display:flex; gap:10px; flex-wrap:wrap; align-items:center;">
            <a href="{{ route('customers.create') }}" class="btn btn-green">
                Add Customer
            </a>

            <a href="{{ route('customers.export.csv') }}" class="btn btn-blue">
                Export CSV
            </a>

            <a href="{{ route('customers.export.pdf') }}" class="btn btn-teal">
                Export PDF
            </a>
        </div>

        <!-- Search Form -->
        <form method="GET" action="{{ route('customers.index') }}"
              style="margin-bottom:15px; display:flex; gap:10px; align-items:center; flex-wrap:wrap;">

            <input
                type="text"
                name="search"
                value="{{ request('search') }}"
                placeholder="Search by name, email, or phone"
                style="padding:8px; border:1px solid #ccc; border-radius:6px; width:250px;"
            >

            <button type="submit" class="btn btn-blue">
                Search
            </button>

            <a href="{{ route('customers.index') }}" class="btn btn-red">
                Reset
            </a>
        </form>

        <!-- Success Message -->
        @if(session('success'))
            <div style="background:#dcfce7; color:#166534; padding:10px; border-radius:6px; margin-bottom:15px;">
                {{ session('success') }}
            </div>
        @endif

        <!-- Table -->
        <table border="1" cellpadding="10"
               style="margin-top:15px; width:100%; border-collapse:collapse; text-align:center;">

            <tr style="background:#f3f4f6;">
                <th>Profile</th>
                <th>Name</th>
                <th>Email</th>
                <th>Phone</th>
                <th>Action</th>
            </tr>

            @forelse($customers as $customer)
                <tr>
                    <!-- Profile Image -->
                    <td>
                        @if($customer->profile_image)
                            <img
                                src="{{ asset('uploads/customers/' . $customer->profile_image) }}"
                                alt="Profile Image"
                                width="50"
                                height="50"
                                style="border-radius:50%; object-fit:cover;"
                            >
                        @else
                            N/A
                        @endif
                    </td>

                    <!-- Customer Details -->
                    <td>{{ $customer->name }}</td>
                    <td>{{ $customer->email }}</td>
                    <td>{{ $customer->phone }}</td>

                    <!-- Action Buttons -->
                    <td>
                        <div style="display:flex; gap:8px; justify-content:center; align-items:center;">

                            <a href="{{ route('customers.edit', $customer->id) }}"
                               class="btn btn-blue">
                                Edit
                            </a>

                            <form action="{{ route('customers.destroy', $customer->id) }}"
                                  method="POST"
                                  style="margin:0;">

                                @csrf
                                @method('DELETE')

                                <button type="submit"
                                        class="btn btn-red"
                                        onclick="return confirm('Are you sure you want to delete this customer?')">
                                    Delete
                                </button>
                            </form>

                        </div>
                    </td>
                </tr>

            @empty
                <tr>
                    <td colspan="5" style="padding:15px;">
                        No customers found.
                    </td>
                </tr>
            @endforelse

        </table>

        <!-- Pagination -->
        <div style="margin-top:15px;">
            {{ $customers->appends(request()->query())->links() }}
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
            border: none;
            cursor: pointer;
        }

        .btn-green {
            background: #16a34a;
        }

        .btn-blue {
            background: #2563eb;
        }

        .btn-teal {
            background: #10b981;
        }

        .btn-red {
            background: #dc2626;
        }

        .btn:hover {
            opacity: 0.9;
        }
    </style>
</x-app-layout>