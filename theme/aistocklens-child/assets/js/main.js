/**
 * AI Stock Lens — Main JS
 * Vanilla JS, no dependencies.
 */
(function () {
    'use strict';

    /* ------------------------------------------------------------------
       FAQ ACCORDION
    ------------------------------------------------------------------ */
    function initFaq() {
        document.querySelectorAll('.asl-faq__question').forEach(function (btn) {
            btn.addEventListener('click', function () {
                var expanded = this.getAttribute('aria-expanded') === 'true';
                var answerId = this.getAttribute('aria-controls');
                var answer   = document.getElementById(answerId);

                // Close all
                document.querySelectorAll('.asl-faq__question').forEach(function (b) {
                    b.setAttribute('aria-expanded', 'false');
                    var id = b.getAttribute('aria-controls');
                    var a  = document.getElementById(id);
                    if (a) a.classList.remove('is-open');
                });

                // Open clicked if it was closed
                if (!expanded && answer) {
                    this.setAttribute('aria-expanded', 'true');
                    answer.classList.add('is-open');
                }
            });
        });
    }

    /* ------------------------------------------------------------------
       SMOOTH SCROLL for anchor links
    ------------------------------------------------------------------ */
    function initSmoothScroll() {
        document.querySelectorAll('a[href^="#"]').forEach(function (a) {
            a.addEventListener('click', function (e) {
                var href   = this.getAttribute('href');
                var target = document.querySelector(href);
                if (!target) return;
                e.preventDefault();
                var offset = 80;
                var top    = target.getBoundingClientRect().top + window.pageYOffset - offset;
                window.scrollTo({ top: top, behavior: 'smooth' });
            });
        });
    }

    /* ------------------------------------------------------------------
       ACTIVE LESSON NAV highlight on scroll
    ------------------------------------------------------------------ */
    function initLessonNav() {
        var navItems = document.querySelectorAll('.asl-lesson-nav__item a');
        if (!navItems.length) return;

        var headings = document.querySelectorAll('.asl-lesson-content h2[id], .asl-lesson-content h3[id]');
        if (!headings.length) return;

        var observer = new IntersectionObserver(function (entries) {
            entries.forEach(function (entry) {
                if (entry.isIntersecting) {
                    var id = entry.target.getAttribute('id');
                    navItems.forEach(function (item) {
                        item.classList.remove('active');
                        if (item.getAttribute('href') === '#' + id) {
                            item.classList.add('active');
                        }
                    });
                }
            });
        }, { rootMargin: '-80px 0px -60% 0px' });

        headings.forEach(function (h) { observer.observe(h); });
    }

    /* ------------------------------------------------------------------
       MOBILE NAV TOGGLE (complements Blocksy; just ensures our
       custom classes are toggled correctly)
    ------------------------------------------------------------------ */
    function initMobileNav() {
        var toggle = document.querySelector('.asl-mobile-nav-toggle');
        var nav    = document.querySelector('.asl-mobile-nav');
        if (!toggle || !nav) return;

        toggle.addEventListener('click', function () {
            var open = toggle.getAttribute('aria-expanded') === 'true';
            toggle.setAttribute('aria-expanded', String(!open));
            nav.classList.toggle('is-open', !open);
            document.body.classList.toggle('nav-open', !open);
        });
    }

    /* ------------------------------------------------------------------
       LAZY-LOAD images (native loading="lazy" handles most cases;
       this is a polyfill fallback for older browsers)
    ------------------------------------------------------------------ */
    function initLazyImages() {
        if ('loading' in HTMLImageElement.prototype) return;
        var imgs = document.querySelectorAll('img[loading="lazy"]');
        var io   = new IntersectionObserver(function (entries, obs) {
            entries.forEach(function (entry) {
                if (entry.isIntersecting) {
                    var img = entry.target;
                    if (img.dataset.src) img.src = img.dataset.src;
                    obs.unobserve(img);
                }
            });
        });
        imgs.forEach(function (img) { io.observe(img); });
    }

    /* ------------------------------------------------------------------
       INIT
    ------------------------------------------------------------------ */
    document.addEventListener('DOMContentLoaded', function () {
        initFaq();
        initSmoothScroll();
        initLessonNav();
        initMobileNav();
        initLazyImages();
    });
}());
