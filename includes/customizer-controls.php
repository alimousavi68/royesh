<?php
/**
 * Royesh Customizer — Custom Control Classes
 *
 * @package Royesh
 * @version 3.0.0
 */

if (!defined('ABSPATH')) {
    exit;
}


/* ==========================================================================
   Royesh_Group_Control
   
   یک کنترل ترکیبی که یک گروه از تنظیمات مرتبط را داخل یک آکاردئون رندر می‌کند.
   هر field از طریق data-customize-setting-link به setting خودش bind می‌شود.
   ========================================================================== */
class Royesh_Group_Control extends WP_Customize_Control {

    public $type        = 'royesh_group';
    public $group_icon  = '⚙️';  // ایموجی یا متن کوتاه
    public $open        = false; // آیا آکاردئون پیش‌فرض باز باشد؟
    public $fields      = [];    // آرایه تعریف‌های field
    public $capability  = 'edit_theme_options';
    public $settings    = [];

    public function __construct($manager, $id, $args = []) {
        $this->capability = 'edit_theme_options';
        $this->settings   = [];
        parent::__construct($manager, $id, $args);
        $this->capability = 'edit_theme_options';
        $this->settings   = [];
    }

    /**
     * تعریف یک field:
     * [
     *   'setting'     => 'royesh_hero_title_main',  // کلید setting ثبت‌شده در customizer.php
     *   'label'       => 'بخش اول عنوان',
     *   'type'        => 'text' | 'textarea' | 'color' | 'checkbox' | 'range' | 'select' | 'url' | 'email' | 'number',
     *   'default'     => '',                         // مقدار پیش‌فرض برای نمایش اولیه (اختیاری)
     *   'description' => '',                         // توضیح زیر فیلد (اختیاری)
     *   'options'     => [],                         // فقط برای نوع select
     *   'min'         => '',  'max' => '', 'step' => '',  // فقط برای range و number
     * ]
     */
    public function render_content() {
        $open_class = $this->open ? 'royesh-group--open' : '';
        ?>
        <div class="royesh-group <?php echo esc_attr($open_class); ?>">

            <button type="button" class="royesh-group__header" aria-expanded="<?php echo $this->open ? 'true' : 'false'; ?>">
                <span class="royesh-group__icon"><?php echo esc_html($this->group_icon); ?></span>
                <span class="royesh-group__title"><?php echo esc_html($this->label); ?></span>
                <span class="royesh-group__chevron">
                    <svg width="12" height="12" viewBox="0 0 12 12" fill="none">
                        <path d="M2 4L6 8L10 4" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"/>
                    </svg>
                </span>
            </button>

            <div class="royesh-group__body">
                <?php
                foreach ($this->fields as $field) {
                    $setting_key = $field['setting'] ?? '';
                    $label       = $field['label']   ?? '';
                    $type        = $field['type']     ?? 'text';
                    $desc        = $field['description'] ?? '';
                    $default_val = $field['default'] ?? '';
                    $options     = $field['options']  ?? [];

                    // مقدار فعلی از theme_mod
                    $current = get_theme_mod($setting_key, $default_val);
                    ?>
                    <div class="royesh-group__field royesh-group__field--<?php echo esc_attr($type); ?>">
                        <?php if ($type !== 'checkbox') : ?>
                            <label class="royesh-group__field-label" for="royesh-field-<?php echo esc_attr($setting_key); ?>">
                                <?php echo esc_html($label); ?>
                            </label>
                        <?php endif; ?>

                        <?php if ($type === 'text' || $type === 'url' || $type === 'email') : ?>
                            <input
                                type="<?php echo esc_attr($type); ?>"
                                id="royesh-field-<?php echo esc_attr($setting_key); ?>"
                                class="royesh-group__input"
                                value="<?php echo esc_attr($current); ?>"
                                data-customize-setting-link="<?php echo esc_attr($setting_key); ?>"
                            />

                        <?php elseif ($type === 'textarea') : ?>
                            <textarea
                                id="royesh-field-<?php echo esc_attr($setting_key); ?>"
                                class="royesh-group__input royesh-group__input--textarea"
                                rows="3"
                                data-customize-setting-link="<?php echo esc_attr($setting_key); ?>"><?php echo esc_textarea($current); ?></textarea>

                        <?php elseif ($type === 'color') : ?>
                            <div class="royesh-group__color-wrap">
                                <input
                                    type="color"
                                    id="royesh-field-<?php echo esc_attr($setting_key); ?>"
                                    class="royesh-group__color-picker"
                                    value="<?php echo esc_attr($current); ?>"
                                    data-customize-setting-link="<?php echo esc_attr($setting_key); ?>"
                                />
                                <input
                                    type="text"
                                    class="royesh-group__color-hex"
                                    value="<?php echo esc_attr($current); ?>"
                                    maxlength="7"
                                    aria-label="کد رنگ HEX"
                                />
                            </div>

                        <?php elseif ($type === 'checkbox') : ?>
                            <label class="royesh-group__toggle-label">
                                <input
                                    type="checkbox"
                                    id="royesh-field-<?php echo esc_attr($setting_key); ?>"
                                    class="royesh-group__toggle"
                                    <?php checked((bool) $current); ?>
                                    data-customize-setting-link="<?php echo esc_attr($setting_key); ?>"
                                />
                                <span class="royesh-group__toggle-track">
                                    <span class="royesh-group__toggle-thumb"></span>
                                </span>
                                <span class="royesh-group__toggle-text"><?php echo esc_html($label); ?></span>
                            </label>

                        <?php elseif ($type === 'range') : ?>
                            <div class="royesh-group__range-wrap">
                                <input
                                    type="range"
                                    id="royesh-field-<?php echo esc_attr($setting_key); ?>"
                                    class="royesh-group__range"
                                    value="<?php echo esc_attr($current); ?>"
                                    min="<?php echo esc_attr($field['min'] ?? 0); ?>"
                                    max="<?php echo esc_attr($field['max'] ?? 100); ?>"
                                    step="<?php echo esc_attr($field['step'] ?? 1); ?>"
                                    data-customize-setting-link="<?php echo esc_attr($setting_key); ?>"
                                />
                                <output class="royesh-group__range-value"><?php echo esc_html($current); ?></output>
                                <?php if (!empty($field['unit'])) : ?>
                                    <span class="royesh-group__range-unit"><?php echo esc_html($field['unit']); ?></span>
                                <?php endif; ?>
                            </div>

                        <?php elseif ($type === 'select') : ?>
                            <select
                                id="royesh-field-<?php echo esc_attr($setting_key); ?>"
                                class="royesh-group__input"
                                data-customize-setting-link="<?php echo esc_attr($setting_key); ?>"
                            >
                                <?php foreach ($options as $val => $opt_label) : ?>
                                    <option value="<?php echo esc_attr($val); ?>" <?php selected($current, $val); ?>>
                                        <?php echo esc_html($opt_label); ?>
                                    </option>
                                <?php endforeach; ?>
                            </select>

                        <?php elseif ($type === 'number') : ?>
                            <input
                                type="number"
                                id="royesh-field-<?php echo esc_attr($setting_key); ?>"
                                class="royesh-group__input royesh-group__input--number"
                                value="<?php echo esc_attr($current); ?>"
                                min="<?php echo esc_attr($field['min'] ?? ''); ?>"
                                max="<?php echo esc_attr($field['max'] ?? ''); ?>"
                                step="<?php echo esc_attr($field['step'] ?? 1); ?>"
                                data-customize-setting-link="<?php echo esc_attr($setting_key); ?>"
                            />

                        <?php endif; ?>

                        <?php if (!empty($desc)) : ?>
                            <p class="royesh-group__field-desc"><?php echo esc_html($desc); ?></p>
                        <?php endif; ?>
                    </div>
                    <?php
                }
                ?>
            </div>
        </div>
        <?php
    }
}


