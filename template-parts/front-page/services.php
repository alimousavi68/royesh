<?php
/**
 * Services Section Template Part
 * 
 * @package Royesh
 * @version 1.0.0
 */

if (!defined('ABSPATH')) {
    exit; // Exit if accessed directly
}

$enable = get_theme_mod('royesh_services_enable', true);
if (!$enable) return;

$title = get_theme_mod('royesh_services_title', 'خدمات ما');
$desc  = get_theme_mod('royesh_services_desc', 'ارائه راهکارهای تخصصی متناسب با نیازهای نهادها و فعالان اقتصادی');

$bg_color       = get_theme_mod('royesh_serv_bg_color', '#004F40');
$title_color    = get_theme_mod('royesh_serv_title_color', '#ffffff');
$desc_color     = get_theme_mod('royesh_serv_desc_color', '#cccccc');
$card_bg        = get_theme_mod('royesh_serv_card_bg', '#082C23');
$card_border    = get_theme_mod('royesh_serv_card_border', '#2E7063');
$card_hover     = get_theme_mod('royesh_serv_card_hover', '#B1862D');
$btn_primary    = get_theme_mod('royesh_serv_btn_primary', '#B1862D');
$btn_secondary  = get_theme_mod('royesh_serv_btn_secondary', '#004F40');

$title_size_dt  = get_theme_mod('royesh_serv_title_size_dt', '36');
$title_size_mb  = get_theme_mod('royesh_serv_title_size_mb', '30');

$services_page_url = royesh_page_url('services');

// Card 1
$c1_title = get_theme_mod('royesh_serv_c1_title', 'خدمات تأمین مالی');
$c1_desc  = get_theme_mod('royesh_serv_c1_desc', 'طراحی و ارائـــــــه راهکارهای تأمین منابع مالی متناسب با ساختار و نــــیاز کسب‌وکارها.');
$c1_raw   = get_theme_mod('royesh_serv_c1_link', '');
$c1_link  = !empty($c1_raw) ? (str_starts_with($c1_raw, 'http') ? $c1_raw : (str_contains($c1_raw, '#') ? $services_page_url . substr($c1_raw, strpos($c1_raw, '#')) : home_url('/' . ltrim($c1_raw, '/')))) : $services_page_url . '#financing-services';

// Card 2
$c2_title = get_theme_mod('royesh_serv_c2_title', 'خدمات اعتباری');
$c2_desc  = get_theme_mod('royesh_serv_c2_desc', 'طراحی سازوکارهای اعتباری، ارزیابی ظرفیت‌ها و توســعه راهکارهای اعتباری مؤثـــــــر.');
$c2_raw   = get_theme_mod('royesh_serv_c2_link', '');
$c2_link  = !empty($c2_raw) ? (str_starts_with($c2_raw, 'http') ? $c2_raw : (str_contains($c2_raw, '#') ? $services_page_url . substr($c2_raw, strpos($c2_raw, '#')) : home_url('/' . ltrim($c2_raw, '/')))) : $services_page_url . '#credit-services';

// Card 3
$c3_title = get_theme_mod('royesh_serv_c3_title', 'مدیریت نقدینگی');
$c3_desc  = get_theme_mod('royesh_serv_c3_desc', 'ارزیـــــابی، ساخـــــــتاردهی و مدیریت داراییهــا با رویکرد خلق ارزش پایدار.');
$c3_raw   = get_theme_mod('royesh_serv_c3_link', '');
$c3_link  = !empty($c3_raw) ? (str_starts_with($c3_raw, 'http') ? $c3_raw : (str_contains($c3_raw, '#') ? $services_page_url . substr($c3_raw, strpos($c3_raw, '#')) : home_url('/' . ltrim($c3_raw, '/')))) : $services_page_url . '#liquidity-management';

// Card 4
$c4_title = get_theme_mod('royesh_serv_c4_title', 'مدیریت دارایی');
$c4_desc  = get_theme_mod('royesh_serv_c4_desc', 'ارزیـــــابی، ساخـــــــتاردهی و مدیریت داراییهــا با رویکرد خلق ارزش پایدار.');
$c4_raw   = get_theme_mod('royesh_serv_c4_link', '');
$c4_link  = !empty($c4_raw) ? (str_starts_with($c4_raw, 'http') ? $c4_raw : (str_contains($c4_raw, '#') ? $services_page_url . substr($c4_raw, strpos($c4_raw, '#')) : home_url('/' . ltrim($c4_raw, '/')))) : $services_page_url . '#asset-management';
?>

