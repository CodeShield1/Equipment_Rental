<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;

class ShopController extends Controller
{
    public function index(Request $request)
    {
        $query = Product::query();
        
        // Filtering by category
        if ($request->has('category') && $request->category != '') {
            $query->where('category_id', $request->category);
        }
        
        // Filtering by city
        if ($request->has('city') && $request->city != '') {
            $query->where('city', $request->city);
        }
    
        // Sorting
        if ($request->has('sort')) {
            if ($request->sort == 'price_asc') {
                $query->orderBy('price_per_day', 'asc');
            } elseif ($request->sort == 'price_desc') {
                $query->orderBy('price_per_day', 'desc');
            } elseif ($request->sort == 'name') {
                $query->orderBy('name', 'asc');
            }
        }
        
        // Get the filtered and sorted products
        $products = $query->paginate(12);  // Paginate results as needed
        
        // Pass the products and categories to the view
        return view('shop.index', [
            'products' => $products,
            'categories' => Category::all(),
            'cities' => Product::select('city')->distinct()->get(), // Get unique cities
        ]);
    }
    
        
    public function show(Product $product)
    {
        return view('shop.show', compact('product'));
    }
}
