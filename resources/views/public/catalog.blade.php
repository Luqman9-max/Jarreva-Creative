@extends('public.layouts.app')

@section('title', 'Jarreva Creative - Catalog Portfolio')

@section('content')
<!-- Header Section with Dynamic Background & Gradient Text -->
<div class="relative py-20 lg:py-28 overflow-hidden bg-white dark:bg-background-dark">
    <!-- Seamless Top Gradient for transition -->
    <div class="absolute top-0 left-0 w-full h-32 lg:h-48 bg-gradient-to-t from-transparent to-white dark:to-background-dark pointer-events-none z-20"></div>

    <!-- Background decorative elements -->
    <div class="absolute inset-0 z-0 pointer-events-none">
        <div
            class="absolute -top-24 -left-24 w-96 h-96 bg-primary/5 rounded-full mix-blend-multiply filter blur-3xl opacity-70 animate-float-p1 dark:opacity-10 translate-x-1/4">
        </div>
        <div
            class="absolute top-1/4 right-0 w-96 h-96 bg-secondary/5 rounded-full mix-blend-multiply filter blur-3xl opacity-70 animate-float-p2 dark:opacity-10 -translate-x-1/4">
        </div>
        <div
            class="absolute -bottom-24 left-1/3 w-80 h-80 bg-indigo-400/5 rounded-full mix-blend-multiply filter blur-3xl opacity-70 animate-float-p3 dark:opacity-10">
        </div>
    </div>

    <div class="relative z-10 w-full max-w-7xl px-6 md:px-12 mx-auto flex flex-col items-center text-center">
        <!-- Badge -->
        <div
            class="inline-flex items-center gap-1.5 lg:gap-2 px-3 py-1.5 lg:px-4 lg:py-2 rounded-full border border-slate-200 dark:border-slate-700 bg-white/50 dark:bg-slate-800/50 backdrop-blur-sm shadow-inner shadow-sm mb-6 animate-float">
            <span class="w-2 h-2 lg:w-3 lg:h-3 rounded-full bg-primary animate-pulse shadow-[0_0_8px_rgba(249,115,22,0.8)]"></span>
            <span class="text-[11px] sm:text-xs lg:text-sm font-medium text-slate-600 dark:text-slate-300 font-mono">Our Creative
                Works</span>
        </div>

        <h1 class="mb-6 font-display text-4xl sm:text-5xl md:text-6xl lg:text-7xl font-bold tracking-tight leading-[1.1] dark:text-white drop-shadow-sm max-w-5xl mx-auto">
            Discover Our<br class="hidden md:block" /> <span
                class="text-transparent bg-clip-text bg-gradient-to-r from-primary to-secondary">Portfolio</span>
        </h1>

        <p class="max-w-2xl text-base sm:text-lg lg:text-xl text-gray-600 dark:text-gray-300 mx-auto leading-relaxed mb-8 lg:mb-10 font-medium">
            Explore a curated collection of our best projects, publications, and creative endeavors that define Jarreva
            Creative's commitment to excellence.
        </p>
    </div>

    <!-- Seamless Bottom Gradient for transition -->
    <div class="absolute bottom-0 left-0 w-full h-32 lg:h-48 bg-gradient-to-b from-transparent to-white dark:to-background-dark pointer-events-none z-20"></div>
</div>

<!-- Catalog Grid Section -->
<div class="container mx-auto px-4 py-16 lg:py-24">

    <!-- Optional: Simulated Toolbar/Filters (Just for visual enhancement) -->


    <!-- Grid Container -->
<<<<<<< HEAD
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-8">
        @forelse ($books ?? [] as $book)
        <!-- Book Card -->
        <div
            class="group relative bg-white dark:bg-gray-800 rounded-2xl overflow-hidden border border-gray-100 hover:border-primary/30 dark:border-gray-700 dark:hover:border-primary/50 shadow-sm hover:shadow-2xl hover:shadow-primary/10 transition-all duration-500 transform hover:-translate-y-2 flex flex-col h-full z-10 hover:z-20">

            <!-- Card Image Header -->
            <div
                class="relative h-64 overflow-hidden border-b border-gray-100 dark:border-gray-700 bg-gray-50 dark:bg-gray-900">
                {{-- Assuming book has an image property in future, fallback to placeholder --}}
                @if (isset($book->image))
                <img src="{{ asset('storage/' . $book->image) }}" alt="{{ $book->title }}"
                    class="w-full h-full object-cover transition-transform duration-700 group-hover:scale-110">
