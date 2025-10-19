<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;

class ProductController extends Controller
{
    public function index(Request $request)
    {
        $category = $request->query('category', '');
        $query = Product::where('is_active', 1);

        if ($category) {
            $query->where('category', $category);
        }

        $products = $query->orderByDesc('id')->get();
        $categories = Product::where('is_active', 1)->distinct()->pluck('category')->toArray();

        return view('products.index', [
            'products' => $products,
            'categories' => $categories,
            'selected_category' => $category,
            'page' => 'products',
        ]);
    }
}
