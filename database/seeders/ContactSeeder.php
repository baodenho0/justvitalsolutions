<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Contact;

class ContactSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Create default Contact page
        Contact::create([
            'title' => 'Contact Us',
            'subtitle' => 'Get in touch with our team',
            'banner_image' => 'storage/contact/contact-banner.jpg',
            'intro_text' => '<p>We\'d love to hear from you! Whether you have a question about our services, pricing, or anything else, our team is ready to answer all your questions.</p>',
            'address' => '123 Business Street, Suite 100, New York, NY 10001',
            'phone' => '+1 (555) 123-4567',
            'email' => 'info@yourcompany.com',
            'map_embed_code' => '<iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3022.9663095343008!2d-74.00425882426698!3d40.74076684375838!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x89c259bf5c1654f3%3A0xc80f9cfce5383d5d!2sEmpire%20State%20Building!5e0!3m2!1sen!2sus!4v1682452077211!5m2!1sen!2sus" width="100%" height="450" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>',
            'office_hours' => [
                [
                    'day' => 'Monday - Friday',
                    'hours' => '9:00 AM - 5:00 PM',
                ],
                [
                    'day' => 'Saturday',
                    'hours' => '10:00 AM - 2:00 PM',
                ],
                [
                    'day' => 'Sunday',
                    'hours' => 'Closed',
                ],
            ],
            'show_contact_form' => true,
            'form_title' => 'Send us a message',
            'form_description' => 'We\'ll get back to you as soon as possible.',
            'is_active' => true,
        ]);
    }
}
