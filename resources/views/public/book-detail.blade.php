{{-- Halaman detail buku --}}
@extends('public.layouts.app')

@section('title', $book->title . ' - Jarreva Creative')

@section('content')

@php
    // DUMMY DATA FOR TESTING - Ganti dengan $book->is_paid dan $book->price dari database nantinya
    $isPaid = isset($book->is_paid) ? $book->is_paid : ($book->id % 2 == 0); 
    $price = isset($book->price) ? $book->price : 3400000;
@endphp

{{-- Navbar is already included in app.blade.php --}}

<style>
    /* Custom Responsive Classes (Tailwind JIT bypass) */
    .mobile-only, .mobile-flex-only { display: none !important; }
    .desktop-only { display: block !important; }
    .desktop-flex-only { display: flex !important; }
    @media (max-width: 1023px) {
        .mobile-only { display: block !important; }
        .mobile-flex-only { display: flex !important; }
        .desktop-only, .desktop-flex-only { display: none !important; }
    }

    .book-glow {
        position: relative;
    }
    .book-glow::after {
        content: '';
        position: absolute;
        top: 50%;
        left: 50%;
        transform: translate(-50%, -50%);
        width: 140%;
        height: 140%;
        background: radial-gradient(circle, rgba(19, 127, 236, 0.15) 0%, rgba(249, 115, 22, 0.1) 40%, transparent 70%);
        z-index: -1;
        filter: blur(50px);
    }
    .perspective-1000 {
        perspective: 1200px;
    }
    .book-3d-mockup {
        transform: rotateY(-18deg) rotateX(8deg);
        transition: transform 0.6s cubic-bezier(0.2, 0.8, 0.2, 1), box-shadow 0.6s ease;
        transform-style: preserve-3d;
    }
    .book-3d-mockup:hover {
        transform: rotateY(-5deg) rotateX(2deg) translateY(-10px);
        box-shadow: 25px 35px 50px -12px rgba(0, 0, 0, 0.3);
    }
    
    /* Reveal Reset for immediate view */
    .reveal-immediate {
        animation: fadeSlideUp 0.8s cubic-bezier(0.2, 0.8, 0.2, 1) forwards;
        opacity: 0;
        transform: translateY(30px);
    }
    @keyframes fadeSlideUp {
        to {
            opacity: 1;
            transform: translateY(0);
        }
    }
</style>

{{-- ===== HERO BACKGROUND 3D (SOFT BLOBS) ===== --}}
@include('public.components.book-detail-bg')

