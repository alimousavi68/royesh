<?php
/**
 * Brand Philosophy Section Template Part
 * 
 * @package Royesh
 * @version 1.0.0
 */

if (!defined('ABSPATH')) {
    exit; // Exit if accessed directly
}

$enable = get_theme_mod('royesh_philosophy_enable', true);
if (!$enable) return;

$badge = get_theme_mod('royesh_philosophy_badge', 'فلسفه برند');
$desc  = get_theme_mod('royesh_philosophy_desc', 'رویکرد بنیادین ما در موسسه رویش بر پایه هم‌افزایی دانش تخصصی، نوآوری مستمر و ایجاد ارزش پایدار استوار است. ما بر این باوریم که تحول اقتصادی و رشد کسب‌وکارها تنها از طریق هدایت هوشمندانه سرمایه حاصل می‌شود.');

$bg_color       = get_theme_mod('royesh_phil_bg_color', '#ffffff');
$title_color    = get_theme_mod('royesh_phil_title_color', '#080206');
$desc_color     = get_theme_mod('royesh_phil_desc_color', '#333333');
$card_bg        = get_theme_mod('royesh_phil_card_bg', '#FAF8F4');
$card_hover     = get_theme_mod('royesh_phil_card_hover', '#B1862D');
$icon_bg        = get_theme_mod('royesh_phil_icon_bg', '#004F40');
$title_size     = get_theme_mod('royesh_phil_title_size', '32');
$desc_size      = get_theme_mod('royesh_phil_desc_size', '15');

$img_1 = get_theme_mod('royesh_phil_img_1', royesh_asset_img('brand-big-1.png'));
$img_2 = get_theme_mod('royesh_phil_img_2', royesh_asset_img('brand-small-2.png'));
$c1_title = get_theme_mod('royesh_phil_c1_title', 'نگاه مسئله‌محور');
$c1_desc  = get_theme_mod('royesh_phil_c1_desc', 'تمرکز بر شناسایی مسائل بنیادین مالی و طراحی راهکارهای ساختاری.');
$c2_title = get_theme_mod('royesh_phil_c2_title', 'همراستاسازی منافع');
$c2_desc  = get_theme_mod('royesh_phil_c2_desc', 'خلق راهکارهایی پایدار با درنظرگرفتن منافع همه ذینفعان.');
$c3_title = get_theme_mod('royesh_phil_c3_title', 'آینده‌نگری مالی');
$c3_desc  = get_theme_mod('royesh_phil_c3_desc', 'توسعه مدل‌های نوین برای پاسخ به نیازهای آینده صنعت مالی.');
?>

<style>
    #v-brand-philosophy {
        background-color: <?php echo esc_attr($bg_color); ?>;
    }
    #v-brand-philosophy h2 {
        color: <?php echo esc_attr($title_color); ?>;
        font-size: <?php echo esc_attr($title_size); ?>px;
    }
    #v-brand-philosophy .v-phil-desc {
        color: <?php echo esc_attr($desc_color); ?>;
        font-size: <?php echo esc_attr($desc_size); ?>px;
    }
    .v-phil-card {
        background-color: <?php echo esc_attr($card_bg); ?>;
        border-color: <?php echo esc_attr($card_bg); ?>;
    }
    .v-phil-card h3 { color: <?php echo esc_attr($desc_color); ?>; }
    .v-phil-card:hover {
        background-color: <?php echo esc_attr($card_hover); ?>;
        border-color: <?php echo esc_attr($card_hover); ?>;
    }
    .v-phil-icon {
        background-color: <?php echo esc_attr($icon_bg); ?>;
        color: #fff;
    }
    .v-phil-card:hover .v-phil-icon {
        background-color: <?php echo esc_attr($card_bg); ?>;
        color: <?php echo esc_attr($card_hover); ?>;
    }
</style>

