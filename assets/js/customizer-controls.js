/**
 * Royesh Customizer Controls JS v3.0
 * Accordion toggle + Color sync + Range output + Repeater (drag/add/remove)
 */
(function ($) {
    'use strict';

    /* ==============================================================
       1. Accordion Toggle
       ============================================================== */
    $(document).on('click', '.royesh-group__header', function (e) {
        e.preventDefault();
        e.stopPropagation();
        var $header = $(this);
        var $group  = $header.closest('.royesh-group');
        var isOpen  = $group.hasClass('royesh-group--open');

        $group.toggleClass('royesh-group--open', !isOpen);
        $header.attr('aria-expanded', !isOpen ? 'true' : 'false');
    });

    /* ==============================================================
       2. Color Picker ↔ HEX Input Sync
       ============================================================== */
    // Color picker → HEX text
    $(document).on('input change', '.royesh-group__color-picker', function () {
        var val = $(this).val();
        $(this).siblings('.royesh-group__color-hex').val(val.toUpperCase());
    });

    // HEX text → Color picker
    $(document).on('input', '.royesh-group__color-hex', function () {
        var val = $(this).val().trim();
        if (/^#[0-9a-fA-F]{6}$/.test(val)) {
            $(this).siblings('.royesh-group__color-picker').val(val);
            // Trigger change so setting link picks it up
            $(this).siblings('.royesh-group__color-picker').trigger('change');
        }
    });

    /* ==============================================================
       3. Range → Output Sync
       ============================================================== */
    $(document).on('input', '.royesh-group__range', function () {
        $(this).siblings('.royesh-group__range-value').text($(this).val());
    });

    /* ==============================================================
       4. Features Repeater
       ============================================================== */
    function royeshSyncRepeater($control) {
        var items = [];
        $control.find('.royesh-repeater__item').each(function () {
            var $item = $(this);
            items.push({
                text:    $item.find('.royesh-repeater__text').val(),
                enabled: $item.find('.royesh-repeater__enabled').is(':checked'),
            });
        });
        $control.find('.royesh-repeater__value').val(JSON.stringify(items)).trigger('change');
    }

    // افزودن آیتم جدید
    $(document).on('click', '.royesh-repeater__add', function () {
        var $control  = $(this).closest('.royesh-group, .royesh-repeater-wrap');
        var $list     = $control.find('.royesh-repeater__list');
        var newIndex  = $list.find('.royesh-repeater__item').length;
        var $newItem  = $('<div>', {
            'class':      'royesh-repeater__item',
            'data-index': newIndex,
        }).html(
            '<span class="royesh-repeater__drag" title="درگ کنید">⠿</span>' +
            '<input type="checkbox" class="royesh-repeater__enabled" checked title="نمایش/پنهان" />' +
            '<input type="text" class="royesh-repeater__text" placeholder="متن آیتم جدید..." />' +
            '<button type="button" class="royesh-repeater__delete" title="حذف">✕</button>'
        );
        $list.append($newItem);
        $newItem.find('.royesh-repeater__text').focus();
        royeshSyncRepeater($control);
        royeshInitSortable($list);
    });

    // حذف آیتم
    $(document).on('click', '.royesh-repeater__delete', function () {
        var $control = $(this).closest('.royesh-group, .royesh-repeater-wrap');
        $(this).closest('.royesh-repeater__item').remove();
        royeshSyncRepeater($control);
    });

    // تغییر متن یا چک‌باکس
    $(document).on('input change', '.royesh-repeater__text, .royesh-repeater__enabled', function () {
        var $control = $(this).closest('.royesh-group, .royesh-repeater-wrap');
        var $item    = $(this).closest('.royesh-repeater__item');
        $item.toggleClass('is-disabled', !$item.find('.royesh-repeater__enabled').is(':checked'));
        royeshSyncRepeater($control);
    });

    /* ==============================================================
       5. Drag & Drop Sortable
       ============================================================== */
    function royeshInitSortable($list) {
        if (typeof $.fn.sortable === 'undefined') return;
        if ($list.hasClass('ui-sortable')) return;
        $list.sortable({
            handle:  '.royesh-repeater__drag',
            axis:    'y',
            opacity: 0.75,
            update: function () {
                royeshSyncRepeater($(this).closest('.royesh-group, .royesh-repeater-wrap'));
            },
        });
    }

    wp.customize && wp.customize.bind('ready', function () {
        $('.royesh-repeater__list').each(function () {
            royeshInitSortable($(this));
        });
    });

    /* ==============================================================
       6. data-customize-setting-link binding helper
       بعضی input ها از طریق data-customize-setting-link به setting
       وردپرس متصل می‌شوند اما برای اطمینان trigger change می‌فرستیم
       ============================================================== */
    $(document).on('input change', '[data-customize-setting-link]', function () {
        // وردپرس به طور خودکار این attribute را listen می‌کند
        // اما برای color/range که مقدار در پشت پرده تغییر می‌کند:
        var settingKey = $(this).data('customize-setting-link');
        if (settingKey && wp.customize) {
            var setting = wp.customize(settingKey);
            if (setting) {
                var val = $(this).is(':checkbox') ? $(this).is(':checked') : $(this).val();
                setting.set(val);
            }
        }
    });

})(jQuery);