<style>
    #v-services-section {
        background-color: <?php echo esc_attr($bg_color); ?>;
        border-bottom-color: <?php echo esc_attr($card_border); ?>;
    }
    #v-services-headline {
        color: <?php echo esc_attr($title_color); ?>;
        font-size: <?php echo esc_attr($title_size_dt); ?>px;
    }
    #v-services-description {
        color: <?php echo esc_attr($desc_color); ?>;
        font-size: <?php echo esc_attr(get_theme_mod('royesh_services_desc_size', '15')); ?>px;
    }
    .v-serv-card {
        background-color: <?php echo esc_attr($card_bg); ?>;
        border-color: <?php echo esc_attr($card_border); ?>;
    }
    .v-serv-card h3 { color: <?php echo esc_attr($title_color); ?>; }
    .v-serv-card p { color: <?php echo esc_attr($desc_color); ?>; }
    .v-serv-card:hover {
        border-color: <?php echo esc_attr($card_hover); ?>;
    }
    .v-serv-btn-primary { background-color: <?php echo esc_attr($btn_primary); ?>; }
    .v-serv-btn-secondary {
        background-color: <?php echo esc_attr($btn_secondary); ?>;
        border-color: <?php echo esc_attr($card_border); ?>;
        border-width: 1px;
    }
    @media (max-width: 1023px) {
        #v-services-headline { font-size: <?php echo esc_attr($title_size_mb); ?>px; }
    }
    
    @keyframes arrow-bounce-rtl {
        0%, 100% { transform: translateX(0); }
        50% { transform: translateX(-10px); }
    }
    @keyframes arrow-bounce-down {
        0%, 100% { transform: translateY(0) rotate(-90deg); }
        50% { transform: translateY(10px) rotate(-90deg); }
    }
    .animate-arrow-bounce {
        animation: arrow-bounce-rtl 1.5s infinite ease-in-out;
    }
    @media (max-width: 1023px) {
        .animate-arrow-bounce {
            animation: arrow-bounce-down 1.5s infinite ease-in-out;
        }
    }
</style>

