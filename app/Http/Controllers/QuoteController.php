<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Quote;

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
                'phone' => ['nullable', 'string', 'regex:/^([0-9\s\-\+\(\)]*)$/'],
                'service-type' => 'required|string',
                'custom_service_type' => 'nullable|string|max:255',
                'size' => 'required|string',
                'custom_size' => 'nullable|string|max:255',
                'selected_materials' => 'nullable|string',
                'inspiration_image' => 'nullable|image|mimes:jpeg,png,jpg|max:5120',
            ]);

        $imagePath = null;
        if ($request->hasFile('inspiration_image')) {
            $imagePath = $request->file('inspiration_image')->store('inspirations', 'public');
        }

        // Save to Database
        Quote::create([
            'name' => $validated['name'],
            'email' => $validated['email'],
            'phone' => $validated['phone'],
            'service_type' => $validated['service-type'],
            'custom_service_type' => $validated['custom_service_type'] ?? null,
            'details' => $validated['details'],
            'selected_materials' => $validated['selected_materials'],
            'size' => $validated['size'],
            'custom_size' => $validated['custom_size'] ?? null,
            'inspiration_image' => $imagePath,
        ]);

        // (Optional) Send Email
        // Mail::to('admin@example.com')->send(new \App\Mail\QuoteRequested($validated));


        // Redirect back with a success message
        return back()->with('success', 'Your quote request has been sent successfully!');
    }
}