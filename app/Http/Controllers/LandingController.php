<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Category;
use App\Models\Contact;
use Illuminate\Http\Request;


class LandingController extends Controller
{
    public function index()
    {
        $categories = Category::withCount('products')->get();
        $featured = Product::inRandomOrder()->take(4)->get();
        $mostRented = Product::withCount('rentals')->orderBy('rentals_count', 'desc')->take(4)->get();
        $latestProducts = Product::latest()->take(4)->get();

        return view('landing', compact('categories', 'featured', 'mostRented', 'latestProducts'));
    }

    public function contact(Request $request)
    {
        $request->validate([
            'first_name' => 'required',
            'last_name' => 'required',
            'email' => 'required|email',
            'phone' => 'required',
            'message' => 'required|min:10',
        ]);
    
        // Save the contact message to the database
        $contact = new Contact();
        $contact->first_name = $request->first_name;
        $contact->last_name = $request->last_name;
        $contact->email = $request->email;
        $contact->phone = $request->phone;
        $contact->message = $request->message;
        $contact->save();
    
    
        // Redirect back with success message
        return back()->with('success', 'Thank you! We will get back to you shortly.');
    }
    
}
