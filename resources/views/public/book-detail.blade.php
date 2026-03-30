{{-- Halaman detail buku --}}
@extends('public.layouts.app')

@section('title', $book->title . ' - Jarreva Creative')

@section('content')

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

        {{-- ===== DETAIL BUKU UTAMA (EDITORIAL LAYOUT) ===== --}}
        
        {{-- MOBILE ONLY: Judul Buku di atas gambar, di tengah --}}
        <h1 class="mobile-only text-center text-3xl sm:text-4xl font-black text-slate-900 dark:text-white leading-[1.2] mb-0 pt-8 tracking-tight reveal-immediate" style="animation-delay: 0.1s; font-family: 'Montserrat', sans-serif;">
            {{ $book->title }}
        </h1>

        <div class="grid grid-cols-1 lg:grid-cols-12 gap-8 lg:gap-20 items-start mt-8 lg:mt-12 mb-24 w-full">

            {{-- Kolom Kiri: Cover --}}
            <div class="lg:col-span-5 flex flex-col items-center lg:items-end lg:sticky lg:top-32 reveal-immediate" style="animation-delay: 0.1s;">
                <div class="flex justify-center items-center perspective-1000 py-6 w-full max-w-md">
                    <div class="book-glow w-full flex justify-center">
                        <div class="book-3d-mockup relative w-[260px] sm:w-[320px] lg:w-[380px] aspect-[2/3] rounded-r-lg shadow-2xl shadow-slate-900/40">
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

                {{-- MOBILE ONLY: Kategori & Published di bawah gambar, di tengah --}}
                <div class="mobile-flex-only justify-center items-center mt-4 w-full gap-8 reveal-immediate" style="animation-delay: 0.2s;">
                    <div class="flex flex-col items-center mt-4 text-center">
                        <span class="text-[10px] uppercase font-bold tracking-widest text-slate-400 dark:text-slate-500 mb-1.5">Category</span>
                        <span class="text-sm font-bold text-slate-800 dark:text-slate-200 flex items-center">
                            <span class="material-symbols-outlined text-[18px] text-primary mr-1.5">category</span>
                            {{ $book->category ?? 'Uncategorized' }}
                        </span>
                    </div>
                    <div class="flex flex-col items-center mt-4 text-center">
                        <span class="text-[10px] uppercase font-bold tracking-widest text-slate-400 dark:text-slate-500 mb-1.5">Published</span>
                        <span class="text-sm font-bold text-slate-800 dark:text-slate-200 flex items-center">
                            <span class="material-symbols-outlined text-[18px] text-primary mr-1.5">calendar_today</span>
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
                <div class="desktop-only mb-10 reveal-immediate" style="animation-delay: 0.2s;">
                    <a href="{{ route('catalog.index') }}" class="inline-flex items-center gap-3 text-sm font-bold text-slate-500 dark:text-slate-400 hover:text-primary dark:hover:text-primary transition-colors group px-5 py-2.5 bg-slate-50 dark:bg-slate-800/50 rounded-full w-max border border-slate-100 dark:border-slate-800">
                        <span class="material-symbols-outlined text-[18px] transform transition-transform group-hover:-translate-x-1">arrow_back</span>
                        Go Back
                    </a>
                </div>

                {{-- Judul --}}
                <h1 class="desktop-only text-4xl sm:text-5xl md:text-6xl lg:text-[4rem] font-black text-slate-900 dark:text-white leading-[1.1] mb-10 tracking-tight reveal-immediate" style="animation-delay: 0.3s; font-family: 'Montserrat', sans-serif;">
                    {{ $book->title }}
                </h1>

                {{-- Meta: Kategori & Tanggal (Clean Editorial List) --}}
                <div class="desktop-flex-only items-center mb-10 pb-10 border-b border-slate-200 dark:border-slate-800 reveal-immediate" style="animation-delay: 0.4s; gap: 2rem;">
                    <div class="flex flex-col mt-4">
                        <span class="text-xs uppercase font-bold tracking-widest text-slate-400 dark:text-slate-500 mb-1">Category</span>
                        <span class="text-lg font-bold text-slate-800 dark:text-slate-200 flex items-center">
                            <span class="material-symbols-outlined text-[24px] text-primary mr-2">category</span>
                            {{ $book->category ?? 'Uncategorized' }}
                        </span>
                    </div>
                    <div class="flex flex-col mt-4">
                        <span class="text-xs uppercase font-bold tracking-widest text-slate-400 dark:text-slate-500 mb-1">Published</span>
                        <span class="text-lg font-bold text-slate-800 dark:text-slate-200 flex items-center">
                            <span class="material-symbols-outlined text-[24px] text-primary mr-2">calendar_today</span>
                            {{ $book->year ?? $book->created_at->format('Y') }}
                        </span>
                    </div>
                </div>

                {{-- Deskripsi --}}
                <div class="prose prose-lg prose-slate dark:prose-invert max-w-none mb-12 reveal-immediate" style="animation-delay: 0.5s;">
                    <p class="text-lg md:text-xl text-slate-600 dark:text-slate-400 leading-relaxed font-medium">
                        {{ $book->description }}
                    </p>
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