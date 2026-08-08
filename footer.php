<?php
/**
 * Main Footer Template
 * 
 * @package Royesh
 * @version 1.0.0
 */

if (!defined('ABSPATH')) {
    exit; // Exit if accessed directly
}

$footer_bg = get_theme_mod('royesh_footer_bg', royesh_asset_img('fotter bg.webp'));
$footer_logo = get_theme_mod('royesh_footer_logo', royesh_asset_img('logo-white.svg'));
$footer_tagline = get_theme_mod('royesh_footer_tagline', 'همراه شما در مسیر رشد و نوآوری پایدار');
$footer_desc = get_theme_mod('royesh_footer_desc', 'موسسه رشد و نوآوری رویش با ارائه خدمات تخصصی مشاوره، شتابدهی و سرمایه‌گذاری، بستری پویا برای بالندگی کسب‌وکارهای نوپا و توسعه سازمان‌های پیشرو فراهم می‌آورد.');

$phone = get_theme_mod('royesh_phone', '۰۲۱ ۵۵۵ ۸۴۶۵');
$address = get_theme_mod('royesh_address', 'تهران، میدان ونک، خیابان ملاصدرا، پلاک ۴۲');
$advisor_text = get_theme_mod('royesh_footer_advisor_text', 'سوالی دارید؟ از ما بپرسید.');
$advisor_img = get_theme_mod('royesh_footer_advisor_img', royesh_asset_img('advisor.jpg'));
$footer_btn_text = get_theme_mod('royesh_footer_btn_text', 'پیام');
$footer_btn_link = get_theme_mod('royesh_footer_btn_link', home_url('/consultation'));
$footer_btn_bg   = get_theme_mod('royesh_footer_btn_bg', '#ffffff');
$footer_btn_color = get_theme_mod('royesh_footer_btn_text_color', '#000000');

$copyright = get_theme_mod('royesh_copyright', 'تمامی حقوق مادی و معنوی این سایت برای موسسه رشد و نوآوری رویش محفوظ است. © ۱۴۰۵');
$telegram = get_theme_mod('royesh_telegram', '#');
$linkedin = get_theme_mod('royesh_linkedin', '#');
$instagram = get_theme_mod('royesh_instagram', '#');
$whatsapp = get_theme_mod('royesh_whatsapp', '#');
?>

