@extends('public.layouts.app')

@section('title', 'Jarreva Creative - Contact Us')

@push('styles')
<style>
    /* Content specifically for contact page */
    .reveal-on-scroll {
        opacity: 0;
        transform: translateY(30px);
        transition: opacity 0.8s ease-out, transform 0.8s ease-out;
        will-change: opacity, transform;
    }

    @keyframes blink {
        50% {
            opacity: 0;
        }
    }

    .signal-line {
        background-image: linear-gradient(90deg, transparent 50%, #f97316 50%);
        background-size: 20px 100%;
        animation: move-signal 1s linear infinite;
        opacity: 0;
        transition: opacity 0.3s;
    }

    @keyframes move-signal {
        0% {
            background-position: 0 0;
        }

        100% {
            background-position: 40px 0;
        }
    }

    .form-group:focus-within .signal-line,
    .input-active .signal-line {
        opacity: 0.5;
    }

    .terminal-input {
        background: transparent;
        border: none;
        border-bottom: 2px solid #e2e8f0;
        color: #0f172a;
        transition: all 0.3s;
    }

    .terminal-input:focus {
        outline: none;
        border-bottom-color: #f97316;
        background: linear-gradient(to bottom, transparent 95%, rgba(249, 115, 22, 0.1) 100%);
    }

    @keyframes success-pulse {
        0% {
            box-shadow: 0 0 0 0 rgba(74, 222, 128, 0.7);
        }

        70% {
            box-shadow: 0 0 0 20px rgba(74, 222, 128, 0);
        }

        100% {
            box-shadow: 0 0 0 0 rgba(74, 222, 128, 0);
        }
    }

    .btn-success {
        animation: success-pulse 1.5s infinite;
        background-color: #22c55e !important;
        border-color: #22c55e !important;
        color: white !important;
    }

    /* Floating Label Logic */
    .floating-label {
        transform: translateY(0);
        transition: all 0.2s ease-out;
        color: #64748b;
    }

    .terminal-input:focus~.floating-label,
    .terminal-input:not(:placeholder-shown)~.floating-label {
        transform: translateY(-24px) scale(0.85);
        color: #f97316;
    }

    .dark .terminal-input {
        border-bottom: 2px solid rgba(255, 255, 255, 0.1);
        color: white;
    }

    .reveal-on-scroll.is-visible {
        opacity: 1;
        transform: translateY(0);
    }

    /* Stagger Delays */
    .delay-100 {
        transition-delay: 100ms;
    }

    .delay-200 {
        transition-delay: 200ms;
    }

    .delay-300 {
        transition-delay: 300ms;
    }

    /* Text Gradient Animation */
    .animate-gradient {
        background-size: 200% auto;
        animation: gradientMove 4s linear infinite;
    }

    @keyframes gradientMove {
        0% {
            background-position: 0% center;
        }

        100% {
            background-position: 200% center;
        }
    }

    .cursor::after {
        content: '_';
        animation: blink 1s step-end infinite;
        color: #f97316;
    }

    .input-glow:focus {
        box-shadow: 0 0 15px rgba(249, 115, 22, 0.2);
        border-color: #f97316;
    }

    @keyframes scan {
        0% {
            top: -100%;
            opacity: 0;
        }

        50% {
            opacity: 1;
        }

        100% {
            top: 100%;
            opacity: 0;
        }
    }

    .animate-scan {
        animation: scan 3s linear infinite;
    }

    .pill-radio:checked+label {
        background-color: #f97316;
        color: white;
        border-color: #f97316;
        box-shadow: 0 4px 12px rgba(249, 115, 22, 0.3);
    }

    @keyframes scan-horizontal {
        0% {
            left: -100%;
        }

        100% {
            left: 100%;
        }
    }

    .animate-scan-horizontal {
        animation: scan-horizontal 3s linear infinite;
    }
</style>
@endpush

@section('content')
<div class="relative z-10">
    <!-- HERO SECTION -->
    <section class="reveal-on-scroll relative min-h-[60vh] flex items-center justify-center px-6 overflow-hidden">
        <!-- Light theme grid background (local to hero) -->
        <div class="absolute inset-0 z-0 bg-[linear-gradient(to_right,#80808012_1px,transparent_1px),linear-gradient(to_bottom,#80808012_1px,transparent_1px)] bg-[size:24px_24px] pointer-events-none">
        </div>

        <!-- Abstract Background Element -->
        <div class="absolute top-1/2 left-1/2 -translate-x-1/2 -translate-y-1/2 w-[800px] h-[800px] bg-gradient-to-tr from-primary/5 to-secondary/5 rounded-full blur-[120px] pointer-events-none">
        </div>

        <div class="relative z-10 max-w-4xl text-center">
            <span class="inline-block py-1 px-3 rounded-full bg-slate-100 dark:bg-slate-800 border border-slate-200 dark:border-slate-700 text-secondary text-xs font-bold tracking-[0.2em] uppercase mb-8 relative z-10 reveal-on-scroll delay-100">
                Transmission Open
            </span>
            <h1 class="mb-6 font-display text-5xl font-bold tracking-tight leading-[1.1] sm:text-6xl md:text-7xl lg:text-7xl dark:text-white drop-shadow-sm max-w-5xl mx-auto reveal-on-scroll delay-200">
                Start the <span class="text-transparent bg-clip-text bg-gradient-to-r from-blue-500 to-orange-500 animate-gradient">Dialogue.</span>
            </h1>
            <p class="text-xl md:text-2xl text-slate-500 dark:text-slate-400 max-w-2xl mx-auto leading-relaxed font-medium relative z-10 reveal-on-scroll delay-300">
                We respond to meaningful inquiries within 24 hours.<br class="hidden md:block"> No bots,
                just
                builders.
            </p>
        </div>
    </section>

    <div class="max-w-7xl mx-auto px-6 pb-20">
        <!-- INTERACTION ZONE (Split Layout) -->
        <section class="grid grid-cols-1 lg:grid-cols-12 gap-12 lg:gap-24 items-stretch mt-8">

            <!-- Left Column: Direct Channels -->
            <div class="lg:col-span-5 flex flex-col">

                <!-- Top Group: Signal & Frequencies -->
                <div class="space-y-10 reveal-on-scroll delay-100">
                    <!-- Email Block -->
                    <div>
                        <h3 class="text-xs font-bold uppercase tracking-widest text-slate-400 mb-6 font-display">
                            Direct Signal
                        </h3>
                        <a href="mailto:jarrevacreative@gmail.com" class="group flex items-center gap-4 text-3xl font-light text-slate-900 dark:text-white hover:text-primary dark:hover:text-primary transition-colors">
                            <span class="material-symbols-outlined text-4xl font-light group-hover:scale-110 transition-transform">alternate_email</span>
                            jarrevacreative@gmail.com
                        </a>
                    </div>

                    <!-- Social Grid -->
                    <div>
                        <h3 class="text-xs font-bold uppercase tracking-widest text-slate-400 mb-6 font-display">
                            Other Frequencies
                        </h3>
                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                            <!-- Instagram -->
                            <a href="https://www.instagram.com/jarrevacreative?igsh=bjlwazJlOHBsd2h0&utm_source=qr" target="_blank" rel="noopener noreferrer" class="flex items-center gap-4 p-4 rounded-xl bg-slate-50 dark:bg-slate-800/50 border border-slate-200 dark:border-slate-700 hover:bg-white dark:hover:bg-slate-800 hover:border-secondary hover:shadow-md hover:-translate-y-1 transition-all duration-300 group">
                                <div class="w-10 h-10 rounded-full bg-gradient-to-r from-purple-500 to-pink-500 flex items-center justify-center text-white shadow-sm group-hover:scale-110 transition-transform">
                                    <svg class="h-5 w-5 fill-current" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512">
                                        <path d="M224.1 141c-63.6 0-114.9 51.3-114.9 114.9s51.3 114.9 114.9 114.9S339 319.5 339 255.9 287.7 141 224.1 141zm0 189.6c-41.1 0-74.7-33.5-74.7-74.7s33.5-74.7 74.7-74.7 74.7 33.5 74.7 74.7-33.6 74.7-74.7 74.7zm146.4-194.3c0 14.9-12 26.8-26.8 26.8-14.9 0-26.8-12-26.8-26.8s12-26.8 26.8-26.8 26.8 12 26.8 26.8zm76.1 27.2c-1.7-35.9-9.9-67.7-36.2-93.9-26.2-26.2-58-34.4-93.9-36.2-37-2.1-147.9-2.1-184.9 0-35.8 1.7-67.6 9.9-93.9 36.1s-34.4 58-36.2 93.9c-2.1 37-2.1 147.9 0 184.9 1.7 35.9 9.9 67.7 36.2 93.9s58 34.4 93.9 36.2c37 2.1 147.9 2.1 184.9 0 35.9-1.7 67.7-9.9 93.9-36.2 26.2-26.2 34.4-58 36.2-93.9 2.1-37 2.1-147.8 0-184.8zM398.8 388c-7.8 19.6-22.9 34.7-42.6 42.6-29.5 11.7-99.5 9-132.1 9s-102.7 2.6-132.1-9c-19.6-7.8-34.7-22.9-42.6-42.6-11.7-29.5-9-99.5-9-132.1s-2.6-102.7 9-132.1c7.8-19.6 22.9-34.7 42.6-42.6 29.5-11.7 99.5-9 132.1-9s102.7-2.6 132.1 9c19.6 7.8 34.7 22.9 42.6 42.6 11.7 29.5 9 99.5 9 132.1s2.7 102.7-9 132.1z"/>
                                    </svg>
                                </div>
                                <div>
                                    <span class="block font-bold text-sm text-slate-900 dark:text-white group-hover:text-pink-400 transition-colors">Instagram</span>
                                    <span class="block text-xs text-slate-500">Daily Visuals</span>
                                </div>
                            </a>
                            <!-- X (Twitter) -->
                            <a href="https://x.com/jarrevacreative?s=21" target="_blank" rel="noopener noreferrer" class="flex items-center gap-4 p-4 rounded-xl bg-slate-50 dark:bg-slate-800/50 border border-slate-200 dark:border-slate-700 hover:bg-white dark:hover:bg-slate-800 hover:border-secondary hover:shadow-md hover:-translate-y-1 transition-all duration-300 group">
                                <div class="w-10 h-10 rounded-full bg-black dark:bg-white border border-slate-200 dark:border-slate-700 flex items-center justify-center text-white dark:text-black shadow-sm group-hover:scale-110 transition-transform">
                                    <svg class="h-4 w-4 fill-current" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512">
                                        <path d="M389.2 48h70.6L305.6 224.2 487 464H345L233.7 318.6 106.5 464H35.8L200.7 275.5 26.8 48H172.4L272.9 180.9 389.2 48zM364.4 421.8h39.1L151.1 88h-42L364.4 421.8z"/>
                                    </svg>
                                </div>
                                <div>
                                    <span class="block font-bold text-sm text-slate-900 dark:text-white group-hover:text-primary transition-colors">X (Twitter)</span>
                                    <span class="block text-xs text-slate-500">Thoughts</span>
                                </div>
                            </a>
                            <!-- TikTok -->
                            <a href="https://www.tiktok.com/@jarreva_creative?is_from_webapp=1&sender_device=pc" target="_blank" rel="noopener noreferrer" class="flex items-center gap-4 p-4 rounded-xl bg-slate-50 dark:bg-slate-800/50 border border-slate-200 dark:border-slate-700 hover:bg-white dark:hover:bg-slate-800 hover:border-secondary hover:shadow-md hover:-translate-y-1 transition-all duration-300 group">
                                <div class="w-10 h-10 rounded-full bg-black dark:bg-white border border-slate-200 dark:border-slate-700 flex items-center justify-center text-white dark:text-black shadow-sm group-hover:scale-110 transition-transform">
                                    <svg class="h-4 w-4 fill-current" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512">
                                        <path d="M448 209.9a210.1 210.1 0 0 1 -122.8-39.3V349.4A162.9 162.9 0 1 1 185 188.3V278.2a74.6 74.6 0 1 0 52.2 71.2V0l88 0a121.2 121.2 0 0 0 1.9 22.2h0A122.2 122.2 0 0 0 381 102.4a121.4 121.4 0 0 0 67 20.1z"/>
                                    </svg>
                                </div>
                                <div>
                                    <span class="block font-bold text-sm text-slate-900 dark:text-white group-hover:text-pink-400 transition-colors">TikTok</span>
                                    <span class="block text-xs text-slate-500">Shorts</span>
                                </div>
                            </a>
                            <!-- Medium -->
                            <a href="https://medium.com/@jarrevacreative" target="_blank" rel="noopener noreferrer" class="flex items-center gap-4 p-4 rounded-xl bg-slate-50 dark:bg-slate-800/50 border border-slate-200 dark:border-slate-700 hover:bg-white dark:hover:bg-slate-800 hover:border-secondary hover:shadow-md hover:-translate-y-1 transition-all duration-300 group">
                                <div class="w-10 h-10 rounded-full bg-white dark:bg-slate-900 border border-slate-200 dark:border-slate-600 text-black dark:text-white flex items-center justify-center shadow-sm group-hover:scale-110 transition-transform">
                                    <svg class="h-4 w-4 fill-current" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 640 512">
                                        <path d="M180.5 74.3C80.8 74.3 0 155.6 0 256S80.8 437.7 180.5 437.7 361 356.4 361 256 280.2 74.3 180.5 74.3zm288.3 10.6c-49.8 0-90.2 76.6-90.2 171.1s40.4 171.1 90.2 171.1 90.2-76.6 90.2-171.1H559C559 161.5 518.6 84.9 468.8 84.9zm139.5 17.8c-17.5 0-31.7 68.6-31.7 153.3s14.2 153.3 31.7 153.3S640 340.6 640 256C640 171.4 625.8 102.7 608.3 102.7z"/>
                                    </svg>
                                </div>
                                <div>
                                    <span class="block font-bold text-sm text-slate-900 dark:text-white group-hover:text-slate-500 transition-colors">Medium</span>
                                    <span class="block text-xs text-slate-500">Deep Dives</span>
                                </div>
                            </a>
                        </div>
                    </div>
                </div>

                <!-- Map Anchor Section -->
                <div class="mt-auto reveal-on-scroll delay-200">
                    <!-- Context/Boundaries -->
                    <div class="mb-6 pt-6 border-t border-slate-100 dark:border-slate-800">
                        <p class="text-xs text-slate-400 font-medium italic">
                            "We do not accept guest posts. We do not outsource our craft."
                        </p>
                    </div>

                    <!-- Map Module -->
                    <div class="relative group bg-white dark:bg-slate-900 rounded-3xl overflow-hidden border border-slate-100 dark:border-slate-800 shadow-xl flex flex-col h-[320px]">
                        <div class="absolute top-0 left-0 right-0 z-10 px-6 py-4 bg-white/80 dark:bg-slate-900/80 backdrop-blur-sm border-b border-slate-100 dark:border-slate-800 flex items-center justify-between">
                            <h3 class="text-xs font-bold uppercase tracking-widest text-slate-500 font-display">
                                Operations Base</h3>
                            <div class="flex gap-1.5">
                                <div class="w-2 h-2 rounded-full bg-red-400"></div>
                                <div class="w-2 h-2 rounded-full bg-yellow-400"></div>
                                <div class="w-2 h-2 rounded-full bg-green-400"></div>
                            </div>
                        </div>

                        <div class="relative w-full h-full bg-slate-50 dark:bg-slate-800">
                            <!-- The Map -->
                            <iframe src="https://maps.google.com/maps?q=-7.756982,110.410981&hl=en&z=17&output=embed" width="100%" height="100%" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade" class="absolute inset-0 grayscale group-hover:grayscale-0 transition-all duration-700 ease-in-out opacity-60 group-hover:opacity-100">
                            </iframe>

                            <!-- Tech Overlay (Scanning Effect) -->
                            <div class="absolute inset-0 bg-slate-900/5 dark:bg-slate-900/20 pointer-events-none group-hover:opacity-0 transition-opacity duration-500 backdrop-blur-[1px] group-hover:backdrop-blur-none">
                                <!-- Scanline -->
                                <div class="absolute inset-0 bg-[linear-gradient(transparent_50%,rgba(0,0,0,0.05)_50%)] bg-[size:100%_4px]">
                                </div>
                                <div class="absolute top-0 left-0 w-full h-1/2 bg-gradient-to-b from-transparent via-primary/10 to-transparent animate-scan">
                                </div>

                                <!-- Center Text -->
                                <div class="absolute top-1/2 left-1/2 -translate-x-1/2 -translate-y-1/2 flex flex-col items-center gap-2">
                                    <div class="relative flex h-3 w-3">
                                        <span class="animate-ping absolute inline-flex h-full w-full rounded-full bg-secondary opacity-75"></span>
                                        <span class="relative inline-flex rounded-full h-3 w-3 bg-secondary"></span>
                                    </div>
                                    <span class="text-[10px] font-mono font-bold text-slate-600 dark:text-slate-300 bg-white/90 dark:bg-slate-900/90 backdrop-blur px-2 py-1 rounded border border-slate-200 dark:border-slate-700 shadow-sm">LOCATING...</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Right Column: The Form -->
            <div class="lg:col-span-7 bg-white dark:bg-slate-900 rounded-3xl p-8 md:p-12 border border-slate-100 dark:border-slate-800 shadow-xl relative overflow-hidden">
                <!-- Ambient Glow -->
                <div class="absolute -top-20 -right-20 w-64 h-64 bg-primary/5 rounded-full blur-[80px] pointer-events-none">
                </div>

                <h2 class="text-2xl font-bold mb-8 flex items-center gap-3 text-slate-900 dark:text-white">
                    <span class="w-2 h-8 bg-primary rounded-full"></span>
                    Project Data Entry
                </h2>

                <form id="contactForm" class="space-y-12 relative z-10" onsubmit="transmitSignal(event)">
                    @csrf
                    <!-- Name & Contact Grid -->
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-12">
                        <!-- Name Input -->
                        <div class="form-group relative group">
                            <input type="text" id="name" name="name" class="terminal-input w-full py-4 text-lg bg-transparent focus:ring-0 placeholder-transparent" placeholder="Your Name" required>
                            <label for="name" class="floating-label absolute left-0 top-4 text-slate-500 pointer-events-none origin-left">Identification Name</label>
                            <div class="absolute bottom-0 left-0 w-full h-[1px] signal-line"></div>
                        </div>

                        <!-- Email Input -->
                        <div class="form-group relative group">
                            <input type="email" id="email" name="email" class="terminal-input w-full py-4 text-lg bg-transparent focus:ring-0 placeholder-transparent" placeholder="email@domain.com" required>
                            <label for="email" class="floating-label absolute left-0 top-4 text-slate-500 pointer-events-none origin-left">Return Signal (Email)</label>
                            <div class="absolute bottom-0 left-0 w-full h-[1px] signal-line"></div>
                        </div>
                    </div>

                    <!-- Topic Selection (formerly Project Type) -->
                    <div class="form-group relative group">
                        <label class="text-sm text-slate-400 mb-4 block">Topic of Inquiry</label>
                        <div class="flex flex-wrap gap-4" id="projectTypes">
                            <button type="button" class="px-6 py-2 rounded-full border border-slate-200 dark:border-slate-700 text-slate-600 dark:text-slate-300 hover:border-primary hover:text-primary hover:bg-primary/5 transition-all focus:border-primary focus:bg-primary focus:text-white project-select icon-transition" onclick="selectProject(this)">Book Inquiry</button>
                            <button type="button" class="px-6 py-2 rounded-full border border-slate-200 dark:border-slate-700 text-slate-600 dark:text-slate-300 hover:border-primary hover:text-primary hover:bg-primary/5 transition-all focus:border-primary focus:bg-primary focus:text-white project-select icon-transition" onclick="selectProject(this)">Creative Collaboration</button>
                            <button type="button" class="px-6 py-2 rounded-full border border-slate-200 dark:border-slate-700 text-slate-600 dark:text-slate-300 hover:border-primary hover:text-primary hover:bg-primary/5 transition-all focus:border-primary focus:bg-primary focus:text-white project-select icon-transition" onclick="selectProject(this)">Speaking / Workshop</button>
                            <button type="button" class="px-6 py-2 rounded-full border border-slate-200 dark:border-slate-700 text-slate-600 dark:text-slate-300 hover:border-primary hover:text-primary hover:bg-primary/5 transition-all focus:border-primary focus:bg-primary focus:text-white project-select icon-transition" onclick="selectProject(this)">General Signal</button>
                        </div>
                        <input type="hidden" id="selectedProject" name="topic" required>
                    </div>

                    <!-- Message -->
                    <div class="form-group relative group">
                        <textarea id="message" name="message" rows="4" class="terminal-input w-full py-4 text-lg bg-transparent focus:ring-0 placeholder-transparent resize-none dark:text-white" placeholder="Describe your chaos..." required></textarea>
                        <label for="message" class="floating-label absolute left-0 top-4 text-slate-500 pointer-events-none origin-left">Input Raw Data (Message)</label>
                        <div class="absolute bottom-0 left-0 w-full h-[1px] signal-line"></div>
                    </div>

                    <!-- Submit Action -->
                    <div class="flex items-center justify-between pt-8 border-t border-slate-100 dark:border-slate-800">
                        <div class="text-xs text-gray-500">
                            <span class="inline-block w-2 h-2 rounded-full bg-green-500 mr-2 animate-pulse"></span>
                            System Online
                        </div>
                        <button type="submit" id="submitBtn" class="group relative px-8 py-4 bg-primary text-white font-bold rounded-lg overflow-hidden transition-all hover:shadow-[0_0_30px_rgba(249,115,22,0.4)] active:scale-95 disabled:opacity-50 disabled:cursor-not-allowed">
                            <span class="relative z-10 flex items-center gap-2">
                                TRANSMIT SIGNAL
                                <span class="material-symbols-outlined transition-transform group-hover:translate-x-1">send</span>
                            </span>
                            <div class="absolute inset-0 bg-white/20 translate-y-full group-hover:translate-y-0 transition-transform duration-300">
                            </div>
                        </button>
                    </div>

                </form>
            </div>
        </section>

        <!-- Information Steps -->
        <section class="max-w-7xl mx-auto px-6 mt-32 border-t border-slate-200 dark:border-slate-800 pt-20">
            <div class="grid grid-cols-1 md:grid-cols-3 gap-12 text-center md:text-left">
                <div class="relative pl-8 border-l-2 border-slate-200 dark:border-slate-800 group hover:border-secondary transition-colors duration-500">
                    <span class="absolute -left-[9px] top-0 w-4 h-4 rounded-full bg-white dark:bg-slate-900 border-2 border-slate-300 dark:border-slate-700 group-hover:border-secondary transition-colors"></span>
                    <h4 class="font-bold text-slate-900 dark:text-white mb-2">01. Signal Received</h4>
                    <p class="text-sm text-slate-500">Your message enters our secure database. An automated confirmation will be sent to your email.</p>
                </div>
                <div class="relative pl-8 border-l-2 border-slate-200 dark:border-slate-800 group hover:border-primary transition-colors duration-500 delay-100">
                    <span class="absolute -left-[9px] top-0 w-4 h-4 rounded-full bg-white dark:bg-slate-900 border-2 border-slate-300 dark:border-slate-700 group-hover:border-primary transition-colors"></span>
                    <h4 class="font-bold text-slate-900 dark:text-white mb-2">02. Logic Analysis</h4>
                    <p class="text-sm text-slate-500">Within 24 hours, our architect team will analyze your needs to ensure a vision fit.</p>
                </div>
                <div class="relative pl-8 border-l-2 border-slate-200 dark:border-slate-800 group hover:border-green-500 transition-colors duration-500 delay-200">
                    <span class="absolute -left-[9px] top-0 w-4 h-4 rounded-full bg-white dark:bg-slate-900 border-2 border-slate-300 dark:border-slate-700 group-hover:border-green-500 transition-colors"></span>
                    <h4 class="font-bold text-slate-900 dark:text-white mb-2">03. Connection Link</h4>
                    <p class="text-sm text-slate-500">We will reply with a discussion schedule link to initiate project mapping.</p>
                </div>
            </div>
        </section>

        <!-- Footer Separator Animation -->
        <div class="relative h-32 w-full flex items-center justify-center overflow-hidden mt-12 opacity-60">
            <div class="absolute w-full h-[1px] bg-slate-200 dark:bg-slate-800"></div>
            <div class="absolute w-1/2 h-[1px] bg-gradient-to-r from-transparent via-secondary to-transparent animate-scan-horizontal">
            </div>
            <span class="bg-white dark:bg-background-dark px-4 text-[10px] font-mono tracking-[0.3em] text-slate-300 dark:text-slate-600 relative z-10 uppercase">
                Terminating Signal
            </span>
        </div>

    </div>
</div>
@endsection

@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', () => {
        const observerOptions = {
            root: null,
            rootMargin: '0px',
            threshold: 0.1
        };
        const observer = new IntersectionObserver((entries, observer) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    entry.target.classList.add('is-visible');
                }
            });
        }, observerOptions);
        const sections = document.querySelectorAll('.reveal-on-scroll');
        sections.forEach(section => {
            observer.observe(section);
        });
        
        // INPUT ANIMATION LISTENERS
        document.querySelectorAll('.terminal-input').forEach(input => {
            input.addEventListener('focus', () => {
                input.parentElement.classList.add('input-active');
            });
            input.addEventListener('blur', () => {
                if (input.value === '') {
                    input.parentElement.classList.remove('input-active');
                }
            });
        });
    });

    // PROJECT SELECTION LOGIC
    function selectProject(btn) {
        // Reset all
        document.querySelectorAll('.project-select').forEach(b => {
            b.classList.remove('bg-primary', 'text-white', 'border-primary', 'dark:text-white');
            b.classList.add('border-slate-200', 'dark:border-slate-700', 'text-slate-600', 'dark:text-slate-300');
        });
        // Active state
        btn.classList.add('bg-primary', 'text-white', 'border-primary', 'dark:text-white');
        btn.classList.remove('border-slate-200', 'dark:border-slate-700', 'text-slate-600', 'dark:text-slate-300');
        document.getElementById('selectedProject').value = btn.innerText;
    }

    // FORM TRANSMISSION 
    async function transmitSignal(e) {
        e.preventDefault();
        
        // If topic is not selected, we alert or focus
        if(!document.getElementById('selectedProject').value) {
            alert('Please select a topic of inquiry.');
            return;
        }

        const btn = document.getElementById('submitBtn');
        const icon = btn.querySelector('.material-symbols-outlined');
        const text = btn.querySelector('span');

        const form = document.getElementById('contactForm');
        const formData = new FormData(form);

        // 1. Loading State
        btn.disabled = true;
        text.innerHTML = ` TRANSMITTING... <span class="material-symbols-outlined animate-spin">refresh</span>`;

        try {
            const response = await fetch('{{ route('contact.submit') }}', {
                method: 'POST',
                headers: {
                    'X-Requested-With': 'XMLHttpRequest',
                    'Accept': 'application/json'
                },
                body: formData
            });

            if (response.ok) {
                // 2. Success State
                btn.classList.add('btn-success');
                btn.classList.remove('bg-primary');
                text.innerHTML = ` SIGNAL SENT <span class="material-symbols-outlined">check_circle</span>`;

                // 3. Reset after delay
                setTimeout(() => {
                    btn.disabled = false;
                    btn.classList.remove('btn-success');
                    btn.classList.add('bg-primary');
                    text.innerHTML = ` TRANSMIT SIGNAL <span class="material-symbols-outlined">send</span>`;
                    form.reset();
                    // Reset pills
                    document.querySelectorAll('.project-select').forEach(b => {
                        b.classList.remove('bg-primary', 'text-white', 'border-primary', 'dark:text-white');
                        b.classList.add('border-slate-200', 'dark:border-slate-700', 'text-slate-600', 'dark:text-slate-300');
                    });
                    document.getElementById('selectedProject').value = '';
                }, 3000);
            } else {
                let errorData = await response.json();
                throw new Error(errorData.message || 'Signal failed to transmit');
            }
        } catch (error) {
            // Error State
            btn.disabled = false;
            text.innerHTML = ` TRANSMIT FAILED <span class="material-symbols-outlined">error</span>`;
            setTimeout(() => {
                text.innerHTML = ` TRANSMIT SIGNAL <span class="material-symbols-outlined">send</span>`;
            }, 3000);
        }
    }
</script>
@endpush
