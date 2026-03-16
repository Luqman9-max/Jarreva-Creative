{{-- Halaman detail buku --}}
@extends('public.layouts.app')

@section('title', $book->title . ' - Jarreva Creative')

@section('content')

{{-- Navbar is already included in app.blade.php --}}

<style>
    .book-glow {
        position: relative;
    }
    .book-glow::after {
        content: '';
        position: absolute;
        top: 50%;
        left: 50%;
        transform: translate(-50%, -50%);
        width: 120%;
        height: 120%;
        background: radial-gradient(circle, rgba(19, 127, 236, 0.15) 0%, rgba(249, 115, 22, 0.1) 50%, transparent 70%);
        z-index: -1;
        filter: blur(40px);
    }
    .perspective-1000 {
        perspective: 1000px;
    }
    .book-3d-mockup {
        transform: rotateY(-15deg) rotateX(5deg);
        transition: transform 0.5s ease;
    }
    .book-3d-mockup:hover {
        transform: rotateY(-5deg) rotateX(2deg);
    }
</style>

{{-- ===== HERO BACKGROUND 3D ===== --}}
@include('public.components.hero-3d-bg')

<main class="flex-grow pt-32 pb-24">
    <section class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">

        {{-- ===== DETAIL BUKU UTAMA ===== --}}
        <div class="bg-white dark:bg-gray-900/40 rounded-[2rem] border border-gray-100 dark:border-gray-800 shadow-2xl shadow-gray-200/50 dark:shadow-none overflow-hidden p-6 sm:p-10 lg:p-16 mb-16">
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-12 lg:gap-20 items-start">

                {{-- Kolom Kiri: Cover --}}
                <div class="flex flex-col items-center">

                    {{-- Cover Buku 3D --}}
                    <div class="flex justify-center items-center perspective-1000 py-6 mb-8">
                        <div class="book-glow">
                            <div class="book-3d-mockup relative w-[280px] sm:w-[350px] lg:w-[400px] aspect-[2/3] shadow-2xl rounded-r-lg">
                                @if($book->cover_image)
                                    <img
                                        src="{{ asset('storage/' . $book->cover_image) }}"
                                        alt="{{ $book->title }}"
                                        class="h-full w-full object-cover rounded-r-lg shadow-2xl border-l-[12px] border-gray-900/10"
                                    />
                                @else
                                    <div class="h-full w-full flex flex-col items-center justify-center bg-gradient-to-br from-gray-100 to-gray-300 dark:from-gray-700 dark:to-gray-900 rounded-r-lg border-l-[12px] border-gray-900/10">
                                        <span class="material-symbols-outlined text-7xl text-gray-400 dark:text-gray-500 mb-3">auto_stories</span>
                                        <span class="text-xs font-bold text-gray-400 uppercase tracking-widest">No Cover</span>
                                    </div>
                                @endif
                                <div class="absolute inset-0 bg-gradient-to-r from-black/20 via-transparent to-transparent pointer-events-none rounded-r-lg"></div>
                            </div>
                        </div>
                    </div>

                    {{-- Info Ringkas Buku --}}
                    <div class="w-full grid grid-cols-3 gap-px bg-gray-100 dark:bg-gray-800 rounded-2xl overflow-hidden border border-gray-100 dark:border-gray-800">
                        <div class="bg-white dark:bg-gray-900/60 p-4 flex flex-col items-center text-center">
                            <span class="text-lg font-black text-primary block">{{ $book->category ?? '-' }}</span>
                            <span class="text-[9px] uppercase font-bold tracking-widest text-text-subtle dark:text-gray-500">Category</span>
                        </div>
                        <div class="bg-white dark:bg-gray-900/60 p-4 flex flex-col items-center text-center">
                            <span class="text-lg font-black text-secondary block">{{ $book->year ?? '-' }}</span>
                            <span class="text-[9px] uppercase font-bold tracking-widest text-text-subtle dark:text-gray-500">Year</span>
                        </div>
                        <div class="bg-white dark:bg-gray-900/60 p-4 flex flex-col items-center text-center">
                            <span class="text-lg font-black text-primary block">{{ $book->is_featured ? 'Yes' : 'No' }}</span>
                            <span class="text-[9px] uppercase font-bold tracking-widest text-text-subtle dark:text-gray-500">Featured</span>
                        </div>
                    </div>

                </div>

                {{-- Kolom Kanan: Info Buku --}}
                <div class="flex flex-col">

                    {{-- Badge --}}
                    @if($book->is_featured)
                    <div class="mb-4 inline-flex items-center gap-2 px-3 py-1 rounded-full bg-blue-50 text-primary text-xs font-bold uppercase tracking-wider dark:bg-blue-900/30 dark:text-blue-300 w-fit">
                        <span class="material-symbols-outlined text-sm">star</span>
                        Featured Publication
                    </div>
                    @endif

                    {{-- Judul --}}
                    <h1 class="text-4xl md:text-5xl lg:text-6xl font-black text-gray-900 dark:text-white leading-tight mb-6">
                        {{ $book->title }}
                    </h1>

                    {{-- Meta: Penulis, Kategori, Tanggal --}}
                    <div class="grid grid-cols-1 sm:grid-cols-3 gap-6 mb-8 py-6 border-y border-gray-100 dark:border-gray-800">
                        <div class="flex items-center gap-3">
                            <span class="material-symbols-outlined text-primary">person</span>
                            <div>
                                <p class="text-[10px] uppercase font-bold text-text-subtle dark:text-gray-500">Author</p>
                                <p class="text-sm font-bold text-gray-900 dark:text-white">{{ $book->author ?? '-' }}</p>
                            </div>
                        </div>
                        <div class="flex items-center gap-3">
                            <span class="material-symbols-outlined text-primary">category</span>
                            <div>
                                <p class="text-[10px] uppercase font-bold text-text-subtle dark:text-gray-500">Category</p>
                                <p class="text-sm font-bold text-gray-900 dark:text-white">{{ $book->category ?? '-' }}</p>
                            </div>
                        </div>
                        <div class="flex items-center gap-3">
                            <span class="material-symbols-outlined text-primary">calendar_today</span>
                            <div>
                                <p class="text-[10px] uppercase font-bold text-text-subtle dark:text-gray-500">Published</p>
                                <p class="text-sm font-bold text-gray-900 dark:text-white">
                                    {{ $book->year ?? $book->created_at->format('Y') }}
                                </p>
                            </div>
                        </div>
                    </div>

                    {{-- Deskripsi --}}
                    <div class="prose prose-blue dark:prose-invert max-w-none mb-10">
                        <p class="text-lg text-text-subtle dark:text-gray-400 leading-relaxed">
                            {{ $book->description }}
                        </p>
                    </div>

                    {{-- Tombol Aksi --}}
                    <div class="flex flex-col sm:flex-row items-center gap-4 pt-4">
                        <a
                            href="{{ route('catalog.index') }}"
                            class="w-full sm:w-auto px-10 h-14 bg-primary hover:bg-blue-600 text-white font-bold rounded-full transition-all shadow-lg shadow-primary/20 hover:shadow-primary/40 flex items-center justify-center gap-2 active:scale-95"
                        >
                            <span class="material-symbols-outlined">collections_bookmark</span>
                            Browse All Books
                        </a>
                        <a
                            href="{{ url()->previous() }}"
                            class="w-full sm:w-auto px-10 h-14 bg-white dark:bg-gray-800 border border-gray-200 dark:border-gray-700 text-text-main dark:text-white font-bold rounded-full hover:bg-gray-50 dark:hover:bg-gray-700 transition-all flex items-center justify-center gap-2 group active:scale-95"
                        >
                            <span class="material-symbols-outlined transition-transform group-hover:-translate-x-1">arrow_back</span>
                            Back
                        </a>
                    </div>

                </div>
            </div>
        </div>

        {{-- ===== BUKU LAINNYA ===== --}}
        @if(isset($relatedBooks) && $relatedBooks->count())
        <div class="w-full py-12">

            {{-- Judul Seksi --}}
            <div class="flex flex-col items-center text-center mb-16 max-w-3xl mx-auto px-4">
                <h2 class="text-4xl md:text-5xl font-black text-gray-900 dark:text-white mb-6">More from Jarreva Creative</h2>
                <div class="h-1.5 w-24 bg-gradient-to-r from-primary to-secondary rounded-full mb-8"></div>
                <p class="text-lg text-text-subtle dark:text-gray-400 font-medium leading-relaxed">
                    Explore our other publications, crafted with passion and precision to elevate your creative potential.
                </p>
            </div>

            {{-- Grid Buku Terkait --}}
            <div class="grid grid-cols-1 md:grid-cols-2 xl:grid-cols-4 gap-8">
                @foreach ($relatedBooks as $related)
                <a
                    href="{{ route('book.show', $related->slug) }}"
                    class="group relative flex flex-col p-8 bg-white dark:bg-gray-800 rounded-[2.5rem] border border-gray-100 dark:border-gray-700 hover:shadow-2xl hover:shadow-gray-200/50 dark:hover:shadow-none transition-all duration-300"
                >
                    <div class="w-full h-[280px] flex items-center justify-center mb-8">
                        <div class="relative w-full h-full flex justify-center items-center transition-transform duration-500 group-hover:-translate-y-2">
                            @if($related->cover_image)
                                <img
                                    src="{{ asset('storage/' . $related->cover_image) }}"
                                    alt="{{ $related->title }}"
                                    class="h-full w-auto object-cover rounded-md shadow-xl"
                                />
                            @else
                                <div class="h-full w-48 flex flex-col items-center justify-center bg-gradient-to-br from-gray-100 to-gray-300 dark:from-gray-700 dark:to-gray-900 rounded-md shadow-xl">
                                    <span class="material-symbols-outlined text-5xl text-gray-400 dark:text-gray-500 mb-2">auto_stories</span>
                                    <span class="text-[10px] font-bold text-gray-400 uppercase tracking-widest">No Cover</span>
                                </div>
                            @endif
                        </div>
                    </div>
                    <div class="flex flex-col">
                        <h3 class="text-xl font-bold text-gray-900 dark:text-white mb-3 tracking-tight">
                            {{ $related->title }}
                        </h3>
                        <p class="text-sm text-text-subtle dark:text-gray-400 leading-relaxed line-clamp-2">
                            {{ $related->description }}
                        </p>
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