<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class CategoryController extends Controller
{
    public function index()
    {
        $categories = Category::latest()->get();
        return view('admin.categories.index', compact('categories'));
    }

    public function create()
    {
        return view('admin.categories.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'image' => 'nullable|image|max:10240', // Validating the image
        ]);
    
        $validated = $request->only('name');
    
        if ($request->hasFile('image')) {
            $validated['image'] = $request->file('image')->store('categories', 'public');
        }
    
        Category::create($validated);
    
        return redirect()->route('admin.categories.index')->with('success', 'Category created.');
    }
    
    public function edit(Category $category)
    {
        return view('admin.categories.edit', compact('category'));
    }

    public function update(Request $request, Category $category)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'image' => 'nullable|image|max:10240', // Validating the image
        ]);
    
        $validated = $request->only('name');
    
        if ($request->hasFile('image')) {
            // Delete the old image if exists
            if ($category->image) {
                Storage::disk('public')->delete($category->image);
            }
    
            // Store the new image
            $validated['image'] = $request->file('image')->store('categories', 'public');
        }
    
        $category->update($validated);
    
        return redirect()->route('admin.categories.index')->with('success', 'Category updated.');
    }
    
    public function destroy(Category $category)
    {
        $category->delete();
        return redirect()->route('admin.categories.index')->with('success', 'Category deleted.');
    }
}
