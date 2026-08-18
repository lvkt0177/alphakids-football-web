window.AdminToast = (function () {
    function ensureContainer() {
        let container = document.getElementById('toastContainer');
        if (!container) {
            container = document.createElement('div');
            container.id = 'toastContainer';
            container.className = 'toast-container';
            document.body.appendChild(container);
        }
        return container;
    }

    function show(message, type = 'success', duration = 3200) {
        if (!message) return;

        const container = ensureContainer();
        const item = document.createElement('div');
        item.className = `toast-item toast-${type}`;

        const icon = type === 'error'
            ? '<svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="12" r="9"/><path d="M12 8v5"/><path d="M12 16h.01"/></svg>'
            : '<svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round"><path d="M5 13l4 4L19 7"/></svg>';

        item.innerHTML = `${icon}<span>${message}</span>`;
        container.appendChild(item);

        requestAnimationFrame(() => item.classList.add('show'));

        setTimeout(() => {
            item.classList.remove('show');
            setTimeout(() => item.remove(), 250);
        }, duration);
    }

    return { show };
})();

document.addEventListener('DOMContentLoaded', function () {
    const flash = document.getElementById('flashData');
    if (flash) {
        if (flash.dataset.success) window.AdminToast.show(flash.dataset.success, 'success');
        if (flash.dataset.error) window.AdminToast.show(flash.dataset.error, 'error');
    }
});