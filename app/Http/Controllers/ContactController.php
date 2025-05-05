<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ContactController extends Controller
{
    /**
     * Display the contact page.
     */
    public function index()
    {
        // Get the active contact page content
        $contact = \App\Models\Contact::active()->first();

        // If no active contact page is found, create a default one
        if (!$contact) {
            $contact = \App\Models\Contact::create([
                'title' => 'Contact Us',
                'subtitle' => 'Get in touch with our team',
                'is_active' => true,
                'show_contact_form' => true,
                'form_title' => 'Send us a message',
                'form_description' => 'We\'ll get back to you as soon as possible.',
            ]);
        }

        // Settings are now automatically shared with all views
        return view('contact', compact('contact'));
    }

    /**
     * Store a new contact form submission.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'subject' => 'nullable|string|max:255',
            'message' => 'required|string',
            'phone' => 'nullable|string|max:20',
            'company' => 'nullable|string|max:255',
        ]);

        // Create the contact submission
        $submission = \App\Models\ContactSubmission::create($validated);

        return redirect()->back()->with('success', 'Your message has been sent successfully. We\'ll get back to you soon!');
    }


}
