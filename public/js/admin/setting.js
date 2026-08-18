document.addEventListener('DOMContentLoaded', function () {
    const storageKey = 'admin_active_tab:' + window.location.pathname;

    function activateTab(tabKey) {
        const btn = document.querySelector('.tab-btn[data-tab="' + tabKey + '"]');
        const panel = document.getElementById('tab-' + tabKey);
        if (!btn || !panel) return;

        document.querySelectorAll('.tab-btn').forEach(b => b.classList.remove('active'));
        document.querySelectorAll('.tab-panel').forEach(p => p.classList.remove('active'));

        btn.classList.add('active');
        panel.classList.add('active');
    }

    document.querySelectorAll('.tab-btn').forEach(function (btn) {
        btn.addEventListener('click', function () {
            activateTab(btn.dataset.tab);
            localStorage.setItem(storageKey, btn.dataset.tab);
        });
    });

    const savedTab = localStorage.getItem(storageKey);
    if (savedTab) {
        activateTab(savedTab);
    }

    document.querySelectorAll('input[name=video_mode]').forEach(function (radio) {
        radio.addEventListener('change', function () {
            document.querySelectorAll('.video-input-mode').forEach(el => el.classList.remove('active'));
            document.getElementById('mode-' + radio.value).classList.add('active');
        });
    });

    document.querySelectorAll('.image-card input[type=file]').forEach(function (input) {
        // The hero banner's crop widget (hero-crop.js) owns its own preview
        // via the two Cropper.js frames - it has no `.image-preview` element,
        // so this generic handler would throw trying to write into a null
        // previewBox. Skip it here, let hero-crop.js handle it.
        if (input.id === 'heroCropSourceInput' || input.id === 'heroCropMobileSourceInput') return;

        input.addEventListener('change', function () {
            const file = input.files && input.files[0];
            if (!file) return;

            const card = input.closest('.image-card');
            const previewBox = card.querySelector('.image-preview');

            const reader = new FileReader();
            reader.onload = function (e) {
                previewBox.innerHTML = `<img src="${e.target.result}" alt="Xem trước ảnh">`;
            };
            reader.readAsDataURL(file);
        });
    });
});