/* ==========================================================================
   Royesh_Header_Nav_Repeater_Control
   کنترل Repeater پیشرفته برای مدیریت آیتم‌های منوی هدر
   هر آیتم: label, url, enabled, icon_type (img|svg), icon_src, match_path
   ========================================================================== */
class Royesh_Header_Nav_Repeater_Control extends WP_Customize_Control {
    public $type = 'royesh_header_nav_repeater';

    public function render_content() {
        $value = $this->value();
        $items = json_decode($value, true);
        if (empty($items) || !is_array($items)) {
            $items = [];
        }
        $uid = 'royesh-nav-repeater-' . $this->id;
        ?>
        <div class="royesh-nav-repeater" id="<?php echo esc_attr($uid); ?>">

            <!-- Header -->
            <div class="royesh-group royesh-group--open">
                <button type="button" class="royesh-group__header" aria-expanded="true">
                    <span class="royesh-group__icon">🧭</span>
                    <span class="royesh-group__title"><?php echo esc_html($this->label); ?></span>
                    <span class="royesh-group__chevron">
                        <svg width="12" height="12" viewBox="0 0 12 12" fill="none">
                            <path d="M2 4L6 8L10 4" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"/>
                        </svg>
                    </span>
                </button>
                <div class="royesh-group__body">
                    <?php if (!empty($this->description)) : ?>
                        <p class="royesh-group__field-desc" style="margin-top:0;margin-bottom:12px"><?php echo esc_html($this->description); ?></p>
                    <?php endif; ?>

                    <!-- لیست آیتم‌ها -->
                    <div class="royesh-nav-repeater__list" id="<?php echo esc_attr($uid); ?>-list">
                        <?php foreach ($items as $index => $item) :
                            $label      = $item['label']      ?? '';
                            $url        = $item['url']        ?? '';
                            $enabled    = isset($item['enabled']) ? (bool)$item['enabled'] : true;
                            $icon_type  = $item['icon_type']  ?? 'img'; // img | svg
                            $icon_src   = $item['icon_src']   ?? '';
                            $match_path = $item['match_path'] ?? $url;
                            $has_svg_code = ($icon_type === 'svg');
                        ?>
                        <div class="royesh-nav-item<?php echo $enabled ? '' : ' royesh-nav-item--disabled'; ?>" data-index="<?php echo $index; ?>">
                            <div class="royesh-nav-item__header">
                                <span class="royesh-nav-item__drag" title="برای مرتب‌سازی درگ کنید">⠿</span>
                                <span class="royesh-nav-item__preview">
                                    <?php if ($icon_type === 'svg' && !empty($icon_src)) : ?>
                                        <?php echo $icon_src; // raw SVG ?>
                                    <?php elseif (!empty($icon_src)) : ?>
                                        <img src="<?php echo esc_url($icon_src); ?>" style="width:18px;height:18px;vertical-align:middle" />
                                    <?php else : ?>
                                        <span style="font-size:16px">📄</span>
                                    <?php endif; ?>
                                </span>
                                <span class="royesh-nav-item__label"><?php echo esc_html($label ?: 'آیتم بدون نام'); ?></span>
                                <div class="royesh-nav-item__actions">
                                    <button type="button" class="royesh-nav-item__toggle-btn" title="<?php echo $enabled ? 'پنهان کردن' : 'نمایش'; ?>">
                                        <?php echo $enabled ? '👁️' : '🙈'; ?>
                                    </button>
                                    <button type="button" class="royesh-nav-item__expand-btn" title="ویرایش">✏️</button>
                                    <button type="button" class="royesh-nav-item__delete-btn" title="حذف">✕</button>
                                </div>
                            </div>
                            <div class="royesh-nav-item__body" style="display:none">
                                <div class="royesh-nav-item__field">
                                    <label>متن آیتم</label>
                                    <input type="text" class="royesh-nav-item__input royesh-nav-item__label-input" value="<?php echo esc_attr($label); ?>" placeholder="مثلاً: خانه" />
                                </div>
                                <div class="royesh-nav-item__field">
                                    <label>لینک (URL)</label>
                                    <input type="url" class="royesh-nav-item__input royesh-nav-item__url-input" value="<?php echo esc_attr($url); ?>" placeholder="مثلاً: /about" />
                                </div>
                                <div class="royesh-nav-item__field">
                                    <label>مسیر تطبیق Active (مثلاً: /about)</label>
                                    <input type="text" class="royesh-nav-item__input royesh-nav-item__match-input" value="<?php echo esc_attr($match_path); ?>" placeholder="مثلاً: /about" />
                                </div>
                                <div class="royesh-nav-item__field">
                                    <label>نوع آیکون</label>
                                    <select class="royesh-nav-item__input royesh-nav-item__icon-type">
                                        <option value="img" <?php selected($icon_type, 'img'); ?>>آدرس فایل SVG/PNG</option>
                                        <option value="svg" <?php selected($icon_type, 'svg'); ?>>کد SVG مستقیم</option>
                                    </select>
                                </div>
                                <div class="royesh-nav-item__field royesh-nav-item__icon-img-wrap"<?php echo $has_svg_code ? ' style="display:none"' : ''; ?>>
                                    <label>آدرس آیکون (URL)</label>
                                    <input type="text" class="royesh-nav-item__input royesh-nav-item__icon-src" value="<?php echo esc_attr($has_svg_code ? '' : $icon_src); ?>" placeholder="مثلاً: https://... یا /wp-content/..." />
                                </div>
                                <div class="royesh-nav-item__field royesh-nav-item__icon-svg-wrap"<?php echo !$has_svg_code ? ' style="display:none"' : ''; ?>>
                                    <label>کد SVG مستقیم</label>
                                    <textarea class="royesh-nav-item__input royesh-nav-item__icon-svg" rows="3" placeholder="<svg ...>...</svg>"><?php echo esc_textarea($has_svg_code ? $icon_src : ''); ?></textarea>
                                </div>
                            </div>
                            <!-- فیلدهای hidden برای ذخیره state -->
                            <input type="hidden" class="royesh-nav-item__enabled-val" value="<?php echo $enabled ? '1' : '0'; ?>" />
                        </div>
                        <?php endforeach; ?>
                    </div>

                    <!-- دکمه افزودن آیتم -->
                    <button type="button" class="royesh-repeater__add royesh-nav-repeater__add">
                        <svg width="12" height="12" viewBox="0 0 12 12" fill="none"><path d="M6 1v10M1 6h10" stroke="currentColor" stroke-width="2" stroke-linecap="round"/></svg>
                        افزودن آیتم جدید
                    </button>

                    <!-- hidden input که لینک به setting دارد -->
                    <input type="hidden" class="royesh-nav-repeater__value" <?php $this->link(); ?> value="<?php echo esc_attr($value); ?>" />
                </div>
            </div>
        </div>
        <?php
    }
}



