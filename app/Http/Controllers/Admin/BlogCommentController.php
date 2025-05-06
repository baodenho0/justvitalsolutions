<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\BlogComment;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class BlogCommentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): View
    {
        $comments = BlogComment::with(['user', 'post'])
            ->latest()
            ->paginate(20);

        return view('admin.blog.comments.index', compact('comments'));
    }

    /**
     * Show the specified comment.
     */
    public function show(BlogComment $comment): View
    {
        $comment->load(['user', 'post', 'parent', 'replies.user']);
        return view('admin.blog.comments.show', compact('comment'));
    }

    /**
     * Update the approval status of the comment.
     */
    public function approve(BlogComment $comment): RedirectResponse
    {
        $comment->update([
            'is_approved' => true,
        ]);

        return redirect()->back()->with('success', 'Comment approved successfully!');
    }

    /**
     * Update the approval status of the comment.
     */
    public function disapprove(BlogComment $comment): RedirectResponse
    {
        $comment->update([
            'is_approved' => false,
        ]);

        return redirect()->back()->with('success', 'Comment disapproved successfully!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(BlogComment $comment): RedirectResponse
    {
        $comment->delete();

        return redirect()->route('admin.blog.comments.index')
            ->with('success', 'Comment deleted successfully!');
    }
}
