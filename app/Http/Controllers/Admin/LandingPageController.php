<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\LandingPageSection;
use App\Models\Feature;
use App\Models\Testimonial;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class LandingPageController extends Controller
{
    /**
     * Display a listing of the sections.
     */
    public function index()
    {
        $sections = LandingPageSection::ordered()->get();

        return view('admin.landing-page.index', compact('sections'));
    }

    /**
     * Show the form for creating a new section.
     */
    public function create()
    {
        $sectionTypes = [
            'hero' => 'Hero Section',
            'features' => 'Features Section',
            'about' => 'About Section',
            'testimonials' => 'Testimonials Section',
            'showcase' => 'Showcase Section',
            'intro' => 'Intro Section',
            'cta' => 'Call to Action',
            'contact' => 'Contact Section',
            'custom' => 'Custom Section',
        ];

        return view('admin.landing-page.create', compact('sectionTypes'));
    }

    /**
     * Store a newly created section in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'title' => 'nullable|string|max:255',
            'subtitle' => 'nullable|string',
            'content' => 'nullable|string',
            'button_text' => 'nullable|string|max:255',
            'button_url' => 'nullable|string|max:255',
            'order' => 'nullable|integer',
            'is_active' => 'boolean',
            'section_type' => 'required|string|max:255',
            'background_image' => 'nullable|image|max:2048',
            'images' => 'nullable|array',
            'images.*' => 'nullable|image|max:2048',
        ]);

        // Handle multiple image uploads
        $allImages = [];
        if ($request->hasFile('images')) {
            foreach ($request->file('images') as $image) {
                $imagePath = $this->uploadImage($image, 'sections');
                $allImages[] = $imagePath;
            }
        }

        // Set the first image as the main image and store all images in slider_images
        $extraData = [];
        if (!empty($allImages)) {
            // Filter out empty values
            $allImages = array_filter($allImages, function($image) {
                return !empty($image);
            });

            if (!empty($allImages)) {
                $allImages = array_values($allImages); // Re-index array
                $validated['image'] = $allImages[0];
                $extraData['slider_images'] = $allImages; // Store all images in slider_images
                $validated['extra_data'] = $extraData; // No need to json_encode
            }
        }

        if ($request->hasFile('background_image')) {
            $validated['background_image'] = $this->uploadImage($request->file('background_image'), 'backgrounds');
        }

        $section = LandingPageSection::create($validated);

        return redirect()->route('admin.landing-page.edit', $section->id)
            ->with('success', 'Section created successfully.');
    }

    /**
     * Show the form for editing the specified section.
     */
    public function edit($id)
    {
        $section = LandingPageSection::findOrFail($id);
        $sectionTypes = [
            'hero' => 'Hero Section',
            'features' => 'Features Section',
            'about' => 'About Section',
            'testimonials' => 'Testimonials Section',
            'showcase' => 'Showcase Section',
            'intro' => 'Intro Section',
            'cta' => 'Call to Action',
            'contact' => 'Contact Section',
            'custom' => 'Custom Section',
        ];

        return view('admin.landing-page.edit', compact('section', 'sectionTypes'));
    }

    /**
     * Update the specified section in storage.
     */
    public function update(Request $request, $id)
    {
        $section = LandingPageSection::findOrFail($id);
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'title' => 'nullable|string|max:255',
            'subtitle' => 'nullable|string',
            'content' => 'nullable|string',
            'button_text' => 'nullable|string|max:255',
            'button_url' => 'nullable|string|max:255',
            'order' => 'nullable|integer',
            'is_active' => 'boolean',
            'section_type' => 'required|string|max:255',
            'background_image' => 'nullable|image|max:2048',
            'slider_images' => 'nullable|array',
            'slider_images.*' => 'nullable|string',
            'images' => 'nullable|array',
            'images.*' => 'nullable|image|max:2048',
            'existing_images' => 'nullable|array',
            'existing_images.*' => 'nullable|string',
        ]);

        // Get or initialize extra_data
        $extraData = ($section->extra_data) ?: [];

        // Handle multiple image uploads
        $allImages = [];

        // Keep track of existing images that should be retained
        if ($request->has('existing_images')) {
            $existingImages = $request->existing_images;

            // Check if the main image is in the existing images list
            if ($section->image && in_array($section->image, $existingImages)) {
                $allImages[] = $section->image;
            } else if ($section->image) {
                // Delete the main image if it's not in the existing images list
                Storage::delete('public/' . $section->image);
                $validated['image'] = null;
            }

            // Filter additional images
            if (isset($extraData['additional_images']) && is_array($extraData['additional_images'])) {
                foreach ($extraData['additional_images'] as $additionalImage) {
                    if (in_array($additionalImage, $existingImages)) {
                        $allImages[] = $additionalImage;
                    } else {
                        // Delete the image if it's not in the existing images list
                        Storage::delete('public/' . $additionalImage);
                    }
                }
            }
        } else {
            // If no existing_images were submitted, delete all images
            if ($section->image) {
                Storage::delete('public/' . $section->image);
                $validated['image'] = null;
            }

            if (isset($extraData['additional_images']) && is_array($extraData['additional_images'])) {
                foreach ($extraData['additional_images'] as $additionalImage) {
                    Storage::delete('public/' . $additionalImage);
                }
            }
        }

        // Upload new images
        if ($request->hasFile('images')) {
            foreach ($request->file('images') as $image) {
                $imagePath = $this->uploadImage($image, 'sections');
                $allImages[] = $imagePath;
            }
        }

        // Set the first image as the main image and store all images in slider_images
        if (!empty($allImages)) {
            // Filter out empty values
            $allImages = array_filter($allImages, function($image) {
                return !empty($image);
            });

            if (!empty($allImages)) {
                $validated['image'] = $allImages[0];
                $extraData['slider_images'] = array_values($allImages); // Re-index array and store all images in slider_images
            } else {
                $validated['image'] = null;
                $extraData['slider_images'] = [];
            }
        } else {
            $validated['image'] = null;
            $extraData['slider_images'] = [];
        }

        // Remove additional_images if it exists
        if (isset($extraData['additional_images'])) {
            unset($extraData['additional_images']);
        }

        // Handle background image upload
        if ($request->hasFile('background_image')) {
            // Delete old background image if exists
            if ($section->background_image) {
                Storage::delete('public/' . $section->background_image);
            }
            $validated['background_image'] = $this->uploadImage($request->file('background_image'), 'backgrounds');
        }

        // Handle slider images for App Showcase section
        // Only update slider_images from the form if we're in showcase section
        // and the form has slider_images input fields
        if ($section->section_type === 'showcase' && $request->has('slider_images')) {
            // We'll keep the uploaded images and add any manually entered paths
            $manualSliderImages = array_filter($request->slider_images); // Remove empty values

            // If we have both uploaded and manual images, merge them
            if (!empty($manualSliderImages) && isset($extraData['slider_images'])) {
                $extraData['slider_images'] = array_unique(array_merge($extraData['slider_images'], $manualSliderImages));
            }
        }

        // Ensure slider_images doesn't have empty values and is properly indexed
        if (isset($extraData['slider_images'])) {
            $extraData['slider_images'] = array_values(array_filter($extraData['slider_images'], function($image) {
                return !empty($image);
            }));
        }

        // Save the extra_data - no need to json_encode as Laravel will handle this via $casts
        $validated['extra_data'] = $extraData;

        $section->update($validated);

        return redirect()->route('admin.landing-page.index')
            ->with('success', 'Section updated successfully.');
    }

    /**
     * Remove the specified section from storage.
     */
    public function destroy($id)
    {
        $section = LandingPageSection::findOrFail($id);

        // Delete associated images
        if ($section->image) {
            Storage::delete('public/' . $section->image);
        }

        if ($section->background_image) {
            Storage::delete('public/' . $section->background_image);
        }

        $section->delete();

        return redirect()->route('admin.landing-page.index')
            ->with('success', 'Section deleted successfully.');
    }

    /**
     * Manage features for a section.
     */
    public function features($id)
    {
        $section = LandingPageSection::findOrFail($id);
        $features = $section->features()->ordered()->get();

        return view('admin.landing-page.features', compact('section', 'features'));
    }

    /**
     * Store a new feature.
     */
    public function storeFeature(Request $request, $id)
    {
        $section = LandingPageSection::findOrFail($id);
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'icon' => 'nullable|string|max:255',
            'image' => 'nullable|image|max:2048',
            'order' => 'nullable|integer',
            'is_active' => 'boolean',
            'position' => 'nullable|string|in:left,right',
        ]);

        // Handle image upload
        if ($request->hasFile('image')) {
            $validated['image'] = $this->uploadImage($request->file('image'), 'features');
        }

        // Handle position for App Showcase section
        $extraData = [];
        if ($request->filled('position')) {
            $extraData['position'] = $request->position;
            $validated['extra_data'] = $extraData; // No need to json_encode
        }

        $section->features()->create($validated);

        return redirect()->route('admin.landing-page.features', $section->id)
            ->with('success', 'Feature added successfully.');
    }

    /**
     * Update a feature.
     */
    public function updateFeature(Request $request, $id)
    {
        $feature = Feature::findOrFail($id);
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'icon' => 'nullable|string|max:255',
            'image' => 'nullable|image|max:2048',
            'order' => 'nullable|integer',
            'is_active' => 'boolean',
            'position' => 'nullable|string|in:left,right',
        ]);

        // Handle image upload
        if ($request->hasFile('image')) {
            // Delete old image if exists
            if ($feature->image) {
                Storage::delete('public/' . $feature->image);
            }
            $validated['image'] = $this->uploadImage($request->file('image'), 'features');
        }

        // Handle position for App Showcase section
        $extraData = ($feature->extra_data) ?: [];
        if ($request->filled('position')) {
            $extraData['position'] = $request->position;
        } elseif (isset($extraData['position'])) {
            unset($extraData['position']);
        }
        $validated['extra_data'] = $extraData; // No need to json_encode

        $feature->update($validated);

        return redirect()->route('admin.landing-page.features', $feature->section_id)
            ->with('success', 'Feature updated successfully.');
    }

    /**
     * Delete a feature.
     */
    public function destroyFeature($id)
    {
        $feature = Feature::findOrFail($id);
        $sectionId = $feature->section_id;

        // Delete associated image
        if ($feature->image) {
            Storage::delete('public/' . $feature->image);
        }

        $feature->delete();

        return redirect()->route('admin.landing-page.features', $sectionId)
            ->with('success', 'Feature deleted successfully.');
    }

    /**
     * Manage testimonials for a section.
     */
    public function testimonials($id)
    {
        $section = LandingPageSection::findOrFail($id);
        $testimonials = $section->testimonials()->ordered()->get();

        return view('admin.landing-page.testimonials', compact('section', 'testimonials'));
    }

    /**
     * Store a new testimonial.
     */
    public function storeTestimonial(Request $request, $id)
    {
        $section = LandingPageSection::findOrFail($id);
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'position' => 'nullable|string|max:255',
            'company' => 'nullable|string|max:255',
            'content' => 'required|string',
            'image' => 'nullable|image|max:2048',
            'rating' => 'nullable|integer|min:1|max:5',
            'order' => 'nullable|integer',
            'is_active' => 'boolean',
        ]);

        // Handle image upload
        if ($request->hasFile('image')) {
            $validated['image'] = $this->uploadImage($request->file('image'), 'testimonials');
        }

        $section->testimonials()->create($validated);

        return redirect()->route('admin.landing-page.testimonials', $section->id)
            ->with('success', 'Testimonial added successfully.');
    }

    /**
     * Update a testimonial.
     */
    public function updateTestimonial(Request $request, $id)
    {
        $testimonial = Testimonial::findOrFail($id);
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'position' => 'nullable|string|max:255',
            'company' => 'nullable|string|max:255',
            'content' => 'required|string',
            'image' => 'nullable|image|max:2048',
            'rating' => 'nullable|integer|min:1|max:5',
            'order' => 'nullable|integer',
            'is_active' => 'boolean',
        ]);

        // Handle image upload
        if ($request->hasFile('image')) {
            // Delete old image if exists
            if ($testimonial->image) {
                Storage::delete('public/' . $testimonial->image);
            }
            $validated['image'] = $this->uploadImage($request->file('image'), 'testimonials');
        }

        $testimonial->update($validated);

        return redirect()->route('admin.landing-page.testimonials', $testimonial->section_id)
            ->with('success', 'Testimonial updated successfully.');
    }

    /**
     * Delete a testimonial.
     */
    public function destroyTestimonial($id)
    {
        $testimonial = Testimonial::findOrFail($id);
        $sectionId = $testimonial->section_id;

        // Delete associated image
        if ($testimonial->image) {
            Storage::delete('public/' . $testimonial->image);
        }

        $testimonial->delete();

        return redirect()->route('admin.landing-page.testimonials', $sectionId)
            ->with('success', 'Testimonial deleted successfully.');
    }


}
