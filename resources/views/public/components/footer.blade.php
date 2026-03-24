{{-- Footer component --}}
<footer class="mobile-footer relative bg-white dark:bg-background-dark pt-24 pb-12 overflow-hidden" id="contact">
    <style>
        @media (max-width: 767px) {
            .mobile-footer { padding-top: 64px !important; padding-bottom: 32px !important; }
            .mobile-footer-logo { width: 32px !important; height: 32px !important; }
            .mobile-footer-brand { font-size: 18px !important; }
            .mobile-footer-desc { font-size: 14px !important; margin-bottom: 24px !important; }
            .mobile-footer-version { font-size: 10px !important; padding: 2px 8px !important; }
            .mobile-footer-heading { font-size: 11px !important; margin-bottom: 12px !important; }
            .mobile-footer-link { font-size: 14px !important; }
            .mobile-footer-uplink-desc { font-size: 13px !important; margin-bottom: 16px !important; }
            .mobile-footer-input { padding: 10px 14px !important; font-size: 13px !important; }
            .mobile-footer-btn { font-size: 10px !important; padding: 4px 12px !important; right: 6px !important; top: 6px !important; bottom: 6px !important; }
            .mobile-footer-copyright { font-size: 11px !important; }
            .mobile-footer-legal { flex-wrap: wrap !important; justify-content: center !important; gap: 12px !important; }
            .mobile-footer-legal a, .mobile-footer-legal span { font-size: 10px !important; }
        }
    </style>
    <!-- Background Elements -->
    @include ('public.components.footer-3d-bg')

    <div
        class="absolute inset-0 z-0 bg-[linear-gradient(to_right,#80808008_1px,transparent_1px),linear-gradient(to_bottom,#80808008_1px,transparent_1px)] bg-[size:24px_24px] pointer-events-none mix-blend-overlay opacity-50 dark:opacity-20">
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
                        class="mobile-footer-logo flex h-10 w-10 items-center justify-center rounded-lg overflow-hidden transition-transform duration-500 group-hover:rotate-20">
                        <img src="{{ asset('logo.png') }}" alt="Jarreva Creative Logo" class="h-full w-full object-contain">
                    </div>
                    <span
                        class="mobile-footer-brand text-xl font-bold tracking-tight text-gray-900 dark:text-white leading-none transition-colors duration-300 group-hover:text-blue-500">Jarreva
                        Creative</span>
                </div>
                <p class="mobile-footer-desc text-slate-500 text-lg leading-relaxed mb-8 max-w-md">
                    Architecting clarity from chaos. We build digital systems that structure thought and amplify
                    intelligence.
                </p>
                <div
                    class="mobile-footer-version flex items-center gap-2 text-xs font-mono text-slate-400 border border-slate-200 dark:border-slate-700 rounded-full px-3 py-1">
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
                <h4 class="mobile-footer-heading font-mono text-xs font-bold text-slate-400 uppercase tracking-widest mb-6">
                    Coordinates</h4>
                <ul class="space-y-4">
                    <li><a href="{{ route('home') }}"
                            class="mobile-footer-link group flex items-center gap-2 {{ request()->routeIs('home') ? 'text-blue-500 font-bold' : 'text-slate-600 dark:text-slate-400 hover:text-blue-400' }} transition-colors"><span
                                class="{{ request()->routeIs('home') ? 'text-blue-500' : 'text-slate-300 dark:text-slate-600 group-hover:text-blue-400' }} transition-colors">/</span>
                            Home</a></li>
                    <li><a href="{{ route('about') }}"
                            class="mobile-footer-link group flex items-center gap-2 {{ request()->routeIs('about') ? 'text-blue-500 font-bold' : 'text-slate-600 dark:text-slate-400 hover:text-blue-400' }} transition-colors"><span
                                class="{{ request()->routeIs('about') ? 'text-blue-500' : 'text-slate-300 dark:text-slate-600 group-hover:text-blue-400' }} transition-colors">/</span>
                            About</a></li>
                    <li><a href="{{ route('catalog.index') }}"
                            class="mobile-footer-link group flex items-center gap-2 {{ request()->routeIs('catalog.index') ? 'text-blue-500 font-bold' : 'text-slate-600 dark:text-slate-400 hover:text-blue-400' }} transition-colors"><span
                                class="{{ request()->routeIs('catalog.index') ? 'text-blue-500' : 'text-slate-300 dark:text-slate-600 group-hover:text-blue-400' }} transition-colors">/</span>
                            Portfolio</a></li>
                    <li><a href="{{ route('contact') }}"
                            class="mobile-footer-link group flex items-center gap-2 {{ request()->routeIs('contact') ? 'text-blue-500 font-bold' : 'text-slate-600 dark:text-slate-400 hover:text-blue-400' }} transition-colors"><span
                                class="{{ request()->routeIs('contact') ? 'text-blue-500' : 'text-slate-300 dark:text-slate-600 group-hover:text-blue-400' }} transition-colors">/</span>
                            Contact</a></li>
                </ul>
            </div>

            <!-- Social Frequencies -->
            <div class="lg:col-span-2">
                <h4 class="mobile-footer-heading font-mono text-xs font-bold text-slate-400 uppercase tracking-widest mb-6">
                    Frequencies</h4>
                <ul class="space-y-4">
                    <li><a href="https://www.instagram.com/jarrevacreative?igsh=bjlwazJlOHBsd2h0&utm_source=qr" target="_blank" rel="noopener noreferrer"
                            class="mobile-footer-link group flex items-center gap-2 text-slate-600 dark:text-slate-400 hover:text-orange-400 transition-colors"><span
                                class="text-slate-300 dark:text-slate-600 group-hover:text-orange-400 transition-colors">></span>
                            Instagram</a></li>
                    <li><a href="https://x.com/jarrevacreative?s=21" target="_blank" rel="noopener noreferrer"
                            class="mobile-footer-link group flex items-center gap-2 text-slate-600 dark:text-slate-400 hover:text-orange-400 transition-colors"><span
                                class="text-slate-300 dark:text-slate-600 group-hover:text-orange-400 transition-colors">></span>
                            Twitter / X</a></li>
                    <li><a href="https://www.tiktok.com/@jarreva_creative?is_from_webapp=1&sender_device=pc" target="_blank" rel="noopener noreferrer"
                            class="mobile-footer-link group flex items-center gap-2 text-slate-600 dark:text-slate-400 hover:text-orange-400 transition-colors"><span
                                class="text-slate-300 dark:text-slate-600 group-hover:text-orange-400 transition-colors">></span>
                            TikTok</a></li>
                    <li><a href="https://medium.com/@jarrevacreative" target="_blank" rel="noopener noreferrer"
                            class="mobile-footer-link group flex items-center gap-2 text-slate-600 dark:text-slate-400 hover:text-orange-400 transition-colors"><span
                                class="text-slate-300 dark:text-slate-600 group-hover:text-orange-400 transition-colors">></span>
                            Medium</a></li>
                </ul>
            </div>

            <!-- Newsletter / Uplink -->
            <div class="lg:col-span-3">
                <h4 class="mobile-footer-heading font-mono text-xs font-bold text-slate-400 uppercase tracking-widest mb-6">Neural
                    Uplink</h4>
                <p class="mobile-footer-uplink-desc text-sm text-slate-500 mb-4">Subscribe for system updates and intellectual design
                    patterns.</p>
                <form id="footer-newsletter-form" class="relative group" onsubmit="submitNewsletter(event)">
                    @csrf
                    <input type="email" id="footer-newsletter-email" placeholder="Enter signal frequency..."
                        class="mobile-footer-input w-full bg-white dark:bg-slate-800 border border-slate-200 dark:border-slate-700 rounded-lg py-3 px-4 text-sm outline-none focus:border-primary focus:ring-1 focus:ring-primary transition-all font-mono placeholder:text-slate-400 dark:text-white" required>
                    <button type="submit" id="footer-newsletter-btn"
                        class="mobile-footer-btn absolute right-2 top-2 bottom-2 bg-slate-900 text-white rounded px-3 text-xs font-bold uppercase hover:bg-primary transition-colors">
                        Init
                    </button>
                    <p id="footer-newsletter-msg" class="absolute -bottom-6 left-0 text-[10px] font-mono mt-1 hidden"></p>
                </form>

                <script>
                    async function submitNewsletter(e) {
                        e.preventDefault();
                        const form = e.target;
                        const emailInput = document.getElementById('footer-newsletter-email');
                        const btn = document.getElementById('footer-newsletter-btn');
                        const msg = document.getElementById('footer-newsletter-msg');
                        const token = form.querySelector('input[name="_token"]').value;

                        // Reset state
                        msg.classList.add('hidden');
                        msg.classList.remove('text-green-500', 'text-red-500');
                        btn.disabled = true;
                        btn.innerHTML = '<span class="material-symbols-outlined text-[14px] animate-spin">refresh</span>';

                        try {
                            const response = await fetch('{{ route('newsletter.subscribe') }}', {
                                method: 'POST',
                                headers: {
                                    'Content-Type': 'application/json',
                                    'Accept': 'application/json',
                                    'X-CSRF-TOKEN': token
                                },
                                body: JSON.stringify({ email: emailInput.value })
                            });

                            const data = await response.json();

                            if (response.ok) {
                                msg.textContent = 'Uplink established. Signal accepted.';
                                msg.classList.add('text-green-500');
                                msg.classList.remove('hidden');
                                emailInput.value = '';
                                btn.innerHTML = 'DONE';
                                btn.classList.add('bg-green-500');
                                btn.classList.remove('bg-slate-900', 'hover:bg-primary');
                                
                                setTimeout(() => {
                                    msg.classList.add('hidden');
                                    btn.innerHTML = 'Init';
                                    btn.classList.remove('bg-green-500');
                                    btn.classList.add('bg-slate-900', 'hover:bg-primary');
                                }, 3000);
                            } else {
                                throw new Error(data.message || 'Transmission failed.');
                            }
                        } catch (error) {
                            msg.textContent = error.message;
                            msg.classList.add('text-red-500');
                            msg.classList.remove('hidden');
                            btn.innerHTML = 'ERR';
                            btn.classList.add('bg-red-500');
                            btn.classList.remove('bg-slate-900', 'hover:bg-primary');
                            
                            setTimeout(() => {
                                msg.classList.add('hidden');
                                btn.innerHTML = 'Init';
                                btn.classList.remove('bg-red-500');
                                btn.classList.add('bg-slate-900', 'hover:bg-primary');
                            }, 3000);
                        } finally {
                            btn.disabled = false;
                        }
                    }
                </script>
            </div>
        </div>

        <!-- Footer Status Bar -->
        <div
            class="border-t border-slate-200 dark:border-slate-800 pt-8 flex flex-col md:flex-row justify-between items-center gap-4">
            <p class="mobile-footer-copyright text-sm text-slate-500 font-medium text-center md:text-left">© {{ date('Y') }} Jarreva Creative. All systems operational.</p>

            <div class="mobile-footer-legal flex items-center gap-8 justify-center">
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
