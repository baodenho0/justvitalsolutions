<?php

namespace Database\Seeders;

use App\Models\Feature;
use App\Models\LandingPageSection;
use App\Models\Testimonial;
use Illuminate\Database\Seeder;

class FoundryTemplateSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Create Hero Section (exactly as in the template)
        $heroSection = LandingPageSection::create([
            'name' => 'Hero Section',
            'title' => 'Built by designers,<br /> tailored to you.',
            'subtitle' => 'A simple, stylish way to showcase your product,<br /> built with Foundry & Variant Page Builder',
            'image' => 'img/appstore.png',
            'button_url' => '#',
            'background_image' => 'img/app8.jpg',
            'order' => 1,
            'is_active' => true,
            'section_type' => 'hero',
        ]);

        // Create Introduction Section (exactly as in the template)
        $introSection = LandingPageSection::create([
            'name' => 'Introduction Section',
            'title' => 'Meet Foundry, your new best friend.',
            'image' => 'img/app7.png',
            'order' => 2,
            'is_active' => true,
            'section_type' => 'intro',
        ]);

        // Add Features to Introduction Section
        Feature::create([
            'section_id' => $introSection->id,
            'title' => 'Screenshots for days',
            'description' => 'Utilize the near infinite number of Apple Watch mockups to showcase your app in clear context. Thank god for Dribbble, huh?',
            'order' => 1,
            'is_active' => true,
        ]);

        Feature::create([
            'section_id' => $introSection->id,
            'title' => 'Call off the search',
            'description' => 'This is it, that perfect template you\'ve been looking for. It\'s well built and sharp looking, goodbye competition!',
            'order' => 2,
            'is_active' => true,
        ]);

        // Create Features Section with icons (exactly as in the template)
        $featuresSection = LandingPageSection::create([
            'name' => 'Features Section',
            'title' => '',
            'subtitle' => '',
            'order' => 5,
            'is_active' => true,
            'section_type' => 'features',
            'background_color' => 'bg-secondary',
            'extra_data' => ([
                'feature_style' => 'icon-feature',
                'text_color' => 'text-white',
                'layout' => '3-column'
            ]),
        ]);

        // Add Features with icons (exactly as in the template)
        Feature::create([
            'section_id' => $featuresSection->id,
            'title' => 'Flexible Layouts',
            'description' => 'Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium, totam rem aperiam, eaque.',
            'icon' => 'ti-layers text-white icon-sm',
            'order' => 1,
            'is_active' => true,
            'extra_data' => ([
                'animation' => 'fade-in',
                'delay' => '0',
                'highlight' => false,
            ]),
        ]);

        Feature::create([
            'section_id' => $featuresSection->id,
            'title' => 'Timely Updates',
            'description' => 'Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium, totam rem aperiam, eaque.',
            'icon' => 'ti-pin text-white icon-sm',
            'order' => 2,
            'is_active' => true,
            'extra_data' => ([
                'animation' => 'fade-in',
                'delay' => '300',
                'highlight' => false,
            ]),
        ]);

        Feature::create([
            'section_id' => $featuresSection->id,
            'title' => 'Elite Author Item',
            'description' => 'Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium, totam rem aperiam, eaque.',
            'icon' => 'ti-import text-white icon-sm',
            'order' => 3,
            'is_active' => true,
            'extra_data' => ([
                'animation' => 'fade-in',
                'delay' => '600',
                'highlight' => false,
            ]),
        ]);

        // Create Testimonials Section (exactly as in the template)
        $testimonialsSection = LandingPageSection::create([
            'name' => 'Testimonials',
            'title' => 'Share meaningful moments with loved ones',
            'subtitle' => 'Neque porro quisquam est, qui dolorem ipsum quia dolor sit amet, consectetur, adipisci velit, sed quia non numquam eius modi tempora incidunt ut labore et dolore magnam.',
            'order' => 3,
            'is_active' => true,
            'section_type' => 'testimonials',
            'background_image' => 'img/app9.jpg',
        ]);

        // Create App Showcase Section (exactly as in the template)
        $showcaseSection = LandingPageSection::create([
            'name' => 'App Showcase',
            'image' => 'img/app5.png',
            'order' => 4,
            'is_active' => true,
            'section_type' => 'showcase',
            'extra_data' => ([
                'slider_images' => [
                    'img/app5.png',
                    'img/app5.png',
                    'img/app5.png'
                ]
            ]),
        ]);

        // Left column features
        Feature::create([
            'section_id' => $showcaseSection->id,
            'title' => 'Never forget again',
            'description' => 'The reminder that just keeps reminding! Scramble to your watch to silence these intrusive notifications.',
            'order' => 1,
            'is_active' => true,
            'extra_data' => ([
                'position' => 'left'
            ]),
        ]);

        Feature::create([
            'section_id' => $showcaseSection->id,
            'title' => 'Stay active, be healthy',
            'description' => 'No more personal responsibility! You\'ll now be constantly reminded to stand up and move around.',
            'order' => 2,
            'is_active' => true,
            'extra_data' => ([
                'position' => 'left'
            ]),
        ]);

        // Right column features
        Feature::create([
            'section_id' => $showcaseSection->id,
            'title' => 'Powered by you',
            'description' => 'Forget empty branding promises, this thing is powered by awesome (you), and we stand by that.',
            'order' => 3,
            'is_active' => true,
            'extra_data' => ([
                'position' => 'right'
            ]),
        ]);

        Feature::create([
            'section_id' => $showcaseSection->id,
            'title' => 'Leave your phone',
            'description' => 'And you wont be able to use the app! Make sure you have the phone within close proximity at all times!',
            'order' => 4,
            'is_active' => true,
            'extra_data' => ([
                'position' => 'right'
            ]),
        ]);

        // Shopping Cart section removed as requested

        // Create Call to Action Section (exactly as in the template)
        $ctaSection = LandingPageSection::create([
            'name' => 'Call to Action',
            'title' => 'Go on, buy it.',
            'subtitle' => 'Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium, totam rem aperiam, eaque.',
            'button_text' => 'I\'m ready to Start the journey',
            'button_url' => '#purhcase-template',
            'image' => 'img/app6.png',
            'order' => 6,
            'is_active' => true,
            'section_type' => 'cta',
            'background_color' => 'bg-dark',
            'extra_data' => ([
                'pb0' => true,
                'large_title' => true,
                'footer_attached' => true,
                'text_color' => 'text-white'
            ]),
        ]);
    }
}
