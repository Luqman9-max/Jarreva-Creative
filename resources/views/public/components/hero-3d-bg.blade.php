<div id="three-bg" class="absolute inset-0 z-0 pointer-events-auto opacity-40 dark:opacity-70 dark:mix-blend-lighten"></div>
@once
<script src="https://cdnjs.cloudflare.com/ajax/libs/three.js/r134/three.min.js"></script>
@endonce
<script>
    document.addEventListener("DOMContentLoaded", () => {
        const container = document.getElementById('three-bg');
        if (!container) return;

        // Check if dark mode is active
        const isDarkMode = document.documentElement.classList.contains('dark');

        const scene = new THREE.Scene();
        // Give light mode a lighter fog, dark mode a darker fog
        scene.fog = new THREE.FogExp2(isDarkMode ? 0x101922 : 0xf8fafc, 0.0015);

        const camera = new THREE.PerspectiveCamera(75, window.innerWidth / window.innerHeight, 0.1, 1000);
        camera.position.z = 30;

        const renderer = new THREE.WebGLRenderer({ alpha: true, antialias: true });
        renderer.setSize(window.innerWidth, window.innerHeight);
        renderer.setPixelRatio(Math.min(window.devicePixelRatio, 2));
        container.appendChild(renderer.domElement);

        const group = new THREE.Group();
        scene.add(group);

        // Core glowing abstract shape
        const geometry = new THREE.TorusKnotGeometry(12, 3.5, 200, 32);
        
        // Add a secondary wireframe for a complex techno-organic look
        const material = new THREE.MeshBasicMaterial({ 
            color: 0xf97316, // Orange
            wireframe: true,
            transparent: true,
            opacity: isDarkMode ? 0.12 : 0.25,
            blending: isDarkMode ? THREE.AdditiveBlending : THREE.NormalBlending
        });
        
        const torusKnot = new THREE.Mesh(geometry, material);
        group.add(torusKnot);

        const geometryInner = new THREE.IcosahedronGeometry(7, 2);
        const materialInner = new THREE.MeshBasicMaterial({ 
            color: 0x137fec, // Blue
            wireframe: true,
            transparent: true,
            opacity: isDarkMode ? 0.15 : 0.35,
            blending: isDarkMode ? THREE.AdditiveBlending : THREE.NormalBlending
        });
        const innerMesh = new THREE.Mesh(geometryInner, materialInner);
        group.add(innerMesh);

        // Floating particles / "Data nodes"
        const particlesGeometry = new THREE.BufferGeometry();
        const particlesCount = 2000;
        const posArray = new Float32Array(particlesCount * 3);
        
        for(let i = 0; i < particlesCount * 3; i++) {
            posArray[i] = (Math.random() - 0.5) * 120; // Spread wide
        }
        
        particlesGeometry.setAttribute('position', new THREE.BufferAttribute(posArray, 3));
        const particlesMaterial = new THREE.PointsMaterial({
            size: isDarkMode ? 0.15 : 0.2,
            color: isDarkMode ? 0xffffff : 0x1e3a8a, // White in dark mode, Jarreva Blue in light mode
            transparent: true,
            opacity: isDarkMode ? 0.8 : 0.4,
            blending: isDarkMode ? THREE.AdditiveBlending : THREE.NormalBlending
        });
        
        const particleMesh = new THREE.Points(particlesGeometry, particlesMaterial);
        group.add(particleMesh);

        // Mouse Parallax
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

        // Touch support for mobile
        document.addEventListener('touchmove', (event) => {
            if(event.touches.length > 0) {
                mouseX = (event.touches[0].clientX - windowHalfX) * 0.001;
                mouseY = (event.touches[0].clientY - windowHalfY) * 0.001;
            }
        }, {passive: true});

        const clock = new THREE.Clock();

        function animate() {
            requestAnimationFrame(animate);
            const elapsedTime = clock.getElapsedTime();

            targetX = mouseX * 0.5;
            targetY = mouseY * 0.5;

            // Parallax pan
            group.rotation.y += 0.05 * (targetX - group.rotation.y);
            group.rotation.x += 0.05 * (targetY - group.rotation.x);

            // Autonomous rotation
            torusKnot.rotation.y = elapsedTime * 0.15;
            torusKnot.rotation.z = elapsedTime * 0.05;

            innerMesh.rotation.x = -elapsedTime * 0.2;
            innerMesh.rotation.y = -elapsedTime * 0.1;

            particleMesh.rotation.y = -elapsedTime * 0.05;
            particleMesh.rotation.x = Math.sin(elapsedTime * 0.2) * 0.1;

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
