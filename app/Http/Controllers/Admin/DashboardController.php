<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;

class DashboardController extends Controller
{
    // Halaman dashboard admin
    public function index()
    {
        return view('admin.dashboard');
    }
}
