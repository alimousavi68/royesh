<?php
/**
 * Advanced Page Meta Box & Customization Fields
 * 
 * Provides native, sleek, and template-aware customization for Page Header/Hero
 * and dedicated template settings with inherited WordPress admin fonts and clean UI.
 * 
 * @package Royesh
 * @version 1.5.0
 */

if (!defined('ABSPATH')) {
    exit; // Exit if accessed directly
}

/**
 * نقشه اطلاعات پیش‌فرض اولیه برای هر قالب جهت ذخیره در دیتابیس
 */
function royesh_get_template_defaults($template_file = '') {
    $common_hero = [
        '_royesh_hero_enable'   => '1',
        '_royesh_hero_bg_color' => '#004F40',
    ];

    $defaults_by_template = [
        'page-about.php' => array_merge($common_hero, [
            '_royesh_hero_badge'    => 'همراه رشد شما',
            '_royesh_hero_title'    => 'درباره گروه اقتصادی رویش',
            '_royesh_hero_desc'     => 'تعهد ما، هدایت هوشمندانه سرمایه برای خلق ارزش پایدار و توانمندسازی سازمان‌های پیشرو است.',
            '_royesh_about_p1'      => 'موسسه رشد و نوآوری رویش با تکیه بر هم‌افزایی دانش تخصصی و تجربه مدیران ارشد خود، بستری پویا برای توانمندسازی اقتصادی فعالان و نهادهای کسب‌وکار ایجاد کرده است. فلسفه وجودی ما بر پایه سه اصل استوار است: نگاه مسئله‌محور، همراستاسازی منافع و چشم‌انداز آینده‌نگر.',
            '_royesh_about_p2'      => 'هدف ما ایجاد پلی ایمن میان بازارهای سرمایه و نیازهای حقیقی بنگاه‌های اقتصادی است. ما در این مسیر متعهد به شفافیت، پویایی و خروجی‌های ملموس مالی هستیم.',
            '_royesh_about_sticky'  => 'پشتیبانی مستمر | رویش سرمایه',
            '_royesh_val_title'     => 'ارزش‌هایی که مسیر حرکت ما را روشن می‌کنند',
            '_royesh_val_1_title'   => 'نگاه مسئله‌محور',
            '_royesh_val_1_desc'    => 'تمرکز کامل بر شناسایی دقیق چالش‌ها و ارائه راهکارهای علمی و ساختاری متناسب با آن‌ها.',
            '_royesh_val_2_title'   => 'همراستاسازی منافع',
            '_royesh_val_2_desc'    => 'خلق مدل‌های اقتصادی پایدار به‌گونه‌ای که منافع تمامی همکاران، سرمایه‌گذاران و ذینفعان تأمین شود.',
            '_royesh_val_3_title'   => 'آینده‌نگری مالی',
            '_royesh_val_3_desc'    => 'استفاده از ابزارهای تکنولوژی و مدل‌سازی نوین برای تضمین رشد و پاسخگویی به چالش‌های اقتصادی آینده.',
            '_royesh_tl_title'      => 'گاه‌شمار توسعه رویش',
            '_royesh_tl_1_year'     => '۱۳۹۸',
            '_royesh_tl_1_title'    => 'تأسیس و شروع مأموریت',
            '_royesh_tl_1_desc'     => 'راه‌اندازی هسته اولیه رشد رویش با تمرکز بر مشاوره سرمایه‌گذاری خطرپذیر و شتابدهی استارتاپ‌ها.',
            '_royesh_tl_2_year'     => '۱۴۰۱',
            '_royesh_tl_2_title'    => 'توسعه خدمات اعتباری و مالی',
            '_royesh_tl_2_desc'     => 'ورود به حوزه خدمات نوین اعتباری و همکاری استراتژیک با بانک‌ها و نهادهای مالی بزرگ کشور.',
            '_royesh_tl_3_year'     => '۱۴۰۵',
            '_royesh_tl_3_title'    => 'تحول دیجیتال و سبدهای دارایی اختصاصی',
            '_royesh_tl_3_desc'     => 'راه‌اندازی مدل‌های پیشرفته مدیریت دارایی و نقدینگی بر بستر تکنولوژی‌های پیشرفته تحلیل داده.',
        ]),

        'page-services.php' => array_merge($common_hero, [
            '_royesh_hero_badge'    => 'رویش سرمایه',
            '_royesh_hero_title'    => 'خدمات تخصصی و راهکارهای مالی',
            '_royesh_hero_desc'     => 'ما در رویش، با تکیه بر تحلیل‌های دقیق و شناخت بازار، راهکارهایی هوشمندانه و شخصی‌سازی شده برای توسعه ظرفیت‌های مالی و کسب‌وکار شما ارائه می‌دهیم.',
            '_royesh_srv_1_badge'   => 'شتاب‌دهنده رشد',
            '_royesh_srv_1_title'   => 'خدمات تأمین مالی',
            '_royesh_srv_1_desc'    => 'طراحی و ارائه راهکارهای تأمین منابع مالی متناسب با ساختار و نیاز کسب‌وکارها، به عنوان شتاب‌دهنده‌ای برای رشد و توسعه پایدار سازمان شما عمل می‌کند. ما در این مسیر تمام مراحل را هموار می‌سازیم.',
            '_royesh_srv_1_bullets' => "تأمین مالی از طریق بازار پول و بازار سرمایه\nطراحی و انتشار اوراق بهادار و مشارکت\nجذب سرمایه‌گذار و هم‌سرمایه‌گذاری ریسک‌پذیر\nساختاردهی به مشارکت‌های استراتژیک مالی",
            '_royesh_srv_1_btn'     => 'درخواست مشاوره تأمین مالی',

            '_royesh_srv_2_badge'   => 'توسعه اعتبار',
            '_royesh_srv_2_title'   => 'خدمات اعتباری',
            '_royesh_srv_2_desc'    => 'طراحی سازوکارهای اعتباری، ارزیابی ظرفیت‌ها و توسعه راهکارهای اعتباری مؤثر به شما کمک می‌کند تا بهینه‌ترین منابع اعتباری بازار را با حداقل ریسک و فرآیند اداری دریافت کنید.',
            '_royesh_srv_2_bullets' => "مشاوره و تسهیل اخذ تسهیلات بانکی\nتسهیل فرآیند صدور ضمانت‌نامه‌ها و اعتبارات اسنادی\nارزیابی و رتبه‌بندی اعتباری شرکت‌ها\nطراحی و تحلیل خط‌مشی‌های اعتباردهی به مشتریان",
            '_royesh_srv_2_btn'     => 'درخواست مشاوره خدمات اعتباری',

            '_royesh_srv_3_badge'   => 'پویایی مالی',
            '_royesh_srv_3_title'   => 'مدیریت نقدینگی',
            '_royesh_srv_3_desc'    => 'بهینه‌سازی جریان‌های نقدی و ارتقای بازدهی منابع کوتاه‌مدت، تضمین‌کننده بقا و پویایی روزمره هر کسب‌وکار در شرایط متغیر اقتصادی است. با رویکردهای تخصصی ما جریان‌های نقدی خود را ایمن کنید.',
            '_royesh_srv_3_bullets' => "پیش‌بینی هوشمند و منظم جریان وجوه نقد\nمدیریت و بهینه‌سازی سرمایه در گردش\nطراحی الگوهای بهینه پرداخت و دریافت\nمدیریت سرمایه‌گذاری‌های کوتاه‌مدت وجوه مازاد",
            '_royesh_srv_3_btn'     => 'درخواست مشاوره نقدینگی',

            '_royesh_srv_4_badge'   => 'ارزش‌آفرینی پایدار',
            '_royesh_srv_4_title'   => 'مدیریت دارایی',
            '_royesh_srv_4_desc'    => 'ارزیابی، ساختاردهی و مدیریت استراتژیک دارایی‌ها با رویکرد خلق ارزش پایدار، به شما کمک می‌کند ارزش دارایی‌های خود را در بلندمدت حفظ کرده و توسعه دهید.',
            '_royesh_srv_4_bullets' => "تشکیل و مدیریت پرتفوی اختصاصی متناسب با اهداف ریسک\nارزیابی و ارزش‌گذاری علمی دارایی‌های مشهود و نامشهود\nمشاوره در زمینه بهینه‌سازی سبد دارایی‌ها\nپایش مستمر و بازنگری دوره‌ای عملکرد سبد سرمایه‌گذاری",
            '_royesh_srv_4_btn'     => 'درخواست مشاوره مدیریت دارایی',
        ]),

        'page-contact.php' => array_merge($common_hero, [
            '_royesh_hero_badge'     => 'ارتباط با رویش',
            '_royesh_hero_title'     => 'تماس با ما',
            '_royesh_hero_desc'      => 'تیم کارشناسان رویش سرمایه آماده پاسخگویی به پرسش‌ها و ارائه خدمات مشاوره تخصصی به شما هستند.',
            '_royesh_cnt_form_title' => 'ارسال پیام به کارشناسان رویش',
            '_royesh_cnt_form_btn'   => 'ارسال پیام',
            '_royesh_cnt_phone_ovr'  => '',
            '_royesh_cnt_email_ovr'  => '',
            '_royesh_cnt_addr_ovr'   => '',
        ]),

        'page-consultation.php' => array_merge($common_hero, [
            '_royesh_hero_badge'     => 'همگام با نیازهای شما',
            '_royesh_hero_title'     => 'درخواست مشاوره تخصصی',
            '_royesh_hero_desc'      => 'برای دریافت مشاوره اختصاصی مالی، فرم زیر را پر کنید. کارشناسان ما در کوتاه‌ترین زمان با شما تماس خواهند گرفت.',
            '_royesh_cns_btn_text'   => 'ثبت نهایی درخواست مشاوره',
            '_royesh_cns_side_badge' => 'خدمات مشاوره حرفه‌ای',
            '_royesh_cns_side_title' => 'چرا مشاوره با رویش سرمایه؟',
            '_royesh_cns_side_desc'  => 'ما در گروه رویش به دنبال روابط طولانی‌مدت و خلق ارزش واقعی هستیم. پس از ثبت درخواست، پرونده شما مستقیماً توسط یکی از کارشناسان خبره ما تحلیل شده و در کوتاه‌ترین زمان با شما ارتباط برقرار خواهد شد.',
            '_royesh_cns_feat_1_t'   => 'تماس در کمتر از ۲۴ ساعت',
            '_royesh_cns_feat_1_d'   => 'کارشناسان ما به محض دریافت فرم، بررسی اولیه را انجام داده و با شما تماس می‌گیرند.',
            '_royesh_cns_feat_2_t'   => 'محرمانگی و امنیت اطلاعات',
            '_royesh_cns_feat_2_d'   => 'تمام اطلاعات مالی، ایده ها و اسناد تجاری شما به عنوان راز تجاری نزد ما محفوظ خواهد ماند.',
        ]),
    ];

    if ($template_file && isset($defaults_by_template[$template_file])) {
        return $defaults_by_template[$template_file];
    }

    return $defaults_by_template;
}

