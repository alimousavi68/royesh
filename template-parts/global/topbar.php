<?php
/**
 * Global Topbar Component
 * 
 * @package Royesh
 * @version 1.1.0
 */

if (!defined('ABSPATH')) {
    exit; // Exit if accessed directly
}

$promo_text    = get_theme_mod('royesh_topbar_promo', 'آینده مالی کسب‌و‌کارتان را هوشمندانه طراحی می‌کنیم!');
$phone         = get_theme_mod('royesh_phone', '۰۲۱ ۵۵۵ ۸۴۶۵');
$phone_raw     = preg_replace('/[^\d\+]/', '', $phone);
$topbar_height = get_theme_mod('royesh_topbar_height', '44');
?>
<!-- Topbar with sleek compact height and perfect vertical centering -->
<div id="v-topbar" dir="rtl" class="w-full bg-[#014235] select-none transition-all duration-300 flex items-center" style="min-height: <?php echo esc_attr($topbar_height); ?>px; height: <?php echo esc_attr($topbar_height); ?>px;">
    <div id="v-topbar-content" class="hidden md:flex justify-between items-center max-w-[1440px] mx-auto w-full text-xs md:text-sm px-4 md:px-12 font-sans h-full">
        <!-- Right Side Text (Vertically Centered) -->
        <div id="v-topbar-promo" class="text-white font-medium flex items-center h-full text-[13px] leading-none">
            <?php echo esc_html($promo_text); ?>
        </div>

        <!-- Left Side Actions / Info (Vertically Centered) -->
        <div id="v-topbar-contact" class="flex items-center gap-3 h-full text-[13px] leading-none">
            <span class="text-white text-opacity-95"><?php esc_html_e('جهت ارتباط با ما تماس بگیرید.', 'royesh'); ?></span>
            <a href="tel:<?php echo esc_attr($phone_raw); ?>" id="v-topbar-phone" class="flex items-center gap-1.5 text-[#d8d0c1] hover:text-white transition-all duration-200 font-bold" dir="ltr">
                <img src="<?php echo royesh_asset_img('phone-call.svg'); ?>" alt="<?php esc_attr_e('تماس با رویش', 'royesh'); ?>" class="w-3.5 h-3.5 object-contain" id="v-topbar-phone-icon" />
                <span class="tracking-wide text-xs"><?php echo esc_html($phone); ?></span>
            </a>
        </div>
    </div>
</div>
