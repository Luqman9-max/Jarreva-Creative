<?php

namespace App\Http\Controllers\Public;

use App\Http\Controllers\Controller;

class HomeController extends Controller
{
    // Landing page + daftar buku
    public function index()
    {
        return view('public.home');
    }
}
