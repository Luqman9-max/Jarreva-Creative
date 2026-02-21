@extends('public.layouts.app')

@section('title', 'Jarreva Creative - About Us')

@push('styles')
<style>
    html {
        scroll-behavior: smooth;
    }

    /* Unified Reveal Animation */
    .reveal-on-scroll {
        opacity: 0;
        transform: translateY(30px);
        transition: all 1s cubic-bezier(0.16, 1, 0.3, 1);
        will-change: opacity, transform;
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

    /* Spotlight Card Effect */
    .spotlight-card {
        position: relative;
        overflow: hidden;
        /* Ensure bg color is set on element */
    }

    .spotlight-card::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        background: radial-gradient(800px circle at var(--mouse-x) var(--mouse-y), rgba(19, 127, 236, 0.06), transparent 40%);
        opacity: 0;
        transition: opacity 0.5s;
        pointer-events: none;
        z-index: 2;
    }

    .spotlight-card:hover::before {
        opacity: 1;
    }

    /* Process Line Animation */
    .process-line {
        height: 0;
        transition: height 1.5s ease-out;
    }

    /* Custom Scrollbar */
    .hide-scrollbar::-webkit-scrollbar {
        display: none;
    }

    .hide-scrollbar {
        -ms-overflow-style: none;
        scrollbar-width: none;
    }
</style>
@endpush

@section('content')
<!-- SECTION 1: HERO - THE MANIFESTO -->
<section
    class="reveal-on-scroll relative min-h-[80vh] flex items-center justify-center px-6 overflow-hidden bg-white dark:bg-background-dark">
    <div
        class="absolute inset-0 z-0 bg-[linear-gradient(to_right,#80808012_1px,transparent_1px),linear-gradient(to_bottom,#80808012_1px,transparent_1px)] bg-[size:24px_24px] pointer-events-none">
    </div>

    <!-- Abstract Background Element -->
    <div
        class="absolute top-1/2 left-1/2 -translate-x-1/2 -translate-y-1/2 w-[800px] h-[800px] bg-gradient-to-tr from-primary/5 to-secondary/5 rounded-full blur-[120px] pointer-events-none">
    </div>

    <div class="relative z-10 max-w-4xl text-center">
        <span
            class="inline-block py-1 px-3 rounded-full bg-slate-100 dark:bg-slate-800 text-slate-500 text-xs font-bold tracking-[0.2em] uppercase mb-8 border border-slate-200 dark:border-slate-700 reveal-on-scroll delay-100">
            Est. 2025
        </span>
        <h1
            class="mb-6 font-display text-5xl font-bold tracking-tight leading-[1.1] sm:text-6xl md:text-7xl lg:text-7xl dark:text-white drop-shadow-sm max-w-5xl mx-auto reveal-on-scroll delay-200">
            We don't just design.<br>
            We build <span
                class="text-transparent bg-clip-text bg-gradient-to-r from-blue-500 to-orange-500 animate-gradient">Systems
                for<br>
                the Mind.</span>
        </h1>
        <p
            class="text-xl md:text-2xl text-slate-500 dark:text-slate-400 max-w-2xl mx-auto leading-relaxed font-medium reveal-on-scroll delay-300">
            Jarreva Creative is an intellectual design studio dedicated to turning chaos into clarity
            through structure, content, and digital craftsmanship.
        </p>
    </div>
</section>

