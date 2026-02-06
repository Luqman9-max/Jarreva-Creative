<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;

class BookController extends Controller
{
    public function index(\Illuminate\Http\Request $request)
    {
        $query = \App\Models\Book::query();
        $query->with('admin'); // Eager load admin

        // Search
        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function($q) use ($search) {
                $q->where('title', 'like', "%{$search}%")
                  ->orWhere('author', 'like', "%{$search}%")
                  ->orWhereHas('admin', function($q) use ($search) {
                      $q->where('name', 'like', "%{$search}%");
                  });
            });
        }

        // Filters
        // 1. Status Filter
        if ($request->filled('filter')) {
            switch ($request->filter) {
                case 'published':
                    $query->where('is_published', true);
                    break;
                case 'drafts':
                    $query->where('is_published', false);
                    break;
                case 'featured':
                    $query->where('is_featured', true);
                    break;
            }
        }

        // 2. Advanced Filters (Year & Category)
        if ($request->filled('year')) {
            $query->where('year', $request->year);
        }
        if ($request->filled('category')) {
            $query->where('category', 'like', "%{$request->category}%");
        }

        // Sorting
        $sort_by = $request->get('sort_by', 'created_at'); // Default: date
        $sort_dir = $request->get('sort_dir', 'desc'); // Default: desc
        
        // Whitelist sort columns
        $allowedImports = ['created_at', 'title', 'year'];
        if (in_array($sort_by, $allowedImports)) {
            $query->orderBy($sort_by, $sort_dir);
        } else {
            $query->latest();
        }

        $books = $query->paginate(10)->withQueryString();
        
        // Get unique years and categories for filter dropdowns
        $filter_years = \App\Models\Book::select('year')->distinct()->orderBy('year', 'desc')->pluck('year');
        $filter_categories = \App\Models\Book::select('category')->distinct()->orderBy('category')->pluck('category');

        return view('admin.books.index', compact('books', 'filter_years', 'filter_categories'));
    }

    public function create()
    {
        return view('admin.books.create');
    }

    public function store(\App\Http\Requests\Admin\BookRequest $request)
    {
        $data = $request->validated();
        $data['admin_id'] = \Illuminate\Support\Facades\Auth::guard('admin')->id();
        
        if ($request->hasFile('cover_image')) {
            $path = $request->file('cover_image')->store('books', 'public');
            $data['cover_image'] = $path;
        }

        $book = \App\Models\Book::create($data);

        \App\Helpers\ActivityLogger::log('created', "Added new book: {$book->title}", $book);

        return redirect()->route('admin.books.index')->with('success', 'Book created successfully.');
    }

    public function edit(\App\Models\Book $book)
    {
        return view('admin.books.edit', compact('book'));
    }

    public function update(\App\Http\Requests\Admin\BookRequest $request, \App\Models\Book $book)
    {
        $data = $request->validated();

        if ($request->hasFile('cover_image')) {
            // Delete old image if exists
            if ($book->cover_image && \Illuminate\Support\Facades\Storage::disk('public')->exists($book->cover_image)) {
                \Illuminate\Support\Facades\Storage::disk('public')->delete($book->cover_image);
            }
            $path = $request->file('cover_image')->store('books', 'public');
            $data['cover_image'] = $path;
        }

        $book->update($data);

        \App\Helpers\ActivityLogger::log('updated', "Updated details for book: {$book->title}", $book);

        return redirect()->route('admin.books.index')->with('success', 'Book updated successfully.');
    }

    public function destroy(\App\Models\Book $book)
    {
        $title = $book->title; // Capture title before deleting

        if ($book->cover_image && \Illuminate\Support\Facades\Storage::disk('public')->exists($book->cover_image)) {
            \Illuminate\Support\Facades\Storage::disk('public')->delete($book->cover_image);
        }
        
        $book->delete();

        \App\Helpers\ActivityLogger::log('deleted', "Deleted book: {$title}", null); // Subject null since it's gone

        return redirect()->route('admin.books.index')->with('delete', 'Book deleted successfully.');
    }
}
