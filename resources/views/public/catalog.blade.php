@extends('public.layouts.app')

@section('title', 'Jarreva Creative - Catalog Portfolio')

@section('content')
    <!-- Header Section with Dynamic Background & Gradient Text -->
    <div class="relative py-20 lg:py-28 overflow-hidden bg-white dark:bg-background-dark">
        <!-- Seamless Top Gradient for transition -->
        <div
            class="absolute top-0 left-0 w-full h-32 lg:h-48 bg-gradient-to-t from-transparent to-white dark:to-background-dark pointer-events-none z-20">
        </div>

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
                <span
                    class="w-2 h-2 lg:w-3 lg:h-3 rounded-full bg-primary animate-pulse shadow-[0_0_8px_rgba(249,115,22,0.8)]"></span>
                <span class="text-[11px] sm:text-xs lg:text-sm font-medium text-slate-600 dark:text-slate-300 font-mono">Our
                    Creative
                    Works</span>
            </div>

            <h1
                class="mb-6 font-display text-4xl sm:text-5xl md:text-6xl lg:text-7xl font-bold tracking-tight leading-[1.1] dark:text-white drop-shadow-sm max-w-5xl mx-auto">
                Discover Our<br class="hidden md:block" /> <span
                    class="text-transparent bg-clip-text bg-gradient-to-r from-primary to-secondary">Portfolio</span>
            </h1>

            <p
                class="max-w-2xl text-base sm:text-lg lg:text-xl text-gray-600 dark:text-gray-300 mx-auto leading-relaxed mb-8 lg:mb-10 font-medium">
                Explore a curated collection of our best projects, publications, and creative endeavors that define Jarreva
                Creative's commitment to excellence.
            </p>
        </div>

        <!-- Seamless Bottom Gradient for transition -->
        <div
            class="absolute bottom-0 left-0 w-full h-32 lg:h-48 bg-gradient-to-b from-transparent to-white dark:to-background-dark pointer-events-none z-20">
        </div>
    </div>

    <!-- Catalog Grid Section -->
    <div class="container mx-auto px-4 py-16 lg:py-24">

        <!-- Optional: Simulated Toolbar/Filters (Just for visual enhancement) -->


        <!-- Grid Container -->
        <style>
            @media (max-width: 767px) {
                .mobile-catalog-grid {
                    grid-template-columns: repeat(2, minmax(0, 1fr)) !important;
                    gap: 12px !important;
                }

                .mobile-catalog-card {
                    border-radius: 12px !important;
                }

                .mobile-catalog-img {
                    aspect-ratio: 860/1216 !important;
                    height: auto !important;
                    padding: 12px !important;
                }

                .mobile-catalog-icon-empty {
                    font-size: 36px !important;
                }

                .mobile-catalog-badge {
                    padding: 4px 8px !important;
                    font-size: 9px !important;
                    top: 8px !important;
                    left: 8px !important;
                    border-radius: 6px !important;
                }

                .mobile-catalog-body {
                    padding: 12px !important;
                }

                .mobile-catalog-title {
                    font-size: 13px !important;
                    margin-bottom: 6px !important;
                    line-height: 1.3 !important;
                }

                .mobile-catalog-desc {
                    font-size: 10px !important;
                    margin-bottom: 12px !important;
                    line-height: 1.4 !important;
                    -webkit-line-clamp: 2 !important;
                }

                .mobile-catalog-footer {
                    padding-top: 12px !important;
                }

                .mobile-catalog-date-icon {
                    width: 24px !important;
                    height: 24px !important;
                }

                .mobile-catalog-date-icon span {
                    font-size: 11px !important;
                }

                .mobile-catalog-date {
                    font-size: 9px !important;
                }

                .mobile-catalog-readmore {
                    font-size: 11px !important;
                    gap: 4px !important;
                }

                .mobile-catalog-readmore span {
                    font-size: 13px !important;
                }
            }
        </style>
        <div class="mobile-catalog-grid grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-6 gap-6">
            @forelse($books ?? [] as $book)
                <!-- Book Card -->
                <!-- Book Card (Unified Design) -->
                <a href="{{ route('book.show', $book->slug ?? '#') }}"
                    class="mobile-catalog-card group flex flex-col bg-white dark:bg-slate-900 rounded-3xl overflow-hidden border border-slate-100 dark:border-slate-800/60 hover:border-slate-200 dark:hover:border-slate-700/80 shadow-sm hover:shadow-2xl hover:shadow-slate-200/50 dark:hover:shadow-black/50 transition-all duration-500 hover:-translate-y-2">
                    <div
                        class="mobile-catalog-img w-full aspect-[860/1216] bg-slate-50 dark:bg-slate-800/50 p-4 md:p-6 flex items-center justify-center relative overflow-hidden">
                        {{-- Soft radial glow --}}
                        <div
                            class="absolute inset-0 bg-gradient-to-tr from-orange-500/0 to-blue-500/0 group-hover:from-orange-500/5 group-hover:to-blue-500/5 transition-colors duration-500 z-20 pointer-events-none">
                        </div>

                        @if($book->cover_image)
                            <img src="{{ asset('storage/' . $book->cover_image) }}" alt="{{ $book->title }}"
                                class="w-full h-full object-cover rounded-md shadow-lg border-l-[3px] border-slate-900/10 transform transition-transform duration-700 cubic-bezier(0.2, 0.8, 0.2, 1) group-hover:scale-105 group-hover:-rotate-2 relative z-10" />
                        @else
                            <div
                                class="w-full h-full flex flex-col items-center justify-center bg-gradient-to-br from-slate-200 to-slate-300 dark:from-slate-700 dark:to-slate-800 rounded-md shadow-lg border-l-[3px] border-slate-900/10 transform transition-transform duration-700 cubic-bezier(0.2, 0.8, 0.2, 1) group-hover:scale-105 group-hover:-rotate-2 relative z-10">
                                <span
                                    class="mobile-catalog-icon-empty material-symbols-outlined text-4xl text-slate-400 dark:text-slate-500">auto_stories</span>
                            </div>
                        @endif
                    </div>
                    <div class="mobile-catalog-body p-6 flex flex-col flex-grow bg-white dark:bg-slate-900 transition-colors duration-500">
                        <div class="mt-auto w-full flex flex-col justify-end">
                            
                            <!-- Category -->
                            <div class="mb-1.5 flex items-center gap-2">
                                <div class="h-px w-3 bg-primary/40 hidden sm:block"></div>
                                <span class="text-[10px] uppercase font-semibold tracking-widest text-slate-500 dark:text-slate-400 block transition-colors duration-300 group-hover:text-primary">
                                    {{ $book->category ?? 'Publication' }}
                                </span>
                            </div>
                            
                            <!-- Attractive & Clean Title -->
                            <h3 class="text-[17px] font-medium text-slate-800 dark:text-slate-200 leading-[1.4] tracking-tight group-hover:text-primary capitalize transition-all duration-300 mobile-catalog-title mb-4 line-clamp-2">
                                {{ $book->title ?? 'Untitled Masterpiece' }}
                            </h3>
                            
                            <!-- Price & Action -->
                            <div class="mt-auto flex items-center justify-between pt-3 border-t border-slate-100 dark:border-slate-800/80 transition-colors duration-300 group-hover:border-slate-200 dark:group-hover:border-slate-700">
                                @if(isset($book->price) && $book->price > 0)
                                    <span class="text-[20px] font-black text-slate-700 dark:text-slate-200 tracking-tight flex items-baseline gap-[2px] group-hover:text-slate-900 dark:group-hover:text-white transition-colors duration-300">
                                        <span class="text-[15px] font-extrabold text-slate-400/80 dark:text-slate-500">$</span>{{ number_format($book->price, 2) }}
                                    </span>
                                @else
                                    <span class="text-[11px] font-semibold uppercase tracking-wider text-emerald-600 dark:text-emerald-400 bg-emerald-50 dark:bg-emerald-500/10 px-2 py-0.5 rounded-full border border-emerald-100 dark:border-emerald-500/20">
                                        Free
                                    </span>
                                @endif
                                
                                <div class="h-7 w-7 rounded-full bg-slate-50 dark:bg-slate-800 flex items-center justify-center opacity-0 group-hover:opacity-100 transform scale-75 group-hover:scale-100 transition-all duration-300 text-primary group-hover:shadow-[0_0_10px_rgba(var(--color-primary-rgb),0.2)]">
                                    <span class="material-symbols-outlined text-[13px] translate-x-px">arrow_forward_ios</span>
                                </div>
                            </div>
                            
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