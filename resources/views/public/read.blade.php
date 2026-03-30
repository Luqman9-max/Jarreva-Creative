@extends('public.layouts.app')

@section('title', 'Reading - ' . $book->title)

@section('content')
<style>
    /* Dedicated reader styles */
    .reader-content {
        transition: font-size 0.3s ease, line-height 0.3s ease;
    }
    .reader-content.font-sm { font-size: 1rem; line-height: 1.6; }
    .reader-content.font-md { font-size: 1.125rem; line-height: 1.75; }
    .reader-content.font-lg { font-size: 1.25rem; line-height: 1.85; }
    
    /* Override global navbar specifically for the reader to prevent overlaps */
    nav.fixed.top-0 {
        display: none !important;
    }
</style>

{{-- Sticky Header --}}
<div class="fixed top-0 left-0 w-full z-50 bg-white/90 dark:bg-slate-900/90 backdrop-blur-md border-b border-slate-200 dark:border-slate-800 transition-all duration-300 transform translate-y-0" id="reader-header">
    <div class="max-w-4xl mx-auto px-4 sm:px-6 h-16 flex items-center justify-between">
        
        <div class="flex items-center gap-3 md:gap-4 truncate">
            <a href="{{ route('book.show', $book->slug) }}" class="text-slate-500 hover:text-primary transition-colors flex-shrink-0" title="Back to Details">
                <span class="material-symbols-outlined">arrow_back</span>
            </a>
            <div class="h-6 w-px bg-slate-200 dark:bg-slate-700"></div>
            <h1 class="text-sm md:text-base font-bold text-slate-900 dark:text-white truncate font-display">{{ $book->title }}</h1>
        </div>

        <div class="flex items-center gap-4 flex-shrink-0">
            {{-- Progress indicator --}}
            <span class="text-xs font-bold text-slate-500 dark:text-slate-400 font-mono tracking-widest hidden sm:inline-block" id="read-progress-text">0%</span>
            
            {{-- Settings Dropdown Trigger --}}
            <button onclick="toggleSettings()" class="w-8 h-8 rounded-full bg-slate-100 dark:bg-slate-800 flex items-center justify-center text-slate-600 dark:text-slate-300 hover:bg-slate-200 dark:hover:bg-slate-700 transition" title="Reading Settings">
                <span class="material-symbols-outlined text-[18px]">format_size</span>
            </button>
        </div>
    </div>
    {{-- Progress bar --}}
    <div class="h-1 bg-slate-100 dark:bg-slate-800 w-full">
        <div class="h-full bg-primary transition-all duration-300 w-0" id="read-progress-bar"></div>
    </div>
    
    {{-- Reader Settings Menu --}}
    <div id="reader-settings" class="absolute top-16 right-4 sm:right-auto sm:left-1/2 sm:-translate-x-1/2 mt-2 w-64 bg-white dark:bg-slate-800 rounded-2xl shadow-xl border border-slate-100 dark:border-slate-700 p-5 transform origin-top transition-all duration-200 scale-95 opacity-0 pointer-events-none z-50">
        <div class="mb-4">
            <span class="block text-xs font-bold uppercase tracking-widest text-slate-400 mb-3 text-center sm:text-left">Font Size</span>
            <div class="flex bg-slate-100 dark:bg-slate-900 rounded-lg p-1">
                <button onclick="setFontSize('sm')" id="btn-font-sm" class="flex-1 py-1.5 rounded-md text-sm font-medium transition-colors text-slate-500 hover:text-slate-900 dark:text-slate-400 dark:hover:text-white">A-</button>
                <button onclick="setFontSize('md')" id="btn-font-md" class="flex-1 py-1.5 rounded-md text-sm font-medium transition-colors bg-white dark:bg-slate-700 text-primary shadow-sm">A</button>
                <button onclick="setFontSize('lg')" id="btn-font-lg" class="flex-1 py-1.5 rounded-md text-sm font-medium transition-colors text-slate-500 hover:text-slate-900 dark:text-slate-400 dark:hover:text-white">A+</button>
            </div>
        </div>
        <div class="text-[10px] text-slate-500 text-center font-medium opacity-80 mt-2">
            The appearance matching system follows your device settings (Light/Dark).
        </div>
    </div>
</div>