<main class="flex-grow pt-24 pb-32 relative z-10 w-full overflow-hidden">
    <section class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">

        {{-- ===== DETAIL BUKU UTAMA (MODERN LAYOUT) ===== --}}
        
        {{-- MOBILE ONLY: Kategori & Judul Buku di atas gambar, di tengah --}}
        <div class="mobile-only text-center pt-8 reveal-immediate" style="animation-delay: 0.1s;">
            <div class="inline-flex items-center gap-1.5 px-3 py-1 bg-slate-100 dark:bg-slate-800 rounded-full mb-4">
                <span class="w-2 h-2 rounded-full bg-primary animate-pulse shadow-[0_0_8px_rgba(249,115,22,0.8)]"></span>
                <span class="text-xs font-bold text-slate-600 dark:text-slate-300 uppercase tracking-widest">{{ $book->category ?? 'Publication' }}</span>
            </div>
            <h1 class="text-3xl sm:text-4xl font-black text-slate-900 dark:text-white leading-[1.2] tracking-tight mb-2" style="font-family: 'Montserrat', sans-serif;">
                {{ $book->title }}
            </h1>
            <p class="text-slate-500 dark:text-slate-400 font-medium text-sm flex items-center justify-center gap-1.5">
                <span class="material-symbols-outlined text-base">edit_note</span>
                By <span class="text-slate-800 dark:text-slate-200 font-bold">{{ $book->author ?? 'Jarreva Creative' }}</span>
            </p>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-12 gap-8 lg:gap-20 items-start mt-8 lg:mt-12 mb-24 w-full">

            {{-- Kolom Kiri: Cover --}}
            <div class="lg:col-span-5 flex flex-col items-center lg:items-end lg:sticky lg:top-32 reveal-immediate" style="animation-delay: 0.2s;">
                <div class="flex justify-center items-center perspective-1000 py-6 w-full max-w-md">
                    <div class="book-glow w-full flex justify-center">
                        <div class="book-3d-mockup relative w-[260px] sm:w-[320px] lg:w-[380px] aspect-[2/3] rounded-r-lg shadow-2xl shadow-slate-900/40">
                            @if($isPaid)
                                <div class="absolute top-4 left-4 z-20 bg-rose-500 text-white text-[10px] sm:text-xs font-bold px-3 py-1.5 rounded-full shadow-lg uppercase tracking-wider backdrop-blur-sm bg-opacity-90 flex items-center gap-1">
                                    <span class="material-symbols-outlined text-[14px]">sell</span> Premium
                                </div>
                            @else
                                <div class="absolute top-4 left-4 z-20 bg-emerald-500 text-white text-[10px] sm:text-xs font-bold px-3 py-1.5 rounded-full shadow-lg uppercase tracking-wider backdrop-blur-sm bg-opacity-90 flex items-center gap-1">
                                    <span class="material-symbols-outlined text-[14px]">stars</span> Free
                                </div>
                            @endif
                            @if($book->cover_image)
                                <img
                                    src="{{ asset('storage/' . $book->cover_image) }}"
                                    alt="{{ $book->title }}"
                                    class="h-full w-full object-cover rounded-r-lg border-l-[14px] border-slate-900/20 dark:border-slate-800/60"
                                />
                            @else
                                <div class="h-full w-full flex flex-col items-center justify-center bg-gradient-to-br from-slate-100 to-slate-200 dark:from-slate-800 dark:to-slate-900 rounded-r-lg border-l-[14px] border-slate-900/20 dark:border-slate-800/60">
                                    <span class="material-symbols-outlined text-7xl text-slate-300 dark:text-slate-600 mb-4">auto_stories</span>
                                    <span class="text-xs font-bold text-slate-400 uppercase tracking-widest">No Cover</span>
                                </div>
                            @endif
                            <div class="absolute inset-0 bg-gradient-to-r from-black/30 via-transparent to-transparent pointer-events-none rounded-r-lg"></div>
                            
                            {{-- Pages effect on the right edge (optional realism) --}}
                            <div class="absolute right-0 top-[2%] bottom-[2%] w-[4px] bg-white rounded-r-sm shadow-inner transform translate-x-full"></div>
                        </div>
                    </div>
                </div>

                {{-- MOBILE ONLY: Published Info --}}
                <div class="mobile-flex-only justify-center items-center mt-6 w-full gap-8 reveal-immediate" style="animation-delay: 0.3s;">
                    <div class="flex flex-col items-center text-center">
                        <span class="text-[10px] uppercase font-bold tracking-widest text-slate-400 dark:text-slate-500 mb-1.5">Published</span>
                        <span class="text-sm font-bold text-slate-800 dark:text-slate-200 flex items-center">
                            <span class="material-symbols-outlined text-[16px] text-primary mr-1.5">calendar_today</span>
                            {{ $book->year ?? $book->created_at->format('Y') }}
                        </span>
                    </div>
                </div>

                {{-- Border divider for mobile --}}
                <div class="mobile-only w-full h-px bg-slate-200 dark:bg-slate-800 mt-8 mb-2"></div>
            </div>

            {{-- Kolom Kanan: Info Buku --}}
            <div class="lg:col-span-7 flex flex-col pt-0 lg:pt-10">

                {{-- Minimal Go Back Button --}}
                <div class="desktop-only mb-8 reveal-immediate" style="animation-delay: 0.1s;">
                    <a href="{{ route('catalog.index') }}" class="inline-flex items-center gap-2 text-sm font-bold text-slate-500 dark:text-slate-400 hover:text-primary dark:hover:text-primary transition-colors group">
                        <span class="material-symbols-outlined text-[18px] transform transition-transform group-hover:-translate-x-1">arrow_back</span>
                        Back to Portfolio
                    </a>
                </div>

                {{-- Judul (Desktop) --}}
                <div class="desktop-only mb-8 reveal-immediate" style="animation-delay: 0.2s;">
                    <div class="inline-flex items-center gap-1.5 px-3 py-1 bg-slate-100 dark:bg-slate-800 rounded-full mb-4">
                        <span class="w-2 h-2 rounded-full bg-primary animate-pulse shadow-[0_0_8px_rgba(249,115,22,0.8)]"></span>
                        <span class="text-xs font-bold text-slate-600 dark:text-slate-300 uppercase tracking-widest">{{ $book->category ?? 'Publication' }}</span>
                    </div>
                    <h1 class="text-4xl sm:text-5xl md:text-6xl font-black text-slate-900 dark:text-white leading-[1.1] tracking-tight mb-4" style="font-family: 'Montserrat', sans-serif;">
                        {{ $book->title }}
                    </h1>
                    <p class="text-lg text-slate-500 dark:text-slate-400 font-medium flex items-center gap-2">
                        <span class="material-symbols-outlined text-xl">edit_note</span>
                        By <span class="text-slate-800 dark:text-slate-200 font-bold">{{ $book->author ?? 'Jarreva Creative' }}</span>
                    </p>
                </div>

                {{-- Meta Info Grid (Desktop) --}}
                <div class="desktop-flex-only mb-8 pb-8 border-b border-slate-200 dark:border-slate-800 reveal-immediate" style="animation-delay: 0.3s;">
                    <div class="flex flex-col">
                        <span class="text-[10px] uppercase font-bold tracking-widest text-slate-400 dark:text-slate-500 mb-1.5">Published</span>
                        <span class="text-base font-bold text-slate-800 dark:text-slate-200 flex items-center gap-1.5">
                            <span class="material-symbols-outlined text-[18px] text-primary">calendar_today</span>
                            {{ $book->year ?? $book->created_at->format('Y') }}
                        </span>
                    </div>
                </div>

                {{-- Deskripsi --}}
                <div class="mb-10 reveal-immediate" style="animation-delay: 0.4s;">
                    <!-- Wrapper for expansion -->
                    <div id="desc-wrapper" class="relative overflow-hidden transition-[max-height,opacity] duration-500 ease-in-out" style="max-height: 5.5rem;">
                        <div class="prose prose-lg prose-slate dark:prose-invert max-w-none">
                            <p id="desc-content" class="text-base md:text-lg text-slate-600 dark:text-slate-300 leading-relaxed font-medium text-justify m-0 pb-1">
                                {{ $book->description }}
                            </p>
                        </div>
                        <!-- Faded effect at the bottom when collapsed -->
                        <div id="desc-fade" class="absolute bottom-0 left-0 w-full h-12 bg-gradient-to-t from-white dark:from-slate-900 to-transparent pointer-events-none transition-opacity duration-300"></div>
                    </div>
                    
                    <!-- Read More Toggle Button -->
                    <button id="desc-toggle" type="button" class="mt-2 ml-auto flex items-center gap-1.5 text-sm font-bold text-primary hover:text-orange-600 transition-colors group focus:outline-none" style="display: none;">
                        <span id="desc-toggle-text">Read More</span>
                        <span id="desc-toggle-icon" class="material-symbols-outlined text-[18px] transition-transform duration-300 group-hover:translate-y-0.5">expand_more</span>
                    </button>
                    
                    <script>
                        document.addEventListener("DOMContentLoaded", function() {
                            const wrapper = document.getElementById('desc-wrapper');
                            const content = document.getElementById('desc-content');
                            const toggleBtn = document.getElementById('desc-toggle');
                            const toggleText = document.getElementById('desc-toggle-text');
                            const toggleIcon = document.getElementById('desc-toggle-icon');
                            const fadePanel = document.getElementById('desc-fade');
                            
                            // Initialize standard max height (roughly 3-4 lines depending on text size)
                            const collapsedHeight = 88; // ~ 5.5rem (88px)
                            
                            // Check if content is actually taller than collapsed height
                            setTimeout(() => {
                                const fullHeight = content.scrollHeight;
                                
                                if (fullHeight > collapsedHeight) {
                                    // If text is long, show the toggle button
                                    toggleBtn.style.display = 'flex';
                                    wrapper.style.maxHeight = collapsedHeight + 'px';
                                    
                                    let isExpanded = false;
                                    
                                    toggleBtn.addEventListener('click', function() {
                                        isExpanded = !isExpanded;
                                        
                                        if (isExpanded) {
                                            // Expand
                                            wrapper.style.maxHeight = fullHeight + 10 + 'px'; // +10 for bottom padding tolerance
                                            toggleText.textContent = 'Read Less';
                                            toggleIcon.textContent = 'expand_less';
                                            toggleIcon.classList.replace('group-hover:translate-y-0.5', 'group-hover:-translate-y-0.5');
                                            fadePanel.style.opacity = '0';
                                        } else {
                                            // Collapse
                                            wrapper.style.maxHeight = collapsedHeight + 'px';
                                            toggleText.textContent = 'Read More';
                                            toggleIcon.textContent = 'expand_more';
                                            toggleIcon.classList.replace('group-hover:-translate-y-0.5', 'group-hover:translate-y-0.5');
                                            fadePanel.style.opacity = '1';
                                        }
                                    });
                                } else {
                                    // If text is short, hide fade and button
                                    fadePanel.style.display = 'none';
                                    wrapper.style.maxHeight = 'none';
                                    wrapper.style.overflow = 'visible';
                                }
                            }, 100);
                        });
                    </script>
                </div>

                {{-- Action Buttons --}}
                <div class="reveal-immediate" style="animation-delay: 0.5s;">
                    @if($isPaid)
                        {{-- BUY NOW --}}
                        <div class="flex flex-col sm:flex-row items-center gap-4 sm:gap-6 bg-slate-50 dark:bg-slate-800/50 p-4 rounded-2xl border border-slate-100 dark:border-slate-800">
                            <div class="flex flex-col items-center sm:items-start text-center sm:text-left w-full sm:w-auto">
                                <span class="text-xs font-bold text-slate-500 dark:text-slate-400 uppercase tracking-widest mb-1">Price</span>
                                <span class="text-2xl font-black text-slate-900 dark:text-white">Rp {{ number_format($price, 0, ',', '.') }}</span>
                            </div>
                            <!-- Update onclick to an href mapping if needed -->
                            <a href="{{ route('book.checkout', $book->slug) }}" class="group relative inline-flex items-center justify-center px-8 py-4 bg-primary text-white text-base font-bold rounded-xl overflow-hidden transition-all duration-300 shadow-[0_10px_20px_-10px_rgba(249,115,22,0.8)] hover:shadow-[0_15px_30px_-10px_rgba(249,115,22,1)] hover:-translate-y-1 sm:w-auto w-full sm:ml-auto">
                                <span class="absolute inset-0 w-full h-full bg-gradient-to-r from-transparent via-white/20 to-transparent -translate-x-full group-hover:animate-[shimmer_1.5s_infinite] transition-transform duration-700 ease-in-out z-0"></span>
                                <span class="relative z-10 flex items-center gap-2">
                                    <span class="material-symbols-outlined text-[20px]">shopping_cart_checkout</span>
                                    Buy Now
                                </span>
                            </a>
                        </div>
                    @else
                        {{-- READ NOW (FREE) --}}
                        <div class="flex flex-col sm:flex-row items-center gap-4 sm:gap-6 bg-emerald-50/50 dark:bg-emerald-900/10 p-5 rounded-2xl border border-emerald-100 dark:border-emerald-800/30">
                            <div class="flex flex-col items-center sm:items-start text-center sm:text-left w-full sm:w-auto">
                                <span class="text-emerald-600 dark:text-emerald-400 font-black text-xl uppercase tracking-wider flex items-center gap-1.5"><span class="material-symbols-outlined">verified</span> Free Access</span>
                                <span class="text-xs font-medium text-slate-500 dark:text-slate-400 mt-1">Ready to read online</span>
                            </div>
                            <a href="{{ route('book.read', $book->slug) }}" class="group relative inline-flex items-center justify-center px-8 py-4 bg-emerald-600 text-white text-base font-bold rounded-xl overflow-hidden transition-all duration-300 shadow-[0_10px_20px_-10px_rgba(5,150,105,0.6)] hover:shadow-[0_15px_30px_-10px_rgba(5,150,105,0.8)] hover:-translate-y-1 sm:w-auto w-full sm:ml-auto focus:outline-none focus:ring-4 focus:ring-emerald-500/30">
                                <span class="absolute inset-0 w-full h-full bg-gradient-to-r from-transparent via-white/20 to-transparent -translate-x-full group-hover:animate-[shimmer_1.5s_infinite] transition-transform duration-700 ease-in-out z-0"></span>
                                <span class="relative z-10 flex items-center gap-2">
                                    <span class="material-symbols-outlined text-[20px] transition-transform duration-300 group-hover:scale-110">auto_stories</span>
                                    Read Now
                                </span>
                            </a>
                        </div>
                    @endif
                    
                    <style>
                        @keyframes shimmer {
                            100% {
                                transform: translateX(100%);
                            }
                        }
                    </style>
                </div>

            </div>
        </div>

        {{-- ===== BUKU LAINNYA ===== --}}
        @if(isset($relatedBooks) && $relatedBooks->count())
        <div class="w-full py-20 border-t border-slate-200 dark:border-slate-800/50 relative z-10 m-auto mt-10">

            {{-- Judul Seksi --}}
            <div class="flex flex-col items-center text-center mb-16 max-w-3xl mx-auto px-4 reveal-immediate" style="animation-delay: 0.2s;">
                <span class="text-primary font-bold tracking-widest uppercase text-xs mb-3">Keep Exploring</span>
                <h2 class="text-3xl md:text-4xl font-black text-slate-900 dark:text-white mb-6 font-display" style="font-family: 'Montserrat', sans-serif;">More from Jarreva</h2>
                <p class="text-base text-slate-500 dark:text-slate-400 font-medium leading-relaxed max-w-xl mx-auto">
                    Discover other publications crafted to help you focus, grow, and achieve your true potential.
                </p>
            </div>

            {{-- Grid Buku Terkait --}}
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-x-8 gap-y-12">
                @foreach ($relatedBooks as $index => $related)
                <a
                    href="{{ route('book.show', $related->slug) }}"
                    class="group flex flex-col bg-white dark:bg-slate-900 rounded-3xl overflow-hidden border border-slate-100 dark:border-slate-800/60 hover:border-slate-200 dark:hover:border-slate-700/80 shadow-sm hover:shadow-2xl hover:shadow-slate-200/50 dark:hover:shadow-black/50 transition-all duration-500 hover:-translate-y-2 reveal-immediate"
                    style="animation-delay: {{ 0.2 + ($index * 0.1) }}s;"
                >
                    <div class="w-full h-[240px] bg-slate-50 dark:bg-slate-800/50 p-6 flex items-center justify-center relative overflow-hidden">
                        {{-- Soft radial glow --}}
                        <div class="absolute inset-0 bg-gradient-to-tr from-orange-500/0 to-blue-500/0 group-hover:from-orange-500/5 group-hover:to-blue-500/5 transition-colors duration-500"></div>
                        
                        @if($related->cover_image)
                            <img src="{{ asset('storage/' . $related->cover_image) }}" alt="{{ $related->title }}" class="h-full w-auto object-cover rounded-md shadow-lg transform transition-transform duration-700 cubic-bezier(0.2, 0.8, 0.2, 1) group-hover:scale-105 group-hover:-rotate-2 border-l-[4px] border-slate-900/10 relative z-10" />
                        @else
                            <div class="h-full w-32 flex flex-col items-center justify-center bg-gradient-to-br from-slate-200 to-slate-300 dark:from-slate-700 dark:to-slate-800 rounded-md shadow-xl border-l-[4px] border-slate-900/10 transform transition-transform duration-700 cubic-bezier(0.2, 0.8, 0.2, 1) group-hover:scale-105 group-hover:-rotate-2 relative z-10">
                                <span class="material-symbols-outlined text-4xl text-slate-400 dark:text-slate-500">auto_stories</span>
                            </div>
                        @endif
                    </div>
                    <div class="p-6 flex flex-col flex-grow">
                        <span class="text-[10px] uppercase font-bold tracking-widest text-slate-400 mb-2">{{ $related->category ?? 'Publication' }}</span>
                        <h3 class="text-xl font-bold text-slate-900 dark:text-white mb-3 tracking-tight group-hover:text-primary transition-colors">
                            {{ $related->title }}
                        </h3>
                        <p class="text-sm text-slate-500 dark:text-slate-400 leading-relaxed line-clamp-2 mb-6">
                            {{ $related->description }}
                        </p>
                        <div class="mt-auto flex items-center gap-2 text-xs font-bold uppercase tracking-wider text-slate-400 group-hover:text-primary transition-colors">
                            <span>Read More</span>
                            <span class="material-symbols-outlined text-sm transform transition-transform group-hover:translate-x-1">trending_flat</span>
                        </div>
                    </div>
                </a>
                @endforeach
            </div>

        </div>
        @endif

    </section>
</main>

{{-- Footer and its 3D Background are already included in app.blade.php --}}

@endsection