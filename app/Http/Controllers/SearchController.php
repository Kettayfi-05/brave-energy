<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Category;
use App\Models\Brand;

class SearchController extends Controller
{
    public function index(Request $request)
    {
        $query = Product::with(['category', 'brand'])->where('is_active', true);

        // Keyword search
        if ($request->filled('q')) {
            $q = $request->q;
            $query->where(function ($sub) use ($q) {
                $sub->where('name', 'like', "%{$q}%")
                    ->orWhere('description', 'like', "%{$q}%")
                    ->orWhere('reference', 'like', "%{$q}%");
            });
        }

        // Category filter
        if ($request->filled('category')) {
            $query->where('category_id', $request->category);
        }

        // Brand filter
        if ($request->filled('brand')) {
            $query->where('brand_id', $request->brand);
        }

        // Price range
        if ($request->filled('price_min')) {
            $query->where('price', '>=', $request->price_min);
        }
        if ($request->filled('price_max')) {
            $query->where('price', '<=', $request->price_max);
        }

        // Promo only
        if ($request->boolean('promo')) {
            $query->whereNotNull('old_price');
        }

        // Sort
        switch ($request->get('sort', 'relevance')) {
            case 'price_asc':
                $query->orderBy('price', 'asc');
                break;
            case 'price_desc':
                $query->orderBy('price', 'desc');
                break;
            case 'newest':
                $query->latest();
                break;
            default:
                $query->latest();
                break;
        }

        $products  = $query->paginate(12)->withQueryString();
        $categories = Category::orderBy('name')->get();
        $brands    = Brand::orderBy('name')->get();

        return view('search.index', compact('products', 'categories', 'brands'));
    }
}
