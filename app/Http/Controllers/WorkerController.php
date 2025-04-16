<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Worker;
use Illuminate\Http\Request;

// Run: php artisan make:controller WorkerController
class WorkerController extends Controller
{
    public function index()
    {
        $workers = Worker::all(); // Get all workers
        return view('admin.workers.index', compact('workers'));
    }


    public function create()
    {
        $products = Product::all(); // Fetch all products to link with workers
        return view('admin.workers.create', compact('products'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required|email',
            'status' => 'required|in:available,unavailable',
            'image' => 'nullable|image',
            'equipment' => 'nullable|array',
        ]);

        $worker = Worker::create($request->only(['name', 'email', 'status']));

        // Handle Image Upload
        if ($request->hasFile('image')) {
            $worker->image = $request->file('image')->store('workers');
            $worker->save();
        }

        // Attach selected equipment
        if ($request->equipment) {
            $worker->products()->attach($request->equipment);
        }

        return redirect()->route('admin.workers.index');
    }

    public function edit(Worker $worker)
    {
        $products = Product::all(); // Fetch all products to link with workers
        return view('admin.workers.edit', compact('worker', 'products'));
    }

    public function update(Request $request, Worker $worker)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required|email',
            'status' => 'required|in:available,unavailable',
            'image' => 'nullable|image',
            'equipment' => 'nullable|array',
        ]);

        $worker->update($request->only(['name', 'email', 'status']));

        // Handle Image Upload
        if ($request->hasFile('image')) {
            $worker->image = $request->file('image')->store('workers');
            $worker->save();
        }

        // Sync selected equipment
        if ($request->equipment) {
            $worker->products()->sync($request->equipment);
        }

        return redirect()->route('admin.workers.index');
    }

    public function destroy(Worker $worker)
    {
        $worker->delete();
        return redirect()->route('admin.workers.index')->with('success', 'Worker deleted successfully.');
    }
}
