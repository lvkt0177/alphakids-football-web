document.addEventListener('DOMContentLoaded', function () {
    initActivityGalleryManager();
});

function initActivityGalleryManager() {
    var grid = document.getElementById('galleryGrid');
    if (!grid) {
        return;
    }

    // Kept in sync with Admin\ActivityController::uploadTempImage()'s rule.
    var MAX_FILE_BYTES = 30 * 1024 * 1024;

    var form = grid.closest('form');
    var dropzone = document.getElementById('galleryDropzone');
    var fileInput = document.getElementById('galleryFileInput');
    var uploadStatus = document.getElementById('galleryUploadStatus');
    var warningsBox = document.getElementById('galleryWarnings');
    var stateInput = document.getElementById('galleryState');
    var tempUploadUrl = grid.dataset.tempUploadUrl;
    var tokenInput = document.querySelector('input[name="_token"]');
    var csrfToken = tokenInput ? tokenInput.value : '';
    var uploadsInFlight = 0;

    function formatMB(bytes) {
        return (bytes / (1024 * 1024)).toFixed(1) + 'MB';
    }

    function renderWarnings(messages) {
        if (!warningsBox) {
            return;
        }
        warningsBox.innerHTML = messages
            .map(function (message) {
                return '<p class="field-error">' + message + '</p>';
            })
            .join('');
    }

    function renumber() {
        var tiles = Array.prototype.slice.call(grid.querySelectorAll('.gallery-tile'));
        tiles.forEach(function (tile, index) {
            var orderBadge = tile.querySelector('.gallery-tile__order');
            if (orderBadge) {
                orderBadge.textContent = index + 1;
            }
            var upBtn = tile.querySelector('.gallery-move-up');
            var downBtn = tile.querySelector('.gallery-move-down');
            if (upBtn) {
                upBtn.disabled = (index === 0);
            }
            if (downBtn) {
                downBtn.disabled = (index === tiles.length - 1);
            }
        });
    }

    grid.addEventListener('click', function (e) {
        var tile = e.target.closest('.gallery-tile');
        if (!tile) {
            return;
        }

        if (e.target.closest('.gallery-move-up')) {
            var prev = tile.previousElementSibling;
            if (prev && prev.classList.contains('gallery-tile')) {
                grid.insertBefore(tile, prev);
            }
            renumber();
        }

        if (e.target.closest('.gallery-move-down')) {
            var next = tile.nextElementSibling;
            if (next && next.classList.contains('gallery-tile')) {
                grid.insertBefore(next, tile);
            }
            renumber();
        }

        if (e.target.closest('.gallery-mark-delete')) {
            tile.classList.add('is-marked-delete');
        }

        if (e.target.closest('.gallery-undo')) {
            tile.classList.remove('is-marked-delete');
        }
    });

    function buildTileMarkup(imgSrc, isNew) {
        return (
            '<div class="gallery-tile__media">' +
                '<img src="' + imgSrc + '" alt="">' +
                '<span class="gallery-tile__order"></span>' +
                (isNew ? '<span class="gallery-tile__new">Mới</span>' : '') +
                '<div class="gallery-tile__actions">' +
                    '<div class="gallery-order-btns">' +
                        '<button type="button" class="gallery-icon-btn gallery-move-up" title="Lên trước"><svg viewBox="0 0 24 24"><path d="M12 19V5M5 12l7-7 7 7"/></svg></button>' +
                        '<button type="button" class="gallery-icon-btn gallery-move-down" title="Xuống sau"><svg viewBox="0 0 24 24"><path d="M12 5v14M19 12l-7 7-7-7"/></svg></button>' +
                    '</div>' +
                    '<button type="button" class="gallery-icon-btn gallery-icon-btn--danger gallery-mark-delete" title="Xóa ảnh"><svg viewBox="0 0 24 24"><path d="M6 6l12 12M18 6L6 18"/></svg></button>' +
                '</div>' +
            '</div>' +
            '<div class="gallery-tile__undo"><span>Sẽ xóa khi lưu</span><button type="button" class="gallery-undo">Hoàn tác</button></div>'
        );
    }

    function uploadFile(file) {
        var previewUrl = URL.createObjectURL(file);
        var tile = document.createElement('div');
        tile.className = 'gallery-tile gallery-tile--uploading';
        tile.innerHTML =
            '<div class="gallery-tile__media">' +
                '<img src="' + previewUrl + '" alt="">' +
                '<div class="gallery-tile__spinner"><svg viewBox="0 0 24 24"><path d="M21 12a9 9 0 1 1-9-9"/></svg></div>' +
            '</div>';
        grid.insertBefore(tile, dropzone);

        var formData = new FormData();
        formData.append('image', file);

        uploadsInFlight++;

        return fetch(tempUploadUrl, {
            method: 'POST',
            headers: { 'X-CSRF-TOKEN': csrfToken, Accept: 'application/json' },
            body: formData,
        })
            .then(function (res) {
                if (!res.ok) {
                    return res.json().catch(function () {
                        return {};
                    }).then(function (data) {
                        throw new Error((data && data.message) || 'Tải lên thất bại');
                    });
                }
                return res.json();
            })
            .then(function (data) {
                tile.className = 'gallery-tile';
                tile.setAttribute('data-temp-path', data.temp_path);
                tile.innerHTML = buildTileMarkup(data.url, true);
                renumber();
            })
            .catch(function (err) {
                tile.className = 'gallery-tile gallery-tile--failed';
                tile.innerHTML =
                    '<div class="gallery-tile__media">' +
                        '<img src="' + previewUrl + '" alt="">' +
                        '<div class="gallery-tile__retry"><span>' + (err.message || 'Tải lên thất bại') + '</span>' +
                            '<button type="button" class="gallery-tile__dismiss">Bỏ ảnh này</button>' +
                        '</div>' +
                    '</div>';
                tile.querySelector('.gallery-tile__dismiss').addEventListener('click', function () {
                    tile.remove();
                });
            })
            .then(function () {
                uploadsInFlight--;
            });
    }

    if (dropzone && fileInput) {
        fileInput.addEventListener('change', function (e) {
            var incoming = Array.prototype.slice.call(e.target.files);
            var warnings = [];
            var toUpload = [];

            incoming.forEach(function (file) {
                if (file.size > MAX_FILE_BYTES) {
                    warnings.push('"' + file.name + '" nặng ' + formatMB(file.size) + ', vượt quá 30MB nên đã bỏ qua.');
                    return;
                }
                toUpload.push(file);
            });

            renderWarnings(warnings);
            fileInput.value = '';

            if (!toUpload.length) {
                return;
            }

            var total = toUpload.length;
            var done = 0;

            function uploadNext() {
                if (done >= total) {
                    uploadStatus.classList.remove('is-visible');
                    uploadStatus.textContent = '';
                    return;
                }
                uploadStatus.classList.add('is-visible');
                uploadStatus.textContent = 'Đang tải ảnh ' + (done + 1) + '/' + total + '...';
                uploadFile(toUpload[done]).then(function () {
                    done++;
                    uploadNext();
                });
            }

            uploadNext();
        });
    }

    if (form && stateInput) {
        form.addEventListener('submit', function (e) {
            if (uploadsInFlight > 0) {
                e.preventDefault();
                if (window.AdminToast) {
                    window.AdminToast.show('Đang tải ảnh lên, vui lòng đợi rồi bấm Lưu lại.', 'error');
                }
                return;
            }

            var items = Array.prototype.slice.call(grid.querySelectorAll('.gallery-tile'))
                .filter(function (tile) {
                    return !tile.classList.contains('is-marked-delete') && !tile.classList.contains('gallery-tile--failed');
                })
                .map(function (tile) {
                    if (tile.hasAttribute('data-temp-path')) {
                        return { type: 'new', temp_path: tile.getAttribute('data-temp-path') };
                    }
                    return { type: 'existing', id: parseInt(tile.getAttribute('data-id'), 10) };
                });

            stateInput.value = JSON.stringify(items);
        });
    }

    renumber();
}
