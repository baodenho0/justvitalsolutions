<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use App\Models\BlogPost;
use App\Models\BlogComment;
use App\Models\ContactSubmission;
use App\Models\User;

class AdminController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        // The middleware will be applied in the routes file
    }

    /**
     * Show the admin dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function dashboard()
    {
        // Get real statistics from the database
        $blogCount = BlogPost::count();
        $publishedBlogCount = BlogPost::published()->count();
        $commentCount = BlogComment::count();
        $pendingCommentCount = BlogComment::where('is_approved', false)->count();
        $formSubmissionCount = ContactSubmission::count();
        $unreadFormSubmissionCount = ContactSubmission::unread()->count();
        $userCount = User::count();

        // Get recent blog posts
        $recentBlogs = BlogPost::with(['allComments'])
            ->orderBy('created_at', 'desc')
            ->limit(5)
            ->get();

        // Get recent comments
        $recentComments = BlogComment::with(['user', 'post'])
            ->orderBy('created_at', 'desc')
            ->limit(5)
            ->get();

        // Get recent form submissions
        $recentSubmissions = ContactSubmission::orderBy('created_at', 'desc')
            ->limit(5)
            ->get();

        $data = [
            'stats' => [
                'blogs' => $blogCount,
                'published_blogs' => $publishedBlogCount,
                'comments' => $commentCount,
                'pending_comments' => $pendingCommentCount,
                'form_submissions' => $formSubmissionCount,
                'unread_submissions' => $unreadFormSubmissionCount,
                'users' => $userCount
            ],
            'recentBlogs' => $recentBlogs,
            'recentComments' => $recentComments,
            'recentSubmissions' => $recentSubmissions
        ];

        return view('admin.dashboard', $data);
    }

    /**
     * Show the user profile page.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function profile()
    {
        $user = Auth::user();
        return view('admin.profile.edit', compact('user'));
    }

    /**
     * Update the user profile.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function updateProfile(Request $request)
    {
        $user = Auth::user();

        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'email' => [
                'required',
                'string',
                'email',
                'max:255',
                Rule::unique('users')->ignore($user->id),
            ],
            'avatar' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        $user->name = $request->name;
        $user->email = $request->email;

        // Handle avatar upload
        if ($request->hasFile('avatar')) {
            $user->avatar = $this->uploadImage($request->file('avatar'), 'avatar');
        }

        $user->save();

        return redirect()->route('admin.profile')
            ->with('success', 'Profile updated successfully.');
    }

    /**
     * Show the change password page.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function changePassword()
    {
        return view('admin.profile.change-password');
    }

    /**
     * Update the user's password.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function updatePassword(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'current_password' => 'required',
            'password' => 'required|string|min:8|confirmed',
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        $user = Auth::user();

        // Check if current password matches
        if (!Hash::check($request->current_password, $user->password)) {
            return redirect()->back()
                ->withErrors(['current_password' => 'The current password is incorrect.'])
                ->withInput();
        }

        $user->password = Hash::make($request->password);
        $user->save();

        return redirect()->route('admin.profile')
            ->with('success', 'Password changed successfully.');
    }
}