/**
 * بذرپاشی و ذخیره خودکار مقادیر اولیه در دیتابیس (در صورتی که هنوز ذخیره نشده باشند)
 */
function royesh_seed_page_defaults($post_id, $template_file = '') {
    if (!$post_id) return;

    if (empty($template_file)) {
        $template_file = get_post_meta($post_id, '_wp_page_template', true);
    }

    $all_defaults = royesh_get_template_defaults();
    $target_defaults = [];

    $target_defaults['_royesh_hero_enable'] = '1';
    $target_defaults['_royesh_hero_bg_color'] = '#004F40';

    if (!empty($template_file) && isset($all_defaults[$template_file])) {
        $target_defaults = array_merge($target_defaults, $all_defaults[$template_file]);
    }

    foreach ($target_defaults as $meta_key => $default_val) {
        $existing = get_post_meta($post_id, $meta_key, true);
        if ($existing === '' || $existing === false) {
            update_post_meta($post_id, $meta_key, $default_val);
        }
    }
}

/**
 * دریافت مقدار فیلد متا با مقدار پیش‌فرض ایمن
 */
function royesh_get_page_meta($post_id, $key, $default = '') {
    $val = get_post_meta($post_id, $key, true);
    if ($key === '_royesh_hero_bg_color') {
        if (empty($val) || strtolower($val) === '#ffffff' || strtolower($val) === '#fff') {
            return '#004F40';
        }
    }
    return ($val !== '' && $val !== false) ? $val : $default;
}

/**
 * ثبت متاباکس اختصاصی برای ویرایش برگه‌ها
 */
function royesh_register_page_metaboxes() {
    add_meta_box(
        'royesh_page_customizer_metabox',
        __('تنظیمات اختصاصی و محتوایی برگه (قالب رویش)', 'royesh'),
        'royesh_render_page_metabox',
        'page',
        'normal',
        'high'
    );
}
add_action('add_meta_boxes', 'royesh_register_page_metaboxes');

/**
 * لود مدیا آپلودر وردپرس در صفحات ویرایش برگه
 */
function royesh_admin_enqueue_metabox_assets($hook) {
    if ($hook === 'post.php' || $hook === 'post-new.php') {
        global $post;
        if ($post && $post->post_type === 'page') {
            wp_enqueue_media();
        }
    }
}
add_action('admin_enqueue_scripts', 'royesh_admin_enqueue_metabox_assets');

/**
 * بذرپاشی خودکار در زمان باز شدن پیشخوان برای تمامی صفحات دارای قالب
 */
function royesh_auto_seed_existing_pages() {
    if (!is_admin()) return;

    static $seeded = false;
    if ($seeded) return;
    $seeded = true;

    $pages = get_posts([
        'post_type'      => 'page',
        'posts_per_page' => -1,
        'post_status'    => 'any',
        'fields'         => 'ids',
    ]);

    foreach ($pages as $p_id) {
        $tpl = get_post_meta($p_id, '_wp_page_template', true);
        if ($tpl && $tpl !== 'default') {
            royesh_seed_page_defaults($p_id, $tpl);
        }
    }
}
add_action('admin_init', 'royesh_auto_seed_existing_pages');

