<?php

namespace Database\Factories;

use App\Models\ContactSubmission;
use App\Models\Contact;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\ContactSubmission>
 */
class ContactSubmissionFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = ContactSubmission::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $isRead = $this->faker->boolean(70);

        return [
            'contact_id' => function () {
                return Contact::inRandomOrder()->first()?->id;
            },
            'name' => $this->faker->name(),
            'email' => $this->faker->email(),
            'subject' => $this->faker->sentence(),
            'message' => $this->faker->paragraphs(3, true),
            'phone' => $this->faker->phoneNumber(),
            'company' => $this->faker->optional(0.7)->company(),
            'read' => $isRead,
            'read_at' => $isRead ? $this->faker->dateTimeBetween('-1 week', 'now') : null,
            'created_at' => $this->faker->dateTimeBetween('-1 month', 'now'),
        ];
    }

    /**
     * Indicate that the submission is read.
     *
     * @return \Illuminate\Database\Eloquent\Factories\Factory
     */
    public function read()
    {
        return $this->state(function (array $attributes) {
            return [
                'read' => true,
                'read_at' => $this->faker->dateTimeBetween('-1 week', 'now'),
            ];
        });
    }

    /**
     * Indicate that the submission is unread.
     *
     * @return \Illuminate\Database\Eloquent\Factories\Factory
     */
    public function unread()
    {
        return $this->state(function (array $attributes) {
            return [
                'read' => false,
                'read_at' => null,
            ];
        });
    }
}
