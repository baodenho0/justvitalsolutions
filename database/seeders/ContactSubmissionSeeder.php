<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\ContactSubmission;
use Carbon\Carbon;

class ContactSubmissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Create sample contact form submissions
        $submissions = [
            [
                'name' => 'John Smith',
                'email' => 'john.smith@example.com',
                'subject' => 'Website Redesign Inquiry',
                'message' => "Hello,\n\nI'm interested in redesigning our company website. We're a small business in the healthcare industry and our current website is outdated. Could you provide information about your web design services and pricing?\n\nThank you,\nJohn Smith",
                'phone' => '(555) 123-4567',
                'company' => 'Smith Healthcare',
                'read' => true,
                'read_at' => Carbon::now()->subDays(2),
                'created_at' => Carbon::now()->subDays(5),
            ],
            [
                'name' => 'Sarah Johnson',
                'email' => 'sarah.johnson@example.com',
                'subject' => 'Mobile App Development',
                'message' => "Hi there,\n\nI'm looking for a company to develop a mobile app for my startup. We have a detailed requirements document and some initial wireframes. I'd like to schedule a consultation to discuss this project further.\n\nBest regards,\nSarah Johnson",
                'phone' => '(555) 987-6543',
                'company' => 'TechStart Inc.',
                'read' => true,
                'read_at' => Carbon::now()->subDays(1),
                'created_at' => Carbon::now()->subDays(3),
            ],
            [
                'name' => 'Michael Brown',
                'email' => 'michael.brown@example.com',
                'subject' => 'SEO Services Question',
                'message' => "Hello,\n\nI'm interested in improving the search engine ranking for my e-commerce website. Could you tell me more about your SEO services and what kind of results I can expect?\n\nThanks,\nMichael Brown",
                'phone' => '(555) 456-7890',
                'company' => 'Brown\'s Online Shop',
                'read' => false,
                'read_at' => null,
                'created_at' => Carbon::now()->subDays(1),
            ],
            [
                'name' => 'Emily Davis',
                'email' => 'emily.davis@example.com',
                'subject' => 'Branding Package Inquiry',
                'message' => "Hi,\n\nI'm launching a new business and need help with branding. I'm looking for a complete package including logo design, business cards, and brand guidelines. What are your rates for these services?\n\nRegards,\nEmily Davis",
                'phone' => '(555) 234-5678',
                'company' => null,
                'read' => false,
                'read_at' => null,
                'created_at' => Carbon::now()->subHours(12),
            ],
            [
                'name' => 'David Wilson',
                'email' => 'david.wilson@example.com',
                'subject' => 'Website Maintenance',
                'message' => "Hello,\n\nWe currently have a WordPress website that needs regular maintenance and updates. Do you offer website maintenance services? If so, could you provide details about your packages and pricing?\n\nThank you,\nDavid Wilson",
                'phone' => '(555) 876-5432',
                'company' => 'Wilson & Associates',
                'read' => false,
                'read_at' => null,
                'created_at' => Carbon::now()->subHours(3),
            ],
        ];

        foreach ($submissions as $submission) {
            ContactSubmission::create($submission);
        }
    }
}
