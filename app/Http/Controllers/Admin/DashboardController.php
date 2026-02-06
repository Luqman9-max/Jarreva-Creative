<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;

class DashboardController extends Controller
{
    // Halaman dashboard admin
    public function index()
    {
        $stats = [
            'total_books' => \App\Models\Book::count(),
            'featured_books' => \App\Models\Book::where('is_featured', true)->count(),
            'published_books' => \App\Models\Book::where('is_published', true)->count(),
            'admins_count' => \App\Models\Admin::count(),
            'recent_books' => \App\Models\Book::latest()->take(5)->get()
        ];
        
        return view('admin.dashboard', compact('stats'));
    }
}
