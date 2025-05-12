<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ApiProxyController;

Route::any('{path?}', [ApiProxyController::class, 'proxyRequest'])
    ->where('path', '.*')
    ->name('api.proxy');
