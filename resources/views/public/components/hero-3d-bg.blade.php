<div id="three-bg" class="absolute inset-0 z-0 pointer-events-auto opacity-50 dark:opacity-80 dark:mix-blend-lighten transition-opacity duration-1000"></div>

<script>
    document.addEventListener("DOMContentLoaded", () => {
        const container = document.getElementById('three-bg');
        if (!container) return;

        // Check if dark mode is active
        const isDarkMode = document.documentElement.classList.contains('dark');
        const themeBg = isDarkMode ? 0x0f172a : 0xf8fafc;

        const scene = new THREE.Scene();
        // Give light mode a lighter fog, dark mode a darker fog
        scene.fog = new THREE.FogExp2(themeBg, 0.015);

        const camera = new THREE.PerspectiveCamera(75, window.innerWidth / window.innerHeight, 0.1, 1000);
        camera.position.z = 24;

        const renderer = new THREE.WebGLRenderer({ alpha: true, antialias: true });
        renderer.setSize(window.innerWidth, window.innerHeight);
        renderer.setPixelRatio(Math.min(window.devicePixelRatio, 2));
        container.appendChild(renderer.domElement);

        const group = new THREE.Group();
        scene.add(group);

        // --- LAYER 1: CHAOS LAYER (Background) ---
        // Abstract floating fragments, slightly random motion
        const chaosGeo = new THREE.BufferGeometry();
        const chaosCount = 800;
        const chaosPos = new Float32Array(chaosCount * 3);
        const chaosSpeeds = new Float32Array(chaosCount);
        
        for(let i = 0; i < chaosCount; i++) {
            chaosPos[i*3] = (Math.random() - 0.5) * 60;
            chaosPos[i*3+1] = (Math.random() - 0.5) * 60;
            chaosPos[i*3+2] = (Math.random() - 0.5) * 60;
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
        const chaosLayer = new THREE.Points(chaosGeo, chaosMat);
        group.add(chaosLayer);

        // --- LAYER 2: LOOP LAYER (Middle) ---
        // Overlapping rings representing habit loops
        const loopGroup = new THREE.Group();
        const ringCount = 7;
        const ringGeo = new THREE.TorusGeometry(10, 0.03, 8, 100);
        const ringMat = new THREE.MeshBasicMaterial({
            color: isDarkMode ? 0x94a3b8 : 0x64748b,
            transparent: true,
            opacity: isDarkMode ? 0.2 : 0.15,
        });

        const rings = [];
        for(let i = 0; i < ringCount; i++) {
            const ring = new THREE.Mesh(ringGeo, ringMat);
            // Random initial rotation
            ring.rotation.x = Math.random() * Math.PI;
            ring.rotation.y = Math.random() * Math.PI;
            
            // Assign unique rotation speeds
            ring.userData = {
                speedX: (Math.random() - 0.5) * 0.005,
                speedY: (Math.random() - 0.5) * 0.005,
                speedZ: (Math.random() - 0.5) * 0.005
            };
            
            // Randomly scale the rings for depth
            const scale = 0.5 + Math.random() * 1.5;
            ring.scale.set(scale, scale, scale);
            
            loopGroup.add(ring);
            rings.push(ring);
        }
        group.add(loopGroup);

        // --- LAYER 3: BREAK LAYER (Foreground Highlight) ---
        // A glowing dot/particle moving intentionally against the flow
        const breakGroup = new THREE.Group();
        
        // Dynamically create a glowing canvas texture for the particle
        const canvas = document.createElement('canvas');
        canvas.width = 128;
        canvas.height = 128;
        const context = canvas.getContext('2d');
        const gradient = context.createRadialGradient(64, 64, 0, 64, 64, 64);
        gradient.addColorStop(0, 'rgba(249, 115, 22, 1)'); // Premium Orange core
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
        breakLayer.scale.set(4, 4, 1); // Size of the glowing dot

        breakGroup.add(breakLayer);

        // Position it slightly off-center and closer to camera
        breakGroup.position.set(-6, 0, 5);
        group.add(breakGroup);

        // --- INTERACTION & ANIMATION ---
        let mouseX = 0;
        let mouseY = 0;
        let targetX = 0;
        let targetY = 0;
        let scrollY = 0;

        const windowHalfX = window.innerWidth / 2;
        const windowHalfY = window.innerHeight / 2;

        document.addEventListener('mousemove', (event) => {
            mouseX = (event.clientX - windowHalfX) * 0.0005;
            mouseY = (event.clientY - windowHalfY) * 0.0005;
        });

        // Touch support for mobile
        document.addEventListener('touchmove', (event) => {
            if(event.touches.length > 0) {
                mouseX = (event.touches[0].clientX - windowHalfX) * 0.0005;
                mouseY = (event.touches[0].clientY - windowHalfY) * 0.0005;
            }
        }, {passive: true});

        window.addEventListener('scroll', () => {
            scrollY = window.scrollY;
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

            // Parallax pan
            targetX = mouseX;
            targetY = mouseY;
            group.rotation.y += 0.05 * (targetX - group.rotation.y);
            group.rotation.x += 0.05 * (targetY - group.rotation.x);

            // Animate 1: Chaos (drifting noise)
            const positions = chaosLayer.geometry.attributes.position.array;
            const speeds = chaosLayer.geometry.attributes.speed.array;
            for(let i = 0; i < chaosCount; i++) {
                // Subtle sine wave drifting
                positions[i*3] += Math.sin(time + speeds[i]*100) * speeds[i] * 0.15;
                // Add a very subtle continuous upward drift for some to feel like escaping or rising noise
                positions[i*3+1] += speeds[i] * 0.5;
                
                // Reset particles if they go too high
                if (positions[i*3+1] > 30) {
                    positions[i*3+1] = -30;
                }
            }
            chaosLayer.geometry.attributes.position.needsUpdate = true;

            // Animate 2: Loop (habitual repetition)
            // Scroll increases the speed of the loop slightly (panic/scrolling effect)
            const scrollInfluence = 1 + Math.min(scrollY * 0.002, 4); // Cap to 4x speed
            rings.forEach(ring => {
                ring.rotation.x += ring.userData.speedX * scrollInfluence;
                ring.rotation.y += ring.userData.speedY * scrollInfluence;
                ring.rotation.z += ring.userData.speedZ * scrollInfluence;
            });
            
            // Loop group overall slowly rotates
            loopGroup.rotation.y -= 0.001 * scrollInfluence;

            // Animate 3: Break (intention)
            // It deliberately floats in its own intentional path against the chaotic background
            // Uses a mix of sine waves to ensure it doesn't just loop perfectly or spin frantically
            breakGroup.position.y = -2 + Math.sin(time * 0.3) * 3;
            breakGroup.position.x = -6 + Math.cos(time * 0.2) * 1;
            breakGroup.position.z =  5 + Math.sin(time * 0.4) * 2;
            
            // Gently pulse the size of the glowing particle
            const pulse = 4 + Math.sin(time * 2) * 0.4;
            breakLayer.scale.set(pulse, pulse, 1);

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
