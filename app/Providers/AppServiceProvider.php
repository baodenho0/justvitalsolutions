<?php

namespace App\Providers;

use App\Models\SiteSetting;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        // Share site settings with all views
        View::composer('*', function ($view) {
            $settings = Cache::remember('site_settings', 3600, function () {
                $settings = SiteSetting::all();
                $result = [];

                foreach ($settings as $setting) {
                    $result[$setting->key] = $setting->getValue($setting->key);
                }

                return $result;
            });

            $view->with('settings', $settings);
        });
    }
}
