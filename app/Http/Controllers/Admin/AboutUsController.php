<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class AboutUsController extends Controller
{
    /**
     * Display the about us page settings.
     */
    public function index()
    {
        $aboutUs = \App\Models\AboutUs::first() ?? new \App\Models\AboutUs();

        return view('admin.about-us.index', compact('aboutUs'));
    }

    /**
     * Show the form for editing the about us page.
     */
    public function edit()
    {
        $aboutUs = \App\Models\AboutUs::first() ?? new \App\Models\AboutUs();

        return view('admin.about-us.edit', compact('aboutUs'));
    }

    /**
     * Update the about us page.
     */
    public function update(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'subtitle' => 'nullable|string|max:255',
            'section1_title' => 'nullable|string|max:255',
            'section1_content' => 'nullable|string',
            'section2_title' => 'nullable|string|max:255',
            'section2_content' => 'nullable|string',
            'is_active' => 'boolean',
        ]);

        // Handle banner image upload
        if ($request->hasFile('banner_image')) {
            $path = $request->file('banner_image')->store('public/about-us');
            $validated['banner_image'] = str_replace('public/', 'storage/', $path);
        }

        // Handle skills
        if ($request->has('skills')) {
            $skills = [];
            foreach ($request->skills as $key => $skill) {
                if (!empty($skill['name']) && !empty($skill['percentage'])) {
                    $skills[] = [
                        'name' => $skill['name'],
                        'percentage' => $skill['percentage'],
                    ];
                }
            }
            $validated['skills'] = $skills;
        }

        // Handle team members
        if ($request->has('team_members')) {
            $teamMembers = [];
            foreach ($request->team_members as $key => $member) {
                if (!empty($member['name']) && !empty($member['position'])) {
                    $teamMember = [
                        'name' => $member['name'],
                        'position' => $member['position'],
                        'bio' => $member['bio'] ?? '',
                    ];

                    // Handle team member image upload
                    if (isset($member['image']) && $member['image'] instanceof \Illuminate\Http\UploadedFile) {
                        $path = $member['image']->store('public/team');
                        $teamMember['image'] = str_replace('public/', 'storage/', $path);
                    } elseif (isset($member['existing_image'])) {
                        $teamMember['image'] = $member['existing_image'];
                    }

                    $teamMembers[] = $teamMember;
                }
            }
            $validated['team_members'] = $teamMembers;
        }

        // Update or create the about us page
        $aboutUs = \App\Models\AboutUs::first();
        if ($aboutUs) {
            $aboutUs->update($validated);
        } else {
            \App\Models\AboutUs::create($validated);
        }

        return redirect()->route('admin.about-us.index')->with('success', 'About Us page updated successfully.');
    }
}
