<?php
/**
 * Hero Section & Features Bar Template Part
 * 
 * @package Royesh
 * @version 1.0.0
 */

if (!defined('ABSPATH')) {
    exit; // Exit if accessed directly
}
?>
<!-- Main Hero Section -->
<section id="v-hero-section" dir="rtl" class="w-full min-h-[73vh] md:min-h-[73vh] flex items-center relative overflow-hidden bg-[#021A15]">
    
    <!-- Background overlay -->
    <div id="v-hero-bg" class="absolute inset-0 select-none pointer-events-none z-0 overflow-hidden">
        <div class="v-hero-bg-entrance absolute inset-0">
            <div class="v-hero-bg-float absolute inset-0 bg-cover bg-center" 
                 style="background-image: linear-gradient(135deg, rgba(1, 53, 42, 0.72) 0%, rgba(2, 26, 21, 0.65) 100%), url('<?php echo esc_url(get_theme_mod('royesh_hero_bg_image', royesh_asset_img('r-hero-section.jpg'))); ?>'); filter: saturate(1.35) contrast(1.12);">
            </div>
            <!-- Floating golden bokeh particles -->
            <canvas id="v-hero-particles" class="absolute inset-0 w-full h-full pointer-events-none mix-blend-screen opacity-70"></canvas>
        </div>
    </div>

    <!-- Radiant Ambient Light Effect -->
    <div class="absolute top-[-10%] left-[-10%] w-[50%] h-[60%] rounded-full bg-radial from-[#0A6B5B]/25 to-transparent blur-[120px] pointer-events-none"></div>

    <!-- Container wrapper -->
    <div id="v-hero-container" class="max-w-[1440px] mx-auto w-full px-4 md:px-12 relative z-10 py-12 md:py-20 flex flex-col justify-center items-start text-right">
        
        <!-- Headline Area -->
        <h1 class="v-hero-fade text-[44px] sm:text-[36px] md:text-[44px] font-extrabold text-white tracking-tight leading-tight mb-4">
            <?php echo esc_html(get_theme_mod('royesh_hero_title_main', 'گروه اقتصادی')); ?> <span id="v-hero-title-accent" class="text-[#B58A33] font-black"><?php echo esc_html(get_theme_mod('royesh_hero_title_accent', 'رویش سرمایه')); ?></span>
        </h1>

        <!-- Tagline Pill Frame -->
        <div class="v-hero-fade mb-8">
            <div id="v-hero-tagline-container" style="background: rgba(244, 240, 234, 0.21); backdrop-filter: blur(19.45px); border-radius: 22.2473px;" class="px-5 py-2 border border-white/10 inline-block">
                <span id="v-hero-tagline" class="text-white text-xs md:text-[23px] font-medium tracking-wide flex items-center gap-2">
                    <span class="w-1.5 h-1.5 rounded-full bg-[#B58A33] animate-pulse"></span>
                    <?php echo esc_html(get_theme_mod('royesh_hero_tagline', 'ریشـــــه مالی، رشد پایدار ...')); ?>
                </span>
            </div>
        </div>

        <!-- Descriptive summary text -->
        <p id="v-hero-description" class="v-hero-fade max-w-2xl text-white/90 text-sm font-extralight sm:text-lg md:text-[18px] sm:font-light leading-relaxed mb-8">
            <?php echo esc_html(get_theme_mod('royesh_hero_desc', 'گروه اقتصادی رویش سرمایه، با رویکـــــــــردی راه حل محور و نوآورانه، در مســیر طراحی راهکارهای مالی مؤثر، توسعه نهــادهای تـــخصصی و خلق مدل‌های نوین کــسب و کار مالی گام برمیدارد.')); ?>
        </p>

        <!-- Action Buttons -->
        <div id="v-hero-actions" class="v-hero-fade flex flex-wrap items-center gap-3 sm:gap-4">
            <?php 
            $hero_btn_url  = get_theme_mod('royesh_hero_btn_url', '');
            $hero_btn_link = !empty($hero_btn_url) ? (str_starts_with($hero_btn_url, 'http') ? $hero_btn_url : home_url('/' . ltrim($hero_btn_url, '/'))) : royesh_page_url('about');
            ?>
            <a href="<?php echo esc_url($hero_btn_link); ?>" id="v-hero-btn-about" class="px-5 py-2.5 sm:px-8 sm:py-3 bg-white text-[#014235] rounded-full text-sm sm:text-[22px] font-bold shadow-md hover:bg-[#F5F4EE] hover:scale-[1.03] transition-all duration-300">
                <?php echo esc_html(get_theme_mod('royesh_hero_btn_text', 'درباره ما')); ?>
            </a>
        </div>

    </div>

