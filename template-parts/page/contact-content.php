<?php
/**
 * Contact Page Content Template Part
 * 
 * @package Royesh
 * @version 1.2.0
 */

if (!defined('ABSPATH')) {
    exit; // Exit if accessed directly
}

$post_id = get_the_ID();

// مقادیر پویا از متاباکس برگه (با فال‌بک به تنظیمات سراسری سفارشی‌سازی)
$hero_enable  = royesh_get_page_meta($post_id, '_royesh_hero_enable', '1');
$hero_badge   = royesh_get_page_meta($post_id, '_royesh_hero_badge', __('ارتباط با رویش', 'royesh'));
$hero_title   = royesh_get_page_meta($post_id, '_royesh_hero_title', get_the_title());
$hero_desc    = royesh_get_page_meta($post_id, '_royesh_hero_desc', __('تیم کارشناسان رویش سرمایه آماده پاسخگویی به پرسش‌ها و ارائه خدمات مشاوره تخصصی به شما هستند.', 'royesh'));
$hero_bg      = royesh_get_page_meta($post_id, '_royesh_hero_bg_color', '#004F40');

$cnt_form_t   = royesh_get_page_meta($post_id, '_royesh_cnt_form_title', __('ارسال پیام به کارشناسان رویش', 'royesh'));
$cnt_form_btn = royesh_get_page_meta($post_id, '_royesh_cnt_form_btn', __('ارسال پیام', 'royesh'));

$phone_ovr    = royesh_get_page_meta($post_id, '_royesh_cnt_phone_ovr', '');
$email_ovr    = royesh_get_page_meta($post_id, '_royesh_cnt_email_ovr', '');
$addr_ovr     = royesh_get_page_meta($post_id, '_royesh_cnt_addr_ovr', '');

$phone     = !empty($phone_ovr) ? $phone_ovr : get_theme_mod('royesh_contact_phone', '۰۲۱-۸۸۸۸۸۸۸۸');
$phone_raw = preg_replace('/[^\d+]/', '', $phone);
$email     = !empty($email_ovr) ? $email_ovr : get_theme_mod('royesh_contact_email', 'info@royesh.com');
$address   = !empty($addr_ovr) ? $addr_ovr : get_theme_mod('royesh_contact_address', 'تهران، خیابان ولیعصر، نرسیده به میدان ونک، برج رویش، طبقه ۵');

// تولید کد امنیتی ریاضی
$captcha = royesh_generate_captcha();
?>

<?php if ($hero_enable !== '0') : ?>
<!-- HERO SECTION -->
<section class="relative w-full py-16 px-4 md:px-12 overflow-hidden border-b border-[#2E7063] bg-[#004F40]" style="background-color: <?php echo esc_attr(!empty($hero_bg) && $hero_bg !== '#ffffff' ? $hero_bg : '#004F40'); ?>;">
    <div class="absolute inset-0 opacity-100 pointer-events-none select-none z-0">
        <img src="<?php echo royesh_asset_img('bg vector patt.svg'); ?>" alt="Pattern" class="w-full h-full object-cover" />
    </div>
    <div class="absolute top-[10%] left-[10%] w-[350px] h-[350px] rounded-full bg-[#2E7063]/25 blur-[100px] pointer-events-none z-0"></div>
    <div class="absolute bottom-[5%] right-[5%] w-[250px] h-[250px] rounded-full bg-[#B1862D]/10 blur-[80px] pointer-events-none z-0"></div>

    <div class="max-w-[1150px] mx-auto relative z-10 text-center text-white">
        <span class="text-[#B1862D] text-sm md:text-base font-bold tracking-wider block mb-3 font-sans"><?php echo esc_html($hero_badge); ?></span>
        <h1 class="text-3xl md:text-5xl font-black leading-tight mb-4"><?php echo esc_html($hero_title); ?></h1>
        <p class="text-white/80 text-base md:text-lg max-w-2xl mx-auto leading-relaxed font-light font-sans">
            <?php echo esc_html($hero_desc); ?>
        </p>
    </div>
</section>
<?php endif; ?>

