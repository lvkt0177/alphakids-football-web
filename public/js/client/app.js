document.addEventListener('DOMContentLoaded', function () {
    initMobileMenu();
    initFlashToast();
    initAccordions();
    initHeaderScroll();
    initRevealOnScroll();
});

function initRevealOnScroll() {
    var groups = document.querySelectorAll('[data-reveal-group]');

    if (!groups.length) {
        return;
    }

    if (!('IntersectionObserver' in window)) {
        groups.forEach(function (group) {
            group.classList.add('is-inview');
        });
        return;
    }

    var observer = new IntersectionObserver(function (entries) {
        entries.forEach(function (entry) {
            if (entry.isIntersecting) {
                entry.target.classList.add('is-inview');
                observer.unobserve(entry.target);
            }
        });
    }, { threshold: 0.2, rootMargin: '0px 0px -8% 0px' });

    groups.forEach(function (group) {
        observer.observe(group);
    });
}

function initHeaderScroll() {
    var header = document.getElementById('siteHeader');

    if (!header) {
        return;
    }

    var ticking = false;

    function update() {
        ticking = false;
        header.classList.toggle('is-scrolled', window.scrollY > 48);
    }

    window.addEventListener('scroll', function () {
        if (!ticking) {
            requestAnimationFrame(update);
            ticking = true;
        }
    }, { passive: true });

    update();
}

function initMobileMenu() {
    var toggle = document.getElementById('menuToggle');
    var closeBtn = document.getElementById('menuClose');
    var menu = document.getElementById('mobileMenu');
    var overlay = document.getElementById('mobileMenuOverlay');

    if (!toggle || !menu) {
        return;
    }

    function openMenu() {
        menu.classList.add('is-open');
        document.body.classList.add('no-scroll');
        toggle.setAttribute('aria-expanded', 'true');
        menu.setAttribute('aria-hidden', 'false');
    }

    function closeMenu() {
        menu.classList.remove('is-open');
        document.body.classList.remove('no-scroll');
        toggle.setAttribute('aria-expanded', 'false');
        menu.setAttribute('aria-hidden', 'true');
    }

    toggle.addEventListener('click', openMenu);

    if (closeBtn) {
        closeBtn.addEventListener('click', closeMenu);
    }

    if (overlay) {
        overlay.addEventListener('click', closeMenu);
    }

    menu.querySelectorAll('a').forEach(function (link) {
        link.addEventListener('click', closeMenu);
    });

    window.addEventListener('keydown', function (event) {
        if (event.key === 'Escape') {
            closeMenu();
        }
    });
}

function initAccordions() {
    var accordions = document.querySelectorAll('[data-accordion]');

    accordions.forEach(function (accordion) {
        var triggers = accordion.querySelectorAll('[data-accordion-trigger]');

        triggers.forEach(function (trigger) {
            trigger.addEventListener('click', function () {
                var alreadyOpen = trigger.getAttribute('aria-expanded') === 'true';

                triggers.forEach(function (other) {
                    other.setAttribute('aria-expanded', 'false');
                });

                trigger.setAttribute('aria-expanded', alreadyOpen ? 'false' : 'true');
            });
        });
    });
}

function initFlashToast() {
    var toast = document.querySelector('[data-flash]');

    if (!toast) {
        return;
    }

    setTimeout(function () {
        toast.classList.add('is-hidden');
    }, 4000);
}