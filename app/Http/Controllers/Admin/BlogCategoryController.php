<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\BlogCategory;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Str;
use Illuminate\View\View;

class BlogCategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): View
    {
        $categories = BlogCategory::withCount('posts')->paginate(10);
        return view('admin.blog.categories.index', compact('categories'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): View
    {
        return view('admin.blog.categories.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
        ]);

        $slug = Str::slug($request->name);
        $uniqueSlug = $slug;
        $counter = 1;

        // Ensure slug is unique
        while (BlogCategory::where('slug', $uniqueSlug)->exists()) {
            $uniqueSlug = $slug . '-' . $counter++;
        }

        BlogCategory::create([
            'name' => $request->name,
            'slug' => $uniqueSlug,
            'description' => $request->description,
        ]);

        return redirect()->route('admin.blog.categories.index')
            ->with('success', 'Category created successfully!');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(BlogCategory $category): View
    {
        return view('admin.blog.categories.edit', compact('category'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, BlogCategory $category): RedirectResponse
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
        ]);

        // Update slug only if name has changed
        if ($category->name !== $request->name) {
            $slug = Str::slug($request->name);
            $uniqueSlug = $slug;
            $counter = 1;

            // Ensure slug is unique
            while (BlogCategory::where('slug', $uniqueSlug)->where('id', '!=', $category->id)->exists()) {
                $uniqueSlug = $slug . '-' . $counter++;
            }

            $category->slug = $uniqueSlug;
        }

        $category->name = $request->name;
        $category->description = $request->description;
        $category->save();

        return redirect()->route('admin.blog.categories.index')
            ->with('success', 'Category updated successfully!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(BlogCategory $category): RedirectResponse
    {
        $category->delete();

        return redirect()->route('admin.blog.categories.index')
            ->with('success', 'Category deleted successfully!');
    }
}
