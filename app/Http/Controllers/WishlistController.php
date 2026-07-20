<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Favorite;
use Illuminate\Support\Facades\Auth;

class WishlistController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        if ($user->role === 'admin') {
            return redirect()->route('admin.dashboard');
        }

        $favorites = Favorite::with('product')
            ->where('user_id', $user->id)
            ->latest()
            ->get();

        return view('wishlist.index', compact('favorites'));
    }

    public function toggle(Product $product)
    {
        $user = Auth::user();
        if ($user->role === 'admin') {
            return redirect()->back()->with('error', 'Les administrateurs n\'ont pas de liste de favoris.');
        }

        $favorite = Favorite::where('user_id', $user->id)
            ->where('product_id', $product->id)
            ->first();

        if ($favorite) {
            $favorite->delete();
            return redirect()->back()->with('success', 'Produit retiré de votre liste de favoris.');
        } else {
            Favorite::create([
                'user_id' => $user->id,
                'product_id' => $product->id,
            ]);
            return redirect()->back()->with('success', 'Produit ajouté à votre liste de favoris !');
        }
    }
}