/* ==============================================================
   5. Header Nav Repeater
   ============================================================== */
(function ($) {
    'use strict';

    /**
     * خواندن تمام آیتم‌های یک Repeater و تبدیل به JSON برای ذخیره در setting
     */
    function serializeNavItems($repeater) {
        var items = [];
        $repeater.find('.royesh-nav-item').each(function () {
            var $item = $(this);
            var iconType = $item.find('.royesh-nav-item__icon-type').val() || 'img';
            var iconSrc  = (iconType === 'svg')
                ? $item.find('.royesh-nav-item__icon-svg').val().trim()
                : $item.find('.royesh-nav-item__icon-src').val().trim();

            items.push({
                label:      $item.find('.royesh-nav-item__label-input').val().trim(),
                url:        $item.find('.royesh-nav-item__url-input').val().trim(),
                match_path: $item.find('.royesh-nav-item__match-input').val().trim(),
                enabled:    $item.find('.royesh-nav-item__enabled-val').val() === '1',
                icon_type:  iconType,
                icon_src:   iconSrc,
            });
        });
        return JSON.stringify(items);
    }

    /**
     * به‌روزرسانی مقدار hidden input و trigger کردن customizer
     */
    function saveNavItems($repeater) {
        var json = serializeNavItems($repeater);
        var $hiddenInput = $repeater.find('.royesh-nav-repeater__value');
        $hiddenInput.val(json).trigger('change');
    }

    /**
     * ساخت یک آیتم جدید خالی
     */
    function buildNewNavItem(index) {
        return $(
            '<div class="royesh-nav-item" data-index="' + index + '">' +
                '<div class="royesh-nav-item__header">' +
                    '<span class="royesh-nav-item__drag" title="درگ برای مرتب‌سازی">⠿</span>' +
                    '<span class="royesh-nav-item__preview"><span style="font-size:16px">📄</span></span>' +
                    '<span class="royesh-nav-item__label">آیتم جدید</span>' +
                    '<div class="royesh-nav-item__actions">' +
                        '<button type="button" class="royesh-nav-item__toggle-btn" title="پنهان کردن">👁️</button>' +
                        '<button type="button" class="royesh-nav-item__expand-btn" title="ویرایش">✏️</button>' +
                        '<button type="button" class="royesh-nav-item__delete-btn" title="حذف">✕</button>' +
                    '</div>' +
                '</div>' +
                '<div class="royesh-nav-item__body" style="display:flex">' +
                    '<div class="royesh-nav-item__field"><label>متن آیتم</label>' +
                        '<input type="text" class="royesh-nav-item__input royesh-nav-item__label-input" value="" placeholder="مثلاً: خانه" /></div>' +
                    '<div class="royesh-nav-item__field"><label>لینک (URL)</label>' +
                        '<input type="url" class="royesh-nav-item__input royesh-nav-item__url-input" value="" placeholder="مثلاً: /about" /></div>' +
                    '<div class="royesh-nav-item__field"><label>مسیر تطبیق Active</label>' +
                        '<input type="text" class="royesh-nav-item__input royesh-nav-item__match-input" value="" placeholder="مثلاً: /about" /></div>' +
                    '<div class="royesh-nav-item__field"><label>نوع آیکون</label>' +
                        '<select class="royesh-nav-item__input royesh-nav-item__icon-type">' +
                            '<option value="img">آدرس فایل SVG/PNG</option>' +
                            '<option value="svg">کد SVG مستقیم</option>' +
                        '</select></div>' +
                    '<div class="royesh-nav-item__field royesh-nav-item__icon-img-wrap">' +
                        '<label>آدرس آیکون (URL)</label>' +
                        '<input type="text" class="royesh-nav-item__input royesh-nav-item__icon-src" value="" placeholder="/wp-content/..." /></div>' +
                    '<div class="royesh-nav-item__field royesh-nav-item__icon-svg-wrap" style="display:none">' +
                        '<label>کد SVG مستقیم</label>' +
                        '<textarea class="royesh-nav-item__input royesh-nav-item__icon-svg" rows="3" placeholder="<svg ...></svg>"></textarea></div>' +
                '</div>' +
                '<input type="hidden" class="royesh-nav-item__enabled-val" value="1" />' +
            '</div>'
        );
    }

    /* ── افزودن آیتم ──────────────────────────────── */
    $(document).on('click', '.royesh-nav-repeater__add', function () {
        var $repeater = $(this).closest('.royesh-nav-repeater');
        var $list = $repeater.find('.royesh-nav-repeater__list');
        var idx = $list.find('.royesh-nav-item').length;
        var $newItem = buildNewNavItem(idx);
        $list.append($newItem);
        saveNavItems($repeater);
    });

    /* ── حذف آیتم ────────────────────────────────── */
    $(document).on('click', '.royesh-nav-item__delete-btn', function () {
        if (!confirm('این آیتم حذف شود؟')) return;
        var $repeater = $(this).closest('.royesh-nav-repeater');
        $(this).closest('.royesh-nav-item').remove();
        saveNavItems($repeater);
    });

    /* ── توسعه/جمع بدنه (ویرایش) ──────────────────── */
    $(document).on('click', '.royesh-nav-item__expand-btn', function () {
        var $body = $(this).closest('.royesh-nav-item').find('.royesh-nav-item__body');
        var isVisible = $body.is(':visible');
        $body.toggle(!isVisible);
        $(this).text(isVisible ? '✏️' : '🔼');
    });

    /* ── نمایش/پنهان‌کردن آیتم ──────────────────── */
    $(document).on('click', '.royesh-nav-item__toggle-btn', function () {
        var $item = $(this).closest('.royesh-nav-item');
        var $enabledInput = $item.find('.royesh-nav-item__enabled-val');
        var isEnabled = $enabledInput.val() === '1';
        $enabledInput.val(isEnabled ? '0' : '1');
        $item.toggleClass('royesh-nav-item--disabled', isEnabled);
        $(this).text(isEnabled ? '🙈' : '👁️');
        saveNavItems($item.closest('.royesh-nav-repeater'));
    });

    /* ── تغییر نوع آیکون (img ↔ svg) ─────────────── */
    $(document).on('change', '.royesh-nav-item__icon-type', function () {
        var $item = $(this).closest('.royesh-nav-item');
        var isSvg = $(this).val() === 'svg';
        $item.find('.royesh-nav-item__icon-img-wrap').toggle(!isSvg);
        $item.find('.royesh-nav-item__icon-svg-wrap').toggle(isSvg);
    });

    /* ── ذخیره هر تغییری در فیلدها ─────────────── */
    $(document).on('input change', '.royesh-nav-item__input', function () {
        var $repeater = $(this).closest('.royesh-nav-repeater');
        // آپدیت نمایش label در هدر کارت
        var $item = $(this).closest('.royesh-nav-item');
        if ($(this).hasClass('royesh-nav-item__label-input')) {
            $item.find('.royesh-nav-item__label').text($(this).val() || 'آیتم بدون نام');
        }
        saveNavItems($repeater);
    });

    /* ── Drag & Drop (sortable با jquery-ui) ──────── */
    $(document).ready(function () {
        // اگر jQuery UI Sortable موجود باشد
        if ($.fn.sortable) {
            $(document).on('click', '.royesh-nav-repeater', function () {
                // فعال‌سازی lazy برای اجتناب از conflict
            });
            function initSortable($list) {
                if ($list.data('sortable-init')) return;
                $list.data('sortable-init', true);
                $list.sortable({
                    handle: '.royesh-nav-item__drag',
                    placeholder: 'royesh-nav-item sortable-placeholder',
                    tolerance: 'pointer',
                    stop: function () {
                        saveNavItems($list.closest('.royesh-nav-repeater'));
                    }
                });
            }
            // فعال‌سازی هنگام باز شدن section
            wp.customize.bind('ready', function () {
                wp.customize.section.each(function (section) {
                    section.expanded.bind(function (expanded) {
                        if (expanded) {
                            setTimeout(function () {
                                $('.royesh-nav-repeater__list').each(function () {
                                    initSortable($(this));
                                });
                            }, 300);
                        }
                    });
                });
            });
        }
    });

})(jQuery);
