<?php
/**
 * Customizer API — Full Granular Front Page Controls v2.0
 *
 * @package Royesh
 * @version 2.0.0
 */

if (!defined('ABSPATH')) {
    exit;
}

/**
 * ثبت همه تنظیمات و کنترل‌های سفارشی‌ساز
 */
function royesh_customize_register($wp_customize) {
    require_once ROYESH_THEME_DIR . '/includes/customizer-controls.php';

    // =========================================================================
    // ۱. تنظیمات هدر (Header)
    // =========================================================================
    $wp_customize->add_panel('royesh_header_panel', [
        'title'       => __('تنظیمات هدر (Header)', 'royesh'),
        'description' => __('مدیریت نوار بالا، لوگو، و استایل‌های هدر', 'royesh'),
        'priority'    => 30,
    ]);

    // نوار بالا (Topbar)
    $wp_customize->add_section('royesh_header_topbar', [
        'title'    => __('نوار بالا (Topbar)', 'royesh'),
        'panel'    => 'royesh_header_panel',
        'priority' => 10,
    ]);
    $wp_customize->add_setting('royesh_topbar_promo', ['default' => 'آینده مالی کسب‌و‌کارتان را هوشمندانه طراحی می‌کنیم!', 'sanitize_callback' => 'sanitize_text_field', 'transport' => 'refresh']);
    $wp_customize->add_setting('royesh_phone', ['default' => '۰۲۱ ۵۵۵ ۸۴۶۵', 'sanitize_callback' => 'sanitize_text_field', 'transport' => 'refresh']);
    $wp_customize->add_setting('royesh_email', ['default' => 'info@royeshcapital.com', 'sanitize_callback' => 'sanitize_email', 'transport' => 'refresh']);
    $wp_customize->add_setting('royesh_topbar_height', ['default' => '44', 'sanitize_callback' => 'absint', 'transport' => 'refresh']);

    $wp_customize->add_control(new Royesh_Group_Control($wp_customize, 'royesh_topbar_group', [
        'label'      => __('محتوای نوار بالا', 'royesh'),
        'section'    => 'royesh_header_topbar',
        'group_icon' => '📣',
        'open'       => true,
        'fields'     => [
            ['setting' => 'royesh_topbar_height', 'label' => 'ارتفاع نوار بالا (پیکسل)', 'type' => 'number', 'min' => 28, 'max' => 90, 'step' => 1],
            ['setting' => 'royesh_topbar_promo', 'label' => 'متن تبلیغاتی', 'type' => 'text'],
            ['setting' => 'royesh_phone', 'label' => 'شماره تلفن', 'type' => 'text'],
            ['setting' => 'royesh_email', 'label' => 'آدرس ایمیل', 'type' => 'email'],
        ]
    ]));

    // لوگو هدر
    $wp_customize->add_section('royesh_header_logo', [
        'title'    => __('لوگو', 'royesh'),
        'panel'    => 'royesh_header_panel',
        'priority' => 20,
    ]);
    $wp_customize->add_setting('royesh_logo_height', ['default' => '58', 'sanitize_callback' => 'absint', 'transport' => 'refresh']);
    $wp_customize->add_control(new Royesh_Group_Control($wp_customize, 'royesh_logo_group', [
        'label'      => __('تنظیمات نمایشی', 'royesh'),
        'section'    => 'royesh_header_logo',
        'group_icon' => '🖼️',
        'open'       => true,
        'fields'     => [
            ['setting' => 'royesh_logo_height', 'label' => 'حداکثر ارتفاع لوگو (پیکسل)', 'type' => 'number', 'min' => 20, 'max' => 150, 'step' => 1],
        ]
    ]));

    // =========================================================================
    // منوی ناوبری هدر (Repeater + استایل)
    // =========================================================================
    $wp_customize->add_section('royesh_header_nav', [
        'title'    => __('🧭 منوی ناوبری هدر', 'royesh'),
        'panel'    => 'royesh_header_panel',
        'priority' => 30,
    ]);

    // مقادیر پیش‌فرض آیتم‌های منو (JSON) متصل به برگه‌های وردپرس
    $default_nav_items = json_encode([
        ['label' => 'خانه',       'url' => home_url('/'),         'enabled' => true, 'icon_type' => 'img', 'icon_src' => royesh_asset_img('r-home.svg'),     'match_path' => '/'],
        ['label' => 'خدمات',      'url' => home_url('/services'), 'enabled' => true, 'icon_type' => 'img', 'icon_src' => royesh_asset_img('r-services.svg'), 'match_path' => '/services'],
        ['label' => 'اخبار',      'url' => home_url('/news'),     'enabled' => true, 'icon_type' => 'img', 'icon_src' => royesh_asset_img('r-news.svg'),     'match_path' => '/news'],
        ['label' => 'درباره ما',  'url' => home_url('/about'),    'enabled' => true, 'icon_type' => 'img', 'icon_src' => royesh_asset_img('r-about.svg'),    'match_path' => '/about'],
        ['label' => 'تماس با ما', 'url' => home_url('/contact'),  'enabled' => true, 'icon_type' => 'img', 'icon_src' => royesh_asset_img('r-contacts.svg'), 'match_path' => '/contact'],
    ], JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES);

    $wp_customize->add_setting('royesh_nav_items', [
        'default'           => $default_nav_items,
        'sanitize_callback' => 'wp_kses_post',
        'transport'         => 'refresh',
    ]);
    $wp_customize->add_control(new Royesh_Header_Nav_Repeater_Control($wp_customize, 'royesh_nav_items', [
        'label'       => __('آیتم‌های منو', 'royesh'),
        'description' => __('آیتم‌ها را اضافه، ویرایش، مرتب یا حذف کنید. برای آیکون می‌توانید آدرس عکس SVG وارد کنید یا کد SVG را مستقیم پیست کنید.', 'royesh'),
        'section'     => 'royesh_header_nav',
        'priority'    => 10,
    ]));

    // تنظیمات رنگ منوی هدر
    $wp_customize->add_setting('royesh_nav_color_normal',     ['default' => '#374151', 'sanitize_callback' => 'sanitize_hex_color', 'transport' => 'refresh']);
    $wp_customize->add_setting('royesh_nav_color_normal_icon',['default' => '#374151', 'sanitize_callback' => 'sanitize_hex_color', 'transport' => 'refresh']);
    $wp_customize->add_setting('royesh_nav_bg_normal',        ['default' => 'transparent', 'sanitize_callback' => 'sanitize_text_field', 'transport' => 'refresh']);
    $wp_customize->add_setting('royesh_nav_color_hover',      ['default' => '#014235', 'sanitize_callback' => 'sanitize_hex_color', 'transport' => 'refresh']);
    $wp_customize->add_setting('royesh_nav_color_hover_icon', ['default' => '#014235', 'sanitize_callback' => 'sanitize_hex_color', 'transport' => 'refresh']);
    $wp_customize->add_setting('royesh_nav_bg_hover',         ['default' => '#E8E2D2', 'sanitize_callback' => 'sanitize_hex_color', 'transport' => 'refresh']);
    $wp_customize->add_setting('royesh_nav_color_active',     ['default' => '#014235', 'sanitize_callback' => 'sanitize_hex_color', 'transport' => 'refresh']);
    $wp_customize->add_setting('royesh_nav_color_active_icon',['default' => '#014235', 'sanitize_callback' => 'sanitize_hex_color', 'transport' => 'refresh']);
    $wp_customize->add_setting('royesh_nav_bg_active',        ['default' => '#E8E2D2', 'sanitize_callback' => 'sanitize_hex_color', 'transport' => 'refresh']);

    $wp_customize->add_control(new Royesh_Group_Control($wp_customize, 'royesh_nav_style_normal', [
        'label'      => __('استایل عادی', 'royesh'),
        'section'    => 'royesh_header_nav',
        'group_icon' => '⬜',
        'open'       => false,
        'priority'   => 20,
        'fields'     => [
            ['setting' => 'royesh_nav_color_normal',      'label' => 'رنگ متن',        'type' => 'color'],
            ['setting' => 'royesh_nav_color_normal_icon', 'label' => 'رنگ تینت آیکون (SVG)', 'type' => 'color'],
            ['setting' => 'royesh_nav_bg_normal',         'label' => 'رنگ پس‌زمینه',  'type' => 'text',  'description' => 'مثال: transparent یا #F5F4EE'],
        ]
    ]));
    $wp_customize->add_control(new Royesh_Group_Control($wp_customize, 'royesh_nav_style_hover', [
        'label'      => __('استایل Hover', 'royesh'),
        'section'    => 'royesh_header_nav',
        'group_icon' => '🖱️',
        'open'       => false,
        'priority'   => 30,
        'fields'     => [
            ['setting' => 'royesh_nav_color_hover',      'label' => 'رنگ متن در Hover',        'type' => 'color'],
            ['setting' => 'royesh_nav_color_hover_icon', 'label' => 'رنگ تینت آیکون در Hover', 'type' => 'color'],
            ['setting' => 'royesh_nav_bg_hover',         'label' => 'رنگ پس‌زمینه در Hover',  'type' => 'color'],
        ]
    ]));
    $wp_customize->add_control(new Royesh_Group_Control($wp_customize, 'royesh_nav_style_active', [
        'label'      => __('استایل Active (صفحه فعلی)', 'royesh'),
        'section'    => 'royesh_header_nav',
        'group_icon' => '✅',
        'open'       => false,
        'priority'   => 40,
        'fields'     => [
            ['setting' => 'royesh_nav_color_active',      'label' => 'رنگ متن در Active',        'type' => 'color'],
            ['setting' => 'royesh_nav_color_active_icon', 'label' => 'رنگ تینت آیکون در Active', 'type' => 'color'],
            ['setting' => 'royesh_nav_bg_active',         'label' => 'رنگ پس‌زمینه در Active',  'type' => 'color'],
        ]
    ]));

    // =========================================================================
    // ۲. تنظیمات فوتر (Footer)
    // =========================================================================
    $wp_customize->add_panel('royesh_footer_panel', [
        'title'       => __('تنظیمات فوتر (Footer)', 'royesh'),
        'description' => __('مدیریت ستون‌ها، کپی‌رایت و شبکه‌های اجتماعی فوتر', 'royesh'),
        'priority'    => 35,
    ]);

    // ستون ۱: شناسنامه
    $wp_customize->add_section('royesh_footer_col1', [
        'title'    => __('ستون اول (شناسنامه برند)', 'royesh'),
        'panel'    => 'royesh_footer_panel',
        'priority' => 10,
    ]);
    $wp_customize->add_setting('royesh_footer_logo', ['default' => royesh_asset_img('logo-white.svg'), 'sanitize_callback' => 'esc_url_raw', 'transport' => 'refresh']);
    $wp_customize->add_control(new WP_Customize_Image_Control($wp_customize, 'royesh_footer_logo', [
        'label'      => __('آپلود لوگوی فوتر', 'royesh'),
        'section'    => 'royesh_footer_col1',
        'priority'   => 5,
    ]));
    
    $wp_customize->add_setting('royesh_footer_tagline', ['default' => 'همراه شما در مسیر رشد و نوآوری پایدار', 'sanitize_callback' => 'sanitize_text_field', 'transport' => 'refresh']);
    $wp_customize->add_setting('royesh_footer_desc', ['default' => 'موسسه رشد و نوآوری رویش با ارائه خدمات تخصصی مشاوره، شتابدهی و سرمایه‌گذاری، بستری پویا برای بالندگی کسب‌وکارهای نوپا و توسعه سازمان‌های پیشرو فراهم می‌آورد.', 'sanitize_callback' => 'sanitize_textarea_field', 'transport' => 'refresh']);
    
    $wp_customize->add_control(new Royesh_Group_Control($wp_customize, 'royesh_footer_col1_group', [
        'label'      => __('محتوای ستون اول', 'royesh'),
        'section'    => 'royesh_footer_col1',
        'group_icon' => '✍️',
        'open'       => true,
        'priority'   => 10,
        'fields'     => [
            ['setting' => 'royesh_footer_tagline', 'label' => 'شعار (Tagline)', 'type' => 'text'],
            ['setting' => 'royesh_footer_desc', 'label' => 'توضیحات کوتاه', 'type' => 'textarea'],
        ]
    ]));

    // تصویر پس‌زمینه فوتر
    $wp_customize->add_setting('royesh_footer_bg', ['default' => royesh_asset_img('fotter bg.webp'), 'sanitize_callback' => 'esc_url_raw', 'transport' => 'refresh']);
    $wp_customize->add_control(new WP_Customize_Image_Control($wp_customize, 'royesh_footer_bg', [
        'label'      => __('تصویر پس‌زمینه فوتر', 'royesh'),
        'section'    => 'royesh_footer_col1',
        'priority'   => 20,
    ]));

    // ستون ۲: منوی خدمات
    $wp_customize->add_section('royesh_footer_col2', [
        'title'    => __('ستون دوم (منوی خدمات)', 'royesh'),
        'panel'    => 'royesh_footer_panel',
        'priority' => 20,
    ]);
    // ساخت لیست منوهای موجود برای select
    $_all_menus_col2 = [];
    foreach (wp_get_nav_menus() as $_m) {
        $_all_menus_col2[$_m->term_id] = $_m->name;
    }
    $wp_customize->add_setting('royesh_footer_menu1_id', [
        'default'           => '',
        'sanitize_callback' => 'absint',
        'transport'         => 'refresh',
    ]);
    $wp_customize->add_control('royesh_footer_menu1_id', [
        'label'   => __('منوی مرتبط با ستون دوم', 'royesh'),
        'section' => 'royesh_footer_col2',
        'type'    => 'select',
        'choices' => ['' => '-- انتخاب منو --'] + $_all_menus_col2,
        'priority'=> 10,
    ]);

    // ستون ۳: منوی دسترسی سریع
    $wp_customize->add_section('royesh_footer_col3', [
        'title'    => __('ستون سوم (منوی دسترسی سریع)', 'royesh'),
        'panel'    => 'royesh_footer_panel',
        'priority' => 30,
    ]);
    $_all_menus_col3 = $_all_menus_col2; // همان لیست
    $wp_customize->add_setting('royesh_footer_menu2_id', [
        'default'           => '',
        'sanitize_callback' => 'absint',
        'transport'         => 'refresh',
    ]);
    $wp_customize->add_control('royesh_footer_menu2_id', [
        'label'   => __('منوی مرتبط با ستون سوم', 'royesh'),
        'section' => 'royesh_footer_col3',
        'type'    => 'select',
        'choices' => ['' => '-- انتخاب منو --'] + $_all_menus_col3,
        'priority'=> 10,
    ]);

    // ستون ۴: ارتباط با ما
    $wp_customize->add_section('royesh_footer_col4', [
        'title'    => __('ستون چهارم (ارتباط با ما)', 'royesh'),
        'panel'    => 'royesh_footer_panel',
        'priority' => 40,
    ]);
    $wp_customize->add_setting('royesh_address', ['default' => 'تهران، میدان ونک، خیابان ملاصدرا، پلاک ۴۲', 'sanitize_callback' => 'sanitize_text_field', 'transport' => 'refresh']);
    $wp_customize->add_setting('royesh_footer_advisor_text', ['default' => 'سوالی دارید؟ از ما بپرسید.', 'sanitize_callback' => 'sanitize_text_field', 'transport' => 'refresh']);
    $wp_customize->add_setting('royesh_footer_advisor_img', ['default' => royesh_asset_img('advisor.jpg'), 'sanitize_callback' => 'esc_url_raw', 'transport' => 'refresh']);
    $wp_customize->add_setting('royesh_footer_btn_text', ['default' => 'پیام', 'sanitize_callback' => 'sanitize_text_field', 'transport' => 'refresh']);
    $wp_customize->add_setting('royesh_footer_btn_link', ['default' => '/consultation', 'sanitize_callback' => 'esc_url_raw', 'transport' => 'refresh']);
    $wp_customize->add_setting('royesh_footer_btn_bg',   ['default' => '#ffffff', 'sanitize_callback' => 'sanitize_hex_color', 'transport' => 'refresh']);
    $wp_customize->add_setting('royesh_footer_btn_text_color', ['default' => '#000000', 'sanitize_callback' => 'sanitize_hex_color', 'transport' => 'refresh']);

    $wp_customize->add_control(new Royesh_Group_Control($wp_customize, 'royesh_footer_col4_group', [
        'label'      => __('اطلاعات تماس و ویجت مشاور', 'royesh'),
        'section'    => 'royesh_footer_col4',
        'group_icon' => '📞',
        'open'       => true,
        'priority'   => 10,
        'fields'     => [
            ['setting' => 'royesh_address', 'label' => 'آدرس', 'type' => 'textarea'],
            ['setting' => 'royesh_footer_advisor_text', 'label' => 'متن کنار آواتار', 'type' => 'text'],
        ]
    ]));
    $wp_customize->add_control(new WP_Customize_Image_Control($wp_customize, 'royesh_footer_advisor_img', [
        'label'      => __('تصویر آواتار مشاور', 'royesh'),
        'section'    => 'royesh_footer_col4',
        'priority'   => 20,
    ]));

    // گروه تنظیمات دکمه
    $wp_customize->add_control(new Royesh_Group_Control($wp_customize, 'royesh_footer_btn_group', [
        'label'      => __('دکمه (Button)', 'royesh'),
        'section'    => 'royesh_footer_col4',
        'group_icon' => '🔘',
        'open'       => false,
        'priority'   => 30,
        'fields'     => [
            ['setting' => 'royesh_footer_btn_text',       'label' => 'متن دکمه', 'type' => 'text'],
            ['setting' => 'royesh_footer_btn_link',       'label' => 'لینک دکمه', 'type' => 'url'],
            ['setting' => 'royesh_footer_btn_bg',         'label' => 'رنگ پس‌زمینه دکمه', 'type' => 'color'],
            ['setting' => 'royesh_footer_btn_text_color', 'label' => 'رنگ متن دکمه', 'type' => 'color'],
        ]
    ]));

    // نوار پایین (Bottom Bar)
    $wp_customize->add_section('royesh_footer_bottom', [
        'title'    => __('نوار پایین (کپی‌رایت و شبکه‌ها)', 'royesh'),
        'panel'    => 'royesh_footer_panel',
        'priority' => 50,
    ]);
    $wp_customize->add_setting('royesh_copyright', ['default' => 'تمامی حقوق مادی و معنوی این سایت برای موسسه رشد و نوآوری رویش محفوظ است. © ۱۴۰۵', 'sanitize_callback' => 'sanitize_text_field', 'transport' => 'refresh']);
    $wp_customize->add_setting('royesh_telegram', ['default' => '#', 'sanitize_callback' => 'esc_url_raw', 'transport' => 'refresh']);
    $wp_customize->add_setting('royesh_linkedin', ['default' => '#', 'sanitize_callback' => 'esc_url_raw', 'transport' => 'refresh']);
    $wp_customize->add_setting('royesh_instagram', ['default' => '#', 'sanitize_callback' => 'esc_url_raw', 'transport' => 'refresh']);
    $wp_customize->add_setting('royesh_whatsapp', ['default' => '#', 'sanitize_callback' => 'esc_url_raw', 'transport' => 'refresh']);

    $wp_customize->add_control(new Royesh_Group_Control($wp_customize, 'royesh_footer_bottom_group', [
        'label'      => __('تنظیمات نوار پایین', 'royesh'),
        'section'    => 'royesh_footer_bottom',
        'group_icon' => '🌐',
        'open'       => true,
        'fields'     => [
            ['setting' => 'royesh_copyright', 'label' => 'کپی‌رایت', 'type' => 'textarea'],
            ['setting' => 'royesh_telegram', 'label' => 'لینک تلگرام', 'type' => 'url'],
            ['setting' => 'royesh_linkedin', 'label' => 'لینک لینکدین', 'type' => 'url'],
            ['setting' => 'royesh_instagram', 'label' => 'لینک اینستاگرام', 'type' => 'url'],
            ['setting' => 'royesh_whatsapp', 'label' => 'لینک واتساپ', 'type' => 'url'],
        ]
    ]));


    // =========================================================================
    // ۳. تنظیمات نقشه
    // =========================================================================
    $wp_customize->add_section('royesh_map_settings', [
        'title'    => __('تنظیمات نقشه و موقعیت', 'royesh'),
        'priority' => 40,
    ]);

    $wp_customize->add_setting('royesh_map_lat', ['default' => '35.7575', 'sanitize_callback' => 'sanitize_text_field', 'transport' => 'refresh']);
    $wp_customize->add_control('royesh_map_lat', ['label' => __('عرض جغرافیایی (Latitude)', 'royesh'), 'section' => 'royesh_map_settings', 'type' => 'text']);

    $wp_customize->add_setting('royesh_map_lng', ['default' => '51.3980', 'sanitize_callback' => 'sanitize_text_field', 'transport' => 'refresh']);
    $wp_customize->add_control('royesh_map_lng', ['label' => __('طول جغرافیایی (Longitude)', 'royesh'), 'section' => 'royesh_map_settings', 'type' => 'text']);

    $wp_customize->add_setting('royesh_neshan_url', ['default' => 'https://nshn.ir', 'sanitize_callback' => 'esc_url_raw', 'transport' => 'refresh']);
    $wp_customize->add_control('royesh_neshan_url', ['label' => __('لینک نقشه نشان', 'royesh'), 'section' => 'royesh_map_settings', 'type' => 'url']);


    // =========================================================================
    // ۴. پنل صفحه اصلی با کنترل‌های جامع
    // =========================================================================
    $wp_customize->add_panel('royesh_frontpage_panel', [
        'title'       => __('صفحه اصلی رویش (تنظیم سکشن‌ها)', 'royesh'),
        'description' => __('تنظیم کامل محتوا، رنگ‌بندی، سایز و قابلیت نمایش تک‌تک بخش‌های صفحه اصلی', 'royesh'),
        'priority'    => 45,
    ]);


    // =========================================================================
    // ۴.۱ — بخش Hero و نوار متحرک
    // =========================================================================
    $wp_customize->add_section('royesh_fp_hero_section', [
        'title'    => __('🎯 هیرو (Hero) و نوار متحرک', 'royesh'),
        'panel'    => 'royesh_frontpage_panel',
        'priority' => 10,
    ]);

    // ثبت همه settings بخش Hero
    $wp_customize->add_setting('royesh_hero_enable',         ['default' => true,            'sanitize_callback' => 'royesh_sanitize_checkbox',  'transport' => 'refresh']);
    $wp_customize->add_setting('royesh_features_bar_enable', ['default' => true,            'sanitize_callback' => 'royesh_sanitize_checkbox',  'transport' => 'refresh']);
    $wp_customize->add_setting('royesh_hero_title_main',     ['default' => 'گروه اقتصادی', 'sanitize_callback' => 'sanitize_text_field',        'transport' => 'refresh']);
    $wp_customize->add_setting('royesh_hero_title_accent',   ['default' => 'رویش سرمایه',  'sanitize_callback' => 'sanitize_text_field',        'transport' => 'refresh']);
    $wp_customize->add_setting('royesh_hero_tagline',        ['default' => 'ریشـــه مالی، رشد پایدار ...', 'sanitize_callback' => 'sanitize_text_field', 'transport' => 'refresh']);
    $wp_customize->add_setting('royesh_hero_desc',           ['default' => 'گروه اقتصادی رویش سرمایه، با رویکردی راه‌حل محور و نوآورانه، در مسیر طراحی راهکارهای مالی مؤثر گام برمیدارد.', 'sanitize_callback' => 'sanitize_textarea_field', 'transport' => 'refresh']);
    $wp_customize->add_setting('royesh_hero_btn_text',       ['default' => 'درباره ما',     'sanitize_callback' => 'sanitize_text_field',        'transport' => 'refresh']);
    $wp_customize->add_setting('royesh_hero_btn_url',        ['default' => '/about',        'sanitize_callback' => 'sanitize_text_field',        'transport' => 'refresh']);
    $wp_customize->add_setting('royesh_hero_bg_color',       ['default' => '#021A15',       'sanitize_callback' => 'sanitize_hex_color',         'transport' => 'refresh']);
    $wp_customize->add_setting('royesh_hero_title_color',    ['default' => '#ffffff',       'sanitize_callback' => 'sanitize_hex_color',         'transport' => 'refresh']);
    $wp_customize->add_setting('royesh_hero_accent_color',   ['default' => '#B58A33',       'sanitize_callback' => 'sanitize_hex_color',         'transport' => 'refresh']);
    $wp_customize->add_setting('royesh_hero_desc_color',     ['default' => '#e5e7eb',       'sanitize_callback' => 'sanitize_hex_color',         'transport' => 'refresh']);
    $wp_customize->add_setting('royesh_hero_btn_bg',         ['default' => '#ffffff',       'sanitize_callback' => 'sanitize_hex_color',         'transport' => 'refresh']);
    $wp_customize->add_setting('royesh_hero_btn_color',      ['default' => '#014235',       'sanitize_callback' => 'sanitize_hex_color',         'transport' => 'refresh']);
    $wp_customize->add_setting('royesh_featbar_bg',          ['default' => '#F0EDE3',       'sanitize_callback' => 'sanitize_hex_color',         'transport' => 'refresh']);
    $wp_customize->add_setting('royesh_featbar_icon_color',  ['default' => '#B58A33',       'sanitize_callback' => 'sanitize_hex_color',         'transport' => 'refresh']);
    $wp_customize->add_setting('royesh_featbar_text_color',  ['default' => '#1f2937',       'sanitize_callback' => 'sanitize_hex_color',         'transport' => 'refresh']);
    $wp_customize->add_setting('royesh_hero_title_size_desktop', ['default' => '44', 'sanitize_callback' => 'absint', 'transport' => 'refresh']);
    $wp_customize->add_setting('royesh_hero_title_size_mobile',  ['default' => '36', 'sanitize_callback' => 'absint', 'transport' => 'refresh']);
    $wp_customize->add_setting('royesh_hero_desc_size',      ['default' => '18', 'sanitize_callback' => 'absint', 'transport' => 'refresh']);
    $wp_customize->add_setting('royesh_hero_tagline_size',   ['default' => '23', 'sanitize_callback' => 'absint', 'transport' => 'refresh']);
    $wp_customize->add_setting('royesh_featbar_text_size',   ['default' => '15', 'sanitize_callback' => 'absint', 'transport' => 'refresh']);
    $wp_customize->add_setting('royesh_featbar_marquee_speed', ['default' => '25', 'sanitize_callback' => 'absint', 'transport' => 'refresh']);

    $default_features = json_encode([
        ['text' => 'راهکارهای نوین مالی و دیجیتال', 'enabled' => true],
        ['text' => 'توسعه کسب‌وکار و نهادسازی',    'enabled' => true],
        ['text' => 'طراحی ساختار و استراتژی',        'enabled' => true],
        ['text' => 'تأمین مالی و خدمات اعتباری',     'enabled' => true],
        ['text' => 'مشاوره و مدیریت مالی',          'enabled' => true],
    ]);
    $wp_customize->add_setting('royesh_features_bar_items', [
        'default'           => $default_features,
        'sanitize_callback' => 'royesh_sanitize_features_json',
        'transport'         => 'refresh',
    ]);


    // Hero Background Image
    $wp_customize->add_setting('royesh_hero_bg_image', ['default' => royesh_asset_img('r-hero-section.jpg'), 'sanitize_callback' => 'esc_url_raw', 'transport' => 'refresh']);
    $wp_customize->add_control(new WP_Customize_Image_Control($wp_customize, 'royesh_hero_bg_image', [
        'label'      => __('تصویر پس‌زمینه هیرو', 'royesh'),
        'section'    => 'royesh_fp_hero_section',
        'priority'   => 5,
    ]));

    // ── آکاردئون ۱: نمایش / پنهان ────────────────────────────────────────────
    $wp_customize->add_control(new Royesh_Group_Control($wp_customize, 'royesh_hero_group_display', [
        'label'      => __('نمایش / پنهان', 'royesh'),
        'group_icon' => '👁',
        'section'    => 'royesh_fp_hero_section',
        'priority'   => 10,
        'open'       => true,
        'settings'   => 'royesh_hero_enable', // primary (dummy)
        'fields'     => [
            ['setting' => 'royesh_hero_enable',         'label' => 'نمایش بخش Hero', 'type' => 'checkbox', 'default' => true],
            ['setting' => 'royesh_features_bar_enable', 'label' => 'نمایش نوار ویژگی‌های متحرک', 'type' => 'checkbox', 'default' => true],
        ],
    ]));

    // ── آکاردئون ۲: محتوا و متون ─────────────────────────────────────────────
    $wp_customize->add_control(new Royesh_Group_Control($wp_customize, 'royesh_hero_group_content', [
        'label'      => __('محتوا و متون', 'royesh'),
        'group_icon' => '✏️',
        'section'    => 'royesh_fp_hero_section',
        'priority'   => 20,
        'open'       => true,
        'settings'   => 'royesh_hero_title_main',
        'fields'     => [
            ['setting' => 'royesh_hero_title_main',   'label' => 'بخش اول عنوان',         'type' => 'text',     'default' => 'گروه اقتصادی'],
            ['setting' => 'royesh_hero_title_accent', 'label' => 'بخش تاکیدی عنوان (طلایی)', 'type' => 'text',  'default' => 'رویش سرمایه'],
            ['setting' => 'royesh_hero_tagline',      'label' => 'تگ‌لاین (Pill Badge)',   'type' => 'text',     'default' => 'ریشـه مالی، رشد پایدار ...'],
            ['setting' => 'royesh_hero_desc',         'label' => 'متن توصیفی Hero',        'type' => 'textarea', 'default' => ''],
            ['setting' => 'royesh_hero_btn_text',     'label' => 'متن دکمه',               'type' => 'text',     'default' => 'درباره ما'],
            ['setting' => 'royesh_hero_btn_url',      'label' => 'لینک دکمه',              'type' => 'text',     'default' => '/about'],
        ],
    ]));

    // ── آکاردئون ۳: رنگ‌بندی Hero ────────────────────────────────────────────
    $wp_customize->add_control(new Royesh_Group_Control($wp_customize, 'royesh_hero_group_colors', [
        'label'      => __('رنگ‌بندی Hero', 'royesh'),
        'group_icon' => '🎨',
        'section'    => 'royesh_fp_hero_section',
        'priority'   => 30,
        'open'       => false,
        'settings'   => 'royesh_hero_bg_color',
        'fields'     => [
            ['setting' => 'royesh_hero_bg_color',     'label' => 'رنگ پس‌زمینه Hero',   'type' => 'color', 'default' => '#021A15'],
            ['setting' => 'royesh_hero_title_color',  'label' => 'رنگ عنوان اصلی',      'type' => 'color', 'default' => '#ffffff'],
            ['setting' => 'royesh_hero_accent_color', 'label' => 'رنگ تاکیدی (طلایی)', 'type' => 'color', 'default' => '#B58A33'],
            ['setting' => 'royesh_hero_desc_color',   'label' => 'رنگ متن توصیفی',      'type' => 'color', 'default' => '#e5e7eb'],
            ['setting' => 'royesh_hero_btn_bg',       'label' => 'رنگ پس‌زمینه دکمه',  'type' => 'color', 'default' => '#ffffff'],
            ['setting' => 'royesh_hero_btn_color',    'label' => 'رنگ متن دکمه',        'type' => 'color', 'default' => '#014235'],
        ],
    ]));

    // ── آکاردئون ۴: رنگ‌بندی نوار ویژگی‌ها ─────────────────────────────────
    $wp_customize->add_control(new Royesh_Group_Control($wp_customize, 'royesh_hero_group_featbar_colors', [
        'label'      => __('رنگ‌بندی نوار ویژگی‌ها', 'royesh'),
        'group_icon' => '🎨',
        'section'    => 'royesh_fp_hero_section',
        'priority'   => 35,
        'open'       => false,
        'settings'   => 'royesh_featbar_bg',
        'fields'     => [
            ['setting' => 'royesh_featbar_bg',         'label' => 'پس‌زمینه نوار',    'type' => 'color', 'default' => '#F0EDE3'],
            ['setting' => 'royesh_featbar_icon_color', 'label' => 'رنگ آیکون‌ها',     'type' => 'color', 'default' => '#B58A33'],
            ['setting' => 'royesh_featbar_text_color', 'label' => 'رنگ متن آیتم‌ها',  'type' => 'color', 'default' => '#1f2937'],
        ],
    ]));

    // ── آکاردئون ۵: تایپوگرافی و سایز ──────────────────────────────────────
    $wp_customize->add_control(new Royesh_Group_Control($wp_customize, 'royesh_hero_group_typo', [
        'label'      => __('تایپوگرافی و سایز فونت', 'royesh'),
        'group_icon' => '🔤',
        'section'    => 'royesh_fp_hero_section',
        'priority'   => 40,
        'open'       => false,
        'settings'   => 'royesh_hero_title_size_desktop',
        'fields'     => [
            ['setting' => 'royesh_hero_title_size_desktop', 'label' => 'سایز عنوان — دسکتاپ', 'type' => 'range', 'default' => '44', 'min' => 24, 'max' => 80, 'step' => 2, 'unit' => 'px'],
            ['setting' => 'royesh_hero_title_size_mobile',  'label' => 'سایز عنوان — موبایل',  'type' => 'range', 'default' => '36', 'min' => 20, 'max' => 56, 'step' => 2, 'unit' => 'px'],
            ['setting' => 'royesh_hero_desc_size',          'label' => 'سایز متن توصیفی',      'type' => 'range', 'default' => '18', 'min' => 12, 'max' => 28, 'step' => 1, 'unit' => 'px'],
            ['setting' => 'royesh_hero_tagline_size',       'label' => 'سایز تگ‌لاین',         'type' => 'range', 'default' => '23', 'min' => 12, 'max' => 36, 'step' => 1, 'unit' => 'px'],
            ['setting' => 'royesh_featbar_text_size',       'label' => 'سایز متن نوار ویژگی',  'type' => 'range', 'default' => '15', 'min' => 11, 'max' => 22, 'step' => 1, 'unit' => 'px'],
        ],
    ]));

    // ── آکاردئون ۶: آیتم‌های نوار ویژگی‌ها (Repeater) ──────────────────────
    $wp_customize->add_control(new Royesh_Features_Repeater_Control($wp_customize, 'royesh_features_bar_items', [
        'label'       => __('آیتم‌های نوار متحرک', 'royesh'),
        'description' => __('درگ کنید برای جابه‌جایی ترتیب. تیک برای نمایش/پنهان. + برای افزودن.', 'royesh'),
        'section'     => 'royesh_fp_hero_section',
        'priority'    => 50,
    ]));

    // ── آکاردئون ۷: تنظیمات حرکت نوار ──────────────────────────────────────
    $wp_customize->add_control(new Royesh_Group_Control($wp_customize, 'royesh_hero_group_featbar_motion', [
        'label'      => __('تنظیمات حرکت نوار', 'royesh'),
        'group_icon' => '⚡',
        'section'    => 'royesh_fp_hero_section',
        'priority'   => 55,
        'open'       => false,
        'settings'   => 'royesh_featbar_marquee_speed',
        'fields'     => [
            ['setting' => 'royesh_featbar_marquee_speed', 'label' => 'سرعت حرکت (کمتر = تندتر)', 'type' => 'range', 'default' => '25', 'min' => 5, 'max' => 60, 'step' => 5, 'unit' => 'ثانیه'],
        ],
    ]));


    // =========================================================================
    // ۴.۲ حوزه‌های خلق ارزش
    // =========================================================================
    $wp_customize->add_section('royesh_fp_value_section', [
        'title'    => __('💎 حوزه‌های خلق ارزش', 'royesh'),
        'panel'    => 'royesh_frontpage_panel',
        'priority' => 20,
    ]);

    $wp_customize->add_setting('royesh_value_enable', ['default' => true, 'sanitize_callback' => 'royesh_sanitize_checkbox', 'transport' => 'refresh']);
    $wp_customize->add_setting('royesh_value_badge',  ['default' => 'مسیرهای ارزش‌آفرینی', 'sanitize_callback' => 'sanitize_text_field', 'transport' => 'refresh']);
    $wp_customize->add_setting('royesh_value_title_start',  ['default' => 'ما چگونه', 'sanitize_callback' => 'sanitize_text_field', 'transport' => 'refresh']);
    $wp_customize->add_setting('royesh_value_title_accent', ['default' => 'ارزش‌آفرینی', 'sanitize_callback' => 'sanitize_text_field', 'transport' => 'refresh']);
    $wp_customize->add_setting('royesh_value_title_end',    ['default' => 'می‌کنیم؟', 'sanitize_callback' => 'sanitize_text_field', 'transport' => 'refresh']);
    $wp_customize->add_setting('royesh_value_desc',   ['default' => 'رویش ســــــــــرمایه با تمرکز بر حل نظام‌مند مسائل مالی، طراحی ساختارهای کارآمد و توسعه راهکارهای نــــــــوآورانه، به دنبال خلق ارزش پایدار برای ذینفعان و ارتقای کارایی اکوسیستم مالی است.', 'sanitize_callback' => 'sanitize_textarea_field', 'transport' => 'refresh']);
    
    // Colors
    $wp_customize->add_setting('royesh_value_bg_color',       ['default' => '#FBFBFA', 'sanitize_callback' => 'sanitize_hex_color', 'transport' => 'refresh']);
    $wp_customize->add_setting('royesh_value_title_color',    ['default' => '#111111', 'sanitize_callback' => 'sanitize_hex_color', 'transport' => 'refresh']);
    $wp_customize->add_setting('royesh_value_accent_color',   ['default' => '#B58A33', 'sanitize_callback' => 'sanitize_hex_color', 'transport' => 'refresh']);
    $wp_customize->add_setting('royesh_value_desc_color',     ['default' => '#4b5563', 'sanitize_callback' => 'sanitize_hex_color', 'transport' => 'refresh']);
    $wp_customize->add_setting('royesh_value_card_bg',        ['default' => '#FAF8F4', 'sanitize_callback' => 'sanitize_hex_color', 'transport' => 'refresh']);
    $wp_customize->add_setting('royesh_value_card_hover_bg',  ['default' => '#B1862D', 'sanitize_callback' => 'sanitize_hex_color', 'transport' => 'refresh']);
    $wp_customize->add_setting('royesh_value_icon_bg',        ['default' => '#014235', 'sanitize_callback' => 'sanitize_hex_color', 'transport' => 'refresh']);
    
    // Typography
    $wp_customize->add_setting('royesh_value_title_size_desktop', ['default' => '36', 'sanitize_callback' => 'absint', 'transport' => 'refresh']);
    $wp_customize->add_setting('royesh_value_title_size_mobile',  ['default' => '30', 'sanitize_callback' => 'absint', 'transport' => 'refresh']);
    
    // Card 1
    $wp_customize->add_setting('royesh_val_c1_title', ['default' => 'راه حل محوری', 'sanitize_callback' => 'sanitize_text_field', 'transport' => 'refresh']);
    $wp_customize->add_setting('royesh_val_c1_desc',  ['default' => 'حل مسائل مالی با نگاه ساختاری', 'sanitize_callback' => 'sanitize_text_field', 'transport' => 'refresh']);
    // Card 2
    $wp_customize->add_setting('royesh_val_c2_title', ['default' => 'نهادسازی تخصصی', 'sanitize_callback' => 'sanitize_text_field', 'transport' => 'refresh']);
    $wp_customize->add_setting('royesh_val_c2_desc',  ['default' => 'توسعه ساختارهای مالی پایدار', 'sanitize_callback' => 'sanitize_text_field', 'transport' => 'refresh']);
    // Card 3
    $wp_customize->add_setting('royesh_val_c3_title', ['default' => 'نوآوری مالی', 'sanitize_callback' => 'sanitize_text_field', 'transport' => 'refresh']);
    $wp_customize->add_setting('royesh_val_c3_desc',  ['default' => 'طراحی مدل‌های نوین کسب‌وکار', 'sanitize_callback' => 'sanitize_text_field', 'transport' => 'refresh']);
    // Card 4
    $wp_customize->add_setting('royesh_val_c4_title', ['default' => 'مسئولیت‌پذیری حرفه‌ای', 'sanitize_callback' => 'sanitize_text_field', 'transport' => 'refresh']);
    $wp_customize->add_setting('royesh_val_c4_desc',  ['default' => 'تعهد به رازداری و انضباط حرفه‌ای', 'sanitize_callback' => 'sanitize_text_field', 'transport' => 'refresh']);



    $wp_customize->add_setting('royesh_value_desc_size',  ['default' => '15', 'sanitize_callback' => 'absint', 'transport' => 'refresh']);

    $wp_customize->add_setting('royesh_value_video_poster', ['default' => royesh_asset_img('value-creation-1.jpg'), 'sanitize_callback' => 'esc_url_raw', 'transport' => 'refresh']);
    $wp_customize->add_control(new WP_Customize_Image_Control($wp_customize, 'royesh_value_video_poster', [
        'label'      => __('تصویر کاور ویدیو (Poster)', 'royesh'),
        'section'    => 'royesh_fp_value_section',
        'priority'   => 5,
    ]));

    $wp_customize->add_setting('royesh_value_img_1', ['default' => royesh_asset_img('value-creation-1.jpg'), 'sanitize_callback' => 'esc_url_raw', 'transport' => 'refresh']);
    $wp_customize->add_control(new WP_Customize_Image_Control($wp_customize, 'royesh_value_img_1', [
        'label'      => __('تصویر بالا (کلاژ)', 'royesh'),
        'section'    => 'royesh_fp_value_section',
        'priority'   => 6,
    ]));

    $wp_customize->add_setting('royesh_value_img_2', ['default' => royesh_asset_img('value-creation-2.jpg'), 'sanitize_callback' => 'esc_url_raw', 'transport' => 'refresh']);
    $wp_customize->add_control(new WP_Customize_Image_Control($wp_customize, 'royesh_value_img_2', [
        'label'      => __('تصویر میانی (کلاژ)', 'royesh'),
        'section'    => 'royesh_fp_value_section',
        'priority'   => 7,
    ]));

    $wp_customize->add_setting('royesh_value_video_url', ['default' => '', 'sanitize_callback' => 'esc_url_raw', 'transport' => 'refresh']);
    $wp_customize->add_control(new WP_Customize_Upload_Control($wp_customize, 'royesh_value_video_url', [
        'label'      => __('فایل ویدیو (MP4)', 'royesh'),
        'section'    => 'royesh_fp_value_section',
        'priority'   => 6,
    ]));

    $wp_customize->add_control(new Royesh_Group_Control($wp_customize, 'royesh_value_group_display', [
        'label'      => __('نمایش / پنهان', 'royesh'),
        'group_icon' => '👁',
        'section'    => 'royesh_fp_value_section',
        'priority'   => 10,
        'open'       => true,
        'settings'   => 'royesh_value_enable',
        'fields'     => [
            ['setting' => 'royesh_value_enable', 'label' => 'نمایش سکشن حوزه‌های خلق ارزش', 'type' => 'checkbox', 'default' => true],
        ],
    ]));

    $wp_customize->add_control(new Royesh_Group_Control($wp_customize, 'royesh_value_group_content', [
        'label'      => __('محتوا و تیترها', 'royesh'),
        'group_icon' => '✏️',
        'section'    => 'royesh_fp_value_section',
        'priority'   => 20,
        'open'       => false,
        'settings'   => 'royesh_value_title_start',
        'fields'     => [
            ['setting' => 'royesh_value_badge', 'label' => 'بج / برچسب بالا', 'type' => 'text', 'default' => 'مسیرهای ارزش‌آفرینی'],
            ['setting' => 'royesh_value_title_start', 'label' => 'بخش اول تیتر',  'type' => 'text', 'default' => 'ما چگونه'],
            ['setting' => 'royesh_value_title_accent', 'label' => 'کلمه تاکیدی',  'type' => 'text', 'default' => 'ارزش‌آفرینی'],
            ['setting' => 'royesh_value_title_end', 'label' => 'بخش پایانی تیتر',  'type' => 'text', 'default' => 'می‌کنیم؟'],
            ['setting' => 'royesh_value_desc',  'label' => 'متن توضیحات',     'type' => 'textarea', 'default' => ''],
        ],
    ]));

    $wp_customize->add_control(new Royesh_Group_Control($wp_customize, 'royesh_value_group_cards', [
        'label'      => __('محتوای کارت‌ها (۴ مورد)', 'royesh'),
        'group_icon' => '🗂️',
        'section'    => 'royesh_fp_value_section',
        'priority'   => 30,
        'open'       => false,
        'settings'   => 'royesh_val_c1_title',
        'fields'     => [
            ['setting' => 'royesh_val_c1_title', 'label' => 'کارت ۱ - عنوان', 'type' => 'text', 'default' => 'راه حل محوری'],
            ['setting' => 'royesh_val_c1_desc',  'label' => 'کارت ۱ - توضیحات', 'type' => 'textarea', 'default' => 'حل مسائل مالی با نگاه ساختاری'],
            ['setting' => 'royesh_val_c2_title', 'label' => 'کارت ۲ - عنوان', 'type' => 'text', 'default' => 'نهادسازی تخصصی'],
            ['setting' => 'royesh_val_c2_desc',  'label' => 'کارت ۲ - توضیحات', 'type' => 'textarea', 'default' => 'توسعه ساختارهای مالی پایدار'],
            ['setting' => 'royesh_val_c3_title', 'label' => 'کارت ۳ - عنوان', 'type' => 'text', 'default' => 'نوآوری مالی'],
            ['setting' => 'royesh_val_c3_desc',  'label' => 'کارت ۳ - توضیحات', 'type' => 'textarea', 'default' => 'طراحی مدل‌های نوین کسب‌وکار'],
            ['setting' => 'royesh_val_c4_title', 'label' => 'کارت ۴ - عنوان', 'type' => 'text', 'default' => 'مسئولیت‌پذیری حرفه‌ای'],
            ['setting' => 'royesh_val_c4_desc',  'label' => 'کارت ۴ - توضیحات', 'type' => 'textarea', 'default' => 'تعهد به رازداری و انضباط حرفه‌ای'],
        ],
    ]));

    $wp_customize->add_control(new Royesh_Group_Control($wp_customize, 'royesh_value_group_colors', [
        'label'      => __('رنگ‌بندی سکشن و کارت‌ها', 'royesh'),
        'group_icon' => '🎨',
        'section'    => 'royesh_fp_value_section',
        'priority'   => 40,
        'open'       => false,
        'settings'   => 'royesh_value_bg_color',
        'fields'     => [
            ['setting' => 'royesh_value_bg_color',       'label' => 'پس‌زمینه سکشن',      'type' => 'color', 'default' => '#FBFBFA'],
            ['setting' => 'royesh_value_title_color',    'label' => 'رنگ عنوان اصلی',     'type' => 'color', 'default' => '#111111'],
            ['setting' => 'royesh_value_accent_color',   'label' => 'رنگ کلمه تاکیدی',    'type' => 'color', 'default' => '#014235'],
            ['setting' => 'royesh_value_desc_color',     'label' => 'رنگ متون و توضیحات',  'type' => 'color', 'default' => '#4b5563'],
            ['setting' => 'royesh_value_card_bg',        'label' => 'پس‌زمینه کارت',      'type' => 'color', 'default' => '#F8F9FA'],
            ['setting' => 'royesh_value_card_hover_bg',  'label' => 'پس‌زمینه کارت (هاور)', 'type' => 'color', 'default' => '#FAF8F4'],
            ['setting' => 'royesh_value_icon_bg',        'label' => 'پس‌زمینه آیکون',     'type' => 'color', 'default' => '#014235'],
        ],
    ]));

    $wp_customize->add_control(new Royesh_Group_Control($wp_customize, 'royesh_value_group_typo', [
        'label'      => __('تایپوگرافی و سایز', 'royesh'),
        'group_icon' => '🔤',
        'section'    => 'royesh_fp_value_section',
        'priority'   => 50,
        'open'       => false,
        
        'settings'   => 'royesh_value_title_size_desktop',
        'fields'     => [
            ['setting' => 'royesh_value_title_size_desktop', 'label' => 'سایز عنوان — دسکتاپ', 'type' => 'range', 'default' => '36', 'min' => 20, 'max' => 60, 'step' => 2, 'unit' => 'px'],
            ['setting' => 'royesh_value_title_size_mobile',  'label' => 'سایز عنوان — موبایل',  'type' => 'range', 'default' => '30', 'min' => 16, 'max' => 48, 'step' => 2, 'unit' => 'px'],
            ['setting' => 'royesh_value_desc_size',          'label' => 'سایز توضیحات',        'type' => 'range', 'default' => '15', 'min' => 12, 'max' => 24, 'step' => 1, 'unit' => 'px'],
        ],

    ]));



    // =========================================================================
    // ۴.۳ خدمات محوری
    // =========================================================================
    $wp_customize->add_section('royesh_fp_services_section', [
        'title'    => __('🛠 خدمات محوری رویش', 'royesh'),
        'panel'    => 'royesh_frontpage_panel',
        'priority' => 30,
    ]);

    $wp_customize->add_setting('royesh_services_enable', ['default' => true, 'sanitize_callback' => 'royesh_sanitize_checkbox', 'transport' => 'refresh']);
    $wp_customize->add_setting('royesh_services_title',  ['default' => 'خدمات ما', 'sanitize_callback' => 'sanitize_text_field', 'transport' => 'refresh']);
    $wp_customize->add_setting('royesh_services_desc',   ['default' => 'ارائه راهکارهای تخصصی متناسب با نیازهای نهادها و فعالان اقتصادی', 'sanitize_callback' => 'sanitize_textarea_field', 'transport' => 'refresh']);

    // Colors
    $wp_customize->add_setting('royesh_serv_bg_color',       ['default' => '#004F40', 'sanitize_callback' => 'sanitize_hex_color', 'transport' => 'refresh']);
    $wp_customize->add_setting('royesh_serv_title_color',    ['default' => '#ffffff', 'sanitize_callback' => 'sanitize_hex_color', 'transport' => 'refresh']);
    $wp_customize->add_setting('royesh_serv_desc_color',     ['default' => '#cccccc', 'sanitize_callback' => 'sanitize_hex_color', 'transport' => 'refresh']);
    $wp_customize->add_setting('royesh_serv_card_bg',        ['default' => '#082C23', 'sanitize_callback' => 'sanitize_hex_color', 'transport' => 'refresh']);
    $wp_customize->add_setting('royesh_serv_card_border',    ['default' => '#2E7063', 'sanitize_callback' => 'sanitize_hex_color', 'transport' => 'refresh']);
    $wp_customize->add_setting('royesh_serv_card_hover',     ['default' => '#B1862D', 'sanitize_callback' => 'sanitize_hex_color', 'transport' => 'refresh']);
    $wp_customize->add_setting('royesh_serv_btn_primary',    ['default' => '#B1862D', 'sanitize_callback' => 'sanitize_hex_color', 'transport' => 'refresh']);
    $wp_customize->add_setting('royesh_serv_btn_secondary',  ['default' => '#004F40', 'sanitize_callback' => 'sanitize_hex_color', 'transport' => 'refresh']);

    // Typography
    $wp_customize->add_setting('royesh_serv_title_size_dt',  ['default' => '36', 'sanitize_callback' => 'absint', 'transport' => 'refresh']);
    $wp_customize->add_setting('royesh_serv_title_size_mb',  ['default' => '30', 'sanitize_callback' => 'absint', 'transport' => 'refresh']);
    
    // Cards Content (1 to 4)
    $services_default_url = function_exists('royesh_page_url') ? royesh_page_url('services') : home_url('/services');

    // Card 1
    $wp_customize->add_setting('royesh_serv_c1_title', ['default' => 'خدمات تأمین مالی', 'sanitize_callback' => 'sanitize_text_field', 'transport' => 'refresh']);
    $wp_customize->add_setting('royesh_serv_c1_desc',  ['default' => 'طراحی و ارائـــــــه راهکارهای تأمین منابع مالی متناسب با ساختار و نــــیاز کسب‌وکارها.', 'sanitize_callback' => 'sanitize_textarea_field', 'transport' => 'refresh']);
    $wp_customize->add_setting('royesh_serv_c1_link',  ['default' => $services_default_url . '#financing-services', 'sanitize_callback' => 'sanitize_text_field', 'transport' => 'refresh']);
    // Card 2
    $wp_customize->add_setting('royesh_serv_c2_title', ['default' => 'خدمات اعتباری', 'sanitize_callback' => 'sanitize_text_field', 'transport' => 'refresh']);
    $wp_customize->add_setting('royesh_serv_c2_desc',  ['default' => 'طراحی سازوکارهای اعتباری، ارزیابی ظرفیت‌ها و توســعه راهکارهای اعتباری مؤثـــــــر.', 'sanitize_callback' => 'sanitize_textarea_field', 'transport' => 'refresh']);
    $wp_customize->add_setting('royesh_serv_c2_link',  ['default' => $services_default_url . '#credit-services', 'sanitize_callback' => 'sanitize_text_field', 'transport' => 'refresh']);
    // Card 3
    $wp_customize->add_setting('royesh_serv_c3_title', ['default' => 'مدیریت نقدینگی', 'sanitize_callback' => 'sanitize_text_field', 'transport' => 'refresh']);
    $wp_customize->add_setting('royesh_serv_c3_desc',  ['default' => 'ارزیـــــابی، ساخـــــــتاردهی و مدیریت داراییهــا با رویکرد خلق ارزش پایدار.', 'sanitize_callback' => 'sanitize_textarea_field', 'transport' => 'refresh']);
    $wp_customize->add_setting('royesh_serv_c3_link',  ['default' => $services_default_url . '#liquidity-management', 'sanitize_callback' => 'sanitize_text_field', 'transport' => 'refresh']);
    // Card 4
    $wp_customize->add_setting('royesh_serv_c4_title', ['default' => 'مدیریت دارایی', 'sanitize_callback' => 'sanitize_text_field', 'transport' => 'refresh']);
    $wp_customize->add_setting('royesh_serv_c4_desc',  ['default' => 'ارزیـــــابی، ساخـــــــتاردهی و مدیریت داراییهــا با رویکرد خلق ارزش پایدار.', 'sanitize_callback' => 'sanitize_textarea_field', 'transport' => 'refresh']);
    $wp_customize->add_setting('royesh_serv_c4_link',  ['default' => $services_default_url . '#asset-management', 'sanitize_callback' => 'sanitize_text_field', 'transport' => 'refresh']);



    $wp_customize->add_setting('royesh_services_desc_size',  ['default' => '15', 'sanitize_callback' => 'absint', 'transport' => 'refresh']);
    $wp_customize->add_control(new Royesh_Group_Control($wp_customize, 'royesh_services_group_display', [
        'label'      => __('نمایش / پنهان', 'royesh'),
        'group_icon' => '👁',
        'section'    => 'royesh_fp_services_section',
        'priority'   => 10,
        'open'       => true,
        'settings'   => 'royesh_services_enable',
        'fields'     => [
            ['setting' => 'royesh_services_enable', 'label' => 'نمایش سکشن خدمات', 'type' => 'checkbox', 'default' => true],
        ],
    ]));

    $wp_customize->add_control(new Royesh_Group_Control($wp_customize, 'royesh_services_group_content', [
        'label'      => __('محتوا و تیترها', 'royesh'),
        'group_icon' => '✏️',
        'section'    => 'royesh_fp_services_section',
        'priority'   => 20,
        'open'       => false,
        'settings'   => 'royesh_services_title',
        'fields'     => [
            ['setting' => 'royesh_services_title', 'label' => 'تیتر اصلی سکشن',  'type' => 'text', 'default' => 'خدمات ما'],
            ['setting' => 'royesh_services_desc',  'label' => 'متن توضیحات',     'type' => 'textarea', 'default' => ''],
        ],
    ]));

    $wp_customize->add_control(new Royesh_Group_Control($wp_customize, 'royesh_services_group_cards', [
        'label'      => __('محتوای کارت‌ها (۴ مورد)', 'royesh'),
        'group_icon' => '🗂️',
        'section'    => 'royesh_fp_services_section',
        'priority'   => 30,
        'open'       => false,
        'settings'   => 'royesh_serv_c1_title',
        'fields'     => [
            ['setting' => 'royesh_serv_c1_title', 'label' => 'کارت ۱ - عنوان', 'type' => 'text', 'default' => 'خدمات تأمین مالی'],
            ['setting' => 'royesh_serv_c1_desc',  'label' => 'کارت ۱ - توضیحات', 'type' => 'textarea', 'default' => ''],
            ['setting' => 'royesh_serv_c1_link',  'label' => 'کارت ۱ - لینک', 'type' => 'text', 'default' => ''],
            
            ['setting' => 'royesh_serv_c2_title', 'label' => 'کارت ۲ - عنوان', 'type' => 'text', 'default' => 'خدمات اعتباری'],
            ['setting' => 'royesh_serv_c2_desc',  'label' => 'کارت ۲ - توضیحات', 'type' => 'textarea', 'default' => ''],
            ['setting' => 'royesh_serv_c2_link',  'label' => 'کارت ۲ - لینک', 'type' => 'text', 'default' => ''],
            
            ['setting' => 'royesh_serv_c3_title', 'label' => 'کارت ۳ - عنوان', 'type' => 'text', 'default' => 'مدیریت نقدینگی'],
            ['setting' => 'royesh_serv_c3_desc',  'label' => 'کارت ۳ - توضیحات', 'type' => 'textarea', 'default' => ''],
            ['setting' => 'royesh_serv_c3_link',  'label' => 'کارت ۳ - لینک', 'type' => 'text', 'default' => ''],
            
            ['setting' => 'royesh_serv_c4_title', 'label' => 'کارت ۴ - عنوان', 'type' => 'text', 'default' => 'مدیریت دارایی'],
            ['setting' => 'royesh_serv_c4_desc',  'label' => 'کارت ۴ - توضیحات', 'type' => 'textarea', 'default' => ''],
            ['setting' => 'royesh_serv_c4_link',  'label' => 'کارت ۴ - لینک', 'type' => 'text', 'default' => ''],
        ],
    ]));

    $wp_customize->add_control(new Royesh_Group_Control($wp_customize, 'royesh_services_group_colors', [
        'label'      => __('رنگ‌بندی سکشن و کارت‌ها', 'royesh'),
        'group_icon' => '🎨',
        'section'    => 'royesh_fp_services_section',
        'priority'   => 40,
        'open'       => false,
        'settings'   => 'royesh_serv_bg_color',
        'fields'     => [
            ['setting' => 'royesh_serv_bg_color',       'label' => 'پس‌زمینه سکشن',      'type' => 'color', 'default' => '#004F40'],
            ['setting' => 'royesh_serv_title_color',    'label' => 'رنگ عنوان اصلی',     'type' => 'color', 'default' => '#ffffff'],
            ['setting' => 'royesh_serv_desc_color',     'label' => 'رنگ متون و توضیحات',  'type' => 'color', 'default' => '#cccccc'],
            ['setting' => 'royesh_serv_card_bg',        'label' => 'پس‌زمینه کارت',      'type' => 'color', 'default' => '#082C23'],
            ['setting' => 'royesh_serv_card_border',    'label' => 'رنگ حاشیه کارت',      'type' => 'color', 'default' => '#2E7063'],
            ['setting' => 'royesh_serv_card_hover',     'label' => 'رنگ هاور کارت (طلایی)', 'type' => 'color', 'default' => '#B1862D'],
            ['setting' => 'royesh_serv_btn_primary',    'label' => 'رنگ دکمه (نوع اول)',  'type' => 'color', 'default' => '#B1862D'],
            ['setting' => 'royesh_serv_btn_secondary',  'label' => 'رنگ دکمه (نوع دوم)',  'type' => 'color', 'default' => '#004F40'],
        ],
    ]));

    $wp_customize->add_control(new Royesh_Group_Control($wp_customize, 'royesh_services_group_typo', [
        'label'      => __('تایپوگرافی و سایز', 'royesh'),
        'group_icon' => '🔤',
        'section'    => 'royesh_fp_services_section',
        'priority'   => 50,
        'open'       => false,
        'settings'   => 'royesh_serv_title_size_dt',
        'fields'     => [
            ['setting' => 'royesh_serv_title_size_dt', 'label' => 'سایز عنوان — دسکتاپ', 'type' => 'range', 'default' => '36', 'min' => 20, 'max' => 60, 'step' => 2, 'unit' => 'px'],
            ['setting' => 'royesh_serv_title_size_mb', 'label' => 'سایز عنوان — موبایل',  'type' => 'range', 'default' => '30', 'min' => 16, 'max' => 48, 'step' => 2, 'unit' => 'px'],
        ],
    ]));


    // =========================================================================
    // ۴.۴ فلسفه برند
    // =========================================================================
    $wp_customize->add_section('royesh_fp_philosophy_section', [
        'title'    => __('🏛 فلسفه برند رویش', 'royesh'),
        'panel'    => 'royesh_frontpage_panel',
        'priority' => 40,
    ]);

    $wp_customize->add_setting('royesh_philosophy_enable', ['default' => true, 'sanitize_callback' => 'royesh_sanitize_checkbox', 'transport' => 'refresh']);
    $wp_customize->add_setting('royesh_philosophy_badge',  ['default' => 'فلسفه برند', 'sanitize_callback' => 'sanitize_text_field', 'transport' => 'refresh']);
    $wp_customize->add_setting('royesh_philosophy_desc',   ['default' => 'رویکرد بنیادین ما در موسسه رویش بر پایه هم‌افزایی دانش تخصصی، نوآوری مستمر و ایجاد ارزش پایدار استوار است. ما بر این باوریم که تحول اقتصادی و رشد کسب‌وکارها تنها از طریق هدایت هوشمندانه سرمایه حاصل می‌شود.', 'sanitize_callback' => 'sanitize_textarea_field', 'transport' => 'refresh']);

    // Colors
    $wp_customize->add_setting('royesh_phil_bg_color',       ['default' => '#ffffff', 'sanitize_callback' => 'sanitize_hex_color', 'transport' => 'refresh']);
    $wp_customize->add_setting('royesh_phil_title_color',    ['default' => '#080206', 'sanitize_callback' => 'sanitize_hex_color', 'transport' => 'refresh']);
    $wp_customize->add_setting('royesh_phil_desc_color',     ['default' => '#333333', 'sanitize_callback' => 'sanitize_hex_color', 'transport' => 'refresh']);
    $wp_customize->add_setting('royesh_phil_card_bg',        ['default' => '#FAF8F4', 'sanitize_callback' => 'sanitize_hex_color', 'transport' => 'refresh']);
    $wp_customize->add_setting('royesh_phil_card_hover',     ['default' => '#B1862D', 'sanitize_callback' => 'sanitize_hex_color', 'transport' => 'refresh']);
    $wp_customize->add_setting('royesh_phil_icon_bg',        ['default' => '#004F40', 'sanitize_callback' => 'sanitize_hex_color', 'transport' => 'refresh']);

    // Typography
    $wp_customize->add_setting('royesh_phil_title_size',     ['default' => '32', 'sanitize_callback' => 'absint', 'transport' => 'refresh']);

    // Cards
    $wp_customize->add_setting('royesh_phil_c1_title', ['default' => 'نگاه مسئله‌محور', 'sanitize_callback' => 'sanitize_text_field', 'transport' => 'refresh']);
    $wp_customize->add_setting('royesh_phil_c1_desc',  ['default' => 'تمرکز بر شناسایی مسائل بنیادین مالی و طراحی راهکارهای ساختاری.', 'sanitize_callback' => 'sanitize_textarea_field', 'transport' => 'refresh']);
    $wp_customize->add_setting('royesh_phil_c2_title', ['default' => 'همراستاسازی منافع', 'sanitize_callback' => 'sanitize_text_field', 'transport' => 'refresh']);
    $wp_customize->add_setting('royesh_phil_c2_desc',  ['default' => 'خلق راهکارهایی پایدار با درنظرگرفتن منافع همه ذینفعان.', 'sanitize_callback' => 'sanitize_textarea_field', 'transport' => 'refresh']);
    $wp_customize->add_setting('royesh_phil_c3_title', ['default' => 'آینده‌نگری مالی', 'sanitize_callback' => 'sanitize_text_field', 'transport' => 'refresh']);
    $wp_customize->add_setting('royesh_phil_c3_desc',  ['default' => 'توسعه مدل‌های نوین برای پاسخ به نیازهای آینده صنعت مالی.', 'sanitize_callback' => 'sanitize_textarea_field', 'transport' => 'refresh']);



    $wp_customize->add_setting('royesh_phil_desc_size',  ['default' => '15', 'sanitize_callback' => 'absint', 'transport' => 'refresh']);

    $wp_customize->add_setting('royesh_phil_img_1', ['default' => royesh_asset_img('brand-big-1.png'), 'sanitize_callback' => 'esc_url_raw', 'transport' => 'refresh']);
    $wp_customize->add_control(new WP_Customize_Image_Control($wp_customize, 'royesh_phil_img_1', [
        'label'      => __('تصویر کلاژ اصلی (بزرگ)', 'royesh'),
        'section'    => 'royesh_fp_philosophy_section',
        'priority'   => 5,
    ]));

    $wp_customize->add_setting('royesh_phil_img_2', ['default' => royesh_asset_img('brand-small-2.png'), 'sanitize_callback' => 'esc_url_raw', 'transport' => 'refresh']);
    $wp_customize->add_control(new WP_Customize_Image_Control($wp_customize, 'royesh_phil_img_2', [
        'label'      => __('تصویر کلاژ فرعی (کوچک)', 'royesh'),
        'section'    => 'royesh_fp_philosophy_section',
        'priority'   => 6,
    ]));

    $wp_customize->add_control(new Royesh_Group_Control($wp_customize, 'royesh_phil_group_display', [
        'label'      => __('نمایش / پنهان', 'royesh'),
        'group_icon' => '👁',
        'section'    => 'royesh_fp_philosophy_section',
        'priority'   => 10,
        'open'       => true,
        'settings'   => 'royesh_philosophy_enable',
        'fields'     => [
            ['setting' => 'royesh_philosophy_enable', 'label' => 'نمایش سکشن فلسفه برند', 'type' => 'checkbox', 'default' => true],
        ],
    ]));

    $wp_customize->add_control(new Royesh_Group_Control($wp_customize, 'royesh_phil_group_content', [
        'label'      => __('محتوا و متن اصلی', 'royesh'),
        'group_icon' => '✏️',
        'section'    => 'royesh_fp_philosophy_section',
        'priority'   => 20,
        'open'       => false,
        'settings'   => 'royesh_philosophy_badge',
        'fields'     => [
            ['setting' => 'royesh_philosophy_badge', 'label' => 'بج / تیتر بالا', 'type' => 'text',     'default' => 'فلسفه برند'],
            ['setting' => 'royesh_philosophy_desc',  'label' => 'متن فلسفه برند',  'type' => 'textarea', 'default' => ''],
        ],
    ]));

    $wp_customize->add_control(new Royesh_Group_Control($wp_customize, 'royesh_phil_group_cards', [
        'label'      => __('محتوای ویژگی‌ها (۳ مورد)', 'royesh'),
        'group_icon' => '🗂️',
        'section'    => 'royesh_fp_philosophy_section',
        'priority'   => 30,
        'open'       => false,
        'settings'   => 'royesh_phil_c1_title',
        'fields'     => [
            ['setting' => 'royesh_phil_c1_title', 'label' => 'آیتم ۱ - عنوان', 'type' => 'text', 'default' => 'نگاه مسئله‌محور'],
            ['setting' => 'royesh_phil_c1_desc',  'label' => 'آیتم ۱ - توضیحات', 'type' => 'textarea', 'default' => ''],
            ['setting' => 'royesh_phil_c2_title', 'label' => 'آیتم ۲ - عنوان', 'type' => 'text', 'default' => 'همراستاسازی منافع'],
            ['setting' => 'royesh_phil_c2_desc',  'label' => 'آیتم ۲ - توضیحات', 'type' => 'textarea', 'default' => ''],
            ['setting' => 'royesh_phil_c3_title', 'label' => 'آیتم ۳ - عنوان', 'type' => 'text', 'default' => 'آینده‌نگری مالی'],
            ['setting' => 'royesh_phil_c3_desc',  'label' => 'آیتم ۳ - توضیحات', 'type' => 'textarea', 'default' => ''],
        ],
    ]));

    $wp_customize->add_control(new Royesh_Group_Control($wp_customize, 'royesh_phil_group_colors', [
        'label'      => __('رنگ‌بندی', 'royesh'),
        'group_icon' => '🎨',
        'section'    => 'royesh_fp_philosophy_section',
        'priority'   => 40,
        'open'       => false,
        'settings'   => 'royesh_phil_bg_color',
        'fields'     => [
            ['setting' => 'royesh_phil_bg_color',       'label' => 'پس‌زمینه سکشن',    'type' => 'color', 'default' => '#ffffff'],
            ['setting' => 'royesh_phil_title_color',    'label' => 'رنگ تیتر اصلی',   'type' => 'color', 'default' => '#080206'],
            ['setting' => 'royesh_phil_desc_color',     'label' => 'رنگ متن توضیحات', 'type' => 'color', 'default' => '#333333'],
            ['setting' => 'royesh_phil_card_bg',        'label' => 'پس‌زمینه آیتم',   'type' => 'color', 'default' => '#FAF8F4'],
            ['setting' => 'royesh_phil_card_hover',     'label' => 'رنگ هاور آیتم',   'type' => 'color', 'default' => '#B1862D'],
            ['setting' => 'royesh_phil_icon_bg',        'label' => 'پس‌زمینه آیکون',  'type' => 'color', 'default' => '#004F40'],
        ],
    ]));

    $wp_customize->add_control(new Royesh_Group_Control($wp_customize, 'royesh_phil_group_typo', [
        'label'      => __('تایپوگرافی', 'royesh'),
        'group_icon' => '🔤',
        'section'    => 'royesh_fp_philosophy_section',
        'priority'   => 50,
        'open'       => false,
        
        'settings'   => 'royesh_phil_title_size',
        'fields'     => [
            ['setting' => 'royesh_phil_title_size', 'label' => 'سایز عنوان', 'type' => 'range', 'default' => '32', 'min' => 20, 'max' => 60, 'step' => 2, 'unit' => 'px'],
            ['setting' => 'royesh_phil_desc_size',  'label' => 'سایز توضیحات', 'type' => 'range', 'default' => '15', 'min' => 12, 'max' => 24, 'step' => 1, 'unit' => 'px'],
        ],

    ]));


    // =========================================================================
    // ۴.۵ بنر دعوت به اقدام (CTA)
    // =========================================================================
    $wp_customize->add_section('royesh_fp_cta_section', [
        'title'    => __('📢 بنر دعوت به اقدام (CTA)', 'royesh'),
        'panel'    => 'royesh_frontpage_panel',
        'priority' => 50,
    ]);

    $wp_customize->add_setting('royesh_cta_enable',   ['default' => true, 'sanitize_callback' => 'royesh_sanitize_checkbox', 'transport' => 'refresh']);
    $wp_customize->add_setting('royesh_cta_badge',    ['default' => 'فرصت‌های رشد پایدار', 'sanitize_callback' => 'sanitize_text_field', 'transport' => 'refresh']);
    $wp_customize->add_setting('royesh_cta_title',    ['default' => 'توسعه مالی با نگاهی آینده‌محور', 'sanitize_callback' => 'sanitize_text_field', 'transport' => 'refresh']);
    $wp_customize->add_setting('royesh_cta_desc',     ['default' => 'جهت آشنایی بیشتر با خدمات و ظرفیت‌های همکاری، با ما در ارتباط باشید.', 'sanitize_callback' => 'sanitize_textarea_field', 'transport' => 'refresh']);
    $wp_customize->add_setting('royesh_cta_btn_text', ['default' => 'تماس با ما', 'sanitize_callback' => 'sanitize_text_field', 'transport' => 'refresh']);
    $wp_customize->add_setting('royesh_cta_btn_url',  ['default' => '/contact', 'sanitize_callback' => 'sanitize_text_field', 'transport' => 'refresh']);

    // Colors
    $wp_customize->add_setting('royesh_cta_badge_color', ['default' => '#E8D2AF', 'sanitize_callback' => 'sanitize_hex_color', 'transport' => 'refresh']);
    $wp_customize->add_setting('royesh_cta_title_color', ['default' => '#ffffff', 'sanitize_callback' => 'sanitize_hex_color', 'transport' => 'refresh']);
    $wp_customize->add_setting('royesh_cta_desc_color',  ['default' => '#E2E8F0', 'sanitize_callback' => 'sanitize_hex_color', 'transport' => 'refresh']);
    $wp_customize->add_setting('royesh_cta_btn_color',   ['default' => '#ffffff', 'sanitize_callback' => 'sanitize_hex_color', 'transport' => 'refresh']);
    $wp_customize->add_setting('royesh_cta_btn_bg',      ['default' => '#004F40', 'sanitize_callback' => 'sanitize_hex_color', 'transport' => 'refresh']);
    $wp_customize->add_setting('royesh_cta_btn_hover',   ['default' => '#003b30', 'sanitize_callback' => 'sanitize_hex_color', 'transport' => 'refresh']);
    
    // Typography
    $wp_customize->add_setting('royesh_cta_title_size',  ['default' => '36', 'sanitize_callback' => 'absint', 'transport' => 'refresh']);



    $wp_customize->add_setting('royesh_cta_desc_size',  ['default' => '18', 'sanitize_callback' => 'absint', 'transport' => 'refresh']);

    $wp_customize->add_setting('royesh_cta_bg_image', ['default' => royesh_asset_img('sustainable.jpg'), 'sanitize_callback' => 'esc_url_raw', 'transport' => 'refresh']);
    $wp_customize->add_control(new WP_Customize_Image_Control($wp_customize, 'royesh_cta_bg_image', [
        'label'      => __('تصویر پس‌زمینه CTA', 'royesh'),
        'section'    => 'royesh_fp_cta_section',
        'priority'   => 5,
    ]));

    $wp_customize->add_control(new Royesh_Group_Control($wp_customize, 'royesh_cta_group_display', [
        'label'      => __('نمایش / پنهان', 'royesh'),
        'group_icon' => '👁',
        'section'    => 'royesh_fp_cta_section',
        'priority'   => 10,
        'open'       => true,
        'settings'   => 'royesh_cta_enable',
        'fields'     => [
            ['setting' => 'royesh_cta_enable', 'label' => 'نمایش بنر CTA', 'type' => 'checkbox', 'default' => true],
        ],
    ]));

    $wp_customize->add_control(new Royesh_Group_Control($wp_customize, 'royesh_cta_group_content', [
        'label'      => __('محتوا و دکمه', 'royesh'),
        'group_icon' => '✏️',
        'section'    => 'royesh_fp_cta_section',
        'priority'   => 20,
        'open'       => false,
        'settings'   => 'royesh_cta_title',
        'fields'     => [
            ['setting' => 'royesh_cta_badge',    'label' => 'بج بالای بنر', 'type' => 'text',     'default' => 'فرصت‌های رشد پایدار'],
            ['setting' => 'royesh_cta_title',    'label' => 'تیتر بنر',     'type' => 'text',     'default' => 'توسعه مالی با نگاهی آینده‌محور'],
            ['setting' => 'royesh_cta_desc',     'label' => 'متن توصیفی',   'type' => 'textarea', 'default' => ''],
            ['setting' => 'royesh_cta_btn_text', 'label' => 'متن دکمه',    'type' => 'text',     'default' => 'تماس با ما'],
            ['setting' => 'royesh_cta_btn_url',  'label' => 'لینک دکمه',   'type' => 'text',     'default' => '/contact'],
        ],
    ]));

    $wp_customize->add_control(new Royesh_Group_Control($wp_customize, 'royesh_cta_group_colors', [
        'label'      => __('رنگ‌بندی', 'royesh'),
        'group_icon' => '🎨',
        'section'    => 'royesh_fp_cta_section',
        'priority'   => 30,
        'open'       => false,
        'settings'   => 'royesh_cta_title_color',
        'fields'     => [
            ['setting' => 'royesh_cta_badge_color', 'label' => 'رنگ بج (نشان)',  'type' => 'color', 'default' => '#E8D2AF'],
            ['setting' => 'royesh_cta_title_color', 'label' => 'رنگ تیتر',       'type' => 'color', 'default' => '#ffffff'],
            ['setting' => 'royesh_cta_desc_color',  'label' => 'رنگ توضیحات',     'type' => 'color', 'default' => '#E2E8F0'],
            ['setting' => 'royesh_cta_btn_color',   'label' => 'رنگ متن دکمه',    'type' => 'color', 'default' => '#ffffff'],
            ['setting' => 'royesh_cta_btn_bg',      'label' => 'رنگ پس‌زمینه دکمه', 'type' => 'color', 'default' => '#004F40'],
            ['setting' => 'royesh_cta_btn_hover',   'label' => 'رنگ هاور دکمه',   'type' => 'color', 'default' => '#003b30'],
        ],
    ]));

    $wp_customize->add_control(new Royesh_Group_Control($wp_customize, 'royesh_cta_group_typo', [
        'label'      => __('تایپوگرافی', 'royesh'),
        'group_icon' => '🔤',
        'section'    => 'royesh_fp_cta_section',
        'priority'   => 40,
        'open'       => false,
        
        'settings'   => 'royesh_cta_title_size',
        'fields'     => [
            ['setting' => 'royesh_cta_title_size', 'label' => 'سایز عنوان', 'type' => 'range', 'default' => '36', 'min' => 20, 'max' => 60, 'step' => 2, 'unit' => 'px'],
            ['setting' => 'royesh_cta_desc_size',  'label' => 'سایز توضیحات', 'type' => 'range', 'default' => '18', 'min' => 12, 'max' => 30, 'step' => 1, 'unit' => 'px'],
        ],

    ]));


    // =========================================================================
    // ۴.۶ اسلایدر مقالات
    // =========================================================================

    // =========================================================================
    // ۴.۷ اطلاعات تماس
    // =========================================================================
    $wp_customize->add_section('royesh_fp_contact_section', [
        'title'    => __('📞 اطلاعات تماس', 'royesh'),
        'panel'    => 'royesh_frontpage_panel',
        'priority' => 55,
    ]);

    $wp_customize->add_setting('royesh_contact_enable', ['default' => true, 'sanitize_callback' => 'royesh_sanitize_checkbox', 'transport' => 'refresh']);
    $wp_customize->add_setting('royesh_contact_badge',  ['default' => 'اطلاعات تماس', 'sanitize_callback' => 'sanitize_text_field', 'transport' => 'refresh']);
    $wp_customize->add_setting('royesh_contact_title_1',  ['default' => 'به دنبال', 'sanitize_callback' => 'sanitize_text_field', 'transport' => 'refresh']);
    $wp_customize->add_setting('royesh_contact_title_2',  ['default' => 'خدمات مالی سفارشی', 'sanitize_callback' => 'sanitize_text_field', 'transport' => 'refresh']);
    $wp_customize->add_setting('royesh_contact_title_3',  ['default' => 'باشید.', 'sanitize_callback' => 'sanitize_text_field', 'transport' => 'refresh']);
    $wp_customize->add_setting('royesh_contact_desc',  ['default' => 'تیم مشاوران و کارشناسان خبره ما در موسسه رویش آماده ارائه راهکارهای دقیق مالی، بهینه‌سازی ساختارهای سرمایه‌گذاری و مدل‌سازی اختصاصی منطبق با نیازها و چشم‌انداز توسعه پایدار کسب‌وکار شما هستند.', 'sanitize_callback' => 'sanitize_textarea_field', 'transport' => 'refresh']);
    
    $wp_customize->add_setting('royesh_contact_bg_color',       ['default' => '#ffffff', 'sanitize_callback' => 'sanitize_hex_color', 'transport' => 'refresh']);
    $wp_customize->add_setting('royesh_contact_card_bg',        ['default' => '#F3ECE3', 'sanitize_callback' => 'sanitize_hex_color', 'transport' => 'refresh']);
    $wp_customize->add_setting('royesh_contact_title_color',    ['default' => '#080206', 'sanitize_callback' => 'sanitize_hex_color', 'transport' => 'refresh']);
    $wp_customize->add_setting('royesh_contact_accent_color',   ['default' => '#004F40', 'sanitize_callback' => 'sanitize_hex_color', 'transport' => 'refresh']);
    $wp_customize->add_setting('royesh_contact_btn_bg',         ['default' => '#004F40', 'sanitize_callback' => 'sanitize_hex_color', 'transport' => 'refresh']);
    
    $wp_customize->add_setting('royesh_contact_title_size',     ['default' => '36', 'sanitize_callback' => 'absint', 'transport' => 'refresh']);
    $wp_customize->add_setting('royesh_contact_desc_size',      ['default' => '15', 'sanitize_callback' => 'absint', 'transport' => 'refresh']);

    $wp_customize->add_setting('royesh_contact_image', ['default' => royesh_asset_img('contact-us-bg.webp'), 'sanitize_callback' => 'esc_url_raw', 'transport' => 'refresh']);
    $wp_customize->add_control(new WP_Customize_Image_Control($wp_customize, 'royesh_contact_image', [
        'label'      => __('تصویر شاخص تماس', 'royesh'),
        'section'    => 'royesh_fp_contact_section',
        'priority'   => 5,
    ]));

    $wp_customize->add_control(new Royesh_Group_Control($wp_customize, 'royesh_contact_group_display', [
        'label'      => __('نمایش / پنهان', 'royesh'),
        'group_icon' => '👁',
        'section'    => 'royesh_fp_contact_section',
        'priority'   => 10,
        'open'       => true,
        'settings'   => 'royesh_contact_enable',
        'fields'     => [
            ['setting' => 'royesh_contact_enable', 'label' => 'نمایش بخش تماس در صفحه اصلی', 'type' => 'checkbox', 'default' => true],
        ],
    ]));

    $wp_customize->add_control(new Royesh_Group_Control($wp_customize, 'royesh_contact_group_content', [
        'label'      => __('محتوا و متون', 'royesh'),
        'group_icon' => '✏️',
        'section'    => 'royesh_fp_contact_section',
        'priority'   => 20,
        'open'       => false,
        'settings'   => 'royesh_contact_badge',
        'fields'     => [
            ['setting' => 'royesh_contact_badge',   'label' => 'بج (برچسب)', 'type' => 'text', 'default' => 'اطلاعات تماس'],
            ['setting' => 'royesh_contact_title_1', 'label' => 'بخش اول تیتر', 'type' => 'text', 'default' => 'به دنبال'],
            ['setting' => 'royesh_contact_title_2', 'label' => 'بخش دوم (رنگی)', 'type' => 'text', 'default' => 'خدمات مالی سفارشی'],
            ['setting' => 'royesh_contact_title_3', 'label' => 'بخش سوم تیتر', 'type' => 'text', 'default' => 'باشید.'],
            ['setting' => 'royesh_contact_desc',    'label' => 'متن توضیحات', 'type' => 'textarea', 'default' => 'تیم مشاوران و کارشناسان خبره ما آماده ارائه راهکارهای دقیق مالی هستند.'],
        ],
    ]));

    $wp_customize->add_control(new Royesh_Group_Control($wp_customize, 'royesh_contact_group_colors', [
        'label'      => __('رنگ‌بندی', 'royesh'),
        'group_icon' => '🎨',
        'section'    => 'royesh_fp_contact_section',
        'priority'   => 30,
        'open'       => false,
        'settings'   => 'royesh_contact_bg_color',
        'fields'     => [
            ['setting' => 'royesh_contact_bg_color',     'label' => 'پس‌زمینه بخش', 'type' => 'color', 'default' => '#ffffff'],
            ['setting' => 'royesh_contact_card_bg',      'label' => 'پس‌زمینه فرم', 'type' => 'color', 'default' => '#F3ECE3'],
            ['setting' => 'royesh_contact_title_color',  'label' => 'رنگ تیتر', 'type' => 'color', 'default' => '#080206'],
            ['setting' => 'royesh_contact_accent_color', 'label' => 'رنگ بخش رنگی تیتر', 'type' => 'color', 'default' => '#004F40'],
            ['setting' => 'royesh_contact_btn_bg',       'label' => 'رنگ دکمه ثبت', 'type' => 'color', 'default' => '#004F40'],
        ],
    ]));

    $wp_customize->add_control(new Royesh_Group_Control($wp_customize, 'royesh_contact_group_typo', [
        'label'      => __('تایپوگرافی', 'royesh'),
        'group_icon' => '🔤',
        'section'    => 'royesh_fp_contact_section',
        'priority'   => 40,
        'open'       => false,
        'settings'   => 'royesh_contact_title_size',
        'fields'     => [
            ['setting' => 'royesh_contact_title_size', 'label' => 'سایز عنوان', 'type' => 'range', 'default' => '36', 'min' => 20, 'max' => 60, 'step' => 2, 'unit' => 'px'],
            ['setting' => 'royesh_contact_desc_size',  'label' => 'سایز توضیحات', 'type' => 'range', 'default' => '15', 'min' => 10, 'max' => 24, 'step' => 1, 'unit' => 'px'],
        ],
    ]));

    $wp_customize->add_section('royesh_fp_blog_section', [
        'title'    => __('📰 اسلایدر مقالات و اخبار', 'royesh'),
        'panel'    => 'royesh_frontpage_panel',
        'priority' => 60,
    ]);

    $wp_customize->add_setting('royesh_blog_enable', ['default' => true, 'sanitize_callback' => 'royesh_sanitize_checkbox', 'transport' => 'refresh']);
    $wp_customize->add_setting('royesh_blog_title',  ['default' => 'اخبار و اطلاعیه‌ها', 'sanitize_callback' => 'sanitize_text_field', 'transport' => 'refresh']);
    $wp_customize->add_setting('royesh_blog_count',  ['default' => 6, 'sanitize_callback' => 'absint', 'transport' => 'refresh']);

    // Colors
    $wp_customize->add_setting('royesh_blog_bg_color',       ['default' => '#004F40', 'sanitize_callback' => 'sanitize_hex_color', 'transport' => 'refresh']);
    $wp_customize->add_setting('royesh_blog_title_color',    ['default' => '#ffffff', 'sanitize_callback' => 'sanitize_hex_color', 'transport' => 'refresh']);
    $wp_customize->add_setting('royesh_blog_card_bg',        ['default' => '#ffffff', 'sanitize_callback' => 'sanitize_hex_color', 'transport' => 'refresh']);
    
    // Typography
    $wp_customize->add_setting('royesh_blog_title_size',     ['default' => '32', 'sanitize_callback' => 'absint', 'transport' => 'refresh']);


    $wp_customize->add_control(new Royesh_Group_Control($wp_customize, 'royesh_blog_group_display', [
        'label'      => __('نمایش / پنهان', 'royesh'),
        'group_icon' => '👁',
        'section'    => 'royesh_fp_blog_section',
        'priority'   => 10,
        'open'       => true,
        'settings'   => 'royesh_blog_enable',
        'fields'     => [
            ['setting' => 'royesh_blog_enable', 'label' => 'نمایش اسلایدر مقالات در صفحه اصلی', 'type' => 'checkbox', 'default' => true],
        ],
    ]));

    $wp_customize->add_control(new Royesh_Group_Control($wp_customize, 'royesh_blog_group_settings', [
        'label'      => __('تنظیمات و محتوا', 'royesh'),
        'group_icon' => '⚙️',
        'section'    => 'royesh_fp_blog_section',
        'priority'   => 20,
        'open'       => false,
        'settings'   => 'royesh_blog_title',
        'fields'     => [
            ['setting' => 'royesh_blog_title', 'label' => 'عنوان بخش اخبار',        'type' => 'text',   'default' => 'اخبار و اطلاعیه‌ها'],
            ['setting' => 'royesh_blog_count', 'label' => 'تعداد مقالات نمایشی',    'type' => 'range',  'default' => 6, 'min' => 2, 'max' => 12, 'step' => 1, 'unit' => 'مورد'],
        ],
    ]));

    $wp_customize->add_control(new Royesh_Group_Control($wp_customize, 'royesh_blog_group_colors', [
        'label'      => __('رنگ‌بندی', 'royesh'),
        'group_icon' => '🎨',
        'section'    => 'royesh_fp_blog_section',
        'priority'   => 30,
        'open'       => false,
        'settings'   => 'royesh_blog_bg_color',
        'fields'     => [
            ['setting' => 'royesh_blog_bg_color',    'label' => 'پس‌زمینه بخش بالایی سکشن',   'type' => 'color', 'default' => '#004F40'],
            ['setting' => 'royesh_blog_title_color', 'label' => 'رنگ تیتر اصلی',   'type' => 'color', 'default' => '#ffffff'],
            ['setting' => 'royesh_blog_card_bg',     'label' => 'پس‌زمینه محتوای کارت‌ها', 'type' => 'color', 'default' => '#ffffff'],
        ],
    ]));

    $wp_customize->add_control(new Royesh_Group_Control($wp_customize, 'royesh_blog_group_typo', [
        'label'      => __('تایپوگرافی', 'royesh'),
        'group_icon' => '🔤',
        'section'    => 'royesh_fp_blog_section',
        'priority'   => 40,
        'open'       => false,
        'settings'   => 'royesh_blog_title_size',
        'fields'     => [
            ['setting' => 'royesh_blog_title_size', 'label' => 'سایز عنوان', 'type' => 'range', 'default' => '32', 'min' => 20, 'max' => 60, 'step' => 2, 'unit' => 'px'],
        ],
    ]));
}
add_action('customize_register', 'royesh_customize_register');


