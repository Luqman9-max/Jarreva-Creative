<div id="three-bg-detail" class="fixed inset-0 z-0 pointer-events-none transition-opacity duration-[2s] ease-in-out opacity-0" style="filter: blur(100px); mix-blend-mode: screen;"></div>

<script>
    document.addEventListener("DOMContentLoaded", () => {
        const container = document.getElementById('three-bg-detail');
        if (!container) return;

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
        renderer.setPixelRatio(0.5); // Low resolution for smooth blur and high performance
        container.appendChild(renderer.domElement);

        const group = new THREE.Group();
        scene.add(group);

        // Blob 1: Orange
        const geo1 = new THREE.IcosahedronGeometry(14, 2);
        const mat1 = new THREE.MeshBasicMaterial({ color: 0xf97316, transparent: true, opacity: isDarkMode ? 0.4 : 0.6 });
        const blob1 = new THREE.Mesh(geo1, mat1);
        blob1.position.set(-15, 8, 0);
        group.add(blob1);

        // Blob 2: Blue
        const geo2 = new THREE.IcosahedronGeometry(18, 2);
        const mat2 = new THREE.MeshBasicMaterial({ color: 0x137fec, transparent: true, opacity: isDarkMode ? 0.3 : 0.5 });
        const blob2 = new THREE.Mesh(geo2, mat2);
        blob2.position.set(12, -10, -5);
        group.add(blob2);

        // Blob 3: Soft Slate/White for blending
        const geo3 = new THREE.IcosahedronGeometry(10, 2);
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

        // Use body instead of container for observer since container is fixed and always in viewport
        let isVisible = true;

        function animate() {
            requestAnimationFrame(animate);
            if(!isVisible) return;
            
            const t = clock.getElapsedTime();

            // Very slow, soft organic movement
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

        animate();

        window.addEventListener('resize', () => {
            camera.aspect = window.innerWidth / window.innerHeight;
            camera.updateProjectionMatrix();
            renderer.setSize(window.innerWidth, window.innerHeight);
        });
    });
</script>
