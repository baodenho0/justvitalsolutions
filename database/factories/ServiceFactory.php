<?php

namespace Database\Factories;

use App\Models\Service;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Service>
 */
class ServiceFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Service::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'title' => 'Our Services',
            'subtitle' => 'What we can do for you',
            'banner_image' => 'storage/services/services-banner.jpg',
            'intro_text' => $this->faker->paragraphs(2, true),
            'service_items' => [
                [
                    'title' => 'Web Development',
                    'description' => $this->faker->paragraphs(1, true),
                    'icon' => 'ti-desktop',
                    'image' => 'storage/services/web-dev.jpg',
                ],
                [
                    'title' => 'Mobile App Development',
                    'description' => $this->faker->paragraphs(1, true),
                    'icon' => 'ti-mobile',
                    'image' => 'storage/services/mobile-dev.jpg',
                ],
                [
                    'title' => 'UI/UX Design',
                    'description' => $this->faker->paragraphs(1, true),
                    'icon' => 'ti-palette',
                    'image' => 'storage/services/ui-design.jpg',
                ],
                [
                    'title' => 'Digital Marketing',
                    'description' => $this->faker->paragraphs(1, true),
                    'icon' => 'ti-announcement',
                    'image' => 'storage/services/digital-marketing.jpg',
                ],
            ],
            'show_cta' => true,
            'cta_title' => 'Ready to get started?',
            'cta_description' => 'Contact us today to discuss your project and how we can help you achieve your goals.',
            'cta_button_text' => 'Get in Touch',
            'cta_button_url' => '/contact',
            'is_active' => true,
        ];
    }
}
