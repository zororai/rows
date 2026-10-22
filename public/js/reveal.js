/*
 * Scroll reveal: animates elements as they enter the viewport.
 *
 * Opt in explicitly with data attributes:
 *   data-reveal="up|down|left|right|zoom|fade"   animation (default "up")
 *   data-reveal-delay="200"                      extra delay in ms
 *   data-count-to="250"                          count a number up from 0
 *
 * Common site components are tagged automatically (see AUTO below), so most
 * pages need no markup changes. Elements revealed together are staggered.
 */
(function () {
    'use strict';

    var root = document.documentElement;
    var reduceMotion = window.matchMedia && window.matchMedia('(prefers-reduced-motion: reduce)').matches;

    window.__reveal = true;

    if (reduceMotion || !('IntersectionObserver' in window)) {
        root.classList.add('reveal-off');
        return;
    }

    // selector -> animation. Order matters: earlier rules win, and an element
    // inside an already-tagged element is skipped so nested items don't double-animate.
    var AUTO = [
        ['.page-header .container > *', 'up'],
        ['.stats-card', 'up'],
        ['.founder img', 'left'],
        ['.founder .col-lg-7 > *', 'right'],
        ['.cta', 'zoom'],
        ['.img-stack', 'zoom'],
        ['.img-frame', 'zoom'],
        ['.home-gallery a', 'zoom'],
        ['.gallery-item', 'zoom'],
        ['.card-soft, .story-card, .cause-card, .home-card, .mv-card, .quote-card', 'up'],
        ['.eyebrow, .section-title, .lead-2', 'up'],
        ['.filter-pills', 'fade'],
        ['.list-check li', 'left'],
        ['.prose > p, .prose > h3, .article-body p', 'up'],
    ];

    AUTO.forEach(function (rule) {
        document.querySelectorAll(rule[0]).forEach(function (el) {
            if (el.hasAttribute('data-reveal') || el.closest('[data-reveal]')) return;
            if (el.querySelector('[data-reveal]')) return;
            el.setAttribute('data-reveal', rule[1]);
        });
    });

    var STAGGER = 90;       // ms between items revealed in the same batch
    var MAX_STAGGER = 540;  // cap so long lists don't lag
    var DURATION = 800;     // keep in sync with --reveal-duration in site.css

    function finish(el) {
        // Hand control back to the component's own styles (e.g. hover lifts).
        el.removeAttribute('data-reveal');
        el.classList.remove('is-visible');
        el.style.removeProperty('--reveal-delay');
    }

    function reveal(el, batchIndex) {
        var delay = (parseInt(el.getAttribute('data-reveal-delay'), 10) || 0) + Math.min(batchIndex * STAGGER, MAX_STAGGER);
        el.style.setProperty('--reveal-delay', delay + 'ms');
        el.classList.add('is-visible');

        var done = false;
        var end = function () { if (!done) { done = true; finish(el); } };
        el.addEventListener('transitionend', function (e) { if (e.target === el) end(); });
        setTimeout(end, DURATION + delay + 150);
    }

    var revealObserver = new IntersectionObserver(function (entries) {
        var i = 0;
        entries.forEach(function (entry) {
            if (!entry.isIntersecting) return;
            revealObserver.unobserve(entry.target);
            reveal(entry.target, i++);
        });
    }, { rootMargin: '0px 0px -8% 0px', threshold: 0.12 });

    document.querySelectorAll('[data-reveal]').forEach(function (el) {
        revealObserver.observe(el);
    });

    // Number counters
    function countUp(el) {
        var target = parseFloat(el.getAttribute('data-count-to'));
        var from = parseFloat(el.getAttribute('data-count-from')) || 0;
        var duration = 1600;
        var start = null;

        function step(now) {
            if (start === null) start = now;
            var t = Math.min((now - start) / duration, 1);
            var eased = 1 - Math.pow(1 - t, 3);
            el.textContent = String(Math.round(from + (target - from) * eased));
            if (t < 1) requestAnimationFrame(step);
        }
        requestAnimationFrame(step);
    }

    var countObserver = new IntersectionObserver(function (entries) {
        entries.forEach(function (entry) {
            if (!entry.isIntersecting) return;
            countObserver.unobserve(entry.target);
            countUp(entry.target);
        });
    }, { threshold: 0.5 });

    document.querySelectorAll('[data-count-to]').forEach(function (el) {
        el.textContent = el.getAttribute('data-count-from') || '0';
        countObserver.observe(el);
    });
})();
