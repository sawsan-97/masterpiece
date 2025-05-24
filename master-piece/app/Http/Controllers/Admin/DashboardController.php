<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\News;
use App\Models\Product;
use App\Models\User;
use App\Models\Order;
use App\Models\JoinRequest;
use App\Models\ContactMessage;

class DashboardController extends Controller
{
    public function index()
    {
        $totalOrders = Order::count();
        $totalUsers = User::count();
        $totalNews = News::count();
        $totalProducts = Product::count();
        $totalRevenue = Order::where('status', 'completed')->sum('total');
        $recentOrders = Order::with('user')->latest()->take(5)->get();
        $pendingJoinRequests = JoinRequest::where('status', 'pending')->count();
        $pendingMessages = ContactMessage::where('status', 'pending')->count();

        return view('admin.dashboard', compact(
            'totalOrders',
            'totalUsers',
            'totalNews',
            'totalProducts',
            'totalRevenue',
            'recentOrders',
            'pendingJoinRequests',
            'pendingMessages'
        ));
    }
}
