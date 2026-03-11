@extends('public.layouts.app')

@section('title', 'Jarreva Creative - Public Landing Page')

@push('styles')
<style>
html {
            scroll-behavior: smooth;
        }

        body {
            font-family: 'Montserrat', sans-serif;
        }

        @keyframes trace {
            0% {
                stroke-dashoffset: 2000;
                opacity: 0;
            }

            10% {
                opacity: 1;
            }

            80% {
                opacity: 1;
            }

            100% {
                stroke-dashoffset: 0;
                opacity: 0;
            }
        }

        .animate-trace {
            stroke-dasharray: 20 2000;
            stroke-dashoffset: 2000;
            animation: trace 2s linear infinite;
            stroke-linecap: round;
        }

        .animate-trace-delayed-1 {
            animation-delay: 0s;
        }

        .animate-trace-delayed-2 {
            animation-delay: 0.3s;
        }

        .animate-trace-delayed-3 {
            animation-delay: 0.6s;
        }

        @keyframes pulse-glow {

            0%,
            100% {
                filter: drop-shadow(0 0 5px rgba(19, 127, 236, 0.3));
                transform: scale(1);
            }

            50% {
                filter: drop-shadow(0 0 15px rgba(19, 127, 236, 0.6));
                transform: scale(1.02);
            }
        }

        .book-pulse {
            animation: pulse-glow 3s ease-in-out infinite;
        }

        .carousel-scene {
            perspective: 2000px;
        }

        .carousel-cylinder {
            transform-style: preserve-3d;
        }

        .carousel-cylinder:hover {
            cursor: grab;
        }

        .carousel-cylinder:active {
            cursor: grabbing;
        }

        @keyframes float-node {

            0%,
            100% {
                transform: translateY(0);
            }

            50% {
                transform: translateY(-15px);
            }
        }

        .animate-float {
            animation: float-node 5s ease-in-out infinite;
        }

        .animate-float-delayed-1 {
            animation-delay: 1s;
        }

        .animate-float-delayed-2 {
            animation-delay: 2s;
        }

        .animate-float-delayed-3 {
            animation-delay: 3s;
        }

        .animate-float-delayed-4 {
            animation-delay: 4s;
        }

        @keyframes sun-pulse-core {

            0%,
            100% {
                box-shadow: 0 0 30px rgba(249, 115, 22, 0.3);
                transform: scale(1);
            }

            50% {
                box-shadow: 0 0 80px rgba(19, 127, 236, 0.5);
                transform: scale(1.05);
            }
        }

        .sun-core-animate {
            animation: sun-pulse-core 4s infinite ease-in-out;
        }

        @keyframes ripple {
            0% {
                transform: scale(1);
                opacity: 0.6;
            }

            100% {
                transform: scale(2.5);
                opacity: 0;
            }
        }

        .animate-ripple {
            animation: ripple 1.5s cubic-bezier(0, 0.2, 0.8, 1) infinite;
        }

        .reveal-on-scroll {
            opacity: 0;
            transform: translateY(30px);
            transition: opacity 0.8s ease-out, transform 0.8s ease-out;
            will-change: opacity, transform;
        }

        .reveal-on-scroll.is-visible {
            opacity: 1;
            transform: translateY(0);
        }

        @keyframes node-pulse-blue {
            0% {
                box-shadow: 0 0 0 0 rgba(19, 127, 236, 0.4);
            }

            70% {
                box-shadow: 0 0 0 20px rgba(19, 127, 236, 0);
            }

            100% {
                box-shadow: 0 0 0 0 rgba(19, 127, 236, 0);
            }
        }

        @keyframes node-pulse-orange {
            0% {
                box-shadow: 0 0 0 0 rgba(249, 115, 22, 0.4);
            }

            70% {
                box-shadow: 0 0 0 20px rgba(249, 115, 22, 0);
            }

            100% {
                box-shadow: 0 0 0 0 rgba(249, 115, 22, 0);
            }
        }

        @keyframes node-pulse-indigo {
            0% {
                box-shadow: 0 0 0 0 rgba(99, 102, 241, 0.4);
            }

            70% {
                box-shadow: 0 0 0 20px rgba(99, 102, 241, 0);
            }

            100% {
                box-shadow: 0 0 0 0 rgba(99, 102, 241, 0);
            }
        }

        @keyframes node-pulse-teal {
            0% {
                box-shadow: 0 0 0 0 rgba(20, 184, 166, 0.4);
            }

            70% {
                box-shadow: 0 0 0 20px rgba(20, 184, 166, 0);
            }

            100% {
                box-shadow: 0 0 0 0 rgba(20, 184, 166, 0);
            }
        }

        @keyframes node-pulse-pink {
            0% {
                box-shadow: 0 0 0 0 rgba(236, 72, 153, 0.4);
            }

            70% {
                box-shadow: 0 0 0 20px rgba(236, 72, 153, 0);
            }

            100% {
                box-shadow: 0 0 0 0 rgba(236, 72, 153, 0);
            }
        }

        .hover-pulse-blue:hover .node-core {
            animation: node-pulse-blue 1.5s infinite;
        }

        .hover-pulse-orange:hover .node-core {
            animation: node-pulse-orange 1.5s infinite;
        }

        .hover-pulse-indigo:hover .node-core {
            animation: node-pulse-indigo 1.5s infinite;
        }

        .hover-pulse-teal:hover .node-core {
            animation: node-pulse-teal 1.5s infinite;
        }

        .hover-pulse-pink:hover .node-core {
            animation: node-pulse-pink 1.5s infinite;
        }

        @keyframes scroll-marquee {
            0% {
                transform: translateX(0);
            }

            100% {
                transform: translateX(-50%);
            }
        }

        .animate-scroll-marquee {
            animation: scroll-marquee 40s linear infinite;
        }

        .animate-scroll-marquee:hover {
            animation-play-state: paused;
        }

        @keyframes shake-subtle {
            0% {
                transform: translate(0, 0) rotate(0deg);
            }

            10% {
                transform: translate(-1px, -1px) rotate(-1deg);
            }

            20% {
                transform: translate(1px, 1px) rotate(1deg);
            }

            30% {
                transform: translate(-2px, 0) rotate(0deg);
            }

            40% {
                transform: translate(1px, -1px) rotate(1deg);
            }

            50% {
                transform: translate(-1px, 1px) rotate(-1deg);
            }

            60% {
                transform: translate(1px, 0) rotate(0deg);
            }

            70% {
                transform: translate(-1px, -1px) rotate(1deg);
            }

            80% {
                transform: translate(0, 1px) rotate(-1deg);
            }

            90% {
                transform: translate(0, 0) rotate(0deg);
            }

            100% {
                transform: translate(0, 0) rotate(0deg);
            }
        }

        .group:hover .animate-shake-icon {
            animation: shake-subtle 0.6s cubic-bezier(.36, .07, .19, .97) both;
            transform: translate3d(0, 0, 0);
            backface-visibility: hidden;
            perspective: 1000px;
        }

        @keyframes scroll-vertical {
            0% {
                transform: translateY(0);
            }

            100% {
                transform: translateY(-50%);
            }
        }

        .animate-scroll-vertical {
            animation: scroll-vertical 15s linear infinite;
        }

        @keyframes device-pulse-blue {
            0% {
                box-shadow: 0 0 0 0 rgba(19, 127, 236, 0.4);
            }

            50% {
                box-shadow: 0 0 25px 5px rgba(19, 127, 236, 0.2);
            }

            100% {
                box-shadow: 0 0 0 0 rgba(19, 127, 236, 0);
            }
        }

        .animate-plr-pulse {
            animation: device-pulse-blue 3s ease-in-out infinite;
        }

        @keyframes smooth-float {

            0%,
            100% {
                transform: translateY(0);
            }

            50% {
                transform: translateY(-12px);
            }
        }

        .animate-smooth-float {
            animation: smooth-float 6s ease-in-out infinite;
        }

        /* NEW ANIMATIONS FROM ABOUT.HTML */
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

        .delay-100 {
            transition-delay: 100ms;
        }

        .delay-200 {
            transition-delay: 200ms;
        }

        .delay-300 {
            transition-delay: 300ms;
        }

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

        .spotlight-card {
            position: relative;
            overflow: hidden;
        }

        .spotlight-card::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: radial-gradient(800px circle at var(--mouse-x) var(--mouse-y), rgba(249, 115, 22, 0.06), transparent 40%);
            opacity: 0;
            transition: opacity 0.5s;
            pointer-events: none;
            z-index: 2;
        }

        .spotlight-card:hover::before {
            opacity: 1;
        }
</style>
@endpush

