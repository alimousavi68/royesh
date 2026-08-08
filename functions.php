<?php
/**
 * Royesh Theme Functions and Definitions
 * 
 * @package Royesh
 * @version 1.0.0
 */

if (!defined('ABSPATH')) {
    exit; // Exit if accessed directly
}

/**
 * کلید ثابت نسخه تم جهت مدیریت کش دارایی‌ها
 */
define('ROYESH_THEME_VERSION', time());
define('ROYESH_THEME_DIR', get_template_directory());
define('ROYESH_THEME_URI', get_template_directory_uri());

/**
 * بارگذاری ماژول‌های هسته تم از پوشه includes/
 */
$royesh_includes = [
    '/includes/setup.php',          // تنظیمات اصلی تم و پشتیبانی‌ها
    '/includes/enqueue.php',        // بارگذاری استایل‌ها و اسکریپت‌ها
    '/includes/sidebars.php',       // ثبت نواحی ویجتی و ابزارک‌ها
    '/includes/widgets.php',              // ابزارک‌های اختصاصی رویش
    '/includes/customizer.php',           // تنظیمات سفارشی‌سازی ادمین
    '/includes/security.php',       // هندلرهای امنیتی و Nonce
    '/includes/helpers.php',        // توابع کمکی عمومی
    '/includes/template-tags.php',  // توابع نمایش تگ‌های پویا
    '/includes/ajax-handlers.php',  // هندلرهای فرم و پردازش AJAX
    '/includes/inbox.php',          // صندوق پیام داخلی مدیریت
    '/includes/page-metaboxes.php', // متاباکس‌های اختصاصی و تنظیمات پیشرفته برگه‌ها
];

foreach ($royesh_includes as $file) {
    $filepath = ROYESH_THEME_DIR . $file;
    if (file_exists($filepath)) {
        require_once $filepath;
    }
}
