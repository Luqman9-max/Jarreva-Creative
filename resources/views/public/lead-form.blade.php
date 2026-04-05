@extends('public.layouts.app')

@section('title', 'Jarreva Creative - Evolve with Us')

@push ('styles')
<style>
    body {
        font-family: 'Montserrat', sans-serif;
    }

    /* 3D and glow effects */
    .glass-panel {
        background: rgba(255, 255, 255, 0.03);
        backdrop-filter: blur(20px);
        -webkit-backdrop-filter: blur(20px);
        border: 1px solid rgba(255, 255, 255, 0.1);
        box-shadow: 0 25px 50px -12px rgba(0, 0, 0, 0.5), inset 0 0 0 1px rgba(255, 255, 255, 0.05);
    }
    
    .light .glass-panel {
        background: rgba(255, 255, 255, 0.7);
        border: 1px solid rgba(0, 0, 0, 0.05);
        box-shadow: 0 25px 50px -12px rgba(0, 0, 0, 0.05), inset 0 0 0 1px rgba(255, 255, 255, 0.5);
    }

    .glow-bg {
        position: absolute;
        width: 600px;
        height: 600px;
        background: radial-gradient(circle, rgba(249,115,22,0.15) 0%, rgba(19,127,236,0.05) 50%, transparent 70%);
        border-radius: 50%;
        filter: blur(60px);
        z-index: 0;
        pointer-events: none;
        animation: pulse-glow 8s infinite alternate ease-in-out;
    }

    @keyframes pulse-glow {
        0% { transform: scale(0.8) translate(-10%, -10%); opacity: 0.5; }
        100% { transform: scale(1.2) translate(10%, 10%); opacity: 1; }
    }



    /* Form interactions */
    .input-wrapper {
        position: relative;
        transition: all 0.3s ease;
    }

    .input-wrapper:focus-within {
        transform: translateY(-2px);
    }

    .styled-input {
        width: 100%;
        background: rgba(255, 255, 255, 0.05);
        border: 1px solid rgba(255, 255, 255, 0.1);
        color: white;
        padding: 1rem 1rem 1rem 3rem;
        border-radius: 0.75rem;
        transition: all 0.3s ease;
        outline: none;
    }
    
    .light .styled-input {
        background: rgba(255, 255, 255, 0.8);
        border: 1px solid rgba(0, 0, 0, 0.1);
        color: #1a202c;
    }

    .styled-input:focus {
        border-color: #f97316;
        box-shadow: 0 0 0 4px rgba(249, 115, 22, 0.1);
        background: rgba(255, 255, 255, 0.1);
    }
    
    .light .styled-input:focus {
        background: #ffffff;
    }

    .input-icon {
        position: absolute;
        left: 1rem;
        top: 50%;
        transform: translateY(-50%);
        color: rgba(255, 255, 255, 0.4);
        transition: all 0.3s ease;
    }
    
    .light .input-icon {
        color: rgba(0, 0, 0, 0.4);
    }

    .input-wrapper:focus-within .input-icon {
        color: #f97316;
    }

    .submit-btn {
        position: relative;
        overflow: hidden;
        transition: all 0.3s ease;
        background: linear-gradient(90deg, #f97316, #ea580c);
        box-shadow: 0 10px 20px -5px rgba(249, 115, 22, 0.4);
    }

    .submit-btn:hover {
        transform: translateY(-2px) scale(1.02);
        box-shadow: 0 15px 25px -5px rgba(249, 115, 22, 0.5);
    }

    .submit-btn::after {
        content: '';
        position: absolute;
        top: -50%;
        left: -50%;
        width: 200%;
        height: 200%;
        background: radial-gradient(circle, rgba(255,255,255,0.3) 0%, transparent 60%);
        opacity: 0;
        transform: scale(0.5);
        transition: opacity 0.3s, transform 0.3s;
        pointer-events: none;
    }

    .submit-btn:hover::after {
        opacity: 1;
        transform: scale(1);
    }
    
    .fade-in-up {
        animation: fadeInUp 0.8s cubic-bezier(0.16, 1, 0.3, 1) forwards;
        opacity: 0;
        transform: translateY(20px);
    }
    
    .delay-100 { animation-delay: 100ms; }
    .delay-200 { animation-delay: 200ms; }
    .delay-300 { animation-delay: 300ms; }
    
    @keyframes fadeInUp {
        to {
            opacity: 1;
            transform: translateY(0);
        }
    }
</style>
@endpush

@section('content')
<div class="relative min-h-[85vh] flex items-center justify-center overflow-hidden bg-white dark:bg-background-dark py-12">
    
    <!-- Background Grid -->
    <div class="absolute inset-0 z-0 bg-[linear-gradient(to_right,#80808012_1px,transparent_1px),linear-gradient(to_bottom,#80808012_1px,transparent_1px)] bg-[size:24px_24px] pointer-events-none mix-blend-overlay opacity-50 dark:opacity-20"></div>
    
    <!-- Ambient Glow -->
    <div class="glow-bg top-1/2 left-1/2 transform -translate-x-1/2 -translate-y-1/2"></div>
    
    <!-- 3D Form Background -->
    @include('public.components.hero-3d-bg')
    <!-- Main Content Container -->
    <div class="container mx-auto px-4 z-10 relative">
        <div class="max-w-xl mx-auto">
            
            <div class="glass-panel rounded-3xl p-8 md:p-12 fade-in-up">
                
                <!-- Header -->
                <div class="text-center mb-10">
                    <div class="inline-flex items-center justify-center w-16 h-16 rounded-2xl bg-primary/10 mb-6 shadow-inner">
                        <span class="material-symbols-outlined text-primary text-4xl">vpn_key</span>
                    </div>
                    <h1 class="text-3xl md:text-4xl font-bold font-display text-slate-900 dark:text-white mb-4">
                        Unlock the <span class="text-transparent bg-clip-text bg-gradient-to-r from-orange-400 to-primary">Library</span>
                    </h1>
                    <p class="text-slate-600 dark:text-gray-400 text-lg leading-relaxed">
                        Before accessing the catalog, enter your email to receive updates, exclusive insights, and future book releases.
                    </p>
                </div>

                <!-- Form -->
                <form action="{{ route('lead.submit') }}" method="POST" class="space-y-6 fade-in-up delay-100">
                    @csrf
                    
                    <!-- Name Input -->
                    <div class="input-wrapper">
                        <span class="material-symbols-outlined input-icon">person</span>
                        <input type="text" name="name" id="name" required 
                            class="styled-input" 
                            placeholder="Your Name"
                            value="{{ old('name') }}"
                            autocomplete="name">
                        @error ('name')
                            <p class="mt-2 text-sm text-red-500 flex items-center gap-1">
                                <span class="material-symbols-outlined text-xs">error</span>
                                {{ $message }}
                            </p>
                        @enderror
                    </div>

                    <!-- Email Input -->
                    <div class="input-wrapper">
                        <span class="material-symbols-outlined input-icon">mail</span>
                        <input type="email" name="email" id="email" required 
                            class="styled-input" 
                            placeholder="Your Email Address"
                            value="{{ old('email') }}"
                            autocomplete="email">
                        @error ('email')
                            <p class="mt-2 text-sm text-red-500 flex items-center gap-1">
                                <span class="material-symbols-outlined text-xs">error</span>
                                {{ $message }}
                            </p>
                        @enderror
                    </div>

                    <!-- Submit Button -->
                    <button type="submit" class="w-full submit-btn text-white font-bold py-4 px-6 rounded-xl flex items-center justify-center gap-2 mt-4 text-lg">
                        <span>Access Catalog Now</span>
                        <span class="material-symbols-outlined">arrow_forward</span>
                    </button>
                    
                    <div class="text-center mt-6 fade-in-up delay-200">
                        <p class="text-xs text-slate-500 dark:text-gray-500 font-medium flex items-center justify-center gap-1">
                            <span class="material-symbols-outlined text-[14px]">lock</span>
                            Your data is secure. We don't spam.
                        </p>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
