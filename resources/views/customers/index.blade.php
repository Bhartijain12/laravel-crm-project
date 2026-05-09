<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-bold">Customers</h2>
    </x-slot>

    <div class="p-6">

        <!-- Top Buttons (ADMIN ONLY) -->
        @if(auth()->user()->role === 'admin')
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
        @endif

        <!-- Search Form -->
        <form method="GET"
              action="{{ route('customers.index') }}"
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
        <table border="1"
               cellpadding="10"
               style="margin-top:15px; width:100%; border-collapse:collapse; text-align:center;">

            <thead>
                <tr style="background:#f3f4f6;">
                    <th>Profile</th>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Phone</th>

                    @if(auth()->user()->role === 'admin')
                        <th>Action</th>
                    @endif
                </tr>
            </thead>

            <tbody>

                @forelse($customers as $customer)

                <tr style="vertical-align:middle;">

                    <!-- Profile -->
                    <td style="vertical-align:middle; text-align:center;">

                        @if($customer->profile_image)

                            <img
                                src="{{ asset('uploads/customers/' . $customer->profile_image) }}"
                                alt="Profile"
                                width="50"
                                height="50"
                                style="
                                    width:50px;
                                    height:50px;
                                    border-radius:50%;
                                    object-fit:cover;
                                    display:block;
                                    margin:auto;
                                "
                            >

                        @else

                            N/A

                        @endif

                    </td>

                    <!-- Name -->
                    <td style="vertical-align:middle;">
                        {{ $customer->name }}
                    </td>

                    <!-- Email -->
                    <td style="vertical-align:middle;">
                        {{ $customer->email }}
                    </td>

                    <!-- Phone -->
                    <td style="vertical-align:middle;">
                        {{ $customer->phone }}
                    </td>

                    <!-- Actions -->
                    @if(auth()->user()->role === 'admin')

                    <td style="vertical-align:middle;">

                        <div style="display:flex; gap:10px; justify-content:center; align-items:center;">

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
                                        onclick="return confirm('Delete this customer?')">
                                    Delete
                                </button>

                            </form>

                        </div>

                    </td>

                    @endif

                </tr>

                @empty

                <tr>
                    <td colspan="5" style="padding:15px;">
                        No customers found.
                    </td>
                </tr>

                @endforelse

            </tbody>

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