<div dir="rtl" class="w-full relative select-none">
    
    <!-- NEWSLETTER SECTION -->
    <section id="v-newsletter-section" class="w-full bg-[#F4F0EA] py-12 px-4 md:px-12 relative z-10 border-t border-[#EBE5D7]/40 v-reveal v-reveal-fade-up">
        <div class="max-w-[1440px] mx-auto grid grid-cols-1 md:grid-cols-2 gap-8 items-center">
            
            <!-- Right Column: Text -->
            <div class="text-right">
                <h3 class="text-2xl font-extrabold text-black mb-2 font-sans">
                    <?php esc_html_e('در خبرنامه ثبت‌نام کنید.', 'royesh'); ?>
                </h3>
                <p class="text-gray-600 text-sm leading-relaxed font-sans font-normal max-w-xl">
                    <?php esc_html_e('با عضویت در خبرنامه رویش، آخرین تحلیل‌ها، مقالات تخصصی توسعه کسب‌وکار و جدیدترین فرصت‌های سرمایه‌گذاری را مستقیماً در ایمیل خود دریافت کنید و از رویدادها باخبر شوید.', 'royesh'); ?>
                </p>
            </div>

            <!-- Left Column: Form -->
            <div class="flex justify-end w-full">
                <form id="royesh-newsletter-form" onsubmit="event.preventDefault();" class="relative flex items-center bg-white rounded-full p-1.5 shadow-sm w-full max-w-md mr-auto border border-[#EBE5D7]/50">
                    <input type="email" placeholder="<?php esc_attr_e('ایمیل', 'royesh'); ?>" class="w-full bg-transparent border-none focus:ring-0 px-4 text-sm outline-none text-gray-700 font-sans">
                    <button type="submit" class="bg-[#004F40] text-white px-8 py-3 rounded-full text-sm font-bold whitespace-nowrap hover:bg-[#003b30] transition-colors cursor-pointer font-sans">
                        <?php esc_html_e('ارسال پیام', 'royesh'); ?>
                    </button>
                </form>
            </div>

        </div>
    </section>

    <!-- MAIN FOOTER SECTION -->
    <footer class="w-full relative overflow-hidden pt-16 pb-6 px-4 md:px-12 bg-cover bg-center select-none" style="background-image: url('<?php echo esc_url($footer_bg); ?>')">
        
        <!-- Dark Green Overlay -->
        <div class="absolute inset-0 bg-[#021f18]/80 z-0"></div>

        <!-- Content Wrapper -->
        <div class="relative z-10 max-w-[1440px] mx-auto">
            
            <!-- Main Grid: 4 columns -->
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-10 mb-12 text-white text-right">
                
                <!-- Column 1 (Right): Logo & Brand Details -->
                <div class="flex flex-col items-start text-right">
                    <a href="<?php echo esc_url(home_url('/')); ?>" class="flex items-center gap-3 focus:outline-none hover:opacity-90 transition-opacity" id="v-footer-logo-link">
                        <img src="<?php echo esc_url($footer_logo); ?>" alt="<?php echo esc_attr(get_bloginfo('name')); ?>" class="h-12 w-auto object-contain">
                    </a>
                    <h4 class="font-semibold mt-4 mb-2 text-base text-white font-sans">
                        <?php echo esc_html($footer_tagline); ?>
                    </h4>
                    <p class="text-sm text-gray-300 leading-relaxed font-sans font-normal max-w-sm">
                        <?php echo esc_html($footer_desc); ?>
                    </p>
                </div>

                <!-- Column 2 (Middle-Right): Services -->
                <div class="footer-accordion-item border-b border-white/10 md:border-b-0 pb-4 md:pb-0">
                    <button class="footer-accordion-trigger w-full flex items-center justify-between text-right focus:outline-none md:pointer-events-none py-3 md:py-0" aria-expanded="false">
                        <?php $menu_name_1 = wp_get_nav_menu_name('footer-menu-1'); ?>
                        <h4 class="font-bold text-lg text-white font-sans"><?php echo esc_html($menu_name_1 ? $menu_name_1 : 'خدمات ما'); ?></h4>
                        <span class="text-[#E8D2AF] transition-transform duration-300 md:hidden">
                            <svg class="w-5 h-5 transform transition-transform duration-300" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 8.25l-7.5 7.5-7.5-7.5"></path>
                            </svg>
                        </span>
                    </button>
                    <?php
                    if (has_nav_menu('footer-menu-1')) {
                        wp_nav_menu([
                            'theme_location' => 'footer-menu-1',
                            'container'      => false,
                            'menu_class'     => 'footer-accordion-content flex flex-col gap-3 text-sm text-gray-300 font-sans font-normal overflow-hidden transition-all duration-300 max-h-0 opacity-0 md:max-h-none md:opacity-100 md:mt-6',
                            'fallback_cb'    => false,
                        ]);
                    } else {
                        ?>
                        <ul class="footer-accordion-content flex flex-col gap-3 text-sm text-gray-300 font-sans font-normal overflow-hidden transition-all duration-300 max-h-0 opacity-0 md:max-h-none md:opacity-100 md:mt-6">
                            <li><a href="<?php echo esc_url(royesh_page_url('services') . '#financing-services'); ?>" class="hover:text-white hover:underline transition-colors"><?php esc_html_e('خدمات تأمین مالی', 'royesh'); ?></a></li>
                            <li><a href="<?php echo esc_url(royesh_page_url('services') . '#credit-services'); ?>" class="hover:text-white hover:underline transition-colors"><?php esc_html_e('خدمات اعتباری', 'royesh'); ?></a></li>
                            <li><a href="<?php echo esc_url(royesh_page_url('services') . '#liquidity-management'); ?>" class="hover:text-white hover:underline transition-colors"><?php esc_html_e('مدیریت نقدینگی', 'royesh'); ?></a></li>
                            <li><a href="<?php echo esc_url(royesh_page_url('services') . '#asset-management'); ?>" class="hover:text-white hover:underline transition-colors"><?php esc_html_e('مدیریت دارایی', 'royesh'); ?></a></li>
                        </ul>
                        <?php
                    }
                    ?>
                </div>

                <!-- Column 3 (Middle-Left): Quick Links -->
                <div class="footer-accordion-item border-b border-white/10 md:border-b-0 pb-4 md:pb-0">
                    <button class="footer-accordion-trigger w-full flex items-center justify-between text-right focus:outline-none md:pointer-events-none py-3 md:py-0" aria-expanded="false">
                        <?php $menu_name_2 = wp_get_nav_menu_name('footer-menu-2'); ?>
                        <h4 class="font-bold text-lg text-white font-sans"><?php echo esc_html($menu_name_2 ? $menu_name_2 : 'دسترسی سریع'); ?></h4>
                        <span class="text-[#E8D2AF] transition-transform duration-300 md:hidden">
                            <svg class="w-5 h-5 transform transition-transform duration-300" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 8.25l-7.5 7.5-7.5-7.5"></path>
                            </svg>
                        </span>
                    </button>
                    <?php
                    if (has_nav_menu('footer-menu-2')) {
                        wp_nav_menu([
                            'theme_location' => 'footer-menu-2',
                            'container'      => false,
                            'menu_class'     => 'footer-accordion-content flex flex-col gap-3 text-sm text-gray-300 font-sans font-normal overflow-hidden transition-all duration-300 max-h-0 opacity-0 md:max-h-none md:opacity-100 md:mt-6',
                            'fallback_cb'    => false,
                        ]);
                    } else {
                        ?>
                        <ul class="footer-accordion-content flex flex-col gap-3 text-sm text-gray-300 font-sans font-normal overflow-hidden transition-all duration-300 max-h-0 opacity-0 md:max-h-none md:opacity-100 md:mt-6">
                            <li><a href="<?php echo esc_url(home_url('/')); ?>" class="hover:text-white hover:underline transition-colors"><?php esc_html_e('صفحه اصلی', 'royesh'); ?></a></li>
                            <li><a href="<?php echo esc_url(royesh_page_url('services')); ?>" class="hover:text-white hover:underline transition-colors"><?php esc_html_e('خدمات ما', 'royesh'); ?></a></li>
                            <li><a href="<?php echo esc_url(royesh_page_url('news')); ?>" class="hover:text-white hover:underline transition-colors"><?php esc_html_e('اخبار و مقالات', 'royesh'); ?></a></li>
                            <li><a href="<?php echo esc_url(royesh_page_url('about')); ?>" class="hover:text-white hover:underline transition-colors"><?php esc_html_e('درباره ما', 'royesh'); ?></a></li>
                            <li><a href="<?php echo esc_url(royesh_page_url('contact')); ?>" class="hover:text-white hover:underline transition-colors"><?php esc_html_e('ارتباط با ما', 'royesh'); ?></a></li>
                            <li><a href="<?php echo esc_url(royesh_consultation_url()); ?>" class="hover:text-white hover:underline transition-colors"><?php esc_html_e('درخواست مشاوره', 'royesh'); ?></a></li>
                        </ul>
                        <?php
                    }
                    ?>
                </div>

                <!-- Column 4 (Left): Contact Information & Support Avatar Widget -->
                <div class="flex flex-col items-start text-right">
                    <h4 class="font-bold text-lg mb-6 text-white font-sans"><?php esc_html_e('ارتباط با ما', 'royesh'); ?></h4>
                    
                    <!-- Address Row -->
                    <div class="flex items-center gap-3 text-sm mb-4 text-gray-300 font-sans font-normal">
                        <svg class="w-5 h-5 text-[#E8D2AF] shrink-0 fill-none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path>
                            <path stroke-linecap="round" stroke-linejoin="round" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path>
                        </svg>
                        <span><?php echo esc_html($address); ?></span>
                    </div>

                    <!-- Phone Row -->
                    <div class="flex items-center gap-3 text-sm mb-8 text-gray-300 font-sans font-normal">
                        <svg class="w-5 h-5 text-[#E8D2AF] shrink-0 fill-none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.94.725l.548 2.2a1 1 0 01-.321.988l-1.305.98a10.582 10.582 0 004.872 4.872l.98-1.305a1 1 0 01.988-.321l2.2.548a1 1 0 01.725.94V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"></path>
                        </svg>
                        <span dir="ltr"><?php echo esc_html($phone); ?></span>
                    </div>

                    <!-- Support Widget -->
                    <div class="flex flex-col items-start w-full">
                        <div class="flex items-center gap-3">
                            <img src="<?php echo esc_url($advisor_img); ?>" alt="<?php esc_attr_e('مشاور رویش', 'royesh'); ?>" class="w-8 h-8 rounded-full border border-[#E8D2AF]/50 object-cover">
                            <span class="text-sm text-gray-200 font-sans font-medium"><?php echo esc_html($advisor_text); ?></span>
                        </div>
                        <a href="<?php echo esc_url($footer_btn_link ?: royesh_consultation_url()); ?>" class="px-8 py-2 rounded-xl text-sm font-bold mt-3 transition-all cursor-pointer font-sans inline-block text-center hover:opacity-80 hover:scale-105 active:scale-95" style="background-color: <?php echo esc_attr($footer_btn_bg); ?>; color: <?php echo esc_attr($footer_btn_color); ?>">
                            <?php echo esc_html($footer_btn_text ?: 'پیام'); ?>
                        </a>
                    </div>

                </div>

            </div>

            <!-- Bottom Bar: Copyright, Scroll-to-top & Social Squares -->
            <div class="border-t border-white/20 pt-6 flex flex-col-reverse md:flex-row justify-between items-center gap-4">
                
                <!-- Right Side: Copyright & Scroll to top -->
                <div class="flex items-center">
                    <button onclick="window.scrollTo({top: 0, behavior: 'smooth'});" class="w-8 h-8 rounded-full bg-[#E8D2AF] text-black hover:bg-white flex items-center justify-center ml-4 cursor-pointer hover:scale-105 active:scale-95 transition-all" aria-label="<?php esc_attr_e('Scroll to top', 'royesh'); ?>">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M4.5 15.75l7.5-7.5 7.5 7.5"></path>
                        </svg>
                    </button>
                    <span class="text-xs text-gray-400 font-sans font-normal">
                        <?php echo esc_html($copyright); ?>
                    </span>
                </div>

                <!-- Left Side: Social Squares & Designer Signature -->
                <div class="flex flex-col sm:flex-row items-center gap-4 sm:gap-6">
                    <span class="text-xs text-gray-400 font-sans font-normal">
                        <?php esc_html_e('طراحی و توسعه:', 'royesh'); ?> <a href="https://ihasht.ir/" target="_blank" rel="noopener noreferrer" class="hover:text-[#E8D2AF] text-gray-300 transition-colors"><?php esc_html_e('هشت بهشت', 'royesh'); ?></a>
                    </span>
                    <div class="flex items-center gap-3.5">
                        <!-- Telegram -->
                        <?php if ($telegram && $telegram !== '#') : ?>
                        <a href="<?php echo esc_url($telegram); ?>" class="bg-[#E8D2AF] text-black w-8 h-8 rounded-lg flex items-center justify-center hover:opacity-80 hover:scale-105 active:scale-95 transition-all" aria-label="Telegram" target="_blank" rel="noopener noreferrer">
                            <svg class="w-[19px] h-[19px] -rotate-45 -translate-x-[0.5px] translate-y-[0.5px]" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M6 12L3.269 3.126A59.768 59.768 0 0121.485 12 59.77 59.77 0 013.27 20.876L5.999 12zm0 0h7.5"></path>
                            </svg>
                        </a>
                        <?php endif; ?>
                        <!-- LinkedIn -->
                        <?php if ($linkedin && $linkedin !== '#') : ?>
                        <a href="<?php echo esc_url($linkedin); ?>" class="bg-[#E8D2AF] text-black w-8 h-8 rounded-lg flex items-center justify-center hover:opacity-80 hover:scale-105 active:scale-95 transition-all" aria-label="LinkedIn" target="_blank" rel="noopener noreferrer">
                            <svg class="w-[19px] h-[19px] fill-current" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                <path d="M19 0h-14c-2.761 0-5 2.239-5 5v14c0 2.761 2.239 5 5 5h14c2.762 0 5-2.239 5-5v-14c0-2.761-2.238-5-5-5zm-11 19h-3v-11h3v11zm-1.5-12.268c-.966 0-1.75-.79-1.75-1.764s.784-1.764 1.75-1.764 1.75.79 1.75 1.764-.783 1.764-1.75 1.764zm13.5 12.268h-3v-5.604c0-3.368-4-3.113-4 0v5.604h-3v-11h3v1.765c1.396-2.586 7-2.777 7 2.476v6.759z"/>
                            </svg>
                        </a>
                        <?php endif; ?>
                        <!-- Instagram -->
                        <?php if ($instagram && $instagram !== '#') : ?>
                        <a href="<?php echo esc_url($instagram); ?>" class="bg-[#E8D2AF] text-black w-8 h-8 rounded-lg flex items-center justify-center hover:opacity-80 hover:scale-105 active:scale-95 transition-all" aria-label="Instagram" target="_blank" rel="noopener noreferrer">
                            <svg class="w-[19px] h-[19px] stroke-current fill-none" stroke-width="2.5" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                <rect x="2" y="2" width="20" height="20" rx="5" ry="5"></rect>
                                <path d="M16 11.37A4 4 0 1 1 12.63 8 4 4 0 0 1 16 11.37z"></path>
                                <line x1="17.5" y1="6.5" x2="17.51" y2="6.5"></line>
                            </svg>
                        </a>
                        <?php endif; ?>
                        <!-- WhatsApp -->
                        <?php if ($whatsapp && $whatsapp !== '#') : ?>
                        <a href="<?php echo esc_url($whatsapp); ?>" class="bg-[#E8D2AF] text-black w-8 h-8 rounded-lg flex items-center justify-center hover:opacity-80 hover:scale-105 active:scale-95 transition-all" aria-label="WhatsApp" target="_blank" rel="noopener noreferrer">
                            <svg class="w-[19px] h-[19px] fill-none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M8.684 13.342C8.886 12.938 9 12.482 9 12c0-.482-.114-.938-.316-1.342m0 2.684a3 3 0 110-2.684m0 2.684l6.632 3.316m-6.632-6l6.632-3.316m0 0a3 3 0 105.367-2.684 3 3 0 00-5.367 2.684zm0 9.316a3 3 0 105.368 2.684 3 3 0 00-5.368-2.684z"></path>
                            </svg>
                        </a>
                        <?php endif; ?>
                    </div>
                    </div>
                </div>

            </div>

        </div>

    </footer>

</div>

<?php wp_footer(); ?>
</body>
</html>
