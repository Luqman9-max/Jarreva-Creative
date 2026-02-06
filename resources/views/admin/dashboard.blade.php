@extends('admin.layouts.app')

@section('title', 'Dashboard - Jarreva Creative Admin')

@section('header_title', 'Dashboard Overview')
@section('header_subtitle', "Welcome back, " . Auth::guard('admin')->user()->name . "! Here's what's happening today.")

@section('content')
<div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
    <div class="bg-gradient-to-br from-blue-900 to-blue-800 rounded-2xl p-6 text-white shadow-lg shadow-blue-900/20 relative overflow-hidden group hover:shadow-xl hover:scale-[1.02] transition-all duration-300">
        <div class="absolute top-0 right-0 p-3 opacity-10 group-hover:opacity-20 transition-opacity">
            <span class="material-symbols-outlined" style="font-size: 100px;">book_2</span>
        </div>
        <div class="flex justify-between items-start mb-8 relative z-10">
            <div class="p-2 bg-white/10 rounded-lg backdrop-blur-sm">
                <span class="material-symbols-outlined text-white text-[24px]">library_books</span>
            </div>
        </div>
        <div class="relative z-10">
            <h3 class="text-4xl font-extrabold mb-1">{{ number_format($stats['total_books']) }}</h3>
            <p class="text-blue-200 text-sm font-medium">Total Books</p>
        </div>
    </div>
    <div class="bg-gradient-to-br from-orange-500 to-orange-400 rounded-2xl p-6 text-white shadow-lg shadow-orange-500/20 relative overflow-hidden group hover:shadow-xl hover:scale-[1.02] transition-all duration-300">
        <div class="absolute -bottom-4 -right-4 p-3 opacity-10 group-hover:opacity-20 transition-opacity rotate-12">
            <span class="material-symbols-outlined" style="font-size: 120px;">grade</span>
        </div>
        <div class="flex justify-between items-start mb-8 relative z-10">
            <div class="p-2 bg-white/20 rounded-lg backdrop-blur-sm">
                <span class="material-symbols-outlined text-white text-[24px]">star</span>
            </div>
        </div>
        <div class="relative z-10">
            <h3 class="text-4xl font-extrabold mb-1">{{ number_format($stats['featured_books']) }}</h3>
            <p class="text-orange-50 text-sm font-medium">Featured Titles</p>
        </div>
    </div>
    <div class="bg-[#0f172a] rounded-2xl p-6 text-white shadow-lg shadow-slate-900/20 relative overflow-hidden group hover:shadow-xl hover:scale-[1.02] transition-all duration-300">
        <div class="absolute top-1/2 right-4 -translate-y-1/2 p-3 opacity-5 group-hover:opacity-10 transition-opacity">
            <span class="material-symbols-outlined" style="font-size: 80px;">shield_person</span>
        </div>
        <div class="flex justify-between items-start mb-8 relative z-10">
            <div class="p-2 bg-white/10 rounded-lg backdrop-blur-sm">
                <span class="material-symbols-outlined text-white text-[24px]">shield_person</span>
            </div>
        </div>
        <div class="relative z-10">
            <h3 class="text-4xl font-extrabold mb-1">{{ number_format($stats['admins_count']) }}</h3>
            <p class="text-slate-400 text-sm font-medium">Total Admins</p>
        </div>
    </div>
    <div class="bg-white dark:bg-[#1e293b] rounded-2xl p-6 border-t-4 border-primary shadow-lg shadow-slate-200/50 dark:shadow-none relative overflow-hidden flex flex-col items-center justify-center text-center gap-4 group hover:shadow-xl transition-all duration-300">
        <div class="size-12 rounded-full bg-orange-50 dark:bg-orange-900/20 text-primary flex items-center justify-center mb-1 group-hover:scale-110 transition-transform">
            <span class="material-symbols-outlined text-[24px]">add</span>
        </div>
        <div>
            <h3 class="text-lg font-bold text-slate-800 dark:text-white">Quick Action</h3>
            <p class="text-xs text-slate-500 dark:text-slate-400 mt-1 max-w-[140px] mx-auto leading-relaxed">Add a new book to the catalog instantly.</p>
        </div>
        <a class="w-full py-2.5 px-4 bg-primary hover:bg-orange-600 text-white rounded-lg text-sm font-bold shadow-md shadow-orange-500/20 hover:shadow-orange-500/40 transition-all active:scale-95 flex items-center justify-center gap-2" href="{{ route('admin.books.index') }}">
            <span class="material-symbols-outlined text-[18px]">add_circle</span>
            Add Book
        </a>
    </div>
