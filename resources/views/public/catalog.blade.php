@extends('public.layouts.app')

@section('title', 'Jarreva Creative - Catalog Portfolio')

@section('content')
    <!-- Header Section with Dynamic Background & Gradient Text -->
    <div class="relative py-20 lg:py-28 overflow-hidden bg-white dark:bg-background-dark">
        <!-- Background decorative elements -->
        <div class="absolute inset-0 z-0 pointer-events-none">
            <div class="absolute -top-24 -left-24 w-96 h-96 bg-primary/5 rounded-full mix-blend-multiply filter blur-3xl opacity-70 animate-float-p1 dark:opacity-10 translate-x-1/4"></div>
            <div class="absolute top-1/4 right-0 w-96 h-96 bg-secondary/5 rounded-full mix-blend-multiply filter blur-3xl opacity-70 animate-float-p2 dark:opacity-10 -translate-x-1/4"></div>
            <div class="absolute -bottom-24 left-1/3 w-80 h-80 bg-indigo-400/5 rounded-full mix-blend-multiply filter blur-3xl opacity-70 animate-float-p3 dark:opacity-10"></div>
        </div>
        
        <div class="container mx-auto px-4 relative z-10 text-center">
            <!-- Badge -->
            <div class="inline-flex items-center gap-2 px-4 py-2 rounded-full bg-white dark:bg-gray-800 border border-gray-100 dark:border-gray-700 shadow-sm mb-6 animate-float">
                <span class="w-2 h-2 rounded-full bg-primary animate-pulse shadow-[0_0_8px_rgba(249,115,22,0.8)]"></span>
                <span class="text-sm font-bold text-gray-800 dark:text-gray-200 uppercase tracking-widest">Our Creative Works</span>
            </div>
            
            <h1 class="text-4xl md:text-5xl lg:text-6xl font-extrabold mb-6 tracking-tight">
                Discover Our <span class="text-transparent bg-clip-text bg-gradient-to-r from-primary to-secondary">Portfolio</span>
            </h1>
            
            <p class="max-w-2xl mx-auto text-lg md:text-xl text-gray-500 dark:text-gray-400 mb-10 leading-relaxed">
                Explore a curated collection of our best projects, publications, and creative endeavors that define Jarreva Creative's commitment to excellence.
            </p>
        </div>
    </div>

    <!-- Catalog Grid Section -->
    <div class="container mx-auto px-4 py-16 lg:py-24">
        
        <!-- Optional: Simulated Toolbar/Filters (Just for visual enhancement) -->
        

        <!-- Grid Container -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-8">
            @forelse($books ?? [] as $book)
                 <!-- Book Card -->
                 <div class="group relative bg-white dark:bg-gray-800 rounded-2xl overflow-hidden border border-gray-100 hover:border-primary/30 dark:border-gray-700 dark:hover:border-primary/50 shadow-sm hover:shadow-2xl hover:shadow-primary/10 transition-all duration-500 transform hover:-translate-y-2 flex flex-col h-full z-10 hover:z-20">
                    
                    <!-- Card Image Header -->
                    <div class="relative h-64 overflow-hidden border-b border-gray-100 dark:border-gray-700 bg-gray-50 dark:bg-gray-900">
                        {{-- Assuming book has an image property in future, fallback to placeholder --}}
                        @if(isset($book->image))
                            <img src="{{ asset('storage/' . $book->image) }}" alt="{{ $book->title }}" class="w-full h-full object-cover transition-transform duration-700 group-hover:scale-110">
                        @else
                            <!-- Enhanced Placeholder -->
                            <div class="w-full h-full flex flex-col items-center justify-center text-primary/40 bg-gradient-to-br from-gray-50 to-gray-200 dark:from-gray-800 dark:to-gray-900 transition-transform duration-700 group-hover:scale-110 relative">
                                <!-- Decorative background elements inside placeholder -->
                                <div class="absolute inset-0 opacity-10" style="background-image: radial-gradient(circle at 2px 2px, currentColor 1px, transparent 0); background-size: 16px 16px;"></div>
                                <div class="absolute top-1/2 left-1/2 -translate-x-1/2 -translate-y-1/2 w-32 h-32 bg-primary/10 rounded-full blur-2xl group-hover:bg-primary/20 transition-colors duration-500"></div>
                                <span class="material-symbols-outlined text-6xl mb-2 opacity-70 z-10 group-hover:rotate-12 transition-transform duration-500">auto_stories</span>
                                <span class="text-xs font-bold tracking-widest uppercase opacity-70 z-10">Jarreva Project</span>
                            </div>
                        @endif
                        
                        <!-- Overlay & Category Badge -->
                        <div class="absolute inset-0 bg-gradient-to-t from-gray-900/80 via-gray-900/20 to-transparent opacity-0 group-hover:opacity-100 transition-all duration-500"></div>
                        
                        <!-- Hover specific action button overlay -->
                        <div class="absolute inset-0 flex items-center justify-center opacity-0 group-hover:opacity-100 transition-opacity duration-500 delay-100 z-20 pointer-events-none group-hover:pointer-events-auto">
                            <a href="{{ route('book.show', $book->slug ?? '#') }}" class="px-6 py-2.5 bg-white/95 text-primary text-sm font-bold rounded-full shadow-lg transform translate-y-4 group-hover:translate-y-0 transition-transform duration-500 hover:bg-primary hover:text-white">
                                Quick View
                            </a>
                        </div>

                        <div class="absolute top-4 left-4 z-20">
                            <span class="px-3 py-1.5 text-xs font-extrabold uppercase tracking-widest text-white bg-primary/90 backdrop-blur-sm rounded-lg shadow-lg border border-white/20">
                                {{ $book->category ?? 'Publication' }}
                            </span>
                        </div>
                    </div>

                    <!-- Card Body -->
                    <div class="p-6 flex flex-col flex-grow relative bg-white dark:bg-gray-800">
                        <!-- Floating decorative shape -->
                        <div class="absolute right-0 top-0 w-24 h-24 bg-gradient-to-br from-primary/5 to-transparent rounded-bl-full transition-transform duration-500 group-hover:scale-150"></div>

                        <div class="flex-grow z-10">
                            <!-- Title -->
                            <h3 class="font-bold text-xl text-gray-900 dark:text-white mb-3 line-clamp-2 group-hover:text-primary transition-colors duration-300">
                                {{ $book->title ?? 'Untitled Masterpiece' }}
                            </h3>
                            
                            <!-- Excerpt/Description -->
                            <p class="text-gray-500 dark:text-gray-400 text-sm line-clamp-3 mb-4 leading-relaxed group-hover:text-gray-700 dark:group-hover:text-gray-300 transition-colors duration-300">
                                {{ $book->description ?? 'Dive into the details of this amazing project. Discover the creative process, design elements, and the profound impact it delivers.' }}
                            </p>
                        </div>
                        
                        <!-- Footer / Actions -->
                        <div class="pt-5 mt-auto border-t border-gray-50 dark:border-gray-700 flex items-center justify-between z-10">
                            <div class="flex items-center gap-2">
                                <div class="w-8 h-8 rounded-full bg-gray-50 dark:bg-gray-700 flex items-center justify-center text-primary group-hover:scale-110 transition-transform duration-300 shadow-sm border border-gray-100 dark:border-gray-600">
                                    <span class="material-symbols-outlined text-sm">calendar_month</span>
                                </div>
                                <span class="text-xs text-gray-400 dark:text-gray-500 font-semibold group-hover:text-gray-600 transition-colors duration-300">
                                    {{ isset($book->created_at) ? $book->created_at->format('M Y') : '2026' }}
                                </span>
                            </div>
                            <a href="{{ route('book.show', $book->slug ?? '#') }}" class="inline-flex items-center gap-2 text-sm font-bold text-secondary dark:text-primary hover:text-primary dark:hover:text-white transition-all duration-300 relative after:absolute after:-bottom-1 after:left-0 after:w-0 after:h-0.5 after:bg-primary after:transition-all after:duration-300 group-hover:after:w-full">
                                Read More 
                                <span class="material-symbols-outlined text-sm transform group-hover:translate-x-2 transition-transform duration-300">trending_flat</span>
                            </a>
                        </div>
                    </div>
                 </div>
            @empty
                <!-- Empty State -->
                <div class="col-span-full py-20 flex flex-col items-center justify-center text-center bg-gray-50 dark:bg-gray-800/50 rounded-2xl border-2 border-dashed border-gray-200 dark:border-gray-700">
                    <div class="w-20 h-20 bg-gray-100 dark:bg-gray-700 rounded-full flex items-center justify-center mb-6 shadow-inner">
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
