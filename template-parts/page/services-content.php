<?php
/**
 * Services Page Content Template Part
 * 
 * @package Royesh
 * @version 1.1.0
 */

if (!defined('ABSPATH')) {
    exit; // Exit if accessed directly
}

$post_id = get_the_ID();

// مقادیر پویا از متاباکس برگه
$hero_enable  = royesh_get_page_meta($post_id, '_royesh_hero_enable', '1');
$hero_badge   = royesh_get_page_meta($post_id, '_royesh_hero_badge', __('رویش سرمایه', 'royesh'));
$hero_title   = royesh_get_page_meta($post_id, '_royesh_hero_title', get_the_title());
$hero_desc    = royesh_get_page_meta($post_id, '_royesh_hero_desc', __('ما در رویش، با تکیه بر تحلیل‌های دقیق و شناخت بازار، راهکارهایی هوشمندانه و شخصی‌سازی شده برای توسعه ظرفیت‌های مالی و کسب‌وکار شما ارائه می‌دهیم.', 'royesh'));
$hero_bg      = royesh_get_page_meta($post_id, '_royesh_hero_bg_color', '#004F40');

// خدمت ۱: خدمات تأمین مالی
$srv_1_badge   = royesh_get_page_meta($post_id, '_royesh_srv_1_badge', __('شتاب‌دهنده رشد', 'royesh'));
$srv_1_title   = royesh_get_page_meta($post_id, '_royesh_srv_1_title', __('خدمات تأمین مالی', 'royesh'));
$srv_1_desc    = royesh_get_page_meta($post_id, '_royesh_srv_1_desc', __('طراحی و ارائه راهکارهای تأمین منابع مالی متناسب با ساختار و نیاز کسب‌وکارها، به عنوان شتاب‌دهنده‌ای برای رشد و توسعه پایدار سازمان شما عمل می‌کند. ما در این مسیر تمام مراحل را هموار می‌سازیم.', 'royesh'));
$srv_1_bullets = royesh_get_page_meta($post_id, '_royesh_srv_1_bullets', "تأمین مالی از طریق بازار پول و بازار سرمایه\nطراحی و انتشار اوراق بهادار و مشارکت\nجذب سرمایه‌گذار و هم‌سرمایه‌گذاری ریسک‌پذیر\nساختاردهی به مشارکت‌های استراتژیک مالی");
$srv_1_btn     = royesh_get_page_meta($post_id, '_royesh_srv_1_btn', __('درخواست مشاوره تأمین مالی', 'royesh'));
$srv_1_items   = array_filter(array_map('trim', explode("\n", $srv_1_bullets)));

// خدمت ۲: خدمات اعتباری
$srv_2_badge   = royesh_get_page_meta($post_id, '_royesh_srv_2_badge', __('توسعه اعتبار', 'royesh'));
$srv_2_title   = royesh_get_page_meta($post_id, '_royesh_srv_2_title', __('خدمات اعتباری', 'royesh'));
$srv_2_desc    = royesh_get_page_meta($post_id, '_royesh_srv_2_desc', __('طراحی سازوکارهای اعتباری، ارزیابی ظرفیت‌ها و توسعه راهکارهای اعتباری مؤثر به شما کمک می‌کند تا بهینه‌ترین منابع اعتباری بازار را با حداقل ریسک و فرآیند اداری دریافت کنید.', 'royesh'));
$srv_2_bullets = royesh_get_page_meta($post_id, '_royesh_srv_2_bullets', "مشاوره و تسهیل اخذ تسهیلات بانکی\nتسهیل فرآیند صدور ضمانت‌نامه‌ها و اعتبارات اسنادی\nارزیابی و رتبه‌بندی اعتباری شرکت‌ها\nطراحی و تحلیل خط‌مشی‌های اعتباردهی به مشتریان");
$srv_2_btn     = royesh_get_page_meta($post_id, '_royesh_srv_2_btn', __('درخواست مشاوره خدمات اعتباری', 'royesh'));
$srv_2_items   = array_filter(array_map('trim', explode("\n", $srv_2_bullets)));

