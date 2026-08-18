document.addEventListener('DOMContentLoaded', function () {
    initHeroLoad();
    initHeroParallax();
    initTimelineStack();
    initVideoSplit();
    initVideoPlayHint();
    initDragScroll();
    initProofSpotlight();
});

function initProofSpotlight() {
    var dataEl = document.getElementById('proofQuotesData');

    if (!dataEl) {
        return;
    }

    var quotes = JSON.parse(dataEl.textContent);

    if (!quotes.length) {
        return;
    }

    var index = 0;
    var timer;
    var quoteEl = document.getElementById('proofSpotQuote');
    var authorEl = document.getElementById('proofSpotAuthor');
    var dotsEl = document.getElementById('proofSpotDots');
    var peekPrevBtn = document.getElementById('proofPeekPrev');
    var peekNextBtn = document.getElementById('proofPeekNext');
    var peekPrevQuote = document.getElementById('proofPeekPrevQuote');
    var peekPrevAuthor = document.getElementById('proofPeekPrevAuthor');
    var peekNextQuote = document.getElementById('proofPeekNextQuote');
    var peekNextAuthor = document.getElementById('proofPeekNextAuthor');

    function at(offset) {
        return (index + offset + quotes.length) % quotes.length;
    }

    function renderDots() {
        dotsEl.innerHTML = quotes.map(function (q, i) {
            return '<button type="button" class="proof-spotlight__dot' + (i === index ? ' is-active' : '') +
                '" data-i="' + i + '" aria-label="Câu ' + (i + 1) + '/' + quotes.length + '"' +
                (i === index ? ' aria-current="true"' : '') + '></button>';
        }).join('');
    }

    function renderPeeks() {
        if (!peekPrevBtn || quotes.length < 3) {
            return;
        }
        var prev = quotes[at(-1)];
        var next = quotes[at(1)];
        peekPrevQuote.textContent = '“' + prev.quote + '”';
        peekPrevAuthor.textContent = prev.author;
        peekNextQuote.textContent = '“' + next.quote + '”';
        peekNextAuthor.textContent = next.author;
    }

    function show(i, skipFade) {
        index = (i + quotes.length) % quotes.length;

        var apply = function () {
            quoteEl.textContent = '“' + quotes[index].quote + '”';
            authorEl.textContent = quotes[index].author;
            renderDots();
            renderPeeks();
        };

        if (skipFade) {
            apply();
            return;
        }

        quoteEl.classList.add('is-swapping');
        authorEl.classList.add('is-swapping');
        setTimeout(function () {
            apply();
            quoteEl.classList.remove('is-swapping');
            authorEl.classList.remove('is-swapping');
        }, 220);
    }

    function resetTimer() {
        clearInterval(timer);
        timer = setInterval(function () {
            show(index + 1);
        }, 5000);
    }

    show(0, true);
    resetTimer();

    if (peekPrevBtn) {
        peekPrevBtn.addEventListener('click', function () {
            show(index - 1);
            resetTimer();
        });
    }

    if (peekNextBtn) {
        peekNextBtn.addEventListener('click', function () {
            show(index + 1);
            resetTimer();
        });
    }

    dotsEl.addEventListener('click', function (event) {
        var btn = event.target.closest('.proof-spotlight__dot');
        if (!btn) {
            return;
        }
        show(+btn.dataset.i);
        resetTimer();
    });
}

function initDragScroll() {
    var track = document.getElementById('activitiesTrack');

    if (!track) {
        return;
    }

    var isDown = false;
    var startX = 0;
    var startScroll = 0;

    track.addEventListener('mousedown', function (event) {
        isDown = true;
        track.classList.add('is-dragging');
        startX = event.pageX;
        startScroll = track.scrollLeft;
    });

    window.addEventListener('mouseup', function () {
        if (!isDown) {
            return;
        }
        isDown = false;
        track.classList.remove('is-dragging');
    });

    window.addEventListener('mousemove', function (event) {
        if (!isDown) {
            return;
        }
        event.preventDefault();
        track.scrollLeft = startScroll - (event.pageX - startX);
    });
}

