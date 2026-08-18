window.AdminConfirm = (function () {
    let overlay, titleEl, descEl, okBtn, cancelBtn, pendingForm = null;

    function init() {
        overlay = document.getElementById('confirmModalOverlay');
        titleEl = document.getElementById('confirmModalTitle');
        descEl = document.getElementById('confirmModalDesc');
        okBtn = document.getElementById('confirmModalOk');
        cancelBtn = document.getElementById('confirmModalCancel');

        if (!overlay) return;

        okBtn.addEventListener('click', () => {
            if (pendingForm) pendingForm.submit();
            close();
        });
        cancelBtn.addEventListener('click', close);
        overlay.addEventListener('click', (e) => {
            if (e.target === overlay) close();
        });

        document.addEventListener('submit', function (e) {
            const form = e.target;
            if (form.hasAttribute('data-confirm')) {
                e.preventDefault();
                open(form);
            }
        });
    }

    function open(form) {
        pendingForm = form;
        titleEl.textContent = form.dataset.confirmTitle || 'Xác nhận';
        descEl.textContent = form.dataset.confirm || 'Bạn có chắc chắn muốn thực hiện hành động này?';
        overlay.classList.add('show');
    }

    function close() {
        overlay.classList.remove('show');
        pendingForm = null;
    }

    document.addEventListener('DOMContentLoaded', init);

    return { open, close };
})();