<!-- SECTION 2: ORIGIN STORY - INTERACTIVE EVOLUTION -->
<section class="relative py-32 bg-white dark:bg-background-dark overflow-hidden">
    <div class="max-w-7xl mx-auto px-6 md:px-12 relative z-10 flex flex-col gap-32">

        <!-- ROW 1: DISCOVERY (Text Left, Visual Right) -->
        <div class="flex flex-col lg:flex-row items-center gap-16 lg:gap-32 reveal-on-scroll">
            <div class="lg:w-1/2">
                <span class="text-secondary font-mono text-xs tracking-widest mb-4 block">PHASE_01 //
                    DISCOVERY</span>
                <h3
                    class="text-4xl md:text-5xl font-black mb-6 text-slate-900 dark:text-white leading-tight">
                    It started with noise.</h3>
                <p class="text-lg text-slate-500 dark:text-slate-400 leading-relaxed">
                    The internet is deafening. We realized that true impact isn't about shouting
                    louder—it's about speaking clearer. We stopped chasing algorithms and started
                    chasing truth.
                </p>
            </div>
            <div class="lg:w-1/2 w-full">
                <!-- Visual 1: Noise -->
                <div
                    class="w-full aspect-square md:aspect-video lg:aspect-square rounded-[40px] bg-slate-950 border border-slate-800 overflow-hidden shadow-2xl relative flex items-center justify-center group hover:scale-[1.02] transition-transform duration-500">
                    <div
                        class="absolute inset-0 bg-[url('https://grainy-gradients.vercel.app/noise.svg')] opacity-20 mix-blend-overlay">
                    </div>
                    <!-- Glitch Text Effect -->
                    <div class="relative">
                        <h4
                            class="text-6xl md:text-8xl font-black text-transparent bg-clip-text bg-gradient-to-r from-red-500 via-orange-500 to-red-500 animate-pulse blur-[1px]">
                            NOISE</h4>
                        <h4 class="absolute top-0 left-0 text-6xl md:text-8xl font-black text-red-500 opacity-50 animate-ping"
                            style="animation-duration: 0.2s;">NOISE</h4>
                    </div>
                </div>
            </div>
        </div>

        <!-- ROW 2: ENGINEERING (Visual Left, Text Right) -->
        <div class="flex flex-col lg:flex-row-reverse items-center gap-16 lg:gap-32 reveal-on-scroll">
            <div class="lg:w-1/2">
                <span class="text-primary font-mono text-xs tracking-widest mb-4 block">PHASE_02 //
                    ENGINEERING</span>
                <h3
                    class="text-4xl md:text-5xl font-black mb-6 text-slate-900 dark:text-white leading-tight">
                    Intellectual Architecture.</h3>
                <p class="text-lg text-slate-500 dark:text-slate-400 leading-relaxed">
                    We engineered a new approach. Content isn't just "filler"—it's a product. We began
                    designing information with the same rigor an architect designs a skyscraper.
                </p>
            </div>
            <div class="lg:w-1/2 w-full">
                <!-- Visual 2: Architecture / Blueprint -->
                <div
                    class="w-full aspect-square md:aspect-video lg:aspect-square rounded-[40px] bg-slate-900 border border-slate-700 overflow-hidden shadow-2xl relative flex items-center justify-center group hover:scale-[1.02] transition-transform duration-500">
                    <div
                        class="absolute inset-0 bg-[linear-gradient(to_right,#137fec10_1px,transparent_1px),linear-gradient(to_bottom,#137fec10_1px,transparent_1px)] bg-[size:40px_40px]">
                    </div>

                    <!-- Animated 3D Structure -->
                    <div class="relative w-64 h-64 perspective-1000">
                        <style>
                            .rotate-3d {
                                transform-style: preserve-3d;
                                animation: rotateCube 15s linear infinite;
                            }

                            @keyframes rotateCube {
                                0% {
                                    transform: rotateX(60deg) rotateZ(0deg);
                                }

                                100% {
                                    transform: rotateX(60deg) rotateZ(360deg);
                                }
                            }

                            .cube-face {
                                position: absolute;
                                width: 100%;
                                height: 100%;
                                border: 1px solid rgba(19, 127, 236, 0.4);
                                background: rgba(19, 127, 236, 0.05);
                                box-shadow: 0 0 15px rgba(19, 127, 236, 0.1);
                            }
                        </style>
                        <div class="w-full h-full rotate-3d">
                            <!-- Base Grid -->
                            <div
                                class="absolute inset-0 border border-primary/30 rounded-lg scale-125 opacity-30">
                            </div>
                            <!-- Core Layers -->
                            <div
                                class="absolute inset-0 border-2 border-primary/60 bg-primary/10 rounded-lg transform translate-z-10 shadow-[0_0_30px_rgba(19,127,236,0.2)]">
                            </div>
                            <div
                                class="absolute inset-0 border border-primary/40 rounded-lg transform translate-z-20 scale-75 rotate-45">
                            </div>
                            <div
                                class="absolute inset-0 border border-dashed border-white/20 rounded-lg transform translate-z-30 scale-50">
                            </div>
                            <!-- Scanning Line -->
                            <div
                                class="absolute top-0 left-0 right-0 h-1 bg-gradient-to-r from-transparent via-primary to-transparent opacity-80 animate-[ping_3s_ease-in-out_infinite] blur-sm">
                            </div>
                        </div>
                    </div>

                    <div
                        class="absolute bottom-8 right-8 font-mono text-primary/50 text-xs tracking-widest">
                        ARCH_V.2.0 // BUILDING...</div>
                </div>
            </div>
        </div>

        <!-- ROW 3: EXECUTION (Text Left, Visual Right) -->
        <div class="flex flex-col lg:flex-row items-center gap-16 lg:gap-32 reveal-on-scroll">
            <div class="lg:w-1/2">
                <span class="text-slate-400 font-mono text-xs tracking-widest mb-4 block">PHASE_03 //
                    EXECUTION</span>
                <h3
                    class="text-4xl md:text-5xl font-black mb-6 text-slate-900 dark:text-white leading-tight">
                    The Clarity Engine.</h3>
                <p class="text-lg text-slate-500 dark:text-slate-400 leading-relaxed">
                    Today, Jarreva isn't just a studio—it's a system. We build the frameworks (books,
                    courses, platforms) that help you turn your chaotic potential into tangible mastery.
                </p>
            </div>
            <div class="lg:w-1/2 w-full">
                <!-- Visual 3: Clarity Engine / System -->
                <div
                    class="w-full aspect-square md:aspect-video lg:aspect-square rounded-[40px] bg-slate-50 dark:bg-slate-900 border border-slate-200 dark:border-slate-800 overflow-hidden shadow-2xl relative flex items-center justify-center group hover:scale-[1.02] transition-transform duration-500">
                    <div
                        class="absolute inset-0 bg-[radial-gradient(circle_at_center,#f0f9ff_0%,#ffffff_70%)] dark:bg-[radial-gradient(circle_at_center,#1e293b_0%,#0f172a_70%)]">
                    </div>

                    <!-- Animated System Core -->
                    <div class="relative flex items-center justify-center">
                        <!-- Orbit 1 -->
                        <div
                            class="absolute w-[300px] h-[300px] border border-slate-200 dark:border-slate-700 rounded-full animate-[spin_20s_linear_infinite] opacity-60">
                            <div class="absolute top-1/2 -right-1 w-2 h-2 bg-slate-400 rounded-full"></div>
                        </div>
                        <!-- Orbit 2 -->
                        <div
                            class="absolute w-[220px] h-[220px] border border-dashed border-slate-300 dark:border-slate-600 rounded-full animate-[spin_15s_linear_infinite_reverse] opacity-80">
                        </div>
                        <!-- Orbit 3 (Active) -->
                        <div
                            class="absolute w-[160px] h-[160px] border border-primary/30 rounded-full animate-[spin_10s_linear_infinite]">
                            <div
                                class="absolute top-0 left-1/2 -translate-x-1/2 -translate-y-1/2 w-3 h-3 bg-primary rounded-full shadow-[0_0_10px_#137fec]">
                            </div>
                        </div>

                        <!-- Core -->
                        <div
                            class="relative z-10 w-28 h-28 bg-white dark:bg-slate-800 rounded-3xl shadow-[0_0_40px_rgba(19,127,236,0.3)] flex items-center justify-center border border-slate-100 dark:border-slate-700 animate-pulse">
                            <span
                                class="material-symbols-outlined text-transparent bg-clip-text bg-gradient-to-br from-primary to-blue-600 text-6xl">diamond</span>
                        </div>
                    </div>

                    <div
                        class="absolute bottom-8 font-bold text-slate-900 dark:text-white text-xs tracking-[0.3em] uppercase opacity-70">
                        System Active</div>
                </div>
            </div>
        </div>

    </div>
