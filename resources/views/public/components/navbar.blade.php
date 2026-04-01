{{-- Navbar component --}}
<header id="main-header" class="fixed top-0 left-0 right-0 z-[100] transition-all duration-300 py-4 px-4 sm:px-6">
    <div
        class="w-full max-w-7xl mx-auto rounded-xl bg-white/80 backdrop-blur-xl border border-white/40 shadow-sm dark:bg-gray-900/80 dark:border-gray-700/50 transition-all duration-500 hover:shadow-md hover:border-secondary/20 relative overflow-hidden group">

        <!-- Scroll Progress Bar -->
        <div id="scroll-progress"
            class="absolute bottom-0 left-0 h-[2px] bg-gradient-to-r from-primary via-secondary to-primary w-0 transition-all duration-100 ease-out opacity-80">
        </div>

        <div class="flex h-16 items-center justify-between px-4 md:px-6">
            <!-- Dynamic Logo -->
            <div class="flex items-center gap-3 group/logo cursor-pointer"
                onclick="window.location.href='{{ route('home') }}'">
                <div
                    class="relative flex h-9 w-9 items-center justify-center rounded-lg overflow-hidden transition-transform duration-500 group-hover/logo:rotate-20">
                    <img src="{{ asset('logo.png') }}" alt="Jarreva Creative Logo" class="h-full w-full object-contain">
                </div>
                <div class="flex flex-col">
                    <span
                        class="text-sm font-bold tracking-tight text-gray-900 dark:text-white leading-none transition-colors duration-300 group-hover/logo:text-blue-500">Jarreva
                        Creative</span>
                    <div class="flex items-center gap-1.5 mt-0.5">
                        <span class="relative flex h-1.5 w-1.5">
                            <span
                                class="animate-ping absolute inline-flex h-full w-full rounded-full bg-green-400 opacity-75"></span>
                            <span class="relative inline-flex rounded-full h-1.5 w-1.5 bg-green-500"></span>
                        </span>
                        <span class="text-[9px] font-mono text-slate-400 uppercase tracking-wider">System
                            Online</span>
                    </div>
                </div>
            </div>

            <!-- Tech Nav -->
            <nav class="hidden md:flex items-center gap-1">
                <a class="relative px-4 py-2 text-sm {{ request()->routeIs('home') ? 'text-slate-900 font-bold dark:text-white' : 'text-slate-600 font-normal dark:text-slate-400 hover:text-slate-900 dark:hover:text-white' }} transition-colors group/nav"
                    href="{{ route('home') }}">
                    <span class="relative z-10">Home</span>
                    <span
                        class="absolute left-0 top-1/2 -translate-y-1/2 text-primary {{ request()->routeIs('home') ? 'opacity-100 -translate-x-1' : 'opacity-0 -translate-x-2 group-hover/nav:translate-x-1 group-hover/nav:opacity-100' }} transition-all duration-300 text-xs font-mono ml-1">[</span>
                    <span
                        class="absolute right-0 top-1/2 -translate-y-1/2 text-primary {{ request()->routeIs('home') ? 'opacity-100 translate-x-1' : 'opacity-0 translate-x-2 group-hover/nav:-translate-x-1 group-hover/nav:opacity-100' }} transition-all duration-300 text-xs font-mono mr-1">]</span>
                </a>
                <a class="relative px-4 py-2 text-sm {{ request()->routeIs('about') ? 'text-slate-900 font-bold dark:text-white' : 'text-slate-600 font-normal dark:text-slate-400 hover:text-slate-900 dark:hover:text-white' }} transition-colors group/nav"
                    href="{{ route('about') }}">
                    <span class="relative z-10">About</span>
                    <span
                        class="absolute left-0 top-1/2 -translate-y-1/2 text-primary {{ request()->routeIs('about') ? 'opacity-100 -translate-x-1' : 'opacity-0 -translate-x-2 group-hover/nav:translate-x-1 group-hover/nav:opacity-100' }} transition-all duration-300 text-xs font-mono ml-1">[</span>
                    <span
                        class="absolute right-0 top-1/2 -translate-y-1/2 text-primary {{ request()->routeIs('about') ? 'opacity-100 translate-x-1' : 'opacity-0 translate-x-2 group-hover/nav:-translate-x-1 group-hover/nav:opacity-100' }} transition-all duration-300 text-xs font-mono mr-1">]</span>
                </a>
                <a class="relative px-4 py-2 text-sm {{ request()->routeIs('contact') ? 'text-slate-900 font-bold dark:text-white' : 'text-slate-600 font-normal dark:text-slate-400 hover:text-slate-900 dark:hover:text-white' }} transition-colors group/nav"
                    href="{{ route('contact') }}">
                    <span class="relative z-10">Contact</span>
                    <span
                        class="absolute left-0 top-1/2 -translate-y-1/2 text-primary {{ request()->routeIs('contact') ? 'opacity-100 -translate-x-1' : 'opacity-0 -translate-x-2 group-hover/nav:translate-x-1 group-hover/nav:opacity-100' }} transition-all duration-300 text-xs font-mono ml-1">[</span>
                    <span
                        class="absolute right-0 top-1/2 -translate-y-1/2 text-primary {{ request()->routeIs('contact') ? 'opacity-100 translate-x-1' : 'opacity-0 translate-x-2 group-hover/nav:-translate-x-1 group-hover/nav:opacity-100' }} transition-all duration-300 text-xs font-mono mr-1">]</span>
                </a>
            </nav>

            <!-- Actions -->
            <div class="flex items-center gap-4">
                <a href="{{ route('catalog.index') }}"
                    class="hidden md:inline-flex items-center justify-center rounded-lg bg-slate-900 px-4 py-1.5 text-sm font-bold text-white transition-all hover:bg-secondary hover:shadow-[0_0_15px_rgba(249,115,22,0.4)] hover:-translate-y-0.5 active:scale-95 group/btn overflow-hidden relative">
                    <span class="relative z-10 flex items-center gap-1.5">
                        Catalog
                        <span
                            class="material-symbols-outlined text-[12px] transition-transform group-hover/btn:rotate-10">trending_up</span>
                    </span>
                    <div
                        class="absolute inset-0 bg-gradient-to-r from-secondary to-primary opacity-0 group-hover/btn:opacity-100 transition-opacity duration-300">
                    </div>
                </a>
                <button id="mobile-menu-toggle" class="md:hidden p-2 text-slate-700 dark:text-slate-300 hover:bg-slate-100 dark:hover:bg-gray-800 rounded-lg transition-colors focus:outline-none focus:ring-2 focus:ring-primary/50 group">
                    <span id="mobile-menu-icon" class="material-symbols-outlined text-2xl transition-transform duration-300 group-active:scale-95">menu</span>
                </button>
            </div>
        </div>
    </div>
    
    <!-- Mobile Menu (Pop-up) -->
    <div id="mobile-menu" class="md:hidden absolute top-[calc(100%+0.5rem)] left-4 right-4 sm:left-6 sm:right-6 origin-top overflow-hidden transition-all duration-300 ease-in-out scale-y-0 opacity-0 bg-white/95 backdrop-blur-xl dark:bg-gray-900/95 rounded-xl border border-gray-100 dark:border-gray-800 shadow-xl z-50 pointer-events-none">
        <nav class="flex flex-col px-4 py-4 space-y-2">
            <a class="px-4 py-2.5 rounded-lg text-sm {{ request()->routeIs('home') ? 'bg-primary/10 text-primary font-bold' : 'text-slate-600 font-medium dark:text-slate-400 hover:bg-white dark:hover:bg-gray-800 hover:text-slate-900 dark:hover:text-white hover:shadow-sm' }} transition-all"
                href="{{ route('home') }}">
                Home
            </a>
            <a class="px-4 py-2.5 rounded-lg text-sm {{ request()->routeIs('about') ? 'bg-primary/10 text-primary font-bold' : 'text-slate-600 font-medium dark:text-slate-400 hover:bg-white dark:hover:bg-gray-800 hover:text-slate-900 dark:hover:text-white hover:shadow-sm' }} transition-all"
                href="{{ route('about') }}">
                About
            </a>
            <a class="px-4 py-2.5 rounded-lg text-sm {{ request()->routeIs('catalog.index') ? 'bg-primary/10 text-primary font-bold' : 'text-slate-600 font-medium dark:text-slate-400 hover:bg-white dark:hover:bg-gray-800 hover:text-slate-900 dark:hover:text-white hover:shadow-sm' }} transition-all"
                href="{{ route('catalog.index') }}">
                Portfolio
            </a>
            <a class="px-4 py-2.5 rounded-lg text-sm {{ request()->routeIs('contact') ? 'bg-primary/10 text-primary font-bold' : 'text-slate-600 font-medium dark:text-slate-400 hover:bg-white dark:hover:bg-gray-800 hover:text-slate-900 dark:hover:text-white hover:shadow-sm' }} transition-all"
                href="{{ route('contact') }}">
                Contact
            </a>
            
            <div class="pt-3 mt-1 border-t border-gray-200/50 dark:border-gray-700/50">
                <a href="{{ route('catalog.index') }}"
                    class="flex w-full items-center justify-center gap-2 rounded-lg bg-slate-900 dark:bg-slate-800 px-4 py-2.5 text-sm font-bold text-white transition-all hover:bg-secondary hover:shadow-[0_0_15px_rgba(249,115,22,0.4)] hover:-translate-y-0.5 active:scale-95 group relative overflow-hidden">
                    <span class="relative z-10 flex items-center gap-1.5">
                        Catalog
                        <span class="material-symbols-outlined text-[16px] transition-transform group-hover:rotate-10">trending_up</span>
                    </span>
                    <div class="absolute inset-0 bg-gradient-to-r from-secondary to-primary opacity-0 group-hover:opacity-100 transition-opacity duration-300"></div>
                </a>
            </div>
        </nav>
    </div>
