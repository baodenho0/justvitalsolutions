<?php

namespace Database\Factories;

use App\Models\AboutUs;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\AboutUs>
 */
class AboutUsFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = AboutUs::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'title' => 'About ' . $this->faker->company(),
            'subtitle' => $this->faker->catchPhrase(),
            'banner_image' => 'storage/about-us/about-banner.jpg',
            'section1_title' => 'Our Story',
            'section1_content' => $this->faker->paragraphs(3, true),
            'section2_title' => 'Our Expertise',
            'section2_content' => $this->faker->paragraphs(2, true),
            'skills' => [
                [
                    'name' => 'Web Development',
                    'percentage' => $this->faker->numberBetween(80, 95),
                ],
                [
                    'name' => 'UI/UX Design',
                    'percentage' => $this->faker->numberBetween(75, 90),
                ],
                [
                    'name' => 'Mobile Development',
                    'percentage' => $this->faker->numberBetween(70, 90),
                ],
                [
                    'name' => 'Digital Marketing',
                    'percentage' => $this->faker->numberBetween(65, 85),
                ],
            ],
            'team_members' => [
                [
                    'name' => $this->faker->name(),
                    'position' => 'CEO & Founder',
                    'bio' => $this->faker->sentence(15),
                    'image' => 'storage/team/team1.jpg',
                ],
                [
                    'name' => $this->faker->name(),
                    'position' => 'Creative Director',
                    'bio' => $this->faker->sentence(15),
                    'image' => 'storage/team/team2.jpg',
                ],
                [
                    'name' => $this->faker->name(),
                    'position' => 'Lead Developer',
                    'bio' => $this->faker->sentence(15),
                    'image' => 'storage/team/team3.jpg',
                ],
            ],
            'is_active' => true,
        ];
    }
}
