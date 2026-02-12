@extends('public.layouts.app')

@section('title', 'Jarreva Creative - Catalog Portfolio')

@section('content')
    <div class="container mx-auto px-4 py-12">
        <h1 class="text-4xl font-bold mb-8 text-center">Our Portfolio</h1>
        <p class="text-lg text-gray-600 text-center mb-12">
            Explore our collection of works and publications.
        </p>

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
            {{-- Loop through books will go here --}}
            @forelse($books ?? [] as $book)
                 <div class="border rounded-lg overflow-hidden shadow-sm hover:shadow-md transition-shadow">
                    {{-- Placeholder Book Card --}}
                    <div class="h-48 bg-gray-200 flex items-center justify-center">
                        <span class="text-gray-500">Book Cover</span>
                    </div>
                    <div class="p-4">
                        <h3 class="font-bold text-xl mb-2">{{ $book->title ?? 'Book Title' }}</h3>
                        <a href="{{ route('book.show', $book->slug ?? '#') }}" class="text-indigo-600 hover:text-indigo-800">View Details &rarr;</a>
                    </div>
                 </div>
            @empty
                <div class="col-span-full text-center text-gray-500 py-12">
                    <p>No items found in the catalog.</p>
                </div>
            @endforelse
        </div>
    </div>
@endsection
