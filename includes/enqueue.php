<?php
/**
 * Scripts & Styles Enqueue Handler
 * 
 * @package Royesh
 * @version 2.1.0
 */

if (!defined('ABSPATH')) {
    exit; // Exit if accessed directly
}

/**
 * مدیریت بارگذاری استایل‌ها و اسکریپت‌ها بر اساس استانداردهای وردپرس
 */
function royesh_enqueue_scripts() {
    $theme_uri = ROYESH_THEME_URI;
    $version   = ROYESH_THEME_VERSION;

    // ۱. کتابخانه Swiper CSS — نسخه محلی
    wp_enqueue_style(
        'royesh-swiper-style',
        $theme_uri . '/assets/css/swiper-bundle.min.css',
        [],
        '11.0.0'
    );

    // ۲. فونت Tilt Warp — نسخه محلی
    wp_enqueue_style(
        'royesh-font-tilt-warp',
        $theme_uri . '/assets/css/tilt-warp.css',
        [],
        $version
    );

    // ۳. استایل اصلی قالب (فونت‌های محلی یکان‌بخ و پیدا، انیمیشن‌ها، ریست و متغیرها)
    wp_enqueue_style(
        'royesh-main-style',
        $theme_uri . '/assets/css/style.css',
        ['royesh-swiper-style', 'royesh-font-tilt-warp'],
        $version
    );

    // ۴. موتور Tailwind CSS جهت رندر کامل، دقیق و بلادرنگ همه کلاس‌های یو‌آی و Customizer
    wp_enqueue_script(
        'royesh-tailwind-cdn',
        'https://cdn.tailwindcss.com',
        [],
        '3.4.3',
        false // بارگذاری در Head جهت جلوگیری از FOUC
    );

    // ۵. پیکربندی افزونه‌های رنگ، فونت و استایل Tailwind
    $tailwind_config = "
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        'royesh-cream': '#F5F4EE',
                        'royesh-cream-dark': '#E8E2D2',
                        'royesh-border': '#DED6CA',
                        'royesh-green': '#014235',
                        'royesh-gold': '#B1862D',
                        'royesh-gold-hover': '#9c7524'
                    },
                    fontFamily: {
                        sans: ['YekanBakhVF', 'ui-sans-serif', 'system-ui', 'sans-serif'],
                        heading: ['PeydaWebVF', 'sans-serif']
                    }
                }
            }
        };
    ";
    wp_add_inline_script('royesh-tailwind-cdn', $tailwind_config, 'after');

    // ۶. کتابخانه Swiper JS — نسخه محلی
    wp_enqueue_script(
        'royesh-swiper-js',
        $theme_uri . '/assets/js/swiper-bundle.min.js',
        [],
        '11.0.0',
        true
    );

    // ۷. اسکریپت اصلی تعاملی تم (منو، پارالاکس، انیمیشن‌ها و رویدادها)
    wp_enqueue_script(
        'royesh-main-js',
        $theme_uri . '/assets/js/main.js',
        ['royesh-swiper-js'],
        $version,
        true
    );

    // ۸. پاس دادن متغیرهای پویا و Nonce از سمت سرور به اسکریپت‌های کلاینت
    wp_localize_script('royesh-main-js', 'royeshData', [
        'ajaxUrl'   => admin_url('admin-ajax.php'),
        'nonce'     => wp_create_nonce('royesh_nonce_action'),
        'themeUrl'  => $theme_uri,
        'mapCoords' => [
            'lat' => get_theme_mod('royesh_map_lat', '35.7925'),
            'lng' => get_theme_mod('royesh_map_lng', '51.3780'),
        ]
    ]);
}
add_action('wp_enqueue_scripts', 'royesh_enqueue_scripts');

/**
 * بارگذاری استایل‌های خاص پنل مدیریت وردپرس و سفارشی‌سازی
 */
function royesh_enqueue_admin_styles() {
    wp_enqueue_style(
        'royesh-admin-style',
        ROYESH_THEME_URI . '/assets/css/customizer-controls.css',
        [],
        ROYESH_THEME_VERSION
    );
}
add_action('admin_enqueue_scripts', 'royesh_enqueue_admin_styles');
