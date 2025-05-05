<?php

namespace App\Http\Controllers;

use App\Models\LandingPageSection;
use App\Models\SiteSetting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;

class LandingPageController extends Controller
{
    /**
     * Display the landing page.
     */
    public function index()
    {
        // Get all active sections ordered by their order value
        $sections = LandingPageSection::with(['features'])
            ->active()
            ->ordered()
            ->get();

        // Get site settings
        $settings = $this->getSiteSettings();

        return view('landing-page', compact('sections', 'settings'));
    }

    /**
     * Get all site settings.
     */
    private function getSiteSettings()
    {
        return Cache::remember('site_settings', 3600, function () {
            $settings = SiteSetting::all();
            $result = [];

            foreach ($settings as $setting) {
                $result[$setting->key] = $setting->getValue($setting->key);
            }

            return $result;
        });
    }
}
