<?php

namespace App\Http\Controllers;

use Illuminate\Support\Str;

abstract class Controller
{
    protected function uploadImage($image, $folder)
    {
        $originalName = pathinfo($image->getClientOriginalName(), PATHINFO_FILENAME);
        $extension = $image->getClientOriginalExtension();
        $random = Str::random(4);
        $filename = $originalName . '_' . $random . '.' . $extension;
        $path = $image->storeAs("uploads/{$folder}", $filename, 'public');
        return '/storage/' . $path;
    }
}