/**
 * رندر ظاهر و فیلدهای متاباکس برگه
 */
function royesh_render_page_metabox($post) {
    wp_nonce_field('royesh_page_meta_nonce_action', 'royesh_page_meta_nonce');

    // تشخیص قالب فعلی برگه
    $current_template = get_post_meta($post->ID, '_wp_page_template', true);

    // بذرپاشی اولیه دیتابیس برای این صفحه
    royesh_seed_page_defaults($post->ID, $current_template);

    // مقادیر تب هیرو / سربرگ از دیتابیس
    $hero_enable   = royesh_get_page_meta($post->ID, '_royesh_hero_enable', '1');
    $hero_badge    = royesh_get_page_meta($post->ID, '_royesh_hero_badge', '');
    $hero_title    = royesh_get_page_meta($post->ID, '_royesh_hero_title', '');
    $hero_desc     = royesh_get_page_meta($post->ID, '_royesh_hero_desc', '');
    $hero_bg_color = royesh_get_page_meta($post->ID, '_royesh_hero_bg_color', '#004F40');

    // مقادیر تب درباره ما از دیتابیس
    $about_p1      = royesh_get_page_meta($post->ID, '_royesh_about_p1', '');
    $about_p2      = royesh_get_page_meta($post->ID, '_royesh_about_p2', '');
    $about_sticky  = royesh_get_page_meta($post->ID, '_royesh_about_sticky', '');

    // ارزش‌های بنیادین از دیتابیس
    $val_title     = royesh_get_page_meta($post->ID, '_royesh_val_title', '');
    $val_1_title   = royesh_get_page_meta($post->ID, '_royesh_val_1_title', '');
    $val_1_desc    = royesh_get_page_meta($post->ID, '_royesh_val_1_desc', '');
    $val_2_title   = royesh_get_page_meta($post->ID, '_royesh_val_2_title', '');
    $val_2_desc    = royesh_get_page_meta($post->ID, '_royesh_val_2_desc', '');
    $val_3_title   = royesh_get_page_meta($post->ID, '_royesh_val_3_title', '');
    $val_3_desc    = royesh_get_page_meta($post->ID, '_royesh_val_3_desc', '');

    // گاه‌شمار از دیتابیس
    $tl_title      = royesh_get_page_meta($post->ID, '_royesh_tl_title', '');
    $tl_1_year     = royesh_get_page_meta($post->ID, '_royesh_tl_1_year', '');
    $tl_1_title    = royesh_get_page_meta($post->ID, '_royesh_tl_1_title', '');
    $tl_1_desc     = royesh_get_page_meta($post->ID, '_royesh_tl_1_desc', '');
    $tl_2_year     = royesh_get_page_meta($post->ID, '_royesh_tl_2_year', '');
    $tl_2_title    = royesh_get_page_meta($post->ID, '_royesh_tl_2_title', '');
    $tl_2_desc     = royesh_get_page_meta($post->ID, '_royesh_tl_2_desc', '');
    $tl_3_year     = royesh_get_page_meta($post->ID, '_royesh_tl_3_year', '');
    $tl_3_title    = royesh_get_page_meta($post->ID, '_royesh_tl_3_title', '');
    $tl_3_desc     = royesh_get_page_meta($post->ID, '_royesh_tl_3_desc', '');

    // مقادیر تب خدمات ما از دیتابیس
    $srv_1_badge   = royesh_get_page_meta($post->ID, '_royesh_srv_1_badge', '');
    $srv_1_title   = royesh_get_page_meta($post->ID, '_royesh_srv_1_title', '');
    $srv_1_desc    = royesh_get_page_meta($post->ID, '_royesh_srv_1_desc', '');
    $srv_1_bullets = royesh_get_page_meta($post->ID, '_royesh_srv_1_bullets', '');
    $srv_1_btn     = royesh_get_page_meta($post->ID, '_royesh_srv_1_btn', '');

    $srv_2_badge   = royesh_get_page_meta($post->ID, '_royesh_srv_2_badge', '');
    $srv_2_title   = royesh_get_page_meta($post->ID, '_royesh_srv_2_title', '');
    $srv_2_desc    = royesh_get_page_meta($post->ID, '_royesh_srv_2_desc', '');
    $srv_2_bullets = royesh_get_page_meta($post->ID, '_royesh_srv_2_bullets', '');
    $srv_2_btn     = royesh_get_page_meta($post->ID, '_royesh_srv_2_btn', '');

    $srv_3_badge   = royesh_get_page_meta($post->ID, '_royesh_srv_3_badge', '');
    $srv_3_title   = royesh_get_page_meta($post->ID, '_royesh_srv_3_title', '');
    $srv_3_desc    = royesh_get_page_meta($post->ID, '_royesh_srv_3_desc', '');
    $srv_3_bullets = royesh_get_page_meta($post->ID, '_royesh_srv_3_bullets', '');
    $srv_3_btn     = royesh_get_page_meta($post->ID, '_royesh_srv_3_btn', '');

    $srv_4_badge   = royesh_get_page_meta($post->ID, '_royesh_srv_4_badge', '');
    $srv_4_title   = royesh_get_page_meta($post->ID, '_royesh_srv_4_title', '');
    $srv_4_desc    = royesh_get_page_meta($post->ID, '_royesh_srv_4_desc', '');
    $srv_4_bullets = royesh_get_page_meta($post->ID, '_royesh_srv_4_bullets', '');
    $srv_4_btn     = royesh_get_page_meta($post->ID, '_royesh_srv_4_btn', '');

    // مقادیر تب تماس با ما از دیتابیس
    $cnt_form_title = royesh_get_page_meta($post->ID, '_royesh_cnt_form_title', '');
    $cnt_form_btn   = royesh_get_page_meta($post->ID, '_royesh_cnt_form_btn', '');
    $cnt_phone_ovr  = royesh_get_page_meta($post->ID, '_royesh_cnt_phone_ovr', '');
    $cnt_email_ovr  = royesh_get_page_meta($post->ID, '_royesh_cnt_email_ovr', '');
    $cnt_addr_ovr   = royesh_get_page_meta($post->ID, '_royesh_cnt_addr_ovr', '');

    // مقادیر تب درخواست مشاوره از دیتابیس
    $cns_btn_text   = royesh_get_page_meta($post->ID, '_royesh_cns_btn_text', '');
    $cns_side_badge = royesh_get_page_meta($post->ID, '_royesh_cns_side_badge', '');
    $cns_side_title = royesh_get_page_meta($post->ID, '_royesh_cns_side_title', '');
    $cns_side_desc  = royesh_get_page_meta($post->ID, '_royesh_cns_side_desc', '');
    $cns_feat_1_t   = royesh_get_page_meta($post->ID, '_royesh_cns_feat_1_t', '');
    $cns_feat_1_d   = royesh_get_page_meta($post->ID, '_royesh_cns_feat_1_d', '');
    $cns_feat_2_t   = royesh_get_page_meta($post->ID, '_royesh_cns_feat_2_t', '');
    $cns_feat_2_d   = royesh_get_page_meta($post->ID, '_royesh_cns_feat_2_d', '');
    ?>

    <style>
        /* استفاده از فونت سراسری پنل مدیریت برای تمام اجزا بدون تعیین فونت دستی */
        .royesh-mb-wrap,
        .royesh-mb-wrap * {
            font-family: inherit !important;
            box-sizing: border-box;
        }

        .royesh-mb-wrap {
            direction: rtl;
            text-align: right;
            margin: -6px -12px -12px -12px;
            background: #ffffff;
        }
        
        .royesh-mb-header {
            background: #f0f0f1;
            border-bottom: 1px solid #c3c4c7;
            padding: 8px 14px 0 14px;
            display: flex;
            align-items: flex-end;
            gap: 4px;
        }
        
        .royesh-tab-item {
            background: #e0e0e0;
            color: #50575e;
            border: 1px solid #c3c4c7;
            border-bottom: none;
            padding: 8px 16px;
            font-size: 13px;
            font-weight: 600;
            cursor: pointer;
            border-top-left-radius: 4px;
            border-top-right-radius: 4px;
            transition: all 0.15s ease;
            display: inline-block;
            margin-bottom: -1px;
            outline: none;
        }
        .royesh-tab-item:hover {
            background: #ffffff;
            color: #1d2327;
        }
        .royesh-tab-item.active {
            background: #ffffff;
            color: #014235;
            border-color: #c3c4c7;
            border-bottom-color: #ffffff;
            font-weight: 700;
        }

        .royesh-mb-body {
            padding: 18px 20px 24px 20px;
            background: #ffffff;
        }
        .royesh-panel {
            display: none;
        }
        .royesh-panel.active {
            display: block;
        }

        /* ساختار تمیز بدون بردرهای تودرتو */
        .royesh-section {
            padding-bottom: 18px;
            margin-bottom: 20px;
            border-bottom: 1px solid #f0f0f1;
        }
        .royesh-section:last-child {
            padding-bottom: 0;
            margin-bottom: 0;
            border-bottom: none;
        }
        .royesh-sec-head {
            font-size: 13px;
            font-weight: 700;
            color: #014235;
            margin: 0 0 14px 0;
        }

        /* نوار فوقانی مرتب: سوئیچ نمایش + انتخاب رنگ سربرگ در یک سطر */
        .royesh-top-bar {
            display: flex;
            align-items: center;
            justify-content: space-between;
            background: #f6f7f7;
            padding: 10px 14px;
            border-radius: 4px;
            margin-bottom: 16px;
            border: 1px solid #dcdcde;
        }
        .royesh-color-inline {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            font-size: 13px;
            color: #2c3338;
        }
        .royesh-color-inline input[type="color"] {
            width: 28px;
            height: 28px;
            padding: 0;
            border: 1px solid #8c8f94;
            border-radius: 4px;
            cursor: pointer;
            background: none;
        }

        /* گرید فیلدها */
        .royesh-row {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 16px;
        }
        .royesh-row-3 {
            display: grid;
            grid-template-columns: 1fr 1fr 1fr;
            gap: 16px;
        }
        @media (max-width: 782px) {
            .royesh-row, .royesh-row-3, .royesh-top-bar {
                grid-template-columns: 1fr;
                flex-direction: column;
                align-items: flex-start;
                gap: 10px;
            }
        }

        /* المان بدون هیچگونه بردر اضافه */
        .royesh-group {
            margin-bottom: 14px;
            border: none !important;
            padding: 0 !important;
            background: transparent !important;
            box-shadow: none !important;
        }
        .royesh-label {
            display: block;
            font-size: 13px;
            font-weight: 600;
            color: #1d2327;
            margin-bottom: 6px;
        }
        .royesh-input,
        .royesh-textarea,
        .royesh-select {
            width: 100% !important;
            max-width: 100% !important;
            padding: 6px 10px !important;
            border: 1px solid #8c8f94 !important;
            border-radius: 4px !important;
            font-size: 13px !important;
            line-height: 1.5 !important;
            background-color: #ffffff !important;
            color: #2c3338 !important;
            box-shadow: none !important;
            box-sizing: border-box !important;
        }
        .royesh-input:focus,
        .royesh-textarea:focus {
            border-color: #014235 !important;
            box-shadow: 0 0 0 1px #014235 !important;
            outline: 2px solid transparent !important;
        }

        .royesh-notice-box {
            padding: 12px 14px;
            background: #f6f7f7;
            border-right: 4px solid #014235;
            border-radius: 2px;
            color: #50575e;
            font-size: 12px;
            line-height: 1.6;
            margin-top: 14px;
        }
    </style>

    <div class="royesh-mb-wrap">
        
        <!-- Tab Bar با عناوین خلاصه و بدون badge -->
        <div class="royesh-mb-header" id="royesh-tabs-bar">
            <!-- تب عمومی سربرگ (همیشه فعال) -->
            <button type="button" class="royesh-tab-item active" data-tab="tab-hero">
                سربرگ برگه
            </button>

            <!-- تب اختصاصی درباره ما -->
            <button type="button" class="royesh-tab-item royesh-tpl-tab" data-tab="tab-about" data-tpl="page-about.php" style="display: none;">
                درباره ما
            </button>

            <!-- تب اختصاصی خدمات ما -->
            <button type="button" class="royesh-tab-item royesh-tpl-tab" data-tab="tab-services" data-tpl="page-services.php" style="display: none;">
                خدمات ما
            </button>

            <!-- تب اختصاصی تماس با ما -->
            <button type="button" class="royesh-tab-item royesh-tpl-tab" data-tab="tab-contact" data-tpl="page-contact.php" style="display: none;">
                تماس با ما
            </button>

            <!-- تب اختصاصی درخواست مشاوره -->
            <button type="button" class="royesh-tab-item royesh-tpl-tab" data-tab="tab-consultation" data-tpl="page-consultation.php" style="display: none;">
                درخواست مشاوره
            </button>
        </div>

        <div class="royesh-mb-body">
            
            <!-- ========================================== -->
            <!-- TAB 1: HERO & HEADER (ALL PAGES)           -->
            <!-- ========================================== -->
            <div class="royesh-panel active" id="tab-hero">
                
                <!-- نوار فوقانی مرتب: سوئیچ نمایش + انتخاب رنگ سربرگ در یک سطر -->
                <div class="royesh-top-bar">
                    <label style="font-weight: 600; font-size: 13px; color: #1d2327; cursor: pointer; display: inline-flex; align-items: center; gap: 6px;">
                        <input type="checkbox" name="royesh_hero_enable" value="1" <?php checked($hero_enable, '1'); ?> />
                        نمایش سکشن سربرگ و بنر بالای این برگه
                    </label>

                    <div class="royesh-color-inline">
                        <span>رنگ پس‌زمینه سربرگ:</span>
                        <input type="color" name="royesh_hero_bg_color" value="<?php echo esc_attr($hero_bg_color); ?>" title="انتخاب رنگ سربرگ" />
                    </div>
                </div>

                <div class="royesh-row">
                    <div class="royesh-group">
                        <label class="royesh-label">بج / عبارت کوچک بالای عنوان:</label>
                        <input type="text" class="royesh-input" name="royesh_hero_badge" value="<?php echo esc_attr($hero_badge); ?>" placeholder="مثال: همراه رشد شما / همگام با نیازهای شما" />
                    </div>
                    <div class="royesh-group">
                        <label class="royesh-label">عنوان اختصاصی سربرگ:</label>
                        <input type="text" class="royesh-input" name="royesh_hero_title" value="<?php echo esc_attr($hero_title); ?>" placeholder="پیش‌فرض: نام همین برگه" />
                    </div>
                </div>

                <div class="royesh-group">
                    <label class="royesh-label">متن توضیحات زیر عنوان سربرگ:</label>
                    <textarea class="royesh-textarea" name="royesh_hero_desc" rows="2" placeholder="توضیح کوتاه و جذاب در مورد این برگه..."><?php echo esc_textarea($hero_desc); ?></textarea>
                </div>

                <!-- پیام راهنما برای برگه‌های بدون تمپلیت خاص -->
                <div class="royesh-notice-box" id="royesh-default-tpl-notice">
                    راهنما: در صورتی که برای این برگه یکی از قالب‌های اختصاصی (مانند <em>درباره ما</em>، <em>خدمات ما</em>، <em>تماس با ما</em> یا <em>درخواست مشاوره</em>) را از بخش ویژگی‌های برگه در سایدبار انتخاب کنید، تب تنظیمات محتوایی اختصاصی آن صفحه به صورت خودکار در این متاباکس فعال خواهد شد.
                </div>
            </div>

            <!-- ========================================== -->
            <!-- TAB 2: ABOUT US (page-about.php)           -->
            <!-- ========================================== -->
            <div class="royesh-panel" id="tab-about">
                
                <div class="royesh-section">
                    <h4 class="royesh-sec-head">۱. فلسفه برند و مأموریت ما</h4>
                    <div class="royesh-group">
                        <label class="royesh-label">پاراگراف اول متن مأموریت:</label>
                        <textarea class="royesh-textarea" name="royesh_about_p1" rows="3"><?php echo esc_textarea($about_p1); ?></textarea>
                    </div>
                    <div class="royesh-group">
                        <label class="royesh-label">پاراگراف دوم متن مأموریت:</label>
                        <textarea class="royesh-textarea" name="royesh_about_p2" rows="3"><?php echo esc_textarea($about_p2); ?></textarea>
                    </div>
                    <div class="royesh-group">
                        <label class="royesh-label">متن برچسب استیکی روی تصاویر:</label>
                        <input type="text" class="royesh-input" name="royesh_about_sticky" value="<?php echo esc_attr($about_sticky); ?>" />
                    </div>
                </div>

                <div class="royesh-section">
                    <h4 class="royesh-sec-head">۲. ارزش‌های بنیادین</h4>
                    <div class="royesh-group">
                        <label class="royesh-label">عنوان اصلی بخش ارزش‌ها:</label>
                        <input type="text" class="royesh-input" name="royesh_val_title" value="<?php echo esc_attr($val_title); ?>" />
                    </div>
                    
                    <div class="royesh-row-3">
                        <div class="royesh-group">
                            <label class="royesh-label">ارزش ۱ - عنوان:</label>
                            <input type="text" class="royesh-input" name="royesh_val_1_title" value="<?php echo esc_attr($val_1_title); ?>" />
                            <label class="royesh-label" style="margin-top:6px;">ارزش ۱ - توضیحات:</label>
                            <textarea class="royesh-textarea" name="royesh_val_1_desc" rows="3"><?php echo esc_textarea($val_1_desc); ?></textarea>
                        </div>
                        <div class="royesh-group">
                            <label class="royesh-label">ارزش ۲ - عنوان:</label>
                            <input type="text" class="royesh-input" name="royesh_val_2_title" value="<?php echo esc_attr($val_2_title); ?>" />
                            <label class="royesh-label" style="margin-top:6px;">ارزش ۲ - توضیحات:</label>
                            <textarea class="royesh-textarea" name="royesh_val_2_desc" rows="3"><?php echo esc_textarea($val_2_desc); ?></textarea>
                        </div>
                        <div class="royesh-group">
                            <label class="royesh-label">ارزش ۳ - عنوان:</label>
                            <input type="text" class="royesh-input" name="royesh_val_3_title" value="<?php echo esc_attr($val_3_title); ?>" />
                            <label class="royesh-label" style="margin-top:6px;">ارزش ۳ - توضیحات:</label>
                            <textarea class="royesh-textarea" name="royesh_val_3_desc" rows="3"><?php echo esc_textarea($val_3_desc); ?></textarea>
                        </div>
                    </div>
                </div>

                <div class="royesh-section">
                    <h4 class="royesh-sec-head">۳. گاه‌شمار توسعه رویش</h4>
                    <div class="royesh-group">
                        <label class="royesh-label">عنوان اصلی بخش گاه‌شمار:</label>
                        <input type="text" class="royesh-input" name="royesh_tl_title" value="<?php echo esc_attr($tl_title); ?>" />
                    </div>

                    <div class="royesh-row-3">
                        <div class="royesh-group">
                            <label class="royesh-label">رویداد ۱ - سال:</label>
                            <input type="text" class="royesh-input" name="royesh_tl_1_year" value="<?php echo esc_attr($tl_1_year); ?>" />
                            <label class="royesh-label" style="margin-top:6px;">رویداد ۱ - عنوان:</label>
                            <input type="text" class="royesh-input" name="royesh_tl_1_title" value="<?php echo esc_attr($tl_1_title); ?>" />
                            <label class="royesh-label" style="margin-top:6px;">رویداد ۱ - توضیحات:</label>
                            <textarea class="royesh-textarea" name="royesh_tl_1_desc" rows="3"><?php echo esc_textarea($tl_1_desc); ?></textarea>
                        </div>
                        <div class="royesh-group">
                            <label class="royesh-label">رویداد ۲ - سال:</label>
                            <input type="text" class="royesh-input" name="royesh_tl_2_year" value="<?php echo esc_attr($tl_2_year); ?>" />
                            <label class="royesh-label" style="margin-top:6px;">رویداد ۲ - عنوان:</label>
                            <input type="text" class="royesh-input" name="royesh_tl_2_title" value="<?php echo esc_attr($tl_2_title); ?>" />
                            <label class="royesh-label" style="margin-top:6px;">رویداد ۲ - توضیحات:</label>
                            <textarea class="royesh-textarea" name="royesh_tl_2_desc" rows="3"><?php echo esc_textarea($tl_2_desc); ?></textarea>
                        </div>
                        <div class="royesh-group">
                            <label class="royesh-label">رویداد ۳ - سال:</label>
                            <input type="text" class="royesh-input" name="royesh_tl_3_year" value="<?php echo esc_attr($tl_3_year); ?>" />
                            <label class="royesh-label" style="margin-top:6px;">رویداد ۳ - عنوان:</label>
                            <input type="text" class="royesh-input" name="royesh_tl_3_title" value="<?php echo esc_attr($tl_3_title); ?>" />
                            <label class="royesh-label" style="margin-top:6px;">رویداد ۳ - توضیحات:</label>
                            <textarea class="royesh-textarea" name="royesh_tl_3_desc" rows="3"><?php echo esc_textarea($tl_3_desc); ?></textarea>
                        </div>
                    </div>
                </div>

            </div>

            <!-- ========================================== -->
            <!-- TAB 3: SERVICES (page-services.php)        -->
            <!-- ========================================== -->
            <div class="royesh-panel" id="tab-services">
                
                <div class="royesh-section">
                    <h4 class="royesh-sec-head">۱. خدمات تأمین مالی</h4>
                    <div class="royesh-row">
                        <div class="royesh-group">
                            <label class="royesh-label">برچسب بالای تیتر:</label>
                            <input type="text" class="royesh-input" name="royesh_srv_1_badge" value="<?php echo esc_attr($srv_1_badge); ?>" />
                        </div>
                        <div class="royesh-group">
                            <label class="royesh-label">عنوان اصلی خدمت:</label>
                            <input type="text" class="royesh-input" name="royesh_srv_1_title" value="<?php echo esc_attr($srv_1_title); ?>" />
                        </div>
                    </div>
                    <div class="royesh-group">
                        <label class="royesh-label">متن توضیحات کامل خدمت:</label>
                        <textarea class="royesh-textarea" name="royesh_srv_1_desc" rows="2"><?php echo esc_textarea($srv_1_desc); ?></textarea>
                    </div>
                    <div class="royesh-group">
                        <label class="royesh-label">سرفصل‌ها و ویژگی‌ها (هر مورد در یک خط):</label>
                        <textarea class="royesh-textarea" name="royesh_srv_1_bullets" rows="3"><?php echo esc_textarea($srv_1_bullets); ?></textarea>
                    </div>
                    <div class="royesh-group">
                        <label class="royesh-label">متن دکمه اقدام:</label>
                        <input type="text" class="royesh-input" name="royesh_srv_1_btn" value="<?php echo esc_attr($srv_1_btn); ?>" />
                    </div>
                </div>

                <div class="royesh-section">
                    <h4 class="royesh-sec-head">۲. خدمات اعتباری</h4>
                    <div class="royesh-row">
                        <div class="royesh-group">
                            <label class="royesh-label">برچسب بالای تیتر:</label>
                            <input type="text" class="royesh-input" name="royesh_srv_2_badge" value="<?php echo esc_attr($srv_2_badge); ?>" />
                        </div>
                        <div class="royesh-group">
                            <label class="royesh-label">عنوان اصلی خدمت:</label>
                            <input type="text" class="royesh-input" name="royesh_srv_2_title" value="<?php echo esc_attr($srv_2_title); ?>" />
                        </div>
                    </div>
                    <div class="royesh-group">
                        <label class="royesh-label">متن توضیحات کامل خدمت:</label>
                        <textarea class="royesh-textarea" name="royesh_srv_2_desc" rows="2"><?php echo esc_textarea($srv_2_desc); ?></textarea>
                    </div>
                    <div class="royesh-group">
                        <label class="royesh-label">سرفصل‌ها و ویژگی‌ها (هر مورد در یک خط):</label>
                        <textarea class="royesh-textarea" name="royesh_srv_2_bullets" rows="3"><?php echo esc_textarea($srv_2_bullets); ?></textarea>
                    </div>
                    <div class="royesh-group">
                        <label class="royesh-label">متن دکمه اقدام:</label>
                        <input type="text" class="royesh-input" name="royesh_srv_2_btn" value="<?php echo esc_attr($srv_2_btn); ?>" />
                    </div>
                </div>

                <div class="royesh-section">
                    <h4 class="royesh-sec-head">۳. مدیریت نقدینگی</h4>
                    <div class="royesh-row">
                        <div class="royesh-group">
                            <label class="royesh-label">برچسب بالای تیتر:</label>
                            <input type="text" class="royesh-input" name="royesh_srv_3_badge" value="<?php echo esc_attr($srv_3_badge); ?>" />
                        </div>
                        <div class="royesh-group">
                            <label class="royesh-label">عنوان اصلی خدمت:</label>
                            <input type="text" class="royesh-input" name="royesh_srv_3_title" value="<?php echo esc_attr($srv_3_title); ?>" />
                        </div>
                    </div>
                    <div class="royesh-group">
                        <label class="royesh-label">متن توضیحات کامل خدمت:</label>
                        <textarea class="royesh-textarea" name="royesh_srv_3_desc" rows="2"><?php echo esc_textarea($srv_3_desc); ?></textarea>
                    </div>
                    <div class="royesh-group">
                        <label class="royesh-label">سرفصل‌ها و ویژگی‌ها (هر مورد در یک خط):</label>
                        <textarea class="royesh-textarea" name="royesh_srv_3_bullets" rows="3"><?php echo esc_textarea($srv_3_bullets); ?></textarea>
                    </div>
                    <div class="royesh-group">
                        <label class="royesh-label">متن دکمه اقدام:</label>
                        <input type="text" class="royesh-input" name="royesh_srv_3_btn" value="<?php echo esc_attr($srv_3_btn); ?>" />
                    </div>
                </div>

                <div class="royesh-section">
                    <h4 class="royesh-sec-head">۴. مدیریت دارایی</h4>
                    <div class="royesh-row">
                        <div class="royesh-group">
                            <label class="royesh-label">برچسب بالای تیتر:</label>
                            <input type="text" class="royesh-input" name="royesh_srv_4_badge" value="<?php echo esc_attr($srv_4_badge); ?>" />
                        </div>
                        <div class="royesh-group">
                            <label class="royesh-label">عنوان اصلی خدمت:</label>
                            <input type="text" class="royesh-input" name="royesh_srv_4_title" value="<?php echo esc_attr($srv_4_title); ?>" />
                        </div>
                    </div>
                    <div class="royesh-group">
                        <label class="royesh-label">متن توضیحات کامل خدمت:</label>
                        <textarea class="royesh-textarea" name="royesh_srv_4_desc" rows="2"><?php echo esc_textarea($srv_4_desc); ?></textarea>
                    </div>
                    <div class="royesh-group">
                        <label class="royesh-label">سرفصل‌ها و ویژگی‌ها (هر مورد در یک خط):</label>
                        <textarea class="royesh-textarea" name="royesh_srv_4_bullets" rows="3"><?php echo esc_textarea($srv_4_bullets); ?></textarea>
                    </div>
                    <div class="royesh-group">
                        <label class="royesh-label">متن دکمه اقدام:</label>
                        <input type="text" class="royesh-input" name="royesh_srv_4_btn" value="<?php echo esc_attr($srv_4_btn); ?>" />
                    </div>
                </div>

            </div>

            <!-- ========================================== -->
            <!-- TAB 4: CONTACT (page-contact.php)          -->
            <!-- ========================================== -->
            <div class="royesh-panel" id="tab-contact">
                <div class="royesh-section">
                    <h4 class="royesh-sec-head">تنظیمات فرم و اطلاعات تماس</h4>
                    
                    <div class="royesh-row">
                        <div class="royesh-group">
                            <label class="royesh-label">عنوان فرم پیام:</label>
                            <input type="text" class="royesh-input" name="royesh_cnt_form_title" value="<?php echo esc_attr($cnt_form_title); ?>" />
                        </div>
                        <div class="royesh-group">
                            <label class="royesh-label">متن دکمه ارسال:</label>
                            <input type="text" class="royesh-input" name="royesh_cnt_form_btn" value="<?php echo esc_attr($cnt_form_btn); ?>" />
                        </div>
                    </div>

                    <div class="royesh-group">
                        <label class="royesh-label">شماره تلفن اختصاصی این برگه (اختیاری):</label>
                        <input type="text" class="royesh-input" name="royesh_cnt_phone_ovr" value="<?php echo esc_attr($cnt_phone_ovr); ?>" placeholder="در صورت خالی بودن، شماره سراسری سایت استفاده می‌شود" />
                    </div>
                    <div class="royesh-group">
                        <label class="royesh-label">ایمیل اختصاصی این برگه (اختیاری):</label>
                        <input type="email" class="royesh-input" name="royesh_cnt_email_ovr" value="<?php echo esc_attr($cnt_email_ovr); ?>" placeholder="در صورت خالی بودن، ایمیل سراسری سایت استفاده می‌شود" />
                    </div>
                    <div class="royesh-group">
                        <label class="royesh-label">آدرس پستی اختصاصی این برگه (اختیاری):</label>
                        <textarea class="royesh-textarea" name="royesh_cnt_addr_ovr" rows="2" placeholder="در صورت خالی بودن، آدرس سراسری سایت استفاده می‌شود"><?php echo esc_textarea($cnt_addr_ovr); ?></textarea>
                    </div>
                </div>
            </div>

            <!-- ========================================== -->
            <!-- TAB 5: CONSULTATION (page-consultation.php)-->
            <!-- ========================================== -->
            <div class="royesh-panel" id="tab-consultation">
                <div class="royesh-section">
                    <h4 class="royesh-sec-head">تنظیمات فرم و ستون راهنمای مشاوره</h4>

                    <div class="royesh-group">
                        <label class="royesh-label">متن دکمه ثبت فرم مشاوره:</label>
                        <input type="text" class="royesh-input" name="royesh_cns_btn_text" value="<?php echo esc_attr($cns_btn_text); ?>" />
                    </div>

                    <div class="royesh-row">
                        <div class="royesh-group">
                            <label class="royesh-label">برچسب بالای ستون چپ:</label>
                            <input type="text" class="royesh-input" name="royesh_cns_side_badge" value="<?php echo esc_attr($cns_side_badge); ?>" />
                        </div>
                        <div class="royesh-group">
                            <label class="royesh-label">تیتر ستون چپ:</label>
                            <input type="text" class="royesh-input" name="royesh_cns_side_title" value="<?php echo esc_attr($cns_side_title); ?>" />
                        </div>
                    </div>

                    <div class="royesh-group">
                        <label class="royesh-label">متن توصیفی ستون چپ:</label>
                        <textarea class="royesh-textarea" name="royesh_cns_side_desc" rows="2"><?php echo esc_textarea($cns_side_desc); ?></textarea>
                    </div>

                    <div class="royesh-row">
                        <div class="royesh-group">
                            <label class="royesh-label">ویژگی ۱ - عنوان:</label>
                            <input type="text" class="royesh-input" name="royesh_cns_feat_1_t" value="<?php echo esc_attr($cns_feat_1_t); ?>" />
                            <label class="royesh-label" style="margin-top:6px;">ویژگی ۱ - توضیحات:</label>
                            <textarea class="royesh-textarea" name="royesh_cns_feat_1_d" rows="2"><?php echo esc_textarea($cns_feat_1_d); ?></textarea>
                        </div>
                        <div class="royesh-group">
                            <label class="royesh-label">ویژگی ۲ - عنوان:</label>
                            <input type="text" class="royesh-input" name="royesh_cns_feat_2_t" value="<?php echo esc_attr($cns_feat_2_t); ?>" />
                            <label class="royesh-label" style="margin-top:6px;">ویژگی ۲ - توضیحات:</label>
                            <textarea class="royesh-textarea" name="royesh_cns_feat_2_d" rows="2"><?php echo esc_textarea($cns_feat_2_d); ?></textarea>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>

    <!-- Script for Dynamic Tab Filtering and Switching -->
    <script>
    (function() {
        function initRoyeshMetabox() {
            var tabsContainer = document.getElementById('royesh-tabs-bar');
            if (!tabsContainer) return;

            var tabButtons = tabsContainer.querySelectorAll('.royesh-tab-item');
            var templateTabs = tabsContainer.querySelectorAll('.royesh-tpl-tab');
            var tabPanels = document.querySelectorAll('.royesh-panel');
            var noticeBox = document.getElementById('royesh-default-tpl-notice');

            function switchTab(targetId) {
                tabButtons.forEach(function(btn) {
                    btn.classList.toggle('active', btn.getAttribute('data-tab') === targetId);
                });
                tabPanels.forEach(function(panel) {
                    panel.classList.toggle('active', panel.id === targetId);
                });
            }

            tabButtons.forEach(function(btn) {
                btn.onclick = function(e) {
                    e.preventDefault();
                    switchTab(this.getAttribute('data-tab'));
                };
            });

            // بررسی و فیلتر دقیق تب‌ها بر اساس قالب انتخاب‌شده
            function filterTabsByTemplate() {
                var currentTpl = '';
                
                // در ادیتور کلاسیک
                var tplSelect = document.getElementById('page_template') || document.querySelector('select[name="page_template"]');
                if (tplSelect) {
                    currentTpl = tplSelect.value;
                }
                
                // در گوتنبرگ (Block Editor)
                if (!currentTpl && window.wp && wp.data && wp.data.select('core/editor')) {
                    try {
                        currentTpl = wp.data.select('core/editor').getEditedPostAttribute('template') || '';
                    } catch(err) {}
                }

                var matchedTab = null;

                templateTabs.forEach(function(tab) {
                    var targetTpl = tab.getAttribute('data-tpl');
                    if (currentTpl && currentTpl.indexOf(targetTpl) !== -1) {
                        tab.style.display = 'inline-block';
                        matchedTab = tab;
                    } else {
                        tab.style.display = 'none';
                    }
                });

                if (noticeBox) {
                    noticeBox.style.display = matchedTab ? 'none' : 'block';
                }

                // اگر تب فعلی ناپدید شده، به تب هیرو بازگردیم
                var activeTabBtn = tabsContainer.querySelector('.royesh-tab-item.active');
                if (activeTabBtn && activeTabBtn.style.display === 'none') {
                    switchTab('tab-hero');
                }
            }

            filterTabsByTemplate();

            // لیسنر تغییر قالب در کلاسیک
            var tplDropdown = document.getElementById('page_template');
            if (tplDropdown) {
                tplDropdown.addEventListener('change', filterTabsByTemplate);
            }

            // لیسنر تغییر قالب در گوتنبرگ
            if (window.wp && wp.data && wp.data.subscribe) {
                var lastTemplate = '';
                wp.data.subscribe(function() {
                    try {
                        var newTemplate = wp.data.select('core/editor').getEditedPostAttribute('template');
                        if (newTemplate !== lastTemplate) {
                            lastTemplate = newTemplate;
                            filterTabsByTemplate();
                        }
                    } catch(e) {}
                });
            }
        }

        if (document.readyState === 'loading') {
            document.addEventListener('DOMContentLoaded', initRoyeshMetabox);
        } else {
            initRoyeshMetabox();
        }
    })();
    </script>
    <?php
}