<section id="v-services-section" dir="rtl" class="relative w-full py-20 px-4 md:px-12 overflow-hidden border-b">
    
    <div class="absolute inset-0 opacity-100 pointer-events-none select-none z-0">
        <img src="<?php echo royesh_asset_img('bg vector patt.svg'); ?>" alt="Pattern" class="w-full h-full object-cover" />
    </div>

    <div class="absolute top-[20%] left-[10%] w-[450px] h-[450px] rounded-full blur-[120px] pointer-events-none z-0" style="background-color: <?php echo esc_attr($card_border); ?>; opacity: 0.25;"></div>
    <div class="absolute bottom-[10%] right-[5%] w-[350px] h-[350px] rounded-full blur-[100px] pointer-events-none z-0" style="background-color: <?php echo esc_attr($card_hover); ?>; opacity: 0.1;"></div>

    <div class="max-w-[1150px] mx-auto relative z-10">
        <div class="flex flex-col lg:flex-row items-center lg:items-start justify-between gap-12 lg:gap-16">
            
            <!-- RIGHT COLUMN -->
            <div id="v-services-intro-column" class="w-full lg:w-[26%] flex flex-col items-start text-right text-white v-reveal v-reveal-fade-right">
                <img src="<?php echo royesh_asset_img('services/edit.svg'); ?>" alt="<?php esc_attr_e('ویرایش', 'royesh'); ?>" class="w-[35px] h-[38px] object-contain mb-6" />

                <h2 id="v-services-headline" class="font-extrabold tracking-tight leading-tight md:leading-normal">
                    <?php echo esc_html($title); ?>
                </h2>

                <p id="v-services-description" class="mt-4 leading-relaxed font-light">
                    <?php echo nl2br(esc_html($desc)); ?>
                </p>

                <div id="v-services-chevron-indicator" class="w-full flex justify-center lg:justify-end mt-8 text-white">
                    <img src="<?php echo royesh_asset_img('services/arrow 3 (1).svg'); ?>" alt="Indicator" class="h-4 w-auto object-contain animate-arrow-bounce" />
                </div>
            </div>

            <!-- LEFT COLUMN: Grid on mobile, horizontal row on desktop -->
            <div id="v-services-cards-column" class="w-full lg:w-[74%] pb-8 lg:pb-0">
                <div class="grid grid-cols-2 gap-x-4 gap-y-10 sm:gap-x-6 sm:gap-y-12 justify-items-center lg:flex lg:items-start lg:justify-between lg:min-w-0 lg:gap-5 px-2 pt-2 pb-12">

                    <!-- CARD 4 -->
                    <div id="v-service-card-4" class="v-serv-card w-full max-w-[212px] lg:w-[212px] lg:min-w-[212px] h-[301px] border-2 rounded-t-[106px] rounded-b-[18px] flex flex-col items-center p-4 pt-6 transition-all duration-200 cursor-pointer hover:-translate-y-2 hover:shadow-[0px_10px_30px_rgba(0,0,0,0.3)] select-none v-reveal v-reveal-fade-up v-delay-400">
                        <img src="<?php echo royesh_asset_img('services/s-4.svg'); ?>" alt="<?php esc_attr_e('مدیریت دارایی', 'royesh'); ?>" class="h-[41px] w-[43px] object-contain" />
                        <h3 class="font-bold text-[15px] sm:text-base mt-4 text-center tracking-tight">
                            <?php echo esc_html($c4_title); ?>
                        </h3>
                        <p class="text-xs text-center mt-3 leading-relaxed font-light px-1 opacity-70">
                            <?php echo esc_html($c4_desc); ?>
                        </p>
                        <a href="<?php echo esc_url($c4_link); ?>" class="v-serv-btn-secondary w-[116px] h-[46px] rounded-[12px] hover:opacity-80 active:scale-95 transition-all duration-300 flex items-center justify-center text-white text-xs font-bold mt-auto cursor-pointer">
                            <?php esc_html_e('اطلاعات بیشتر', 'royesh'); ?>
                        </a>
                    </div>

                    <!-- CARD 3 -->
                    <div id="v-service-card-3" class="v-serv-card w-full max-w-[212px] lg:w-[212px] lg:min-w-[212px] h-[301px] border-2 rounded-t-[106px] rounded-b-[18px] flex flex-col items-center p-4 pt-6 transition-all duration-200 cursor-pointer hover:-translate-y-2 hover:shadow-[0px_10px_30px_rgba(0,0,0,0.3)] select-none lg:mt-[42px] v-reveal v-reveal-fade-up v-delay-300">
                        <img src="<?php echo royesh_asset_img('services/s-3.svg'); ?>" alt="<?php esc_attr_e('مدیریت نقدینگی', 'royesh'); ?>" class="h-[40px] w-[44px] object-contain" />
                        <h3 class="font-bold text-[15px] sm:text-base mt-4 text-center tracking-tight">
                            <?php echo esc_html($c3_title); ?>
                        </h3>
                        <p class="text-xs text-center mt-3 leading-relaxed font-light px-1 opacity-70">
                            <?php echo esc_html($c3_desc); ?>
                        </p>
                        <a href="<?php echo esc_url($c3_link); ?>" class="v-serv-btn-primary w-[116px] h-[46px] rounded-[12px] hover:opacity-80 active:scale-95 transition-all duration-300 flex items-center justify-center text-white text-xs font-bold mt-auto cursor-pointer">
                            <?php esc_html_e('اطلاعات بیشتر', 'royesh'); ?>
                        </a>
                    </div>

                    <!-- CARD 2 -->
                    <div id="v-service-card-2" class="v-serv-card w-full max-w-[212px] lg:w-[212px] lg:min-w-[212px] h-[301px] border-2 rounded-t-[106px] rounded-b-[18px] flex flex-col items-center p-4 pt-6 transition-all duration-200 cursor-pointer hover:-translate-y-2 hover:shadow-[0px_10px_30px_rgba(0,0,0,0.3)] select-none v-reveal v-reveal-fade-up v-delay-200">
                        <img src="<?php echo royesh_asset_img('services/s-2.svg'); ?>" alt="<?php esc_attr_e('خدمات اعتباری', 'royesh'); ?>" class="h-[38px] w-[44px] object-contain" />
                        <h3 class="font-bold text-[15px] sm:text-base mt-4 text-center tracking-tight">
                            <?php echo esc_html($c2_title); ?>
                        </h3>
                        <p class="text-xs text-center mt-3 leading-relaxed font-light px-1 opacity-70">
                            <?php echo esc_html($c2_desc); ?>
                        </p>
                        <a href="<?php echo esc_url($c2_link); ?>" class="v-serv-btn-secondary w-[116px] h-[46px] rounded-[12px] hover:opacity-80 active:scale-95 transition-all duration-300 flex items-center justify-center text-white text-xs font-bold mt-auto cursor-pointer">
                            <?php esc_html_e('اطلاعات بیشتر', 'royesh'); ?>
                        </a>
                    </div>

                    <!-- CARD 1 -->
                    <div id="v-service-card-1" class="v-serv-card w-full max-w-[212px] lg:w-[212px] lg:min-w-[212px] h-[301px] border-2 rounded-t-[106px] rounded-b-[18px] flex flex-col items-center p-4 pt-6 transition-all duration-200 cursor-pointer hover:-translate-y-2 hover:shadow-[0px_10px_30px_rgba(0,0,0,0.3)] select-none lg:mt-[42px] v-reveal v-reveal-fade-up v-delay-100">
                        <img src="<?php echo royesh_asset_img('services/s-1.svg'); ?>" alt="<?php esc_attr_e('خدمات تأمین مالی', 'royesh'); ?>" class="h-[43px] w-[40px] object-contain" />
                        <h3 class="font-bold text-[15px] sm:text-base mt-4 text-center tracking-tight">
                            <?php echo esc_html($c1_title); ?>
                        </h3>
                        <p class="text-xs text-center mt-3 leading-relaxed font-light px-1 opacity-70">
                            <?php echo esc_html($c1_desc); ?>
                        </p>
                        <a href="<?php echo esc_url($c1_link); ?>" class="v-serv-btn-primary w-[116px] h-[46px] rounded-[12px] hover:opacity-80 active:scale-95 transition-all duration-300 flex items-center justify-center text-white text-xs font-bold mt-auto cursor-pointer">
                            <?php esc_html_e('اطلاعات بیشتر', 'royesh'); ?>
                        </a>
                    </div>

                </div>
            </div>

        </div>
    </div>
</section>