// خدمت ۳: مدیریت نقدینگی
$srv_3_badge   = royesh_get_page_meta($post_id, '_royesh_srv_3_badge', __('پویایی مالی', 'royesh'));
$srv_3_title   = royesh_get_page_meta($post_id, '_royesh_srv_3_title', __('مدیریت نقدینگی', 'royesh'));
$srv_3_desc    = royesh_get_page_meta($post_id, '_royesh_srv_3_desc', __('بهینه‌سازی جریان‌های نقدی و ارتقای بازدهی منابع کوتاه‌مدت، تضمین‌کننده بقا و پویایی روزمره هر کسب‌وکار در شرایط متغیر اقتصادی است. با رویکردهای تخصصی ما جریان‌های نقدی خود را ایمن کنید.', 'royesh'));
$srv_3_bullets = royesh_get_page_meta($post_id, '_royesh_srv_3_bullets', "پیش‌بینی هوشمند و منظم جریان وجوه نقد\nمدیریت و بهینه‌سازی سرمایه در گردش\nطراحی الگوهای بهینه پرداخت و دریافت\nمدیریت سرمایه‌گذاری‌های کوتاه‌مدت وجوه مازاد");
$srv_3_btn     = royesh_get_page_meta($post_id, '_royesh_srv_3_btn', __('درخواست مشاوره نقدینگی', 'royesh'));
$srv_3_items   = array_filter(array_map('trim', explode("\n", $srv_3_bullets)));

// خدمت ۴: مدیریت دارایی
$srv_4_badge   = royesh_get_page_meta($post_id, '_royesh_srv_4_badge', __('ارزش‌آفرینی پایدار', 'royesh'));
$srv_4_title   = royesh_get_page_meta($post_id, '_royesh_srv_4_title', __('مدیریت دارایی', 'royesh'));
$srv_4_desc    = royesh_get_page_meta($post_id, '_royesh_srv_4_desc', __('ارزیابی، ساختاردهی و مدیریت استراتژیک دارایی‌ها با رویکرد خلق ارزش پایدار، به شما کمک می‌کند ارزش دارایی‌های خود را در بلندمدت حفظ کرده و توسعه دهید.', 'royesh'));
$srv_4_bullets = royesh_get_page_meta($post_id, '_royesh_srv_4_bullets', "تشکیل و مدیریت پرتفوی اختصاصی متناسب با اهداف ریسک\nارزیابی و ارزش‌گذاری علمی دارایی‌های مشهود و نامشهود\nمشاوره در زمینه بهینه‌سازی سبد دارایی‌ها\nپایش مستمر و بازنگری دوره‌ای عملکرد سبد سرمایه‌گذاری");
$srv_4_btn     = royesh_get_page_meta($post_id, '_royesh_srv_4_btn', __('درخواست مشاوره مدیریت دارایی', 'royesh'));
$srv_4_items   = array_filter(array_map('trim', explode("\n", $srv_4_bullets)));
?>

<?php if ($hero_enable !== '0') : ?>
<!-- PAGE HERO SECTION -->
<section class="relative w-full py-20 px-4 md:px-12 overflow-hidden border-b border-[#2E7063] bg-[#004F40]" style="background-color: <?php echo esc_attr(!empty($hero_bg) && $hero_bg !== '#ffffff' ? $hero_bg : '#004F40'); ?>;">
    <div class="absolute inset-0 opacity-100 pointer-events-none select-none z-0">
        <img src="<?php echo royesh_asset_img('bg vector patt.svg'); ?>" alt="Pattern" class="w-full h-full object-cover" />
    </div>
    <div class="absolute top-[10%] left-[10%] w-[350px] h-[350px] rounded-full bg-[#2E7063]/25 blur-[100px] pointer-events-none z-0"></div>
    <div class="absolute bottom-[5%] right-[5%] w-[250px] h-[250px] rounded-full bg-[#B1862D]/10 blur-[80px] pointer-events-none z-0"></div>

    <div class="max-w-[1150px] mx-auto relative z-10 text-center text-white">
        <span class="text-[#B1862D] text-sm md:text-base font-bold tracking-wider block mb-3 font-sans"><?php echo esc_html($hero_badge); ?></span>
        <h1 class="text-3xl md:text-5xl font-black leading-tight mb-6"><?php echo esc_html($hero_title); ?></h1>
        <p class="text-white/80 text-base md:text-lg max-w-2xl mx-auto leading-relaxed font-light">
            <?php echo esc_html($hero_desc); ?>
        </p>
    </div>
