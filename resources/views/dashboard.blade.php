<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-bold">
            Dashboard
        </h2>
    </x-slot>

    <!-- Main Container -->
    <div style="max-width:1200px; margin:20px auto; padding:0 20px;">

        <!-- Dashboard Cards -->
        <div style="
            display:grid;
            grid-template-columns:repeat(auto-fit, minmax(250px,1fr));
            gap:20px;
            margin-bottom:20px;
        ">

            <!-- Customers -->
            <div style="
                background:white;
                padding:20px;
                border-radius:10px;
                box-shadow:0 2px 8px rgba(0,0,0,0.08);
            ">
                <h3 style="color:#6b7280; font-weight:600;">
                    Total Customers
                </h3>

                <p style="
                    font-size:30px;
                    font-weight:bold;
                    margin-top:10px;
                ">
                    {{ $totalCustomers }}
                </p>
            </div>

            <!-- Orders -->
            <div style="
                background:white;
                padding:20px;
                border-radius:10px;
                box-shadow:0 2px 8px rgba(0,0,0,0.08);
            ">
                <h3 style="color:#6b7280; font-weight:600;">
                    Total Orders
                </h3>

                <p style="
                    font-size:30px;
                    font-weight:bold;
                    margin-top:10px;
                ">
                    {{ $totalOrders }}
                </p>
            </div>

            <!-- Revenue -->
            <div style="
                background:white;
                padding:20px;
                border-radius:10px;
                box-shadow:0 2px 8px rgba(0,0,0,0.08);
            ">
                <h3 style="color:#6b7280; font-weight:600;">
                    Total Revenue
                </h3>

                <p style="
                    font-size:30px;
                    font-weight:bold;
                    margin-top:10px;
                    color:#16a34a;
                ">
                    ₹ {{ $totalRevenue }}
                </p>
            </div>

        </div>

        <!-- Recent Customers -->
        <div style="
            background:white;
            border-radius:10px;
            padding:20px;
            box-shadow:0 2px 8px rgba(0,0,0,0.08);
        ">

            <h3 style="
                font-size:24px;
                font-weight:bold;
                margin-bottom:20px;
            ">
                Recent Customers
            </h3>

            <!-- Buttons -->
            @if(auth()->user()->role === 'admin')

                <div style="
                    margin-bottom:20px;
                    display:flex;
                    gap:12px;
                    flex-wrap:wrap;
                ">

                    <a href="{{ route('customers.create') }}"
                       style="
                            background:#2563eb;
                            color:white;
                            padding:10px 16px;
                            border-radius:8px;
                            text-decoration:none;
                            font-weight:600;
                            display:inline-block;
                       ">
                        Add Customer
                    </a>

                    <a href="{{ route('customers.export.csv') }}"
                       style="
                            background:#16a34a;
                            color:white;
                            padding:10px 16px;
                            border-radius:8px;
                            text-decoration:none;
                            font-weight:600;
                            display:inline-block;
                       ">
                        Export CSV
                    </a>

                    <a href="{{ route('customers.export.pdf') }}"
                       style="
                            background:#dc2626;
                            color:white;
                            padding:10px 16px;
                            border-radius:8px;
                            text-decoration:none;
                            font-weight:600;
                            display:inline-block;
                       ">
                        Export PDF
                    </a>

                </div>

            @endif

            <!-- Table -->
            <div style="overflow-x:auto;">

                <table style="
                    width:100%;
                    border-collapse:collapse;
                    border:1px solid #d1d5db;
                ">

                    <thead style="background:#f3f4f6;">

                        <tr>

                            <th style="
                                border:1px solid #d1d5db;
                                padding:12px;
                                text-align:left;
                            ">
                                Name
                            </th>

                            <th style="
                                border:1px solid #d1d5db;
                                padding:12px;
                                text-align:left;
                            ">
                                Email
                            </th>

                            <th style="
                                border:1px solid #d1d5db;
                                padding:12px;
                                text-align:center;
                            ">
                                Date
                            </th>

                            @if(auth()->user()->role === 'admin')

                                <th style="
                                    border:1px solid #d1d5db;
                                    padding:12px;
                                    text-align:center;
                                ">
                                    Actions
                                </th>

                            @endif

                        </tr>

                    </thead>

                    <tbody>

                        @forelse($recentCustomers as $c)

                            <tr>

                                <td style="
                                    border:1px solid #d1d5db;
                                    padding:12px;
                                ">
                                    {{ $c->name }}
                                </td>

                                <td style="
                                    border:1px solid #d1d5db;
                                    padding:12px;
                                ">
                                    {{ $c->email }}
                                </td>

                                <td style="
                                    border:1px solid #d1d5db;
                                    padding:12px;
                                    text-align:center;
                                ">
                                    {{ $c->created_at->format('d-m-Y') }}
                                </td>

                                @if(auth()->user()->role === 'admin')

                                    <td style="
                                        border:1px solid #d1d5db;
                                        padding:12px;
                                        text-align:center;
                                    ">

                                        <a href="{{ route('customers.edit', $c->id) }}"
                                           style="
                                                color:#2563eb;
                                                margin-right:12px;
                                                text-decoration:none;
                                                font-weight:600;
                                           ">
                                            Edit
                                        </a>

                                        <form action="{{ route('customers.destroy', $c->id) }}"
                                              method="POST"
                                              style="display:inline;">

                                            @csrf
                                            @method('DELETE')

                                            <button type="submit"
                                                    onclick="return confirm('Delete this customer?')"
                                                    style="
                                                        background:none;
                                                        border:none;
                                                        color:#dc2626;
                                                        cursor:pointer;
                                                        font-weight:600;
                                                    ">
                                                Delete
                                            </button>

                                        </form>

                                    </td>

                                @endif

                            </tr>

                        @empty

                            <tr>

                                <td colspan="4"
                                    style="
                                        border:1px solid #d1d5db;
                                        padding:16px;
                                        text-align:center;
                                        color:#6b7280;
                                    ">

                                    No recent customers found.

                                </td>

                            </tr>

                        @endforelse

                    </tbody>

                </table>

            </div>

            <!-- Recent Activity -->
            @if(auth()->user()->role === 'admin')

                <div style="margin-top:35px;">

                    <h3 style="
                        font-size:24px;
                        font-weight:bold;
                        margin-bottom:15px;
                    ">
                        Recent Activity
                    </h3>

                    <div style="
                        background:#f9fafb;
                        border:1px solid #e5e7eb;
                        border-radius:10px;
                    ">

                        @forelse($activities ?? [] as $activity)

                            <div style="
                                padding:15px;
                                border-bottom:1px solid #e5e7eb;
                            ">

                                <div style="
                                    font-weight:600;
                                    color:#1f2937;
                                ">
                                    {{ $activity->action }}
                                </div>

                                <div style="
                                    color:#6b7280;
                                    margin-top:5px;
                                    font-size:14px;
                                ">
                                    {{ $activity->created_at->diffForHumans() }}
                                </div>

                            </div>

                        @empty

                            <div style="
                                padding:15px;
                                color:#6b7280;
                            ">
                                No recent activity found.
                            </div>

                        @endforelse

                    </div>

                </div>

            @endif

            <!-- Role Badge -->
            <div style="margin-top:25px;">

                @if(auth()->user()->role === 'admin')

                    <span style="
                        background:#dcfce7;
                        color:#166534;
                        padding:8px 14px;
                        border-radius:8px;
                        font-weight:600;
                    ">
                        Admin Access ✅
                    </span>

                @else

                    <span style="
                        background:#dbeafe;
                        color:#1d4ed8;
                        padding:8px 14px;
                        border-radius:8px;
                        font-weight:600;
                    ">
                        Staff Access ✅
                    </span>

                @endif

            </div>

        </div>

    </div>

</x-app-layout>