<div class="reader-container min-h-screen bg-slate-50 dark:bg-background-dark pt-24 pb-32">
    <article class="max-w-2xl mx-auto px-6 sm:px-8 bg-white dark:bg-slate-900 rounded-3xl shadow-sm border border-slate-100 dark:border-slate-800 p-8 sm:p-12 mb-10">
        {{-- Cover / Header Content --}}
        <header class="mb-12 text-center md:text-left border-b border-slate-100 dark:border-slate-800 pb-8">
            <span class="text-[10px] uppercase font-bold tracking-widest text-primary mb-3 block">Chapter 1</span>
            <h2 class="text-3xl md:text-5xl font-black text-slate-900 dark:text-white mb-6 leading-tight font-display">The Beginning of Everything</h2>
            
            <div class="flex items-center justify-center md:justify-start gap-4">
                <div class="w-12 h-12 rounded-full border-2 border-slate-100 dark:border-slate-700 flex items-center justify-center text-slate-500 bg-slate-50 dark:bg-slate-800">
                    <span class="material-symbols-outlined text-[20px]">person</span>
                </div>
                <div class="text-left">
                    <p class="text-sm font-bold text-slate-800 dark:text-slate-200">{{ $book->author ?? 'Jarreva Creative' }}</p>
                    <p class="text-[11px] font-medium text-slate-500 mt-0.5">Estimated 10 mins read</p>
                </div>
            </div>
        </header>

        {{-- Reader Content --}}
        <div class="reader-content font-md text-slate-700 dark:text-slate-300 space-y-7" id="reader-text">
            {{-- Dropcap paragraph --}}
            <p class="first-letter:text-6xl first-letter:font-black first-letter:text-primary first-letter:float-left first-letter:mr-4 first-letter:mt-1 font-serif text-justify">
                {{ $book->description ?? 'Lorem ipsum dolor sit amet...' }} 
                Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium, totam rem aperiam, eaque ipsa quae ab illo inventore veritatis et quasi architecto beatae vitae dicta sunt explicabo. Nemo enim ipsam voluptatem.
            </p>
            
            <p class="font-serif text-justify">
                Ut enim ad minima veniam, quis nostrum exercitationem ullam corporis suscipit laboriosam, nisi ut aliquid ex ea commodi consequatur? Quis autem vel eum iure reprehenderit qui in ea voluptate velit esse quam nihil molestiae consequatur, vel illum qui dolorem eum fugiat quo voluptas nulla pariatur.
            </p>

            <blockquote class="border-l-4 border-primary pl-6 py-2 my-10 italic font-serif text-xl sm:text-2xl text-slate-900 dark:text-white leading-relaxed">
                "Reading is to the mind what exercise is to the body. It expands the boundaries of possibility and fuels the imagination."
            </blockquote>

            <p class="font-serif text-justify">
                At vero eos et accusamus et iusto odio dignissimos ducimus qui blanditiis praesentium voluptatum deleniti atque corrupti quos dolores et quas molestias excepturi sint occaecati cupiditate non provident, similique sunt in culpa qui officia deserunt mollitia animi, id est laborum et dolorum fuga. Et harum quidem rerum facilis est et expedita distinctio.
            </p>

            <h3 class="text-2xl font-black text-slate-900 dark:text-white mt-14 mb-5 font-display">The Path Forward</h3>

            <p class="font-serif text-justify">
                Nam libero tempore, cum soluta nobis est eligendi optio cumque nihil impedit quo minus id quod maxime placeat facere possimus, omnis voluptas assumenda est, omnis dolor repellendus. Temporibus autem quibusdam et aut officiis debitis aut rerum necessitatibus saepe eveniet ut et voluptates repudiandae sint et molestiae non recusandae.
            </p>
            
            {{-- Generate extra dummy content for scrolling --}}
            @for ($i = 0; $i < 6; $i++)
            <p class="font-serif text-justify">
                Itaque earum rerum hic tenetur a sapiente delectus, ut aut reiciendis voluptatibus maiores alias consequatur aut perferendis doloribus asperiores repellat. Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.
            </p>
            @endfor
        </div>
        
        <div class="mt-16 text-center">
            <span class="inline-block w-2 h-2 rounded-full bg-slate-300 dark:bg-slate-700 mx-1"></span>
            <span class="inline-block w-2 h-2 rounded-full bg-slate-300 dark:bg-slate-700 mx-1"></span>
            <span class="inline-block w-2 h-2 rounded-full bg-slate-300 dark:bg-slate-700 mx-1"></span>
        </div>
    </article>

    {{-- Reading Navigation --}}
    <div class="max-w-3xl mx-auto px-6 mt-16 flex flex-col sm:flex-row items-center justify-between gap-4">
        <button class="w-full sm:w-auto px-8 py-4 rounded-2xl border-2 border-slate-200 dark:border-slate-800 bg-transparent text-slate-500 dark:text-slate-400 font-bold hover:text-primary hover:border-primary transition-all flex items-center justify-center gap-3 group outline-none">
            <span class="material-symbols-outlined transition-transform group-hover:-translate-x-1">arrow_back</span>
            Previous Chapter
        </button>
        <button class="w-full sm:w-auto px-8 py-4 rounded-2xl bg-primary text-white font-bold hover:bg-orange-600 transition-all shadow-[0_10px_20px_-10px_rgba(249,115,22,0.8)] hover:shadow-[0_15px_30px_-10px_rgba(249,115,22,1)] hover:-translate-y-1 flex items-center justify-center gap-3 group outline-none">
            Next Chapter
            <span class="material-symbols-outlined transition-transform group-hover:translate-x-1">arrow_forward</span>
        </button>
    </div>
