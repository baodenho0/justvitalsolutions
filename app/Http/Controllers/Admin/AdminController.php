<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

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
        // You can add any data you want to pass to the dashboard view here
        $data = [
            'stats' => [
                'orders' => 150,
                'products' => 53,
                'users' => 44,
                'categories' => 65
            ]
        ];

        return view('admin.dashboard', $data);
    }
}
