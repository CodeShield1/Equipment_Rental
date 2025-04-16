<?php

namespace App\Http\Controllers;
use App\Models\Contact;

class AdminController extends Controller
{
    // Show all contact messages
    public function index()
    {
        $messages = Contact::all(); // Retrieve all contact messages from the database
        return view('admin.contact.index', compact('messages')); // Return a view with the messages
    }
}
