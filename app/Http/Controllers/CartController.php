<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Cart;
use App\Models\CartItem;
use Illuminate\Support\Facades\Auth;

class CartController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        if ($user->role === 'admin') {
            return redirect()->route('admin.dashboard')->with('error', 'Les administrateurs n\'ont pas de panier.');
        }

        $cart = Cart::with(['cartItems.product'])->firstOrCreate(['user_id' => $user->id]);
        $items = $cart->cartItems;
        $total = 0;
        foreach ($items as $item) {
            $total += ($item->product->price * $item->quantity);
        }

        return view('cart.index', compact('items', 'total'));
    }

    public function store(Request $request)
    {
        $user = Auth::user();
        if ($user->role === 'admin') {
            return redirect()->back()->with('error', 'Les administrateurs ne peuvent pas commander de produits.');
        }

        $request->validate([
            'product_id' => 'required|exists:products,id',
            'quantity' => 'nullable|integer|min:1',
        ]);

        $product = Product::findOrFail($request->product_id);
        if ($product->status !== 'active') {
            return redirect()->back()->with('error', 'Ce produit n\'est pas disponible actuellement.');
        }

        $quantity = $request->get('quantity', 1);

        $cart = Cart::firstOrCreate(['user_id' => $user->id]);

        $cartItem = CartItem::where('cart_id', $cart->id)
            ->where('product_id', $product->id)
            ->first();

        if ($cartItem) {
            $cartItem->quantity += $quantity;
            $cartItem->save();
        } else {
            CartItem::create([
                'cart_id' => $cart->id,
                'product_id' => $product->id,
                'quantity' => $quantity,
            ]);
        }

        return redirect()->back()->with('success', 'Produit ajouté au panier !');
    }

    public function update(Request $request, CartItem $cartItem)
    {
        // Ensure cart item belongs to user
        if ($cartItem->cart->user_id !== Auth::id()) {
            abort(403);
        }

        $request->validate([
            'quantity' => 'required|integer|min:1',
        ]);

        $cartItem->update([
            'quantity' => $request->quantity,
        ]);

        return redirect()->route('cart.index')->with('success', 'Quantité mise à jour.');
    }

    public function destroy(CartItem $cartItem)
    {
        // Ensure cart item belongs to user
        if ($cartItem->cart->user_id !== Auth::id()) {
            abort(403);
        }

        $cartItem->delete();

        return redirect()->route('cart.index')->with('success', 'Produit retiré du panier.');
    }
}
