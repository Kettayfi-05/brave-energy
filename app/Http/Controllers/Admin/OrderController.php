<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\OrderRequest;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function index(Request $request)
    {
        $query = OrderRequest::with('user');

        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        if ($request->filled('q')) {
            $q = $request->q;
            $query->where(function($sub) use ($q) {
                $sub->where('reference', 'like', "%{$q}%")
                    ->orWhere('customer_name', 'like', "%{$q}%");
            });
        }

        $orders = $query->latest()->paginate(10)->withQueryString();
        return view('admin.orders.index', compact('orders'));
    }

    public function show(OrderRequest $order)
    {
        $order->load(['items.product', 'items.productVariant']);
        return view('admin.orders.show', compact('order'));
    }

    public function update(Request $request, OrderRequest $order)
    {
        $request->validate([
            'status' => 'required|in:pending,validated,rejected,completed',
        ]);

        $order->update([
            'status' => $request->status,
        ]);

        return redirect()->route('admin.orders.show', $order)->with('success', 'Statut de la commande mis à jour.');
    }
}
