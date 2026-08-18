document.addEventListener('DOMContentLoaded', function () {
    initActivityFilters();
});

function initActivityFilters() {
    var chips = document.querySelectorAll('.archive-filter-chip');
    var cards = document.querySelectorAll('.activity-grid .activity-card[data-category]');
    var emptyState = document.getElementById('archiveEmpty');
    var filterLabel = document.getElementById('filterLabel');
    var filterCount = document.getElementById('filterCount');
    var archiveSection = document.getElementById('archive');
    var QUERY_KEY = 'danh-muc';
    var TRANSITION_MS = 320;
    var STAGGER_STEP_MS = 35;
    var STAGGER_MAX_MS = 175;

    if (!chips.length || !cards.length) {
        return;
    }

    function updateUrl(category) {
        var url = new URL(window.location.href);
        if (category === 'all') {
            url.searchParams.delete(QUERY_KEY);
        } else {
            url.searchParams.set(QUERY_KEY, category);
        }
        window.history.replaceState({}, '', url);
    }

    function showCard(card, staggerIndex, instant) {
        window.clearTimeout(card._filterTimeout);

        if (instant) {
            card.style.display = '';
            return;
        }

        var wasHidden = card.style.display === 'none';
        card.style.display = '';

        if (wasHidden) {
            card.style.transitionDelay = Math.min(staggerIndex * STAGGER_STEP_MS, STAGGER_MAX_MS) + 'ms';
            card.classList.add('is-entering');
            // Force a reflow so the browser registers the "entering" state before it's removed,
            // otherwise both class changes collapse into a single paint and nothing animates.
            void card.offsetWidth;
            requestAnimationFrame(function () {
                card.classList.remove('is-entering');
            });
            window.clearTimeout(card._filterTimeout);
            card._filterTimeout = window.setTimeout(function () {
                card.style.transitionDelay = '';
            }, TRANSITION_MS + STAGGER_MAX_MS);
        }
    }

    function hideCard(card) {
        // No exit animation: an opacity/transform fade keeps the card occupying its
        // flex-basis width for the whole transition, crowding the cards that ARE
        // staying visible and forcing them to wrap onto a second row until the fade
        // finishes - a visible "stack then snap back to one row" jump. Removing it
        // from flow immediately avoids that; the entrance animation below is what
        // actually reads as "switching categories" to the user anyway.
        window.clearTimeout(card._filterTimeout);
        card.classList.remove('is-leaving', 'is-entering');
        card.style.transitionDelay = '';
        card.style.display = 'none';
    }

    function applyFilter(category, label, options) {
        options = options || {};

        chips.forEach(function (chip) {
            chip.classList.toggle('is-active', chip.getAttribute('data-category') === category);
        });

        var visible = 0;
        var enteringIndex = 0;
        cards.forEach(function (card) {
            var match = category === 'all' || card.getAttribute('data-category') === category;
            if (match) {
                visible++;
                showCard(card, enteringIndex, options.instant);
                enteringIndex++;
            } else {
                hideCard(card);
            }
        });

        if (emptyState) {
            emptyState.classList.toggle('is-visible', visible === 0);
        }
        if (filterLabel) {
            filterLabel.textContent = label;
        }
        if (filterCount) {
            filterCount.textContent = visible;
        }
        if (!options.skipUrlUpdate) {
            updateUrl(category);
        }
    }

    chips.forEach(function (chip) {
        chip.addEventListener('click', function () {
            var category = chip.getAttribute('data-category');
            var label = chip.querySelector('span') ? chip.querySelector('span').textContent : category;
            applyFilter(category, label);
        });
    });

    var gotoButtons = document.querySelectorAll('[data-goto-category]');
    gotoButtons.forEach(function (btn) {
        btn.addEventListener('click', function () {
            var category = btn.getAttribute('data-goto-category');
            var label = btn.getAttribute('data-goto-label') || category;
            applyFilter(category, label);
            if (archiveSection) {
                archiveSection.scrollIntoView({ behavior: 'smooth', block: 'start' });
            }
        });
    });

    var initialCategory = new URL(window.location.href).searchParams.get(QUERY_KEY);
    if (initialCategory) {
        var matchingChip = document.querySelector('.archive-filter-chip[data-category="' + initialCategory + '"]');
        if (matchingChip) {
            var label = matchingChip.querySelector('span') ? matchingChip.querySelector('span').textContent : initialCategory;
            applyFilter(initialCategory, label, { skipUrlUpdate: true, instant: true });
        }
    }
}
