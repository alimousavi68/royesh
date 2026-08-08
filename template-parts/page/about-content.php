<?php
/**
 * About Page Content Template Part
 * 
 * @package Royesh
 * @version 1.0.0
 */

if (!defined('ABSPATH')) {
    exit; // Exit if accessed directly
}
?>

<!-- HERO SECTION -->
<section class="relative w-full bg-[#004F40] py-20 px-4 md:px-12 overflow-hidden border-b border-[#2E7063]">
    <div class="absolute inset-0 opacity-100 pointer-events-none select-none z-0">
        <img src="<?php echo royesh_asset_img('bg vector patt.svg'); ?>" alt="Pattern" class="w-full h-full object-cover" />
    </div>
    <div class="absolute top-[10%] left-[10%] w-[350px] h-[350px] rounded-full bg-[#2E7063]/25 blur-[100px] pointer-events-none z-0"></div>
    <div class="absolute bottom-[5%] right-[5%] w-[250px] h-[250px] rounded-full bg-[#B1862D]/10 blur-[80px] pointer-events-none z-0"></div>

    <div class="max-w-[1150px] mx-auto relative z-10 text-center text-white">
        <span class="text-[#B1862D] text-sm md:text-base font-bold tracking-wider block mb-3 font-sans"><?php esc_html_e('همراه رشد شما', 'royesh'); ?></span>
        <h1 class="text-3xl md:text-5xl font-black leading-tight mb-6"><?php esc_html_e('درباره گروه اقتصادی رویش', 'royesh'); ?></h1>
        <p class="text-white/80 text-base md:text-lg max-w-2xl mx-auto leading-relaxed font-light">
            <?php esc_html_e('تعهد ما، هدایت هوشمندانه سرمایه برای خلق ارزش پایدار و توانمندسازی سازمان‌های پیشرو است.', 'royesh'); ?>
        </p>
    </div>
</section>

