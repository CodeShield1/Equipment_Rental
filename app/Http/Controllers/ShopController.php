<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;

class ShopController extends Controller
{
    public function index(Request $request)
    {
        $categories = Category::all();
    
        // Fetching all products with categories
        $products = Product::with('category')->get();
    
        // Optionally, you can handle sorting and filtering logic here
        if ($request->has('category')) {
            $products = $products->where('category_id', $request->category);
        }
    
        if ($request->has('sort')) {
            if ($request->sort == 'price_asc') {
                $products = $products->sortBy('price_per_day');
            } elseif ($request->sort == 'price_desc') {
                $products = $products->sortByDesc('price_per_day');
            } else {
                $products = $products->sortBy('name');
            }
        }
    
        // Returning the view with the products and categories
        return view('shop.index', compact('categories', 'products'));
    }
    
    public function show(Product $product)
    {
        return view('shop.show', compact('product'));
    }
}
