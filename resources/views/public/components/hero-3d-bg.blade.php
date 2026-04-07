{{-- CSS-only fallback for low-end devices --}}
<div id="three-bg-fallback" class="absolute inset-0 z-0 pointer-events-none hidden">
    <div class="absolute top-1/4 left-1/4 w-64 h-64 bg-orange-400/10 rounded-full blur-[100px] animate-pulse"></div>
    <div class="absolute bottom-1/3 right-1/4 w-48 h-48 bg-blue-400/10 rounded-full blur-[80px] animate-pulse" style="animation-delay: 1s;"></div>
    <div class="absolute top-1/2 left-1/2 -translate-x-1/2 -translate-y-1/2 w-32 h-32 bg-slate-400/5 rounded-full blur-[60px] animate-pulse" style="animation-delay: 2s;"></div>
</div>

<div id="three-bg" class="absolute inset-0 z-0 pointer-events-auto opacity-50 dark:opacity-80 dark:mix-blend-lighten transition-opacity duration-1000"></div>

<script>
    document.addEventListener("DOMContentLoaded", () => {
        const perf = window.JarrevaPerf;
        const container = document.getElementById('three-bg');
        const fallback = document.getElementById('three-bg-fallback');

        // LOW-END: Show CSS fallback, skip Three.js entirely
        if (!perf || !perf.config.enableThreeJs) {
            if (container) container.style.display = 'none';
            if (fallback) fallback.classList.remove('hidden');
            return;
        }

        if (!container || typeof THREE === 'undefined') return;

        const isDarkMode = document.documentElement.classList.contains('dark');
        const themeBg = isDarkMode ? 0x0f172a : 0xf8fafc;

        const scene = new THREE.Scene();
        scene.fog = new THREE.FogExp2(themeBg, 0.015);

        const camera = new THREE.PerspectiveCamera(75, window.innerWidth / window.innerHeight, 0.1, 1000);
        camera.position.z = 24;

        const renderer = new THREE.WebGLRenderer({ alpha: true, antialias: perf.is('high') });
        renderer.setSize(window.innerWidth, window.innerHeight);
        renderer.setPixelRatio(perf.config.threeJsPixelRatio);
        container.appendChild(renderer.domElement);

        const group = new THREE.Group();
        scene.add(group);

        // --- LAYER 1: CHAOS LAYER (Background) --- Adaptive particle count
        const chaosCount = perf.config.particleCount;
        let chaosLayer = null;

        if (chaosCount > 0) {
            const chaosGeo = new THREE.BufferGeometry();
            const chaosPos = new Float32Array(chaosCount * 3);
            const chaosSpeeds = new Float32Array(chaosCount);

            for (let i = 0; i < chaosCount; i++) {
                chaosPos[i * 3] = (Math.random() - 0.5) * 60;
                chaosPos[i * 3 + 1] = (Math.random() - 0.5) * 60;
                chaosPos[i * 3 + 2] = (Math.random() - 0.5) * 60;
                chaosSpeeds[i] = Math.random() * 0.05;
            }
            chaosGeo.setAttribute('position', new THREE.BufferAttribute(chaosPos, 3));
            chaosGeo.setAttribute('speed', new THREE.BufferAttribute(chaosSpeeds, 1));

            const chaosColor = isDarkMode ? 0x64748b : 0x94a3b8;
            const chaosMat = new THREE.PointsMaterial({
                color: chaosColor,
                size: isDarkMode ? 0.12 : 0.15,
                transparent: true,
                opacity: isDarkMode ? 0.4 : 0.3,
                blending: isDarkMode ? THREE.AdditiveBlending : THREE.NormalBlending
            });
            chaosLayer = new THREE.Points(chaosGeo, chaosMat);
            group.add(chaosLayer);
        }

        // --- LAYER 2: LOOP LAYER (Middle) --- Adaptive ring count
        const loopGroup = new THREE.Group();
        const ringCount = perf.config.ringCount;
        const ringGeo = new THREE.TorusGeometry(10, 0.03, 8, ringCount > 4 ? 100 : 60);
        const ringMat = new THREE.MeshBasicMaterial({
            color: isDarkMode ? 0x94a3b8 : 0x64748b,
            transparent: true,
            opacity: isDarkMode ? 0.2 : 0.15,
        });

        const rings = [];
        for (let i = 0; i < ringCount; i++) {
            const ring = new THREE.Mesh(ringGeo, ringMat);
            ring.rotation.x = Math.random() * Math.PI;
            ring.rotation.y = Math.random() * Math.PI;
            ring.userData = {
                speedX: (Math.random() - 0.5) * 0.005,
                speedY: (Math.random() - 0.5) * 0.005,
                speedZ: (Math.random() - 0.5) * 0.005
            };
            const scale = 0.5 + Math.random() * 1.5;
            ring.scale.set(scale, scale, scale);
            loopGroup.add(ring);
            rings.push(ring);
        }
        group.add(loopGroup);

        // --- LAYER 3: BREAK LAYER (Foreground Highlight) ---
        const breakGroup = new THREE.Group();
        const canvas = document.createElement('canvas');
        canvas.width = 128;
        canvas.height = 128;
        const context = canvas.getContext('2d');
        const gradient = context.createRadialGradient(64, 64, 0, 64, 64, 64);
        gradient.addColorStop(0, 'rgba(249, 115, 22, 1)');
        gradient.addColorStop(0.1, 'rgba(249, 115, 22, 0.9)');
        gradient.addColorStop(0.4, 'rgba(249, 115, 22, 0.3)');
        gradient.addColorStop(1, 'rgba(0, 0, 0, 0)');
        context.fillStyle = gradient;
        context.fillRect(0, 0, 128, 128);

        const glowTexture = new THREE.CanvasTexture(canvas);
        const breakMat = new THREE.SpriteMaterial({
            map: glowTexture,
            color: 0xffffff,
            transparent: true,
            blending: THREE.AdditiveBlending,
            depthWrite: false
        });

        const breakLayer = new THREE.Sprite(breakMat);
        breakLayer.scale.set(4, 4, 1);
        breakGroup.add(breakLayer);
        breakGroup.position.set(-6, 0, 5);
        group.add(breakGroup);

        // --- INTERACTION ---
        let mouseX = 0;
        let mouseY = 0;
        let scrollY = 0;
        const windowHalfX = window.innerWidth / 2;
        const windowHalfY = window.innerHeight / 2;

        document.addEventListener('mousemove', (event) => {
            mouseX = (event.clientX - windowHalfX) * 0.0005;
            mouseY = (event.clientY - windowHalfY) * 0.0005;
        });

        document.addEventListener('touchmove', (event) => {
            if (event.touches.length > 0) {
                mouseX = (event.touches[0].clientX - windowHalfX) * 0.0005;
                mouseY = (event.touches[0].clientY - windowHalfY) * 0.0005;
            }
        }, { passive: true });

        window.addEventListener('scroll', () => {
            scrollY = window.scrollY;
        }, { passive: true });

        // --- ANIMATION with FPS throttle ---
        const clock = new THREE.Clock();
        let isVisible = true;
        const targetInterval = 1000 / perf.config.targetFPS;
        let lastFrameTime = 0;

        const observer = new IntersectionObserver((entries) => {
            entries.forEach(entry => {
                isVisible = entry.isIntersecting;
            });
        });
        observer.observe(container);

        function animate(currentTime) {
            requestAnimationFrame(animate);
            if (!isVisible) return;

            // FPS throttle
            if (currentTime - lastFrameTime < targetInterval) return;
            lastFrameTime = currentTime;

            const time = clock.getElapsedTime();

            // Parallax pan
            group.rotation.y += 0.05 * (mouseX - group.rotation.y);
            group.rotation.x += 0.05 * (mouseY - group.rotation.x);

            // Animate chaos particles
            if (chaosLayer) {
                const positions = chaosLayer.geometry.attributes.position.array;
                const speeds = chaosLayer.geometry.attributes.speed.array;
                for (let i = 0; i < chaosCount; i++) {
                    positions[i * 3] += Math.sin(time + speeds[i] * 100) * speeds[i] * 0.15;
                    positions[i * 3 + 1] += speeds[i] * 0.5;
                    if (positions[i * 3 + 1] > 30) {
                        positions[i * 3 + 1] = -30;
                    }
                }
                chaosLayer.geometry.attributes.position.needsUpdate = true;
            }

            // Animate rings
            const scrollInfluence = 1 + Math.min(scrollY * 0.002, 4);
            rings.forEach(ring => {
                ring.rotation.x += ring.userData.speedX * scrollInfluence;
                ring.rotation.y += ring.userData.speedY * scrollInfluence;
                ring.rotation.z += ring.userData.speedZ * scrollInfluence;
            });
            loopGroup.rotation.y -= 0.001 * scrollInfluence;

            // Animate break layer
            breakGroup.position.y = -2 + Math.sin(time * 0.3) * 3;
            breakGroup.position.x = -6 + Math.cos(time * 0.2) * 1;
            breakGroup.position.z = 5 + Math.sin(time * 0.4) * 2;
            const pulse = 4 + Math.sin(time * 2) * 0.4;
            breakLayer.scale.set(pulse, pulse, 1);

            renderer.render(scene, camera);
        }

        requestAnimationFrame(animate);

        // Resize handler
        let resizeTimeout;
        window.addEventListener('resize', () => {
            clearTimeout(resizeTimeout);
            resizeTimeout = setTimeout(() => {
                camera.aspect = window.innerWidth / window.innerHeight;
                camera.updateProjectionMatrix();
                renderer.setSize(window.innerWidth, window.innerHeight);
            }, 150);
        });
    });
</script>
