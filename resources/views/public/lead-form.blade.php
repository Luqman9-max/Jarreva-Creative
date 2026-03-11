@extends('public.layouts.app')

@section('title', 'Jarreva Creative - Evolve with Us')

@push('styles')
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
    <div id="form-3d-bg" class="absolute inset-0 z-0 pointer-events-auto opacity-50 dark:opacity-80"></div>

    <script>
        document.addEventListener("DOMContentLoaded", () => {
            const container = document.getElementById('form-3d-bg');
            if (!container) return;

            const isDarkMode = document.documentElement.classList.contains('dark');
            const scene = new THREE.Scene();
            scene.fog = new THREE.FogExp2(isDarkMode ? 0x050510 : 0xf0f4f8, 0.002);

            const camera = new THREE.PerspectiveCamera(75, window.innerWidth / window.innerHeight, 0.1, 1000);
            camera.position.z = 40;
            camera.position.y = 10;

            const renderer = new THREE.WebGLRenderer({ alpha: true, antialias: true });
            renderer.setSize(window.innerWidth, window.innerHeight);
            renderer.setPixelRatio(Math.min(window.devicePixelRatio, 2));
            container.appendChild(renderer.domElement);

            const group = new THREE.Group();
            scene.add(group);

            // Glowing Core
            const coreGeometry = new THREE.IcosahedronGeometry(6, 1);
            const coreMaterial = new THREE.MeshBasicMaterial({ 
                color: 0x137fec, // Blue
                wireframe: true,
                transparent: true,
                opacity: 0.8,
                blending: THREE.AdditiveBlending
            });
            const core = new THREE.Mesh(coreGeometry, coreMaterial);
            group.add(core);

            // Outer Energy Shell
            const shellGeometry = new THREE.OctahedronGeometry(12, 0);
            const shellMaterial = new THREE.MeshBasicMaterial({ 
                color: 0xf97316, // Orange
                wireframe: true,
                transparent: true,
                opacity: 0.3,
                blending: THREE.AdditiveBlending
            });
            const shell = new THREE.Mesh(shellGeometry, shellMaterial);
            group.add(shell);

            // Swirling Energy Vortex (Particles)
            const particlesCount = 2500;
            const particlesGeometry = new THREE.BufferGeometry();
            const posArray = new Float32Array(particlesCount * 3);
            const colorsArray = new Float32Array(particlesCount * 3);

            const color1 = new THREE.Color(0xef4444); // Red/Orange
            const color2 = new THREE.Color(0x3b82f6); // Blue

            for(let i = 0; i < particlesCount * 3; i += 3) {
                // Tornado Math
                const y = (Math.random() - 0.5) * 80; 
                // Radius gets wider at the top and bottom
                const radius = 5 + Math.abs(y) * 0.4 + Math.random() * 5;
                const theta = Math.random() * Math.PI * 2;

                posArray[i] = Math.cos(theta) * radius;     // x
                posArray[i+1] = y;                          // y
                posArray[i+2] = Math.sin(theta) * radius;   // z

                // Interpolate colors based on Y position
                const mixRatio = (y + 40) / 80; 
                const mixedColor = color1.clone().lerp(color2, mixRatio);
                colorsArray[i] = mixedColor.r;
                colorsArray[i+1] = mixedColor.g;
                colorsArray[i+2] = mixedColor.b;
            }
            
            particlesGeometry.setAttribute('position', new THREE.BufferAttribute(posArray, 3));
            particlesGeometry.setAttribute('color', new THREE.BufferAttribute(colorsArray, 3));
            
            const particlesMaterial = new THREE.PointsMaterial({
                size: 0.3,
                vertexColors: true,
                transparent: true,
                opacity: 0.8,
                blending: THREE.AdditiveBlending
            });
            
            const particleSystem = new THREE.Points(particlesGeometry, particlesMaterial);
            group.add(particleSystem);

            // Mouse interaction
            let mouseX = 0;
            let mouseY = 0;
            let targetX = 0;
            let targetY = 0;
            
            const windowHalfX = window.innerWidth / 2;
            const windowHalfY = window.innerHeight / 2;

            document.addEventListener('mousemove', (event) => {
                mouseX = (event.clientX - windowHalfX) * 0.001;
                mouseY = (event.clientY - windowHalfY) * 0.001;
            });

            document.addEventListener('touchmove', (event) => {
                if(event.touches.length > 0) {
                    mouseX = (event.touches[0].clientX - windowHalfX) * 0.001;
                    mouseY = (event.touches[0].clientY - windowHalfY) * 0.001;
                }
            }, {passive: true});

            const clock = new THREE.Clock();
            let isVisible = true;

            const observer = new IntersectionObserver((entries) => {
                entries.forEach(entry => {
                    isVisible = entry.isIntersecting;
                });
            });
            observer.observe(container);

            function animate() {
                requestAnimationFrame(animate);
                if (!isVisible) return;

                const time = clock.getElapsedTime();

                targetX = mouseX * 2;
                targetY = mouseY * 2;

                // Parallax pan
                group.rotation.y += 0.02 * (targetX - group.rotation.y);
                group.rotation.x += 0.02 * (targetY - group.rotation.x);

                // Autonomous rotation
                core.rotation.x = time * 0.3;
                core.rotation.y = time * 0.5;

                shell.rotation.x = -time * 0.2;
                shell.rotation.y = -time * 0.1;

                // Vortex rotation
                particleSystem.rotation.y = time * 0.2;

                // Vortex upward motion
                const positions = particleSystem.geometry.attributes.position.array;
                for (let i = 0; i < particlesCount; i++) {
                    const i3 = i * 3;
                    positions[i3+1] += 0.1; // move up
                    if (positions[i3+1] > 40) {
                        positions[i3+1] = -40; // reset at bottom
                    }
                }
                particleSystem.geometry.attributes.position.needsUpdate = true;

                renderer.render(scene, camera);
            }

            animate();

            window.addEventListener('resize', () => {
                camera.aspect = window.innerWidth / window.innerHeight;
                camera.updateProjectionMatrix();
                renderer.setSize(window.innerWidth, window.innerHeight);
            });
        });
    </script>

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
                        @error('name')
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
                        @error('email')
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
