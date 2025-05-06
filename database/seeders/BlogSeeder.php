<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\BlogPost;
use App\Models\BlogCategory;
use App\Models\BlogComment;
use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Hash;

class BlogSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Create a user if none exists
        $user = User::firstOrCreate(
            ['email' => 'admin1@example.com'],
            [
                'name' => 'Admin User',
                'password' => Hash::make('password'),
                'is_admin' => true,
            ]
        );

        // Create a blog category
        $category = BlogCategory::create([
            'name' => 'Technology',
            'slug' => 'technology',
            'description' => 'Articles about the latest technology trends and innovations.',
        ]);

        // Create a blog post
        $post = BlogPost::create([
            'title' => 'Getting Started with Laravel',
            'slug' => 'getting-started-with-laravel',
            'excerpt' => 'Laravel is a web application framework with expressive, elegant syntax.',
            'content' => '<p>Laravel is a web application framework with expressive, elegant syntax. We\'ve already laid the foundation — freeing you to create without sweating the small things.</p>
                        <p>Laravel is accessible, powerful, and provides tools required for large, robust applications. A superb combination of simplicity, elegance, and innovation gives you a complete toolset for building any application with which you are tasked.</p>
                        <h3>Why Laravel?</h3>
                        <p>There are a variety of tools and frameworks available to you when building a web application. However, we believe Laravel is the best choice for building modern, full-stack web applications.</p>
                        <ul>
                            <li>A Progressive Framework</li>
                            <li>A Scalable Framework</li>
                            <li>A Community Framework</li>
                        </ul>
                        <p>Whether you are new to PHP web frameworks or have years of experience, Laravel is a framework that can grow with you. We\'ll help you take your first steps as a web developer or give you a boost as you take your expertise to the next level.</p>',
            'user_id' => $user->id,
            'is_published' => true,
            'published_at' => now(),
        ]);

        // Attach the category to the post
        $post->categories()->attach($category->id);

        // Create a comment for the post
        BlogComment::create([
            'blog_post_id' => $post->id,
            'user_id' => $user->id,
            'content' => 'This is a great introduction to Laravel! Looking forward to more articles in this series.',
            'is_approved' => true,
        ]);
    }
}
