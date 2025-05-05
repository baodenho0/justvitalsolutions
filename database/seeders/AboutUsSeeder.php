<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\AboutUs;

class AboutUsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Create default About Us page
        AboutUs::create([
            'title' => 'About Our Company',
            'subtitle' => 'Learn more about who we are and what we do',
            'banner_image' => 'storage/about-us/about-banner.jpg',
            'section1_title' => 'Our Mission & Values',
            'section1_content' => '<p>Founded in 2010, our company has been dedicated to providing exceptional services to our clients. We believe in integrity, innovation, and customer satisfaction.</p><p>Our mission is to deliver high-quality solutions that exceed expectations and help our clients achieve their goals.</p>',
            'section2_title' => 'Our Expertise',
            'section2_content' => '<p>With over a decade of experience in the industry, we have developed a deep understanding of our clients\' needs and challenges.</p><p>Our team of experts is committed to staying at the forefront of industry trends and technologies to provide cutting-edge solutions.</p>',
            'skills' => [
                [
                    'name' => 'Web Development',
                    'percentage' => 95,
                ],
                [
                    'name' => 'UI/UX Design',
                    'percentage' => 90,
                ],
                [
                    'name' => 'Mobile Development',
                    'percentage' => 85,
                ],
                [
                    'name' => 'Digital Marketing',
                    'percentage' => 80,
                ],
            ],
            'team_members' => [
                [
                    'name' => 'John Doe',
                    'position' => 'CEO & Founder',
                    'bio' => 'John has over 15 years of experience in the industry and is passionate about creating innovative solutions.',
                    'image' => 'storage/team/team1.jpg',
                ],
                [
                    'name' => 'Jane Smith',
                    'position' => 'Creative Director',
                    'bio' => 'Jane leads our creative team with her exceptional design skills and strategic thinking.',
                    'image' => 'storage/team/team2.jpg',
                ],
                [
                    'name' => 'Michael Johnson',
                    'position' => 'Lead Developer',
                    'bio' => 'Michael is a skilled developer with expertise in multiple programming languages and frameworks.',
                    'image' => 'storage/team/team3.jpg',
                ],
                [
                    'name' => 'Emily Brown',
                    'position' => 'Marketing Manager',
                    'bio' => 'Emily has a proven track record of developing successful marketing strategies for various clients.',
                    'image' => 'storage/team/team4.jpg',
                ],
            ],
            'is_active' => true,
        ]);
    }
}
