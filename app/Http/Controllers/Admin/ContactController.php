<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ContactController extends Controller
{
    /**
     * Display the contact page settings.
     */
    public function index()
    {
        $contact = \App\Models\Contact::first() ?? new \App\Models\Contact();

        return view('admin.contact.index', compact('contact'));
    }

    /**
     * Show the form for editing the contact page.
     */
    public function edit()
    {
        $contact = \App\Models\Contact::first() ?? new \App\Models\Contact();

        return view('admin.contact.edit', compact('contact'));
    }

    /**
     * Update the contact page.
     */
    public function update(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'subtitle' => 'nullable|string|max:255',
            'intro_text' => 'nullable|string',
            'address' => 'nullable|string|max:255',
            'phone' => 'nullable|string|max:20',
            'email' => 'nullable|email|max:255',
            'map_embed_code' => 'nullable|string',
            'show_contact_form' => 'boolean',
            'form_title' => 'nullable|string|max:255',
            'form_description' => 'nullable|string',
            'is_active' => 'boolean',
        ]);

        // Handle banner image upload
        if ($request->hasFile('banner_image')) {
            $validated['banner_image'] = $this->uploadImage($request->file('banner_image'), 'contact');
        }

        // Handle office hours
        if ($request->has('office_hours')) {
            $officeHours = [];
            foreach ($request->office_hours as $key => $hours) {
                if (!empty($hours['day']) && !empty($hours['hours'])) {
                    $officeHours[] = [
                        'day' => $hours['day'],
                        'hours' => $hours['hours'],
                    ];
                }
            }
            $validated['office_hours'] = $officeHours;
        }

        // Update or create the contact page
        $contact = \App\Models\Contact::first();
        if ($contact) {
            $contact->update($validated);
        } else {
            \App\Models\Contact::create($validated);
        }

        return redirect()->route('admin.contact.index')->with('success', 'Contact page updated successfully.');
    }

    /**
     * Display the contact form submissions.
     */
    public function submissions()
    {
        $submissions = \App\Models\ContactSubmission::latest()->paginate(10);

        return view('admin.contact.submissions', compact('submissions'));
    }

    /**
     * Show a specific contact form submission.
     */
    public function showSubmission($id)
    {
        $submission = \App\Models\ContactSubmission::findOrFail($id);

        // Mark as read if not already
        if (!$submission->read) {
            $submission->markAsRead();
        }

        return view('admin.contact.submission-show', compact('submission'));
    }

    /**
     * Delete a contact form submission.
     */
    public function deleteSubmission($id)
    {
        $submission = \App\Models\ContactSubmission::findOrFail($id);
        $submission->delete();

        return redirect()->route('admin.contact.submissions')->with('success', 'Submission deleted successfully.');
    }
}
