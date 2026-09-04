document.addEventListener('DOMContentLoaded', function () {
    initMobileMenu();
    initSuccessModal();
    initAccordions();
    initHeaderScroll();
    initRevealOnScroll();
    initContactFab();
    initCustomSelects();
});

function initSuccessModal() {
    var modal = document.querySelector('[data-success-modal]');

    if (!modal) {
        return;
    }

    var closers = modal.querySelectorAll('[data-success-modal-close]');

    function close() {
        modal.classList.remove('is-open');
    }

    closers.forEach(function (el) {
        el.addEventListener('click', close);
    });

    document.addEventListener('keydown', function (event) {
        if (event.key === 'Escape' && modal.classList.contains('is-open')) {
            close();
        }
    });

    // Short delay before revealing: the entrance (card scale-in, then the
    // checkmark stroke drawing in after it) reads as a deliberate moment
    // rather than a jump-cut if the page isn't already mid-transition when
    // it starts.
    setTimeout(function () {
        modal.classList.add('is-open');
    }, 150);
}

function initContactFab() {
    var fab = document.querySelector('[data-contact-fab]');
    var trigger = fab ? fab.querySelector('[data-contact-fab-trigger]') : null;

    if (!fab || !trigger) {
        return;
    }

    function close() {
        fab.classList.remove('is-open');
        trigger.setAttribute('aria-expanded', 'false');
    }

    trigger.addEventListener('click', function () {
        var isOpen = fab.classList.toggle('is-open');
        trigger.setAttribute('aria-expanded', isOpen ? 'true' : 'false');
    });

    document.addEventListener('click', function (event) {
        if (!fab.contains(event.target)) {
            close();
        }
    });

    document.addEventListener('keydown', function (event) {
        if (event.key === 'Escape') {
            close();
        }
    });
}

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