<!-- INTRO & PHILOSOPHY SECTION -->
<section class="w-full py-20 bg-white">
    <div class="max-w-[1150px] mx-auto px-6 md:px-12 grid grid-cols-1 lg:grid-cols-2 gap-12 lg:gap-16 items-center">
        
        <div class="flex flex-col text-right v-reveal v-reveal-fade-right">
            <div class="flex items-center gap-4 mb-6">
                <div class="w-[55px] h-[55px] bg-[#FAF8F4] border border-[#B1862D]/10 rounded-[17px] flex items-center justify-center text-[#B1862D] shadow-sm">
                    <svg class="w-7 h-7" viewBox="0 0 41 41" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M32.2805 12.7064L31.7353 12.1632C31.6294 12.0556 31.5681 11.9121 31.5681 11.7601V10.9947C31.5681 8.24945 29.3335 6.01489 26.5882 6.01489H25.8229C25.6726 6.01489 25.5255 5.95331 25.4196 5.8491L24.8766 5.30419C22.9376 3.36353 19.7788 3.36011 17.833 5.30419L17.29 5.84743C17.1841 5.95335 17.037 6.01489 16.8867 6.01489H16.1214C13.3761 6.01489 11.1415 8.24945 11.1415 10.9947V11.7601C11.1415 11.9121 11.0819 12.0556 10.9742 12.1615L10.4291 12.7081C8.48847 14.6488 8.48847 17.8092 10.4291 19.7516L10.9742 20.2949C11.0802 20.4025 11.1415 20.5459 11.1415 20.698V21.4633C11.1415 23.556 12.4415 25.343 14.2729 26.0793L11.5807 35.5228C11.4474 35.9926 11.5926 36.4984 11.9565 36.8264C12.3169 37.1527 12.8345 37.2467 13.2907 37.0639L18.0195 35.1694C20.172 34.3118 22.5394 34.3118 24.6885 35.1694L29.4206 37.0656C29.576 37.1271 29.7384 37.1578 29.8973 37.1578C30.2099 37.1578 30.5156 37.045 30.7548 36.8281C31.1187 36.5001 31.2638 35.9962 31.1306 35.5228L28.4384 26.0809C30.2697 25.3446 31.5698 23.5577 31.5698 21.465V20.6996C31.5698 20.5476 31.6294 20.4041 31.737 20.2982L32.2821 19.7533C32.2821 19.7533 32.2821 19.7533 32.2821 19.7516C34.2211 17.8092 34.2211 14.6488 32.2805 12.7064ZM25.6386 32.7879C22.8796 31.6877 19.8369 31.686 17.066 32.7879L14.7596 33.7121L16.832 26.4431H16.8833C17.0337 26.4431 17.1803 26.5047 17.2862 26.6089L17.8297 27.1538C18.8 28.1242 20.0745 28.6111 21.3523 28.6111C22.6267 28.6111 23.9029 28.1259 24.8749 27.1538L25.4179 26.6106C25.5238 26.5047 25.6709 26.4431 25.8212 26.4431H25.8725L27.9446 33.7121L25.6386 32.7879ZM30.4695 17.939L29.9248 18.4839C29.332 19.075 29.0073 19.8626 29.0073 20.698V21.4633C29.0073 22.7958 27.9224 23.8806 26.5899 23.8806H25.8246C24.9994 23.8806 24.1916 24.2154 23.6091 24.7997L23.0656 25.3429C22.1517 26.2552 20.5596 26.2552 19.6456 25.3429L19.1022 24.798C18.5196 24.2155 17.7135 23.8806 16.8867 23.8806H16.1214C14.7889 23.8806 13.704 22.7958 13.704 21.4633V20.698C13.704 19.8609 13.3796 19.0751 12.7868 18.4823L12.2417 17.939C11.3004 16.996 11.3004 15.4603 12.2417 14.519L12.7868 13.9741C13.3796 13.383 13.704 12.5955 13.704 11.7601V10.9947C13.704 9.66225 14.7889 8.57739 16.1214 8.57739H16.8867C17.7118 8.57739 18.5196 8.24262 19.1022 7.65837L19.6456 7.11513C20.5596 6.20288 22.1517 6.20288 23.0656 7.11513L23.6091 7.66003C24.1916 8.24258 24.9977 8.57739 25.8246 8.57739H26.5899C27.9224 8.57739 29.0073 9.66225 29.0073 10.9947V11.7601C29.0073 12.5972 29.332 13.383 29.9248 13.9758L30.4695 14.519C31.4108 15.462 31.4108 16.996 30.4695 17.939ZM25.6761 13.0447C26.1766 13.5452 26.1766 14.3567 25.6761 14.8573L21.12 19.4134C20.8791 19.6543 20.5545 19.7892 20.2145 19.7892C19.8746 19.7892 19.5482 19.6543 19.309 19.4134L17.0318 17.1362C16.5313 16.6356 16.5313 15.8241 17.0318 15.3236C17.5341 14.8213 18.3456 14.8247 18.8444 15.3236L20.2162 16.6953L23.8668 13.0447C24.3657 12.5441 25.1755 12.5441 25.6761 13.0447Z" fill="#B1862D"/>
                    </svg>
                </div>
                <h2 class="text-3xl font-extrabold text-[#014235] leading-none"><?php esc_html_e('فلسفه برند و مأموریت ما', 'royesh'); ?></h2>
            </div>
            <p class="text-[#333333] text-base leading-relaxed mb-6 text-justify">
                <?php esc_html_e('موسسه رشد و نوآوری رویش با تکیه بر هم‌افزایی دانش تخصصی و تجربه مدیران ارشد خود، بستری پویا برای توانمندسازی اقتصادی فعالان و نهادهای کسب‌وکار ایجاد کرده است. فلسفه وجودی ما بر پایه سه اصل استوار است: نگاه مسئله‌محور، همراستاسازی منافع و چشم‌انداز آینده‌نگر.', 'royesh'); ?>
            </p>
            <p class="text-[#333333] text-base leading-relaxed text-justify mb-8">
                <?php esc_html_e('هدف ما ایجاد پلی ایمن میان بازارهای سرمایه و نیازهای حقیقی بنگاه‌های اقتصادی است. ما در این مسیر متعهد به شفافیت، پویایی و خروجی‌های ملموس مالی هستیم.', 'royesh'); ?>
            </p>
        </div>

        <div id="v-philosophy-collage" class="relative w-full h-[380px] sm:h-[440px] lg:h-[488px] flex items-center justify-center lg:block select-none flex-shrink-0 v-reveal v-reveal-fade-left">
            <img 
                src="<?php echo royesh_asset_img('brand-big.webp'); ?>" 
                alt="<?php esc_attr_e('طراحی راهکار مالی', 'royesh'); ?>" 
                class="w-[155px] h-[287px] sm:w-[200px] sm:h-[370px] lg:w-[235px] lg:h-[436px] rounded-[80px] lg:rounded-[128px] object-cover absolute right-2 lg:right-auto lg:left-[240px] top-[20px] lg:top-[52px] z-10 transition-transform duration-500 hover:scale-[1.03] shadow-lg v-reveal v-reveal-fade-right v-delay-200"
            />

            <div class="absolute left-2 lg:left-0 top-[100px] lg:top-[129px] z-20 flex flex-col gap-4 items-end">
                <div class="relative w-[140px] h-[146px] sm:w-[180px] sm:h-[188px] lg:w-[222px] lg:h-[232px] group/small-img v-reveal v-reveal-fade-left v-delay-300">
                    <img 
                        src="<?php echo royesh_asset_img('Isolation_Mode.svg'); ?>" 
                        alt="Isolation Mode Decor" 
                        class="absolute bottom-full left-2 w-[80px] sm:w-[100px] lg:w-[120px] object-contain pointer-events-none mb-0"
                    />
                    <img 
                        src="<?php echo royesh_asset_img('brand-small.jpg'); ?>" 
                        alt="<?php esc_attr_e('فلسفه برند رویش', 'royesh'); ?>" 
                        class="w-full h-full rounded-tl-[38px] rounded-tr-none rounded-b-none object-cover grayscale opacity-90 transition-all duration-500 hover:grayscale-0 shadow-md"
                    />
                </div>

                <div class="w-[240px] sm:w-[280px] lg:w-[304px] h-[80px] sm:h-[95px] lg:h-[106px] bg-[#004F40] flex flex-col justify-center px-4 lg:px-6 rounded-tl-none rounded-tr-full rounded-br-full rounded-bl-full shadow-xl text-left items-start v-reveal v-reveal-fade-up v-delay-400">
                    <span class="text-[#E8D2AF] text-[18px] sm:text-[20px] lg:text-[22px] font-extrabold tracking-tight w-full text-left">
                        <?php esc_html_e('پشتیبانی', 'royesh'); ?> <span class="text-white"><?php esc_html_e('مستمر', 'royesh'); ?></span>
                    </span>
                    <div class="flex items-center gap-2 mt-1 w-full overflow-hidden flex-row-reverse">
                        <div class="flex-grow border-b border-dashed border-[#C9C9C9] opacity-70"></div>
                        <span class="text-white text-[14px] sm:text-[16px] lg:text-[18px] font-normal flex-shrink-0 text-left">
                            <?php esc_html_e('رویش سرمایه', 'royesh'); ?>
                        </span>
                    </div>
                </div>
            </div>
        </div>

    </div>
