<?php
/**
 * Consultation Page Content Template Part
 * 
 * @package Royesh
 * @version 1.0.0
 */

if (!defined('ABSPATH')) {
    exit; // Exit if accessed directly
}
?>

<!-- HERO SECTION -->
<section class="relative w-full bg-[#004F40] py-16 px-4 md:px-12 overflow-hidden border-b border-[#2E7063]">
    <div class="absolute inset-0 opacity-100 pointer-events-none select-none z-0">
        <img src="<?php echo royesh_asset_img('bg vector patt.svg'); ?>" alt="Pattern" class="w-full h-full object-cover" />
    </div>
    <div class="absolute top-[10%] left-[10%] w-[350px] h-[350px] rounded-full bg-[#2E7063]/25 blur-[100px] pointer-events-none z-0"></div>
    <div class="absolute bottom-[5%] right-[5%] w-[250px] h-[250px] rounded-full bg-[#B1862D]/10 blur-[80px] pointer-events-none z-0"></div>

    <div class="max-w-[1150px] mx-auto relative z-10 text-center text-white">
        <span class="text-[#B1862D] text-sm md:text-base font-bold tracking-wider block mb-3 font-sans"><?php esc_html_e('همگام با نیازهای شما', 'royesh'); ?></span>
        <h1 class="text-3xl md:text-5xl font-black leading-tight mb-4"><?php esc_html_e('درخواست مشاوره تخصصی', 'royesh'); ?></h1>
        <p class="text-white/80 text-base md:text-lg max-w-2xl mx-auto leading-relaxed font-light font-sans">
            <?php esc_html_e('برای دریافت مشاوره اختصاصی مالی، فرم زیر را پر کنید. کارشناسان ما در کوتاه‌ترین زمان با شما تماس خواهند گرفت.', 'royesh'); ?>
        </p>
    </div>
</section>