function initHeroLoad() {
    var hero = document.getElementById('hero');

    if (!hero) {
        return;
    }

    requestAnimationFrame(function () {
        requestAnimationFrame(function () {
            hero.classList.add('is-loaded');
        });
    });
}

function initHeroParallax() {
    var hero = document.getElementById('hero');
    var img = document.getElementById('heroPhotoImg');

    if (!hero || !img) {
        return;
    }

    var ticking = false;

    function update() {
        ticking = false;
        var rect = hero.getBoundingClientRect();

        if (rect.bottom < 0 || rect.top > window.innerHeight) {
            return;
        }

        var progress = Math.min(1, Math.max(0, -rect.top / Math.max(rect.height, 1)));
        var offset = progress * 60;
        img.style.transform = 'translateY(' + offset.toFixed(1) + 'px)';
    }

    function onScroll() {
        if (!ticking) {
            requestAnimationFrame(update);
            ticking = true;
        }
    }

    window.addEventListener('scroll', onScroll, { passive: true });
    update();
}

function initTimelineStack() {
    var stack = document.getElementById('timelineStack');
    var railFill = document.getElementById('timelineRailFill');
    var panels = stack ? stack.querySelectorAll('[data-timeline-step]') : [];
    var dots = stack ? stack.querySelectorAll('[data-timeline-dot]') : [];

    if (!stack || !railFill || !panels.length) {
        return;
    }

    var ticking = false;

    function update() {
        ticking = false;

        var viewportH = window.innerHeight;
        var activationLine = viewportH * (1 / 3);

        var activeCount = 0;
        panels.forEach(function (panel) {
            if (panel.getBoundingClientRect().top <= activationLine) {
                activeCount += 1;
            }
        });

        var progress = activeCount / panels.length;
        stack.style.setProperty('--progress', progress);

        panels.forEach(function (panel, index) {
            panel.classList.toggle('is-active', index < activeCount);
        });
        dots.forEach(function (dot, index) {
            dot.classList.toggle('is-filled', index < activeCount);
        });
    }

    function onScroll() {
        if (!ticking) {
            requestAnimationFrame(update);
            ticking = true;
        }
    }

    window.addEventListener('scroll', onScroll, { passive: true });
    window.addEventListener('resize', onScroll);
    update();
}

function initVideoSplit() {
    var section = document.getElementById('introVideoSection');
    var stage = document.getElementById('introVideoStage');
    var feature = document.querySelector('.intro-video-feature');

    if (!section || !stage) {
        return;
    }

    function update() {
        var sectionRect = section.getBoundingClientRect();
        var stageRect = stage.getBoundingClientRect();
        var splitHeight = (stageRect.top - sectionRect.top) + (stageRect.height * 2 / 3);
        section.style.setProperty('--video-split-height', splitHeight + 'px');
    }

    var ticking = false;
    function onScroll() {
        if (!ticking) {
            requestAnimationFrame(function () {
                update();
                ticking = false;
            });
            ticking = true;
        }
    }

    update();
    window.addEventListener('resize', update);
    window.addEventListener('load', update);
    window.addEventListener('scroll', onScroll, { passive: true });

    if (feature) {
        feature.addEventListener('transitionend', update);
    }

    if (document.fonts && document.fonts.ready) {
        document.fonts.ready.then(update);
    }
}

function initVideoPlayHint() {
    var video = document.getElementById('introVideoEl');
    var hint = document.getElementById('introVideoPlayHint');

    if (!video || !hint) {
        return;
    }

    hint.addEventListener('click', function () {
        video.play();
    });

    video.addEventListener('play', function () {
        hint.classList.add('is-hidden');
    });

    video.addEventListener('pause', function () {
        hint.classList.remove('is-hidden');
    });
}
