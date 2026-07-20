<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Cart;
use App\Models\OrderRequest;
use App\Models\RequestItem;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class OrderController extends Controller
{
    public function checkout()
    {
        $user = Auth::user();
        if ($user->role === 'admin') {
            return redirect()->route('admin.dashboard');
        }

        $cart = Cart::with(['cartItems.product'])->where('user_id', $user->id)->first();
        if (!$cart || $cart->cartItems->isEmpty()) {
            return redirect()->route('cart.index')->with('error', 'Votre panier est vide.');
        }

        $items = $cart->cartItems;
        $total = 0;
        foreach ($items as $item) {
            $total += ($item->product->price * $item->quantity);
        }

        return view('orders.checkout', compact('items', 'total'));
    }

    public function store(Request $request)
    {
        $user = Auth::user();
        if ($user->role === 'admin') {
            abort(403);
        }

        $cart = Cart::with(['cartItems.product'])->where('user_id', $user->id)->first();
        if (!$cart || $cart->cartItems->isEmpty()) {
            return redirect()->route('cart.index')->with('error', 'Votre panier est vide.');
        }

        $request->validate([
            'customer_name'    => 'required|string|max:255',
            'customer_phone'   => 'required|string|max:50',
            'customer_email'   => 'required|email|max:255',
            'delivery_address' => 'required|string',
            'notes'            => 'nullable|string',
        ]);

        // Generate unique reference
        $reference = 'BE-' . strtoupper(Str::random(8));
        while (OrderRequest::where('reference', $reference)->exists()) {
            $reference = 'BE-' . strtoupper(Str::random(8));
        }

        // Create Order Request
        $order = OrderRequest::create([
            'user_id'          => $user->id,
            'reference'        => $reference,
            'status'           => 'pending',
            'customer_name'    => $request->customer_name,
            'customer_phone'   => $request->customer_phone,
            'customer_email'   => $request->customer_email,
            'delivery_address' => $request->delivery_address,
            'notes'            => $request->notes,
        ]);

        // Transfer items
        foreach ($cart->cartItems as $cartItem) {
            RequestItem::create([
                'order_request_id' => $order->id,
                'product_id'       => $cartItem->product_id,
                'quantity'         => $cartItem->quantity,
            ]);

            // Decrement stock if applicable
            $product = $cartItem->product;
            if ($product->stock >= $cartItem->quantity) {
                $product->stock -= $cartItem->quantity;
            } else {
                $product->stock = 0;
            }
            $product->save();
        }

        // Clear cart
        $cart->cartItems()->delete();

        return redirect()->route('orders.show', $order)->with('success', 'Votre demande de commande a été enregistrée avec succès !');
    }

    public function index()
    {
        $user = Auth::user();
        if ($user->role === 'admin') {
            return redirect()->route('admin.dashboard');
        }

        $orders = OrderRequest::where('user_id', $user->id)
            ->latest()
            ->paginate(10);

        return view('orders.index', compact('orders'));
    }

    public function show(OrderRequest $orderRequest)
    {
        if ($orderRequest->user_id !== Auth::id()) {
            abort(403);
        }

        $orderRequest->load('items.product');
        
        $total = 0;
        foreach ($orderRequest->items as $item) {
            $total += ($item->product->price * $item->quantity);
        }

        return view('orders.show', compact('orderRequest', 'total'));
    }
}