/* ==========================================================================
   توابع کمکی sanitize
   ========================================================================== */
function royesh_sanitize_checkbox($checked) {
    return (isset($checked) && true == $checked);
}

function royesh_sanitize_features_json($value) {
    $decoded = json_decode(stripslashes($value), true);
    if (!is_array($decoded)) return '';
    $clean = [];
    foreach ($decoded as $item) {
        $clean[] = [
            'text'    => isset($item['text']) ? sanitize_text_field($item['text']) : '',
            'enabled' => !empty($item['enabled']),
        ];
    }
    return json_encode($clean);
}


/* ==========================================================================
   خروجی CSS داینامیک بر اساس تنظیمات Customizer
   ========================================================================== */
function royesh_customizer_dynamic_css() {
    $hero_bg        = get_theme_mod('royesh_hero_bg_color',          '#021A15');
    $hero_title_c   = get_theme_mod('royesh_hero_title_color',       '#ffffff');
    $hero_accent_c  = get_theme_mod('royesh_hero_accent_color',      '#B58A33');
    $hero_desc_c    = get_theme_mod('royesh_hero_desc_color',        'rgba(255,255,255,0.9)');
    $hero_btn_bg    = get_theme_mod('royesh_hero_btn_bg',            '#ffffff');
    $hero_btn_c     = get_theme_mod('royesh_hero_btn_color',         '#014235');
    $title_desk     = get_theme_mod('royesh_hero_title_size_desktop','44');
    $title_mob      = get_theme_mod('royesh_hero_title_size_mobile', '36');
    $desc_size      = get_theme_mod('royesh_hero_desc_size',         '18');
    $tagline_size   = get_theme_mod('royesh_hero_tagline_size',      '23');
    $featbar_bg     = get_theme_mod('royesh_featbar_bg',             '#F0EDE3');
    $feat_icon_c    = get_theme_mod('royesh_featbar_icon_color',     '#B58A33');
    $feat_text_c    = get_theme_mod('royesh_featbar_text_color',     '#1f2937');
    $feat_text_size = get_theme_mod('royesh_featbar_text_size',      '15');
    $cta_btn_bg     = get_theme_mod('royesh_cta_btn_bg',             '#004F40');
    $speed          = get_theme_mod('royesh_featbar_marquee_speed',  '25');

    $css = "
        
        /* === Contact Dynamic Styles === */
        #contact { background-color: {$hero_bg} /* will be handled in template instead of here to keep it clean */('royesh_contact_bg_color', '#ffffff'); ?> !important; }
        #contact .royesh-contact-form-bg { background-color: {$hero_bg} /* will be handled in template instead of here to keep it clean */('royesh_contact_card_bg', '#F3ECE3'); ?> !important; }

        /* === Hero Dynamic Styles === */
        #v-hero-section { background-color: {$hero_bg} !important; }
        #v-hero-section h1 { color: {$hero_title_c}; font-size: {$title_desk}px !important; }
        #v-hero-title-accent { color: {$hero_accent_c} !important; }
        #v-hero-description { color: {$hero_desc_c}; font-size: {$desc_size}px !important; }
        #v-hero-tagline { font-size: {$tagline_size}px !important; }
        #v-hero-tagline .animate-pulse { background-color: {$hero_accent_c} !important; }
        #v-hero-btn-about { background-color: {$hero_btn_bg} !important; color: {$hero_btn_c} !important; }

        /* === Features Bar Dynamic Styles === */
        #v-features-bar { background-color: {$featbar_bg} !important; }
        .v-feature-item .rounded-full { background-color: {$feat_icon_c} !important; }
        .v-feature-item span { color: {$feat_text_c}; font-size: {$feat_text_size}px !important; }
        .animate-marquee-rtl { animation-duration: {$speed}s !important; }

        /* === CTA Button Dynamic === */
        #v-cta-divider a { background-color: {$cta_btn_bg} !important; }

        /* === Mobile Hero title size === */
        @media (max-width: 640px) {
            #v-hero-section h1 { font-size: {$title_mob}px !important; }
        }
    ";
    echo '<style id="royesh-dynamic-css">' . $css . '</style>'; // phpcs:ignore
}
add_action('wp_head', 'royesh_customizer_dynamic_css', 99);
