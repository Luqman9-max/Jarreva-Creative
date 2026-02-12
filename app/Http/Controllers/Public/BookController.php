<?php

namespace App\Http\Controllers\Public;

use App\Http\Controllers\Controller;
use App\Models\Book;
use Illuminate\Http\Request;

class BookController extends Controller
{
    /**
     * Display the catalog of books.
     */
    public function index()
    {
        // Fetch books, assuming 'is_published' column exists or just fetch all for now
        // Using simple pagination or get
        $books = Book::latest()->get(); 
        return view('public.catalog', compact('books'));
    }

    /**
     * Display the specified book.
     */
    public function show($slug)
    {
        // Find book by slug
        $book = Book::where('slug', $slug)->firstOrFail();
        return view('public.book-detail', compact('book'));
    }
}
