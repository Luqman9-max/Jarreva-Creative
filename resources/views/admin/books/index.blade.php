@extends('admin.layouts.app')

@section('title', 'Manage Books - Jarreva Creative Admin')

{{-- Define Header Content --}}
@section('header_title', 'Manage Books')
@section('header_subtitle', 'View and edit your complete book catalog')

{{-- Add Book Button in Header --}}
@section('header_actions')
    <a href="{{ route('admin.books.create') }}" class="py-2.5 px-4 bg-primary hover:bg-orange-600 text-white rounded-lg text-sm font-bold shadow-md shadow-orange-500/20 hover:shadow-orange-500/40 transition-all active:scale-95 flex items-center gap-2">
        <span class="material-symbols-outlined text-[18px]">add</span>
        Add Book
    </a>
@endsection

{{-- Hide Global Search --}}
@php $hide_global_search = true; @endphp

@section('content')

{{-- Filter Tabs --}}
<div class="flex flex-wrap items-center gap-2 mb-6">
    @php
        $currentFilter = request('filter');
    @endphp
    
    <a href="{{ route('admin.books.index') }}" 
       class="px-5 py-2 rounded-full text-sm font-bold transition-all {{ !$currentFilter ? 'bg-primary text-white shadow-md shadow-orange-500/20' : 'bg-white text-slate-600 border border-slate-200 hover:bg-slate-50' }}">
       All Books
    </a>
    
    <a href="{{ route('admin.books.index', ['filter' => 'published']) }}" 
       class="px-5 py-2 rounded-full text-sm font-bold transition-all {{ $currentFilter === 'published' ? 'bg-primary text-white shadow-md shadow-orange-500/20' : 'bg-white text-slate-600 border border-slate-200 hover:bg-slate-50' }}">
       Published
    </a>
    
    <a href="{{ route('admin.books.index', ['filter' => 'drafts']) }}" 
       class="px-5 py-2 rounded-full text-sm font-bold transition-all {{ $currentFilter === 'drafts' ? 'bg-primary text-white shadow-md shadow-orange-500/20' : 'bg-white text-slate-600 border border-slate-200 hover:bg-slate-50' }}">
       Drafts
    </a>
    
    <a href="{{ route('admin.books.index', ['filter' => 'featured']) }}" 
       class="px-5 py-2 rounded-full text-sm font-bold transition-all {{ $currentFilter === 'featured' ? 'bg-primary text-white shadow-md shadow-orange-500/20' : 'bg-white text-slate-600 border border-slate-200 hover:bg-slate-50' }}">
       Featured
    </a>
    
    <a href="{{ route('admin.books.index', ['filter' => 'archived']) }}" 
       class="px-5 py-2 rounded-full text-sm font-bold transition-all {{ $currentFilter === 'archived' ? 'bg-primary text-white shadow-md shadow-orange-500/20' : 'bg-white text-slate-600 border border-slate-200 hover:bg-slate-50' }}">
       Archived
    </a>
</div>

{{-- Toolbar --}}
<div class="bg-white dark:bg-[#1e293b] p-2 rounded-xl border border-slate-200 dark:border-slate-700 mb-6 flex flex-col md:flex-row gap-3">
    <form action="{{ route('admin.books.index') }}" method="GET" class="flex-grow">
        @if(request('filter'))
            <input type="hidden" name="filter" value="{{ request('filter') }}">
        @endif
        <div class="relative group w-full">
            <div class="absolute left-3 top-1/2 -translate-y-1/2 flex items-center text-slate-400">
                <span class="material-symbols-outlined text-[20px]">search</span>
            </div>
            <input name="search" value="{{ request('search') }}" class="w-full h-11 pl-10 pr-4 rounded-lg bg-slate-50 dark:bg-[#0f172a] border-transparent focus:bg-white focus:border-primary focus:ring-2 focus:ring-primary/20 text-sm transition-all outline-none" placeholder="Search by title, author, or ISBN..." type="text"/>
        </div>
    </form>
    
    <button class="px-4 py-2.5 bg-white border border-slate-200 dark:bg-slate-800 dark:border-slate-700 text-slate-700 dark:text-slate-300 rounded-lg text-sm font-bold hover:bg-slate-50 transition-colors flex items-center gap-2">
        <span class="material-symbols-outlined text-[18px]">sort</span>
        Sort
    </button>
    
    <button class="px-4 py-2.5 bg-white border border-slate-200 dark:bg-slate-800 dark:border-slate-700 text-slate-700 dark:text-slate-300 rounded-lg text-sm font-bold hover:bg-slate-50 transition-colors flex items-center gap-2">
        <span class="material-symbols-outlined text-[18px]">filter_list</span>
        More Filters
    </button>
</div>

