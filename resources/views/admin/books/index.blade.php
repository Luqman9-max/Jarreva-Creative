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
<div x-data="{ showFilters: {{ request('category') || request('year') ? 'true' : 'false' }}, sortOpen: false }" class="mb-6">
    <div class="bg-white dark:bg-[#1e293b] p-2 rounded-xl border border-slate-200 dark:border-slate-700 flex flex-col md:flex-row gap-3">
        <form action="{{ route('admin.books.index') }}" method="GET" class="flex-grow">
            {{-- Persist other filters --}}
            @if(request('filter')) <input type="hidden" name="filter" value="{{ request('filter') }}"> @endif
            @if(request('sort_by')) <input type="hidden" name="sort_by" value="{{ request('sort_by') }}"> @endif
            @if(request('sort_dir')) <input type="hidden" name="sort_dir" value="{{ request('sort_dir') }}"> @endif
            @if(request('year')) <input type="hidden" name="year" value="{{ request('year') }}"> @endif
            @if(request('category')) <input type="hidden" name="category" value="{{ request('category') }}"> @endif

            <div class="relative group w-full">
                <div class="absolute left-3 top-1/2 -translate-y-1/2 flex items-center text-slate-400">
                    <span class="material-symbols-outlined text-[20px]">search</span>
                </div>
                <input name="search" value="{{ request('search') }}" class="w-full h-11 pl-10 pr-4 rounded-lg bg-slate-50 dark:bg-[#0f172a] border-transparent focus:bg-white focus:border-primary focus:ring-2 focus:ring-primary/20 text-sm transition-all outline-none" placeholder="Search by title, author, or ISBN..." type="text"/>
            </div>
        </form>
        
        <div class="relative">
            <button @click="sortOpen = !sortOpen" @click.away="sortOpen = false" class="px-4 py-2.5 bg-white border border-slate-200 dark:bg-slate-800 dark:border-slate-700 text-slate-700 dark:text-slate-300 rounded-lg text-sm font-bold hover:bg-slate-50 transition-colors flex items-center gap-2 h-full">
                <span class="material-symbols-outlined text-[18px]">sort</span>
                Sort
                <span class="material-symbols-outlined text-[16px] text-slate-400">expand_more</span>
            </button>
            
            {{-- Sort Dropdown --}}
            <div x-show="sortOpen" class="absolute z-10 right-0 mt-2 w-48 bg-white dark:bg-[#1e293b] rounded-lg shadow-xl border border-slate-100 dark:border-slate-700 py-1" style="display: none;">
                @php 
                    $sorts = [
                        ['label' => 'Newest First', 'by' => 'created_at', 'dir' => 'desc'],
                        ['label' => 'Oldest First', 'by' => 'created_at', 'dir' => 'asc'],
                        ['label' => 'Title A-Z', 'by' => 'title', 'dir' => 'asc'],
                        ['label' => 'Year (Newest)', 'by' => 'year', 'dir' => 'desc'],
                    ];
                @endphp
                @foreach($sorts as $sort)
                <a href="{{ request()->fullUrlWithQuery(['sort_by' => $sort['by'], 'sort_dir' => $sort['dir']]) }}" 
                   class="block px-4 py-2 text-sm text-slate-700 hover:bg-slate-50 {{ request('sort_by', 'created_at') == $sort['by'] && request('sort_dir', 'desc') == $sort['dir'] ? 'font-bold text-primary bg-orange-50' : '' }}">
                    {{ $sort['label'] }}
                </a>
                @endforeach
            </div>
        </div>
        
        <button @click="showFilters = !showFilters" :class="showFilters ? 'bg-slate-100 dark:bg-slate-700 border-slate-300' : 'bg-white border-slate-200'" class="px-4 py-2.5 border dark:bg-slate-800 dark:border-slate-700 text-slate-700 dark:text-slate-300 rounded-lg text-sm font-bold hover:bg-slate-50 transition-colors flex items-center gap-2">
            <span class="material-symbols-outlined text-[18px]">filter_list</span>
            More Filters
        </button>
    </div>

    {{-- Extended Filters Panel --}}
    <div x-show="showFilters" x-transition class="bg-white dark:bg-[#1e293b] p-4 rounded-xl border border-slate-200 dark:border-slate-700 mt-2 shadow-sm" style="display: none;">
        <form action="{{ route('admin.books.index') }}" method="GET" class="flex flex-wrap items-end gap-4">
             {{-- Persist other filters --}}
            @if(request('search')) <input type="hidden" name="search" value="{{ request('search') }}"> @endif
            @if(request('filter')) <input type="hidden" name="filter" value="{{ request('filter') }}"> @endif
            @if(request('sort_by')) <input type="hidden" name="sort_by" value="{{ request('sort_by') }}"> @endif
            @if(request('sort_dir')) <input type="hidden" name="sort_dir" value="{{ request('sort_dir') }}"> @endif

            <div class="flex flex-col gap-1 w-full md:w-auto min-w-[150px]">
                <label class="text-xs font-bold text-slate-500 uppercase">Year</label>
                <select name="year" class="w-full h-9 px-3 rounded-lg bg-slate-50 border border-slate-200 text-sm focus:border-primary focus:ring-1 focus:ring-primary outline-none">
                    <option value="">All Years</option>
                    @foreach($filter_years ?? [] as $y)
                        <option value="{{ $y }}" {{ request('year') == $y ? 'selected' : '' }}>{{ $y }}</option>
                    @endforeach
                </select>
            </div>

            <div class="flex flex-col gap-1 w-full md:w-auto min-w-[200px]">
                <label class="text-xs font-bold text-slate-500 uppercase">Category</label>
                <select name="category" class="w-full h-9 px-3 rounded-lg bg-slate-50 border border-slate-200 text-sm focus:border-primary focus:ring-1 focus:ring-primary outline-none">
                    <option value="">All Categories</option>
                    @foreach($filter_categories ?? [] as $c)
                        <option value="{{ $c }}" {{ request('category') == $c ? 'selected' : '' }}>{{ $c }}</option>
                    @endforeach
                </select>
            </div>

            <div class="flex items-center gap-2 pb-0.5">
                <button type="submit" class="px-4 py-2 bg-primary hover:bg-orange-600 text-white rounded-lg text-sm font-bold shadow-md shadow-orange-500/20">Apply</button>
                <a href="{{ route('admin.books.index') }}" class="px-4 py-2 text-slate-500 hover:text-slate-700 text-sm font-bold">Reset</a>
            </div>
        </form>
    </div>