// Replaces a native <select> with a custom listbox: the browser's own option
// popup (OS-themed, no CSS access) can't be restyled, so this rebuilds it as
// a button + <ul role="listbox"> kept in sync with the original <select>,
// which stays in the DOM (hidden, not disabled) so the form still submits its
// value normally and still works if this script fails to run.
function initCustomSelects() {
    var wraps = document.querySelectorAll('[data-select]');

    wraps.forEach(function (wrap) {
        var select = wrap.querySelector('select');

        if (!select) {
            return;
        }

        var baseId = select.id || 'select_' + Math.random().toString(36).slice(2);
        select.id = baseId + '__native';
        select.hidden = true;

        wrap.insertAdjacentHTML('beforeend',
            '<button type="button" class="select__trigger" id="' + baseId + '" aria-haspopup="listbox" aria-expanded="false">' +
            '<span class="select__trigger-label"></span>' +
            '<svg class="select__chevron" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M6 9l6 6 6-6"/></svg>' +
            '</button>'
        );

        var trigger = wrap.querySelector('.select__trigger');
        var labelEl = wrap.querySelector('.select__trigger-label');
        // Appended to <body>, not `wrap`: a fixed-position popover panel must
        // sit outside any ancestor that might create its own stacking context
        // (e.g. the .reveal scroll-in animation below uses `transform`,
        // which does exactly that) or it can get painted over despite z-index.
        var listbox = document.createElement('ul');
        listbox.className = 'select__listbox';
        listbox.setAttribute('role', 'listbox');
        document.body.appendChild(listbox);
        var optionEls = [];
        var activeIndex = -1;
        var typeAhead = '';
        var typeAheadTimer = null;

        Array.prototype.forEach.call(select.options, function (opt, index) {
            var li = document.createElement('li');
            li.className = 'select__option';
            li.setAttribute('role', 'option');
            li.id = baseId + '_opt_' + index;
            li.tabIndex = -1;

            var text = document.createElement('span');
            text.textContent = opt.textContent.trim();
            li.appendChild(text);
            li.insertAdjacentHTML('beforeend',
                '<svg class="select__check" viewBox="0 0 16 16" fill="none" stroke="currentColor" stroke-width="2.3" stroke-linecap="round" stroke-linejoin="round"><path d="M3.5 8.5l3 3 6-7"/></svg>'
            );

            li.addEventListener('click', function () {
                selectOption(index);
                close();
                trigger.focus();
            });

            listbox.appendChild(li);
            optionEls.push(li);
        });

        function isOpen() {
            return wrap.classList.contains('is-open');
        }

        function syncFromSelect() {
            var opt = select.options[select.selectedIndex];
            var hasValue = !!opt && opt.value !== '';

            labelEl.textContent = opt ? opt.textContent.trim() : '';
            labelEl.classList.toggle('is-placeholder', !hasValue);

            optionEls.forEach(function (li, index) {
                li.setAttribute('aria-selected', index === select.selectedIndex ? 'true' : 'false');
            });
        }

        function selectOption(index) {
            select.selectedIndex = index;
            select.dispatchEvent(new Event('change', { bubbles: true }));
            syncFromSelect();
        }

        function setActive(index) {
            if (activeIndex >= 0 && optionEls[activeIndex]) {
                optionEls[activeIndex].classList.remove('is-active');
            }

            activeIndex = index;

            if (optionEls[activeIndex]) {
                optionEls[activeIndex].classList.add('is-active');
                optionEls[activeIndex].focus();
                optionEls[activeIndex].scrollIntoView({ block: 'nearest' });
            }
        }

        function reposition() {
            var rect = trigger.getBoundingClientRect();
            listbox.style.top = (rect.bottom + 6) + 'px';
            listbox.style.left = rect.left + 'px';
            listbox.style.width = rect.width + 'px';
        }

        function open() {
            reposition();
            wrap.classList.add('is-open');
            listbox.classList.add('is-open');
            trigger.setAttribute('aria-expanded', 'true');
            window.addEventListener('scroll', reposition, true);
            window.addEventListener('resize', reposition);
            setActive(select.selectedIndex >= 0 ? select.selectedIndex : 0);
        }

        function close() {
            wrap.classList.remove('is-open');
            listbox.classList.remove('is-open');
            trigger.setAttribute('aria-expanded', 'false');
            window.removeEventListener('scroll', reposition, true);
            window.removeEventListener('resize', reposition);

            if (activeIndex >= 0 && optionEls[activeIndex]) {
                optionEls[activeIndex].classList.remove('is-active');
            }

            activeIndex = -1;
        }

        trigger.addEventListener('click', function () {
            if (isOpen()) {
                close();
            } else {
                open();
            }
        });

        trigger.addEventListener('keydown', function (event) {
            if (event.key === 'ArrowDown' || event.key === 'ArrowUp' || event.key === 'Enter' || event.key === ' ') {
                event.preventDefault();

                if (!isOpen()) {
                    open();
                }
            }
        });

        listbox.addEventListener('keydown', function (event) {
            if (event.key === 'ArrowDown') {
                event.preventDefault();
                setActive(Math.min(activeIndex + 1, optionEls.length - 1));
            } else if (event.key === 'ArrowUp') {
                event.preventDefault();
                setActive(Math.max(activeIndex - 1, 0));
            } else if (event.key === 'Home') {
                event.preventDefault();
                setActive(0);
            } else if (event.key === 'End') {
                event.preventDefault();
                setActive(optionEls.length - 1);
            } else if (event.key === 'Enter' || event.key === ' ') {
                event.preventDefault();

                if (activeIndex >= 0) {
                    selectOption(activeIndex);
                }

                close();
                trigger.focus();
            } else if (event.key === 'Escape') {
                event.preventDefault();
                close();
                trigger.focus();
            } else if (event.key === 'Tab') {
                close();
            } else if (event.key.length === 1 && /[a-z0-9]/i.test(event.key)) {
                clearTimeout(typeAheadTimer);
                typeAhead += event.key.toLowerCase();
                typeAheadTimer = setTimeout(function () {
                    typeAhead = '';
                }, 500);

                var match = optionEls.findIndex(function (li) {
                    return li.textContent.trim().toLowerCase().indexOf(typeAhead) === 0;
                });

                if (match >= 0) {
                    setActive(match);
                }
            }
        });

        document.addEventListener('click', function (event) {
            if (isOpen() && !wrap.contains(event.target) && !listbox.contains(event.target)) {
                close();
            }
        });

        syncFromSelect();
    });
}