{{-- Data Table --}}
<div class="bg-white dark:bg-[#1e293b] rounded-2xl shadow-sm border border-slate-100 dark:border-slate-800 overflow-hidden">
    <div class="overflow-x-auto">
        <table class="w-full text-left border-collapse">
            <thead class="bg-slate-50/50 dark:bg-[#0f172a]/50 border-b border-slate-100 dark:border-slate-800">
                <tr>
                    <th class="px-6 py-4 text-slate-500 dark:text-slate-400 text-[10px] font-bold uppercase tracking-wider w-1/3">Book Details</th>
                    <th class="px-6 py-4 text-slate-500 dark:text-slate-400 text-[10px] font-bold uppercase tracking-wider">Author</th>
                    <th class="px-6 py-4 text-slate-500 dark:text-slate-400 text-[10px] font-bold uppercase tracking-wider">Details</th>
                    <th class="px-6 py-4 text-slate-500 dark:text-slate-400 text-[10px] font-bold uppercase tracking-wider">Status</th>
                    <th class="px-6 py-4 text-slate-500 dark:text-slate-400 text-[10px] font-bold uppercase tracking-wider text-right">Actions</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-slate-100 dark:divide-slate-800">
                @forelse($books as $book)
                <tr class="hover:bg-slate-50/80 dark:hover:bg-[#252f45] transition-colors group">
                    <td class="px-6 py-4">
                        <div class="flex items-center gap-4">
                            <div class="h-14 w-10 rounded shadow-sm bg-slate-100 flex-shrink-0 overflow-hidden relative border border-slate-200">
                                @if($book->cover_image)
                                    <div class="w-full h-full bg-cover bg-center" style="background-image: url('{{ asset('storage/' . $book->cover_image) }}');"></div>
                                @else
                                    <div class="w-full h-full flex items-center justify-center text-slate-300 bg-slate-50">
                                        <span class="material-symbols-outlined text-[20px]">image</span>
                                    </div>
                                @endif
                            </div>
                            <div class="flex flex-col">
                                <span class="text-slate-800 dark:text-white font-bold text-sm">{{ $book->title }}</span>
                                <span class="text-slate-400 text-xs font-medium mt-0.5">/{{ $book->slug }}</span>
                            </div>
                        </div>
                    </td>
                    <td class="px-6 py-4">
                        <span class="text-slate-600 dark:text-slate-300 text-sm font-medium">{{ $book->author ?? '-' }}</span>
                    </td>
                    <td class="px-6 py-4">
                        <div class="flex flex-col gap-1">
                            <span class="text-xs text-slate-500">Year: {{ $book->year ?? '-' }}</span>
                            <span class="text-xs text-slate-500">Cat: {{ $book->category ?? '-' }}</span>
                        </div>
                    </td>
                    <td class="px-6 py-4">
                        <div class="flex gap-2">
                            @if($book->is_published)
                                <span class="inline-flex items-center px-2.5 py-1 rounded-full text-xs font-bold bg-green-100 text-green-700">Published</span>
                            @else
                                <span class="inline-flex items-center px-2.5 py-1 rounded-full text-xs font-bold bg-slate-100 text-slate-600">Draft</span>
                            @endif
                            
                            @if($book->is_featured)
                                <span class="inline-flex items-center px-2.5 py-1 rounded-full text-xs font-bold bg-orange-100 text-orange-700">Featured</span>
                            @endif
                        </div>
                    </td>
                    <td class="px-6 py-4 text-right">
                        <div class="flex justify-end items-center gap-3">
                            <a href="{{ route('admin.books.edit', $book) }}" class="text-slate-400 hover:text-primary transition-colors">
                                <span class="material-symbols-outlined text-[20px]">edit</span>
                            </a>
                            <form action="{{ route('admin.books.destroy', $book) }}" method="POST" onsubmit="return confirm('Are you sure?');">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="text-slate-400 hover:text-red-500 transition-colors pt-1">
                                    <span class="material-symbols-outlined text-[20px]">delete</span>
                                </button>
                            </form>
                        </div>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="5" class="px-6 py-12 text-center text-slate-500">
                        <div class="flex flex-col items-center justify-center">
                            <span class="material-symbols-outlined text-[48px] text-slate-300 mb-4">search_off</span>
                            <p class="font-medium">No books found.</p>
                            <p class="text-sm mt-1">Try adjusting your filters or search query.</p>
                        </div>
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    {{-- Footer Pagination --}}
    <div class="p-6 border-t border-slate-100 dark:border-slate-800 flex flex-col md:flex-row justify-between items-center gap-4">
        <p class="text-sm text-slate-500">
            Showing <span class="font-bold text-slate-800 dark:text-white">{{ $books->firstItem() ?? 0 }}-{{ $books->lastItem() ?? 0 }}</span> of <span class="font-bold text-slate-800 dark:text-white">{{ $books->total() }}</span> books
        </p>
        
        {{-- Custom Pagination Links --}}
        @if($books->hasPages())
        <div class="flex gap-1">
            {{-- Previous Page Link --}}
            @if ($books->onFirstPage())
                <span class="px-3 py-1 text-slate-300 cursor-not-allowed"><span class="material-symbols-outlined text-sm">chevron_left</span></span>
            @else
                <a href="{{ $books->previousPageUrl() }}" class="px-3 py-1 text-slate-500 hover:text-primary transition-colors"><span class="material-symbols-outlined text-sm">chevron_left</span></a>
            @endif

            {{-- Pagination Elements --}}
            @foreach ($books->elements()[0] as $page => $url)
                @if ($page == $books->currentPage())
                    <span class="w-8 h-8 flex items-center justify-center rounded-lg bg-primary text-white text-sm font-bold shadow-md shadow-orange-500/20">{{ $page }}</span>
                @else
                    <a href="{{ $url }}" class="w-8 h-8 flex items-center justify-center rounded-lg text-slate-600 hover:bg-slate-50 text-sm font-medium transition-colors">{{ $page }}</a>
                @endif
            @endforeach

            {{-- Next Page Link --}}
            @if ($books->hasMorePages())
                <a href="{{ $books->nextPageUrl() }}" class="px-3 py-1 text-slate-500 hover:text-primary transition-colors"><span class="material-symbols-outlined text-sm">chevron_right</span></a>
            @else
                <span class="px-3 py-1 text-slate-300 cursor-not-allowed"><span class="material-symbols-outlined text-sm">chevron_right</span></span>
            @endif
        </div>
        @endif
    </div>
</div>

@endsection
