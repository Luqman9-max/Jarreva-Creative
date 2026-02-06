<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;

class BookController extends Controller
{
    public function index(\Illuminate\Http\Request $request)
    {
        $query = \App\Models\Book::query();

        // Search
        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function($q) use ($search) {
                $q->where('title', 'like', "%{$search}%")
                  ->orWhere('author', 'like', "%{$search}%");
            });
        }

        // Filters
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
                // 'all' is default
            }
        }

        $books = $query->latest()->paginate(10)->withQueryString();

        return view('admin.books.index', compact('books'));
    }

    public function create()
    {
        return view('admin.books.create');
    }

    public function store(\App\Http\Requests\Admin\BookRequest $request)
    {
        $data = $request->validated();
        
        if ($request->hasFile('cover_image')) {
            $path = $request->file('cover_image')->store('books', 'public');
            $data['cover_image'] = $path;
        }

        \App\Models\Book::create($data);

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

        return redirect()->route('admin.books.index')->with('success', 'Book updated successfully.');
    }

    public function destroy(\App\Models\Book $book)
    {
        if ($book->cover_image && \Illuminate\Support\Facades\Storage::disk('public')->exists($book->cover_image)) {
            \Illuminate\Support\Facades\Storage::disk('public')->delete($book->cover_image);
        }
        
        $book->delete();

        return redirect()->route('admin.books.index')->with('success', 'Book deleted successfully.');
    }
}
