<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Rental;
use App\Models\Worker;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RentalController extends Controller
{
    public function create(Product $product)
    {
        // Get workers who are available in the same city as the product
        $workers = Worker::where('city', $product->city)
                        ->where('status', 'available')
                        ->get();
        
        return view('rentals.create', compact('product', 'workers'));
    }

    public function store(Request $request, Product $product)
    {
        $request->validate([
            'start_date' => 'required|date|after_or_equal:today',
            'end_date' => 'required|date|after:start_date',
            'location' => 'required|string|max:255',
            'worker_id' => 'nullable|exists:workers,id',
        ]);

        // Create the rental record
        Rental::create([
            'user_id' => Auth::id(),
            'product_id' => $product->id,
            'start_date' => $request->start_date,
            'end_date' => $request->end_date,
            'location' => $request->location,
            'worker_id' => $request->worker_id ?? null,
            'status' => 'pending',
        ]);

        // Decrease the product's available quantity for the selected city
        $product->quantity_available -= 1;
        $product->save();

        // Set the worker's availability to false
        if($request->worker_id) {
            $worker = Worker::find($request->worker_id);
            $worker->status = 'unavailable';
            $worker->save();
        }

        return redirect()->route('rentals.index')->with('success', 'Rental request submitted. We will contact you soon.');
    }

    public function index()
    {
        $rentals = Rental::with('product')->where('user_id', Auth::id())->latest()->get();
        return view('rentals.index', compact('rentals'));
    }
}
