document.addEventListener('DOMContentLoaded', function () {
    document.querySelectorAll('.tab-btn').forEach(function (btn) {
        btn.addEventListener('click', function () {
            document.querySelectorAll('.tab-btn').forEach(b => b.classList.remove('active'));
            btn.classList.add('active');
            document.querySelectorAll('.tab-panel').forEach(p => p.classList.remove('active'));
            document.getElementById('tab-' + btn.dataset.tab).classList.add('active');
        });
    });

    document.querySelectorAll('input[name=video_mode]').forEach(function (radio) {
        radio.addEventListener('change', function () {
            document.querySelectorAll('.video-input-mode').forEach(el => el.classList.remove('active'));
            document.getElementById('mode-' + radio.value).classList.add('active');
        });
    });
});