/**
 * ذخیره‌سازی مقادیر متا با ایمن‌سازی دقیق و Nonce
 */
function royesh_save_page_metabox_data($post_id) {
    if (!isset($_POST['royesh_page_meta_nonce']) || !wp_verify_nonce($_POST['royesh_page_meta_nonce'], 'royesh_page_meta_nonce_action')) {
        return;
    }

    if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) {
        return;
    }

    if (!current_user_can('edit_page', $post_id)) {
        return;
    }

    // لیست فیلدهای متنی ساده
    $text_fields = [
        'royesh_hero_badge'     => '_royesh_hero_badge',
        'royesh_hero_title'     => '_royesh_hero_title',
        'royesh_hero_bg_color'  => '_royesh_hero_bg_color',
        'royesh_about_sticky'   => '_royesh_about_sticky',
        'royesh_val_title'      => '_royesh_val_title',
        'royesh_val_1_title'    => '_royesh_val_1_title',
        'royesh_val_2_title'    => '_royesh_val_2_title',
        'royesh_val_3_title'    => '_royesh_val_3_title',
        'royesh_tl_title'       => '_royesh_tl_title',
        'royesh_tl_1_year'      => '_royesh_tl_1_year',
        'royesh_tl_1_title'     => '_royesh_tl_1_title',
        'royesh_tl_2_year'      => '_royesh_tl_2_year',
        'royesh_tl_2_title'     => '_royesh_tl_2_title',
        'royesh_tl_3_year'      => '_royesh_tl_3_year',
        'royesh_tl_3_title'     => '_royesh_tl_3_title',
        'royesh_srv_1_badge'    => '_royesh_srv_1_badge',
        'royesh_srv_1_title'    => '_royesh_srv_1_title',
        'royesh_srv_1_btn'      => '_royesh_srv_1_btn',
        'royesh_srv_2_badge'    => '_royesh_srv_2_badge',
        'royesh_srv_2_title'    => '_royesh_srv_2_title',
        'royesh_srv_2_btn'      => '_royesh_srv_2_btn',
        'royesh_srv_3_badge'    => '_royesh_srv_3_badge',
        'royesh_srv_3_title'    => '_royesh_srv_3_title',
        'royesh_srv_3_btn'      => '_royesh_srv_3_btn',
        'royesh_srv_4_badge'    => '_royesh_srv_4_badge',
        'royesh_srv_4_title'    => '_royesh_srv_4_title',
        'royesh_srv_4_btn'      => '_royesh_srv_4_btn',
        'royesh_cnt_form_title' => '_royesh_cnt_form_title',
        'royesh_cnt_form_btn'   => '_royesh_cnt_form_btn',
        'royesh_cnt_phone_ovr'  => '_royesh_cnt_phone_ovr',
        'royesh_cns_btn_text'   => '_royesh_cns_btn_text',
        'royesh_cns_side_badge' => '_royesh_cns_side_badge',
        'royesh_cns_side_title' => '_royesh_cns_side_title',
        'royesh_cns_feat_1_t'   => '_royesh_cns_feat_1_t',
        'royesh_cns_feat_2_t'   => '_royesh_cns_feat_2_t',
    ];

    foreach ($text_fields as $post_key => $meta_key) {
        if (isset($_POST[$post_key])) {
            update_post_meta($post_id, $meta_key, sanitize_text_field($_POST[$post_key]));
        }
    }

    // فیلدهای ایمیل
    if (isset($_POST['royesh_cnt_email_ovr'])) {
        update_post_meta($post_id, '_royesh_cnt_email_ovr', sanitize_email($_POST['royesh_cnt_email_ovr']));
    }

    // فیلدهای چندخطی (Textarea)
    $textarea_fields = [
        'royesh_hero_desc'      => '_royesh_hero_desc',
        'royesh_about_p1'       => '_royesh_about_p1',
        'royesh_about_p2'       => '_royesh_about_p2',
        'royesh_val_1_desc'     => '_royesh_val_1_desc',
        'royesh_val_2_desc'     => '_royesh_val_2_desc',
        'royesh_val_3_desc'     => '_royesh_val_3_desc',
        'royesh_tl_1_desc'      => '_royesh_tl_1_desc',
        'royesh_tl_2_desc'      => '_royesh_tl_2_desc',
        'royesh_tl_3_desc'      => '_royesh_tl_3_desc',
        'royesh_srv_1_desc'     => '_royesh_srv_1_desc',
        'royesh_srv_1_bullets'  => '_royesh_srv_1_bullets',
        'royesh_srv_2_desc'     => '_royesh_srv_2_desc',
        'royesh_srv_2_bullets'  => '_royesh_srv_2_bullets',
        'royesh_srv_3_desc'     => '_royesh_srv_3_desc',
        'royesh_srv_3_bullets'  => '_royesh_srv_3_bullets',
        'royesh_srv_4_desc'     => '_royesh_srv_4_desc',
        'royesh_srv_4_bullets'  => '_royesh_srv_4_bullets',
        'royesh_cnt_addr_ovr'   => '_royesh_cnt_addr_ovr',
        'royesh_cns_side_desc'  => '_royesh_cns_side_desc',
        'royesh_cns_feat_1_d'   => '_royesh_cns_feat_1_d',
        'royesh_cns_feat_2_d'   => '_royesh_cns_feat_2_d',
    ];

    foreach ($textarea_fields as $post_key => $meta_key) {
        if (isset($_POST[$post_key])) {
            update_post_meta($post_id, $meta_key, sanitize_textarea_field($_POST[$post_key]));
        }
    }

    // چک‌باکس فعال‌سازی هیرو
    $hero_enabled = isset($_POST['royesh_hero_enable']) ? '1' : '0';
    update_post_meta($post_id, '_royesh_hero_enable', $hero_enabled);
}
add_action('save_post_page', 'royesh_save_page_metabox_data');
