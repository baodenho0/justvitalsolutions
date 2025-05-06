<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Service;

class ServiceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Create default Services page
        Service::create([
            'title' => 'Our Services',
            'subtitle' => 'What we can do for you',
            'banner_image' => 'storage/services/services-banner.jpg',
            'intro_text' => '<p>We offer a comprehensive range of services designed to help your business grow and succeed in today\'s competitive market. Our team of experts is dedicated to delivering high-quality solutions tailored to your specific needs.</p>',
            'service_items' => [
                [
                    'title' => 'Web Development',
                    'description' => '<p>We create responsive, user-friendly websites that are optimized for performance and search engines. Our web development services include custom website design, e-commerce solutions, content management systems, and web application development.</p>',
                    'icon' => 'ti-desktop',
                    'image' => 'storage/services/web-dev.jpg',
                ],
                [
                    'title' => 'Mobile App Development',
                    'description' => '<p>Our mobile app development team creates intuitive, feature-rich applications for iOS and Android platforms. We focus on delivering seamless user experiences, robust functionality, and visually appealing designs.</p>',
                    'icon' => 'ti-mobile',
                    'image' => 'storage/services/mobile-dev.jpg',
                ],
                [
                    'title' => 'UI/UX Design',
                    'description' => '<p>Our design team creates visually stunning and user-friendly interfaces that enhance user engagement and satisfaction. We follow a user-centered design approach to ensure that your digital products are intuitive and easy to use.</p>',
                    'icon' => 'ti-palette',
                    'image' => 'storage/services/ui-design.jpg',
                ],
                [
                    'title' => 'Digital Marketing',
                    'description' => '<p>We offer comprehensive digital marketing services to help you reach your target audience and achieve your business goals. Our services include search engine optimization (SEO), social media marketing, content marketing, and pay-per-click (PPC) advertising.</p>',
                    'icon' => 'ti-announcement',
                    'image' => 'storage/services/digital-marketing.jpg',
                ],
                [
                    'title' => 'Branding & Identity',
                    'description' => '<p>We help businesses establish a strong brand identity that resonates with their target audience. Our branding services include logo design, brand strategy, visual identity development, and brand guidelines creation.</p>',
                    'icon' => 'ti-crown',
                    'image' => 'storage/services/branding.jpg',
                ],
                [
                    'title' => 'Consulting & Strategy',
                    'description' => '<p>Our consulting services provide expert guidance and strategic insights to help you navigate challenges and capitalize on opportunities. We work closely with you to develop tailored strategies that drive growth and success.</p>',
                    'icon' => 'ti-light-bulb',
                    'image' => 'storage/services/consulting.jpg',
                ],
            ],
            'process_steps' => [
                [
                    'title' => 'Research & Ideate',
                    'description' => 'Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium, totam rem aperiam, eaque ipsa quae.',
                    'icon' => 'ti-agenda',
                ],
                [
                    'title' => 'Design & Iterate',
                    'description' => 'Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium, totam rem aperiam, eaque ipsa quae.',
                    'icon' => 'ti-pencil-alt2',
                ],
                [
                    'title' => 'Ship & Support',
                    'description' => 'Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium, totam rem aperiam, eaque ipsa quae.',
                    'icon' => 'ti-package',
                ],
            ],
            'show_cta' => true,
            'cta_title' => 'Ready to get started?',
            'cta_description' => 'Contact us today to discuss your project and how we can help you achieve your goals.',
            'cta_button_text' => 'Get in Touch',
            'cta_button_url' => '/contact',
            'is_active' => true,
        ]);
    }
}
