<?php
/**
 * Theme Setup & Capabilities Configuration
 * 
 * @package Royesh
 * @version 1.0.0
 */

if (!defined('ABSPATH')) {
    exit; // Exit if accessed directly
}

if (!function_exists('royesh_setup')) :
    /**
     * تنظیمات پایه پوسته، پشتیبانی‌ها و منوها
     */
    function royesh_setup() {
        // پشتیبانی از ترجمه و Text Domain
        load_theme_textdomain('royesh', ROYESH_THEME_DIR . '/languages');

        // مدیریت عنوان صفحه توسط وردپرس
        add_theme_support('title-tag');

        // پشتیبانی از تصاویر شاخص (Post Thumbnails)
        add_theme_support('post-thumbnails');

        // تعریف ابعاد سفارشی تصاویر
        add_image_size('royesh-blog-card', 600, 400, true);
        add_image_size('royesh-hero-banner', 1200, 675, true);

        // ثبت منوهای ناوبری رسمی وردپرس
        register_nav_menus([
            'primary-menu'  => __('منوی اصلی هدر', 'royesh'),
            'footer-menu-1' => __('ستون دوم فوتر (خدمات)', 'royesh'),
            'footer-menu-2' => __('ستون سوم فوتر (دسترسی سریع)', 'royesh'),
        ]);

        // پشتیبانی از HTML5 استاندارد برای فرم‌ها و گالری‌ها
        add_theme_support('html5', [
            'search-form',
            'comment-form',
            'comment-list',
            'gallery',
            'caption',
            'style',
            'script',
        ]);

        // پشتیبانی از لوگوی سفارشی وردپرس
        add_theme_support('custom-logo', [
            'height'      => 80,
            'width'       => 240,
            'flex-height' => true,
            'flex-width'  => true,
        ]);

        // غیرفعال‌سازی Block Widgets و اجبار به Classic Widgets API جهت حفظ پایداری UI
        add_theme_support('widgets-block-editor', false);
    }
endif;
add_action('after_setup_theme', 'royesh_setup');

/**
 * ایجاد خودکار منوهای فوتر در صورت عدم وجود
 */
function royesh_create_default_menus() {
    $menus_to_create = [
        'رویش | خدمات ما' => [
            'location' => 'footer-menu-1',
            'items' => [
                ['title' => 'خدمات تأمین مالی', 'url' => '/services#financing-services'],
                ['title' => 'خدمات اعتباری', 'url' => '/services#credit-services'],
                ['title' => 'مدیریت نقدینگی', 'url' => '/services#liquidity-management'],
                ['title' => 'مدیریت دارایی', 'url' => '/services#asset-management'],
            ]
        ],
        'رویش | دسترسی سریع' => [
            'location' => 'footer-menu-2',
            'items' => [
                ['title' => 'صفحه اصلی', 'url' => '/'],
                ['title' => 'وبلاگ', 'url' => '/news'],
                ['title' => 'درباره ما', 'url' => '/about'],
                ['title' => 'تماس با ما', 'url' => '/contact'],
                ['title' => 'درخواست مشاوره', 'url' => '/consultation'],
            ]
        ]
    ];

    $locations = get_theme_mod('nav_menu_locations');
    if (!is_array($locations)) {
        $locations = [];
    }
    
    $locations_updated = false;

    foreach ($menus_to_create as $menu_name => $menu_data) {
        $menu_exists = wp_get_nav_menu_object($menu_name);

        if (!$menu_exists) {
            $menu_id = wp_create_nav_menu($menu_name);
            if (!is_wp_error($menu_id)) {
                foreach ($menu_data['items'] as $item) {
                    wp_update_nav_menu_item($menu_id, 0, [
                        'menu-item-title'   => $item['title'],
                        'menu-item-url'     => $item['url'],
                        'menu-item-status'  => 'publish',
                        'menu-item-type'    => 'custom',
                    ]);
                }
                $locations[$menu_data['location']] = $menu_id;
                $locations_updated = true;
            }
        } else {
            // اطمینان از متصل بودن مکان در صورت وجود منو
            if (empty($locations[$menu_data['location']]) || $locations[$menu_data['location']] != $menu_exists->term_id) {
                $locations[$menu_data['location']] = $menu_exists->term_id;
                $locations_updated = true;
            }
        }
    }

    if ($locations_updated) {
        set_theme_mod('nav_menu_locations', $locations);
    }
}
add_action('after_setup_theme', 'royesh_create_default_menus', 20);

/**
 * افزودن کلاس‌های Tailwind به لینک‌های منوی فوتر
 */
function royesh_footer_menu_classes($atts, $item, $args) {
    if ($args->theme_location === 'footer-menu-1' || $args->theme_location === 'footer-menu-2') {
        $atts['class'] = isset($atts['class']) ? $atts['class'] . ' hover:text-[#E8D2AF] transition-colors' : 'hover:text-[#E8D2AF] transition-colors';
    }
    return $atts;
}
add_filter('nav_menu_link_attributes', 'royesh_footer_menu_classes', 10, 3);

/**
 * تنظیم عرض محتوای استاندارد وردپرس
 */
function royesh_content_width() {
    $GLOBALS['content_width'] = apply_filters('royesh_content_width', 1440);
}
add_action('after_setup_theme', 'royesh_content_width', 0);