</section>
<?php endif; ?>

<!-- SERVICES DETAILS SECTION -->
<section class="w-full py-20 px-4 md:px-12 relative">
    <div class="max-w-[1150px] mx-auto flex flex-col gap-24">

        <!-- SERVICE 1: خدمات تأمین مالی -->
        <div id="financing-services" class="grid grid-cols-1 lg:grid-cols-12 gap-10 items-center scroll-mt-24 v-reveal v-reveal-fade-up">
            <div class="lg:col-span-5 flex justify-center order-2 lg:order-1">
                <div class="relative w-[280px] h-[350px] bg-[#004F40] rounded-t-[140px] rounded-b-[24px] border-2 border-[#B1862D] flex flex-col items-center justify-center p-8 shadow-xl">
                    <div class="v-divider-dots-bg absolute inset-0 opacity-10 rounded-t-[140px] rounded-b-[24px]"></div>
                    <img src="<?php echo royesh_asset_img('services/s-1.svg'); ?>" alt="<?php echo esc_attr($srv_1_title); ?>" class="w-24 h-24 object-contain z-10 mb-6 transition-transform duration-300 hover:scale-110" />
                    <div class="text-[#E8D2AF] text-sm font-semibold tracking-wide border border-[#E8D2AF]/20 px-4 py-1.5 rounded-full bg-[#014235] z-10"><?php esc_html_e('سرمایه‌گذاری پویا', 'royesh'); ?></div>
                </div>
            </div>
            <div class="lg:col-span-7 text-right order-1 lg:order-2">
                <span class="text-[#B1862D] font-bold text-[11px] tracking-wider block mb-2"><?php echo esc_html($srv_1_badge); ?></span>
                <h2 class="text-2xl md:text-3xl font-extrabold text-[#014235] mb-4"><?php echo esc_html($srv_1_title); ?></h2>
                <div class="w-20 h-1 bg-[#B1862D] mb-6 rounded-full"></div>
                <p class="text-[#333333] text-base leading-relaxed mb-6 font-normal">
                    <?php echo nl2br(esc_html($srv_1_desc)); ?>
                </p>
                <ul class="v-service-bullets v-reveal v-reveal-fade-up grid grid-cols-1 md:grid-cols-2 gap-4 text-sm text-gray-700 mb-8">
                    <?php foreach ($srv_1_items as $item) : ?>
                        <li class="flex items-center gap-2">
                            <span class="w-2 h-2 rounded-full bg-[#B1862D] shrink-0"></span>
                            <span><?php echo esc_html($item); ?></span>
                        </li>
                    <?php endforeach; ?>
                </ul>
                <a href="<?php echo esc_url(royesh_consultation_url()); ?>" class="inline-flex items-center gap-2 bg-[#B1862D] text-white rounded-[14px] px-6 py-3.5 hover:bg-[#9c7524] hover:scale-[1.02] transition-all duration-300 font-bold">
                    <span><?php echo esc_html($srv_1_btn); ?></span>
                    <img src="<?php echo royesh_asset_img('services/arrow 3 (1).svg'); ?>" class="v-arrow-bounce w-4 h-4 object-contain invert brightness-0" alt="Arrow" />
                </a>
            </div>
        </div>

        <!-- SERVICE 2: خدمات اعتباری -->
        <div id="credit-services" class="grid grid-cols-1 lg:grid-cols-12 gap-10 items-center scroll-mt-24 v-reveal v-reveal-fade-up">
            <div class="lg:col-span-7 text-right">
                <span class="text-[#B1862D] font-bold text-[11px] tracking-wider block mb-2"><?php echo esc_html($srv_2_badge); ?></span>
                <h2 class="text-2xl md:text-3xl font-extrabold text-[#014235] mb-4"><?php echo esc_html($srv_2_title); ?></h2>
                <div class="w-20 h-1 bg-[#B1862D] mb-6 rounded-full"></div>
                <p class="text-[#333333] text-base leading-relaxed mb-6 font-normal">
                    <?php echo nl2br(esc_html($srv_2_desc)); ?>
                </p>
                <ul class="v-service-bullets v-reveal v-reveal-fade-up grid grid-cols-1 md:grid-cols-2 gap-4 text-sm text-gray-700 mb-8">
                    <?php foreach ($srv_2_items as $item) : ?>
                        <li class="flex items-center gap-2">
                            <span class="w-2 h-2 rounded-full bg-[#B1862D] shrink-0"></span>
                            <span><?php echo esc_html($item); ?></span>
                        </li>
                    <?php endforeach; ?>
                </ul>
                <a href="<?php echo esc_url(royesh_consultation_url()); ?>" class="inline-flex items-center gap-2 bg-[#014235] text-white rounded-[14px] px-6 py-3.5 hover:bg-[#003127] hover:scale-[1.02] transition-all duration-300 font-bold">
                    <span><?php echo esc_html($srv_2_btn); ?></span>
                    <img src="<?php echo royesh_asset_img('services/arrow 3 (1).svg'); ?>" class="v-arrow-bounce w-4 h-4 object-contain invert brightness-0" alt="Arrow" />
                </a>
            </div>
            <div class="lg:col-span-5 flex justify-center">
                <div class="relative w-[280px] h-[350px] bg-[#004F40] rounded-t-[140px] rounded-b-[24px] border-2 border-[#B1862D] flex flex-col items-center justify-center p-8 shadow-xl">
                    <div class="v-divider-dots-bg absolute inset-0 opacity-10 rounded-t-[140px] rounded-b-[24px]"></div>
                    <img src="<?php echo royesh_asset_img('services/s-2.svg'); ?>" alt="<?php echo esc_attr($srv_2_title); ?>" class="w-24 h-24 object-contain z-10 mb-6 transition-transform duration-300 hover:scale-110" />
                    <div class="text-[#E8D2AF] text-sm font-semibold tracking-wide border border-[#E8D2AF]/20 px-4 py-1.5 rounded-full bg-[#014235] z-10"><?php esc_html_e('توسعه اعتبار', 'royesh'); ?></div>
                </div>
            </div>
        </div>

        <!-- SERVICE 3: مدیریت نقدینگی -->
        <div id="liquidity-management" class="grid grid-cols-1 lg:grid-cols-12 gap-10 items-center scroll-mt-24 v-reveal v-reveal-fade-up">
            <div class="lg:col-span-5 flex justify-center order-2 lg:order-1">
                <div class="relative w-[280px] h-[350px] bg-[#004F40] rounded-t-[140px] rounded-b-[24px] border-2 border-[#B1862D] flex flex-col items-center justify-center p-8 shadow-xl">
                    <div class="v-divider-dots-bg absolute inset-0 opacity-10 rounded-t-[140px] rounded-b-[24px]"></div>
                    <img src="<?php echo royesh_asset_img('services/s-3.svg'); ?>" alt="<?php echo esc_attr($srv_3_title); ?>" class="w-24 h-24 object-contain z-10 mb-6 transition-transform duration-300 hover:scale-110" />
                    <div class="text-[#E8D2AF] text-sm font-semibold tracking-wide border border-[#E8D2AF]/20 px-4 py-1.5 rounded-full bg-[#014235] z-10"><?php esc_html_e('مدیریت بهینه جریان نقد', 'royesh'); ?></div>
                </div>
            </div>
            <div class="lg:col-span-7 text-right order-1 lg:order-2">
                <span class="text-[#B1862D] font-bold text-[11px] tracking-wider block mb-2"><?php echo esc_html($srv_3_badge); ?></span>
                <h2 class="text-2xl md:text-3xl font-extrabold text-[#014235] mb-4"><?php echo esc_html($srv_3_title); ?></h2>
                <div class="w-20 h-1 bg-[#B1862D] mb-6 rounded-full"></div>
                <p class="text-[#333333] text-base leading-relaxed mb-6 font-normal">
                    <?php echo nl2br(esc_html($srv_3_desc)); ?>
                </p>
                <ul class="v-service-bullets v-reveal v-reveal-fade-up grid grid-cols-1 md:grid-cols-2 gap-4 text-sm text-gray-700 mb-8">
                    <?php foreach ($srv_3_items as $item) : ?>
                        <li class="flex items-center gap-2">
                            <span class="w-2 h-2 rounded-full bg-[#B1862D] shrink-0"></span>
                            <span><?php echo esc_html($item); ?></span>
                        </li>
                    <?php endforeach; ?>
                </ul>
                <a href="<?php echo esc_url(royesh_consultation_url()); ?>" class="inline-flex items-center gap-2 bg-[#B1862D] text-white rounded-[14px] px-6 py-3.5 hover:bg-[#9c7524] hover:scale-[1.02] transition-all duration-300 font-bold">
                    <span><?php echo esc_html($srv_3_btn); ?></span>
                    <img src="<?php echo royesh_asset_img('services/arrow 3 (1).svg'); ?>" class="v-arrow-bounce w-4 h-4 object-contain invert brightness-0" alt="Arrow" />
                </a>
            </div>
        </div>

        <!-- SERVICE 4: مدیریت دارایی -->
        <div id="asset-management" class="grid grid-cols-1 lg:grid-cols-12 gap-10 items-center scroll-mt-24 v-reveal v-reveal-fade-up">
            <div class="lg:col-span-7 text-right">
                <span class="text-[#B1862D] font-bold text-[11px] tracking-wider block mb-2"><?php echo esc_html($srv_4_badge); ?></span>
                <h2 class="text-2xl md:text-3xl font-extrabold text-[#014235] mb-4"><?php echo esc_html($srv_4_title); ?></h2>
                <div class="w-20 h-1 bg-[#B1862D] mb-6 rounded-full"></div>
                <p class="text-[#333333] text-base leading-relaxed mb-6 font-normal">
                    <?php echo nl2br(esc_html($srv_4_desc)); ?>
                </p>
                <ul class="v-service-bullets v-reveal v-reveal-fade-up grid grid-cols-1 md:grid-cols-2 gap-4 text-sm text-gray-700 mb-8">
                    <?php foreach ($srv_4_items as $item) : ?>
                        <li class="flex items-center gap-2">
                            <span class="w-2 h-2 rounded-full bg-[#B1862D] shrink-0"></span>
                            <span><?php echo esc_html($item); ?></span>
                        </li>
                    <?php endforeach; ?>
                </ul>
                <a href="<?php echo esc_url(royesh_consultation_url()); ?>" class="inline-flex items-center gap-2 bg-[#014235] text-white rounded-[14px] px-6 py-3.5 hover:bg-[#003127] hover:scale-[1.02] transition-all duration-300 font-bold">
                    <span><?php echo esc_html($srv_4_btn); ?></span>
                    <img src="<?php echo royesh_asset_img('services/arrow 3 (1).svg'); ?>" class="v-arrow-bounce w-4 h-4 object-contain invert brightness-0" alt="Arrow" />
                </a>
            </div>
            <div class="lg:col-span-5 flex justify-center">
                <div class="relative w-[280px] h-[350px] bg-[#004F40] rounded-t-[140px] rounded-b-[24px] border-2 border-[#B1862D] flex flex-col items-center justify-center p-8 shadow-xl">
                    <div class="v-divider-dots-bg absolute inset-0 opacity-10 rounded-t-[140px] rounded-b-[24px]"></div>
                    <img src="<?php echo royesh_asset_img('services/s-4.svg'); ?>" alt="<?php echo esc_attr($srv_4_title); ?>" class="w-24 h-24 object-contain z-10 mb-6 transition-transform duration-300 hover:scale-110" />
                    <div class="text-[#E8D2AF] text-sm font-semibold tracking-wide border border-[#E8D2AF]/20 px-4 py-1.5 rounded-full bg-[#014235] z-10"><?php esc_html_e('مدیریت سبد دارایی', 'royesh'); ?></div>
                </div>
            </div>
        </div>

    </div>
</section>

