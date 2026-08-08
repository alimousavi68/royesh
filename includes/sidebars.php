<?php
/**
 * Register Sidebars & Widget Areas
 * 
 * @package Royesh
 * @version 1.0.0
 */

if (!defined('ABSPATH')) {
    exit; // Exit if accessed directly
}

/**
 * ثبت سایدبارها و نواحی ابزارک‌های پوسته
 */
function royesh_widgets_init() {
    // ۱. سایدبار وبلاگ و مقالات
    register_sidebar([
        'name'          => __('سایدبار مقالات و اخبار', 'royesh'),
        'id'            => 'royesh-sidebar-blog',
        'description'   => __('محل قرارگیری ابزارک‌های جانبی در صفحات وبلاگ و جزئیات مقاله', 'royesh'),
        'before_widget' => '<div id="%1$s" class="widget bg-white p-6 rounded-[24px] border border-[#EBE5D7]/50 shadow-sm mb-6 %2$s">',
        'after_widget'  => '</div>',
        'before_title'  => '<h3 class="text-lg font-bold text-[#014235] mb-4 pb-2 border-b border-[#EBE5D7]/60 font-heading">',
        'after_title'   => '</h3>',
    ]);

    // ۲. سایدبار تاپ‌بار
    register_sidebar([
        'name'          => __('تاپ‌بار راست (اطلاعات تماس)', 'royesh'),
        'id'            => 'royesh-topbar-right',
        'description'   => __('محل قرارگیری اطلاعات تماس سریع در بالای هدر', 'royesh'),
        'before_widget' => '<div id="%1$s" class="widget %2$s">',
        'after_widget'  => '</div>',
        'before_title'  => '<h4 class="hidden">',
        'after_title'   => '</h4>',
    ]);

    // ۳. نواحی چهارگانه ستون‌های فوتر
    for ($i = 1; $i <= 4; $i++) {
        register_sidebar([
            'name'          => sprintf(__('فوتر — ستون %d', 'royesh'), $i),
            'id'            => 'royesh-footer-col-' . $i,
            'description'   => sprintf(__('محتوای ستون شماره %d در فوتر سایت', 'royesh'), $i),
            'before_widget' => '<div id="%1$s" class="footer-widget %2$s mb-6">',
            'after_widget'  => '</div>',
            'before_title'  => '<h3 class="text-lg font-bold text-white mb-4 font-heading">',
            'after_title'   => '</h3>',
        ]);
    }
}
add_action('widgets_init', 'royesh_widgets_init');
