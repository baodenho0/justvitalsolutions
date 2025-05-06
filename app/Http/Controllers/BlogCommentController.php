<?php

namespace App\Http\Controllers;

use App\Models\BlogPost;
use App\Models\BlogComment;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;

class BlogCommentController extends Controller
{
    /**
     * Store a newly created comment in storage.
     */
    public function store(Request $request, BlogPost $post): RedirectResponse
    {
        $request->validate([
            'content' => 'required|string|min:3',
            'parent_id' => 'nullable|exists:blog_comments,id'
        ]);

        $comment = new BlogComment([
            'content' => $request->content,
            'parent_id' => $request->parent_id,
            'is_approved' => true, // Auto-approve for now, can be changed to false if moderation is needed
        ]);

        $comment->user()->associate(Auth::user());
        $comment->post()->associate($post);
        $comment->save();

        return redirect()->back()->with('success', 'Comment added successfully!');
    }

    /**
     * Update the specified comment in storage.
     */
    public function update(Request $request, BlogComment $comment): RedirectResponse
    {
        $request->validate([
            'content' => 'required|string|min:3',
        ]);

        $comment->update([
            'content' => $request->content,
        ]);

        return redirect()->back()->with('success', 'Comment updated successfully!');
    }

    /**
     * Remove the specified comment from storage.
     */
    public function destroy(BlogComment $comment): RedirectResponse
    {
        $comment->delete();

        return redirect()->back()->with('success', 'Comment deleted successfully!');
    }
}