@section('content')
<section
                class="reveal-on-scroll relative z-0 flex min-h-[90vh] w-full items-center justify-center overflow-hidden pt-24 pb-24 lg:pt-32 bg-white dark:bg-background-dark">
                
                <!-- 3D Hero Background -->
                @include('public.components.hero-3d-bg')

                <div
                    class="absolute inset-0 z-0 bg-[linear-gradient(to_right,#80808012_1px,transparent_1px),linear-gradient(to_bottom,#80808012_1px,transparent_1px)] bg-[size:24px_24px] pointer-events-none mix-blend-overlay opacity-50 dark:opacity-20">
                </div>
                <div class="relative z-10 w-full max-w-7xl px-6 md:px-12 flex flex-col items-center text-center">
                    <!-- System Intelligence Status -->
                    <div class="group relative mb-12 inline-flex items-center gap-3 rounded-full border border-slate-200 bg-white/50 backdrop-blur-md px-4 py-2 shadow-sm hover:border-secondary/30 transition-all duration-500">
                        <div class="relative flex h-3 w-3">
                            <span class="animate-ping absolute inline-flex h-full w-full rounded-full bg-primary opacity-75"></span>
                            <span class="relative inline-flex rounded-full h-3 w-3 bg-primary"></span>
                        </div>
                        <div class="flex items-center gap-2 text-sm font-medium text-slate-600 font-mono">
                            <span class="text-xs text-slate-400 uppercase tracking-wider">System Status:</span>
                            <span id="system-status-text" class="text-slate-900 font-bold typing-effect">Initializing...</span>
                            <span class="animate-blink text-primary">_</span>
                        </div>
                    </div>

                    <script>
                        document.addEventListener('DOMContentLoaded', () => {
                            const statusText = document.getElementById('system-status-text');
                            const messages = [
                                "Building Mental Structure",
                                "Designing Clear Thinking",
                                "Reducing Noise",
                                "Creating Functional Systems",
                                "Signal Received"
                            ];
                            let msgIndex = 0;
                            let charIndex = 0;
                            let isDeleting = false;

                            function typeWriter() {
                                const currentMsg = messages[msgIndex];

                                if (isDeleting) {
                                    statusText.textContent = currentMsg.substring(0, charIndex - 1);
                                    charIndex--;
                                } else {
                                    statusText.textContent = currentMsg.substring(0, charIndex + 1);
                                    charIndex++;
                                }

                                let typeSpeed = isDeleting ? 30 : 50;

                                if (!isDeleting && charIndex === currentMsg.length) {
                                    typeSpeed = 2000; // Pause at end
                                    isDeleting = true;
                                } else if (isDeleting && charIndex === 0) {
                                    isDeleting = false;
                                    msgIndex = (msgIndex + 1) % messages.length;
                                    typeSpeed = 500; // Pause before next
                                }

                                setTimeout(typeWriter, typeSpeed);
                            }

                            typeWriter();
                        });
                    </script>
                    <h1
                        class="mb-6 font-display text-5xl font-bold tracking-tight leading-[1.1] sm:text-6xl md:text-7xl lg:text-7xl dark:text-white drop-shadow-sm max-w-5xl">
                        Why Does Your Life<br class="hidden md:block" />
                        <span
                            class="text-transparent bg-clip-text bg-gradient-to-r from-blue-500 to-orange-500 animate-gradient">Feel
                            Stuck Like This?</span>
                    </h1>
                    <p
                        class="max-w-2xl text-lg text-gray-600 dark:text-gray-300 sm:text-xl leading-relaxed mb-10 font-medium reveal-on-scroll delay-100">
                        You wake up. Grab your phone. Scroll. Just for a second, then one hour disappears. You know it's
                        wrong, but you repeat it anyway.
                    </p>
                    <div
                        class="flex flex-col sm:flex-row items-center gap-4 w-full justify-center reveal-on-scroll delay-200">
                        <a href="{{ route('evolve') }}"
                            class="group relative flex h-14 items-center justify-center gap-2 rounded-full bg-primary px-8 text-base font-bold text-white transition-all hover:bg-orange-600 hover:shadow-lg w-full sm:w-auto shadow-orange-200/50">
                            Explore Library
                            <span
                                class="material-symbols-outlined text-white transition-transform group-hover:translate-x-1">arrow_forward</span>
                        </a>
                    </div>
                </div>
            </section>
            <section
                class="reveal-on-scroll relative z-10 w-full overflow-hidden bg-slate-950 py-24 rounded-[40px] shadow-2xl border border-slate-800 hover:border-slate-700 transition-colors duration-700 group">
                <!-- Clean Minimal Background -->
                <div class="absolute inset-0 pointer-events-none overflow-hidden">
                    <div
                        class="absolute inset-0 bg-[linear-gradient(to_right,#ffffff03_1px,transparent_1px),linear-gradient(to_bottom,#ffffff03_1px,transparent_1px)] bg-[size:48px_48px]">
                    </div>
                    <div
                        class="absolute top-0 left-1/2 -translate-x-1/2 w-[600px] h-[400px] bg-secondary/10 blur-[100px] rounded-full pointer-events-none mix-blend-screen">
                    </div>
                </div>

                <div class="mx-auto max-w-7xl px-6 flex flex-col items-center justify-center mb-24 relative z-10">
                    <div>
                        <div
                            class="inline-flex items-center gap-2 rounded-full border border-secondary/20 bg-white shadow-sm px-4 py-1.5 mb-6">
                            <div class="h-2 w-2 rounded-full bg-secondary animate-pulse"></div>
                            <span class="text-xs font-bold text-secondary uppercase tracking-widest">Stop
                                wasting opportunities</span>
                        </div>
                    </div>
                    <h2
                        class="font-display text-4xl md:text-5xl font-bold text-white text-center mb-6 leading-tight max-w-4xl mx-auto">
                        The Big Problem With Gen Z Is <span
                            class="text-transparent bg-clip-text bg-gradient-to-r from-blue-500 to-orange-500">Not Lack Of
                            Motivation</span>
                    </h2>
                    <p
                        class="text-lg md:text-xl font-medium text-gray-400 text-center max-w-2xl mx-auto mb-16 leading-relaxed">
                        You know you need products, offers, and lead magnets to grow. But instead of selling and
                        scaling, you’re stuck:
                    </p>
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-6 w-full max-w-5xl">
                        <div
                            class="spotlight-card bg-slate-900/40 backdrop-blur-sm rounded-[2rem] p-8 border border-slate-800 shadow-xl flex flex-col items-center text-center transform transition-all duration-300 hover:-translate-y-2 group hover:bg-slate-900/60 hover:border-primary/50 hover:shadow-[0_0_30px_rgba(249,115,22,0.15)] relative overflow-hidden">
                            <div
                                class="w-16 h-16 bg-primary/10 rounded-2xl flex items-center justify-center mb-6 shadow-inner group-hover:scale-110 transition-transform duration-300">
                                <span class="material-symbols-outlined text-primary text-3xl font-bold">close</span>
                            </div>
                            <h3 class="font-display text-xl font-bold text-white leading-snug mb-2">
                                Undisciplined
                            </h3>
                            <p class="text-gray-400 text-sm leading-relaxed">
                                You know exactly what to do, but you just don't do it.
                            </p>
                        </div>
                        <div
                            class="spotlight-card bg-slate-900/40 backdrop-blur-sm rounded-[2rem] p-8 border border-slate-800 shadow-xl flex flex-col items-center text-center transform transition-all duration-300 hover:-translate-y-2 group hover:bg-slate-900/60 hover:border-primary/50 hover:shadow-[0_0_30px_rgba(249,115,22,0.15)] relative overflow-hidden">
                            <div
                                class="w-16 h-16 bg-primary/10 rounded-2xl flex items-center justify-center mb-6 shadow-inner group-hover:scale-110 transition-transform duration-300">
                                <span
                                    class="material-symbols-outlined text-primary text-3xl font-bold">blur_off</span>
                            </div>
                            <h3 class="font-display text-xl font-bold text-white leading-snug mb-2">
                                Lack of Focus
                            </h3>
                            <p class="text-gray-400 text-sm leading-relaxed">
                                You start 10 different projects and finish absolutely none of them.
                            </p>
                        </div>
                        <div
                            class="spotlight-card bg-slate-900/40 backdrop-blur-sm rounded-[2rem] p-8 border border-slate-800 shadow-xl flex flex-col items-center text-center transform transition-all duration-300 hover:-translate-y-2 group hover:bg-slate-900/60 hover:border-primary/50 hover:shadow-[0_0_30px_rgba(249,115,22,0.15)] relative overflow-hidden">
                            <div
                                class="w-16 h-16 bg-primary/10 rounded-2xl flex items-center justify-center mb-6 shadow-inner group-hover:scale-110 transition-transform duration-300">
                                <span
                                    class="material-symbols-outlined text-primary text-3xl font-bold">battery_alert</span>
                            </div>
                            <h3 class="font-display text-xl font-bold text-white leading-snug mb-2">
                                Mental Exhaustion
                            </h3>
                            <p class="text-gray-400 text-sm leading-relaxed">
                                You feel drained & addicted to cheap dopamine distractions.
                            </p>
                        </div>
                    </div>
                </div>
                <div class="mx-auto max-w-7xl px-6 text-center pt-8 relative z-10">
                    <h3 class="font-display text-2xl font-bold uppercase tracking-widest text-white/50 mb-2">THIS IS
                        NOT A TYPICAL MOTIVATION BOOK SET</h3>
                    <div
                        class="mx-auto h-1 w-24 rounded-full bg-primary mb-16 shadow-[0_0_15px_rgba(249,115,22,0.5)]">
                    </div>
                </div>
                <!-- Carousel Container -->
                <div class="relative w-full h-[500px] flex items-center justify-center overflow-visible">
                    <!-- Glow behind carousel -->
                    <div
                        class="absolute top-1/2 left-1/2 -translate-x-1/2 -translate-y-1/2 w-[600px] h-[600px] bg-secondary/10 rounded-full blur-[100px] pointer-events-none">
                    </div>

                    <div
                        class="carousel-scene relative flex h-[350px] w-full items-center justify-center overflow-visible">
                        <div class="carousel-cylinder relative h-[280px] w-[180px]">
                            <!-- Reduced number of books for performance, high quality only -->
                            <div class="absolute left-0 top-0 h-full w-full rounded-xl bg-gray-900 shadow-2xl border border-white/10 transition-transform duration-300 hover:scale-105 hover:border-secondary/50 hover:shadow-[0_0_20px_rgba(249,115,22,0.3)]"
                                style="transform: rotateY(0deg) translateZ(480px);">
                                <img alt="Book Cover 1" class="h-full w-full rounded-xl object-cover opacity-90"
                                    src="https://lh3.googleusercontent.com/aida-public/AB6AXuBxYsyRSwgXtMEZEFhdJ-PS1lOqC1y9V6eUZyRnTTX5tPkLndwD1Oan6R9zVNbXrIa0mEbrNaKQ28lXcxFmYefpEnyJRDIEBp4ZBp-TF9AVd_INoqTdtE_MSloij8hxco6HaH2CYQPFEr6l1A6e-6XEqTX97S0sUzglSPsFkewuAjMzIalvmSKl6abvxy2gqJQnpd6IX7ty8kGUuaYfUhDtyaOFcLxk5m3r2IWKqHrht8GX8rsrXh2gD_FQ61dUD4mj9AwQzginOyk" />
                                <div
                                    class="absolute inset-0 rounded-xl bg-gradient-to-t from-black/80 via-transparent to-transparent p-4 flex items-end">
                                    <p class="font-bold text-white text-sm">Discipline Blueprint</p>
                                </div>
                            </div>
                            <div class="absolute left-0 top-0 h-full w-full rounded-xl bg-gray-900 shadow-2xl border border-white/10 transition-transform duration-300 hover:scale-105 hover:border-secondary/50 hover:shadow-[0_0_20px_rgba(249,115,22,0.3)]"
                                style="transform: rotateY(36deg) translateZ(480px);">
                                <img alt="Book Cover 2" class="h-full w-full rounded-xl object-cover opacity-90"
                                    src="https://lh3.googleusercontent.com/aida-public/AB6AXuBSC5mJewY7dZx1s6m7cTWnT-SpwpZ90q-dXlh157QtCD5CskNIlxL3t1wTtAxuj_bF1QwOoFzeRKrV2IV3HxuMy1qRjfYmaXj7ueuYWkUNHvLCoN0ZDqnBCT0vtOO-Nlf1dT-Q2SzfXkTMjVvhpOZGUfK7IbW830wCt_rFWYQKOBvPSc7baxhVQcgRbKjjMkVnEQZqsLY1WVNEzjZlp_l7xHZVO8R4S9gzojmpXfEfOJ_BU48nqnuwZAVWlNoYFrXMk2dHD4ajwT4" />
                                <div
                                    class="absolute inset-0 rounded-xl bg-gradient-to-t from-black/80 via-transparent to-transparent p-4 flex items-end">
                                    <p class="font-bold text-white text-sm">Focus Protocol</p>
                                </div>
                            </div>
                            <div class="absolute left-0 top-0 h-full w-full rounded-xl bg-gray-900 shadow-2xl border border-white/10 transition-transform duration-300 hover:scale-105 hover:border-secondary/50 hover:shadow-[0_0_20px_rgba(249,115,22,0.3)]"
                                style="transform: rotateY(72deg) translateZ(480px);">
                                <img alt="Book Cover 3" class="h-full w-full rounded-xl object-cover opacity-90"
                                    src="https://lh3.googleusercontent.com/aida-public/AB6AXuDEFbNRvyPYRAWTToebf6PdbEFEVzmIhTO7ZLhcKdh1Z3AlPpOzfug2Xngz746KOn1jWLFh_7fN4QygqgezTD0T4DuQQRlyeaNCdqd15m0ws1crVvwmagmEC1XLLGBO1ecbXmWxElqV2CRR3bhQiNiaZNm3PY-42gMacJxSXZeHcI0HG-Ur5KzqutbS-m8Vsehj40NyOJPe77TshsEIx9qmOC8KYJVVotR5I_NMIHNN0OWFnpXMsX7yHdUBFpnolgbYRXC5a4Djyzc" />
                                <div
                                    class="absolute inset-0 rounded-xl bg-gradient-to-t from-black/80 via-transparent to-transparent p-4 flex items-end">
                                    <p class="font-bold text-white text-sm">Emotional Reset</p>
                                </div>
                            </div>
                            <div class="absolute left-0 top-0 h-full w-full rounded-xl bg-gray-900 shadow-2xl border border-white/10 transition-transform duration-300 hover:scale-105 hover:border-secondary/50 hover:shadow-[0_0_20px_rgba(249,115,22,0.3)]"
                                style="transform: rotateY(108deg) translateZ(480px);">
                                <img alt="Book Cover 4" class="h-full w-full rounded-xl object-cover opacity-90"
                                    src="https://lh3.googleusercontent.com/aida-public/AB6AXuALSeZanVKMNzFqf8z3YElfEc1DA-qiuE_nJg_aXmFwvxiLT_WjBOA3M7gJHSMJf3emhRPAevFxljJJK1KxjA12rZ3iSUHzg-TsjoSUWQMOJyrl9lMcbLRqxDcxuS2GbZSndbENeG-FiK0JfHuLZy8aaxyrVTFgawvQOiJti4Gh-epy9retriK_jwxxbKgocZ9fC7wvOkG0rbjoiw0eS3bN2mJ-MOmmCn2n0PWVS9E56Hgqa11_gBGnTUYdolGuA2A5JNbxxQzqw_g" />
                                <div
                                    class="absolute inset-0 rounded-xl bg-gradient-to-t from-black/80 via-transparent to-transparent p-4 flex items-end">
                                    <p class="font-bold text-white text-sm">Momentum System</p>
                                </div>
                            </div>
                            <div class="absolute left-0 top-0 h-full w-full rounded-xl bg-gray-900 shadow-2xl border border-white/10 transition-transform duration-300 hover:scale-105 hover:border-secondary/50 hover:shadow-[0_0_20px_rgba(249,115,22,0.3)]"
                                style="transform: rotateY(144deg) translateZ(480px);">
                                <img alt="Book Cover 5" class="h-full w-full rounded-xl object-cover opacity-90"
                                    src="https://lh3.googleusercontent.com/aida-public/AB6AXuCbaCswGNNfB1Jpn9pqgHIc7uzNbYaOAvAf3zV-NHO9uEAB0VOCPx_Dtf0izFssoMFWnTTc381Dy7KcpZUrIkseITlLqA-P6k_p_KKVYV6tSFdYGyauxIpFgLSwVhaxXYM9IR0wlqY42xXaewmlrjB3IdFuR4_rogXJJWhbl0ofZo5nEhFe_DK7CdTDy3ZlYrPD9cNUPTBToXd3MEs4U4ih6MEQrycn49r6UO3pYId411Wcnoll6kt46BcHTUTjiz0szgIrd4S-rlo" />
                                <div
                                    class="absolute inset-0 rounded-xl bg-gradient-to-t from-black/80 via-transparent to-transparent p-4 flex items-end">
                                    <p class="font-bold text-white text-sm">Career Control</p>
                                </div>
                            </div>
                            <div class="absolute left-0 top-0 h-full w-full rounded-xl bg-gray-900 shadow-2xl border border-white/10 transition-transform duration-300 hover:scale-105 hover:border-secondary/50 hover:shadow-[0_0_20px_rgba(249,115,22,0.3)]"
                                style="transform: rotateY(180deg) translateZ(480px);">
                                <img alt="Book Cover 6" class="h-full w-full rounded-xl object-cover opacity-90"
                                    src="https://lh3.googleusercontent.com/aida-public/AB6AXuCKXvOcxBAna-QU39U2Oz5UU0AjNivu_pkraY5tdtVNTV-1T0GjN25_kfw9jgolLXX4YD6VX03Pe8q_NJq8OJ9MqIdZjyQW1PUJBwDA5swtbuaBI_SUJkLTApgDMWwRcd9q3ji2hDHYtvvOrD9Br6rB8nSPQKTc62V3jiQpFmeGdt3_8qVaAJ_C2UbKFbChjlcdgqZYCID7ns5hZhlKMit19hGARGh_RthT3zPS0oWwVhUu3ok3C6gTI61C_h4DtBB3FxDeEsRresU" />
                                <div
                                    class="absolute inset-0 rounded-xl bg-gradient-to-t from-black/80 via-transparent to-transparent p-4 flex items-end">
                                    <p class="font-bold text-white text-sm">Digital Minimalism</p>
                                </div>
                            </div>
                            <div class="absolute left-0 top-0 h-full w-full rounded-xl bg-gray-900 shadow-2xl border border-white/10 transition-transform duration-300 hover:scale-105 hover:border-secondary/50 hover:shadow-[0_0_20px_rgba(249,115,22,0.3)]"
                                style="transform: rotateY(216deg) translateZ(480px);">
                                <img alt="Book Cover 7" class="h-full w-full rounded-xl object-cover opacity-90"
                                    src="https://lh3.googleusercontent.com/aida-public/AB6AXuAfoVSwU7qtkcr-CFwqN-pQamAJyHvx71VAzGszL6QIJ82TmPb-pLE6PtKoS4H9rYnWizjMn1m9M300tqIgA-RDqEyoI8f24gFKDxA18a0KPScz7NxJhnuRmpfLQNoZmRTxHEmgwpdOtXxGnoUuLaZtcJeXLU7npux1I2SdB8t_yCGxzWt_uj0VKm2ZXzDOQBI6fvOOdSRneev_kRHg9jly2XZFzWqr4634DB8QIDgAjiFfcEdKgshC-r7jdixrKuTBl9NQM34cb38" />
                                <div
                                    class="absolute inset-0 rounded-xl bg-gradient-to-t from-black/80 via-transparent to-transparent p-4 flex items-end">
                                    <p class="font-bold text-white text-sm">Social Battery</p>
                                </div>
                            </div>
                            <div class="absolute left-0 top-0 h-full w-full rounded-xl bg-gray-900 shadow-2xl border border-white/10 transition-transform duration-300 hover:scale-105 hover:border-secondary/50 hover:shadow-[0_0_20px_rgba(249,115,22,0.3)]"
                                style="transform: rotateY(252deg) translateZ(480px);">
                                <img alt="Book Cover 8" class="h-full w-full rounded-xl object-cover opacity-90"
                                    src="https://lh3.googleusercontent.com/aida-public/AB6AXuDGPfAAmM0IzGZanJPzBIHN4y1iVk159-Obptn1BR2k4BWKdwXurrkOV4f7vCmnt3pfdCbvBrlxs0EKj7xeEgi2vISJ9Bscl1DdSlk6UsCKj1woGDWQ7i-nhaphkJ9Ezlt_LnPlH6Ih7D0YpY5dYjxTkUoK6I8kGcfSTRKwW0M_fDTPHDiNqPJecCF0xknT7IHmcWf54gFVkf4vQD4_0pDhgBtHN2WAbCgpw4Krhr10emu5ygevxrmnL2EnK9CsH__3t89Scbc3T6I" />
                                <div
                                    class="absolute inset-0 rounded-xl bg-gradient-to-t from-black/80 via-transparent to-transparent p-4 flex items-end">
                                    <p class="font-bold text-white text-sm">Money Clarity</p>
                                </div>
                            </div>
                            <div class="absolute left-0 top-0 h-full w-full rounded-xl bg-gray-900 shadow-2xl border border-white/10 transition-transform duration-300 hover:scale-105 hover:border-secondary/50 hover:shadow-[0_0_20px_rgba(249,115,22,0.3)]"
                                style="transform: rotateY(288deg) translateZ(480px);">
                                <img alt="Book Cover 9" class="h-full w-full rounded-xl object-cover opacity-90"
                                    src="https://lh3.googleusercontent.com/aida-public/AB6AXuAAOQvjm5RfKZiaRjXtTlGgQt-XLigbV5vnWdTtWxHb5hQEDimzJ9NDJ-WGa8VKPbojGHRqpV91Aw3fFPAJyHbwdFh5mbfvfrlcAXvi4-j7W4zkKBL37r0_1wCxIOawrGaWCoTaz_-xGMvhBiKpF3MatmYLAH4sxxnwaNPeUsCaFv18OLe9Ai1Oey0NGdNkMVuavKZ_X7FJ56BojO3vLzAkERQEj97U5VHR_7RAzec9FLkSJJg7CW0QYwwrezny1pc4U_B554VRlwI" />
                                <div
                                    class="absolute inset-0 rounded-xl bg-gradient-to-t from-black/80 via-transparent to-transparent p-4 flex items-end">
                                    <p class="font-bold text-white text-sm">Identity Architect</p>
                                </div>
                            </div>
                            <div class="absolute left-0 top-0 h-full w-full rounded-xl bg-gray-900 shadow-2xl border border-white/10 transition-transform duration-300 hover:scale-105 hover:border-secondary/50 hover:shadow-[0_0_20px_rgba(249,115,22,0.3)]"
                                style="transform: rotateY(324deg) translateZ(480px);">
                                <img alt="Book Cover 10" class="h-full w-full rounded-xl object-cover opacity-90"
                                    src="https://lh3.googleusercontent.com/aida-public/AB6AXuD4jU2MEmgBHBskXd4Fpmr451oC2Ca9kxAvh7VOR7LWSkrcSK9U_yK_5dGLqQcBVYWmPVtjWbBuHChNrWYRq05m1iIZBfkwKOMcIG4tP9QFn5fICTGlBclziIs5ioxi4VvXeUXBOD0ZKRh-T63t9ZKk4oR-2zZgWGcJxIVD2ucVAn-1UjGsuHaNt0kxlmFfRt8ym2ApsruHDSGMRys2LRo14cYDxIjFUyTtDeB3hBSpbj_wNm9ODoWyMwX1lRyYtY6fvJFZNJ11fE0" />
                                <div
                                    class="absolute inset-0 rounded-xl bg-gradient-to-t from-black/80 via-transparent to-transparent p-4 flex items-end">
                                    <p class="font-bold text-white text-sm">Sleep Audit</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="mt-8 flex justify-center gap-2 text-sm text-gray-400/70">
                    <span class="flex items-center gap-1"><span
                            class="material-symbols-outlined text-sm">pan_tool</span> Click &amp; hold to pause</span>
                    <span class="flex items-center gap-1"><span class="material-symbols-outlined text-sm">360</span>
                        Drag to explore</span>
                </div>
            </section>
            <section
                class="reveal-on-scroll relative z-0 w-full overflow-hidden bg-white dark:bg-background-dark pb-24 pt-32 -mt-12">
                <div class="flex justify-center">
                    <div class="w-full max-w-7xl px-6 md:px-12">
                        <div class="flex flex-col items-center">
                            <div class="w-full max-w-7xl mx-auto mb-32 relative">
                                <!-- Background Ambient Light -->
                                <div
                                    class="absolute top-1/2 left-1/2 -translate-x-1/2 -translate-y-1/2 w-[800px] h-[400px] bg-primary/5 rounded-full blur-[100px] pointer-events-none">
                                </div>

                                <div class="flex flex-col items-center mb-20 relative z-10">
                                    <div
                                        class="inline-flex items-center gap-2 rounded-full border border-primary/20 bg-white shadow-sm px-4 py-1.5 mb-6">
                                        <div class="h-2 w-2 rounded-full bg-primary animate-pulse"></div>
                                        <span
                                            class="text-xs font-bold text-primary uppercase tracking-widest">Protocol
                                            Validated</span>
                                    </div>
                                    <h2
                                    class="text-4xl font-black leading-[1.1] tracking-tight text-gray-900 sm:text-5xl lg:text-6xl mb-6">
                                    Real Result. <br><span
                                        class="text-transparent bg-clip-text bg-gradient-to-r from-primary to-secondary">Real Impact.</span>
                                </h2>
                                    <p class="text-slate-500 text-xl max-w-2xl text-center leading-relaxed">
                                        Join thousands of high-performers who stopped relying on motivation and started
                                        building systems.
                                    </p>
                                </div>

                                <!-- Infinite Scroll Marquee -->
                                <div class="relative w-full overflow-hidden"
                                    style="mask-image: linear-gradient(to right, transparent, black 10%, black 90%, transparent); -webkit-mask-image: linear-gradient(to right, transparent, black 10%, black 90%, transparent);">

                                    <div
                                        class="flex animate-scroll-marquee w-max gap-8 py-10 px-4 hover:[animation-play-state:paused]">
                                        <!-- Testimonial 1 -->
                                        <div
                                            class="w-[400px] bg-white rounded-[32px] p-8 shadow-[0_8px_30px_rgba(0,0,0,0.04)] hover:shadow-[0_20px_50px_rgba(0,0,0,0.1)] border border-slate-100 flex flex-col justify-between shrink-0 group transition-all duration-300 hover:-translate-y-2">
                                            <div class="mb-6">
                                                <div class="flex items-center gap-1 mb-4">
                                                    <span
                                                        class="material-symbols-outlined text-yellow-500 text-sm filled">star</span>
                                                    <span
                                                        class="material-symbols-outlined text-yellow-500 text-sm filled">star</span>
                                                    <span
                                                        class="material-symbols-outlined text-yellow-500 text-sm filled">star</span>
                                                    <span
                                                        class="material-symbols-outlined text-yellow-500 text-sm filled">star</span>
                                                    <span
                                                        class="material-symbols-outlined text-yellow-500 text-sm filled">star</span>
                                                </div>
                                                <p class="text-slate-700 leading-relaxed font-medium text-lg">
                                                    "I used to watch motivational videos every morning. Now I just
                                                    follow my system. No hype needed. It's liberating."
                                                </p>
                                            </div>
                                            <div class="flex items-center gap-4 pt-6 border-t border-slate-50">
                                                <div
                                                    class="w-12 h-12 rounded-full bg-slate-100 flex items-center justify-center text-slate-700 font-bold text-lg">
                                                    MC
                                                </div>
                                                <div>
                                                    <h4 class="text-slate-900 font-bold">Marcus Chen</h4>
                                                    <p class="text-slate-400 text-sm">Student, Singapore</p>
                                                </div>
                                                <span
                                                    class="ml-auto material-symbols-outlined text-secondary group-hover:scale-110 transition-transform filled icon-filled">verified</span>
                                            </div>
                                        </div>

                                        <!-- Testimonial 2 -->
                                        <div
                                            class="w-[400px] bg-white rounded-[32px] p-8 shadow-[0_8px_30px_rgba(0,0,0,0.04)] hover:shadow-[0_20px_50px_rgba(0,0,0,0.1)] border border-slate-100 flex flex-col justify-between shrink-0 group transition-all duration-300 hover:-translate-y-2">
                                            <div class="mb-6">
                                                <div class="flex items-center gap-1 mb-4">
                                                    <span
                                                        class="material-symbols-outlined text-yellow-500 text-sm filled">star</span>
                                                    <span
                                                        class="material-symbols-outlined text-yellow-500 text-sm filled">star</span>
                                                    <span
                                                        class="material-symbols-outlined text-yellow-500 text-sm filled">star</span>
                                                    <span
                                                        class="material-symbols-outlined text-yellow-500 text-sm filled">star</span>
                                                    <span
                                                        class="material-symbols-outlined text-yellow-500 text-sm filled">star</span>
                                                </div>
                                                <p class="text-slate-700 leading-relaxed font-medium text-lg">
                                                    "The 'Intellectual Architecture' concept changed how I structure my
                                                    entire business. Content is finally an asset, not a chore."
                                                </p>
                                            </div>
                                            <div class="flex items-center gap-4 pt-6 border-t border-slate-50">
                                                <div
                                                    class="w-12 h-12 rounded-full bg-slate-100 flex items-center justify-center text-slate-700 font-bold text-lg">
                                                    AR
                                                </div>
                                                <div>
                                                    <h4 class="text-slate-900 font-bold">Aisha Rahman</h4>
                                                    <p class="text-slate-400 text-sm">Founder, Malaysia</p>
                                                </div>
                                                <span
                                                    class="ml-auto material-symbols-outlined text-secondary group-hover:scale-110 transition-transform filled icon-filled">verified</span>
                                            </div>
                                        </div>

                                        <!-- Testimonial 3 -->
                                        <div
                                            class="w-[400px] bg-white rounded-[32px] p-8 shadow-[0_8px_30px_rgba(0,0,0,0.04)] hover:shadow-[0_20px_50px_rgba(0,0,0,0.1)] border border-slate-100 flex flex-col justify-between shrink-0 group transition-all duration-300 hover:-translate-y-2">
                                            <div class="mb-6">
                                                <div class="flex items-center gap-1 mb-4">
                                                    <span
                                                        class="material-symbols-outlined text-yellow-500 text-sm filled">star</span>
                                                    <span
                                                        class="material-symbols-outlined text-yellow-500 text-sm filled">star</span>
                                                    <span
                                                        class="material-symbols-outlined text-yellow-500 text-sm filled">star</span>
                                                    <span
                                                        class="material-symbols-outlined text-yellow-500 text-sm filled">star</span>
                                                    <span
                                                        class="material-symbols-outlined text-yellow-500 text-sm filled">star</span>
                                                </div>
                                                <p class="text-slate-700 leading-relaxed font-medium text-lg">
                                                    "Finally, something that doesn't promise overnight success. It's a
                                                    brutal reality check that I needed. Pure signal."
                                                </p>
                                            </div>
                                            <div class="flex items-center gap-4 pt-6 border-t border-slate-50">
                                                <div
                                                    class="w-12 h-12 rounded-full bg-slate-100 flex items-center justify-center text-slate-700 font-bold text-lg">
                                                    JM
                                                </div>
                                                <div>
                                                    <h4 class="text-slate-900 font-bold">Jake Morrison</h4>
                                                    <p class="text-slate-400 text-sm">Dev Lead, Australia</p>
                                                </div>
                                                <span
                                                    class="ml-auto material-symbols-outlined text-secondary group-hover:scale-110 transition-transform filled icon-filled">verified</span>
                                            </div>
                                        </div>

                                        <!-- Testimonial 4 -->
                                        <div
                                            class="w-[400px] bg-white rounded-[32px] p-8 shadow-[0_8px_30px_rgba(0,0,0,0.04)] hover:shadow-[0_20px_50px_rgba(0,0,0,0.1)] border border-slate-100 flex flex-col justify-between shrink-0 group transition-all duration-300 hover:-translate-y-2">
                                            <div class="mb-6">
                                                <div class="flex items-center gap-1 mb-4">
                                                    <span
                                                        class="material-symbols-outlined text-yellow-500 text-sm filled">star</span>
                                                    <span
                                                        class="material-symbols-outlined text-yellow-500 text-sm filled">star</span>
                                                    <span
                                                        class="material-symbols-outlined text-yellow-500 text-sm filled">star</span>
                                                    <span
                                                        class="material-symbols-outlined text-yellow-500 text-sm filled">star</span>
                                                    <span
                                                        class="material-symbols-outlined text-yellow-500 text-sm filled">star</span>
                                                </div>
                                                <p class="text-slate-700 leading-relaxed font-medium text-lg">
                                                    "I stopped waiting for motivation. This framework gave me the tools
                                                    to build even when I don't 'feel' like it."
                                                </p>
                                            </div>
                                            <div class="flex items-center gap-4 pt-6 border-t border-slate-50">
                                                <div
                                                    class="w-12 h-12 rounded-full bg-slate-100 flex items-center justify-center text-slate-700 font-bold text-lg">
                                                    PS
                                                </div>
                                                <div>
                                                    <h4 class="text-slate-900 font-bold">Priya Sharma</h4>
                                                    <p class="text-slate-400 text-sm">Content Creator, India</p>
                                                </div>
                                                <span
                                                    class="ml-auto material-symbols-outlined text-secondary group-hover:scale-110 transition-transform filled icon-filled">verified</span>
                                            </div>
                                        </div>

                                        <!-- Testimonial 5 -->
                                        <div
                                            class="w-[400px] bg-white rounded-[32px] p-8 shadow-[0_8px_30px_rgba(0,0,0,0.04)] hover:shadow-[0_20px_50px_rgba(0,0,0,0.1)] border border-slate-100 flex flex-col justify-between shrink-0 group transition-all duration-300 hover:-translate-y-2">
                                            <div class="mb-6">
                                                <div class="flex items-center gap-1 mb-4">
                                                    <span
                                                        class="material-symbols-outlined text-yellow-500 text-sm filled">star</span>
                                                    <span
                                                        class="material-symbols-outlined text-yellow-500 text-sm filled">star</span>
                                                    <span
                                                        class="material-symbols-outlined text-yellow-500 text-sm filled">star</span>
                                                    <span
                                                        class="material-symbols-outlined text-yellow-500 text-sm filled">star</span>
                                                    <span
                                                        class="material-symbols-outlined text-yellow-500 text-sm filled">star</span>
                                                </div>
                                                <p class="text-slate-700 leading-relaxed font-medium text-lg">
                                                    "The discipline systems in this book helped me launch my startup
                                                    while working 9-5. It's a blueprint for action."
                                                </p>
                                            </div>
                                            <div class="flex items-center gap-4 pt-6 border-t border-slate-50">
                                                <div
                                                    class="w-12 h-12 rounded-full bg-slate-100 flex items-center justify-center text-slate-700 font-bold text-lg">
                                                    DP
                                                </div>
                                                <div>
                                                    <h4 class="text-slate-900 font-bold">Daniel Park</h4>
                                                    <p class="text-slate-400 text-sm">Entrepreneur, Korea</p>
                                                </div>
                                                <span
                                                    class="ml-auto material-symbols-outlined text-secondary group-hover:scale-110 transition-transform filled icon-filled">verified</span>
                                            </div>
                                        </div>

                                        <!-- Testimonial 6 (Duplicate for Loop) -->
                                        <div
                                            class="w-[400px] bg-white rounded-[32px] p-8 shadow-[0_8px_30px_rgba(0,0,0,0.04)] hover:shadow-[0_20px_50px_rgba(0,0,0,0.1)] border border-slate-100 flex flex-col justify-between shrink-0 group transition-all duration-300 hover:-translate-y-2">
                                            <div class="mb-6">
                                                <div class="flex items-center gap-1 mb-4">
                                                    <span
                                                        class="material-symbols-outlined text-yellow-500 text-sm filled">star</span>
                                                    <span
                                                        class="material-symbols-outlined text-yellow-500 text-sm filled">star</span>
                                                    <span
                                                        class="material-symbols-outlined text-yellow-500 text-sm filled">star</span>
                                                    <span
                                                        class="material-symbols-outlined text-yellow-500 text-sm filled">star</span>
                                                    <span
                                                        class="material-symbols-outlined text-yellow-500 text-sm filled">star</span>
                                                </div>
                                                <p class="text-slate-700 leading-relaxed font-medium text-lg">
                                                    "One of the few guides that respects your intelligence. No vague
                                                    advice, just operational logic."
                                                </p>
                                            </div>
                                            <div class="flex items-center gap-4 pt-6 border-t border-slate-50">
                                                <div
                                                    class="w-12 h-12 rounded-full bg-slate-100 flex items-center justify-center text-slate-700 font-bold text-lg">
                                                    SM
                                                </div>
                                                <div>
                                                    <h4 class="text-slate-900 font-bold">Sofia Martinez</h4>
                                                    <p class="text-slate-400 text-sm">Engineer, Spain</p>
                                                </div>
                                                <span
                                                    class="ml-auto material-symbols-outlined text-secondary group-hover:scale-110 transition-transform filled icon-filled">verified</span>
                                            </div>
                                        </div>

                                        <!-- Testimonial 7 (Duplicate for Loop) -->
                                        <div
                                            class="w-[400px] bg-white rounded-[32px] p-8 shadow-[0_8px_30px_rgba(0,0,0,0.04)] hover:shadow-[0_20px_50px_rgba(0,0,0,0.1)] border border-slate-100 flex flex-col justify-between shrink-0 group transition-all duration-300 hover:-translate-y-2">
                                            <div class="mb-6">
                                                <div class="flex items-center gap-1 mb-4">
                                                    <span
                                                        class="material-symbols-outlined text-yellow-500 text-sm filled">star</span>
                                                    <span
                                                        class="material-symbols-outlined text-yellow-500 text-sm filled">star</span>
                                                    <span
                                                        class="material-symbols-outlined text-yellow-500 text-sm filled">star</span>
                                                    <span
                                                        class="material-symbols-outlined text-yellow-500 text-sm filled">star</span>
                                                    <span
                                                        class="material-symbols-outlined text-yellow-500 text-sm filled">star</span>
                                                </div>
                                                <p class="text-slate-700 leading-relaxed font-medium text-lg">
                                                    "Worth every second. The 'Identity Shifting' framework is now the
                                                    basis for all my coaching."
                                                </p>
                                            </div>
                                            <div class="flex items-center gap-4 pt-6 border-t border-slate-50">
                                                <div
                                                    class="w-12 h-12 rounded-full bg-slate-100 flex items-center justify-center text-slate-700 font-bold text-lg">
                                                    RT
                                                </div>
                                                <div>
                                                    <h4 class="text-slate-900 font-bold">Ryan Thompson</h4>
                                                    <p class="text-slate-400 text-sm">Coach, UK</p>
                                                </div>
                                                <span
                                                    class="ml-auto material-symbols-outlined text-secondary group-hover:scale-110 transition-transform filled icon-filled">verified</span>
                                            </div>
                                        </div>

                                    </div>
                                </div>
                            </div>
                            <div class="mb-8 text-center max-w-4xl mx-auto">
                                <div
                                    class="inline-flex items-center gap-2 rounded-full border border-secondary/20 bg-white shadow-sm px-4 py-1.5 mb-6">
                                    <div class="h-2 w-2 rounded-full bg-secondary animate-pulse"></div>
                                    <span class="text-xs font-bold text-secondary uppercase tracking-widest">Take It
                                        Further</span>
                                </div>
                                <h2
                                    class="text-4xl font-black leading-[1.1] tracking-tight text-gray-900 sm:text-5xl lg:text-6xl mb-6">
                                    Build Your <span
                                        class="text-transparent bg-clip-text bg-gradient-to-r from-primary to-secondary">Personal
                                        System</span>
                                </h2>
                                <p class="text-lg font-normal leading-relaxed text-gray-600 max-w-2xl mx-auto">
                                    Stop relying on willpower. Install a proven operating system for your life that
                                    makes discipline automatic and success inevitable.
                                </p>
                            </div>
                            <div class="w-full relative mb-8 mt-8">
                                <div class="grid grid-cols-2 sm:grid-cols-3 lg:grid-cols-6 gap-4 relative z-10 mb-2">
                                    <div class="flex flex-col items-center text-center gap-3">
                                        <h4
                                            class="text-xs font-bold text-gray-500 uppercase tracking-wider mb-2 h-8 flex items-end justify-center">
                                            Identity<br />Shifting</h4>
                                        <div
                                            class="w-12 h-12 rounded-lg bg-white shadow-md border border-gray-100 flex items-center justify-center transition-colors hover:bg-orange-50 hover:shadow-lg">
                                            <span
                                                class="material-symbols-outlined text-2xl text-primary">fingerprint</span>
                                        </div>
                                    </div>
                                    <div class="flex flex-col items-center text-center gap-3">
                                        <h4
                                            class="text-xs font-bold text-gray-500 uppercase tracking-wider mb-2 h-8 flex items-end justify-center">
                                            Protocol<br />Stack</h4>
                                        <div
                                            class="w-12 h-12 rounded-lg bg-white shadow-md border border-gray-100 flex items-center justify-center transition-colors hover:bg-orange-50 hover:shadow-lg">
                                            <span
                                                class="material-symbols-outlined text-2xl text-primary">layers</span>
                                        </div>
                                    </div>
                                    <div class="flex flex-col items-center text-center gap-3">
                                        <h4
                                            class="text-xs font-bold text-gray-500 uppercase tracking-wider mb-2 h-8 flex items-end justify-center">
                                            Action<br />Engine</h4>
                                        <div
                                            class="w-12 h-12 rounded-lg bg-white shadow-md border border-gray-100 flex items-center justify-center transition-colors hover:bg-orange-50 hover:shadow-lg">
                                            <span class="material-symbols-outlined text-2xl text-primary">bolt</span>
                                        </div>
                                    </div>
                                    <div class="flex flex-col items-center text-center gap-3">
                                        <h4
                                            class="text-xs font-bold text-gray-500 uppercase tracking-wider mb-2 h-8 flex items-end justify-center">
                                            Streak<br />Guardian</h4>
                                        <div
                                            class="w-12 h-12 rounded-lg bg-white shadow-md border border-gray-100 flex items-center justify-center transition-colors hover:bg-orange-50 hover:shadow-lg">
                                            <span
                                                class="material-symbols-outlined text-2xl text-primary">shield_lock</span>
                                        </div>
                                    </div>
                                    <div class="flex flex-col items-center text-center gap-3">
                                        <h4
                                            class="text-xs font-bold text-gray-500 uppercase tracking-wider mb-2 h-8 flex items-end justify-center">
                                            Inner<br />Circle</h4>
                                        <div
                                            class="w-12 h-12 rounded-lg bg-white shadow-md border border-gray-100 flex items-center justify-center transition-colors hover:bg-orange-50 hover:shadow-lg">
                                            <span
                                                class="material-symbols-outlined text-2xl text-primary">diversity_3</span>
                                        </div>
                                    </div>
                                    <div class="flex flex-col items-center text-center gap-3">
                                        <h4
                                            class="text-xs font-bold text-gray-500 uppercase tracking-wider mb-2 h-8 flex items-end justify-center">
                                            System<br />Architect</h4>
                                        <div
                                            class="w-12 h-12 rounded-lg bg-white shadow-md border border-gray-100 flex items-center justify-center transition-colors hover:bg-orange-50 hover:shadow-lg">
                                            <span
                                                class="material-symbols-outlined text-2xl text-primary">architecture</span>
                                        </div>
                                    </div>
                                </div>
                                <div class="hidden lg:block relative w-full h-[140px] -mt-2 overflow-visible">
                                    <svg class="w-full h-full overflow-visible" preserveAspectRatio="none"
                                        viewBox="0 0 1200 140" xmlns="http://www.w3.org/2000/svg">
                                        <path class="stroke-gray-200 fill-none stroke-1"
                                            d="M100 0 C 100 80, 580 80, 600 140"></path>
                                        <path class="stroke-gray-200 fill-none stroke-1"
                                            d="M300 0 C 300 60, 590 60, 600 140"></path>
                                        <path class="stroke-gray-200 fill-none stroke-1"
                                            d="M500 0 C 500 40, 595 40, 600 140"></path>
                                        <path class="stroke-gray-200 fill-none stroke-1"
                                            d="M700 0 C 700 40, 605 40, 600 140"></path>
                                        <path class="stroke-gray-200 fill-none stroke-1"
                                            d="M900 0 C 900 60, 610 60, 600 140"></path>
                                        <path class="stroke-gray-200 fill-none stroke-1"
                                            d="M1100 0 C 1100 80, 620 80, 600 140"></path>
                                        <path
                                            class="animate-trace animate-trace-delayed-1 stroke-secondary fill-none stroke-[2px]"
                                            d="M100 0 C 100 80, 580 80, 600 140" filter="url(#glow)"></path>
                                        <path
                                            class="animate-trace animate-trace-delayed-2 stroke-secondary fill-none stroke-[2px]"
                                            d="M300 0 C 300 60, 590 60, 600 140" filter="url(#glow)"></path>
                                        <path
                                            class="animate-trace animate-trace-delayed-3 stroke-secondary fill-none stroke-[2px]"
                                            d="M500 0 C 500 40, 595 40, 600 140" filter="url(#glow)"></path>
                                        <path
                                            class="animate-trace animate-trace-delayed-3 stroke-secondary fill-none stroke-[2px]"
                                            d="M700 0 C 700 40, 605 40, 600 140" filter="url(#glow)"></path>
                                        <path
                                            class="animate-trace animate-trace-delayed-2 stroke-secondary fill-none stroke-[2px]"
                                            d="M900 0 C 900 60, 610 60, 600 140" filter="url(#glow)"></path>
                                        <path
                                            class="animate-trace animate-trace-delayed-1 stroke-secondary fill-none stroke-[2px]"
                                            d="M1100 0 C 1100 80, 620 80, 600 140" filter="url(#glow)"></path>
                                        <defs>
                                            <filter height="140%" id="glow" width="140%" x="-20%" y="-20%">
                                                <feGaussianBlur result="coloredBlur" stdDeviation="3"></feGaussianBlur>
                                                <feMerge>
                                                    <feMergeNode in="coloredBlur"></feMergeNode>
                                                    <feMergeNode in="SourceGraphic"></feMergeNode>
                                                </feMerge>
                                            </filter>
                                        </defs>
                                    </svg>
                                </div>
                                <div
                                    class="relative mt-8 lg:mt-0 flex flex-col lg:flex-row items-center justify-center gap-12 lg:gap-24">
                                    <div class="flex flex-col gap-10 lg:items-end lg:text-right w-full lg:w-1/3">
                                        <div class="flex flex-col lg:flex-row items-center lg:items-start gap-4">
                                            <div class="order-2 lg:order-1 flex flex-col gap-1">
                                                <h3 class="text-lg font-bold text-gray-800">
                                                    Hyper-Personalized<br />Protocols</h3>
                                            </div>
                                            <div
                                                class="order-1 lg:order-2 w-8 h-8 rounded-full bg-primary text-white flex items-center justify-center shadow-lg shadow-orange-500/20 flex-shrink-0">
                                                <span
                                                    class="material-symbols-outlined text-[16px] font-bold">check</span>
                                            </div>
                                        </div>
                                        <div class="flex flex-col lg:flex-row items-center lg:items-start gap-4">
                                            <div class="order-2 lg:order-1 flex flex-col gap-1">
                                                <h3 class="text-lg font-bold text-gray-800">Plug & Play<br />System
                                                    Tools</h3>
                                            </div>
                                            <div
                                                class="order-1 lg:order-2 w-8 h-8 rounded-full bg-primary text-white flex items-center justify-center shadow-lg shadow-orange-500/20 flex-shrink-0">
                                                <span
                                                    class="material-symbols-outlined text-[16px] font-bold">check</span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="relative z-10 mx-auto book-pulse">
                                        <div
                                            class="absolute -bottom-10 left-1/2 -translate-x-1/2 w-[280px] h-10 bg-gray-800 rounded-sm transform rotate(6deg) shadow-xl z-0 border-l border-b border-gray-600">
                                        </div>
                                        <div
                                            class="absolute -bottom-5 left-1/2 -translate-x-1/2 w-[280px] h-10 bg-gray-700 rounded-sm transform -rotate(3deg) shadow-xl z-10 border-l border-b border-gray-600">
                                        </div>
                                        <div class="relative w-[260px] aspect-[2/3] group perspective-1000 z-20">
                                            <div
                                                class="relative w-full h-full bg-gray-800 rounded-r-lg rounded-l-sm shadow-[0_20px_60px_-15px_rgba(0,0,0,0.6)] overflow-hidden border-l-[6px] border-gray-700 flex flex-col">
                                                <div
                                                    class="absolute inset-0 bg-gradient-to-br from-gray-700 via-gray-800 to-gray-900">
                                                </div>
                                                <div class="absolute inset-0 opacity-10"
                                                    style="background-image: linear-gradient(#fff 1px, transparent 1px), linear-gradient(90deg, #fff 1px, transparent 1px); background-size: 20px 20px;">
                                                </div>
                                                <div
                                                    class="absolute left-0 top-0 bottom-0 w-3 bg-gradient-to-r from-white/20 to-transparent">
                                                </div>
                                                <div class="relative z-10 p-6 h-full flex flex-col justify-between">
                                                    <div>
                                                        <div
                                                            class="flex items-center gap-2 text-white/50 text-[10px] uppercase tracking-widest mb-8 border-l-2 border-primary pl-2">
                                                            CORE_OS_v2.0
                                                        </div>
                                                        <h2
                                                            class="text-4xl font-black text-white leading-[0.85] tracking-tight drop-shadow-lg">
                                                            YOUR<br /><span class="text-primary">SYSTEM</span>
                                                        </h2>
                                                    </div>
                                                    <div>
                                                        <p
                                                            class="text-gray-400 text-xs leading-relaxed mb-6 border-l border-gray-600 pl-3 italic">
                                                            The complete interface for managing your habits, focus, and
                                                            output.
                                                        </p>
                                                        <div
                                                            class="flex items-center gap-2 text-white font-bold text-xs">
                                                            <span
                                                                class="w-4 h-4 rounded-full bg-primary flex items-center justify-center text-[8px]">L</span>
                                                            <span>Jarreva Creative</span>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="flex flex-col gap-10 lg:items-start lg:text-left w-full lg:w-1/3">
                                        <div class="flex flex-col lg:flex-row items-center lg:items-start gap-4">
                                            <div
                                                class="w-8 h-8 rounded-full bg-primary text-white flex items-center justify-center shadow-lg shadow-orange-500/20 flex-shrink-0">
                                                <span
                                                    class="material-symbols-outlined text-[16px] font-bold">check</span>
                                            </div>
                                            <div class="flex flex-col gap-1">
                                                <h3 class="text-lg font-bold text-gray-800">Designed by<br />Real
                                                    Experts</h3>
                                            </div>
                                        </div>
                                        <div class="flex flex-col lg:flex-row items-center lg:items-start gap-4">
                                            <div
                                                class="w-8 h-8 rounded-full bg-primary text-white flex items-center justify-center shadow-lg shadow-orange-500/20 flex-shrink-0">
                                                <span
                                                    class="material-symbols-outlined text-[16px] font-bold">check</span>
                                            </div>
                                            <div class="flex flex-col gap-1">
                                                <h3 class="text-lg font-bold text-gray-800">See measurable<br />results
                                                    in 7 days</h3>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>

            <!-- NEW: Why Solutions Fail Section -->
            <section
                class="reveal-on-scroll relative z-10 w-full overflow-hidden bg-slate-950 pt-24 pb-48 rounded-[40px] shadow-2xl border border-slate-800 hover:border-slate-700 transition-colors duration-700 group mt-8">
                <!-- Clean Minimal Background -->
                <div class="absolute inset-0 pointer-events-none overflow-hidden">
                    <div
                        class="absolute inset-0 bg-[linear-gradient(to_right,#ffffff03_1px,transparent_1px),linear-gradient(to_bottom,#ffffff03_1px,transparent_1px)] bg-[size:48px_48px]">
                    </div>
                </div>

                <div class="max-w-6xl mx-auto px-6 md:px-12 relative z-10">
                    <div class="text-center mb-16">
                        <div
                            class="inline-flex items-center gap-2 rounded-full border border-secondary/20 bg-white shadow-sm px-4 py-1.5 mb-6">
                            <div class="h-2 w-2 rounded-full bg-secondary animate-pulse"></div>
                            <span class="text-xs font-bold text-secondary uppercase tracking-widest">The Hard
                                Truth</span>
                        </div>
                        <h2 class="text-4xl md:text-5xl font-black text-white mb-6 tracking-tight">
                            Why Most Solutions <span
                                class="text-transparent bg-clip-text bg-gradient-to-r from-primary to-secondary">Fail
                                Completely</span>
                        </h2>
                        <p class="text-lg text-gray-400 max-w-2xl mx-auto leading-relaxed">
                            You've tried motivational videos, inspiring quotes, and hype seminars. They all end the same
                            way.
                        </p>
                    </div>
                    <div class="grid grid-cols-1 lg:grid-cols-2 gap-12 items-center">
                        <!-- Left: Visual Cycle -->
                        <div class="relative">
                            <div class="bg-slate-900/40 backdrop-blur-sm rounded-3xl p-8 border border-slate-800">
                                <h3 class="text-xl font-bold text-white mb-6 text-center">The Motivation Trap</h3>
                                <div class="flex flex-col gap-4">
                                    <!-- Step 1 -->
                                    <div class="flex items-center gap-4">
                                        <div
                                            class="w-12 h-12 rounded-full bg-blue-500/10 flex items-center justify-center flex-shrink-0">
                                            <span
                                                class="material-symbols-outlined text-blue-400 text-xl">trending_up</span>
                                        </div>
                                        <div>
                                            <h4 class="text-white font-bold">Motivation Spike</h4>
                                            <p class="text-gray-400 text-sm">You feel inspired, pumped, ready to conquer
                                                the world</p>
                                        </div>
                                    </div>
                                    <!-- Arrow -->
                                    <div class="flex justify-center">
                                        <span
                                            class="material-symbols-outlined text-gray-600 text-2xl">arrow_downward</span>
                                    </div>
                                    <!-- Step 2 -->
                                    <div class="flex items-center gap-4">
                                        <div
                                            class="w-12 h-12 rounded-full bg-orange-500/10 flex items-center justify-center flex-shrink-0">
                                            <span
                                                class="material-symbols-outlined text-orange-400 text-xl">trending_flat</span>
                                        </div>
                                        <div>
                                            <h4 class="text-white font-bold">Reality Hits</h4>
                                            <p class="text-gray-400 text-sm">The hype fades, you face real obstacles</p>
                                        </div>
                                    </div>
                                    <!-- Arrow -->
                                    <div class="flex justify-center">
                                        <span
                                            class="material-symbols-outlined text-gray-600 text-2xl">arrow_downward</span>
                                    </div>
                                    <!-- Step 3 -->
                                    <div class="flex items-center gap-4">
                                        <div
                                            class="w-12 h-12 rounded-full bg-red-500/10 flex items-center justify-center flex-shrink-0">
                                            <span
                                                class="material-symbols-outlined text-red-400 text-xl">trending_down</span>
                                        </div>
                                        <div>
                                            <h4 class="text-white font-bold">Crash & Guilt</h4>
                                            <p class="text-gray-400 text-sm">Back to zero, feeling worse than before</p>
                                        </div>
                                    </div>
                                    <!-- Arrow -->
                                    <div class="flex justify-center">
                                        <span class="material-symbols-outlined text-gray-600 text-2xl">sync</span>
                                    </div>
                                    <!-- Repeat indicator -->
                                    <div class="text-center py-2 rounded-lg bg-slate-800/50 border border-slate-700">
                                        <span class="text-gray-300 font-bold text-sm uppercase tracking-wider">Repeat
                                            Forever</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- Right: Text Explanation -->
                        <div class="space-y-8">
                            <div class="flex gap-4">
                                <div
                                    class="w-10 h-10 rounded-full bg-primary/10 flex items-center justify-center flex-shrink-0">
                                    <span class="material-symbols-outlined text-primary">close</span>
                                </div>
                                <div>
                                    <h4 class="text-white font-bold text-lg mb-2">They Talk About Feelings, Not Behavior
                                    </h4>
                                    <p class="text-gray-400 leading-relaxed">
                                        Most self-help focuses on how you should FEEL. But feelings are temporary. Real
                                        change comes from what you DO consistently.
                                    </p>
                                </div>
                            </div>
                            <div class="flex gap-4">
                                <div
                                    class="w-10 h-10 rounded-full bg-primary/10 flex items-center justify-center flex-shrink-0">
                                    <span class="material-symbols-outlined text-primary">close</span>
                                </div>
                                <div>
                                    <h4 class="text-white font-bold text-lg mb-2">They Promise Quick Fixes</h4>
                                    <p class="text-gray-400 leading-relaxed">
                                        "30 days to transform your life!" No. Real discipline is built slowly, through
                                        boring repetition when no one is watching.
                                    </p>
                                </div>
                            </div>
                            <div class="flex gap-4">
                                <div
                                    class="w-10 h-10 rounded-full bg-primary/10 flex items-center justify-center flex-shrink-0">
                                    <span class="material-symbols-outlined text-primary">close</span>
                                </div>
                                <div>
                                    <h4 class="text-white font-bold text-lg mb-2">They Ignore The System</h4>
                                    <p class="text-gray-400 leading-relaxed">
                                        Motivation is unreliable fuel. You need a SYSTEM that works even when you don't
                                        feel like it. That's what we teach.
                                    </p>
                                </div>
                            </div>
                            <div class="mt-8 p-6 bg-secondary/5 rounded-2xl border border-secondary/20">
                                <p class="text-white font-bold text-lg">
                                    "Your life doesn't need more motivation. Your life needs <span
                                        class="text-primary">structure</span>."
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
            <section class="reveal-on-scroll w-full max-w-7xl mx-auto px-6 -mt-24 mb-20 relative z-20">
                <div class="bg-[#F7F9FB] rounded-[60px] p-12 lg:p-16 shadow-2xl relative overflow-hidden">
                    <div class="text-center mb-16 relative z-10">
                        <div
                            class="inline-flex items-center gap-2 rounded-full border border-secondary/20 bg-white shadow-sm px-4 py-1.5 mb-6">
                            <div class="h-2 w-2 rounded-full bg-secondary animate-pulse"></div>
                            <span class="text-xs font-bold text-secondary uppercase tracking-widest">Spread The
                                Impact</span>
                        </div>
                        <h2 class="text-4xl md:text-5xl font-black text-gray-900 tracking-tight leading-[1.1]">
                            Help Others<br /><span
                                class="text-transparent bg-clip-text bg-gradient-to-r from-primary to-secondary">Break
                                Free</span>
                        </h2>
                        <p class="mt-6 text-lg text-gray-600 max-w-2xl mx-auto leading-relaxed">
                            Know someone stuck in the motivation trap? Share this book with friends, teams, or
                            communities.
                            Help them build systems that actually work.
                        </p>
                    </div>
                    <div class="grid grid-cols-1 lg:grid-cols-3 gap-12 lg:gap-8 items-center relative z-10">
                        <div class="lg:text-right flex flex-col lg:items-end">
                            <span class="text-gray-400 font-bold tracking-widest text-xs uppercase mb-4">Who to share
                                with</span>
                            <h3 class="text-2xl font-black text-gray-900 mb-8">Perfect for</h3>
                            <ul class="space-y-6">
                                <li class="flex items-center lg:flex-row-reverse gap-4 text-right">
                                    <div
                                        class="w-6 h-6 rounded-full bg-secondary flex items-center justify-center flex-shrink-0">
                                        <span
                                            class="material-symbols-outlined text-white text-sm font-bold">check</span>
                                    </div>
                                    <span class="text-gray-600 font-medium text-base">Friends who feel stuck</span>
                                </li>
                                <li class="flex items-center lg:flex-row-reverse gap-4 text-right">
                                    <div
                                        class="w-6 h-6 rounded-full bg-secondary flex items-center justify-center flex-shrink-0">
                                        <span
                                            class="material-symbols-outlined text-white text-sm font-bold">check</span>
                                    </div>
                                    <span class="text-gray-600 font-medium text-base">Startup teams needing focus</span>
                                </li>
                                <li class="flex items-center lg:flex-row-reverse gap-4 text-right">
                                    <div
                                        class="w-6 h-6 rounded-full bg-secondary flex items-center justify-center flex-shrink-0">
                                        <span
                                            class="material-symbols-outlined text-white text-sm font-bold">check</span>
                                    </div>
                                    <span class="text-gray-600 font-medium text-base">School counselors</span>
                                </li>
                                <li class="flex items-center lg:flex-row-reverse gap-4 text-right">
                                    <div
                                        class="w-6 h-6 rounded-full bg-secondary flex items-center justify-center flex-shrink-0">
                                        <span
                                            class="material-symbols-outlined text-white text-sm font-bold">check</span>
                                    </div>
                                    <span class="text-gray-600 font-medium text-base">Youth group leaders</span>
                                </li>
                                <li class="flex items-center lg:flex-row-reverse gap-4 text-right">
                                    <div
                                        class="w-6 h-6 rounded-full bg-secondary flex items-center justify-center flex-shrink-0">
                                        <span
                                            class="material-symbols-outlined text-white text-sm font-bold">check</span>
                                    </div>
                                    <span class="text-gray-600 font-medium text-base">Parents of teenagers</span>
                                </li>
                                <li class="flex items-center lg:flex-row-reverse gap-4 text-right">
                                    <div
                                        class="w-6 h-6 rounded-full bg-secondary flex items-center justify-center flex-shrink-0">
                                        <span
                                            class="material-symbols-outlined text-white text-sm font-bold">check</span>
                                    </div>
                                    <span class="text-gray-600 font-medium text-base">Community organizations</span>
                                </li>
                            </ul>
                        </div>
                        <div class="flex justify-center relative">
                            <div class="relative w-[280px] h-[450px] bg-gray-900 rounded-[30px] border-[8px] border-gray-800 shadow-2xl overflow-hidden flex flex-col transform lg:scale-110 z-10 parallax-target animate-smooth-float animate-plr-pulse transition-transform will-change-transform"
                                data-speed="0.06" style="transform: translateY(var(--parallax-y, 0));">
                                <div
                                    class="absolute inset-0 bg-gradient-to-tr from-white/10 to-transparent pointer-events-none z-20 rounded-[22px]">
                                </div>
                                <div class="bg-[#1a1a1a] flex-1 w-full h-full flex flex-col relative overflow-hidden">
                                    <div
                                        class="pt-12 px-6 pb-6 text-center z-10 bg-gradient-to-b from-[#1a1a1a] to-transparent">
                                        <span
                                            class="material-symbols-outlined text-gray-400 text-3xl mb-2">verified_user</span>
                                        <h4 class="text-white font-bold text-xl leading-tight uppercase tracking-wider">
                                            Impact<br />License</h4>
                                    </div>
                                    <div class="flex-1 overflow-hidden relative w-full px-6">
                                        <div class="animate-scroll-vertical space-y-4 pb-10">
                                            <div class="space-y-4 text-center">
                                                <p class="text-gray-500 text-xs border-b border-gray-800 pb-2">Share
                                                    with
                                                    your team</p>
                                                <p class="text-gray-500 text-xs border-b border-gray-800 pb-2">Mentor
                                                    your community</p>
                                                <p class="text-gray-500 text-xs border-b border-gray-800 pb-2">Gift to
                                                    friends in need</p>
                                                <p class="text-gray-500 text-xs border-b border-gray-800 pb-2">Use in
                                                    local workshops</p>
                                                <p class="text-gray-500 text-xs border-b border-gray-800 pb-2">Brand as
                                                    your system</p>
                                                <p class="text-gray-500 text-xs border-b border-gray-800 pb-2">Teach
                                                    the methodology</p>
                                                <p class="text-gray-500 text-xs border-b border-gray-800 pb-2">Support
                                                    local youth</p>
                                                <p class="text-gray-500 text-xs border-b border-gray-800 pb-2">Build
                                                    accountability groups</p>
                                            </div>
                                            <div class="space-y-4 text-center">
                                                <p class="text-gray-500 text-xs border-b border-gray-800 pb-2">Share
                                                    with
                                                    your team</p>
                                                <p class="text-gray-500 text-xs border-b border-gray-800 pb-2">Mentor
                                                    your community</p>
                                                <p class="text-gray-500 text-xs border-b border-gray-800 pb-2">Gift to
                                                    friends in need</p>
                                                <p class="text-gray-500 text-xs border-b border-gray-800 pb-2">Use in
                                                    local workshops</p>
                                                <p class="text-gray-500 text-xs border-b border-gray-800 pb-2">Brand as
                                                    your system</p>
                                                <p class="text-gray-500 text-xs border-b border-gray-800 pb-2">Teach
                                                    the methodology</p>
                                                <p class="text-gray-500 text-xs border-b border-gray-800 pb-2">Support
                                                    local youth</p>
                                                <p class="text-gray-500 text-xs border-b border-gray-800 pb-2">Build
                                                    accountability groups</p>
                                            </div>
                                        </div>
                                        <div
                                            class="absolute top-0 left-0 right-0 h-10 bg-gradient-to-b from-[#1a1a1a] to-transparent z-10">
                                        </div>
                                        <div
                                            class="absolute bottom-0 left-0 right-0 h-20 bg-gradient-to-t from-[#1a1a1a] to-transparent z-10">
                                        </div>
                                    </div>
                                    <div
                                        class="absolute -bottom-8 -right-8 w-24 h-24 bg-white transform rotate(12deg) shadow-2xl z-30 rounded-tl-3xl">
                                    </div>
                                    <div
                                        class="absolute -bottom-8 -left-8 w-24 h-24 bg-white transform -rotate(12deg) shadow-2xl z-30 rounded-tr-3xl">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="flex flex-col lg:items-start">
                            <span class="text-gray-400 font-bold tracking-widest text-xs uppercase mb-4">Beyond
                                Yourself</span>
                            <h3 class="text-2xl font-black text-gray-900 mb-8">Create big things</h3>
                            <ul class="space-y-6">
                                <li class="flex items-center gap-4">
                                    <div
                                        class="w-6 h-6 rounded-full bg-secondary flex items-center justify-center flex-shrink-0">
                                        <span
                                            class="material-symbols-outlined text-white text-sm font-bold">check</span>
                                    </div>
                                    <span class="text-gray-600 font-medium text-base">Build accountability
                                        circles</span>
                                </li>
                                <li class="flex items-center gap-4">
                                    <div
                                        class="w-6 h-6 rounded-full bg-secondary flex items-center justify-center flex-shrink-0">
                                        <span
                                            class="material-symbols-outlined text-white text-sm font-bold">check</span>
                                    </div>
                                    <span class="text-gray-600 font-medium text-base">Transform team dynamics</span>
                                </li>
                                <li class="flex items-center gap-4">
                                    <div
                                        class="w-6 h-6 rounded-full bg-secondary flex items-center justify-center flex-shrink-0">
                                        <span
                                            class="material-symbols-outlined text-white text-sm font-bold">check</span>
                                    </div>
                                    <span class="text-gray-600 font-medium text-base">Mentor future leaders</span>
                                </li>
                                <li class="flex items-center gap-4">
                                    <div
                                        class="w-6 h-6 rounded-full bg-secondary flex items-center justify-center flex-shrink-0">
                                        <span
                                            class="material-symbols-outlined text-white text-sm font-bold">check</span>
                                    </div>
                                    <span class="text-gray-600 font-medium text-base">Teach system-based
                                        thinking</span>
                                </li>
                                <li class="flex items-center gap-4">
                                    <div
                                        class="w-6 h-6 rounded-full bg-secondary flex items-center justify-center flex-shrink-0">
                                        <span
                                            class="material-symbols-outlined text-white text-sm font-bold">check</span>
                                    </div>
                                    <span class="text-gray-600 font-medium text-base">Replace hype with habits</span>
                                </li>
                                <li class="flex items-center gap-4">
                                    <div
                                        class="w-6 h-6 rounded-full bg-secondary flex items-center justify-center flex-shrink-0">
                                        <span
                                            class="material-symbols-outlined text-white text-sm font-bold">check</span>
                                    </div>
                                    <span class="text-gray-600 font-medium text-base">Build a culture of
                                        execution</span>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </section>
            <!-- NEW: Radial Orbital Timeline Section -->
            <section
                class="reveal-on-scroll relative z-0 w-full overflow-hidden bg-white py-16 min-h-[1000px] flex flex-col items-center justify-center scroll-mt-28"
                id="about">
                <!-- Premium Light Texture Background -->
                <div class="absolute inset-0 pointer-events-none">
                    <div
                        class="absolute inset-0 bg-[radial-gradient(#e2e8f0_1px,transparent_1px)] [background-size:24px_24px] opacity-70">
                    </div>
                    <div
                        class="absolute top-0 left-0 w-full h-full bg-gradient-to-b from-white via-transparent to-white">
                    </div>
                </div>

                <div class="relative z-10 text-center mb-10 max-w-3xl px-6">
                    <div
                        class="inline-flex items-center gap-2 rounded-full border border-primary/20 bg-white shadow-sm px-4 py-1.5 mb-4">
                        <div class="h-2 w-2 rounded-full bg-primary animate-pulse"></div>
                        <span class="text-xs font-bold text-primary uppercase tracking-widest">Your Roadmap</span>
                    </div>
                    <h2 class="text-4xl md:text-6xl font-black text-slate-900 tracking-tight mb-6">
                        The Learning <span
                            class="text-transparent bg-clip-text bg-gradient-to-r from-primary to-secondary">Journey</span>
                    </h2>
                    <p class="text-slate-500 text-xl leading-relaxed">
                        Explore the interconnected areas of personal development covered in our discipline system.
                    </p>
                </div>

                <!-- Radial Orbital Timeline Container -->
                <div id="radial-timeline-container"
                    class="relative w-full h-[800px] flex items-center justify-center cursor-pointer select-none overflow-visible">
                    <!-- Orbit Container (Rotates) -->
                    <div id="orbit-container" class="absolute w-full h-full flex items-center justify-center">

                        <!-- Center Core -->
                        <div
                            class="absolute z-10 w-24 h-24 rounded-full bg-gradient-to-br from-secondary to-orange-600 shadow-2xl flex items-center justify-center animate-pulse">
                            <div
                                class="absolute w-32 h-32 rounded-full border border-secondary/30 animate-ping opacity-50">
                            </div>
                            <div class="absolute w-48 h-48 rounded-full border border-secondary/10 animate-ping opacity-30"
                                style="animation-delay: 0.5s;"></div>
                            <div class="w-10 h-10 rounded-full bg-white/90 backdrop-blur-md"></div>
                        </div>

                        <!-- Orbit Rings (Visual) -->
                        <div
                            class="absolute w-[300px] h-[300px] rounded-full border border-slate-200 pointer-events-none opacity-60">
                        </div>
                        <div
                            class="absolute w-[500px] h-[500px] rounded-full border border-slate-200 pointer-events-none opacity-40">
                        </div>
                        <div
                            class="absolute w-[700px] h-[700px] rounded-full border border-slate-100 pointer-events-none opacity-30">
                        </div>

                        <!-- Nodes will be injected here by JS -->
                    </div>
                </div>

                <script>
                    document.addEventListener('DOMContentLoaded', () => {
                        const timelineData = [
                            {
                                id: 1,
                                title: "Self-Awareness",
                                content: "Identify your triggers and loops. Map your internal landscape to navigate it consciously.",
                                icon: "visibility"
                            },
                            {
                                id: 2,
                                title: "System Building",
                                content: "Replace motivation with reliable protocols. Build personal infrastructure for consistency.",
                                icon: "settings_suggest"
                            },
                            {
                                id: 3,
                                title: "Mindset Shift",
                                content: "Rewire your narrative from 'I can't' to 'I am the type of person who does.'",
                                icon: "psychology"
                            },
                            {
                                id: 4,
                                title: "Atomic Habits",
                                content: "Master small, consistent actions that compound into massive results over time.",
                                icon: "repeat"
                            },
                            {
                                id: 5,
                                title: "Environment",
                                content: "Curate your physical and digital spaces to minimize friction and force focus.",
                                icon: "grid_view"
                            }
                        ];

                        const container = document.getElementById('radial-timeline-container');
                        const orbitContainer = document.getElementById('orbit-container');
                        let nodes = [];
                        let rotationAngle = 0;
                        let autoRotate = true;
                        let activeNodeId = null;
                        const radius = 250;
                        const total = timelineData.length;

                        function createNodes() {
                            timelineData.forEach((item, index) => {
                                // Calculate angle (distributed evenly)
                                const angleDeg = (index / total) * 360;

                                const nodeEl = document.createElement('div');
                                nodeEl.className = 'absolute flex items-center justify-center cursor-pointer transition-all duration-500 ease-out group';
                                nodeEl.dataset.id = item.id;
                                nodeEl.dataset.angle = angleDeg;

                                // Inner Content
                                nodeEl.innerHTML = `
                                    <div class="node-pulse absolute inset-0 rounded-full bg-secondary/10 opacity-0 transition-opacity duration-300 scale-150"></div>
                                    <div class="node-core relative w-12 h-12 rounded-full bg-white border-2 border-slate-200 shadow-lg flex items-center justify-center transition-all duration-300 group-hover:scale-110 group-hover:border-secondary group-hover:shadow-secondary/20 z-20">
                                        <span class="material-symbols-outlined text-slate-500 text-xl transition-colors group-hover:text-secondary">${item.icon}</span>
                                    </div>
                                    <div class="node-label absolute top-14 text-sm font-bold text-slate-600 bg-white/80 px-2 py-1 rounded backdrop-blur-sm shadow-sm opacity-100 transition-opacity duration-300 pointer-events-none whitespace-nowrap z-10">
                                        ${item.title}
                                    </div>
                                    
                                    <!-- EXPANDED CARD (Simplifed) -->
                                    <div class="node-card absolute top-20 left-1/2 -translate-x-1/2 w-72 bg-white/95 backdrop-blur-xl border border-slate-200 shadow-2xl rounded-xl p-5 opacity-0 pointer-events-none scale-90 transition-all duration-300 origin-top z-50 text-center">
                                        <div class="absolute -top-2 left-1/2 -translate-x-1/2 w-4 h-4 bg-white border-t border-l border-slate-200 rotate-45 transform"></div>
                                        <h4 class="font-bold text-slate-900 text-lg mb-2">${item.title}</h4>
                                        <p class="text-sm text-slate-500 leading-relaxed">${item.content}</p>
                                    </div>
                                `;

                                nodeEl.addEventListener('click', (e) => {
                                    e.stopPropagation();
                                    toggleNode(item.id);
                                });

                                orbitContainer.appendChild(nodeEl);
                                nodes.push({ el: nodeEl, angle: angleDeg });
                            });
                        }

                        // Animation Loop
                        function animate() {
                            if (autoRotate) {
                                rotationAngle = (rotationAngle + 0.05) % 360; // Slower speed (was 0.2)
                            }
                            updatePositions();
                            requestAnimationFrame(animate);
                        }

                        function updatePositions() {
                            const centerX = orbitContainer.clientWidth / 2; // Should be center if flex centered
                            // Since parent is flex center, elements are centered.
                            // translate(0,0) is center.

                            nodes.forEach(node => {
                                const currentAngle = (node.angle + rotationAngle) % 360;
                                const rad = (currentAngle * Math.PI) / 180;

                                // Calculate X and Y based on current rotation
                                const x = Math.cos(rad) * radius;
                                const y = Math.sin(rad) * radius;

                                node.el.style.transform = `translate(${x}px, ${y}px)`;
                            });
                        }

                        function toggleNode(id) {
                            if (activeNodeId === id) {
                                // Close
                                activeNodeId = null;
                                autoRotate = true;

                                // Reset styles
                                nodes.forEach(n => {
                                    const card = n.el.querySelector('.node-card');
                                    const label = n.el.querySelector('.node-label');
                                    const core = n.el.querySelector('.node-core');

                                    card.classList.remove('opacity-100', 'pointer-events-auto', 'scale-100');
                                    card.classList.add('opacity-0', 'pointer-events-none', 'scale-90');

                                    // SHOW label again
                                    label.classList.remove('opacity-0');
                                    label.classList.add('opacity-100');

                                    core.classList.remove('scale-125', 'border-secondary', 'bg-slate-900', 'text-white');
                                    core.classList.add('bg-white');
                                    core.querySelector('span').classList.remove('text-white');
                                    core.querySelector('span').classList.add('text-slate-500');

                                    n.el.style.zIndex = 10;
                                });

                            } else {
                                // Open
                                activeNodeId = id;
                                autoRotate = false;

                                // Move active node to TOP (270 degrees / -90 degrees)
                                const targetNode = nodes.find(n => n.el.dataset.id == id);

                                // We want (targetNode.angle + rotationAngle) % 360 = 270 (or -90)
                                // rotationAngle = 270 - targetNode.angle
                                let targetRotation = 270 - targetNode.angle;

                                // Smooth transition logic could be added here, but instant snap is requested implied by "berhenti berputar"
                                rotationAngle = targetRotation;
                                updatePositions();

                                // Update Styles
                                nodes.forEach(n => {
                                    const isTarget = n.el.dataset.id == id;
                                    const card = n.el.querySelector('.node-card');
                                    const label = n.el.querySelector('.node-label');
                                    const core = n.el.querySelector('.node-core');

                                    if (isTarget) {
                                        n.el.style.zIndex = 50;
                                        card.classList.remove('opacity-0', 'pointer-events-none', 'scale-90');
                                        card.classList.add('opacity-100', 'pointer-events-auto', 'scale-100');

                                        // HIDE label
                                        label.classList.remove('opacity-100');
                                        label.classList.add('opacity-0');

                                        core.classList.add('scale-125', 'border-secondary', 'bg-slate-900', 'text-white');
                                        core.classList.remove('bg-white');
                                        core.querySelector('span').classList.add('text-white');
                                        core.querySelector('span').classList.remove('text-slate-500');
                                    } else {
                                        n.el.style.zIndex = 10;
                                        card.classList.remove('opacity-100', 'pointer-events-auto', 'scale-100');
                                        card.classList.add('opacity-0', 'pointer-events-none', 'scale-90');

                                        // Ensure other labels are visible (or hidden if desired? usually visible)
                                        label.classList.remove('opacity-0');
                                        label.classList.add('opacity-100');

                                        // Reset others
                                        core.classList.remove('scale-125', 'border-secondary', 'bg-slate-900', 'text-white');
                                        core.classList.add('bg-white');
                                        core.querySelector('span').classList.remove('text-white');
                                        core.querySelector('span').classList.add('text-slate-500');
                                    }
                                });
                            }
                        }

                        // Background click to close
                        container.addEventListener('click', (e) => {
                            if (activeNodeId !== null) {
                                toggleNode(activeNodeId); // Toggling visible node closes it
                            }
                        });


                        // Initialization
                        createNodes();
                        animate();
                    });
                </script>
            </section>
            <section
                class="reveal-on-scroll relative z-10 w-full overflow-hidden bg-slate-950 py-24 rounded-[40px] shadow-2xl scroll-mt-28 border border-slate-800 hover:border-slate-700 transition-colors duration-700 group"
                id="portfolio">
                <!-- Clean Minimal Background -->
                <div class="absolute inset-0 pointer-events-none overflow-hidden">
                    <div
                        class="absolute inset-0 bg-[linear-gradient(to_right,#ffffff03_1px,transparent_1px),linear-gradient(to_bottom,#ffffff03_1px,transparent_1px)] bg-[size:48px_48px]">
                    </div>
                    <!-- Soft Top Glow -->
                    <div class="absolute top-0 left-1/2 -translate-x-1/2 w-[600px] h-[400px] bg-primary/10 blur-[100px] rounded-full pointer-events-none"></div>
                </div>

                <div class="flex justify-center relative z-10">
                    <div class="w-full max-w-7xl px-6 md:px-12">
                        <div class="text-center mb-16">
                            <div
                                class="inline-flex items-center gap-2 rounded-full border border-primary/20 bg-white shadow-sm px-4 py-1.5 mb-6">
                                <div class="h-2 w-2 rounded-full bg-primary animate-pulse"></div>
                                <span class="text-xs font-bold text-primary uppercase tracking-widest">The
                                    Collection</span>
                            </div>
                            <h2 class="text-4xl md:text-5xl font-extrabold tracking-tight text-white mb-6">Complete
                                Book
                                Series</h2>
                            <div
                                class="h-1.5 w-24 bg-primary rounded-full mx-auto shadow-[0_0_15px_rgba(249,115,22,0.5)]">
                            </div>
                            <p class="mt-8 text-gray-400 max-w-2xl mx-auto text-lg leading-relaxed">
                                Our discipline framework spans multiple volumes, each targeting specific areas of
                                personal growth.
                            </p>
                        </div>
                        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                            <div
                                class="group relative flex flex-col p-8 bg-slate-900/40 rounded-[2rem] border border-slate-800 hover:border-slate-600 hover:bg-slate-900/60 hover:shadow-2xl hover:shadow-secondary/10 hover:-translate-y-2 transition-all duration-500 overflow-hidden backdrop-blur-sm">
                                <div class="relative h-64 w-full flex items-center justify-center mb-6 z-0">
                                    <img alt="Book Layer 1"
                                        class="absolute w-40 h-60 object-cover rounded-lg shadow-md border border-white/20 transition-all duration-500 ease-out opacity-80 group-hover:opacity-100 group-hover:rotate-[-12deg] group-hover:-translate-x-12 z-10"
                                        src="https://lh3.googleusercontent.com/aida-public/AB6AXuAqQAUN9Hpv4fYdlVu2ZhzrNHJLaDmpWXXGl_RUQ1HbufrtOvFYR39hbKF0LURl1Bj26eSxGlzBiB74lM71FGv52bIWgrNnPgJpSA6SL6yXEbmQJuvjy19tqgdeLv9csqps6sqw1cBbO_cCaqe9u6gyv0tu07cI-61XPJT-UZZnqeIZ6oX6wvkcX9HipHJgJf5gYxwcBNyShTqvXus47C_pZd_5Foqx1fGWUjL06CaorMSHq02lZ4VVoI0s1Mu460YVBx4qF2GHCvM" />
                                    <img alt="Book Layer 2"
                                        class="absolute w-40 h-60 object-cover rounded-lg shadow-md border border-white/20 transition-all duration-500 ease-out opacity-80 group-hover:opacity-100 group-hover:rotate-[12deg] group-hover:translate-x-12 z-10"
                                        src="https://lh3.googleusercontent.com/aida-public/AB6AXuAqQAUN9Hpv4fYdlVu2ZhzrNHJLaDmpWXXGl_RUQ1HbufrtOvFYR39hbKF0LURl1Bj26eSxGlzBiB74lM71FGv52bIWgrNnPgJpSA6SL6yXEbmQJuvjy19tqgdeLv9csqps6sqw1cBbO_cCaqe9u6gyv0tu07cI-61XPJT-UZZnqeIZ6oX6wvkcX9HipHJgJf5gYxwcBNyShTqvXus47C_pZd_5Foqx1fGWUjL06CaorMSHq02lZ4VVoI0s1Mu460YVBx4qF2GHCvM" />
                                    <img alt="Book Cover"
                                        class="relative w-40 h-60 object-cover rounded-lg shadow-2xl border-2 border-white/10 z-20 transition-all duration-500 group-hover:scale-105"
                                        src="https://lh3.googleusercontent.com/aida-public/AB6AXuAqQAUN9Hpv4fYdlVu2ZhzrNHJLaDmpWXXGl_RUQ1HbufrtOvFYR39hbKF0LURl1Bj26eSxGlzBiB74lM71FGv52bIWgrNnPgJpSA6SL6yXEbmQJuvjy19tqgdeLv9csqps6sqw1cBbO_cCaqe9u6gyv0tu07cI-61XPJT-UZZnqeIZ6oX6wvkcX9HipHJgJf5gYxwcBNyShTqvXus47C_pZd_5Foqx1fGWUjL06CaorMSHq02lZ4VVoI0s1Mu460YVBx4qF2GHCvM" />
                                </div>
                                <h3 class="text-xl font-bold text-white leading-tight mb-3">Echoes of
                                    the Void</h3>
                                <p class="text-gray-400 leading-relaxed text-sm">
                                    A journey through space and time that challenges the perception of reality itself.
                                </p>
                            </div>
                            <div
                                class="group relative flex flex-col p-8 bg-slate-900/40 rounded-[2rem] border border-slate-800 hover:border-slate-600 hover:bg-slate-900/60 hover:shadow-2xl hover:shadow-secondary/10 hover:-translate-y-2 transition-all duration-500 overflow-hidden backdrop-blur-sm">
                                <div class="relative h-64 w-full flex items-center justify-center mb-6 z-0">
                                    <img alt="Book Layer 1"
                                        class="absolute w-40 h-60 object-cover rounded-lg shadow-md border border-white/20 transition-all duration-500 ease-out opacity-80 group-hover:opacity-100 group-hover:rotate-[-12deg] group-hover:-translate-x-12 z-10"
                                        src="https://lh3.googleusercontent.com/aida-public/AB6AXuAgVsaHLBvXrE6w-xt4xnTBbuW5AU2e9BFE_9cY5vfcDc5DphdsyCJF-BCCOR5fmTvP3YlsXiS726qlF_tcazn-CbYPIxR5t0N2iGfsNAanPtunuWXGEApJKOEG66FR64c4T7hA5uuvWj9e_atoFbZW2dWNbFKUeFxC42-cGtPvrUzHO84W6ZD_o72zdiGQq_tp8jMwqEC5LTzz2zVPsMQRWa7IN2xKoG249oHfh_cNn4ZhEjSyAtYlehi0dyCE9lFsWX3pDivetSg" />
                                    <img alt="Book Layer 2"
                                        class="absolute w-40 h-60 object-cover rounded-lg shadow-md border border-white/20 transition-all duration-500 ease-out opacity-80 group-hover:opacity-100 group-hover:rotate-[12deg] group-hover:translate-x-12 z-10"
                                        src="https://lh3.googleusercontent.com/aida-public/AB6AXuAgVsaHLBvXrE6w-xt4xnTBbuW5AU2e9BFE_9cY5vfcDc5DphdsyCJF-BCCOR5fmTvP3YlsXiS726qlF_tcazn-CbYPIxR5t0N2iGfsNAanPtunuWXGEApJKOEG66FR64c4T7hA5uuvWj9e_atoFbZW2dWNbFKUeFxC42-cGtPvrUzHO84W6ZD_o72zdiGQq_tp8jMwqEC5LTzz2zVPsMQRWa7IN2xKoG249oHfh_cNn4ZhEjSyAtYlehi0dyCE9lFsWX3pDivetSg" />
                                    <img alt="Book Cover"
                                        class="relative w-40 h-60 object-cover rounded-lg shadow-2xl border-2 border-white/10 z-20 transition-all duration-500 group-hover:scale-105"
                                        src="https://lh3.googleusercontent.com/aida-public/AB6AXuAgVsaHLBvXrE6w-xt4xnTBbuW5AU2e9BFE_9cY5vfcDc5DphdsyCJF-BCCOR5fmTvP3YlsXiS726qlF_tcazn-CbYPIxR5t0N2iGfsNAanPtunuWXGEApJKOEG66FR64c4T7hA5uuvWj9e_atoFbZW2dWNbFKUeFxC42-cGtPvrUzHO84W6ZD_o72zdiGQq_tp8jMwqEC5LTzz2zVPsMQRWa7IN2xKoG249oHfh_cNn4ZhEjSyAtYlehi0dyCE9lFsWX3pDivetSg" />
                                </div>
                                <h3 class="text-xl font-bold text-white leading-tight mb-3">Digital
                                    Renaissance</h3>
                                <p class="text-gray-400 leading-relaxed text-sm">
                                    Exploring how modern technology is reshaping the creative landscape for artists.
                                </p>
                            </div>
                            <div
                                class="group relative flex flex-col p-8 bg-slate-900/40 rounded-[2rem] border border-slate-800 hover:border-slate-600 hover:bg-slate-900/60 hover:shadow-2xl hover:shadow-secondary/10 hover:-translate-y-2 transition-all duration-500 overflow-hidden backdrop-blur-sm">
                                <div class="relative h-64 w-full flex items-center justify-center mb-6 z-0">
                                    <img alt="Book Layer 1"
                                        class="absolute w-40 h-60 object-cover rounded-lg shadow-md border border-white/20 transition-all duration-500 ease-out opacity-80 group-hover:opacity-100 group-hover:rotate-[-12deg] group-hover:-translate-x-12 z-10"
                                        src="https://lh3.googleusercontent.com/aida-public/AB6AXuC7veN4LzkfNO-ZXYNdPyIqb7hNQdn6dErDu3fKuqiGzQfTANwMyIkqklfTuz_CoNxEwfD-5oQgN19G28O0EjNJma_pqNpsCYF6QmY2mZhCKNA6lpPb8t5cBW2OspOHwlgesk5UuFr9XzRQlsKmddwNY2Ch55rcWazsZZwR6txbnsKPzr5WoiyAKFqRygCPsJNjxsfx_ogDekCc2I4pXcMMMDFhpEpfxOPA8F6dM4EkqqVddd_9qPPcyPdHjAUT8VdNtRkPD2kuXUs" />
                                    <img alt="Book Layer 2"
                                        class="absolute w-40 h-60 object-cover rounded-lg shadow-md border border-white/20 transition-all duration-500 ease-out opacity-80 group-hover:opacity-100 group-hover:rotate-[12deg] group-hover:translate-x-12 z-10"
                                        src="https://lh3.googleusercontent.com/aida-public/AB6AXuC7veN4LzkfNO-ZXYNdPyIqb7hNQdn6dErDu3fKuqiGzQfTANwMyIkqklfTuz_CoNxEwfD-5oQgN19G28O0EjNJma_pqNpsCYF6QmY2mZhCKNA6lpPb8t5cBW2OspOHwlgesk5UuFr9XzRQlsKmddwNY2Ch55rcWazsZZwR6txbnsKPzr5WoiyAKFqRygCPsJNjxsfx_ogDekCc2I4pXcMMMDFhpEpfxOPA8F6dM4EkqqVddd_9qPPcyPdHjAUT8VdNtRkPD2kuXUs" />
                                    <img alt="Book Cover"
                                        class="relative w-40 h-60 object-cover rounded-lg shadow-xl border-2 border-white/10 z-20 transition-all duration-500 group-hover:scale-105"
                                        src="https://lh3.googleusercontent.com/aida-public/AB6AXuC7veN4LzkfNO-ZXYNdPyIqb7hNQdn6dErDu3fKuqiGzQfTANwMyIkqklfTuz_CoNxEwfD-5oQgN19G28O0EjNJma_pqNpsCYF6QmY2mZhCKNA6lpPb8t5cBW2OspOHwlgesk5UuFr9XzRQlsKmddwNY2Ch55rcWazsZZwR6txbnsKPzr5WoiyAKFqRygCPsJNjxsfx_ogDekCc2I4pXcMMMDFhpEpfxOPA8F6dM4EkqqVddd_9qPPcyPdHjAUT8VdNtRkPD2kuXUs" />
                                </div>
                                <h3 class="text-xl font-bold text-white leading-tight mb-3">The
                                    Silent Protocol</h3>
                                <p class="text-gray-400 leading-relaxed text-sm">
                                    A high-stakes cyber thriller that will keep you on the edge of your seat until the
                                    last page.
                                </p>
                            </div>
                        </div>
                        <div class="mt-16 text-center">
                            <button
                                class="inline-flex items-center gap-2 rounded-full bg-primary px-8 py-3 text-sm font-bold text-white transition-all hover:bg-orange-600 hover:shadow-lg hover:shadow-orange-500/25 hover:-translate-y-0.5">
                                View Full Portfolio
                                <span class="material-symbols-outlined text-lg">arrow_forward</span>
                            </button>
                        </div>
                    </div>
                </div>
            </section>
            <!-- NEW: Transformation/Benefits Section -->
            <section
                class="reveal-on-scroll relative z-0 w-full overflow-hidden bg-white dark:bg-background-dark py-24 min-h-[900px] flex flex-col items-center justify-center scroll-mt-28">
                <!-- Qualifiers Content (merged) -->
                <div class="max-w-5xl mx-auto px-6 md:px-12">
                    <div class="text-center mb-16">
                        <div
                            class="inline-flex items-center gap-2 rounded-full border border-secondary/20 bg-white shadow-sm px-4 py-1.5 mb-6">
                            <div class="h-2 w-2 rounded-full bg-secondary animate-pulse"></div>
                            <span class="text-xs font-bold text-secondary uppercase tracking-widest">Important
                                Warning</span>
                        </div>
                        <h2 class="text-4xl md:text-5xl font-black text-gray-900 dark:text-white mb-6 tracking-tight">
                            This Is <span
                                class="text-transparent bg-clip-text bg-gradient-to-r from-primary to-secondary">Not</span>
                            For Everyone
                        </h2>
                        <p class="text-lg text-gray-600 dark:text-gray-400 max-w-2xl mx-auto leading-relaxed">
                            Before you continue, be honest with yourself. This requires work.
                        </p>
                    </div>
                    <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">
                        <!-- NOT For You -->
                        <div
                            class="bg-white dark:bg-gray-800 rounded-3xl p-8 shadow-lg border border-gray-100 dark:border-gray-700 hover:shadow-xl transition-shadow group">
                            <div
                                class="w-14 h-14 rounded-2xl bg-primary/10 flex items-center justify-center mb-6 group-hover:scale-110 transition-transform">
                                <span class="material-symbols-outlined text-primary text-2xl">close</span>
                            </div>
                            <h3 class="text-xl font-black text-gray-900 dark:text-white mb-6">NOT For You If...</h3>
                            <ul class="space-y-4">
                                <li class="flex items-start gap-3">
                                    <span class="material-symbols-outlined text-primary text-lg mt-0.5">remove</span>
                                    <span class="text-gray-600 dark:text-gray-400">You only want entertainment -
                                        another
                                        book to read and
                                        forget</span>
                                </li>
                                <li class="flex items-start gap-3">
                                    <span class="material-symbols-outlined text-primary text-lg mt-0.5">remove</span>
                                    <span class="text-gray-600 dark:text-gray-400">You are waiting to be "saved" by
                                        external
                                        motivation</span>
                                </li>
                                <li class="flex items-start gap-3">
                                    <span class="material-symbols-outlined text-primary text-lg mt-0.5">remove</span>
                                    <span class="text-gray-600 dark:text-gray-400">You want instant transformation
                                        without doing the
                                        work</span>
                                </li>
                                <li class="flex items-start gap-3">
                                    <span class="material-symbols-outlined text-primary text-lg mt-0.5">remove</span>
                                    <span class="text-gray-600 dark:text-gray-400">You're not willing to be
                                        uncomfortable for a
                                        while</span>
                                </li>
                            </ul>
                        </div>
                        <!-- FOR You -->
                        <div
                            class="bg-white dark:bg-gray-800 rounded-3xl p-8 shadow-lg border border-gray-100 dark:border-gray-700 hover:shadow-xl transition-shadow group">
                            <div
                                class="w-14 h-14 rounded-2xl bg-blue-500/10 flex items-center justify-center mb-6 group-hover:scale-110 transition-transform">
                                <span class="material-symbols-outlined text-blue-600 text-2xl">check</span>
                            </div>
                            <h3 class="text-xl font-black text-gray-900 dark:text-white mb-6">FOR You If...</h3>
                            <ul class="space-y-4">
                                <li class="flex items-start gap-3">
                                    <span class="material-symbols-outlined text-blue-600 text-lg mt-0.5">add</span>
                                    <span class="text-gray-600 dark:text-gray-400">You are 16 to 25 and feel like
                                        you're
                                        wasting your
                                        potential</span>
                                </li>
                                <li class="flex items-start gap-3">
                                    <span class="material-symbols-outlined text-blue-600 text-lg mt-0.5">add</span>
                                    <span class="text-gray-600 dark:text-gray-400">You feel mentally exhausted and
                                        stuck
                                        in loops</span>
                                </li>
                                <li class="flex items-start gap-3">
                                    <span class="material-symbols-outlined text-blue-600 text-lg mt-0.5">add</span>
                                    <span class="text-gray-600 dark:text-gray-400">You have a small intention to get
                                        your life
                                        together</span>
                                </li>
                                <li class="flex items-start gap-3">
                                    <span class="material-symbols-outlined text-blue-600 text-lg mt-0.5">add</span>
                                    <span class="text-gray-600 dark:text-gray-400">You're ready to try something
                                        that
                                        actually works</span>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </section>
            <!-- NEW: Final CTA Section -->
            <section
                class="reveal-on-scroll relative z-10 w-full overflow-hidden bg-slate-950 py-20 rounded-[40px] mt-16 border border-slate-800 hover:border-slate-700 transition-colors duration-700 shadow-2xl group">
                
                <!-- Clean Minimal Background -->
                <div class="absolute inset-0 pointer-events-none overflow-hidden">
                    <!-- Subtle clean grid -->
                    <div
                        class="absolute inset-0 bg-[linear-gradient(to_right,#ffffff03_1px,transparent_1px),linear-gradient(to_bottom,#ffffff03_1px,transparent_1px)] bg-[size:48px_48px]">
                    </div>
                    <!-- Soft Top Glow (Not overpowering) -->
                    <div class="absolute top-0 left-1/2 -translate-x-1/2 w-[500px] h-[300px] bg-primary/10 blur-[80px] rounded-full pointer-events-none"></div>
                </div>

                <div class="max-w-4xl mx-auto px-6 md:px-12 text-center relative z-10">
                    
                    <!-- Minimal Badge -->
                    <div class="inline-flex flex-col items-center mb-8 reveal-on-scroll">
                        <span class="w-px h-6 bg-gradient-to-b from-transparent to-primary/30 mb-4 block"></span>
                        <div class="inline-flex items-center gap-2 border border-white/10 bg-white/5 rounded-full px-4 py-1.5 backdrop-blur-md">
                            <span class="w-1.5 h-1.5 rounded-full bg-primary animate-pulse"></span>
                            <span class="text-xs font-bold text-slate-300 tracking-widest uppercase">The Turning Point</span>
                        </div>
                    </div>

                    <!-- Clean Headline -->
                    <h2 class="text-4xl md:text-5xl font-black text-white mb-8 tracking-tight leading-[1.1] reveal-on-scroll delay-100">
                        The Choice Is<br>
                        <span class="text-slate-400">Absolutely Simple.</span>
                    </h2>

                    <!-- Clean Choices (Horizontal alignment for Side-by-Side look) -->
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-10 max-w-4xl mx-auto reveal-on-scroll delay-200 text-left">
                        
                        <!-- Choice A: Subtle Box -->
                        <div class="flex flex-col gap-4 p-6 rounded-[24px] border border-slate-800/50 bg-slate-900/30 hover:bg-slate-900/80 hover:border-slate-700 transition-all duration-300 group/item backdrop-blur-sm">
                            <div class="w-12 h-12 rounded-full bg-slate-800/80 flex items-center justify-center shrink-0 group-hover/item:-translate-y-1 transition-transform duration-300 shadow-inner">
                                <span class="material-symbols-outlined text-slate-500 text-xl">swipe_down</span>
                            </div>
                            <p class="text-slate-400 font-medium text-base leading-relaxed">
                                Keep scrolling, keep overthinking, keep breaking promises to yourself.
                            </p>
                        </div>
                        
                        <!-- Choice B: Highlighted Box -->
                        <div class="flex flex-col gap-4 p-6 rounded-[24px] border border-primary/30 bg-primary/5 hover:bg-primary/10 hover:border-primary/50 transition-all duration-300 group/item backdrop-blur-sm shadow-[0_0_30px_rgba(249,115,22,0.05)]">
                            <div class="w-12 h-12 rounded-full bg-primary/20 flex items-center justify-center shrink-0 group-hover/item:-translate-y-1 transition-transform duration-300">
                                <span class="material-symbols-outlined text-primary text-xl">rocket_launch</span>
                            </div>
                            <p class="text-white font-bold text-base leading-relaxed">
                                Or start building the systems that pull your life out of chaos.
                            </p>
                        </div>

                    </div>

                    <!-- Focus CTA Button -->
                    <div class="relative inline-block group reveal-on-scroll delay-300">
                        <!-- Subtle hover ring -->
                        <div class="absolute -inset-1 bg-gradient-to-r from-primary to-orange-500 rounded-full blur opacity-30 group-hover:opacity-70 transition duration-500"></div>
                        
                        <a href="#library"
                            class="relative inline-flex items-center gap-3 bg-white text-slate-900 px-8 py-4 rounded-full font-bold text-lg transform group-hover:scale-[1.02] transition-all duration-300 overflow-hidden isolate">
                            
                            <!-- Shimmer effect -->
                            <div class="absolute inset-0 -translate-x-full bg-gradient-to-r from-transparent via-slate-100/50 to-transparent group-hover:animate-[shimmer_1.5s_infinite] -z-10"></div>
                            
                            Get Discipline Blueprint Now
                            <span class="material-symbols-outlined text-base group-hover:translate-x-1 transition-transform">arrow_forward</span>
                        </a>
                    </div>
                </div>
            </section>
