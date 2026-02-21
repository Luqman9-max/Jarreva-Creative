{{-- Footer component --}}
<footer
    class="relative bg-white dark:bg-background-dark border-t border-slate-200 dark:border-slate-800 pt-24 pb-12 overflow-hidden"
    id="contact">
    <!-- Background Elements -->
    <div
        class="absolute inset-0 z-0 bg-[linear-gradient(to_right,#80808008_1px,transparent_1px),linear-gradient(to_bottom,#80808008_1px,transparent_1px)] bg-[size:24px_24px] pointer-events-none">
    </div>
    <div
        class="absolute bottom-0 left-0 w-full h-px bg-gradient-to-r from-transparent via-slate-300 dark:via-slate-700 to-transparent opacity-50">
    </div>

    <div class="container mx-auto px-6 relative z-10">
        <div class="grid grid-cols-1 lg:grid-cols-12 gap-12 mb-20">

            <!-- Brand Module -->
            <div class="lg:col-span-5 flex flex-col items-start">
                <div class="flex items-center gap-3 mb-6 group cursor-pointer"
                    onclick="window.location.href='{{ route('home') }}'">
                    <div
                        class="flex h-10 w-10 items-center justify-center rounded-lg overflow-hidden transition-transform duration-500 group-hover:rotate-20">
                        <img src="{{ asset('logo.png') }}" alt="Jarreva Creative Logo" class="h-full w-full object-contain">
                    </div>
                    <span
                        class="text-xl font-bold tracking-tight text-gray-900 dark:text-white leading-none transition-colors duration-300 group-hover:text-blue-500">Jarreva
                        Creative</span>
                </div>
                <p class="text-slate-500 text-lg leading-relaxed mb-8 max-w-md">
                    Architecting clarity from chaos. We build digital systems that structure thought and amplify
                    intelligence.
                </p>
                <div
                    class="flex items-center gap-2 text-xs font-mono text-slate-400 border border-slate-200 dark:border-slate-700 rounded-full px-3 py-1">
                    <span class="relative flex h-2 w-2">
                        <span
                            class="animate-ping absolute inline-flex h-full w-full rounded-full bg-slate-400 opacity-75"></span>
                        <span class="relative inline-flex rounded-full h-2 w-2 bg-slate-500"></span>
                    </span>
                    SYSTEM VERSION 2.0.4
                </div>
            </div>

            <!-- Navigation Matrix -->
            <div class="lg:col-span-2 lg:col-start-7">
                <h4 class="font-mono text-xs font-bold text-slate-400 uppercase tracking-widest mb-6">
                    Coordinates</h4>
                <ul class="space-y-4">
                    <li><a href="{{ route('home') }}"
                            class="group flex items-center gap-2 {{ request()->routeIs('home') ? 'text-blue-500 font-bold' : 'text-slate-600 dark:text-slate-400 hover:text-blue-400' }} transition-colors"><span
                                class="{{ request()->routeIs('home') ? 'text-blue-500' : 'text-slate-300 dark:text-slate-600 group-hover:text-blue-400' }} transition-colors">/</span>
                            Home</a></li>
                    <li><a href="{{ route('about') }}"
                            class="group flex items-center gap-2 {{ request()->routeIs('about') ? 'text-blue-500 font-bold' : 'text-slate-600 dark:text-slate-400 hover:text-blue-400' }} transition-colors"><span
                                class="{{ request()->routeIs('about') ? 'text-blue-500' : 'text-slate-300 dark:text-slate-600 group-hover:text-blue-400' }} transition-colors">/</span>
                            About</a></li>
                    <li><a href="{{ route('catalog.index') }}"
                            class="group flex items-center gap-2 {{ request()->routeIs('catalog.index') ? 'text-blue-500 font-bold' : 'text-slate-600 dark:text-slate-400 hover:text-blue-400' }} transition-colors"><span
                                class="{{ request()->routeIs('catalog.index') ? 'text-blue-500' : 'text-slate-300 dark:text-slate-600 group-hover:text-blue-400' }} transition-colors">/</span>
                            Portfolio</a></li>
                    <li><a href="{{ route('contact') }}"
                            class="group flex items-center gap-2 {{ request()->routeIs('contact') ? 'text-blue-500 font-bold' : 'text-slate-600 dark:text-slate-400 hover:text-blue-400' }} transition-colors"><span
                                class="{{ request()->routeIs('contact') ? 'text-blue-500' : 'text-slate-300 dark:text-slate-600 group-hover:text-blue-400' }} transition-colors">/</span>
                            Contact</a></li>
                </ul>
            </div>

            <!-- Social Frequencies -->
            <div class="lg:col-span-2">
                <h4 class="font-mono text-xs font-bold text-slate-400 uppercase tracking-widest mb-6">
                    Frequencies</h4>
                <ul class="space-y-4">
                    <li><a href="#"
                            class="group flex items-center gap-2 text-slate-600 dark:text-slate-400 hover:text-orange-400 transition-colors"><span
                                class="text-slate-300 dark:text-slate-600 group-hover:text-orange-400 transition-colors">></span>
                            Instagram</a></li>
                    <li><a href="#"
                            class="group flex items-center gap-2 text-slate-600 dark:text-slate-400 hover:text-orange-400 transition-colors"><span
                                class="text-slate-300 dark:text-slate-600 group-hover:text-orange-400 transition-colors">></span>
                            Twitter / X</a></li>
                    <li><a href="#"
                            class="group flex items-center gap-2 text-slate-600 dark:text-slate-400 hover:text-orange-400 transition-colors"><span
                                class="text-slate-300 dark:text-slate-600 group-hover:text-orange-400 transition-colors">></span>
                            TikTok</a></li>
                    <li><a href="#"
                            class="group flex items-center gap-2 text-slate-600 dark:text-slate-400 hover:text-orange-400 transition-colors"><span
                                class="text-slate-300 dark:text-slate-600 group-hover:text-orange-400 transition-colors">></span>
                            Medium</a></li>
                </ul>
            </div>

            <!-- Newsletter / Uplink -->
            <div class="lg:col-span-3">
                <h4 class="font-mono text-xs font-bold text-slate-400 uppercase tracking-widest mb-6">Neural
                    Uplink</h4>
                <p class="text-sm text-slate-500 mb-4">Subscribe for system updates and intellectual design
                    patterns.</p>
                <form class="relative group">
                    <input type="email" placeholder="Enter signal frequency..."
                        class="w-full bg-white dark:bg-slate-800 border border-slate-200 dark:border-slate-700 rounded-lg py-3 px-4 text-sm outline-none focus:border-primary focus:ring-1 focus:ring-primary transition-all font-mono placeholder:text-slate-400 dark:text-white">
                    <button type="button"
                        class="absolute right-2 top-2 bottom-2 bg-slate-900 text-white rounded px-3 text-xs font-bold uppercase hover:bg-primary transition-colors">
                        Init
                    </button>
                </form>
            </div>
        </div>

        <!-- Footer Status Bar -->
        <div
            class="border-t border-slate-200 dark:border-slate-800 pt-8 flex flex-col md:flex-row justify-between items-center gap-4">
            <p class="text-sm text-slate-500 font-medium">© {{ date('Y') }} Jarreva Creative. All systems operational.</p>

            <div class="flex items-center gap-8">
                <a href="#"
                    class="text-xs font-mono text-slate-400 hover:text-slate-600 dark:hover:text-slate-300 transition-colors uppercase">Privacy
                    Protocol</a>
                <a href="#"
                    class="text-xs font-mono text-slate-400 hover:text-slate-600 dark:hover:text-slate-300 transition-colors uppercase">Terms
                    of Logic</a>
                <div class="flex items-center gap-2">
                    <div class="h-1.5 w-1.5 rounded-full bg-slate-300 dark:bg-slate-600"></div>
                    <span class="text-xs font-mono text-slate-300 dark:text-slate-500 uppercase">End of Line</span>
                </div>
            </div>
        </div>
    </div>
</footer>
