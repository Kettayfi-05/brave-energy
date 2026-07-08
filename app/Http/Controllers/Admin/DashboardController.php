<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Product;
use App\Models\OrderRequest;
use App\Models\ContactMessage;
use App\Models\Category;

class DashboardController extends Controller
{
    public function index()
    {
        $stats = [
            'products'      => Product::count(),
            'orders'        => OrderRequest::count(),
            'customers'     => User::where('role', 'customer')->count(),
            'messages'      => ContactMessage::count(),
        ];

        $recentOrders = OrderRequest::with('user')
            ->latest()
            ->take(6)
            ->get();

        $recentUsers = User::where('role', 'customer')
            ->latest()
            ->take(5)
            ->get();

        return view('admin.dashbord.index', compact('stats', 'recentOrders', 'recentUsers'));
    }
}