</header>

@push ('scripts')
<script>
    // Header Scroll Progress Logic
    window.addEventListener('scroll', () => {
        const header = document.getElementById('main-header');
        const progressBar = document.getElementById('scroll-progress');

        // Progress Calculation
        const winScroll = document.body.scrollTop || document.documentElement.scrollTop;
        const height = document.documentElement.scrollHeight - document.documentElement.clientHeight;
        const scrolled = (winScroll / height) * 100;

        if (progressBar) {
            progressBar.style.width = scrolled + "%";
        }

        // Compact Header on Scroll
        if (window.scrollY > 50) {
            header.classList.remove('py-4');
            header.classList.add('py-2');
        } else {
            header.classList.add('py-4');
            header.classList.remove('py-2');
        }
    });

    // Mobile Menu Toggle Logic
    const mobileMenuToggle = document.getElementById('mobile-menu-toggle');
    const mobileMenu = document.getElementById('mobile-menu');
    const mobileMenuIcon = document.getElementById('mobile-menu-icon');
    let isMenuOpen = false;

    if (mobileMenuToggle && mobileMenu && mobileMenuIcon) {
        mobileMenuToggle.addEventListener('click', () => {
            isMenuOpen = !isMenuOpen;
            if (isMenuOpen) {
                // Open menu
                mobileMenu.classList.remove('scale-y-0', 'opacity-0', 'pointer-events-none');
                mobileMenu.classList.add('scale-y-100', 'opacity-100');
                mobileMenuIcon.innerText = 'close';
                mobileMenuIcon.classList.add('rotate-90');
            } else {
                // Close menu
                mobileMenu.classList.add('scale-y-0', 'opacity-0', 'pointer-events-none');
                mobileMenu.classList.remove('scale-y-100', 'opacity-100');
                mobileMenuIcon.innerText = 'menu';
                mobileMenuIcon.classList.remove('rotate-90');
            }
        });
    }
</script>
@endpush