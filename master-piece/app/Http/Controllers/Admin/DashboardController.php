<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\News;
use App\Models\Product;
use App\Models\User;
use App\Models\Order;
use App\Models\JoinRequest;

class DashboardController extends Controller
{
    public function index()
    {
        $stats = [
            'orders_count' => Order::count(), // تأكد من أن لديك نموذج Order
        'users_count' => User::count(),

            'news_count' => News::count(),
            'products_count' => Product::count(),
            'orders_count' => Order::count(),
            'recent_orders' => Order::with('user')->latest()->take(5)->get(),
        ];

        return view('admin.dashboard', compact('stats'));
    }
}
