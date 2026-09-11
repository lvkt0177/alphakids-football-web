document.addEventListener('DOMContentLoaded', function () {
    initGalleryLightbox();
});

function initGalleryLightbox() {
    // Only photo figures drive the lightbox - video figures carry native
    // <video controls> and are excluded so render()'s `img` lookup below
    // never hits a video figure and breaks.
    var figures = Array.prototype.slice.call(document.querySelectorAll('#showGallery .show-gallery__photo'));
    var lightbox = document.getElementById('showLightbox');

    if (!figures.length || !lightbox) {
        return;
    }

    var lbImage = document.getElementById('showLbImage');
    var lbCount = document.getElementById('showLbCount');
    var current = 0;
    var SWIPE_THRESHOLD = 70;
    var SLIDE_MS = 220;
    var drag = null;

    function render() {
        var img = figures[current].querySelector('img');
        lbImage.src = img.src;
        lbImage.alt = img.alt;
        lbCount.textContent = (current + 1) + ' / ' + figures.length;
    }

    function resetTransform() {
        lbImage.style.transition = 'none';
        lbImage.style.transform = 'translateX(0)';
    }

    function open(index) {
        current = index;
        render();
        resetTransform();
        lightbox.classList.add('is-open');
        document.body.classList.add('no-scroll');
    }

    function close() {
        lightbox.classList.remove('is-open');
        document.body.classList.remove('no-scroll');
    }

    // direction: -1 = prev, 1 = next. viaSwipe adds the slide-out/slide-in
    // transition (what the finger just did); button/keyboard nav stays an
    // instant swap, unchanged from before.
    function step(direction, viaSwipe) {
        current = (current + direction + figures.length) % figures.length;

        if (!viaSwipe) {
            render();
            resetTransform();
            return;
        }

        var exitX = direction > 0 ? '-100%' : '100%';
        lbImage.style.transition = 'transform ' + SLIDE_MS + 'ms cubic-bezier(.16,1,.3,1)';
        lbImage.style.transform = 'translateX(' + exitX + ')';

        lbImage.addEventListener('transitionend', function onExit() {
            lbImage.removeEventListener('transitionend', onExit);
            render();
            lbImage.style.transition = 'none';
            lbImage.style.transform = 'translateX(' + (direction > 0 ? '40px' : '-40px') + ')';
            void lbImage.offsetWidth; // flush so the next transform change animates
            lbImage.style.transition = 'transform ' + SLIDE_MS + 'ms cubic-bezier(.16,1,.3,1)';
            lbImage.style.transform = 'translateX(0)';
        }, { once: true });
    }

    figures.forEach(function (figure, index) {
        figure.addEventListener('click', function () {
            open(index);
        });
    });

    document.getElementById('showLbClose').addEventListener('click', close);
    document.getElementById('showLbPrev').addEventListener('click', function () {
        step(-1);
    });
    document.getElementById('showLbNext').addEventListener('click', function () {
        step(1);
    });

    lightbox.addEventListener('click', function (e) {
        if (e.target === lightbox) {
            close();
        }
    });

    document.addEventListener('keydown', function (e) {
        if (!lightbox.classList.contains('is-open')) {
            return;
        }
        if (e.key === 'Escape') {
            close();
        }
        if (e.key === 'ArrowLeft') {
            step(-1);
        }
        if (e.key === 'ArrowRight') {
            step(1);
        }
    });

    // ---------- swipe to browse (touch drag tracks the finger 1:1) ----------
    lbImage.addEventListener('pointerdown', function (e) {
        if (e.button !== undefined && e.button !== 0) {
            return;
        }
        drag = { startX: e.clientX, lastX: e.clientX, moved: false };
        lbImage.setPointerCapture(e.pointerId);
    });

    lbImage.addEventListener('pointermove', function (e) {
        if (!drag) {
            return;
        }
        var deltaX = e.clientX - drag.startX;

        if (!drag.moved && Math.abs(deltaX) > 6) {
            drag.moved = true;
            lbImage.style.transition = 'none';
        }
        if (!drag.moved) {
            return;
        }

        var atStart = current === 0 && deltaX > 0;
        var atEnd = current === figures.length - 1 && deltaX < 0;
        var tracked = (atStart || atEnd) ? deltaX * 0.35 : deltaX; // rubber-band at the ends

        drag.lastX = e.clientX;
        lbImage.style.transform = 'translateX(' + tracked + 'px)';
    });

    function endDrag(e) {
        if (!drag) {
            return;
        }
        var deltaX = drag.moved ? (drag.lastX - drag.startX) : 0;
        var wasMoved = drag.moved;
        drag = null;

        if (!wasMoved) {
            return;
        }

        var atStart = current === 0 && deltaX > 0;
        var atEnd = current === figures.length - 1 && deltaX < 0;

        if (!atStart && !atEnd && Math.abs(deltaX) > SWIPE_THRESHOLD) {
            step(deltaX < 0 ? 1 : -1, true);
        } else {
            lbImage.style.transition = 'transform ' + SLIDE_MS + 'ms cubic-bezier(.16,1,.3,1)';
            lbImage.style.transform = 'translateX(0)';
        }
    }

    lbImage.addEventListener('pointerup', endDrag);
    lbImage.addEventListener('pointercancel', endDrag);
}
