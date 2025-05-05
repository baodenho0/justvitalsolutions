<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\SiteSetting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class SiteSettingController extends Controller
{
    /**
     * Display a listing of the settings.
     */
    public function index(Request $request)
    {
        $groups = SiteSetting::select('group')->distinct()->pluck('group');
        $currentGroup = $request->get('group', 'general');

        $settings = SiteSetting::where('group', $currentGroup)
            ->orderBy('key')
            ->get();

        return view('admin.settings.index', compact('settings', 'groups', 'currentGroup'));
    }

    /**
     * Show the form for creating a new setting.
     */
    public function create()
    {
        $types = [
            'text' => 'Text',
            'textarea' => 'Textarea',
            'number' => 'Number',
            'boolean' => 'Boolean',
            'image' => 'Image',
            'color' => 'Color',
            'json' => 'JSON',
        ];

        $groups = SiteSetting::select('group')->distinct()->pluck('group');

        return view('admin.settings.create', compact('types', 'groups'));
    }

    /**
     * Store a newly created setting in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'key' => 'required|string|max:255|unique:site_settings',
            'value' => 'nullable',
            'group' => 'required|string|max:255',
            'type' => 'required|string|max:255',
            'image' => 'nullable|image|max:2048',
        ]);

        // Handle different types of settings
        if ($validated['type'] === 'image' && $request->hasFile('image')) {
            $validated['value'] = $this->uploadImage($request->file('image'), 'settings');
        } elseif ($validated['type'] === 'boolean') {
            $validated['value'] = $request->has('value') ? '1' : '0';
        } elseif ($validated['type'] === 'json' && is_array($request->value)) {
            $validated['value'] = json_encode($request->value);
        }

        SiteSetting::create($validated);

        // Clear cache
        Cache::forget('site_settings');

        return redirect()->route('admin.settings.index', ['group' => $validated['group']])
            ->with('success', 'Setting created successfully.');
    }

    /**
     * Show the form for editing the specified setting.
     */
    public function edit(SiteSetting $setting)
    {
        $types = [
            'text' => 'Text',
            'textarea' => 'Textarea',
            'number' => 'Number',
            'boolean' => 'Boolean',
            'image' => 'Image',
            'color' => 'Color',
            'json' => 'JSON',
        ];

        $groups = SiteSetting::select('group')->distinct()->pluck('group');

        return view('admin.settings.edit', compact('setting', 'types', 'groups'));
    }

    /**
     * Update the specified setting in storage.
     */
    public function update(Request $request, SiteSetting $setting)
    {
        $validated = $request->validate([
            'key' => 'required|string|max:255|unique:site_settings,key,' . $setting->id,
            'value' => 'nullable',
            'group' => 'required|string|max:255',
            'type' => 'required|string|max:255',
            'image' => 'nullable|image|max:2048',
        ]);

        // Handle different types of settings
        if ($validated['type'] === 'image' && $request->hasFile('image')) {
            // Delete old image if exists
            if ($setting->type === 'image' && $setting->value) {
                Storage::delete('public/' . $setting->value);
            }
            $validated['value'] = $this->uploadImage($request->file('image'), 'settings');
        } elseif ($validated['type'] === 'boolean') {
            $validated['value'] = $request->has('value') ? '1' : '0';
        } elseif ($validated['type'] === 'json' && is_array($request->value)) {
            $validated['value'] = json_encode($request->value);
        }

        $setting->update($validated);

        // Clear cache
        Cache::forget('site_settings');

        return redirect()->route('admin.settings.index', ['group' => $validated['group']])
            ->with('success', 'Setting updated successfully.');
    }

    /**
     * Remove the specified setting from storage.
     */
    public function destroy(SiteSetting $setting)
    {
        $group = $setting->group;

        // Delete associated image
        if ($setting->type === 'image' && $setting->value) {
            Storage::delete('public/' . $setting->value);
        }

        $setting->delete();

        // Clear cache
        Cache::forget('site_settings');

        return redirect()->route('admin.settings.index', ['group' => $group])
            ->with('success', 'Setting deleted successfully.');
    }

    /**
     * Update multiple settings at once.
     */
    public function updateBatch(Request $request)
    {
        $settings = $request->except('_token', '_method', 'group');
        $group = $request->input('group', 'general');

        foreach ($settings as $key => $value) {
            $setting = SiteSetting::where('key', $key)->first();

            if ($setting) {
                // Handle different types of settings
                if ($setting->type === 'boolean') {
                    $value = isset($value) ? '1' : '0';
                } elseif ($setting->type === 'json' && is_array($value)) {
                    $value = json_encode($value);
                }

                $setting->update(['value' => $value]);
            }
        }

        // Clear cache
        Cache::forget('site_settings');

        return redirect()->route('admin.settings.index', ['group' => $group])
            ->with('success', 'Settings updated successfully.');
    }

    /**
     * Upload an image and return the path.
     */
    private function uploadImage($image, $folder)
    {
        $filename = Str::random(20) . '.' . $image->getClientOriginalExtension();
        $path = $image->storeAs("uploads/{$folder}", $filename, 'public');
        return $path;
    }
}
