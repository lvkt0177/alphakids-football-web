function initWeeklyMemoReveal() {
    var section = document.getElementById('weeklyMemo');

    if (!section) {
        return;
    }

    var rows = section.querySelectorAll('.memo-row');

    if (!('IntersectionObserver' in window)) {
        rows.forEach(function (row) {
            row.classList.add('is-visible');
        });
        return;
    }

    var observer = new IntersectionObserver(function (entries) {
        entries.forEach(function (entry) {
            if (entry.isIntersecting) {
                entry.target.classList.add('is-visible');
                observer.unobserve(entry.target);
            }
        });
    }, { threshold: 0.35, rootMargin: '0px 0px -8% 0px' });

    rows.forEach(function (row) {
        observer.observe(row);
    });
}

document.addEventListener('DOMContentLoaded', function () {
    initWeeklyMemoReveal();
});
