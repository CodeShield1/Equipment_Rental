<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ProductController extends Controller
{
    public function index()
    {
        $products = Product::with('category')->latest()->get();
        return view('admin.products.index', compact('products'));
    }

    public function create()
    {
        $categories = Category::all();
        return view('admin.products.create', compact('categories'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required',
            'category_id' => 'required|exists:categories,id',
            'description' => 'nullable',
            'price_per_day' => 'required|numeric',
            'weight' => 'nullable|numeric', // New validation rule
            'fuel_type' => 'nullable|string', // New validation rule
            'brand' => 'nullable|string', // New validation rule
            'dimensions' => 'nullable|string', // New validation rule
            'image' => 'nullable|image|max:10240',
            'quantity_available' => 'required|integer|min:0', // New validation
            'city' => 'nullable|string', // New validation
        ]);

        if ($request->hasFile('image')) {
            $validated['image'] = $request->file('image')->store('products', 'public');
        }
        $validated['featured'] = $request->has('featured');

        Product::create($validated);
        return redirect()->route('admin.products.index')->with('success', 'Product created.');
    }

    public function edit(Product $product)
    {
        $categories = Category::all();
        return view('admin.products.edit', compact('product', 'categories'));
    }

    public function update(Request $request, Product $product)
    {

        $validated = $request->validate([
            'name' => 'required',
            'category_id' => 'required|exists:categories,id',
            'description' => 'nullable',
            'price_per_day' => 'required|numeric',
            'weight' => 'nullable|numeric', // New validation rule
            'fuel_type' => 'nullable|string', // New validation rule
            'brand' => 'nullable|string', // New validation rule
            'dimensions' => 'nullable|string', // New validation rule
            'image' => 'nullable|image|max:10240',
            'quantity_available' => 'required|integer|min:0', // New validation
            'city' => 'nullable|string', // New validation
        ]);


        if ($request->hasFile('image')) {
            // Delete old image
            if ($product->image) {
                Storage::disk('public')->delete($product->image);
            }
            $validated['image'] = $request->file('image')->store('products', 'public');
        }
        $validated['featured'] = $request->has('featured');

        $product->update($validated);
        return redirect()->route('admin.products.index')->with('success', 'Product updated.');
    }

    public function destroy(Product $product)
    {
        if ($product->image) {
            Storage::disk('public')->delete($product->image);
        }

        $product->delete();
        return redirect()->route('admin.products.index')->with('success', 'Product deleted.');
    }
}
