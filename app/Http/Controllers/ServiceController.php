<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ServiceController extends Controller
{
    /**
     * Display the services page.
     */
    public function index()
    {
        // Get the active services page content
        $service = \App\Models\Service::active()->first();

        // If no active services page is found, create a default one
        if (!$service) {
            $service = \App\Models\Service::create([
                'title' => 'Our Services',
                'subtitle' => 'What we can do for you',
                'is_active' => true,
            ]);
        }

        // Get site settings
        $settings = $this->getSiteSettings();

        return view('services', compact('service', 'settings'));
    }

    /**
     * Get all site settings.
     */
    private function getSiteSettings()
    {
        return \Illuminate\Support\Facades\Cache::remember('site_settings', 3600, function () {
            $settings = \App\Models\SiteSetting::all();
            $result = [];

            foreach ($settings as $setting) {
                $result[$setting->key] = $setting->getValue($setting->key);
            }

            return $result;
        });
    }
}
