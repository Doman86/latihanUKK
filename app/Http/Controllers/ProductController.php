<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\View\View;

class ProductController extends Controller
{
    public function index(): View
    {
        $search = request()->query('search');

        $products = Product::query()
            ->withCount('comments')
            ->when($search, function ($query, $search) {
                $query->where('name', 'like', "%{$search}%")
                    ->orWhere('description', 'like', "%{$search}%");
            })
            ->latest()
            ->paginate(9);

        return view('products.index', compact('products', 'search'));
    }

    public function show(Product $product): View
    {
        $product->load('comments.user');

        return view('products.show', compact('product'));
    }
}