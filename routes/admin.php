<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\AuthController;
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\LandingPageController;
use App\Http\Controllers\Admin\SiteSettingController;
use App\Http\Controllers\Admin\AboutUsController;
use App\Http\Controllers\Admin\ServiceController;
use App\Http\Controllers\Admin\ContactController;
use App\Http\Controllers\Admin\BlogPostController;
use App\Http\Controllers\Admin\BlogCategoryController;
use App\Http\Controllers\Admin\BlogCommentController;

// Admin Authentication Routes
Route::group(['prefix' => 'admin', 'as' => 'admin.', 'middleware' => ['web']], function () {
    Route::get('login', [AuthController::class, 'showLoginForm'])->name('login')->middleware('guest');
    Route::post('login', [AuthController::class, 'login'])->name('login.submit')->middleware('guest');
    Route::post('logout', [AuthController::class, 'logout'])->name('logout')->middleware('auth');
});

// Admin Protected Routes
Route::group([
    'prefix' => 'admin',
    'as' => 'admin.',
    'middleware' => ['web', 'auth', 'admin']
], function () {
    // Dashboard
    Route::get('dashboard', [AdminController::class, 'dashboard'])->name('dashboard');

    // Profile Management
    Route::get('profile', [AdminController::class, 'profile'])->name('profile');
    Route::put('profile', [AdminController::class, 'updateProfile'])->name('profile.update');
    Route::get('change-password', [AdminController::class, 'changePassword'])->name('change-password');
    Route::put('change-password', [AdminController::class, 'updatePassword'])->name('change-password.update');

    // User Management
    Route::get('users', [App\Http\Controllers\Admin\UserController::class, 'index'])->name('users.index');
    Route::get('users/create', [App\Http\Controllers\Admin\UserController::class, 'create'])->name('users.create');
    Route::post('users', [App\Http\Controllers\Admin\UserController::class, 'store'])->name('users.store');
    Route::get('users/{id}/edit', [App\Http\Controllers\Admin\UserController::class, 'edit'])->name('users.edit');
    Route::put('users/{id}', [App\Http\Controllers\Admin\UserController::class, 'update'])->name('users.update');
    Route::delete('users/{id}', [App\Http\Controllers\Admin\UserController::class, 'destroy'])->name('users.destroy');

    // Landing Page Management
    Route::get('landing-page/create', [LandingPageController::class, 'create'])->name('landing-page.create');
    Route::get('landing-page', [LandingPageController::class, 'index'])->name('landing-page.index');
    Route::post('landing-page', [LandingPageController::class, 'store'])->name('landing-page.store');
    Route::get('landing-page/{id}/edit', [LandingPageController::class, 'edit'])->name('landing-page.edit');
    Route::put('landing-page/{id}', [LandingPageController::class, 'update'])->name('landing-page.update');
    Route::delete('landing-page/{id}', [LandingPageController::class, 'destroy'])->name('landing-page.destroy');

    // Features Management
    Route::get('landing-page/{id}/features', [LandingPageController::class, 'features'])->name('landing-page.features');
    Route::post('landing-page/{id}/features', [LandingPageController::class, 'storeFeature'])->name('landing-page.features.store');
    Route::put('features/{id}', [LandingPageController::class, 'updateFeature'])->name('features.update');
    Route::delete('features/{id}', [LandingPageController::class, 'destroyFeature'])->name('features.destroy');

    // Testimonials Management
    Route::get('landing-page/{id}/testimonials', [LandingPageController::class, 'testimonials'])->name('landing-page.testimonials');
    Route::post('landing-page/{id}/testimonials', [LandingPageController::class, 'storeTestimonial'])->name('landing-page.testimonials.store');
    Route::put('testimonials/{id}', [LandingPageController::class, 'updateTestimonial'])->name('testimonials.update');
    Route::delete('testimonials/{id}', [LandingPageController::class, 'destroyTestimonial'])->name('testimonials.destroy');

    // Site Settings
    Route::get('settings', [SiteSettingController::class, 'index'])->name('settings.index');
    Route::get('settings/create', [SiteSettingController::class, 'create'])->name('settings.create');
    Route::post('settings', [SiteSettingController::class, 'store'])->name('settings.store');
    Route::post('settings/batch', [SiteSettingController::class, 'updateBatch'])->name('settings.update-batch');
    Route::get('settings/{setting}/edit', [SiteSettingController::class, 'edit'])->name('settings.edit');
    Route::put('settings/{setting}', [SiteSettingController::class, 'update'])->name('settings.update');
    Route::delete('settings/{setting}', [SiteSettingController::class, 'destroy'])->name('settings.destroy');

    // About Us Page Management
    Route::get('about-us', [AboutUsController::class, 'index'])->name('about-us.index');
    Route::get('about-us/edit', [AboutUsController::class, 'edit'])->name('about-us.edit');
    Route::put('about-us', [AboutUsController::class, 'update'])->name('about-us.update');

    // Services Page Management
    Route::get('services', [ServiceController::class, 'index'])->name('services.index');
    Route::get('services/edit', [ServiceController::class, 'edit'])->name('services.edit');
    Route::put('services', [ServiceController::class, 'update'])->name('services.update');

    // Contact Page Management
    Route::get('contact', [ContactController::class, 'index'])->name('contact.index');
    Route::get('contact/edit', [ContactController::class, 'edit'])->name('contact.edit');
    Route::put('contact', [ContactController::class, 'update'])->name('contact.update');

    // Contact Form Submissions
    Route::get('contact/submissions', [ContactController::class, 'submissions'])->name('contact.submissions');
    Route::get('contact/submissions/{id}', [ContactController::class, 'showSubmission'])->name('contact.submissions.show');
    Route::delete('contact/submissions/{id}', [ContactController::class, 'deleteSubmission'])->name('contact.submissions.delete');

    // Blog Management
    // Blog Posts
    Route::get('blog/posts', [BlogPostController::class, 'index'])->name('blog.posts.index');
    Route::get('blog/posts/create', [BlogPostController::class, 'create'])->name('blog.posts.create');
    Route::post('blog/posts', [BlogPostController::class, 'store'])->name('blog.posts.store');
    Route::get('blog/posts/{post}/edit', [BlogPostController::class, 'edit'])->name('blog.posts.edit');
    Route::put('blog/posts/{post}', [BlogPostController::class, 'update'])->name('blog.posts.update');
    Route::delete('blog/posts/{post}', [BlogPostController::class, 'destroy'])->name('blog.posts.destroy');

    // Blog Categories
    Route::get('blog/categories', [BlogCategoryController::class, 'index'])->name('blog.categories.index');
    Route::get('blog/categories/create', [BlogCategoryController::class, 'create'])->name('blog.categories.create');
    Route::post('blog/categories', [BlogCategoryController::class, 'store'])->name('blog.categories.store');
    Route::get('blog/categories/{category}/edit', [BlogCategoryController::class, 'edit'])->name('blog.categories.edit');
    Route::put('blog/categories/{category}', [BlogCategoryController::class, 'update'])->name('blog.categories.update');
    Route::delete('blog/categories/{category}', [BlogCategoryController::class, 'destroy'])->name('blog.categories.destroy');

    // Blog Comments
    Route::get('blog/comments', [BlogCommentController::class, 'index'])->name('blog.comments.index');
    Route::get('blog/comments/{comment}', [BlogCommentController::class, 'show'])->name('blog.comments.show');
    Route::post('blog/comments/{comment}/approve', [BlogCommentController::class, 'approve'])->name('blog.comments.approve');
    Route::post('blog/comments/{comment}/disapprove', [BlogCommentController::class, 'disapprove'])->name('blog.comments.disapprove');
    Route::delete('blog/comments/{comment}', [BlogCommentController::class, 'destroy'])->name('blog.comments.destroy');
});
