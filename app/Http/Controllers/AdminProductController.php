<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;

class AdminProductController extends Controller
{
    public function index()
    {
        $products = Product::orderByDesc('id')->get();
        return view('admin.products.index', compact('products'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|min:2',
            'description' => 'required|min:10',
            'image' => 'required|image|mimes:jpg,jpeg,png,gif|max:2048',
            'category' => 'required|string',
        ]);

        $imageName = null;
        if ($request->hasFile('image')) {
            $imageName = time() . '_' . $request->file('image')->getClientOriginalName();
            $request->file('image')->move(public_path('img'), $imageName);
        }

        Product::create([
            'name' => $request->name,
            'description' => $request->description,
            'image_path' => 'img/' . $imageName,
            'category' => $request->category,
            'is_active' => 1,
        ]);

        return redirect()->route('admin.products')->with('success', 'Product added successfully!');
    }

    public function update(Request $request, Product $product)
{
    $request->validate([
        'name' => 'required|min:2',
        'description' => 'required|min:10',
        'image' => 'nullable|image|mimes:jpg,jpeg,png,gif|max:2048',
        // category no longer required — keep old one
    ]);

    $data = [
        'name' => $request->name,
        'description' => $request->description,
        'category' => $product->category, // use existing category
    ];

    // only update if new image is uploaded
    if ($request->hasFile('image')) {
        $imageName = time() . '_' . $request->file('image')->getClientOriginalName();
        $request->file('image')->move(public_path('img'), $imageName);
        $data['image_path'] = 'img/' . $imageName;
    }

    $product->update($data);

    return redirect()->route('admin.products')->with('success', 'Product updated successfully!');
}



    public function destroy(Product $product)
    {
        $product->delete();
        return redirect()->route('admin.products')->with('success', 'Product deleted successfully!');
    }
}