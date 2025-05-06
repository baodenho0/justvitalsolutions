<?php

namespace App\Http\Controllers;

use App\Models\BlogPost;
use App\Models\BlogCategory;
use Illuminate\Http\Request;
use Illuminate\View\View;

class BlogController extends Controller
{
    /**
     * Display a listing of the blog posts.
     */
    public function index(): View
    {
        $posts = BlogPost::with(['user', 'categories'])
            ->published()
            ->latest('published_at')
            ->paginate(10);

        $categories = BlogCategory::withCount('posts')->get();

        return view('blog.index', compact('posts', 'categories'));
    }

    /**
     * Display the specified blog post.
     */
    public function show(BlogPost $post): View
    {
        if (!$post->is_published) {
            abort(404);
        }

        $post->load(['user', 'categories', 'comments' => function($query) {
            $query->with('user', 'replies.user')
                  ->approved()
                  ->latest();
        }]);

        $relatedPosts = BlogPost::published()
            ->whereHas('categories', function($query) use ($post) {
                $query->whereIn('blog_categories.id', $post->categories->pluck('id'));
            })
            ->where('id', '!=', $post->id)
            ->latest('published_at')
            ->take(3)
            ->get();

        return view('blog.show', compact('post', 'relatedPosts'));
    }

    /**
     * Display posts by category.
     */
    public function category(BlogCategory $category): View
    {
        $posts = $category->posts()
            ->with(['user', 'categories'])
            ->published()
            ->latest('published_at')
            ->paginate(10);

        $categories = BlogCategory::withCount('posts')->get();

        return view('blog.category', compact('category', 'posts', 'categories'));
    }
}