</section>

<!-- SECTION 3: CORE PRINCIPLES - BENTO GRID v2 -->
<section id="principles" class="reveal-on-scroll py-32 bg-slate-50 dark:bg-slate-900 mx-4">
    <div class="max-w-7xl mx-auto px-6 md:px-12 text-center mb-16">
        <span
            class="text-secondary font-bold tracking-widest uppercase text-xs border border-secondary/20 bg-secondary/10 px-3 py-1 rounded-full mb-4 inline-block">The
            Codec</span>
        <h2 class="text-4xl md:text-5xl font-black mb-6">Built on Principles.</h2>
        <p class="max-w-2xl mx-auto text-slate-500 text-lg">We don't follow trends. We observe first
            principles.</p>
    </div>

    <div class="max-w-6xl mx-auto px-6 md:px-12">
        <div class="grid grid-cols-1 md:grid-cols-6 gap-6 auto-rows-[340px]">

            <!-- Card 1: Systems > Hacks (Large Span) -->
            <div
                class="spotlight-card md:col-span-4 bg-white dark:bg-slate-800 rounded-3xl p-10 border border-slate-200 dark:border-slate-700 shadow-sm hover:shadow-xl hover:border-blue-500/50 transition-all duration-300 relative overflow-hidden group">
                <!-- Background Elements -->
                <div
                    class="absolute inset-0 opacity-10 pointer-events-none bg-[radial-gradient(#3b82f6_1px,transparent_1px)] [background-size:20px_20px]">
                </div>
                <div
                    class="absolute -right-20 -bottom-20 w-80 h-80 bg-blue-500/5 rounded-full blur-3xl group-hover:bg-blue-500/10 transition-colors duration-500">
                </div>

                <div class="relative z-10 h-full flex flex-col gap-12">
                    <div class="w-full flex justify-between items-start">
                        <div
                            class="w-14 h-14 bg-blue-500/10 rounded-2xl flex items-center justify-center text-blue-500 group-hover:scale-110 transition-transform duration-300">
                            <span class="material-symbols-outlined text-3xl">hub</span>
                        </div>
                        <span
                            class="font-mono text-xs text-slate-400 bg-slate-100 dark:bg-slate-700 px-2 py-1 rounded">SYS_01</span>
                    </div>

                    <div>
                        <h3 class="text-3xl font-bold mb-2 group-hover:text-blue-500 transition-colors">
                            Systems &gt; Hacks</h3>
                        <p class="text-slate-500 dark:text-slate-400 text-lg leading-relaxed max-w-md">
                            Overnight success is a myth. We build robust, scalable architectures for your
                            mind and business that compound over time.
                        </p>
                    </div>
                </div>
            </div>

            <!-- Card 2: Clarity (Tall/Vertical) -->
            <div
                class="spotlight-card md:col-span-2 bg-slate-900 text-white rounded-3xl p-10 border border-slate-700 shadow-lg relative overflow-hidden group">
                <!-- Animated Noise/Blur -->
                <div class="absolute inset-0 bg-gradient-to-br from-slate-800 to-slate-950 z-0"></div>
                <div
                    class="absolute inset-0 opacity-0 group-hover:opacity-100 transition-opacity duration-700 bg-[url('data:image/svg+xml;base64,PHN2ZyB4bWxucz0iaHR0cDovL3d3dy53My5vcmcvMjAwMC9zdmciIHdpZHRoPSI0IiBoZWlnaHQ9IjQiPgo8cmVjdCB3aWR0aD0iNCIgaGVpZ2h0PSI0IiBmaWxsPSIjZmZmIiBmaWxsLW9wYWNpdHk9IjAuMDUiLz4KPC9zdmc+')]">
                </div>

                <div class="relative z-10 h-full flex flex-col justify-center items-center text-center">
                    <div class="mb-6 relative">
                        <div
                            class="absolute inset-0 bg-primary/20 blur-xl rounded-full scale-0 group-hover:scale-150 transition-transform duration-500">
                        </div>
                        <div
                            class="w-14 h-14 bg-primary/10 rounded-2xl flex items-center justify-center text-primary group-hover:scale-110 transition-transform duration-300 relative z-10 mx-auto group-hover:rotate-12">
                            <span
                                class="material-symbols-outlined text-3xl text-primary">filter_center_focus</span>
                        </div>
                    </div>
                    <h3 class="text-3xl font-bold mb-2">Clarity is Power.</h3>
                    <p class="text-slate-400 text-lg">Signal vs Noise. We cut through the clutter.</p>
                </div>
            </div>

            <!-- Card 3: Structure (Visual/Quote) - MOVED & RESIZED -->
            <div
                class="spotlight-card md:col-span-2 bg-gradient-to-tr from-blue-500/10 to-slate-50 dark:to-slate-900 rounded-3xl p-10 border border-slate-200 dark:border-slate-700 shadow-sm relative overflow-hidden group flex items-center justify-center">
                <!-- Decorative Lines -->
                <div
                    class="absolute inset-0 border-[1px] border-blue-500/20 scale-90 rounded-2xl opacity-0 group-hover:opacity-100 group-hover:scale-95 transition-all duration-500">
                </div>

                <div class="text-center relative z-10">
                    <span
                        class="block text-blue-500 font-mono text-xs mb-2 tracking-widest opacity-60">PRINCIPLE_04</span>
                    <h3 class="text-3xl font-black text-slate-900 dark:text-white leading-tight">
                        "Structure<br>Creates<br><span class="text-blue-500">Freedom.</span>"
                    </h3>
                </div>
            </div>

            <!-- Card 4: Premium Standard (Standard) - MOVED & RESIZED -->
            <div
                class="spotlight-card md:col-span-4 bg-white dark:bg-slate-800 rounded-3xl p-10 border border-slate-200 dark:border-slate-700 shadow-sm hover:shadow-xl hover:border-secondary/50 transition-all duration-300 relative overflow-hidden group">
                <div
                    class="absolute top-0 right-0 w-32 h-32 bg-secondary/5 rounded-bl-full transition-all duration-500 group-hover:w-full group-hover:h-full group-hover:rounded-none opacity-50">
                </div>

                <div class="relative z-10 h-full flex flex-col gap-12">
                    <div
                        class="w-14 h-14 bg-primary/10 rounded-2xl flex items-center justify-center text-primary group-hover:scale-110 transition-transform duration-300">
                        <span class="material-symbols-outlined text-3xl">diamond</span>
                    </div>
                    <div>
                        <h3 class="text-3xl font-bold mb-2">The Premium Standard</h3>
                        <p class="text-slate-500 dark:text-slate-400 text-lg">
                            Mediocrity is a disease. We craft experiences that feel inevitable, polished,
                            and world-class.
                        </p>
                    </div>
                </div>
            </div>

        </div>
    </div>
