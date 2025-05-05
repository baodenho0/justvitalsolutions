<?php

namespace Database\Seeders;

use App\Models\SiteSetting;
use Illuminate\Database\Seeder;

class SiteSettingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // General Settings
        $this->createSetting('site_name', 'Laravel Admin', 'general', 'text');
        $this->createSetting('site_description', 'A powerful Laravel admin panel', 'general', 'textarea');
        $this->createSetting('site_logo', 'uploads/settings/logo.png', 'general', 'image');
        $this->createSetting('site_favicon', 'uploads/settings/favicon.ico', 'general', 'image');
        $this->createSetting('admin_email', 'admin@example.com', 'general', 'text');

        // Menu Settings
        $menuItems = [
            [
                'text' => 'Home',
                'url' => '/'
            ],
            [
                'text' => 'About Us',
                'url' => '/about'
            ],
            [
                'text' => 'Services',
                'url' => '/services'
            ],
            [
                'text' => 'Blog',
                'url' => '/blog'
            ],
            [
                'text' => 'Contact',
                'url' => '/contact'
            ],
            [
                'text' => 'Login',
                'url' => '/login'
            ],
            [
                'text' => 'Register',
                'url' => '/register'
            ],
        ];
        $this->createSetting('menu_items', $menuItems, 'navigation', 'json');

        // Contact Information
        $this->createSetting('contact_email', 'contact@example.com', 'contact', 'text');
        $this->createSetting('contact_phone', '+1 (123) 456-7890', 'contact', 'text');
        $this->createSetting('contact_address', '123 Main Street, City, Country', 'contact', 'textarea');

        // Social Media Links
        $this->createSetting('social_facebook', 'https://facebook.com/example', 'social', 'text');
        $this->createSetting('social_twitter', 'https://twitter.com/example', 'social', 'text');
        $this->createSetting('social_instagram', 'https://instagram.com/example', 'social', 'text');
        $this->createSetting('social_linkedin', 'https://linkedin.com/company/example', 'social', 'text');
        $this->createSetting('social_youtube', 'https://youtube.com/channel/example', 'social', 'text');

        // SEO Settings
        $this->createSetting('meta_title', 'Laravel Admin Panel', 'seo', 'text');
        $this->createSetting('meta_description', 'A powerful admin panel built with Laravel', 'seo', 'textarea');
        $this->createSetting('meta_keywords', 'laravel, admin, panel, dashboard', 'seo', 'textarea');
        $this->createSetting('google_analytics_id', 'UA-XXXXXXXXX-X', 'seo', 'text');

        // Footer Settings
        $this->createSetting('footer_text', '© ' . date('Y') . ' Laravel Admin. All Rights Reserved', 'footer', 'text');
        $this->createSetting('footer_about', 'We are a team of passionate developers building amazing solutions for businesses worldwide.', 'footer', 'textarea');
        $this->createSetting('footer_contact_title', 'Contact Us', 'footer', 'text');
        $this->createSetting('footer_address', '123 Main Street, City, Country', 'footer', 'text');
        $this->createSetting('footer_phone', '+1 (123) 456-7890', 'footer', 'text');
        $this->createSetting('footer_email', 'contact@example.com', 'footer', 'text');
        $this->createSetting('footer_copyright', '© ' . date('Y') . ' Laravel Admin. All Rights Reserved', 'footer', 'text');
        $this->createSetting('site_logo_light', 'uploads/settings/logo-light.png', 'footer', 'image');
        $this->createSetting('site_logo_dark', 'uploads/settings/logo-dark.png', 'footer', 'image');

        // Email Settings
        $this->createSetting('mail_driver', 'smtp', 'email', 'text');
        $this->createSetting('mail_host', 'smtp.mailtrap.io', 'email', 'text');
        $this->createSetting('mail_port', '2525', 'email', 'text');
        $this->createSetting('mail_username', '', 'email', 'text');
        $this->createSetting('mail_password', '', 'email', 'text');
        $this->createSetting('mail_encryption', 'tls', 'email', 'text');
        $this->createSetting('mail_from_address', 'noreply@example.com', 'email', 'text');
        $this->createSetting('mail_from_name', 'Laravel Admin', 'email', 'text');
    }

    /**
     * Create or update a setting
     */
    private function createSetting(string $key, $value, string $group = 'general', string $type = 'text'): void
    {
        SiteSetting::setValue($key, $value, $group, $type);
    }
}