</div>

{{-- Data Table --}}
<div x-data="{ deleteModalOpen: false, deleteAction: '', deleteItem: '' }">
    <div class="bg-white dark:bg-[#1e293b] rounded-2xl shadow-sm border border-slate-100 dark:border-slate-800 overflow-hidden">
        <div class="overflow-x-auto">
            <table class="w-full text-left border-collapse">
                <thead class="bg-slate-50/50 dark:bg-[#0f172a]/50 border-b border-slate-100 dark:border-slate-800">
                    <tr>
                        <th class="px-6 py-4 text-slate-500 dark:text-slate-400 text-[10px] font-bold uppercase tracking-wider w-1/3">Book Details</th>
                        <th class="px-6 py-4 text-slate-500 dark:text-slate-400 text-[10px] font-bold uppercase tracking-wider">Added By</th>
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
                            <div class="flex items-center gap-2">
                                 @if($book->admin && $book->admin->profile_photo_path)
                                    <div class="h-6 w-6 rounded-full bg-cover bg-center border border-slate-200" style="background-image: url('{{ asset('storage/' . $book->admin->profile_photo_path) }}');"></div>
                                @else
                                    <div class="h-6 w-6 rounded-full bg-blue-100 text-blue-600 flex items-center justify-center text-[10px] font-bold">
                                        {{ substr($book->admin->name ?? 'S', 0, 1) }}
                                    </div>
                                @endif
                                <span class="text-slate-600 dark:text-slate-300 text-sm font-medium">{{ $book->admin->name ?? 'System' }}</span>
                            </div>
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
                                <button type="button" @click="deleteModalOpen = true; deleteAction = '{{ route('admin.books.destroy', $book) }}'; deleteItem = '{{ addslashes($book->title) }}'" class="text-slate-400 hover:text-red-500 transition-colors pt-1">
                                    <span class="material-symbols-outlined text-[20px]">delete</span>
                                </button>
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="5" class="px-6 py-12 text-center text-slate-500">
                            <div class="flex flex-col items-center justify-center">
                                <span class="material-symbols-outlined text-[48px] text-slate-300 mb-4 scale-90">search_off</span>
                                <p class="font-medium text-sm">No books found.</p>
                                <p class="text-xs mt-1 text-slate-400">Try adjusting your filters or search query.</p>
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
                    <span class="px-2 py-1 text-slate-300 cursor-not-allowed"><span class="material-symbols-outlined text-sm">chevron_left</span></span>
                @else
                    <a href="{{ $books->previousPageUrl() }}" class="px-2 py-1 text-slate-500 hover:text-primary transition-colors"><span class="material-symbols-outlined text-sm">chevron_left</span></a>
                @endif

                {{-- Pagination Elements --}}
                @foreach ($books->elements()[0] as $page => $url)
                    @if ($page == $books->currentPage())
                        <span class="w-8 h-8 flex items-center justify-center rounded-lg bg-primary text-white text-xs font-bold shadow-md shadow-orange-500/20 scale-90">{{ $page }}</span>
                    @else
                        <a href="{{ $url }}" class="w-8 h-8 flex items-center justify-center rounded-lg text-slate-600 hover:bg-slate-50 text-xs font-medium transition-colors scale-90">{{ $page }}</a>
                    @endif
                @endforeach

                {{-- Next Page Link --}}
                @if ($books->hasMorePages())
                    <a href="{{ $books->nextPageUrl() }}" class="px-2 py-1 text-slate-500 hover:text-primary transition-colors"><span class="material-symbols-outlined text-sm">chevron_right</span></a>
                @else
                    <span class="px-2 py-1 text-slate-300 cursor-not-allowed"><span class="material-symbols-outlined text-sm">chevron_right</span></span>
                @endif
            </div>
            @endif
        </div>
    </div>

    {{-- Delete Confirmation Modal --}}
    <div x-show="deleteModalOpen" class="fixed inset-0 z-[100] flex items-center justify-center p-4 bg-slate-900/40 backdrop-blur-sm" 
         style="display: none;"
         x-transition:enter="transition ease-out duration-300"
         x-transition:enter-start="opacity-0"
         x-transition:enter-end="opacity-100"
         x-transition:leave="transition ease-in duration-200"
         x-transition:leave-start="opacity-100"
         x-transition:leave-end="opacity-0">
        
        <div class="relative w-full max-w-sm bg-white bg-opacity-100 rounded-2xl shadow-2xl border-0 transform transition-all"
             @click.away="deleteModalOpen = false"
             x-transition:enter="transition cubic-bezier(0.34, 1.56, 0.64, 1) duration-500"
             x-transition:enter-start="opacity-0 scale-90 translate-y-4"
             x-transition:enter-end="opacity-100 scale-100 translate-y-0"
             x-transition:leave="transition ease-in duration-200"
             x-transition:leave-start="opacity-100 scale-100 translate-y-0"
             x-transition:leave-end="opacity-0 scale-90 translate-y-4">
             
            <div class="flex flex-col items-center p-6 text-center">
                <div class="relative mb-4 group cursor-pointer" @click="deleteModalOpen = false">
                    <div class="absolute top-1/2 left-1/2 -translate-x-1/2 -translate-y-1/2 w-14 h-14 bg-red-100 rounded-full animate-ping opacity-75"></div>
                    <div class="relative flex items-center justify-center w-12 h-12 bg-red-50 rounded-full border-2 border-red-100 text-red-500 transition-transform group-hover:rotate-12">
                        <span class="material-symbols-outlined text-[28px]">delete</span>
                    </div>
                </div>
                <h3 class="text-lg font-bold text-slate-800 mb-1.5 font-sans">
                    Delete Book?
                </h3>
                <p class="text-slate-500 text-xs leading-relaxed mb-6 px-4">
                    Are you sure you want to delete <span class="font-bold text-slate-800 break-words" x-text="'&quot;' + deleteItem + '&quot;'"></span>?
                </p>
                <form :action="deleteAction" method="POST" class="grid grid-cols-2 gap-3 w-full">
                    @csrf
                    @method('DELETE')
                    <button @click="deleteModalOpen = false" class="w-full py-2.5 px-4 bg-slate-100 hover:bg-slate-200 border border-slate-200 rounded-lg text-slate-600 font-bold text-sm transition-all focus:ring-2 focus:ring-slate-300 focus:outline-none" type="button">
                        Cancel
                    </button>
                    <button class="w-full py-2.5 px-4 bg-red-600 hover:bg-red-700 border border-transparent rounded-lg text-white font-bold text-sm shadow-md shadow-red-500/20 transition-all focus:ring-2 focus:ring-red-500 focus:ring-offset-1 focus:outline-none" type="submit">
                        Delete
                    </button>
                </form>
            </div>
        </div>
    </div>
</div>

@endsection
