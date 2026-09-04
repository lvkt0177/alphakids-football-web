window.addEventListener('load', function () {
    initHeroCrop();
});

function initHeroCrop() {
    var tools = document.getElementById('heroCropTools');
    var sourceInput = document.getElementById('heroCropSourceInput');
    var mobileSourceInput = document.getElementById('heroCropMobileSourceInput');
    var mobileSourceNote = document.getElementById('heroCropMobileSourceNote');
    var form = document.getElementById('imagesForm');

    if (!tools || !sourceInput || !form || typeof Cropper === 'undefined') {
        return;
    }

    var imgDesktop = document.getElementById('heroCropImgDesktop');
    var imgMobile = document.getElementById('heroCropImgMobile');

    // Mobile crops its own uploaded photo once Admin provides one; until
    // then it crops the same photo as desktop (see hero-crop-card in the
    // blade). Whichever is true right now decides what a NEW desktop photo
    // should do to mobile's preview: replace it too (still following
    // along) or leave mobile alone (it has its own photo already).
    var mobileHasOwnSource = tools.dataset.mobileHasOwnSource === '1';

    var hidden = {
        desktop: {
            x: document.getElementById('cropDesktopX'),
            y: document.getElementById('cropDesktopY'),
            width: document.getElementById('cropDesktopW'),
            height: document.getElementById('cropDesktopH')
        },
        mobile: {
            x: document.getElementById('cropMobileX'),
            y: document.getElementById('cropMobileY'),
            width: document.getElementById('cropMobileW'),
            height: document.getElementById('cropMobileH')
        }
    };

    var initial = {
        desktop: readInitialCrop('heroCropDesktopInitial'),
        mobile: readInitialCrop('heroCropMobileInitial')
    };

    function readInitialCrop(id) {
        var el = document.getElementById(id);
        if (!el || !el.value) {
            return null;
        }
        try {
            var data = JSON.parse(el.value);
            if (data && data.width && data.height) {
                // The server stores these as PHP request values, which are
                // always strings - json_encode() keeps them as JSON strings
                // ("x":"0"), not numbers ("x":0). Cropper.js's `data` option
                // silently misbehaves when given numeric strings instead of
                // real numbers (it lands the crop box at a wrong, uniformly
                // scaled-down position, no error) - confirmed directly in a
                // real browser. Coerce every field to a number before it
                // ever reaches Cropper.
                return {
                    x: parseFloat(data.x),
                    y: parseFloat(data.y),
                    width: parseFloat(data.width),
                    height: parseFloat(data.height)
                };
            }
        } catch (e) {
            // ignore malformed stored crop, fall back to autoCropArea
        }
        return null;
    }

    // Cropper.js attaches itself to the source element as `img.cropper`
    // synchronously, at the very start of construction, before "ready" can
    // fire. Restoring a previous crop goes through the `data` constructor
    // option (the library-documented way to seed a starting crop box).
    //
    // Measured directly in a real browser: building the desktop and mobile
    // instances back-to-back in the same synchronous tick made `data` land
    // wrong (a uniformly scaled-down box, unrelated to either instance's own
    // aspect ratio). Building them strictly one after another - mobile only
    // starting inside desktop's own `ready` callback, never in the same
    // tick - restores both correctly, every time. Do not "fix" this by
    // destroying and rebuilding an instance from inside its own `ready`
    // callback either - that reproduces the same corruption; the fix is
    // giving each instance's build its own turn, not retrying it.
    function setupCropper(img, aspectRatio, restoreData, onReady) {
        if (img.cropper) {
            img.cropper.destroy();
        }

        var options = {
            aspectRatio: aspectRatio,
            viewMode: 1,
            movable: true,
            zoomable: true,
            scalable: false,
            rotatable: false,
            guides: true
        };

        if (restoreData) {
            options.data = restoreData;
        } else {
            options.autoCropArea = 1;
        }

        if (onReady) {
            options.ready = onReady;
        }

        // eslint-disable-next-line no-new
        new Cropper(img, options);
    }

    function rebuildMobile(restoreData) {
        if (imgMobile && imgMobile.getAttribute('src')) {
            setupCropper(imgMobile, 4 / 5, restoreData);
        }
    }

    function rebuildDesktop(restoreData) {
        if (imgDesktop && imgDesktop.getAttribute('src')) {
            setupCropper(imgDesktop, 21 / 9, restoreData);
        }
    }

    function initFromCurrentImages(restore) {
        var hasDesktop = imgDesktop && imgDesktop.getAttribute('src');

        function buildMobile() {
            rebuildMobile(restore ? initial.mobile : null);
        }

        if (hasDesktop) {
            setupCropper(imgDesktop, 21 / 9, restore ? initial.desktop : null, buildMobile);
        } else {
            buildMobile();
        }
    }

    // The "Hình ảnh" tab remembers the last tab the admin had open
    // (localStorage, see setting.js) and may not be the active one on load -
    // its panel is `display:none` until then. Cropper.js measures the
    // container to build its canvas, so initializing while hidden yields a
    // zero-size crop box that looks reset no matter what was saved. Only
    // build the croppers once the panel is actually visible.
    var imagesPanel = document.getElementById('tab-images');
    var imagesTabBtn = document.querySelector('.tab-btn[data-tab="images"]');
    var croppersBuilt = false;

    function isPanelVisible() {
        return !imagesPanel || imagesPanel.offsetParent !== null;
    }

    function buildCroppersOnceVisible() {
        if (croppersBuilt || !isPanelVisible()) {
            return;
        }
        croppersBuilt = true;
        initFromCurrentImages(true);
    }

    buildCroppersOnceVisible();

    if (imagesTabBtn) {
        imagesTabBtn.addEventListener('click', function () {
            // Tab switch happens synchronously in setting.js's own click
            // handler registered before this script; by the time this
            // listener runs the panel is already visible.
            buildCroppersOnceVisible();
        });
    }

    sourceInput.addEventListener('change', function () {
        var file = sourceInput.files && sourceInput.files[0];
        if (!file) {
            return;
        }

        var reader = new FileReader();
        reader.onload = function (e) {
            tools.style.display = '';
            imgDesktop.setAttribute('src', e.target.result);
            // New photo: previous crop coordinates no longer apply, start fresh.
            initial.desktop = null;

            if (mobileHasOwnSource) {
                // Mobile has its own photo - a new desktop photo doesn't touch it.
                rebuildDesktop(null);
            } else {
                // Mobile was following the desktop photo - keep it following.
                imgMobile.setAttribute('src', e.target.result);
                initial.mobile = null;
                setupCropper(imgDesktop, 21 / 9, null, function () {
                    rebuildMobile(null);
                });
            }
        };
        reader.readAsDataURL(file);
    });

    if (mobileSourceInput) {
        mobileSourceInput.addEventListener('change', function () {
            var file = mobileSourceInput.files && mobileSourceInput.files[0];
            if (!file) {
                return;
            }

            var reader = new FileReader();
            reader.onload = function (e) {
                imgMobile.setAttribute('src', e.target.result);
                initial.mobile = null;
                mobileHasOwnSource = true;
                if (mobileSourceNote) {
                    mobileSourceNote.textContent = 'Đang dùng ảnh riêng cho Mobile.';
                }
                rebuildMobile(null);
            };
            reader.readAsDataURL(file);
        });
    }

    form.addEventListener('submit', function () {
        [
            { img: imgDesktop, fields: hidden.desktop },
            { img: imgMobile, fields: hidden.mobile }
        ].forEach(function (entry) {
            var cropper = entry.img && entry.img.cropper;
            var fields = entry.fields;

            if (!cropper) {
                Object.keys(fields).forEach(function (k) {
                    if (fields[k]) {
                        fields[k].disabled = true;
                    }
                });
                return;
            }

            var data = cropper.getData();
            fields.x.value = Math.round(data.x);
            fields.y.value = Math.round(data.y);
            fields.width.value = Math.round(data.width);
            fields.height.value = Math.round(data.height);
            Object.keys(fields).forEach(function (k) {
                fields[k].disabled = false;
            });
        });
    });
}
