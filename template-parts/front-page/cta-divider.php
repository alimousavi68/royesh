<?php
/**
 * CTA Divider Section Template Part
 * 
 * @package Royesh
 * @version 1.0.0
 */

if (!defined('ABSPATH')) {
    exit; // Exit if accessed directly
}

$enable = get_theme_mod('royesh_cta_enable', true);
if (!$enable) return;

$badge = get_theme_mod('royesh_cta_badge', 'فرصت‌های رشد پایدار');
$title = get_theme_mod('royesh_cta_title', 'توسعه مالی با نگاهی آینده‌محور');
$desc  = get_theme_mod('royesh_cta_desc', 'جهت آشنایی بیشتر با خدمات و ظرفیت‌های همکاری، با ما در ارتباط باشید.');
$btn_text = get_theme_mod('royesh_cta_btn_text', 'تماس با ما');
$btn_url  = get_theme_mod('royesh_cta_btn_url', '/contact');

$badge_color = get_theme_mod('royesh_cta_badge_color', '#E8D2AF');
$title_color = get_theme_mod('royesh_cta_title_color', '#ffffff');
$desc_color  = get_theme_mod('royesh_cta_desc_color', '#E2E8F0');
$btn_color   = get_theme_mod('royesh_cta_btn_color', '#ffffff');
$btn_bg      = get_theme_mod('royesh_cta_btn_bg', '#004F40');
$btn_hover   = get_theme_mod('royesh_cta_btn_hover', '#003b30');
$title_size  = get_theme_mod('royesh_cta_title_size', '36');
$desc_size   = get_theme_mod('royesh_cta_desc_size', '18');
$bg_image    = get_theme_mod('royesh_cta_bg_image', royesh_asset_img('sustainable.jpg'));
?>

<style>
    #v-cta-badge {
        color: <?php echo esc_attr($badge_color); ?>;
    }
    #v-cta-title {
        color: <?php echo esc_attr($title_color); ?>;
        font-size: <?php echo esc_attr($title_size); ?>px;
    }
    #v-cta-desc {
        color: <?php echo esc_attr($desc_color); ?>;
        font-size: <?php echo esc_attr($desc_size); ?>px;
    }
    #v-cta-btn {
        background-color: <?php echo esc_attr($btn_bg); ?>;
        color: <?php echo esc_attr($btn_color); ?>;
    }
    #v-cta-btn:hover {
        background-color: <?php echo esc_attr($btn_hover); ?>;
    }
</style>

<section id="v-cta-divider" dir="rtl" class="w-full relative py-20 px-4 flex items-center justify-center overflow-hidden select-none">
    <div class="absolute inset-0 bg-cover bg-center" 
         style="background-image: url('<?php echo esc_url($bg_image); ?>');">
    </div>

    <div class="absolute inset-0 bg-[#081b17]/50 backdrop-blur-[1px]"></div>

    <div class="absolute top-0 left-0 w-full h-[1px] bg-gradient-to-r from-transparent via-[#E8D2AF]/30 to-transparent"></div>
    <div class="absolute bottom-0 left-0 w-full h-[1px] bg-gradient-to-r from-transparent via-[#E8D2AF]/30 to-transparent"></div>

    <div class="relative z-10 flex flex-col items-center text-center max-w-3xl mx-auto px-4 v-reveal v-reveal-fade-up">
        
        <span id="v-cta-badge" class="text-xs sm:text-sm font-bold tracking-wider uppercase mb-3 px-3 py-1 bg-white/5 border border-white/10 rounded-full backdrop-blur-md">
            <?php echo esc_html($badge); ?>
        </span>

        <h2 id="v-cta-title" class="font-extrabold mb-4 leading-tight">
            <?php echo esc_html($title); ?>
        </h2>

        <p id="v-cta-desc" class="text-sm md:text-lg font-normal mb-8 leading-relaxed max-w-2xl">
            <?php echo nl2br(esc_html($desc)); ?>
        </p>

        <?php
        $btn_url_custom = get_theme_mod('royesh_cta_btn_url', '');
        $cta_btn_link   = !empty($btn_url_custom) ? (str_starts_with($btn_url_custom, 'http') ? $btn_url_custom : home_url('/' . ltrim($btn_url_custom, '/'))) : royesh_page_url('contact');
        ?>
        <a id="v-cta-btn" href="<?php echo esc_url($cta_btn_link); ?>" class="inline-flex items-center justify-center px-8 py-3.5 rounded-2xl font-bold text-base transition-all duration-300 hover:scale-[1.03] shadow-lg hover:shadow-emerald-950/40 border border-emerald-800/50">
            <?php echo esc_html($btn_text); ?>
        </a>
        
    </div>
</section>
