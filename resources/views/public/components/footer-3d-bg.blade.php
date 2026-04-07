{{-- CSS-only fallback for low-end devices --}}
<div id="footer-three-bg-fallback" class="absolute inset-0 z-0 pointer-events-none hidden overflow-hidden">
    <div class="absolute bottom-0 left-0 right-0 h-full bg-gradient-to-t from-blue-500/5 via-transparent to-transparent"></div>
    <div class="absolute bottom-1/4 left-1/3 w-48 h-48 bg-blue-400/5 rounded-full blur-[80px]"></div>
</div>

<div id="footer-three-bg" class="absolute inset-0 z-0 pointer-events-none overflow-hidden opacity-100 dark:opacity-80 transition-opacity duration-1000"></div>

<script>
    document.addEventListener("DOMContentLoaded", () => {
        const perf = window.JarrevaPerf;
        const container = document.getElementById('footer-three-bg');
        const fallback = document.getElementById('footer-three-bg-fallback');

        // LOW-END: Show CSS fallback, skip Three.js
        if (!perf || !perf.config.enableThreeJs) {
            if (container) container.style.display = 'none';
            if (fallback) fallback.classList.remove('hidden');
            return;
        }

        if (!container || typeof THREE === 'undefined') return;

        let isDarkMode = document.documentElement.classList.contains('dark');

        const scene = new THREE.Scene();
        scene.fog = new THREE.FogExp2(isDarkMode ? 0x0f172a : 0xffffff, 0.035);

        const camera = new THREE.PerspectiveCamera(75, window.innerWidth / 400, 0.1, 1000);
        camera.position.z = 25;
        camera.position.y = -2;
        camera.position.x = 0;

        const renderer = new THREE.WebGLRenderer({ alpha: true, antialias: perf.is('high') });
        renderer.setSize(window.innerWidth, container.offsetHeight);
        renderer.setPixelRatio(perf.config.threeJsPixelRatio);
        container.appendChild(renderer.domElement);

        const group = new THREE.Group();
        scene.add(group);

        // Foundation Grid — adaptive segment count
        const segments = perf.config.gridSegments;
        const geometry = new THREE.PlaneGeometry(80, 40, segments[0], segments[1]);

        const wireframeMaterial = new THREE.MeshBasicMaterial({
            color: isDarkMode ? 0x1e293b : 0xe2e8f0,
            wireframe: true,
            transparent: true,
            opacity: isDarkMode ? 0.4 : 0.8,
            blending: THREE.NormalBlending
        });

        const plane = new THREE.Mesh(geometry, wireframeMaterial);
        plane.rotation.x = -Math.PI / 2.2;
        plane.position.y = -8;
        group.add(plane);

        // Neural Nodes
        const particlesMaterial = new THREE.PointsMaterial({
            color: isDarkMode ? 0x38bdf8 : 0x3b82f6,
            size: 0.2,
            transparent: true,
            opacity: isDarkMode ? 0.8 : 0.6,
            blending: isDarkMode ? THREE.AdditiveBlending : THREE.NormalBlending
        });
        const particles = new THREE.Points(geometry, particlesMaterial);
        particles.rotation.x = -Math.PI / 2.2;
        particles.position.y = -8;
        group.add(particles);

        // Store initial vertex heights
        const positionAttribute = geometry.attributes.position;
        const vertex = new THREE.Vector3();
        const initialHeights = [];
        for (let i = 0; i < positionAttribute.count; i++) {
            initialHeights.push((Math.random() - 0.5) * 1.5);
        }

        const clock = new THREE.Clock();
        let isVisible = false;
        const targetInterval = 1000 / perf.config.targetFPS;
        let lastFrameTime = 0;

        const intersectionObserver = new IntersectionObserver((entries) => {
            entries.forEach(entry => {
                isVisible = entry.isIntersecting;
            });
        });
        intersectionObserver.observe(container);

        function animate(currentTime) {
            requestAnimationFrame(animate);
            if (!isVisible) return;

            // FPS throttle
            if (currentTime - lastFrameTime < targetInterval) return;
            lastFrameTime = currentTime;

            const elapsedTime = clock.getElapsedTime();

            // Wave effect on vertices
            for (let i = 0; i < positionAttribute.count; i++) {
                vertex.fromBufferAttribute(positionAttribute, i);
                const waveX1 = Math.sin(vertex.x * 0.2 + elapsedTime * 0.6) * 0.5;
                const waveY1 = Math.sin(vertex.y * 0.3 + elapsedTime * 0.4) * 0.5;
                const waveX2 = Math.cos(vertex.x * 0.15 - elapsedTime * 0.3) * 0.3;
                positionAttribute.setZ(i, initialHeights[i] + waveX1 + waveY1 + waveX2);
            }
            positionAttribute.needsUpdate = true;

            // Slow cinematic panning
            group.position.x = Math.sin(elapsedTime * 0.1) * 2;
            group.rotation.y = Math.sin(elapsedTime * 0.1) * 0.05;
            group.position.z = Math.cos(elapsedTime * 0.1) * 1.5;

            renderer.render(scene, camera);
        }

        requestAnimationFrame(animate);

        // Dark mode transition listener
        const darkObserver = new MutationObserver(() => {
            const newIsDarkMode = document.documentElement.classList.contains('dark');
            if (newIsDarkMode !== isDarkMode) {
                isDarkMode = newIsDarkMode;
                scene.fog.color.setHex(isDarkMode ? 0x0f172a : 0xffffff);
                wireframeMaterial.color.setHex(isDarkMode ? 0x1e293b : 0xe2e8f0);
                wireframeMaterial.opacity = isDarkMode ? 0.4 : 0.8;
                particlesMaterial.color.setHex(isDarkMode ? 0x38bdf8 : 0x3b82f6);
                particlesMaterial.opacity = isDarkMode ? 0.8 : 0.6;
                particlesMaterial.blending = isDarkMode ? THREE.AdditiveBlending : THREE.NormalBlending;
                particlesMaterial.needsUpdate = true;
                wireframeMaterial.needsUpdate = true;
            }
        });
        darkObserver.observe(document.documentElement, { attributes: true, attributeFilter: ['class'] });

        // Debounced resize
        let resizeTimeout;
        window.addEventListener('resize', () => {
            clearTimeout(resizeTimeout);
            resizeTimeout = setTimeout(() => {
                const height = container.offsetHeight || 400;
                camera.aspect = window.innerWidth / height;
                camera.updateProjectionMatrix();
                renderer.setSize(window.innerWidth, height);
            }, 150);
        });

        // Initial size fix
        setTimeout(() => {
            const height = container.offsetHeight || 400;
            camera.aspect = window.innerWidth / height;
            camera.updateProjectionMatrix();
            renderer.setSize(window.innerWidth, height);
        }, 150);
    });
</script>
