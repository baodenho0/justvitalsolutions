<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\AuthController;
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\LandingPageController;
use App\Http\Controllers\Admin\SiteSettingController;
use App\Http\Controllers\Admin\AboutUsController;
use App\Http\Controllers\Admin\ServiceController;
use App\Http\Controllers\Admin\ContactController;

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
    'middleware' => ['web', 'admin']
], function () {
    // Dashboard
    Route::get('dashboard', [AdminController::class, 'dashboard'])->name('dashboard');

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
    Route::get('settings/{id}/edit', [SiteSettingController::class, 'edit'])->name('settings.edit');
    Route::put('settings/{id}', [SiteSettingController::class, 'update'])->name('settings.update');
    Route::delete('settings/{id}', [SiteSettingController::class, 'destroy'])->name('settings.destroy');
    Route::post('settings/batch', [SiteSettingController::class, 'updateBatch'])->name('settings.update-batch');

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
});
