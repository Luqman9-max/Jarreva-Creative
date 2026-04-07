/**
 * Jarreva Performance Manager
 * Detects device capability and provides a global quality tier.
 * Must be imported FIRST before any other JS.
 */
const JarrevaPerf = (() => {
    function detectTier() {
        // Check: Prefer reduced motion (user system setting)
        const prefersReducedMotion = window.matchMedia('(prefers-reduced-motion: reduce)').matches;
        if (prefersReducedMotion) return 'low';

        // Check: Connection speed
        const connection = navigator.connection || {};
        const isSlowNetwork = connection.effectiveType === '2g' || connection.effectiveType === 'slow-2g';
        if (isSlowNetwork) return 'low';

        // Check: Hardware concurrency (CPU cores)
        const cores = navigator.hardwareConcurrency || 2;

        // Check: Device memory (Chrome/Edge only)
        const memory = navigator.deviceMemory || 4;

        // Check: GPU capability via WebGL
        let gpuScore = 2; // default: unknown
        try {
            const canvas = document.createElement('canvas');
            const gl = canvas.getContext('webgl') || canvas.getContext('experimental-webgl');
            if (gl) {
                const debugInfo = gl.getExtension('WEBGL_debug_renderer_info');
                if (debugInfo) {
                    const renderer = gl.getParameter(debugInfo.UNMASKED_RENDERER_WEBGL).toLowerCase();
                    if (renderer.includes('swiftshader') || renderer.includes('llvmpipe')) {
                        gpuScore = 0; // Software renderer
                    } else if (renderer.includes('intel') || renderer.includes('mali') ||
                        renderer.includes('adreno') || renderer.includes('powervr') ||
                        renderer.includes('apple gpu')) {
                        gpuScore = 1; // Integrated/mobile GPU
                    } else {
                        gpuScore = 3; // Discrete GPU
                    }
                }
                // Clean up context
                const ext = gl.getExtension('WEBGL_lose_context');
                if (ext) ext.loseContext();
            } else {
                gpuScore = 0; // No WebGL at all
            }
        } catch (e) {
            gpuScore = 1;
        }

        // Check: Screen size as mobile proxy
        const isMobile = window.innerWidth < 768;
        const isTablet = window.innerWidth >= 768 && window.innerWidth < 1024;

        // Score calculation (max 12)
        let score = 0;
        score += cores >= 8 ? 3 : cores >= 4 ? 2 : 1;
        score += memory >= 8 ? 3 : memory >= 4 ? 2 : 1;
        score += gpuScore;
        score += isMobile ? 0 : isTablet ? 1 : 2;

        // Software renderer = force low
        if (gpuScore === 0) return 'low';

        if (score >= 9) return 'high';
        if (score >= 5) return 'medium';
        return 'low';
    }

    const tier = detectTier();

    // Set data attribute on <html> for CSS to reference
    document.documentElement.setAttribute('data-perf-tier', tier);

    // Quality configuration per tier
    const configs = {
        high: {
            particleCount: 800,
            threeJsPixelRatio: Math.min(window.devicePixelRatio, 2),
            enableThreeJs: true,
            enableParallax: true,
            enableSpotlight: true,
            ringCount: 7,
            gridSegments: [40, 20],
            targetFPS: 60,
            enableMarquee: true,
        },
        medium: {
            particleCount: 300,
            threeJsPixelRatio: 1,
            enableThreeJs: true,
            enableParallax: true,
            enableSpotlight: true,
            ringCount: 4,
            gridSegments: [20, 10],
            targetFPS: 30,
            enableMarquee: true,
        },
        low: {
            particleCount: 0,
            threeJsPixelRatio: 0.5,
            enableThreeJs: false,
            enableParallax: false,
            enableSpotlight: false,
            ringCount: 0,
            gridSegments: [10, 5],
            targetFPS: 30,
            enableMarquee: false,
        }
    };

    const config = configs[tier];

    console.log(`[Jarreva Perf] Device tier: ${tier} | Cores: ${navigator.hardwareConcurrency || '?'} | Memory: ${navigator.deviceMemory || '?'}GB`);

    return {
        tier,
        config,
        is: (t) => tier === t,
        isAtLeast: (t) => {
            const order = ['low', 'medium', 'high'];
            return order.indexOf(tier) >= order.indexOf(t);
        }
    };
})();

window.JarrevaPerf = JarrevaPerf;

export default JarrevaPerf;
