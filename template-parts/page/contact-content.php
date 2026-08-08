<?php
/**
 * Contact Page Content Template Part
 * 
 * @package Royesh
 * @version 1.0.0
 */

if (!defined('ABSPATH')) {
    exit; // Exit if accessed directly
}

$phone = get_theme_mod('royesh_phone', '۰۲۱-۶۵۲۵۴۱۲۲');
$phone_raw = preg_replace('/[^\d\+]/', '', $phone);
$email = get_theme_mod('royesh_email', 'info@royeshcapital.com');
$address = get_theme_mod('royesh_address', 'تهران، میدان ونک، خیابان ملاصدرا، پلاک ۴۲');
?>

<!-- PAGE HERO SECTION -->
<section class="relative w-full bg-[#004F40] py-20 px-4 md:px-12 overflow-hidden border-b border-[#2E7063]">
    <div class="absolute inset-0 opacity-100 pointer-events-none select-none z-0">
        <img src="<?php echo royesh_asset_img('bg vector patt.svg'); ?>" alt="Pattern" class="w-full h-full object-cover" />
    </div>
    <div class="absolute top-[10%] left-[10%] w-[350px] h-[350px] rounded-full bg-[#2E7063]/25 blur-[100px] pointer-events-none z-0"></div>
    <div class="absolute bottom-[5%] right-[5%] w-[250px] h-[250px] rounded-full bg-[#B1862D]/10 blur-[80px] pointer-events-none z-0"></div>

    <div class="max-w-[1150px] mx-auto relative z-10 text-center text-white">
        <span class="text-[#B1862D] text-sm md:text-base font-bold tracking-wider block mb-3 font-sans"><?php esc_html_e('ارتباط با رویش', 'royesh'); ?></span>
        <h1 class="text-3xl md:text-5xl font-black leading-tight mb-6"><?php esc_html_e('تماس با ما', 'royesh'); ?></h1>
        <p class="text-white/80 text-base md:text-lg max-w-2xl mx-auto leading-relaxed font-light">
            <?php esc_html_e('تیم کارشناسان رویش سرمایه آماده پاسخگویی به پرسش‌ها و ارائه خدمات مشاوره تخصصی به شما هستند.', 'royesh'); ?>
        </p>
    </div>
</section>

<!-- CONTACT DETAILS & FORM -->
<section class="w-full py-20 px-4 md:px-12 bg-white">
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
                <p class="text-gray-600 text-sm leading-relaxed"><?php echo esc_html($address); ?></p>
            </div>

            <!-- Phone Card -->
            <div class="bg-[#FAF8F4] border border-[#EBE5D7]/80 rounded-[24px] p-6 shadow-sm">
                <div class="w-12 h-12 rounded-2xl bg-[#004F40] text-[#E8D2AF] flex items-center justify-center mb-4">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.94.725l.548 2.2a1 1 0 01-.321.988l-1.305.98a10.582 10.582 0 004.872 4.872l.98-1.305a1 1 0 01.988-.321l2.2.548a1 1 0 01.725.94V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"></path>
                    </svg>
                </div>
                <h3 class="text-lg font-bold text-gray-900 mb-2"><?php esc_html_e('تلفن‌های تماس', 'royesh'); ?></h3>
                <a href="tel:<?php echo esc_attr($phone_raw); ?>" class="text-[#004F40] font-bold text-base hover:underline block" dir="ltr"><?php echo esc_html($phone); ?></a>
            </div>

            <!-- Email Card -->
            <div class="bg-[#FAF8F4] border border-[#EBE5D7]/80 rounded-[24px] p-6 shadow-sm">
                <div class="w-12 h-12 rounded-2xl bg-[#004F40] text-[#E8D2AF] flex items-center justify-center mb-4">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path>
                    </svg>
                </div>
                <h3 class="text-lg font-bold text-gray-900 mb-2"><?php esc_html_e('پست الکترونیک', 'royesh'); ?></h3>
                <a href="mailto:<?php echo esc_attr($email); ?>" class="text-[#004F40] font-bold text-sm hover:underline block" dir="ltr"><?php echo esc_html($email); ?></a>
            </div>
        </div>

        <!-- Form Block (Left) -->
        <div class="lg:col-span-2 bg-[#F3ECE3] rounded-[32px] p-8 shadow-sm border border-[#E5DDD0] text-right">
            <h2 class="text-2xl font-extrabold text-gray-900 mb-6"><?php esc_html_e('ارسال پیام به کارشناسان رویش', 'royesh'); ?></h2>

            <form id="royesh-contact-page-form" class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <?php wp_nonce_field('royesh_nonce_action', 'royesh_contact_nonce'); ?>

                <div style="display:none;" aria-hidden="true">
                    <input type="text" name="website_hp" tabindex="-1" autocomplete="off" />
                </div>

                <div class="col-span-1">
                    <input type="text" name="fullname" required placeholder="<?php esc_attr_e('نام و نام خانوادگی', 'royesh'); ?>" class="bg-white w-full px-6 py-4 rounded-full text-sm text-gray-700 placeholder-gray-400 border border-[#E2DDD4] focus:outline-none focus:ring-2 focus:ring-[#004F40]/20 font-sans" />
                </div>

                <div class="col-span-1">
                    <input type="text" name="phone" required placeholder="<?php esc_attr_e('شماره تماس', 'royesh'); ?>" class="bg-white w-full px-6 py-4 rounded-full text-sm text-gray-700 placeholder-gray-400 border border-[#E2DDD4] focus:outline-none focus:ring-2 focus:ring-[#004F40]/20 font-sans" />
                </div>

                <div class="col-span-1 md:col-span-2">
                    <input type="email" name="email" placeholder="<?php esc_attr_e('ایمیل', 'royesh'); ?>" class="bg-white w-full px-6 py-4 rounded-full text-sm text-gray-700 placeholder-gray-400 border border-[#E2DDD4] focus:outline-none focus:ring-2 focus:ring-[#004F40]/20 font-sans" />
                </div>

                <div class="col-span-1 md:col-span-2">
                    <textarea name="message" required placeholder="<?php esc_attr_e('متن پیام شما', 'royesh'); ?>" class="bg-white w-full px-6 py-4 rounded-[24px] text-sm text-gray-700 placeholder-gray-400 border border-[#E2DDD4] focus:outline-none focus:ring-2 focus:ring-[#004F40]/20 resize-none h-36 font-sans"></textarea>
                </div>

                <div class="col-span-1 md:col-span-2">
                    <button type="submit" class="w-full bg-[#004F40] hover:bg-[#003b30] text-white font-bold py-4 rounded-full transition-all duration-300 shadow-md cursor-pointer">
                        <?php esc_html_e('ارسال پیام', 'royesh'); ?>
                    </button>
                </div>
            </form>
        </div>

    </div>
</section>
