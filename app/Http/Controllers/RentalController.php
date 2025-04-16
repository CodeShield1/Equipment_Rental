<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Rental;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RentalController extends Controller
{
    public function create(Product $product)
    {
        return view('rentals.create', compact('product'));
    }

    public function store(Request $request, Product $product)
    {
        $request->validate([
            'start_date' => 'required|date|after_or_equal:today',
            'end_date' => 'required|date|after:start_date',
            'location' => 'required|string|max:255',
        ]);

        Rental::create([
            'user_id' => Auth::id(),
            'product_id' => $product->id,
            'start_date' => $request->start_date,
            'end_date' => $request->end_date,
            'location' => $request->location,
            'status' => 'pending',
        ]);

        return redirect()->route('rentals.index')->with('success', 'Rental request submitted. We will contact you soon.');
    }

    public function index()
    {
        $rentals = Rental::with('product')->where('user_id', Auth::id())->latest()->get();
        return view('rentals.index', compact('rentals'));
    }
}
