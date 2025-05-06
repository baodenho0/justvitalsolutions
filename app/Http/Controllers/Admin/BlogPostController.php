<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\BlogPost;
use App\Models\BlogCategory;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\View\View;

class BlogPostController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): View
    {
        $posts = BlogPost::with(['user', 'categories'])
            ->latest()
            ->paginate(10);

        return view('admin.blog.posts.index', compact('posts'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): View
    {
        $categories = BlogCategory::all();
        return view('admin.blog.posts.create', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required|string',
            'excerpt' => 'nullable|string',
            'featured_image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'categories' => 'nullable|array',
            'categories.*' => 'exists:blog_categories,id',
            'is_published' => 'boolean',
            'published_at' => 'nullable|date',
        ]);

        $slug = Str::slug($request->title);
        $uniqueSlug = $slug;
        $counter = 1;

        // Ensure slug is unique
        while (BlogPost::where('slug', $uniqueSlug)->exists()) {
            $uniqueSlug = $slug . '-' . $counter++;
        }

        $post = new BlogPost([
            'title' => $request->title,
            'slug' => $uniqueSlug,
            'excerpt' => $request->excerpt,
            'content' => $request->content,
            'is_published' => $request->is_published ?? false,
            'published_at' => $request->is_published ? ($request->published_at ?? now()) : null,
        ]);

        // Handle featured image upload
        if ($request->hasFile('featured_image')) {
            $path = $request->file('featured_image')->store('blog', 'public');
            $post->featured_image = $path;
        }

        $post->user()->associate(Auth::user());
        $post->save();

        // Sync categories
        if ($request->has('categories')) {
            $post->categories()->sync($request->categories);
        }

        return redirect()->route('admin.blog.posts.index')
            ->with('success', 'Blog post created successfully!');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(BlogPost $post): View
    {
        $post->load('categories');
        $categories = BlogCategory::all();
        return view('admin.blog.posts.edit', compact('post', 'categories'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, BlogPost $post): RedirectResponse
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required|string',
            'excerpt' => 'nullable|string',
            'featured_image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'categories' => 'nullable|array',
            'categories.*' => 'exists:blog_categories,id',
            'is_published' => 'boolean',
            'published_at' => 'nullable|date',
        ]);

        // Update slug only if title has changed
        if ($post->title !== $request->title) {
            $slug = Str::slug($request->title);
            $uniqueSlug = $slug;
            $counter = 1;

            // Ensure slug is unique
            while (BlogPost::where('slug', $uniqueSlug)->where('id', '!=', $post->id)->exists()) {
                $uniqueSlug = $slug . '-' . $counter++;
            }

            $post->slug = $uniqueSlug;
        }

        $post->title = $request->title;
        $post->excerpt = $request->excerpt;
        $post->content = $request->content;
        $post->is_published = $request->is_published ?? false;
        $post->published_at = $request->is_published ? ($request->published_at ?? now()) : null;

        // Handle featured image upload
        if ($request->hasFile('featured_image')) {
            // Delete old image if exists
            if ($post->featured_image) {
                Storage::disk('public')->delete($post->featured_image);
            }

            $path = $request->file('featured_image')->store('blog', 'public');
            $post->featured_image = $path;
        }

        $post->save();

        // Sync categories
        if ($request->has('categories')) {
            $post->categories()->sync($request->categories);
        } else {
            $post->categories()->detach();
        }

        return redirect()->route('admin.blog.posts.index')
            ->with('success', 'Blog post updated successfully!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(BlogPost $post): RedirectResponse
    {
        // Delete featured image if exists
        if ($post->featured_image) {
            Storage::disk('public')->delete($post->featured_image);
        }

        $post->delete();

        return redirect()->route('admin.blog.posts.index')
            ->with('success', 'Blog post deleted successfully!');
    }
}
