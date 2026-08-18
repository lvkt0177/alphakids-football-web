<div id="toastContainer" class="toast-container"></div>

@if (session('success') || session('error'))
    <div id="flashData" data-success="{{ session('success') }}" data-error="{{ session('error') }}" style="display:none;">
    </div>
@endif
