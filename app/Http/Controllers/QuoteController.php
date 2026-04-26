<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class QuoteController extends Controller
{
    // 1. Show the Quote Form
    public function index()
    {
        return view('quote.index'); // Points to resources/views/quote/index.blade.php
    }

    // 2. Process the Form Submission
    public function store(Request $request)
    {
        // Validate the incoming form data
        $validated = $request->validate([
                'name' => 'required|string|max:255',
                'email' => 'required|email',
                'details' => 'required|string',
                'phone' => 'nullable|string',
                'service-type' => 'required|string',
                'size' => 'required|string',
                'selected_materials' => 'nullable|string', // Catch the React data here!
            ]);

        // (Optional) Save to Database using a Model here
        // Quote::create($validated);

        // Send Email (Replacing your PHPMailer logic)
        // Mail::to('admin@example.com')->send(new \App\Mail\QuoteRequested($validated));

        // Redirect back with a success message
        return back()->with('success', 'Your quote request has been sent successfully!');
    }
}