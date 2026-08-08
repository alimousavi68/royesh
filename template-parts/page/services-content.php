<?php
/**
 * Services Page Content Template Part
 * 
 * @package Royesh
 * @version 1.0.0
 */

if (!defined('ABSPATH')) {
    exit; // Exit if accessed directly
}
?>

<!-- PAGE HERO SECTION -->
<section class="relative w-full bg-[#004F40] py-20 px-4 md:px-12 overflow-hidden border-b border-[#2E7063]">
    <div class="absolute inset-0 opacity-100 pointer-events-none select-none z-0">
        <img src="<?php echo royesh_asset_img('bg vector patt.svg'); ?>" alt="Pattern" class="w-full h-full object-cover" />
    </div>
    <div class="absolute top-[10%] left-[10%] w-[350px] h-[350px] rounded-full bg-[#2E7063]/25 blur-[100px] pointer-events-none z-0"></div>
    <div class="absolute bottom-[5%] right-[5%] w-[250px] h-[250px] rounded-full bg-[#B1862D]/10 blur-[80px] pointer-events-none z-0"></div>

    <div class="max-w-[1150px] mx-auto relative z-10 text-center text-white">
        <span class="text-[#B1862D] text-sm md:text-base font-bold tracking-wider block mb-3 font-sans"><?php esc_html_e('رویش سرمایه', 'royesh'); ?></span>
        <h1 class="text-3xl md:text-5xl font-black leading-tight mb-6"><?php esc_html_e('خدمات تخصصی و راهکارهای مالی', 'royesh'); ?></h1>
        <p class="text-white/80 text-base md:text-lg max-w-2xl mx-auto leading-relaxed font-light">
            <?php esc_html_e('ما در رویش، با تکیه بر تحلیل‌های دقیق و شناخت بازار، راهکارهایی هوشمندانه و شخصی‌سازی شده برای توسعه ظرفیت‌های مالی و کسب‌وکار شما ارائه می‌دهیم.', 'royesh'); ?>
        </p>
    </div>
</section>

