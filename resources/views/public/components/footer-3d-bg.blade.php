<div id="footer-three-bg" class="absolute inset-0 z-0 pointer-events-none overflow-hidden opacity-100 dark:opacity-80 transition-opacity duration-1000"></div>

<script>
    document.addEventListener("DOMContentLoaded", () => {
        const container = document.getElementById('footer-three-bg');
        if (!container) return;

        let isDarkMode = document.documentElement.classList.contains('dark');

        const scene = new THREE.Scene();
        // Set fog matching footer bg (white in light mode, dark slate in dark mode)
        scene.fog = new THREE.FogExp2(isDarkMode ? 0x0f172a : 0xffffff, 0.035);

        const camera = new THREE.PerspectiveCamera(75, window.innerWidth / 400, 0.1, 1000); 
        camera.position.z = 25;
        camera.position.y = -2; // Slightly higher view
        camera.position.x = 0;

        const renderer = new THREE.WebGLRenderer({ alpha: true, antialias: true });
        renderer.setSize(window.innerWidth, container.offsetHeight);
        renderer.setPixelRatio(Math.min(window.devicePixelRatio, 2));
        container.appendChild(renderer.domElement);

        const group = new THREE.Group();
        scene.add(group);

        // Foundation Grid
        const geometry = new THREE.PlaneGeometry(80, 40, 40, 20);
        
        // Wireframe material for the grid
        const wireframeMaterial = new THREE.MeshBasicMaterial({ 
            color: isDarkMode ? 0x1e293b : 0xe2e8f0, // slate-800 or slate-200
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
            color: isDarkMode ? 0x38bdf8 : 0x3b82f6, // sky-400 or blue-500
            size: 0.2, // slightly larger dots
            transparent: true,
            opacity: isDarkMode ? 0.8 : 0.6,
            blending: isDarkMode ? THREE.AdditiveBlending : THREE.NormalBlending
        });
        const particles = new THREE.Points(geometry, particlesMaterial);
        particles.rotation.x = -Math.PI / 2.2;
        particles.position.y = -8;
        group.add(particles);

        // Modify plane vertices to make it look like a wavy data grid
        const positionAttribute = geometry.attributes.position;
        const vertex = new THREE.Vector3();
        const initialHeights = [];
        for ( let i = 0; i < positionAttribute.count; i ++ ) {
            initialHeights.push((Math.random() - 0.5) * 1.5);
        }

        const clock = new THREE.Clock();
        let isVisible = false; // Initially assume not visible to save first frames if footer is far down

        const intersectionObserver = new IntersectionObserver((entries) => {
            entries.forEach(entry => {
                isVisible = entry.isIntersecting;
            });
        });
        intersectionObserver.observe(container);

        function animate() {
            requestAnimationFrame(animate);
            if (!isVisible) return;

            const elapsedTime = clock.getElapsedTime();

            // Intertwining wave effect
            for ( let i = 0; i < positionAttribute.count; i ++ ) {
                vertex.fromBufferAttribute( positionAttribute, i );
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

        animate();

        // Listen for dark mode toggle for seamless transition without reload
        const observer = new MutationObserver(() => {
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
        observer.observe(document.documentElement, { attributes: true, attributeFilter: ['class'] });

        window.addEventListener('resize', () => {
             const height = container.offsetHeight || 400;
             camera.aspect = window.innerWidth / height;
             camera.updateProjectionMatrix();
             renderer.setSize(window.innerWidth, height);
        });
        
        // Initial setup for correct height on render
        setTimeout(() => {
            const height = container.offsetHeight || 400;
            camera.aspect = window.innerWidth / height;
            camera.updateProjectionMatrix();
            renderer.setSize(window.innerWidth, height);
        }, 150);
    });
</script>
