document.addEventListener('DOMContentLoaded', function () {
    initPillarBento();
});

function initPillarBento() {
    var wrap = document.getElementById('pillarBento');
    var cards = wrap ? wrap.querySelectorAll('[data-pillar-card]') : [];
    var dots = wrap ? wrap.querySelectorAll('[data-pillar-dot]') : [];
    var linePath = wrap ? wrap.querySelector('[data-pillar-path]') : null;
    var lineSvg = wrap ? wrap.querySelector('.pillar-bento__line') : null;

    if (!wrap || !cards.length) {
        return;
    }

    var pathLength = 0;
    var layoutTicking = false;
    var ticking = false;

    // Real-pixel geometry: the connecting line is drawn between each card's
    // actual measured center, not a fixed 100x100 percentage grid. This keeps
    // it undistorted at any container aspect ratio, and lets it degrade
    // correctly to a vertical line when the grid collapses to one column on
    // mobile instead of needing to be hidden there.
    function layoutLine() {
        layoutTicking = false;

        var wrapRect = wrap.getBoundingClientRect();
        if (!wrapRect.width || !wrapRect.height) {
            return;
        }

        if (lineSvg) {
            lineSvg.setAttribute('viewBox', '0 0 ' + wrapRect.width + ' ' + wrapRect.height);
        }

        var centers = [];
        cards.forEach(function (card) {
            var cardRect = card.getBoundingClientRect();
            centers.push({
                x: cardRect.left - wrapRect.left + cardRect.width / 2,
                y: cardRect.top - wrapRect.top + cardRect.height / 2
            });
        });

        if (linePath && centers.length) {
            var d = 'M' + centers[0].x + ',' + centers[0].y;
            for (var i = 1; i < centers.length; i++) {
                d += ' L' + centers[i].x + ',' + centers[i].y;
            }
            linePath.setAttribute('d', d);
            pathLength = linePath.getTotalLength();
        }

        dots.forEach(function (dot, index) {
            if (centers[index]) {
                dot.setAttribute('cx', centers[index].x);
                dot.setAttribute('cy', centers[index].y);
            }
        });

        update();
    }

    function onResize() {
        if (!layoutTicking) {
            requestAnimationFrame(layoutLine);
            layoutTicking = true;
        }
    }

    function update() {
        ticking = false;

        var rect = wrap.getBoundingClientRect();
        var viewportH = window.innerHeight;
        var startTop = viewportH;
        var centeredTop = (viewportH - rect.height) / 2;

        var raw = (startTop - rect.top) / (startTop - centeredTop);
        var progress = Math.min(1, Math.max(0, raw));
        var activeCount = Math.min(cards.length, Math.floor(progress * cards.length + 0.0001));

        cards.forEach(function (card, index) {
            card.classList.toggle('is-active', index < activeCount);
        });
        dots.forEach(function (dot, index) {
            dot.classList.toggle('is-active', index < activeCount);
        });

        if (linePath && pathLength) {
            linePath.style.strokeDasharray = pathLength;
            linePath.style.strokeDashoffset = pathLength * (1 - progress);
        }
    }

    function onScroll() {
        if (!ticking) {
            requestAnimationFrame(update);
            ticking = true;
        }
    }

    window.addEventListener('scroll', onScroll, { passive: true });
    window.addEventListener('resize', onResize);

    layoutLine();
}
