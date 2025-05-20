<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\User;
use App\Models\Order;
use App\Models\JoinRequest;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $stats = [
            'users_count' => User::count(),
            'products_count' => Product::count(),
            'orders_count' => Order::count(),
            'recent_orders' => Order::with('user')->latest()->take(5)->get(),
        ];

        $pendingRequestsCount = JoinRequest::where('status', 'pending')->count();

        return view('admin.dashboard', compact('stats', 'pendingRequestsCount'));
    }
}