</div>
<div class="bg-white dark:bg-[#1e293b] rounded-2xl shadow-sm border border-slate-100 dark:border-slate-800 overflow-hidden">
    <div class="p-6 border-b border-slate-100 dark:border-slate-800 flex justify-between items-center">
        <div>
            <h2 class="text-lg font-bold text-slate-800 dark:text-white">Latest Books</h2>
            <p class="text-xs text-slate-500 mt-1">Recently added to the catalog</p>
        </div>
        <a class="text-sm font-bold text-secondary dark:text-blue-400 hover:text-primary transition-colors flex items-center gap-1" href="{{ route('admin.books.index') }}">
            View All
            <span class="material-symbols-outlined text-[16px]">arrow_forward</span>
        </a>
    </div>
    <div class="overflow-x-auto">
        <table class="w-full text-left border-collapse">
            <thead class="bg-slate-50/50 dark:bg-[#0f172a]/50">
                <tr>
                    <th class="px-6 py-4 text-slate-400 dark:text-slate-500 text-[10px] font-bold uppercase tracking-wider w-1/3">Book Details</th>
                    <th class="px-6 py-4 text-slate-400 dark:text-slate-500 text-[10px] font-bold uppercase tracking-wider">Added By</th>
                    <th class="px-6 py-4 text-slate-400 dark:text-slate-500 text-[10px] font-bold uppercase tracking-wider">Status</th>
                    <th class="px-6 py-4 text-slate-400 dark:text-slate-500 text-[10px] font-bold uppercase tracking-wider text-right">Actions</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-slate-100 dark:divide-slate-800">
                @forelse($stats['recent_books'] as $book)
                <tr class="hover:bg-slate-50/80 dark:hover:bg-[#252f45] transition-colors group">
                    <td class="px-6 py-4">
                        <div class="flex items-center gap-4">
                            <div class="h-14 w-10 rounded shadow-sm bg-slate-100 flex-shrink-0 overflow-hidden relative">
                                @if($book->cover_image)
                                    <div class="w-full h-full bg-cover bg-center" style="background-image: url('{{ asset('storage/' . $book->cover_image) }}');"></div>
                                @else
                                    <div class="w-full h-full flex items-center justify-center text-slate-400">
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
                            <div class="size-6 rounded-full bg-blue-100 text-blue-600 flex items-center justify-center text-[10px] font-bold">{{ substr($book->author ?? 'A', 0, 2) }}</div>
                            <span class="text-slate-600 dark:text-slate-300 text-sm font-medium">{{ $book->author ?? 'Unknown' }}</span>
                        </div>
                    </td>
                    <td class="px-6 py-4">
                        @if($book->is_published)
                            <span class="inline-flex items-center px-2.5 py-1 rounded-full text-xs font-bold bg-green-100 text-green-700 dark:bg-green-900/30 dark:text-green-400">Published</span>
                        @else
                            <span class="inline-flex items-center px-2.5 py-1 rounded-full text-xs font-bold bg-slate-100 text-slate-600">Draft</span>
                        @endif
                    </td>
                    <td class="px-6 py-4 text-right">
                        <div class="flex justify-end items-center gap-2">
                            <a href="{{ route('admin.books.edit', $book) }}" class="p-2 rounded-lg hover:bg-slate-100 dark:hover:bg-slate-700 text-slate-400 hover:text-primary transition-colors">
                                <span class="material-symbols-outlined text-[18px]">edit</span>
                            </a>
                        </div>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="4" class="px-6 py-8 text-center text-slate-500">
                        No books added yet.
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection
