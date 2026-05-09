<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use App\Models\Order;
use App\Models\ActivityLog;

class DashboardController extends Controller
{
    public function index()
    {
        $user = auth()->user();

        $totalCustomers = Customer::count();
        $totalOrders = Order::count();
        $totalRevenue = Order::sum('price');
        $recentCustomers = Customer::latest()->take(5)->get();

        // Default: no activity logs for staff
        $activities = [];

        // ONLY admin can see activity logs
        if ($user && $user->role === 'admin') {
            $activities = ActivityLog::latest()->take(5)->get();
        }

        return view('dashboard', compact(
            'totalCustomers',
            'totalOrders',
            'totalRevenue',
            'recentCustomers',
            'activities'
        ));
    }
}