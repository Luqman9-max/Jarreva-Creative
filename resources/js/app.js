import './bootstrap';
import Alpine from 'alpinejs';

window.Alpine = Alpine;
Alpine.start();

// --- Global Scroll Animation System ---
document.addEventListener('DOMContentLoaded', () => {
    const observerOptions = {
        root: null,
        rootMargin: '0px 0px -15% 0px', // Trigger slightly before element enters viewport
        threshold: 0
    };

    const revealObserver = new IntersectionObserver((entries, observer) => {
        entries.forEach(entry => {
            if (entry.isIntersecting) {
                entry.target.classList.add('is-revealed');
                observer.unobserve(entry.target); // Only animate once per page load
            }
        });
    }, observerOptions);

    const observeElements = () => {
        const revealElements = document.querySelectorAll('.reveal-element:not(.is-observed)');
        revealElements.forEach(el => {
            el.classList.add('is-observed');
            revealObserver.observe(el);
        });
    };

    observeElements();
    
    // Handle dynamically added elements
    const mutationObserver = new MutationObserver((mutations) => {
        let addedNodes = false;
        for (let mutation of mutations) {
            if (mutation.addedNodes.length) {
                addedNodes = true;
                break;
            }
        }
        if (addedNodes) {
            observeElements();
        }
    });

    mutationObserver.observe(document.body, { childList: true, subtree: true });
});