</section>

<!-- CORE VALUES SECTION -->
<section class="w-full bg-[#FAF8F4] py-20 border-t border-b border-[#EBE5D7]/50">
    <div class="max-w-[1150px] mx-auto px-6 md:px-12 text-center">
        <span class="text-[#B1862D] font-bold text-sm block mb-2"><?php esc_html_e('ارزش‌های بنیادین', 'royesh'); ?></span>
        <h2 class="text-3xl font-extrabold text-[#014235] mb-12"><?php esc_html_e('ارزش‌هایی که مسیر حرکت ما را روشن می‌کنند', 'royesh'); ?></h2>

        <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
            <div class="bg-white border border-[#EBE5D7]/60 rounded-[24px] p-8 text-right shadow-sm hover:shadow-md transition-all duration-300 v-reveal v-reveal-fade-up v-delay-100">
                <div class="w-[50px] h-[50px] rounded-[14px] bg-[#004F40] text-[#E8D2AF] flex items-center justify-center mb-6">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M9.663 17h4.673M12 3v1m6.364 1.636l-.707.707M21 12h-1M4 12H3m3.343-5.657l-.707-.707m2.828 9.9a5 5 0 117.072 0l-.548.547A3.374 3.374 0 0014 18.469V19a2 2 0 11-4 0v-.531c0-.895-.356-1.754-.988-2.386l-.548-.547z"></path>
                    </svg>
                </div>
                <h3 class="text-xl font-bold text-black mb-3"><?php esc_html_e('نگاه مسئله‌محور', 'royesh'); ?></h3>
                <p class="text-gray-600 text-sm leading-relaxed font-light"><?php esc_html_e('تمرکز کامل بر شناسایی دقیق چالش‌ها و ارائه راهکارهای علمی و ساختاری متناسب با آن‌ها.', 'royesh'); ?></p>
            </div>

            <div class="bg-white border border-[#EBE5D7]/60 rounded-[24px] p-8 text-right shadow-sm hover:shadow-md transition-all duration-300 v-reveal v-reveal-fade-up v-delay-200">
                <div class="w-[50px] h-[50px] rounded-[14px] bg-[#004F40] text-[#E8D2AF] flex items-center justify-center mb-6">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"></path>
                    </svg>
                </div>
                <h3 class="text-xl font-bold text-black mb-3"><?php esc_html_e('همراستاسازی منافع', 'royesh'); ?></h3>
                <p class="text-gray-600 text-sm leading-relaxed font-light"><?php esc_html_e('خلق مدل‌های اقتصادی پایدار به‌گونه‌ای که منافع تمامی همکاران، سرمایه‌گذاران و ذینفعان تأمین شود.', 'royesh'); ?></p>
            </div>

            <div class="bg-white border border-[#EBE5D7]/60 rounded-[24px] p-8 text-right shadow-sm hover:shadow-md transition-all duration-300 v-reveal v-reveal-fade-up v-delay-300">
                <div class="w-[50px] h-[50px] rounded-[14px] bg-[#004F40] text-[#E8D2AF] flex items-center justify-center mb-6">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M13 7h8m0 0v8m0-8l-8 8-4-4-6 6"></path>
                    </svg>
                </div>
                <h3 class="text-xl font-bold text-black mb-3"><?php esc_html_e('آینده‌نگری مالی', 'royesh'); ?></h3>
                <p class="text-gray-600 text-sm leading-relaxed font-light"><?php esc_html_e('استفاده از ابزارهای تکنولوژی و مدل‌سازی نوین برای تضمین رشد و پاسخگویی به چالش‌های اقتصادی آینده.', 'royesh'); ?></p>
            </div>
        </div>
    </div>
