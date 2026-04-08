@extends('public.layouts.app')

@section('title', 'Jarreva Creative - Catalog Portfolio')

@section('content')
    <!-- Cinematic Hero Section -->
    <div class="relative min-h-[30vh] lg:min-h-screen overflow-hidden bg-white dark:bg-background-dark flex items-start lg:items-center pt-32 lg:pt-0 pb-6 lg:pb-24" id="cinematic-hero">
        <!-- Background Gradients -->
        <div class="absolute inset-0 z-0 pointer-events-none overflow-hidden">
            <div class="absolute top-0 left-0 w-full h-32 lg:h-48 bg-gradient-to-t from-transparent to-white dark:to-background-dark z-20"></div>
            <div class="absolute inset-0 bg-gradient-to-br from-white via-white to-orange-50/50 dark:from-background-dark dark:via-background-dark dark:to-blue-900/10"></div>
            
            <!-- Soft Ambient Light -->
            <div class="absolute top-1/4 -left-[10%] w-[50%] h-[50%] rounded-full bg-orange-400/5 dark:bg-orange-500/10 blur-[120px] mix-blend-multiply dark:mix-blend-screen opacity-80 animate-pulse-slow"></div>
            <div class="absolute bottom-1/4 -right-[10%] w-[60%] h-[60%] rounded-full bg-blue-500/5 dark:bg-blue-600/10 blur-[120px] mix-blend-multiply dark:mix-blend-screen opacity-70 animate-pulse-slow"></div>
        </div>

        <div class="relative z-10 w-full max-w-7xl px-6 md:px-12 mx-auto h-full flex flex-col lg:flex-row items-center gap-4 lg:gap-8 pb-10 lg:-translate-y-8">
            
            <!-- LEFT: TEXT CONTENT (50%) -->
            <div class="w-full lg:w-1/2 flex flex-col justify-center text-center lg:text-left relative z-30 pt-4 lg:pt-0 order-2 lg:order-1">
                <!-- Removed Premium Collection Badge -->

                <h1 class="stagger-2 opacity-0 translate-y-6 mb-6 font-display text-[42px] sm:text-5xl md:text-6xl lg:text-7xl font-bold tracking-tight leading-[1.05] text-slate-900 dark:text-white drop-shadow-sm">
                    Discover Our<br/>
                    <span class="relative inline-block pb-1">
                        <span class="text-transparent bg-clip-text bg-gradient-to-r from-primary to-secondary relative z-10">Portfolio</span>
                    </span>
                </h1>

                <p class="stagger-3 opacity-0 translate-y-4 max-w-lg mx-auto lg:mx-0 text-base lg:text-lg text-slate-600 dark:text-slate-300 leading-relaxed font-medium mb-10">
                    Explore a curated collection of our best projects, publications, and creative endeavors that define Jarreva Creative's commitment to excellence.
                </p>

                <div class="stagger-4 opacity-0 translate-y-4">
                    <a href="#catalog-grid" onclick="event.preventDefault(); document.querySelector('#catalog-grid').scrollIntoView({behavior: 'smooth'});" class="group relative px-10 py-3.5 bg-slate-900 dark:bg-white text-white dark:text-slate-900 rounded-full font-semibold text-[15px] tracking-wide overflow-hidden transition-all duration-300 hover:scale-[1.03] hover:shadow-xl hover:shadow-primary/30 inline-flex items-center justify-center cursor-pointer">
                        <span class="relative z-10">Explore</span>
                    </a>
                </div>
            </div>

            <!-- RIGHT: 3D BOOK COMPOSITION & TABLE (50%) -->
            @php
                $bookImages = glob(public_path('images/books/*.{jpg,jpeg,png,gif,webp}'), GLOB_BRACE) ?: [];
                $bookImages = array_map(function($path) {
                    return asset('images/books/' . basename($path));
                }, $bookImages);
                
                if (count($bookImages) >= 3) {
                    $keys = array_rand($bookImages, 3);
                    $imgLeft = $bookImages[$keys[0]];
                    $imgMain = $bookImages[$keys[1]];
                    $imgRight = $bookImages[$keys[2]];
                } else {
                    $imgLeft = 'https://placehold.co/860x1216/e2e8f0/64748b?text=Your+Left+Book+Image';
                    $imgMain = 'https://placehold.co/860x1216/f8f9fa/1e293b?text=Your+Main+Book+Image';
                    $imgRight = 'https://placehold.co/860x1216/fff7ed/ea580c?text=Your+Right+Book+Image';
                }
            @endphp
            <div class="hidden lg:block w-full lg:w-1/2 h-[380px] lg:h-[700px] relative z-10 hero-perspective order-1 lg:order-2" id="3d-scene">
                
                <!-- THE TABLE / SURFACE LAYER (BOTTOM) -->
                <div class="absolute bottom-0 left-1/2 -translate-x-1/2 w-[150%] lg:w-[120%] h-[300px] lg:h-[400px] table-surface rounded-t-full border-t border-slate-200/80 dark:border-slate-600/50 shadow-[0_-20px_50px_rgba(0,0,0,0.03)] dark:shadow-[0_-20px_50px_rgba(0,0,0,0.3)] bg-gradient-to-b from-slate-100/60 to-white dark:from-slate-800 dark:to-background-dark z-0">
                    <!-- Reflection Highight on Table -->
                    <div class="absolute top-0 left-1/2 -translate-x-1/2 w-3/4 h-[100px] bg-gradient-to-b from-white/60 dark:from-white/5 to-transparent blur-xl"></div>
                </div>

                <!-- 3D BOOKS LAYER (TRIPTYCH PANEL LAYOUT) -->
                <div class="absolute inset-0 w-full h-full z-10 flex flex-row items-center justify-center gap-2 lg:gap-4 transform-style-3d scene-rotator lg:pt-16" id="book-rotator">
                    
                    <!-- LEFT BOOK (Volume III, BLUE) -->
                    <div class="relative z-10 scale-[0.9] lg:scale-[1]">
                        <div class="float-delay-1">
                            <div class="book-3d w-[90px] lg:w-[150px] aspect-[860/1216] transform-style-3d group cursor-pointer hover-lift transition-transform duration-700 ease-out" style="transform: translateZ(0px) rotateY(3deg) rotateX(2deg);">
                            <div class="absolute inset-0 bg-white dark:bg-slate-900 border border-slate-200 dark:border-slate-700 rounded-r-md shadow-[0_15px_30px_rgba(0,0,0,0.1)] overflow-hidden front pointer-events-auto group-hover:border-blue-400/50 transition-colors">
                                <!-- USER IMAGE FOR LEFT BOOK -->
                                <img src="{{ $imgLeft }}" alt="Left Book Cover" class="w-full h-full object-cover">
                                
                                <!-- Realistic Book Hinge Shadow Overlay -->
                                <div class="absolute top-0 left-0 w-3 h-full bg-black/10 dark:bg-black/30 shadow-[1px_0_2px_rgba(255,255,255,0.2)_inset] pointer-events-none"></div>
                            </div>
                            <div class="absolute inset-0 bg-slate-300 dark:bg-slate-900 border border-slate-400 dark:border-slate-800 rounded-r-md back"></div>
                            <div class="absolute left-0 top-0 w-[40px] h-full bg-slate-200 dark:bg-slate-800 border-l border-r border-slate-300 dark:border-slate-900 spine"></div>
                            <div class="absolute right-0 top-[2px] w-[40px] h-[calc(100%-4px)] pages text-page-color page-right"></div>
                            <div class="absolute top-0 left-[2px] w-[calc(100%-4px)] h-[40px] pages text-page-color page-top"></div>
                            <div class="absolute bottom-0 left-[2px] w-[calc(100%-4px)] h-[40px] pages text-page-color page-bottom"></div>
                        </div>
                        </div>
                    </div>

                    <!-- CENTER BOOK (The Artifact, MAIN TALL PANEL) -->
                    <div class="relative z-30 scale-100 lg:scale-[1.1]">
                        <div class="float-main">
                            <div class="book-3d w-[130px] lg:w-[210px] aspect-[860/1216] transform-style-3d group cursor-pointer hover-lift-main transition-transform duration-700 ease-out" style="transform: translateZ(30px) rotateY(0deg) rotateX(0deg);">
                            <div class="absolute inset-0 bg-white dark:bg-slate-900 border border-slate-200 dark:border-slate-700 rounded-lg shadow-[0_25px_50px_rgba(0,0,0,0.15)] overflow-hidden front group-hover:border-primary/40 transition-colors pointer-events-auto">
                                <!-- USER IMAGE FOR CENTER BOOK -->
                                <img src="{{ $imgMain }}" alt="Main Book Cover" class="w-full h-full object-cover">
                                
                                <!-- Realistic Book Hinge Shadow Overlay -->
                                <div class="absolute top-0 left-0 w-3 h-full bg-gradient-to-r from-black/20 to-transparent shadow-[2px_0_4px_rgba(255,255,255,0.4)_inset] pointer-events-none"></div>
                                <div class="absolute inset-0 bg-gradient-to-tr from-primary/0 to-secondary/0 group-hover:from-primary/10 group-hover:to-secondary/10 transition-colors duration-700 pointer-events-none"></div>
                            </div>
                            <div class="absolute inset-0 bg-slate-200 dark:bg-slate-900 border border-slate-300 dark:border-slate-800 rounded-lg back"></div>
                            <div class="absolute left-0 top-0 w-[45px] h-full bg-slate-100 dark:bg-[#0a0e17] border-l border-r border-slate-300 border-slate-800/80 spine flex flex-col items-center justify-center py-8 rotate-180">
                                <span class="writing-vertical-rl text-[7px] lg:text-[8px] text-slate-400 tracking-widest font-bold rotate-180">THE ARTIFACT</span>
                            </div>
                            <div class="absolute right-0 top-[2px] w-[45px] h-[calc(100%-4px)] pages text-page-color page-right"></div>
                            <div class="absolute top-0 left-[3px] w-[calc(100%-6px)] h-[45px] pages text-page-color page-top"></div>
                            <div class="absolute bottom-0 left-[3px] w-[calc(100%-6px)] h-[45px] pages text-page-color page-bottom"></div>
                        </div>
                        </div>
                    </div>

                    <!-- RIGHT BOOK (The Shift, ORANGE) -->
                    <div class="relative z-20 scale-[0.9] lg:scale-[1]">
                        <div class="float-delay-2">
                            <div class="book-3d w-[95px] lg:w-[155px] aspect-[860/1216] transform-style-3d group cursor-pointer hover-lift transition-transform duration-700 ease-out" style="transform: translateZ(0px) rotateY(-3deg) rotateX(2deg);">
                            <div class="absolute inset-0 bg-white dark:bg-slate-900 border border-slate-200 dark:border-slate-700 rounded-r-md shadow-[0_15px_30px_rgba(0,0,0,0.1)] overflow-hidden front pointer-events-auto group-hover:border-orange-400/50 transition-colors">
                                <!-- USER IMAGE FOR RIGHT BOOK -->
                                <img src="{{ $imgRight }}" alt="Right Book Cover" class="w-full h-full object-cover">
                                
                                <!-- Realistic Book Hinge Shadow Overlay -->
                                <div class="absolute top-0 left-0 w-3 h-full bg-black/10 dark:bg-black/30 shadow-[1px_0_2px_rgba(255,255,255,0.2)_inset] pointer-events-none"></div>
                            </div>
                            <div class="absolute inset-0 bg-slate-300 dark:bg-slate-900 border border-slate-400 dark:border-slate-800 rounded-r-md back"></div>
                            <div class="absolute left-0 top-0 w-[40px] h-full bg-orange-100 dark:bg-[#1a1311] border-l border-r border-orange-200 dark:border-orange-900/50 spine"></div>
                            <div class="absolute right-0 top-[2px] w-[40px] h-[calc(100%-4px)] pages text-page-color page-right"></div>
                            <div class="absolute top-0 left-[2px] w-[calc(100%-4px)] h-[40px] pages text-page-color page-top"></div>
                            <div class="absolute bottom-0 left-[2px] w-[calc(100%-4px)] h-[40px] pages text-page-color page-bottom"></div>
                        </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>

        <!-- Seamless blending gradient to the next section -->
        <div class="hidden lg:block absolute -bottom-2 left-0 w-full h-48 bg-gradient-to-t from-white via-white/90 dark:from-background-dark dark:via-background-dark/90 to-transparent pointer-events-none z-20"></div>

        <style>
            .hero-perspective {
                perspective: 1500px;
                -webkit-perspective: 1500px;
                perspective-origin: 50% 50%;
            }

            .transform-style-3d {
                transform-style: preserve-3d;
                -webkit-transform-style: preserve-3d;
            }

            /* Table Surface Styling */
            .table-surface {
                transform-origin: bottom;
                transform: rotateX(75deg) translateZ(-150px) translateY(100px);
                /* Linear gradient simulating distance falloff */
                mask-image: linear-gradient(to top, rgba(0,0,0,1) 30%, rgba(0,0,0,0) 100%);
                -webkit-mask-image: linear-gradient(to top, rgba(0,0,0,1) 30%, rgba(0,0,0,0) 100%);
            }

            /* Realistic 3D Book Construction */
            .book-3d {
                position: relative;
            }
            .book-3d .front { transform: translateZ(calc(var(--thick, 45px)/2)); }
            .book-3d .back { transform: translateZ(calc(var(--thick, 45px)/-2)) rotateY(180deg); }
            
            .book-3d .spine {
                transform-origin: left center;
                transform: rotateY(-90deg) translateX(calc(var(--thick, 45px)/-2));
            }
            
            .book-3d .page-right {
                transform-origin: right center;
                transform: rotateY(90deg) translateX(calc(var(--thick, 45px)/2));
            }
            
            .book-3d .page-top {
                transform-origin: top center;
                transform: rotateX(90deg) translateY(calc(var(--thick, 45px)/-2));
            }

            .book-3d .page-bottom {
                transform-origin: bottom center;
                transform: rotateX(-90deg) translateY(calc(var(--thick, 45px)/2));
            }

            /* Set individual thicknesses */
            .float-delay-1 .book-3d { --thick: 40px; }
            .float-delay-2 .book-3d { --thick: 35px; }
            .float-main .book-3d { --thick: 45px; }

            /* Page realistic lines */
            .text-page-color {
                background-color: #f1f5f9;
            }
            :is(.dark) .text-page-color {
                background-color: #cbd5e1;
            }
            .pages {
                background-image: repeating-linear-gradient(
                    to right,
                    rgba(0,0,0,0.05) 0px,
                    rgba(0,0,0,0) 2px,
                    rgba(0,0,0,0.05) 4px
                );
                box-shadow: inset 0 0 10px rgba(0,0,0,0.1);
            }
            .page-top, .page-bottom {
                background-image: repeating-linear-gradient(
                    to bottom,
                    rgba(0,0,0,0.05) 0px,
                    rgba(0,0,0,0) 2px,
                    rgba(0,0,0,0.05) 4px
                );
            }

            /* Vertical Text for Spine */
            .writing-vertical-rl {
                writing-mode: vertical-rl;
            }

            /* Hover Lifts */
            .hover-lift:hover {
                transform: translateZ(-20px) translateY(-15px) rotateY(-20deg) scale(1.05) !important;
            }
            .hover-lift-main:hover {
                transform: translateZ(100px) translateY(-20px) rotateY(0deg) scale(1.05) !important;
            }

            /* Smooth Slow Float Animations using translate to avoid fighting Tailwind scales */
            @keyframes floatOrganic {
                0%, 100% { translate: 0 0; }
                50% { translate: 0 -12px; }
            }

            /* Cinematic 3D Entrance Sequence */
            @keyframes bookReveal {
                0% { opacity: 0; translate: 0 60px; scale: 0.8; }
                100% { opacity: 1; translate: 0 0; scale: 1; }
            }

            .float-main { animation: bookReveal 1.6s cubic-bezier(0.16, 1, 0.3, 1) 0.2s backwards, floatOrganic 8s ease-in-out infinite 1.8s; }
            .float-delay-1 { animation: bookReveal 1.6s cubic-bezier(0.16, 1, 0.3, 1) 0.4s backwards, floatOrganic 6s ease-in-out infinite 2.0s; }
            .float-delay-2 { animation: bookReveal 1.6s cubic-bezier(0.16, 1, 0.3, 1) 0.6s backwards, floatOrganic 7s ease-in-out infinite 2.2s; }

            /* Text Stagger Reveal */
            @keyframes revealUp {
                0% { opacity: 0; transform: translateY(20px); }
                100% { opacity: 1; transform: translateY(0); }
            }
            .stagger-1 { animation: revealUp 0.8s ease-out 0.2s forwards; }
            .stagger-2 { animation: revealUp 0.8s ease-out 0.3s forwards; }
            .stagger-3 { animation: revealUp 0.8s ease-out 0.4s forwards; }
            .stagger-4 { animation: revealUp 0.8s ease-out 0.5s forwards; }

            @keyframes pulse-slow {
                0%, 100% { opacity: 0.6; transform: scale(1); }
                50% { opacity: 0.8; transform: scale(1.05); }
            }
            .animate-pulse-slow {
                animation: pulse-slow 8s infinite;
            }

        </style>

        <!-- Subtle Parallax Mouse Script -->
        <script>
            document.addEventListener('DOMContentLoaded', () => {
                const scene = document.getElementById('3d-scene');
                const rotator = document.getElementById('book-rotator');
                if(!scene || !rotator || window.innerWidth < 1024) return;

                // Hardware acceleration for the rotating container
                rotator.style.willChange = 'transform';

                let state = { currentX: 0, currentY: 0, targetX: 0, targetY: 0 };
                
                scene.addEventListener('mousemove', (e) => {
                    const rect = scene.getBoundingClientRect();
                    // Normalize position from -1 to 1
                    const x = ((e.clientX - rect.left) / rect.width) * 2 - 1;
                    const y = ((e.clientY - rect.top) / rect.height) * 2 - 1;
                    
                    // Constrain max rotation for subtlety (Premium feel)
                    state.targetX = x * 8; 
                    state.targetY = y * -5; 
                });

                scene.addEventListener('mouseleave', () => {
                    state.targetX = 0; 
                    state.targetY = 0;
                });

                function loop() {
                    // Fast and buttery smooth lerp interpolation
                    state.currentX += (state.targetX - state.currentX) * 0.08;
                    state.currentY += (state.targetY - state.currentY) * 0.08;
                    
                    // Use toFixed to eliminate sub-pixel floating point jitter during resting state
                    rotator.style.transform = `rotateY(${state.currentX.toFixed(3)}deg) rotateX(${state.currentY.toFixed(3)}deg)`;
                    
                    requestAnimationFrame(loop);
                }
                loop();
            });
        </script>
    </div>
    


    <!-- Catalog Grid Section -->

    <!-- Catalog Grid Section -->
    <div id="catalog-grid" class="container mx-auto px-4 pb-16 pt-16 lg:pt-0 lg:pb-24 lg:-mt-16 relative z-30">

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
                                class="w-full h-full object-cover rounded-md shadow-lg border-l-[3px] border-slate-900/10 transform transition-transform duration-700 cubic-bezier(0.2, 0.8, 0.2, 1) group-hover:scale-105 relative z-10" />
                        @else
                            <div
                                class="w-full h-full flex flex-col items-center justify-center bg-gradient-to-br from-slate-200 to-slate-300 dark:from-slate-700 dark:to-slate-800 rounded-md shadow-lg border-l-[3px] border-slate-900/10 transform transition-transform duration-700 cubic-bezier(0.2, 0.8, 0.2, 1) group-hover:scale-105 relative z-10">
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