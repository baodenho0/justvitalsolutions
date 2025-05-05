<?php

use App\Models\SiteSetting;
use Illuminate\Support\Facades\Cache;

if (!function_exists('setting')) {
    /**
     * Get a setting value by key.
     *
     * @param string|null $key
     * @param mixed $default
     * @return mixed
     */
    function setting($key = null, $default = null)
    {
        $settings = Cache::remember('site_settings', 3600, function () {
            $settings = SiteSetting::all();
            $result = [];

            foreach ($settings as $setting) {
                $value = null;

                // Handle different types of settings
                switch ($setting->type) {
                    case 'boolean':
                        $value = (bool) $setting->value;
                        break;
                    case 'number':
                        $value = (float) $setting->value;
                        break;
                    case 'array':
                    case 'json':
                        $decoded = json_decode($setting->value, true);
                        $value = is_null($decoded) ? [] : $decoded;
                        break;
                    default:
                        $value = $setting->value;
                }

                $result[$setting->key] = $value;
            }

            return $result;
        });

        if (is_null($key)) {
            return $settings;
        }

        return $settings[$key] ?? $default;
    }
}

if (!function_exists('clear_settings_cache')) {
    /**
     * Clear the settings cache.
     *
     * @return bool
     */
    function clear_settings_cache()
    {
        return Cache::forget('site_settings');
    }
}