@endsection

@push('scripts')
<script>

        document.addEventListener('DOMContentLoaded', () => {
            // 1. Reveal Animations
            const observerOptions = {
                root: null,
                rootMargin: '0px',
                threshold: 0.1
            };
            const observer = new IntersectionObserver((entries, observer) => {
                entries.forEach(entry => {
                    if (entry.isIntersecting) {
                        entry.target.classList.add('is-visible');
                        observer.unobserve(entry.target);
                    }
                });
            }, observerOptions);

            document.querySelectorAll('.reveal-on-scroll').forEach(section => {
                observer.observe(section);
            });

            // 2. Spotlight Effect (Orange for Landing Page)
            document.querySelectorAll('.spotlight-card').forEach(card => {
                card.addEventListener('mousemove', e => {
                    const rect = card.getBoundingClientRect();
                    const x = e.clientX - rect.left;
                    const y = e.clientY - rect.top;
                    card.style.setProperty('--mouse-x', `${x}px`);
                    card.style.setProperty('--mouse-y', `${y}px`);
                });
            });

            // 3. Parallax Logic (Existing)
            const parallaxElements = document.querySelectorAll('.parallax-target');
            function updateParallax() {
                const scrollY = window.scrollY;
                parallaxElements.forEach(element => {
                    const speed = element.getAttribute('data-speed') || 0.1;
                    const rect = element.getBoundingClientRect();
                    if (rect.top < window.innerHeight && rect.bottom > 0) {
                        const offset = (window.innerHeight - rect.top) * speed;
                        element.style.setProperty('--parallax-y', `${-offset}px`);
                    }
                });
                requestAnimationFrame(updateParallax);
            }
            window.addEventListener('scroll', () => {
                requestAnimationFrame(updateParallax);
            });
            updateParallax();

            // 4. Interactive 3D Carousel Drag to Explore
            const carousel = document.querySelector('.carousel-cylinder');
            if (carousel) {
                let currentAngle = 0;
                let isDragging = false;
                let startX = 0;
                let currentX = 0;
                let dragVelocity = 0;

                function spinCarousel() {
                    if (!isDragging) {
                        currentAngle -= 0.05; // Speed of auto spin (slowed down)
                        if(Math.abs(dragVelocity) > 0.01) {
                            currentAngle += dragVelocity;
                            dragVelocity *= 0.95; // Friction
                        } else {
                            dragVelocity = 0;
                        }
                        carousel.style.transform = `rotateY(${currentAngle}deg) translateZ(0)`;
                    }
                    requestAnimationFrame(spinCarousel);
                }
                
                requestAnimationFrame(spinCarousel);

                const startDrag = (e) => {
                    isDragging = true;
                    startX = e.type.includes('mouse') ? e.pageX : e.touches[0].pageX;
                    currentX = startX;
                    carousel.style.transition = 'none';
                    dragVelocity = 0;
                };

                const drag = (e) => {
                    if (!isDragging) return;
                    const x = e.type.includes('mouse') ? e.pageX : e.touches[0].pageX;
                    const dx = x - currentX;
                    currentX = x;
                    
                    const deltaAngle = dx * 0.4; // Sensitivity
                    currentAngle += deltaAngle;
                    dragVelocity = deltaAngle;
                    
                    carousel.style.transform = `rotateY(${currentAngle}deg) translateZ(0)`;
                };

                const endDrag = () => {
                    isDragging = false;
                };

                carousel.addEventListener('mousedown', startDrag);
                carousel.addEventListener('touchstart', startDrag, {passive: true});
                
                window.addEventListener('mousemove', drag, {passive: false});
                window.addEventListener('touchmove', drag, {passive: false});
                
                window.addEventListener('mouseup', endDrag);
                window.addEventListener('touchend', endDrag);
            }
        });
</script>
@endpush
