document.addEventListener('DOMContentLoaded', function () {
    initActivityGalleryManager();
});

function initActivityGalleryManager() {
    var grid = document.getElementById('galleryGrid');
    if (!grid) {
        return;
    }

    // Kept in sync with Admin\ActivityController::uploadTempMedia()'s rules.
    // Client-side checks here are UX only (fail fast, no wasted upload) -
    // the server re-validates size, extension and real content regardless.
    var MAX_IMAGE_BYTES = 30 * 1024 * 1024;
    var MAX_VIDEO_BYTES = 500 * 1024 * 1024;
    var VIDEO_EXTENSIONS = ['mp4', 'mov', 'webm', 'm4v'];

    function isVideoFile(file) {
        if (file.type && file.type.indexOf('video/') === 0) {
            return true;
        }
        var ext = (file.name.split('.').pop() || '').toLowerCase();
        return VIDEO_EXTENSIONS.indexOf(ext) !== -1;
    }

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

    function buildTileMarkup(mediaSrc, isNew, isVideo) {
        var media = isVideo
            ? '<video src="' + mediaSrc + '" muted playsinline preload="metadata"></video>'
            : '<img src="' + mediaSrc + '" alt="">';

        return (
            '<div class="gallery-tile__media">' +
                media +
                (isVideo ? '<span class="gallery-tile__badge gallery-tile__badge--video">Video</span>' : '') +
                '<span class="gallery-tile__order"></span>' +
                (isNew ? '<span class="gallery-tile__new">Mới</span>' : '') +
                '<div class="gallery-tile__actions">' +
                    '<div class="gallery-order-btns">' +
                        '<button type="button" class="gallery-icon-btn gallery-move-up" title="Lên trước"><svg viewBox="0 0 24 24"><path d="M12 19V5M5 12l7-7 7 7"/></svg></button>' +
                        '<button type="button" class="gallery-icon-btn gallery-move-down" title="Xuống sau"><svg viewBox="0 0 24 24"><path d="M12 5v14M19 12l-7 7-7-7"/></svg></button>' +
                    '</div>' +
                    '<button type="button" class="gallery-icon-btn gallery-icon-btn--danger gallery-mark-delete" title="Xóa"><svg viewBox="0 0 24 24"><path d="M6 6l12 12M18 6L6 18"/></svg></button>' +
                '</div>' +
            '</div>' +
            '<div class="gallery-tile__undo"><span>Sẽ xóa khi lưu</span><button type="button" class="gallery-undo">Hoàn tác</button></div>'
        );
    }

    // XMLHttpRequest (not fetch) specifically so a large video reports real
    // upload progress - without it a 300MB+ upload just sits there for
    // minutes with no feedback, which reads as "frozen" and invites the
    // admin to reload the page mid-upload.
    function uploadFile(file) {
        var isVideo = isVideoFile(file);
        var previewUrl = URL.createObjectURL(file);
        var tile = document.createElement('div');
        tile.className = 'gallery-tile gallery-tile--uploading';
        var mediaEl = isVideo
            ? '<video src="' + previewUrl + '" muted playsinline preload="metadata"></video>'
            : '<img src="' + previewUrl + '" alt="">';
        tile.innerHTML =
            '<div class="gallery-tile__media">' +
                mediaEl +
                '<div class="gallery-tile__spinner"><svg viewBox="0 0 24 24"><path d="M21 12a9 9 0 1 1-9-9"/></svg></div>' +
                '<div class="gallery-tile__progress"><div class="gallery-tile__progress-bar"></div></div>' +
            '</div>';
        grid.insertBefore(tile, dropzone);

        var progressBar = tile.querySelector('.gallery-tile__progress-bar');

        var formData = new FormData();
        formData.append('file', file);

        uploadsInFlight++;

        return new Promise(function (resolve) {
            var xhr = new XMLHttpRequest();
            xhr.open('POST', tempUploadUrl, true);
            xhr.setRequestHeader('X-CSRF-TOKEN', csrfToken);
            xhr.setRequestHeader('Accept', 'application/json');

            xhr.upload.addEventListener('progress', function (e) {
                if (e.lengthComputable && progressBar) {
                    progressBar.style.transform = 'scaleX(' + (e.loaded / e.total) + ')';
                }
            });

            xhr.onload = function () {
                var data = {};
                try {
                    data = JSON.parse(xhr.responseText);
                } catch (err) {
                    data = {};
                }

                if (xhr.status >= 200 && xhr.status < 300) {
                    tile.className = 'gallery-tile';
                    tile.setAttribute('data-temp-path', data.temp_path);
                    tile.innerHTML = buildTileMarkup(data.url, true, data.type === 'video');
                    renumber();
                } else {
                    tile.className = 'gallery-tile gallery-tile--failed';
                    tile.innerHTML =
                        '<div class="gallery-tile__media">' +
                            mediaEl +
                            '<div class="gallery-tile__retry"><span>' + (data.message || 'Tải lên thất bại') + '</span>' +
                                '<button type="button" class="gallery-tile__dismiss">Bỏ mục này</button>' +
                            '</div>' +
                        '</div>';
                    tile.querySelector('.gallery-tile__dismiss').addEventListener('click', function () {
                        tile.remove();
                    });
                }

                uploadsInFlight--;
                resolve();
            };

            xhr.onerror = function () {
                tile.className = 'gallery-tile gallery-tile--failed';
                tile.innerHTML =
                    '<div class="gallery-tile__media">' +
                        mediaEl +
                        '<div class="gallery-tile__retry"><span>Mất kết nối khi tải lên.</span>' +
                            '<button type="button" class="gallery-tile__dismiss">Bỏ mục này</button>' +
                        '</div>' +
                    '</div>';
                tile.querySelector('.gallery-tile__dismiss').addEventListener('click', function () {
                    tile.remove();
                });
                uploadsInFlight--;
                resolve();
            };

            xhr.send(formData);
        });
    }

    if (dropzone && fileInput) {
        fileInput.addEventListener('change', function (e) {
            var incoming = Array.prototype.slice.call(e.target.files);
            var warnings = [];
            var toUpload = [];

            incoming.forEach(function (file) {
                var isVideo = isVideoFile(file);
                var cap = isVideo ? MAX_VIDEO_BYTES : MAX_IMAGE_BYTES;
                if (file.size > cap) {
                    warnings.push('"' + file.name + '" nặng ' + formatMB(file.size) + ', vượt quá ' + formatMB(cap) + ' nên đã bỏ qua.');
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
                uploadStatus.textContent = 'Đang tải ' + (done + 1) + '/' + total + '...';
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
                    window.AdminToast.show('Đang tải lên, vui lòng đợi rồi bấm Lưu lại.', 'error');
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