=======
    <style>
        @media (max-width: 767px) {
            .mobile-catalog-grid { grid-template-columns: repeat(2, minmax(0, 1fr)) !important; gap: 12px !important; }
            .mobile-catalog-card { border-radius: 12px !important; }
            .mobile-catalog-img { height: 180px !important; padding: 12px !important; }
            .mobile-catalog-icon-empty { font-size: 36px !important; }
            .mobile-catalog-badge { padding: 4px 8px !important; font-size: 9px !important; top: 8px !important; left: 8px !important; border-radius: 6px !important; }
            .mobile-catalog-body { padding: 12px !important; }
            .mobile-catalog-title { font-size: 13px !important; margin-bottom: 6px !important; line-height: 1.3 !important; }
            .mobile-catalog-desc { font-size: 10px !important; margin-bottom: 12px !important; line-height: 1.4 !important; -webkit-line-clamp: 2 !important; }
            .mobile-catalog-footer { padding-top: 12px !important; }
            .mobile-catalog-date-icon { width: 24px !important; height: 24px !important; }
            .mobile-catalog-date-icon span { font-size: 11px !important; }
            .mobile-catalog-date { font-size: 9px !important; }
            .mobile-catalog-readmore { font-size: 11px !important; gap: 4px !important; }
            .mobile-catalog-readmore span { font-size: 13px !important; }
        }
    </style>
    <div class="mobile-catalog-grid grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-8">
        @forelse($books ?? [] as $book)
        <!-- Book Card -->
        <!-- Book Card (Unified Design) -->
        <a href="{{ route('book.show', $book->slug ?? '#') }}" class="mobile-catalog-card group flex flex-col bg-white dark:bg-slate-900 rounded-3xl overflow-hidden border border-slate-100 dark:border-slate-800/60 hover:border-slate-200 dark:hover:border-slate-700/80 shadow-sm hover:shadow-2xl hover:shadow-slate-200/50 dark:hover:shadow-black/50 transition-all duration-500 hover:-translate-y-2">
            <div class="mobile-catalog-img w-full h-[240px] bg-slate-50 dark:bg-slate-800/50 p-6 flex items-center justify-center relative overflow-hidden">
                {{-- Soft radial glow --}}
                <div class="absolute inset-0 bg-gradient-to-tr from-orange-500/0 to-blue-500/0 group-hover:from-orange-500/5 group-hover:to-blue-500/5 transition-colors duration-500"></div>
                
                @if($book->cover_image)
                    <img src="{{ asset('storage/' . $book->cover_image) }}" alt="{{ $book->title }}" class="h-full w-auto object-cover rounded-md shadow-lg transform transition-transform duration-700 cubic-bezier(0.2, 0.8, 0.2, 1) group-hover:scale-105 group-hover:-rotate-2 border-l-[4px] border-slate-900/10 relative z-10" />
>>>>>>> origin/main
                @else
                    <div class="h-full w-32 flex flex-col items-center justify-center bg-gradient-to-br from-slate-200 to-slate-300 dark:from-slate-700 dark:to-slate-800 rounded-md shadow-xl border-l-[4px] border-slate-900/10 transform transition-transform duration-700 cubic-bezier(0.2, 0.8, 0.2, 1) group-hover:scale-105 group-hover:-rotate-2 relative z-10">
                        <span class="mobile-catalog-icon-empty material-symbols-outlined text-4xl text-slate-400 dark:text-slate-500">auto_stories</span>
                    </div>
                @endif
            </div>
            <div class="mobile-catalog-body p-6 flex flex-col flex-grow">
                <span class="text-[10px] uppercase font-bold tracking-widest text-slate-400 mb-2">{{ $book->category ?? 'Publication' }}</span>
                <h3 class="text-xl font-bold text-slate-900 dark:text-white mb-3 tracking-tight group-hover:text-primary transition-colors mobile-catalog-title">
                    {{ $book->title ?? 'Untitled Masterpiece' }}
                </h3>
                <p class="text-sm text-slate-500 dark:text-slate-400 leading-relaxed line-clamp-2 mb-6 mobile-catalog-desc">
                    {{ $book->description ?? 'Dive into the details of this amazing project. Discover the creative process, design elements, and the profound impact it delivers.' }}
                </p>
                <div class="mt-auto flex items-center gap-2 text-xs font-bold uppercase tracking-wider text-slate-400 group-hover:text-primary transition-colors mobile-catalog-footer mobile-catalog-readmore">
                    <span>Read More</span>
                    <span class="material-symbols-outlined text-sm transform transition-transform group-hover:translate-x-1">trending_flat</span>
                </div>
            </div>
        </a>
        @empty
        <!-- Empty State -->
        <div
            class="col-span-full py-20 flex flex-col items-center justify-center text-center bg-gray-50 dark:bg-gray-800/50 rounded-2xl border-2 border-dashed border-gray-200 dark:border-gray-700">
            <div
                class="w-20 h-20 bg-gray-100 dark:bg-gray-700 rounded-full flex items-center justify-center mb-6 shadow-inner">
                <span class="material-symbols-outlined text-4xl text-gray-400">search_off</span>
            </div>
            <h3 class="text-2xl font-bold text-gray-800 dark:text-white mb-2">No Projects Found</h3>
            <p class="text-gray-500 max-w-md mx-auto">
                Looks like we don't have any items in the portfolio right now. Check back soon for our latest updates.
            </p>
        </div>
        @endforelse
    </div>
</div>
@endsection