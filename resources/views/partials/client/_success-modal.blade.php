@if (session('success'))
    <div class="success-modal" data-success-modal role="alertdialog" aria-live="polite" aria-labelledby="successModalTitle">
        <div class="success-modal__backdrop" data-success-modal-close></div>
        <div class="success-modal__card">
            <button type="button" class="success-modal__close" data-success-modal-close aria-label="Đóng thông báo">
                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2" stroke-linecap="round">
                    <path d="M6 6l12 12M18 6L6 18" />
                </svg>
            </button>

            <div class="success-modal__badge">
                <svg viewBox="0 0 24 24" fill="none">
                    <path class="success-modal__check" d="M5 13l5 5L19 7" stroke="var(--ink)" stroke-width="2.6"
                        stroke-linecap="round" stroke-linejoin="round" />
                </svg>
            </div>

            <h2 id="successModalTitle">Đăng ký thành công!</h2>
            <p>{{ session('success') }}</p>

            <button type="button" class="btn btn--accent btn--block" data-success-modal-close>Đã hiểu</button>
        </div>
    </div>
@endif
