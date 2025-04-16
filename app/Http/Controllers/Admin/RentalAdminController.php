<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Rental;
use Illuminate\Http\Request;

class RentalAdminController extends Controller
{
    public function index(Request $request)
    {
        $status = $request->query('status');
    
        $rentals = Rental::with(['product', 'user'])
            ->when($status, fn($query) => $query->where('status', $status))
            ->latest()
            ->get();
    
        return view('admin.rentals.index', compact('rentals', 'status'));
    }
    
    public function update(Request $request, Rental $rental)
    {
        $request->validate([
            'status' => 'required|in:pending,confirmed,completed',
        ]);

        $rental->update(['status' => $request->status]);

        return redirect()->back()->with('success', 'Rental status updated.');
    }

    public function destroy(Rental $rental)
    {
        $rental->delete();
        return redirect()->back()->with('success', 'Rental deleted.');
    }
}