</div>

<script>
    // Constants
    const STORAGE_KEY = 'jarreva_reader_pos_' + '{{ $book->slug }}';
    const SETTINGS_KEY = 'jarreva_reader_font';
    
    // DOM Elements
    const progressBar = document.getElementById('read-progress-bar');
    const progressText = document.getElementById('read-progress-text');
    const header = document.getElementById('reader-header');
    const settingsMenu = document.getElementById('reader-settings');
    const readerContent = document.getElementById('reader-text');
    
    // State
    let isSettingsOpen = false;
    let lastScrollY = window.scrollY;
    
    // --- Scroll & Progress logic ---
    function updateProgress() {
        const scrollTop = window.scrollY;
        // Subtract innerHeight precisely, adding a tolerance
        const docHeight = Math.max(1, document.body.offsetHeight - window.innerHeight - 50);
        const scrollPercent = scrollTop / docHeight;
        
        // Update UI
        const percentVal = Math.max(0, Math.min(100, Math.floor(scrollPercent * 100)));
        progressBar.style.width = percentVal + '%';
        progressText.textContent = percentVal + '%';
        
        // Hide/Show Header based on scroll direction (only if scrolled past 150px)
        if (scrollTop > 150) {
            if (scrollTop > lastScrollY && !isSettingsOpen) {
                // Scrolling down -> hide header
                header.classList.add('-translate-y-full');
            } else {
                // Scrolling up -> show header
                header.classList.remove('-translate-y-full');
            }
        } else {
            header.classList.remove('-translate-y-full');
        }
        lastScrollY = scrollTop;
        
        // Save Position
        clearTimeout(window.saveTimeout);
        window.saveTimeout = setTimeout(() => {
            localStorage.setItem(STORAGE_KEY, scrollTop.toString());
        }, 300);
    }
    
    // --- Settings UI ---
    function toggleSettings() {
        isSettingsOpen = !isSettingsOpen;
        if (isSettingsOpen) {
            settingsMenu.classList.remove('scale-95', 'opacity-0', 'pointer-events-none');
            settingsMenu.classList.add('scale-100', 'opacity-100');
            header.classList.remove('-translate-y-full');
        } else {
            settingsMenu.classList.remove('scale-100', 'opacity-100');
            settingsMenu.classList.add('scale-95', 'opacity-0', 'pointer-events-none');
        }
    }
    
    // Close settings when clicking outside
    document.addEventListener('click', (e) => {
        if (isSettingsOpen && !e.target.closest('#reader-settings') && !e.target.closest('button[onclick="toggleSettings()"]')) {
            toggleSettings();
        }
    });

    // --- Font Size Logic ---
    function setFontSize(size) {
        // Reset styles and button classes
        readerContent.classList.remove('font-sm', 'font-md', 'font-lg');
        
        const baseClass = 'flex-1 py-1.5 rounded-md text-sm font-medium transition-colors ';
        const inactiveClass = baseClass + 'text-slate-500 hover:text-slate-900 dark:text-slate-400 dark:hover:text-white';
        const activeClass = baseClass + 'bg-white dark:bg-slate-700 text-primary shadow-sm';
        
        document.getElementById('btn-font-sm').className = inactiveClass;
        document.getElementById('btn-font-md').className = inactiveClass;
        document.getElementById('btn-font-lg').className = inactiveClass;
        
        // Apply new classes
        readerContent.classList.add('font-' + size);
        document.getElementById('btn-font-' + size).className = activeClass;
        
        localStorage.setItem(SETTINGS_KEY, size);
        
        // Re-measure progression as height changes
        setTimeout(updateProgress, 350); 
    }
    
    // --- Lifecycle ---
    document.addEventListener('DOMContentLoaded', () => {
        // Load font settings
        const savedFont = localStorage.getItem(SETTINGS_KEY) || 'md';
        setFontSize(savedFont);
        
        // Restore reading position smoothly
        const savedScroll = localStorage.getItem(STORAGE_KEY);
        if (savedScroll && parseInt(savedScroll) > 0) {
            // slight delay avoids jarring jump on layout jitter
            setTimeout(() => {
                window.scrollTo({
                    top: parseInt(savedScroll),
                    behavior: 'smooth'
                });
            }, 500);
        }
        
        window.addEventListener('scroll', updateProgress);
        updateProgress();
    });
</script>
@endsection