</section>

<!-- SECTION 4: METHODOLOGY - BLUEPRINT -->
<section id="methodology" class="relative py-32 bg-slate-50 dark:bg-background-dark overflow-hidden">
    <div class="absolute top-0 left-1/2 -translate-x-1/2 w-px h-full bg-slate-200 dark:bg-white/5"></div>
    <div
        class="process-line absolute top-0 left-1/2 -translate-x-1/2 w-[2px] bg-primary shadow-[0_0_15px_#f97316]">
    </div>

    <div class="max-w-4xl mx-auto px-6 relative z-10">
        <div class="text-center mb-20 reveal-on-scroll">
            <h2 class="font-display text-5xl font-bold text-slate-900 dark:text-white">Thought Architecture
            </h2>
            <p class="text-slate-500 dark:text-gray-400 mt-2 text-lg">How we engineer your digital legacy.
            </p>
        </div>

        <!-- Step 1 -->
        <div class="relative flex flex-col md:flex-row items-center gap-8 mb-24 group reveal-on-scroll">
            <div class="md:w-1/2 md:text-right">
                <h3 class="text-2xl font-bold text-slate-900 dark:text-white mb-2">01. Deconstruct</h3>
                <p class="text-slate-600 dark:text-gray-400">Dismantling the problem to its core.
                    Understanding First Principles before design begins.</p>
            </div>
            <div
                class="w-12 h-12 rounded-full bg-white dark:bg-background-dark border-2 border-secondary flex items-center justify-center shadow-[0_0_20px_rgba(249,115,22,0.3)] z-10 transition-transform group-hover:scale-110 duration-500">
                <span class="material-symbols-outlined text-secondary text-sm">search</span>
            </div>
            <div class="md:w-1/2"></div>
        </div>

        <!-- Step 2 -->
        <div
            class="relative flex flex-col md:flex-row-reverse items-center gap-8 mb-24 group reveal-on-scroll delay-100">
            <div class="md:w-1/2 md:text-left">
                <h3 class="text-2xl font-bold text-slate-900 dark:text-white mb-2">02. Architecture</h3>
                <p class="text-slate-600 dark:text-gray-400">Structuring the cognitive framework. Grids,
                    color systems, and information hierarchy arranged with precision.</p>
            </div>
            <div
                class="w-12 h-12 rounded-full bg-white dark:bg-background-dark border-2 border-primary flex items-center justify-center shadow-[0_0_20px_rgba(19,127,236,0.3)] z-10 transition-transform group-hover:scale-110 duration-500">
                <span class="material-symbols-outlined text-primary text-sm">architecture</span>
            </div>
            <div class="md:w-1/2"></div>
        </div>

        <!-- Step 3 -->
        <div class="relative flex flex-col md:flex-row items-center gap-8 group reveal-on-scroll delay-200">
            <div class="md:w-1/2 md:text-right">
                <h3 class="text-2xl font-bold text-slate-900 dark:text-white mb-2">03. Materialize</h3>
                <p class="text-slate-600 dark:text-gray-400">Visual execution with the highest aesthetic
                    standards. Every pixel has a reason.</p>
            </div>
            <div
                class="w-12 h-12 rounded-full bg-white dark:bg-background-dark border-2 border-slate-300 dark:border-white flex items-center justify-center shadow-lg dark:shadow-[0_0_20px_rgba(255,255,255,0.3)] z-10 transition-transform group-hover:scale-110 duration-500">
                <span
                    class="material-symbols-outlined text-slate-900 dark:text-white text-sm">diamond</span>
            </div>
            <div class="md:w-1/2"></div>
        </div>
    </div>
