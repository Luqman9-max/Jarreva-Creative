{{-- CSS-only fallback for book detail --}}
<div id="three-bg-detail-fallback" class="fixed inset-0 z-0 pointer-events-none hidden" style="filter: blur(100px);">
    <div class="absolute top-1/4 left-1/4 w-64 h-64 bg-orange-400/20 rounded-full animate-pulse"></div>
    <div class="absolute bottom-1/3 right-1/4 w-72 h-72 bg-blue-400/15 rounded-full animate-pulse" style="animation-delay: 1.5s;"></div>
    <div class="absolute top-1/2 left-1/2 -translate-x-1/2 -translate-y-1/2 w-40 h-40 bg-slate-300/10 rounded-full animate-pulse" style="animation-delay: 2.5s;"></div>
</div>

<div id="three-bg-detail" class="fixed inset-0 z-0 pointer-events-none transition-opacity duration-[2s] ease-in-out opacity-0" style="filter: blur(100px); mix-blend-mode: screen;"></div>

<script>
    document.addEventListener("DOMContentLoaded", () => {
        const perf = window.JarrevaPerf;
        const container = document.getElementById('three-bg-detail');
        const fallback = document.getElementById('three-bg-detail-fallback');

        // LOW-END: Show CSS fallback
        if (!perf || !perf.config.enableThreeJs) {
            if (container) container.style.display = 'none';
            if (fallback) fallback.classList.remove('hidden');
            return;
        }

        if (!container || typeof THREE === 'undefined') return;

        // Fade in
        setTimeout(() => {
            container.classList.remove('opacity-0');
            container.classList.add('opacity-40');
            if (document.documentElement.classList.contains('dark')) {
                container.classList.remove('opacity-40');
                container.classList.add('opacity-25');
                container.style.mixBlendMode = 'lighten';
            }
        }, 100);

        const isDarkMode = document.documentElement.classList.contains('dark');

        const scene = new THREE.Scene();
        const camera = new THREE.PerspectiveCamera(75, window.innerWidth / window.innerHeight, 0.1, 1000);
        camera.position.z = 30;

        const renderer = new THREE.WebGLRenderer({ alpha: true, antialias: false });
        renderer.setSize(window.innerWidth, window.innerHeight);
        renderer.setPixelRatio(Math.min(perf.config.threeJsPixelRatio, 0.75)); // Extra low for blurred bg
        container.appendChild(renderer.domElement);

        const group = new THREE.Group();
        scene.add(group);

        // Reduce geometry detail on medium tier
        const detail = perf.is('high') ? 2 : 1;

        // Blob 1: Orange
        const geo1 = new THREE.IcosahedronGeometry(14, detail);
        const mat1 = new THREE.MeshBasicMaterial({ color: 0xf97316, transparent: true, opacity: isDarkMode ? 0.4 : 0.6 });
        const blob1 = new THREE.Mesh(geo1, mat1);
        blob1.position.set(-15, 8, 0);
        group.add(blob1);

        // Blob 2: Blue
        const geo2 = new THREE.IcosahedronGeometry(18, detail);
        const mat2 = new THREE.MeshBasicMaterial({ color: 0x137fec, transparent: true, opacity: isDarkMode ? 0.3 : 0.5 });
        const blob2 = new THREE.Mesh(geo2, mat2);
        blob2.position.set(12, -10, -5);
        group.add(blob2);

        // Blob 3: Soft blend
        const geo3 = new THREE.IcosahedronGeometry(10, detail);
        const mat3 = new THREE.MeshBasicMaterial({ color: isDarkMode ? 0x334155 : 0xffffff, transparent: true, opacity: 0.4 });
        const blob3 = new THREE.Mesh(geo3, mat3);
        blob3.position.set(0, 0, -10);
        group.add(blob3);

        const clock = new THREE.Clock();
        let mouseX = 0;
        let mouseY = 0;
        const windowHalfX = window.innerWidth / 2;
        const windowHalfY = window.innerHeight / 2;

        document.addEventListener('mousemove', (event) => {
            mouseX = (event.clientX - windowHalfX) * 0.001;
            mouseY = (event.clientY - windowHalfY) * 0.001;
        });

        let isVisible = true;
        const targetInterval = 1000 / perf.config.targetFPS;
        let lastFrameTime = 0;

        function animate(currentTime) {
            requestAnimationFrame(animate);
            if (!isVisible) return;

            // FPS throttle
            if (currentTime - lastFrameTime < targetInterval) return;
            lastFrameTime = currentTime;

            const t = clock.getElapsedTime();

            blob1.position.x = -15 + Math.sin(t * 0.15) * 8;
            blob1.position.y = 8 + Math.cos(t * 0.1) * 6;
            blob1.rotation.x = t * 0.05;
            blob1.rotation.y = t * 0.08;

            blob2.position.x = 12 + Math.cos(t * 0.1) * 10;
            blob2.position.y = -10 + Math.sin(t * 0.2) * 5;
            blob2.rotation.x = t * 0.07;
            blob2.rotation.z = t * 0.05;

            blob3.position.x = Math.sin(t * 0.08) * 5;
            blob3.position.y = Math.cos(t * 0.12) * 5;

            group.rotation.x += 0.01 * (mouseY - group.rotation.x);
            group.rotation.y += 0.01 * (mouseX - group.rotation.y);

            renderer.render(scene, camera);
        }

        requestAnimationFrame(animate);

        // Debounced resize
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
