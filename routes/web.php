<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\HomeController;

Route::get('/', [App\Http\Controllers\LandingPageController::class, 'index'])->name('landing-page');

// Authentication Routes
Auth::routes();

// Home Route
Route::get('/home', [HomeController::class, 'index'])->name('home')->middleware('auth');

// Include Admin Routes
require __DIR__.'/admin.php';
