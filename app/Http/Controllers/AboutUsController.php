<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AboutUsController extends Controller
{
    /**
     * Display the about us page.
     */
    public function index()
    {
        // Get the active about us page content
        $aboutUs = \App\Models\AboutUs::active()->first();

        // If no active about us page is found, create a default one
        if (!$aboutUs) {
            $aboutUs = \App\Models\AboutUs::create([
                'title' => 'About Us',
                'subtitle' => 'Learn more about our company',
                'is_active' => true,
            ]);
        }

        // Get site settings
        $settings = $this->getSiteSettings();

        return view('about-us', compact('aboutUs', 'settings'));
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
