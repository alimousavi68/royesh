<?php
/**
 * Utility & Helper Functions
 * 
 * @package Royesh
 * @version 1.2.0
 */

if (!defined('ABSPATH')) {
    exit; // Exit if accessed directly
}

/**
 * دریافت سریع آدرس تصاویر پوسته
 *
 * @param string $filename نام فایل تصویر در پوشه assets/images/
 * @return string URL کامل تصویر ایمن‌شده
 */
function royesh_asset_img($filename) {
    return esc_url(ROYESH_THEME_URI . '/assets/images/' . ltrim($filename, '/'));
}

/**
 * دریافت ایمن تنظیمات Theme Mod با مقدار پیش‌فرض
 *
 * @param string $setting_name نام تنظیم
 * @param mixed $default_value مقدار پیش‌فرض
 * @return mixed
 */
function royesh_get_setting($setting_name, $default_value = '') {
    return get_theme_mod($setting_name, $default_value);
}

/**
 * دریافت لینک دقیق و قطعی برای برگه‌های ساخته‌شده در وردپرس
 *
 * @param string $type نوع برگه (consultation | services | news | about | contact | home)
 * @return string URL کامل برگه در وردپرس
 */
function royesh_page_url(string $type = 'consultation'): string {
    static $cache = [];
    if (isset($cache[$type])) {
        return $cache[$type];
    }

    if ($type === 'home') {
        return $cache['home'] = home_url('/');
    }

    $map = [
        'consultation' => [
            'template' => 'page-consultation.php',
            'slugs'    => ['درخواست-مشاوره', 'consultation'],
            'titles'   => ['درخواست مشاوره', 'مشاوره'],
        ],
        'services' => [
            'template' => 'page-services.php',
            'slugs'    => ['خدمات-ما', 'services', 'خدمات'],
            'titles'   => ['خدمات ما', 'خدمات'],
        ],
        'news' => [
            'template' => 'page-news.php',
            'slugs'    => ['اخبار،-مقالات-و-اطلاعیه‌ها', 'اخبار-و-مقالات', 'اخبار', 'news', 'blog'],
            'titles'   => ['اخبار، مقالات و اطلاعیه‌ها', 'اخبار و مقالات', 'اخبار', 'وبلاگ'],
        ],
        'about' => [
            'template' => 'page-about.php',
            'slugs'    => ['درباره-ما', 'about', 'درباره'],
            'titles'   => ['درباره ما', 'درباره'],
        ],
        'contact' => [
            'template' => 'page-contact.php',
            'slugs'    => ['تماس-با-ما', 'contact', 'تماس'],
            'titles'   => ['تماس با ما', 'تماس'],
        ],
    ];

    if (!isset($map[$type])) {
        return home_url('/' . ltrim($type, '/'));
    }

    $target = $map[$type];

    // ۱. بررسی صفحه نوشته‌ها در تنظیمات خواندن (برای اخبار)
    if ($type === 'news') {
        $posts_page_id = (int) get_option('page_for_posts');
        if ($posts_page_id > 0) {
            $url = get_permalink($posts_page_id);
            if ($url) {
                return $cache[$type] = $url;
            }
        }
    }

    // ۲. جستجو بر اساس اسلاگ دقیق در پایگاه‌داده
    foreach ($target['slugs'] as $slug) {
        $page = get_page_by_path($slug);
        if ($page && $page->post_status === 'publish') {
            return $cache[$type] = get_permalink($page->ID);
        }
    }

    // ۳. جستجو بر اساس Template اختصاصی
    $pages = get_pages([
        'meta_key'    => '_wp_page_template',
        'meta_value'  => $target['template'],
        'number'      => 1,
        'post_status' => 'publish',
    ]);
    if (!empty($pages)) {
        return $cache[$type] = get_permalink($pages[0]->ID);
    }

    // ۴. جستجو بر اساس عنوان برگه
    foreach ($target['titles'] as $title) {
        $page = get_page_by_title($title);
        if ($page && $page->post_status === 'publish') {
            return $cache[$type] = get_permalink($page->ID);
        }
    }

    // ۵. fallback به اسلاگ اصلی
    return $cache[$type] = home_url('/' . $target['slugs'][0] . '/');
}

/**
 * میان‌بر مستقیم برای دریافت پیوند صفحه درخواست مشاوره
 */
function royesh_consultation_url(): string {
    return royesh_page_url('consultation');
}