</section>

<!-- TIMELINE SECTION -->
<section class="w-full py-20 bg-white">
    <div class="max-w-[800px] mx-auto px-6 md:px-12">
        <div class="text-center mb-16">
            <span class="text-[#B1862D] font-bold text-sm block mb-2"><?php esc_html_e('مسیر بالندگی', 'royesh'); ?></span>
            <h2 class="text-3xl font-extrabold text-[#014235]"><?php esc_html_e('گاه‌شمار توسعه رویش', 'royesh'); ?></h2>
        </div>

        <div class="relative border-r-2 border-[#EBE5D7] mr-4 md:mr-8 pr-8 flex flex-col gap-12 text-right">
            <div class="relative v-reveal v-reveal-fade-right v-delay-100">
                <div class="absolute top-1.5 -right-[41px] w-5 h-5 rounded-full bg-[#B1862D] border-4 border-white shadow-sm"></div>
                <span class="text-sm font-bold text-[#B1862D] block mb-1"><?php esc_html_e('۱۳۹۸', 'royesh'); ?></span>
                <h3 class="text-lg font-bold text-black mb-2"><?php esc_html_e('تأسیس و شروع مأموریت', 'royesh'); ?></h3>
                <p class="text-gray-600 text-sm leading-relaxed font-light"><?php esc_html_e('راه‌اندازی هسته اولیه رشد رویش با تمرکز بر مشاوره سرمایه‌گذاری خطرپذیر و شتابدهی استارتاپ‌ها.', 'royesh'); ?></p>
            </div>

            <div class="relative v-reveal v-reveal-fade-right v-delay-200">
                <div class="absolute top-1.5 -right-[41px] w-5 h-5 rounded-full bg-[#014235] border-4 border-white shadow-sm"></div>
                <span class="text-sm font-bold text-[#B1862D] block mb-1"><?php esc_html_e('۱۴۰۱', 'royesh'); ?></span>
                <h3 class="text-lg font-bold text-black mb-2"><?php esc_html_e('توسعه خدمات اعتباری و مالی', 'royesh'); ?></h3>
                <p class="text-gray-600 text-sm leading-relaxed font-light"><?php esc_html_e('ورود به حوزه خدمات نوین اعتباری و همکاری استراتژیک با بانک‌ها و نهادهای مالی بزرگ کشور.', 'royesh'); ?></p>
            </div>

            <div class="relative v-reveal v-reveal-fade-right v-delay-300">
                <div class="absolute top-1.5 -right-[41px] w-5 h-5 rounded-full bg-[#B1862D] border-4 border-white shadow-sm"></div>
                <span class="text-sm font-bold text-[#B1862D] block mb-1"><?php esc_html_e('۱۴۰۵', 'royesh'); ?></span>
                <h3 class="text-lg font-bold text-black mb-2"><?php esc_html_e('تحول دیجیتال و سبدهای دارایی اختصاصی', 'royesh'); ?></h3>
                <p class="text-gray-600 text-sm leading-relaxed font-light"><?php esc_html_e('راه‌اندازی مدل‌های پیشرفته مدیریت دارایی و نقدینگی بر بستر تکنولوژی‌های پیشرفته تحلیل داده.', 'royesh'); ?></p>
            </div>
        </div>
    </div>
</section>