<!-- FORM & INFO SECTION -->
<section class="w-full py-20 px-4 md:px-12 relative">
    <div class="max-w-[1150px] mx-auto grid grid-cols-1 lg:grid-cols-12 gap-12 items-start">
        
        <!-- RIGHT COLUMN: Premium Consultation Form -->
        <div class="lg:col-span-7 bg-[#F3ECE3] rounded-[32px] p-6 md:p-8 relative overflow-hidden shadow-sm border border-[#E5DDD0] w-full v-reveal v-reveal-fade-right">
            <div class="absolute -right-20 -top-20 w-64 h-64 rounded-full bg-[#004F40]/5 blur-3xl pointer-events-none"></div>

            <form id="royesh-consultation-form" class="grid grid-cols-1 md:grid-cols-2 gap-y-4 gap-x-4 relative z-10">
                <?php wp_nonce_field('royesh_nonce_action', 'royesh_consultation_nonce'); ?>

                <div style="display:none;" aria-hidden="true">
                    <input type="text" name="website_hp" tabindex="-1" autocomplete="off" />
                </div>

                <div class="col-span-1">
                    <label class="block text-xs font-bold text-gray-700 mb-2 font-sans"><?php esc_html_e('نام و نام خانوادگی *', 'royesh'); ?></label>
                    <input type="text" name="fullname" required placeholder="<?php esc_attr_e('مثال: علی علوی', 'royesh'); ?>" class="bg-white w-full px-5 py-3.5 rounded-full text-sm text-gray-700 placeholder-gray-400 border border-[#E2DDD4] focus:outline-none focus:ring-2 focus:ring-[#004F40]/20 font-sans" />
                </div>

                <div class="col-span-1">
                    <label class="block text-xs font-bold text-gray-700 mb-2 font-sans"><?php esc_html_e('شماره تماس *', 'royesh'); ?></label>
                    <input type="text" name="phone" required placeholder="<?php esc_attr_e('مثال: ۰۹۱۲۳۴۵۶۷۸۹', 'royesh'); ?>" class="bg-white w-full px-5 py-3.5 rounded-full text-sm text-gray-700 placeholder-gray-400 border border-[#E2DDD4] focus:outline-none focus:ring-2 focus:ring-[#004F40]/20 font-sans" />
                </div>

                <div class="col-span-1">
                    <label class="block text-xs font-bold text-gray-700 mb-2 font-sans"><?php esc_html_e('ایمیل', 'royesh'); ?></label>
                    <input type="email" name="email" placeholder="<?php esc_attr_e('مثال: info@royesh.com', 'royesh'); ?>" class="bg-white w-full px-5 py-3.5 rounded-full text-sm text-gray-700 placeholder-gray-400 border border-[#E2DDD4] focus:outline-none focus:ring-2 focus:ring-[#004F40]/20 font-sans" />
                </div>

                <div class="col-span-1">
                    <label class="block text-xs font-bold text-gray-700 mb-2 font-sans"><?php esc_html_e('نام شرکت / سازمان', 'royesh'); ?></label>
                    <input type="text" name="company" placeholder="<?php esc_attr_e('مثال: شرکت رویش', 'royesh'); ?>" class="bg-white w-full px-5 py-3.5 rounded-full text-sm text-gray-700 placeholder-gray-400 border border-[#E2DDD4] focus:outline-none focus:ring-2 focus:ring-[#004F40]/20 font-sans" />
                </div>

                <div class="col-span-1 md:col-span-2 relative">
                    <label class="block text-xs font-bold text-gray-700 mb-2 font-sans"><?php esc_html_e('موضوع مشاوره *', 'royesh'); ?></label>
                    <select name="subject" required class="bg-white w-full px-5 py-3.5 rounded-full text-sm text-gray-700 placeholder-gray-400 border border-[#E2DDD4] focus:outline-none focus:ring-2 focus:ring-[#004F40]/20 appearance-none font-sans cursor-pointer">
                        <option value="" disabled selected hidden><?php esc_html_e('یک مورد را انتخاب کنید', 'royesh'); ?></option>
                        <option value="financing"><?php esc_html_e('خدمات تأمین مالی', 'royesh'); ?></option>
                        <option value="credit"><?php esc_html_e('خدمات اعتباری', 'royesh'); ?></option>
                        <option value="liquidity"><?php esc_html_e('مدیریت نقدینگی', 'royesh'); ?></option>
                        <option value="asset"><?php esc_html_e('مدیریت دارایی', 'royesh'); ?></option>
                        <option value="other"><?php esc_html_e('سایر موارد', 'royesh'); ?></option>
                    </select>
                </div>

                <div class="col-span-1 md:col-span-2">
                    <label class="block text-xs font-bold text-gray-700 mb-2 font-sans"><?php esc_html_e('جزئیات و توضیحات درخواست *', 'royesh'); ?></label>
                    <textarea name="message" required placeholder="<?php esc_attr_e('لطفاً خلاصه چالش یا موضوع مورد نیاز خود را شرح دهید...', 'royesh'); ?>" class="bg-white w-full px-5 py-3.5 rounded-[24px] text-sm text-gray-700 placeholder-gray-400 border border-[#E2DDD4] focus:outline-none focus:ring-2 focus:ring-[#004F40]/20 resize-none h-32 font-sans"></textarea>
                </div>

                <div class="col-span-1 md:col-span-2">
                    <button type="submit" class="w-full bg-[#B1862D] hover:bg-[#9c7524] text-white font-bold py-4 rounded-full transition-all duration-300 shadow-md cursor-pointer">
                        <?php esc_html_e('ثبت نهایی درخواست مشاوره', 'royesh'); ?>
                    </button>
                </div>
            </form>
        </div>

        <!-- LEFT COLUMN -->
        <div class="lg:col-span-5 flex flex-col text-right items-start v-reveal v-reveal-fade-left">
            <div class="bg-[#FAF8F4] border border-[#E5DDD0] text-[#333333] text-xs font-bold px-4 py-2 rounded-full mb-6 font-sans">
                <?php esc_html_e('خدمات مشاوره حرفه‌ای', 'royesh'); ?>
            </div>

            <h2 class="text-2xl md:text-3xl font-extrabold text-[#014235] leading-snug mb-4 font-heading text-right">
                <?php esc_html_e('چرا مشاوره با', 'royesh'); ?> <span class="text-[#B1862D]"><?php esc_html_e('رویش سرمایه؟', 'royesh'); ?></span>
            </h2>

            <p class="text-gray-600 text-sm leading-relaxed mb-8 text-justify font-sans">
                <?php esc_html_e('ما در گروه رویش به دنبال روابط طولانی‌مدت و خلق ارزش واقعی هستیم. پس از ثبت درخواست، پرونده شما مستقیماً توسط یکی از کارشناسان خبره ما تحلیل شده و در کوتاه‌ترین زمان با شما ارتباط برقرار خواهد شد.', 'royesh'); ?>
            </p>

            <div class="flex flex-col gap-6 w-full">
                <div class="flex items-start gap-4">
                    <div class="w-10 h-10 rounded-xl bg-[#FAF8F4] border border-[#B1862D]/10 flex items-center justify-center text-[#B1862D] shadow-sm shrink-0">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                    </div>
                    <div>
                        <h3 class="text-sm font-bold text-black mb-1 font-sans"><?php esc_html_e('تماس در کمتر از ۲۴ ساعت', 'royesh'); ?></h3>
                        <p class="text-xs text-gray-500 font-sans leading-relaxed"><?php esc_html_e('کارشناسان ما به محض دریافت فرم، بررسی اولیه را انجام داده و با شما تماس می‌گیرند.', 'royesh'); ?></p>
                    </div>
                </div>

                <div class="flex items-start gap-4">
                    <div class="w-10 h-10 rounded-xl bg-[#FAF8F4] border border-[#B1862D]/10 flex items-center justify-center text-[#B1862D] shadow-sm shrink-0">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"></path></svg>
                    </div>
                    <div>
                        <h3 class="text-sm font-bold text-black mb-1 font-sans"><?php esc_html_e('محرمانگی و امنیت اطلاعات', 'royesh'); ?></h3>
                        <p class="text-xs text-gray-500 font-sans leading-relaxed"><?php esc_html_e('تمام اطلاعات مالی، ایده ها و اسناد تجاری شما به عنوان راز تجاری نزد ما محفوظ خواهد ماند.', 'royesh'); ?></p>
                    </div>
                </div>
            </div>
        </div>

    </div>
</section>