</section>

<!-- SECTION 5: THE TEAM - COLLECTIVE INTELLIGENCE -->
<section class="reveal-on-scroll py-32 bg-slate-50 dark:bg-slate-900 relative overflow-hidden">
    <!-- Background decoration -->
    <div
        class="absolute top-0 right-0 w-[500px] h-[500px] bg-secondary/5 rounded-full blur-3xl -translate-y-1/2 translate-x-1/2 pointer-events-none">
    </div>
    <div
        class="absolute bottom-0 left-0 w-[500px] h-[500px] bg-primary/5 rounded-full blur-3xl translate-y-1/2 -translate-x-1/2 pointer-events-none">
    </div>

    <div class="max-w-7xl mx-auto px-6 md:px-12 relative z-10">
        <div class="flex flex-col lg:flex-row items-center gap-16">

            <!-- Left: Large Team Photo (Landscape) -->
            <div class="w-full lg:w-3/5 order-2 lg:order-1">
                <div
                    class="relative group rounded-[40px] overflow-hidden shadow-2xl border border-white/20 dark:border-slate-700">
                    <!-- Main Image (Placeholder for Group) -->
                    <div class="aspect-video relative overflow-hidden">
                        <img src="https://images.unsplash.com/photo-1522071820081-009f0129c71c?ixlib=rb-4.0.3&auto=format&fit=crop&w=1600&q=80"
                            alt="Jarreva Team"
                            class="w-full h-full object-cover transition-transform duration-700 group-hover:scale-105">

                        <!-- Overlay Gradient -->
                        <div
                            class="absolute inset-0 bg-gradient-to-t from-slate-900/80 via-transparent to-transparent opacity-60 group-hover:opacity-40 transition-opacity duration-500">
                        </div>

                        <!-- Hover Reveal - Names/Roles (Optional) -->
                        <div
                            class="absolute bottom-0 left-0 right-0 p-8 transform translate-y-full group-hover:translate-y-0 transition-transform duration-500 ease-out bg-slate-900/90 backdrop-blur-md border-t border-white/10">
                            <div class="flex items-center justify-between text-white">
                                <div>
                                    <h4 class="font-bold text-lg">The Collective</h4>
                                    <p class="text-slate-400 text-sm">Designers, Engineers, Strategists</p>
                                </div>
                                <div class="flex -space-x-3">
                                    <!-- Avatars (Micro Representations) -->
                                    <div
                                        class="w-10 h-10 rounded-full border-2 border-slate-900 bg-slate-700">
                                    </div>
                                    <div
                                        class="w-10 h-10 rounded-full border-2 border-slate-900 bg-slate-600">
                                    </div>
                                    <div
                                        class="w-10 h-10 rounded-full border-2 border-slate-900 bg-slate-500">
                                    </div>
                                    <div
                                        class="w-10 h-10 rounded-full border-2 border-slate-900 bg-secondary flex items-center justify-center text-xs font-bold">
                                        +</div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Right: Content -->
            <div class="w-full lg:w-2/5 order-1 lg:order-2">
                <span
                    class="text-secondary font-bold tracking-widest uppercase text-xs border border-secondary/20 bg-secondary/10 px-3 py-1 rounded-full mb-6 inline-block">Our
                    People</span>
                <h2
                    class="text-4xl md:text-5xl font-black mb-6 leading-tight text-slate-900 dark:text-white">
                    Unified by <br><span class="text-blue-500">Purpose.</span>
                </h2>
                <p class="text-lg text-slate-600 dark:text-slate-400 mb-8 leading-relaxed">
                    Jarreva isn't just one person—it's a collective of builders obsessed with quality. We
                    operate as a single unit, combining diverse skills into a cohesive force for clarity.
                </p>

                <div class="space-y-6">
                    <div class="flex items-start gap-4">
                        <div
                            class="w-10 h-10 rounded-full bg-slate-100 dark:bg-slate-800 flex items-center justify-center shrink-0">
                            <span
                                class="material-symbols-outlined text-slate-900 dark:text-white">groups</span>
                        </div>
                        <div>
                            <h4 class="font-bold text-slate-900 dark:text-white">Shared Vision</h4>
                            <p class="text-sm text-slate-500">Every member aligns on the core mission:
                                removing noise.</p>
                        </div>
                    </div>
                    <div class="flex items-start gap-4">
                        <div
                            class="w-10 h-10 rounded-full bg-slate-100 dark:bg-slate-800 flex items-center justify-center shrink-0">
                            <span
                                class="material-symbols-outlined text-slate-900 dark:text-white">engineering</span>
                        </div>
                        <div>
                            <h4 class="font-bold text-slate-900 dark:text-white">Relentless Craft</h4>
                            <p class="text-sm text-slate-500">We don't ship until it meets our exacting
                                standards.</p>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