<!-- CONTACT MAIN SECTION -->
<section class="w-full py-20 px-4 md:px-12 relative">
    <div class="max-w-[1150px] mx-auto grid grid-cols-1 lg:grid-cols-3 gap-12 items-start">
        
        <!-- Info Cards (Right) -->
        <div class="lg:col-span-1 flex flex-col gap-6 text-right">
            <!-- Address Card -->
            <div class="bg-[#FAF8F4] border border-[#EBE5D7]/80 rounded-[24px] p-6 shadow-sm">
                <div class="w-12 h-12 rounded-2xl bg-[#004F40] text-[#E8D2AF] flex items-center justify-center mb-4">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path>
                    </svg>
                </div>
                <h3 class="text-lg font-bold text-gray-900 mb-2"><?php esc_html_e('آدرس دفتر مرکزی', 'royesh'); ?></h3>
                <p class="text-gray-600 text-sm leading-relaxed"><?php echo nl2br(esc_html($address)); ?></p>
            </div>

            <!-- Phone Card -->
            <div class="bg-[#FAF8F4] border border-[#EBE5D7]/80 rounded-[24px] p-6 shadow-sm">
                <div class="w-12 h-12 rounded-2xl bg-[#004F40] text-[#E8D2AF] flex items-center justify-center mb-4">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.94.725l.548 2.2a1 1 0 01-.321.988l-1.305.98a10.582 10.582 0 004.872 4.872l.98-1.305a1 1 0 01.988-.321l2.2.548a1 1 0 01.725.94V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"></path>
                    </svg>
                </div>
                <h3 class="text-lg font-bold text-gray-900 mb-2"><?php esc_html_e('تلفن‌های تماس', 'royesh'); ?></h3>
                <a href="tel:<?php echo esc_attr($phone_raw); ?>" class="text-gray-600 hover:text-[#004F40] text-sm font-sans tracking-wide block mb-1 font-bold"><?php echo esc_html($phone); ?></a>
                <span class="text-xs text-gray-400 font-sans block"><?php esc_html_e('شنبه تا چهارشنبه: ۸:۳۰ الی ۱۷:۰۰', 'royesh'); ?></span>
            </div>

            <!-- Email Card -->
            <div class="bg-[#FAF8F4] border border-[#EBE5D7]/80 rounded-[24px] p-6 shadow-sm">
                <div class="w-12 h-12 rounded-2xl bg-[#004F40] text-[#E8D2AF] flex items-center justify-center mb-4">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path>
                    </svg>
                </div>
                <h3 class="text-lg font-bold text-gray-900 mb-2"><?php esc_html_e('پست الکترونیک', 'royesh'); ?></h3>
                <a href="mailto:<?php echo esc_attr($email); ?>" class="text-gray-600 hover:text-[#004F40] text-sm font-sans block"><?php echo esc_html($email); ?></a>
            </div>
        </div>

        <!-- Form (Left) -->
        <div class="lg:col-span-2 bg-[#FAF8F4] border border-[#EBE5D7]/80 rounded-[32px] p-8 lg:p-12 shadow-sm">
            <h2 class="text-2xl font-black text-[#014235] mb-2 font-heading"><?php echo esc_html($cnt_form_t); ?></h2>
            <p class="text-gray-500 text-sm mb-8"><?php esc_html_e('لطفاً اطلاعات خود را با دقت وارد نمایید. پیام شما مستقیماً به واحد مربوطه ارسال خواهد شد.', 'royesh'); ?></p>

            <form id="royesh-contact-form" class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <?php wp_nonce_field('royesh_nonce_action', 'royesh_contact_nonce'); ?>

                <!-- Honeypot -->
                <div style="display:none;" aria-hidden="true">
                    <input type="text" name="website_hp" tabindex="-1" autocomplete="off" />
                </div>

                <!-- Captcha Token -->
                <input type="hidden" name="captcha_token" id="royesh-captcha-token-contact" value="<?php echo esc_attr($captcha['token']); ?>" />

                <div class="col-span-1">
                    <label class="block text-xs font-bold text-gray-700 mb-2 font-sans"><?php esc_html_e('نام و نام خانوادگی *', 'royesh'); ?></label>
                    <input type="text" name="fullname" required placeholder="<?php esc_attr_e('مثال: سهراب سپهری', 'royesh'); ?>" class="bg-white w-full px-5 py-3.5 rounded-full text-sm text-gray-700 placeholder-gray-400 border border-[#E2DDD4] focus:outline-none focus:ring-2 focus:ring-[#004F40]/20 font-sans" />
                </div>

                <div class="col-span-1">
                    <label class="block text-xs font-bold text-gray-700 mb-2 font-sans"><?php esc_html_e('شماره تماس *', 'royesh'); ?></label>
                    <input type="text" name="phone" required placeholder="<?php esc_attr_e('مثال: ۰۹۱۲۳۴۵۶۷۸۹', 'royesh'); ?>" class="bg-white w-full px-5 py-3.5 rounded-full text-sm text-gray-700 placeholder-gray-400 border border-[#E2DDD4] focus:outline-none focus:ring-2 focus:ring-[#004F40]/20 font-sans" />
                </div>

                <div class="col-span-1">
                    <label class="block text-xs font-bold text-gray-700 mb-2 font-sans"><?php esc_html_e('ایمیل', 'royesh'); ?></label>
                    <input type="email" name="email" placeholder="<?php esc_attr_e('مثال: info@example.com', 'royesh'); ?>" class="bg-white w-full px-5 py-3.5 rounded-full text-sm text-gray-700 placeholder-gray-400 border border-[#E2DDD4] focus:outline-none focus:ring-2 focus:ring-[#004F40]/20 font-sans" />
                </div>

                <div class="col-span-1">
                    <label class="block text-xs font-bold text-gray-700 mb-2 font-sans"><?php esc_html_e('موضوع پیام *', 'royesh'); ?></label>
                    <input type="text" name="subject" required placeholder="<?php esc_attr_e('مثال: درخواست همکاری و مشاوره', 'royesh'); ?>" class="bg-white w-full px-5 py-3.5 rounded-full text-sm text-gray-700 placeholder-gray-400 border border-[#E2DDD4] focus:outline-none focus:ring-2 focus:ring-[#004F40]/20 font-sans" />
                </div>

                <div class="col-span-1 md:col-span-2">
                    <label class="block text-xs font-bold text-gray-700 mb-2 font-sans"><?php esc_html_e('متن پیام شما *', 'royesh'); ?></label>
                    <textarea name="message" required placeholder="<?php esc_attr_e('پیام خود را به طور کامل بنویسید...', 'royesh'); ?>" class="bg-white w-full px-5 py-3.5 rounded-[24px] text-sm text-gray-700 placeholder-gray-400 border border-[#E2DDD4] focus:outline-none focus:ring-2 focus:ring-[#004F40]/20 resize-none h-32 font-sans"></textarea>
                </div>

                <!-- Math CAPTCHA -->
                <div class="col-span-1 md:col-span-2">
                    <label class="block text-xs font-bold text-gray-700 mb-2 font-sans">
                        <?php esc_html_e('کد امنیتی *', 'royesh'); ?>
                    </label>
                    <div class="royesh-captcha-row flex items-center gap-3 flex-wrap">
                        <span class="royesh-captcha-question bg-[#FAF8F4] border border-[#E2DDD4] px-4 py-3 rounded-full text-sm font-bold text-[#004F40] min-w-[70px] text-center" id="royesh-captcha-question-contact" dir="ltr">
                            <?php echo esc_html($captcha['question']); ?>
                        </span>
                        <input type="text"
                               name="captcha_answer"
                               id="royesh-captcha-answer-contact"
                               class="royesh-captcha-input bg-white w-28 px-4 py-3.5 rounded-full text-sm text-gray-700 text-center border border-[#E2DDD4] focus:outline-none focus:ring-2 focus:ring-[#004F40]/20 font-sans"
                               placeholder="؟"
                               required
                               inputmode="numeric"
                               autocomplete="off" />
                        <button type="button"
                                class="royesh-captcha-refresh flex items-center gap-1.5 px-4 py-3 bg-white border border-[#E2DDD4] hover:border-[#004F40] rounded-full text-xs text-gray-600 hover:text-[#004F40] transition-colors cursor-pointer"
                                id="royesh-captcha-refresh-contact"
                                title="<?php esc_attr_e('کد جدید', 'royesh'); ?>"
                                aria-label="<?php esc_attr_e('کد جدید', 'royesh'); ?>">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15"></path></svg>
                            <span class="font-sans"><?php esc_html_e('تغییر کد', 'royesh'); ?></span>
                        </button>
                    </div>
                </div>

                <!-- Inline Feedback Alert Box -->
                <div id="royesh-contact-feedback" class="col-span-1 md:col-span-2 hidden p-4 rounded-2xl text-sm font-sans" role="alert"></div>

                <div class="col-span-1 md:col-span-2">
                    <button type="submit" class="w-full bg-[#004F40] hover:bg-[#003d32] text-white font-bold py-4 rounded-full transition-all duration-300 shadow-md cursor-pointer font-sans">
                        <?php echo esc_html($cnt_form_btn); ?>
                    </button>
                </div>
            </form>
        </div>

    </div>
</section>