class Royesh_Features_Repeater_Control extends WP_Customize_Control {
    public $type = 'royesh_features_repeater';

    public function render_content() {
        $value = $this->value();
        $items = json_decode($value, true);
        if (empty($items) || !is_array($items)) {
            $items = [
                ['text' => 'راهکارهای نوین مالی و دیجیتال', 'enabled' => true],
                ['text' => 'توسعه کسب‌وکار و نهادسازی',    'enabled' => true],
                ['text' => 'طراحی ساختار و استراتژی',        'enabled' => true],
                ['text' => 'تأمین مالی و خدمات اعتباری',     'enabled' => true],
                ['text' => 'مشاوره و مدیریت مالی',          'enabled' => true],
            ];
        }
        ?>
        <div class="royesh-group royesh-group--open">
            <button type="button" class="royesh-group__header" aria-expanded="true">
                <span class="royesh-group__icon">📋</span>
                <span class="royesh-group__title"><?php echo esc_html($this->label); ?></span>
                <span class="royesh-group__chevron">
                    <svg width="12" height="12" viewBox="0 0 12 12" fill="none">
                        <path d="M2 4L6 8L10 4" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"/>
                    </svg>
                </span>
            </button>
            <div class="royesh-group__body">
                <?php if (!empty($this->description)) : ?>
                    <p class="royesh-group__field-desc" style="margin-top:0"><?php echo esc_html($this->description); ?></p>
                <?php endif; ?>

                <div class="royesh-repeater__list" id="royesh-features-list">
                    <?php foreach ($items as $index => $item) : ?>
                        <div class="royesh-repeater__item" data-index="<?php echo $index; ?>">
                            <span class="royesh-repeater__drag" title="درگ کنید برای ترتیب">⠿</span>
                            <input type="checkbox" class="royesh-repeater__enabled" <?php checked(!empty($item['enabled'])); ?> title="نمایش/پنهان" />
                            <input type="text" class="royesh-repeater__text" value="<?php echo esc_attr($item['text']); ?>" placeholder="متن آیتم..." />
                            <button type="button" class="royesh-repeater__delete" title="حذف">✕</button>
                        </div>
                    <?php endforeach; ?>
                </div>

                <button type="button" class="royesh-repeater__add">
                    <svg width="12" height="12" viewBox="0 0 12 12" fill="none"><path d="M6 1v10M1 6h10" stroke="currentColor" stroke-width="2" stroke-linecap="round"/></svg>
                    افزودن آیتم جدید
                </button>

                <input type="hidden" class="royesh-repeater__value" <?php $this->link(); ?> value="<?php echo esc_attr($value); ?>" />
            </div>
        </div>
        <?php
    }
}



/* ==========================================================================
   Enqueue Assets در پنل Customizer
   ========================================================================== */
function royesh_customizer_controls_enqueue() {
    wp_enqueue_style(
        'royesh-customizer-controls',
        ROYESH_THEME_URI . '/assets/css/customizer-controls.css',
        [],
        ROYESH_THEME_VERSION
    );
    wp_enqueue_script(
        'royesh-customizer-controls',
        ROYESH_THEME_URI . '/assets/js/customizer-controls.js',
        ['jquery', 'customize-controls'],
        ROYESH_THEME_VERSION,
        true
    );
}
add_action('customize_controls_enqueue_scripts', 'royesh_customizer_controls_enqueue');