<section id="v-brand-philosophy" dir="rtl" class="w-full select-none">
    <div class="max-w-[1150px] mx-auto pt-16 pb-28 px-6 md:px-12 grid grid-cols-1 lg:grid-cols-2 gap-12 lg:gap-16 items-center lg:min-h-[488px] overflow-visible">
        
        <!-- STACK RIGHT -->
        <div class="flex flex-col text-right h-full justify-start">
            <div class="flex items-center gap-4">
                <div class="w-[55px] h-[55px] bg-[#FAF8F4] border border-[#B1862D]/10 rounded-[17px] flex items-center justify-center text-[#B1862D] shadow-sm flex-shrink-0">
                    <svg class="w-7 h-7" viewBox="0 0 41 41" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M32.2805 12.7064L31.7353 12.1632C31.6294 12.0556 31.5681 11.9121 31.5681 11.7601V10.9947C31.5681 8.24945 29.3335 6.01489 26.5882 6.01489H25.8229C25.6726 6.01489 25.5255 5.95331 25.4196 5.8491L24.8766 5.30419C22.9376 3.36353 19.7788 3.36011 17.833 5.30419L17.29 5.84743C17.1841 5.95335 17.037 6.01489 16.8867 6.01489H16.1214C13.3761 6.01489 11.1415 8.24945 11.1415 10.9947V11.7601C11.1415 11.9121 11.0819 12.0556 10.9742 12.1615L10.4291 12.7081C8.48847 14.6488 8.48847 17.8092 10.4291 19.7516L10.9742 20.2949C11.0802 20.4025 11.1415 20.5459 11.1415 20.698V21.4633C11.1415 23.556 12.4415 25.343 14.2729 26.0793L11.5807 35.5228C11.4474 35.9926 11.5926 36.4984 11.9565 36.8264C12.3169 37.1527 12.8345 37.2467 13.2907 37.0639L18.0195 35.1694C20.172 34.3118 22.5394 34.3118 24.6885 35.1694L29.4206 37.0656C29.576 37.1271 29.7384 37.1578 29.8973 37.1578C30.2099 37.1578 30.5156 37.045 30.7548 36.8281C31.1187 36.5001 31.2638 35.9962 31.1306 35.5228L28.4384 26.0809C30.2697 25.3446 31.5698 23.5577 31.5698 21.465V20.6996C31.5698 20.5476 31.6294 20.4041 31.737 20.2982L32.2821 19.7533C32.2821 19.7533 32.2821 19.7533 32.2821 19.7516C34.2211 17.8092 34.2211 14.6488 32.2805 12.7064ZM25.6386 32.7879C22.8796 31.6877 19.8369 31.686 17.066 32.7879L14.7596 33.7121L16.832 26.4431H16.8833C17.0337 26.4431 17.1803 26.5047 17.2862 26.6089L17.8297 27.1538C18.8 28.1242 20.0745 28.6111 21.3523 28.6111C22.6267 28.6111 23.9029 28.1259 24.8749 27.1538L25.4179 26.6106C25.5238 26.5047 25.6709 26.4431 25.8212 26.4431H25.8725L27.9446 33.7121L25.6386 32.7879ZM30.4695 17.939L29.9248 18.4839C29.332 19.075 29.0073 19.8626 29.0073 20.698V21.4633C29.0073 22.7958 27.9224 23.8806 26.5899 23.8806H25.8246C24.9994 23.8806 24.1916 24.2154 23.6091 24.7997L23.0656 25.3429C22.1517 26.2552 20.5596 26.2552 19.6456 25.3429L19.1022 24.798C18.5196 24.2155 17.7135 23.8806 16.8867 23.8806H16.1214C14.7889 23.8806 13.704 22.7958 13.704 21.4633V20.698C13.704 19.8609 13.3796 19.0751 12.7868 18.4823L12.2417 17.939C11.3004 16.996 11.3004 15.4603 12.2417 14.519L12.7868 13.9741C13.3796 13.383 13.704 12.5955 13.704 11.7601V10.9947C13.704 9.66225 14.7889 8.57739 16.1214 8.57739H16.8867C17.7118 8.57739 18.5196 8.24262 19.1022 7.65837L19.6456 7.11513C20.5596 6.20288 22.1517 6.20288 23.0656 7.11513L23.6091 7.66003C24.1916 8.24258 24.9977 8.57739 25.8246 8.57739H26.5899C27.9224 8.57739 29.0073 9.66225 29.0073 10.9947V11.7601C29.0073 12.5972 29.332 13.383 29.9248 13.9758L30.4695 14.519C31.4108 15.462 31.4108 16.996 30.4695 17.939ZM25.6761 13.0447C26.1766 13.5452 26.1766 14.3567 25.6761 14.8573L21.12 19.4134C20.8791 19.6543 20.5545 19.7892 20.2145 19.7892C19.8746 19.7892 19.5482 19.6543 19.309 19.4134L17.0318 17.1362C16.5313 16.6356 16.5313 15.8241 17.0318 15.3236C17.5341 14.8213 18.3456 14.8247 18.8444 15.3236L20.2162 16.6953L23.8668 13.0447C24.3657 12.5441 25.1755 12.5441 25.6761 13.0447Z" fill="#B1862D"/>
                    </svg>
                </div>
                <h2 class="font-extrabold leading-none">
                    <?php echo esc_html($badge); ?>
                </h2>
            </div>

            <p class="v-phil-desc text-[16px] font-normal leading-[26px] my-5 text-justify">
                <?php echo nl2br(esc_html($desc)); ?>
            </p>

            <div class="flex flex-col gap-3">
                <div class="v-phil-card group rounded-[32px] p-4 flex items-start gap-4 cursor-pointer transition-all duration-300 hover:shadow-lg v-reveal v-reveal-fade-up v-delay-100 border">
                    <div class="v-phil-icon w-[50px] h-[50px] p-[6px] rounded-[14px] flex-shrink-0 flex items-center justify-center transition-all duration-300 mt-0.5">
                        <svg class="w-[38px] h-[38px]" viewBox="0 0 38 38" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M15.2396 11.0833H26.9167V8.90625C26.9167 6.13542 25.5312 4.75 22.7604 4.75H8.90625C6.13542 4.75 4.75 6.13542 4.75 8.90625V22.7604C4.75 25.5312 6.13542 26.9167 8.90625 26.9167H11.0833V15.2396C11.0833 12.4687 12.4687 11.0833 15.2396 11.0833Z" fill="currentColor"/>
                            <path opacity="0.4" d="M29.0937 11.0833H26.9166H15.2395C12.4687 11.0833 11.0833 12.4688 11.0833 15.2396V26.9167V29.0938C11.0833 31.8646 12.4687 33.25 15.2395 33.25H29.0937C31.8645 33.25 33.2499 31.8646 33.2499 29.0938V15.2396C33.2499 12.4688 31.8645 11.0833 29.0937 11.0833Z" fill="currentColor"/>
                            <path d="M20.8478 25.9936C20.5327 25.9936 20.2302 25.8686 20.0086 25.6453L17.3692 23.0059C16.9053 22.542 16.9053 21.7899 17.3692 21.3259C17.8331 20.862 18.5852 20.862 19.0491 21.3259L20.8493 23.1246L25.2874 18.6865C25.7513 18.2226 26.5034 18.2226 26.9674 18.6865C27.4313 19.1505 27.4313 19.9025 26.9674 20.3664L21.6901 25.6437C21.4653 25.8685 21.1629 25.9936 20.8478 25.9936Z" fill="currentColor"/>
                        </svg>
                    </div>
                    <div class="flex flex-col text-right">
                        <h3 class="text-xl font-extrabold group-hover:text-white transition-colors duration-300">
                            <?php echo esc_html($c1_title); ?>
                        </h3>
                        <p class="text-[14px] font-light text-[#666666] group-hover:text-white/90 transition-colors duration-300 mt-1">
                            <?php echo esc_html($c1_desc); ?>
                        </p>
                    </div>
                </div>

                <div class="v-phil-card group rounded-[32px] p-4 flex items-start gap-4 cursor-pointer transition-all duration-300 hover:shadow-lg v-reveal v-reveal-fade-up v-delay-200 border">
                    <div class="v-phil-icon w-[50px] h-[50px] p-[6px] rounded-[14px] flex-shrink-0 flex items-center justify-center transition-all duration-300 mt-0.5">
                        <svg class="w-[38px] h-[38px]" viewBox="0 0 54 52" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path opacity="0.4" d="M19.875 35.5158C19.875 36.6717 20.2233 37.7166 20.8725 38.6191C16.6292 38.3499 12.75 36.7983 12.75 33.9325V32.5392C14.4125 33.8375 16.8667 34.7083 19.875 34.9933V35.5158ZM19.9225 29.0717C16.8825 28.8025 14.4125 27.9317 12.75 26.6175V28.0109C12.75 30.655 16.0433 32.175 19.875 32.6183V29.5942C19.875 29.4359 19.8909 29.2774 19.9225 29.1191C19.9225 29.1033 19.9225 29.0875 19.9383 29.0717H19.9225ZM22.25 23.5933C18.1492 23.5933 14.8242 22.6433 12.75 21.0125V22.0892C12.75 24.9392 16.5658 26.4908 20.7775 26.76C21.8225 25.24 23.7067 24.0209 26.1133 23.2767C24.9258 23.4825 23.6275 23.5933 22.25 23.5933ZM28.1717 22.7858C29.28 22.5958 30.4675 22.485 31.7183 22.485C31.7341 22.3584 31.75 22.2317 31.75 22.0892V21.0125C30.8 21.7566 29.5967 22.3583 28.1717 22.7858Z" fill="currentColor"/>
                            <path d="M22.25 21.2183C27.4967 21.2183 31.75 19.0988 31.75 16.4842C31.75 13.8695 27.4967 11.75 22.25 11.75C17.0033 11.75 12.75 13.8695 12.75 16.4842C12.75 19.0988 17.0033 21.2183 22.25 21.2183Z" fill="currentColor"/>
                            <path opacity="0.4" d="M41.25 33.9642V35.5159C41.25 38.6667 36.5 40.25 31.75 40.25C27 40.25 22.25 38.6667 22.25 35.5159V33.9642C24.3875 35.6584 27.7758 36.7034 31.75 36.7034C35.7242 36.7034 39.1125 35.6584 41.25 33.9642Z" fill="currentColor"/>
                            <path d="M41.25 29.5943C41.25 32.2068 36.9908 34.3284 31.75 34.3284C26.5092 34.3284 22.25 32.2068 22.25 29.5943C22.25 26.9818 26.5092 24.8601 31.75 24.8601C36.9908 24.8601 41.25 26.9818 41.25 29.5943Z" fill="currentColor"/>
                        </svg>
                    </div>
                    <div class="flex flex-col text-right">
                        <h3 class="text-xl font-extrabold group-hover:text-white transition-colors duration-300">
                            <?php echo esc_html($c2_title); ?>
                        </h3>
                        <p class="text-[14px] font-light text-[#666666] group-hover:text-white/90 transition-colors duration-300 mt-1">
                            <?php echo esc_html($c2_desc); ?>
                        </p>
                    </div>
                </div>

                <div class="v-phil-card group rounded-[32px] p-4 flex items-start gap-4 cursor-pointer transition-all duration-300 hover:shadow-lg v-reveal v-reveal-fade-up v-delay-300 border">
                    <div class="v-phil-icon w-[50px] h-[50px] p-[6px] rounded-[14px] flex-shrink-0 flex items-center justify-center transition-all duration-300 mt-0.5">
                        <svg class="w-[38px] h-[38px]" viewBox="0 0 54 52" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path opacity="0.4" d="M41.25 40.4375H12.75C12.0945 40.4375 11.5625 39.9055 11.5625 39.25C11.5625 38.5945 12.0945 38.0625 12.75 38.0625H41.25C41.9055 38.0625 42.4375 38.5945 42.4375 39.25C42.4375 39.9055 41.9055 40.4375 41.25 40.4375Z" fill="currentColor"/>
                            <path opacity="0.4" d="M27.7918 34.5H26.2085C24.6252 34.5 23.8335 33.7083 23.8335 32.125V13.125C23.8335 11.5417 24.6252 10.75 26.2085 10.75H27.7918C29.3752 10.75 30.1668 11.5417 30.1668 13.125V32.125C30.1668 33.7083 29.3752 34.5 27.7918 34.5Z" fill="currentColor"/>
                            <path d="M38.8748 34.5H37.2915C35.7082 34.5 34.9165 33.7084 34.9165 32.125V19.4584C34.9165 17.875 35.7082 17.0834 37.2915 17.0834H38.8748C40.4582 17.0834 41.2498 17.875 41.2498 19.4584V32.125C41.2498 33.7084 40.4582 34.5 38.8748 34.5Z" fill="currentColor"/>
                            <path d="M16.7083 34.5H15.125C13.5417 34.5 12.75 33.7084 12.75 32.125V24.2084C12.75 22.625 13.5417 21.8334 15.125 21.8334H16.7083C18.2917 21.8334 19.0833 22.625 19.0833 24.2084V32.125C19.0833 33.7084 18.2917 34.5 16.7083 34.5Z" fill="currentColor"/>
                        </svg>
                    </div>
                    <div class="flex flex-col text-right">
                        <h3 class="text-xl font-extrabold group-hover:text-white transition-colors duration-300">
                            <?php echo esc_html($c3_title); ?>
                        </h3>
                        <p class="text-[14px] font-light text-[#666666] group-hover:text-white/90 transition-colors duration-300 mt-1">
                            <?php echo esc_html($c3_desc); ?>
                        </p>
                    </div>
                </div>
            </div>
        </div>

        <!-- STACK LEFT -->
        <div id="v-philosophy-collage" class="relative w-full h-[380px] sm:h-[440px] lg:h-[488px] flex items-center justify-center lg:block select-none flex-shrink-0">
            <img 
                src="<?php echo esc_url($img_1); ?>" 
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
                        src="<?php echo esc_url($img_2); ?>" 
                        alt="<?php esc_attr_e('فلسفه برند رویش', 'royesh'); ?>" 
                        class="w-full h-full rounded-tl-[38px] rounded-tr-none rounded-b-none object-cover transition-all duration-500 shadow-md"
                    />
                </div>

                <!-- Floating Green Banner -->
                <div class="w-[240px] sm:w-[280px] lg:w-[304px] h-[80px] sm:h-[95px] lg:h-[106px] bg-[#004F40] flex flex-col justify-center px-4 lg:px-6 rounded-tl-none rounded-tr-full rounded-br-full rounded-bl-full shadow-xl text-left items-start v-reveal v-reveal-fade-up v-delay-400">
                    <!-- Top Row -->
                    <span class="text-[#E8D2AF] text-[18px] sm:text-[20px] lg:text-[22px] font-extrabold tracking-tight w-full text-left font-heading">
                        پشتیبانی <span class="text-white">سریع و مستمر</span>
                    </span>
                    
                    <!-- Bottom Row -->
                    <div class="flex items-center gap-2 mt-1 w-full overflow-hidden flex-row-reverse">
                        <div class="flex-grow border-b border-dashed border-[#C9C9C9] opacity-70"></div>
                        <span class="text-white text-[14px] sm:text-[16px] lg:text-[18px] font-normal flex-shrink-0 text-left font-sans">
                            راهکارهای اختصاصی
                        </span>
                    </div>
                </div>

            </div>
            
            <div class="absolute bottom-2 lg:bottom-12 right-12 lg:right-auto lg:left-[50px] w-24 h-24 lg:w-32 lg:h-32 border border-dashed border-[#B1862D]/40 rounded-full animate-[spin_10s_linear_infinite] z-0 opacity-50 pointer-events-none"></div>
        </div>

    </div>
</section>