</section>
@endsection

@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', () => {
        // 1. Intersection Observer for Reveals
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

        document.querySelectorAll('.reveal-on-scroll').forEach(section => {
            observer.observe(section);
        });

        // 2. Spotlight Effect for Cards
        document.querySelectorAll('.spotlight-card').forEach(card => {
            card.addEventListener('mousemove', e => {
                const rect = card.getBoundingClientRect();
                const x = e.clientX - rect.left;
                const y = e.clientY - rect.top;
                card.style.setProperty('--mouse-x', `${x}px`);
                card.style.setProperty('--mouse-y', `${y}px`);
            });
        });

        // 3. Process Line Scroll Animation
        const processSection = document.getElementById('methodology');
        const processLine = document.querySelector('.process-line');

        if (processSection && processLine) {
            window.addEventListener('scroll', () => {
                const rect = processSection.getBoundingClientRect();
                const windowHeight = window.innerHeight;

                // Start animating when the section is in the viewport
                if (rect.top < windowHeight * 0.6 && rect.bottom > 0) {
                    const totalHeight = rect.height * 0.8; // Approximate track length
                    const startOffset = windowHeight * 0.6;
                    const scrolled = startOffset - rect.top;
                    const percentage = Math.min(Math.max(scrolled / totalHeight, 0), 1);
                    processLine.style.height = `${percentage * 100}%`;
                }
            });
        }
    });
</script>
@endpush