<!-- SERVICES DETAILS SECTION -->
<section class="w-full py-20 px-4 md:px-12 relative">
    <div class="max-w-[1150px] mx-auto flex flex-col gap-24">

        <!-- SERVICE 1: خدمات تأمین مالی -->
        <div id="financing-services" class="grid grid-cols-1 lg:grid-cols-12 gap-10 items-center scroll-mt-24 v-reveal v-reveal-fade-up">
            <div class="lg:col-span-5 flex justify-center order-2 lg:order-1">
                <div class="relative w-[280px] h-[350px] bg-[#004F40] rounded-t-[140px] rounded-b-[24px] border-2 border-[#B1862D] flex flex-col items-center justify-center p-8 shadow-xl">
                    <div class="v-divider-dots-bg absolute inset-0 opacity-10 rounded-t-[140px] rounded-b-[24px]"></div>
                    <img src="<?php echo royesh_asset_img('services/s-1.svg'); ?>" alt="<?php esc_attr_e('خدمات تأمین مالی', 'royesh'); ?>" class="w-24 h-24 object-contain z-10 mb-6 transition-transform duration-300 hover:scale-110" />
                    <div class="text-[#E8D2AF] text-sm font-semibold tracking-wide border border-[#E8D2AF]/20 px-4 py-1.5 rounded-full bg-[#014235] z-10"><?php esc_html_e('سرمایه‌گذاری پویا', 'royesh'); ?></div>
                </div>
            </div>
            <div class="lg:col-span-7 text-right order-1 lg:order-2">
                <span class="text-[#B1862D] font-bold text-[11px] tracking-wider block mb-2"><?php esc_html_e('شتاب‌دهنده رشد', 'royesh'); ?></span>
                <h2 class="text-2xl md:text-3xl font-extrabold text-[#014235] mb-4"><?php esc_html_e('خدمات تأمین مالی', 'royesh'); ?></h2>
                <div class="w-20 h-1 bg-[#B1862D] mb-6 rounded-full"></div>
                <p class="text-[#333333] text-base leading-relaxed mb-6 font-normal">
                    <?php esc_html_e('طراحی و ارائه راهکارهای تأمین منابع مالی متناسب با ساختار و نیاز کسب‌وکارها، به عنوان شتاب‌دهنده‌ای برای رشد و توسعه پایدار سازمان شما عمل می‌کند. ما در این مسیر تمام مراحل را هموار می‌سازیم.', 'royesh'); ?>
                </p>
                <ul class="v-service-bullets v-reveal v-reveal-fade-up grid grid-cols-1 md:grid-cols-2 gap-4 text-sm text-gray-700 mb-8">
                    <li class="flex items-center gap-2">
                        <span class="w-2 h-2 rounded-full bg-[#B1862D]"></span>
                        <?php esc_html_e('تأمین مالی از طریق بازار پول و بازار سرمایه', 'royesh'); ?>
                    </li>
                    <li class="flex items-center gap-2">
                        <span class="w-2 h-2 rounded-full bg-[#B1862D]"></span>
                        <?php esc_html_e('طراحی و انتشار اوراق بهادار و مشارکت', 'royesh'); ?>
                    </li>
                    <li class="flex items-center gap-2">
                        <span class="w-2 h-2 rounded-full bg-[#B1862D]"></span>
                        <?php esc_html_e('جذب سرمایه‌گذار و هم‌سرمایه‌گذاری ریسک‌پذیر', 'royesh'); ?>
                    </li>
                    <li class="flex items-center gap-2">
                        <span class="w-2 h-2 rounded-full bg-[#B1862D]"></span>
                        <?php esc_html_e('ساختاردهی به مشارکت‌های استراتژیک مالی', 'royesh'); ?>
                    </li>
                </ul>
                <a href="<?php echo esc_url(royesh_consultation_url()); ?>" class="inline-flex items-center gap-2 bg-[#B1862D] text-white rounded-[14px] px-6 py-3.5 hover:bg-[#9c7524] hover:scale-[1.02] transition-all duration-300 font-bold">
                    <span><?php esc_html_e('درخواست مشاوره تأمین مالی', 'royesh'); ?></span>
                    <img src="<?php echo royesh_asset_img('services/arrow 3 (1).svg'); ?>" class="v-arrow-bounce w-4 h-4 object-contain invert brightness-0" alt="Arrow" />
                </a>
            </div>
        </div>

        <!-- SERVICE 2: خدمات اعتباری -->
        <div id="credit-services" class="grid grid-cols-1 lg:grid-cols-12 gap-10 items-center scroll-mt-24 v-reveal v-reveal-fade-up">
            <div class="lg:col-span-7 text-right">
                <span class="text-[#B1862D] font-bold text-[11px] tracking-wider block mb-2"><?php esc_html_e('توسعه اعتبار', 'royesh'); ?></span>
                <h2 class="text-2xl md:text-3xl font-extrabold text-[#014235] mb-4"><?php esc_html_e('خدمات اعتباری', 'royesh'); ?></h2>
                <div class="w-20 h-1 bg-[#B1862D] mb-6 rounded-full"></div>
                <p class="text-[#333333] text-base leading-relaxed mb-6 font-normal">
                    <?php esc_html_e('طراحی سازوکارهای اعتباری، ارزیابی ظرفیت‌ها و توسعه راهکارهای اعتباری مؤثر به شما کمک می‌کند تا بهینه‌ترین منابع اعتباری بازار را با حداقل ریسک و فرآیند اداری دریافت کنید.', 'royesh'); ?>
                </p>
                <ul class="v-service-bullets v-reveal v-reveal-fade-up grid grid-cols-1 md:grid-cols-2 gap-4 text-sm text-gray-700 mb-8">
                    <li class="flex items-center gap-2">
                        <span class="w-2 h-2 rounded-full bg-[#B1862D]"></span>
                        <?php esc_html_e('مشاوره و تسهیل اخذ تسهیلات بانکی', 'royesh'); ?>
                    </li>
                    <li class="flex items-center gap-2">
                        <span class="w-2 h-2 rounded-full bg-[#B1862D]"></span>
                        <?php esc_html_e('تسهیل فرآیند صدور ضمانت‌نامه‌ها و اعتبارات اسنادی', 'royesh'); ?>
                    </li>
                    <li class="flex items-center gap-2">
                        <span class="w-2 h-2 rounded-full bg-[#B1862D]"></span>
                        <?php esc_html_e('ارزیابی و رتبه‌بندی اعتباری شرکت‌ها', 'royesh'); ?>
                    </li>
                    <li class="flex items-center gap-2">
                        <span class="w-2 h-2 rounded-full bg-[#B1862D]"></span>
                        <?php esc_html_e('طراحی و تحلیل خط‌مشی‌های اعتباردهی به مشتریان', 'royesh'); ?>
                    </li>
                </ul>
                <a href="<?php echo esc_url(royesh_consultation_url()); ?>" class="inline-flex items-center gap-2 bg-[#014235] text-white rounded-[14px] px-6 py-3.5 hover:bg-[#003127] hover:scale-[1.02] transition-all duration-300 font-bold">
                    <span><?php esc_html_e('درخواست مشاوره خدمات اعتباری', 'royesh'); ?></span>
                    <img src="<?php echo royesh_asset_img('services/arrow 3 (1).svg'); ?>" class="v-arrow-bounce w-4 h-4 object-contain invert brightness-0" alt="Arrow" />
                </a>
            </div>
            <div class="lg:col-span-5 flex justify-center">
                <div class="relative w-[280px] h-[350px] bg-[#004F40] rounded-t-[140px] rounded-b-[24px] border-2 border-[#B1862D] flex flex-col items-center justify-center p-8 shadow-xl">
                    <div class="v-divider-dots-bg absolute inset-0 opacity-10 rounded-t-[140px] rounded-b-[24px]"></div>
                    <img src="<?php echo royesh_asset_img('services/s-2.svg'); ?>" alt="<?php esc_attr_e('خدمات اعتباری', 'royesh'); ?>" class="w-24 h-24 object-contain z-10 mb-6 transition-transform duration-300 hover:scale-110" />
                    <div class="text-[#E8D2AF] text-sm font-semibold tracking-wide border border-[#E8D2AF]/20 px-4 py-1.5 rounded-full bg-[#014235] z-10"><?php esc_html_e('توسعه اعتبار', 'royesh'); ?></div>
                </div>
            </div>
        </div>

        <!-- SERVICE 3: مدیریت نقدینگی -->
        <div id="liquidity-management" class="grid grid-cols-1 lg:grid-cols-12 gap-10 items-center scroll-mt-24 v-reveal v-reveal-fade-up">
            <div class="lg:col-span-5 flex justify-center order-2 lg:order-1">
                <div class="relative w-[280px] h-[350px] bg-[#004F40] rounded-t-[140px] rounded-b-[24px] border-2 border-[#B1862D] flex flex-col items-center justify-center p-8 shadow-xl">
                    <div class="v-divider-dots-bg absolute inset-0 opacity-10 rounded-t-[140px] rounded-b-[24px]"></div>
                    <img src="<?php echo royesh_asset_img('services/s-3.svg'); ?>" alt="<?php esc_attr_e('مدیریت نقدینگی', 'royesh'); ?>" class="w-24 h-24 object-contain z-10 mb-6 transition-transform duration-300 hover:scale-110" />
                    <div class="text-[#E8D2AF] text-sm font-semibold tracking-wide border border-[#E8D2AF]/20 px-4 py-1.5 rounded-full bg-[#014235] z-10"><?php esc_html_e('مدیریت بهینه جریان نقد', 'royesh'); ?></div>
                </div>
            </div>
            <div class="lg:col-span-7 text-right order-1 lg:order-2">
                <span class="text-[#B1862D] font-bold text-[11px] tracking-wider block mb-2"><?php esc_html_e('پویایی مالی', 'royesh'); ?></span>
                <h2 class="text-2xl md:text-3xl font-extrabold text-[#014235] mb-4"><?php esc_html_e('مدیریت نقدینگی', 'royesh'); ?></h2>
                <div class="w-20 h-1 bg-[#B1862D] mb-6 rounded-full"></div>
                <p class="text-[#333333] text-base leading-relaxed mb-6 font-normal">
                    <?php esc_html_e('بهینه‌سازی جریان‌های نقدی و ارتقای بازدهی منابع کوتاه‌مدت، تضمین‌کننده بقا و پویایی روزمره هر کسب‌وکار در شرایط متغیر اقتصادی است. با رویکردهای تخصصی ما جریان‌های نقدی خود را ایمن کنید.', 'royesh'); ?>
                </p>
                <ul class="v-service-bullets v-reveal v-reveal-fade-up grid grid-cols-1 md:grid-cols-2 gap-4 text-sm text-gray-700 mb-8">
                    <li class="flex items-center gap-2">
                        <span class="w-2 h-2 rounded-full bg-[#B1862D]"></span>
                        <?php esc_html_e('پیش‌بینی هوشمند و منظم جریان وجوه نقد', 'royesh'); ?>
                    </li>
                    <li class="flex items-center gap-2">
                        <span class="w-2 h-2 rounded-full bg-[#B1862D]"></span>
                        <?php esc_html_e('مدیریت و بهینه‌سازی سرمایه در گردش', 'royesh'); ?>
                    </li>
                    <li class="flex items-center gap-2">
                        <span class="w-2 h-2 rounded-full bg-[#B1862D]"></span>
                        <?php esc_html_e('طراحی الگوهای بهینه پرداخت و دریافت', 'royesh'); ?>
                    </li>
                    <li class="flex items-center gap-2">
                        <span class="w-2 h-2 rounded-full bg-[#B1862D]"></span>
                        <?php esc_html_e('مدیریت سرمایه‌گذاری‌های کوتاه‌مدت وجوه مازاد', 'royesh'); ?>
                    </li>
                </ul>
                <a href="<?php echo esc_url(royesh_consultation_url()); ?>" class="inline-flex items-center gap-2 bg-[#B1862D] text-white rounded-[14px] px-6 py-3.5 hover:bg-[#9c7524] hover:scale-[1.02] transition-all duration-300 font-bold">
                    <span><?php esc_html_e('درخواست مشاوره نقدینگی', 'royesh'); ?></span>
                    <img src="<?php echo royesh_asset_img('services/arrow 3 (1).svg'); ?>" class="v-arrow-bounce w-4 h-4 object-contain invert brightness-0" alt="Arrow" />
                </a>
            </div>
        </div>

        <!-- SERVICE 4: مدیریت دارایی -->
        <div id="asset-management" class="grid grid-cols-1 lg:grid-cols-12 gap-10 items-center scroll-mt-24 v-reveal v-reveal-fade-up">
            <div class="lg:col-span-7 text-right">
                <span class="text-[#B1862D] font-bold text-[11px] tracking-wider block mb-2"><?php esc_html_e('ارزش‌آفرینی پایدار', 'royesh'); ?></span>
                <h2 class="text-2xl md:text-3xl font-extrabold text-[#014235] mb-4"><?php esc_html_e('مدیریت دارایی', 'royesh'); ?></h2>
                <div class="w-20 h-1 bg-[#B1862D] mb-6 rounded-full"></div>
                <p class="text-[#333333] text-base leading-relaxed mb-6 font-normal">
                    <?php esc_html_e('ارزیابی، ساختاردهی و مدیریت استراتژیک دارایی‌ها با رویکرد خلق ارزش پایدار، به شما کمک می‌کند ارزش دارایی‌های خود را در بلندمدت حفظ کرده و توسعه دهید.', 'royesh'); ?>
                </p>
                <ul class="v-service-bullets v-reveal v-reveal-fade-up grid grid-cols-1 md:grid-cols-2 gap-4 text-sm text-gray-700 mb-8">
                    <li class="flex items-center gap-2">
                        <span class="w-2 h-2 rounded-full bg-[#B1862D]"></span>
                        <?php esc_html_e('تشکیل و مدیریت پرتفوی اختصاصی متناسب با اهداف ریسک', 'royesh'); ?>
                    </li>
                    <li class="flex items-center gap-2">
                        <span class="w-2 h-2 rounded-full bg-[#B1862D]"></span>
                        <?php esc_html_e('ارزیابی و ارزش‌گذاری علمی دارایی‌های مشهود و نامشهود', 'royesh'); ?>
                    </li>
                    <li class="flex items-center gap-2">
                        <span class="w-2 h-2 rounded-full bg-[#B1862D]"></span>
                        <?php esc_html_e('مشاوره در زمینه بهینه‌سازی سبد دارایی‌ها', 'royesh'); ?>
                    </li>
                    <li class="flex items-center gap-2">
                        <span class="w-2 h-2 rounded-full bg-[#B1862D]"></span>
                        <?php esc_html_e('پایش مستمر و بازنگری دوره‌ای عملکرد سبد سرمایه‌گذاری', 'royesh'); ?>
                    </li>
                </ul>
                <a href="<?php echo esc_url(royesh_consultation_url()); ?>" class="inline-flex items-center gap-2 bg-[#014235] text-white rounded-[14px] px-6 py-3.5 hover:bg-[#003127] hover:scale-[1.02] transition-all duration-300 font-bold">
                    <span><?php esc_html_e('درخواست مشاوره مدیریت دارایی', 'royesh'); ?></span>
                    <img src="<?php echo royesh_asset_img('services/arrow 3 (1).svg'); ?>" class="v-arrow-bounce w-4 h-4 object-contain invert brightness-0" alt="Arrow" />
                </a>
            </div>
            <div class="lg:col-span-5 flex justify-center">
                <div class="relative w-[280px] h-[350px] bg-[#004F40] rounded-t-[140px] rounded-b-[24px] border-2 border-[#B1862D] flex flex-col items-center justify-center p-8 shadow-xl">
                    <div class="v-divider-dots-bg absolute inset-0 opacity-10 rounded-t-[140px] rounded-b-[24px]"></div>
                    <img src="<?php echo royesh_asset_img('services/s-4.svg'); ?>" alt="<?php esc_attr_e('مدیریت دارایی', 'royesh'); ?>" class="w-24 h-24 object-contain z-10 mb-6 transition-transform duration-300 hover:scale-110" />
                    <div class="text-[#E8D2AF] text-sm font-semibold tracking-wide border border-[#E8D2AF]/20 px-4 py-1.5 rounded-full bg-[#014235] z-10"><?php esc_html_e('مدیریت سبد دارایی', 'royesh'); ?></div>
                </div>
            </div>
        </div>

    </div>
</section>