</section>

<?php if (get_theme_mod('royesh_features_bar_enable', true)) : ?>
<!-- Attached Bottom Features Bar -->
<?php
// دریافت آیتم‌های نوار از Customizer
$features_raw   = get_theme_mod('royesh_features_bar_items', '');
$features_items = json_decode($features_raw, true);
if (empty($features_items) || !is_array($features_items)) {
    $features_items = [
        ['text' => 'راهکارهای نوین مالی و دیجیتال', 'enabled' => true],
        ['text' => 'توسعه کسب‌وکار و نهادسازی',    'enabled' => true],
        ['text' => 'طراحی ساختار و استراتژی',        'enabled' => true],
        ['text' => 'تأمین مالی و خدمات اعتباری',     'enabled' => true],
        ['text' => 'مشاوره و مدیریت مالی',          'enabled' => true],
    ];
}
// فقط آیتم‌های فعال
$active_items = array_filter($features_items, fn($item) => !empty($item['enabled']));
$speed        = get_theme_mod('royesh_featbar_marquee_speed', '25');
?>
<div id="v-features-bar" dir="rtl" class="v-features-bar-fade w-full bg-[#F0EDE3] border-b border-[#DED6CA] relative z-20">

    <style>
        @keyframes marquee-rtl {
            0% { transform: translateX(0); }
            100% { transform: translateX(50%); }
        }
        .animate-marquee-rtl {
            animation: marquee-rtl <?php echo esc_attr($speed); ?>s linear infinite;
        }
        .animate-marquee-rtl:hover {
            animation-play-state: paused;
        }
    </style>

    <div class="absolute top-[4px] right-0 w-[55%] h-[10px] transform -translate-y-[13px] pointer-events-none">
        <svg class="w-full h-full text-[#B58A33]" viewBox="0 0 400 8" preserveAspectRatio="none" fill="currentColor">
            <path d="M 400,8 L 400,0 L 150,4 Q 50,7 0,8 Z" />
        </svg>
    </div>

    <div class="max-w-[1440px] mx-auto px-4 md:px-12 py-5 overflow-hidden">

        <!-- Mobile & Tablet: Infinite Marquee -->
        <div class="lg:hidden w-full overflow-hidden relative py-1">
            <div class="flex gap-8 w-max animate-marquee-rtl">
                <div class="flex gap-8 shrink-0">
                    <?php foreach ($active_items as $item) : ?>
                        <div class="v-feature-item flex items-center gap-3 py-1.5 px-3 rounded-lg hover:bg-black/5 transition-all">
                            <div class="w-[22px] h-[22px] rounded-full bg-[#B58A33] flex items-center justify-center shadow-sm flex-shrink-0">
                                <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round" class="w-[18px] h-[18px] text-white">
                                    <polyline points="20 6 9 17 4 12"></polyline>
                                </svg>
                            </div>
                            <span class="text-[14px] md:text-[15px] xl:text-[17px] font-normal text-gray-800 leading-none whitespace-nowrap">
                                <?php echo esc_html($item['text']); ?>
                            </span>
                        </div>
                    <?php endforeach; ?>
                </div>
            </div>
        </div>

        <!-- Desktop Grid View -->
        <div id="v-features-inner-container" class="hidden lg:flex justify-between items-center gap-3">
            <?php foreach ($active_items as $item) : ?>
                <div class="v-feature-item flex items-center gap-3 py-1.5 px-3 rounded-lg hover:bg-black/5 transition-all">
                    <div class="w-[22px] h-[22px] rounded-full bg-[#B58A33] flex items-center justify-center shadow-sm flex-shrink-0">
                        <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round" class="w-[18px] h-[18px] text-white">
                            <polyline points="20 6 9 17 4 12"></polyline>
                        </svg>
                    </div>
                    <span class="text-[14px] md:text-[15px] xl:text-[17px] font-normal text-gray-800 leading-none">
                        <?php echo esc_html($item['text']); ?>
                    </span>
                </div>
            <?php endforeach; ?>
        </div>
    </div>

    <div class="absolute bottom-[4px] left-0 w-[55%] h-[10px] transform translate-y-[13px] pointer-events-none">
        <svg class="w-full h-full text-[#B58A33]" viewBox="0 0 400 8" preserveAspectRatio="none" fill="currentColor">
            <path d="M 0,0 L 0,8 L 250,4 Q 350,1 400,0 Z" />
        </svg>
    </div>

</div>
<?php endif; ?>

