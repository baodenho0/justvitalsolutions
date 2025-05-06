<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ServiceController extends Controller
{
    /**
     * Display the services page settings.
     */
    public function index()
    {
        $service = \App\Models\Service::first() ?? new \App\Models\Service();

        return view('admin.services.index', compact('service'));
    }

    /**
     * Show the form for editing the services page.
     */
    public function edit()
    {
        $service = \App\Models\Service::first() ?? new \App\Models\Service();

        return view('admin.services.edit', compact('service'));
    }

    /**
     * Update the services page.
     */
    public function update(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'subtitle' => 'nullable|string|max:255',
            'intro_text' => 'nullable|string',
            'show_cta' => 'boolean',
            'cta_title' => 'nullable|string|max:255',
            'cta_description' => 'nullable|string',
            'cta_button_text' => 'nullable|string|max:255',
            'cta_button_url' => 'nullable|string|max:255',
            'is_active' => 'boolean',
        ]);

        // Handle banner image upload
        if ($request->hasFile('banner_image')) {
            $path = $request->file('banner_image')->store('public/services');
            $validated['banner_image'] = str_replace('public/', 'storage/', $path);
        }

        // Handle service items
        if ($request->has('service_items')) {
            $serviceItems = [];
            foreach ($request->service_items as $key => $item) {
                if (!empty($item['title'])) {
                    $serviceItem = [
                        'title' => $item['title'],
                        'description' => $item['description'] ?? '',
                        'icon' => $item['icon'] ?? 'ti-star',
                    ];

                    // Handle service item image upload
                    if (isset($item['image']) && $item['image'] instanceof \Illuminate\Http\UploadedFile) {
                        $path = $item['image']->store('public/services');
                        $serviceItem['image'] = str_replace('public/', 'storage/', $path);
                    } elseif (isset($item['existing_image'])) {
                        $serviceItem['image'] = $item['existing_image'];
                    }

                    $serviceItems[] = $serviceItem;
                }
            }
            $validated['service_items'] = $serviceItems;
        }

        // Handle process steps
        if ($request->has('process_steps')) {
            $processSteps = [];
            foreach ($request->process_steps as $key => $step) {
                if (!empty($step['title'])) {
                    $processStep = [
                        'title' => $step['title'],
                        'description' => $step['description'] ?? '',
                        'icon' => $step['icon'] ?? 'ti-package',
                    ];

                    $processSteps[] = $processStep;
                }
            }
            $validated['process_steps'] = $processSteps;
        }

        // Update or create the services page
        $service = \App\Models\Service::first();
        if ($service) {
            $service->update($validated);
        } else {
            \App\Models\Service::create($validated);
        }

        return redirect()->route('admin.services.index')->with('success', 'Services page updated successfully.');
    }
}
