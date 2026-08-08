<?php
/**
 * Value Creation Section Template Part
 * 
 * @package Royesh
 * @version 1.0.0
 */

if (!defined('ABSPATH')) {
    exit; // Exit if accessed directly
}

// Fetch Customizer Settings
$enable = get_theme_mod('royesh_value_enable', true);
if (!$enable) return;

$title_start  = get_theme_mod('royesh_value_title_start', 'ما چگونه');
$title_accent = get_theme_mod('royesh_value_title_accent', 'ارزش‌آفرینی');
$title_end    = get_theme_mod('royesh_value_title_end', 'می‌کنیم؟');
$desc         = get_theme_mod('royesh_value_desc', 'رویش ســــــــــرمایه با تمرکز بر حل نظام‌مند مسائل مالی، طراحی ساختارهای کارآمد و توسعه راهکارهای نــــــــوآورانه، به دنبال خلق ارزش پایدار برای ذینفعان و ارتقای کارایی اکوسیستم مالی است.');

$video_poster = get_theme_mod('royesh_value_video_poster', royesh_asset_img('value-creation-1.jpg'));
if (empty($video_poster) || strpos($video_poster, 'bg-r-s-c.jpg') !== false) {
    $video_poster = royesh_asset_img('value-creation-1.jpg');
}
$video_url = get_theme_mod('royesh_value_video_url', '');
if (strpos($video_url, 'v-4.mp4') !== false) {
    $video_url = '';
}
$has_video = !empty($video_url);

$bg_color       = get_theme_mod('royesh_value_bg_color', '#FBFBFA');
$title_color    = get_theme_mod('royesh_value_title_color', '#111111');
$accent_color   = get_theme_mod('royesh_value_accent_color', '#014235');
$desc_color     = get_theme_mod('royesh_value_desc_color', '#4b5563');
$card_bg        = get_theme_mod('royesh_value_card_bg', '#F8F9FA');
$card_hover_bg  = get_theme_mod('royesh_value_card_hover_bg', '#FAF8F4');
$icon_bg        = get_theme_mod('royesh_value_icon_bg', '#014235');

$title_size_dt  = get_theme_mod('royesh_value_title_size_desktop', '36');
$title_size_mb  = get_theme_mod('royesh_value_title_size_mobile', '30');
$desc_size      = get_theme_mod('royesh_value_desc_size', '15');

$c1_title = get_theme_mod('royesh_val_c1_title', 'راه حل محوری');
$c1_desc  = get_theme_mod('royesh_val_c1_desc', 'حل مسائل مالی با نگاه ساختاری');
$c2_title = get_theme_mod('royesh_val_c2_title', 'نهادسازی تخصصی');
$c2_desc  = get_theme_mod('royesh_val_c2_desc', 'توسعه ساختارهای مالی پایدار');
$c3_title = get_theme_mod('royesh_val_c3_title', 'نوآوری مالی');
$c3_desc  = get_theme_mod('royesh_val_c3_desc', 'طراحی مدل‌های نوین کسب‌وکار');
$c4_title = get_theme_mod('royesh_val_c4_title', 'مسئولیت‌پذیری حرفه‌ای');
$c4_desc  = get_theme_mod('royesh_val_c4_desc', 'تعهد به رازداری و انضباط حرفه‌ای');
?>

<style>
    #v-value-creation-section {
        background-color: <?php echo esc_attr($bg_color); ?>;
    }
    #v-val-headline {
        color: <?php echo esc_attr($title_color); ?>;
        font-size: <?php echo esc_attr($title_size_dt); ?>px;
    }
    #v-val-headline span {
        color: <?php echo esc_attr($icon_bg); ?>;
    }
    #v-val-headline span::after {
        background-color: <?php echo esc_attr($accent_color); ?>;
    }
    #v-val-description {
        color: <?php echo esc_attr($desc_color); ?>;
        font-size: <?php echo esc_attr($desc_size); ?>px;
    }
    
    .v-val-card {
        background-color: <?php echo esc_attr($card_bg); ?>;
    }
    .v-val-card:hover {
        background-color: <?php echo esc_attr($card_hover_bg); ?>;
    }
    .v-val-icon-box {
        background-color: <?php echo esc_attr($icon_bg); ?>;
        color: #fff;
    }
    .v-val-card:hover .v-val-icon-box {
        background-color: #fff;
        color: <?php echo esc_attr($icon_bg); ?>;
    }
    .v-val-card:hover h3 {
        color: <?php echo esc_attr($icon_bg); ?>;
    }

    @media (max-width: 640px) {
        #v-val-headline { font-size: <?php echo esc_attr($title_size_mb); ?>px; }
    }
</style>

<section id="v-value-creation-section" dir="rtl" class="w-full border-b border-[#DED6CA] overflow-hidden">
    <div class="max-w-[1440px] mx-auto py-24 sm:py-32 px-4 md:px-12">
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-12 items-center">
            
            <!-- Left Column (Text & Features Grid) -->
            <div class="w-full flex flex-col items-start text-right order-1 lg:order-last v-reveal v-reveal-fade-left">
                
                <!-- Headline -->
                <h2 id="v-val-headline" class="font-extrabold tracking-tight leading-tight">
                    <?php echo esc_html($title_start); ?> <span class="relative after:absolute after:bottom-[-4px] after:right-0 after:w-full after:h-[6px]"><?php echo esc_html($title_accent); ?></span> <?php echo esc_html($title_end); ?>
                </h2>
                
                <!-- Description -->
                <p id="v-val-description" class="mt-5 leading-relaxed text-base md:text-lg max-w-2xl font-normal">
                    <?php echo nl2br(esc_html($desc)); ?>
                </p>
                
                <!-- Features Grid (2x2) -->
                <div id="v-val-features-grid" class="grid grid-cols-2 gap-4 sm:gap-6 mt-10 w-full relative">
                    
                    <!-- Feature Card 1 -->
                    <div id="v-val-card-1" class="v-val-card group rounded-[24px] sm:rounded-[32px] p-4 sm:p-5 flex flex-col sm:flex-row items-center gap-3 sm:gap-4 transition-all duration-300 cursor-pointer border border-transparent hover:border-[#DAD1C0] hover:shadow-[0px_5px_11.5px_rgba(204,198,189,0.5)] v-reveal v-reveal-fade-up v-delay-100 text-center sm:text-right">
                        <div class="v-val-icon-box w-[48px] h-[48px] sm:w-[64px] sm:h-[64px] flex-shrink-0 rounded-xl sm:rounded-2xl flex items-center justify-center transition-all duration-300 group-hover:shadow-sm">
                            <svg class="w-[28px] h-[28px] sm:w-[38px] sm:h-[38px] transition-transform duration-300 group-hover:scale-110" viewBox="0 0 38 38" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path d="M15.2396 11.0833H26.9167V8.90625C26.9167 6.13542 25.5312 4.75 22.7604 4.75H8.90625C6.13542 4.75 4.75 6.13542 4.75 8.90625V22.7604C4.75 25.5312 6.13542 26.9167 8.90625 26.9167H11.0833V15.2396C11.0833 12.4687 12.4687 11.0833 15.2396 11.0833Z" fill="currentColor"/>
                                <path opacity="0.4" d="M29.0937 11.0833H26.9166H15.2395C12.4687 11.0833 11.0833 12.4688 11.0833 15.2396V26.9167V29.0938C11.0833 31.8646 12.4687 33.25 15.2395 33.25H29.0937C31.8645 33.25 33.2499 31.8646 33.2499 29.0938V15.2396C33.2499 12.4688 31.8645 11.0833 29.0937 11.0833Z" fill="currentColor"/>
                                <path d="M20.8478 25.9936C20.5327 25.9936 20.2302 25.8686 20.0086 25.6453L17.3692 23.0059C16.9053 22.542 16.9053 21.7899 17.3692 21.3259C17.8331 20.862 18.5852 20.862 19.0491 21.3259L20.8493 23.1246L25.2874 18.6865C25.7513 18.2226 26.5034 18.2226 26.9674 18.6865C27.4313 19.1505 27.4313 19.9025 26.9674 20.3664L21.6901 25.6437C21.4653 25.8685 21.1629 25.9936 20.8478 25.9936Z" fill="currentColor"/>
                            </svg>
                        </div>
                        <div class="flex-1 min-w-0">
                            <h3 class="font-bold text-gray-800 text-sm md:text-base tracking-wide transition-colors duration-300"><?php echo esc_html($c1_title); ?></h3>
                            <p class="text-xs text-gray-500 mt-1 font-normal leading-relaxed"><?php echo esc_html($c1_desc); ?></p>
                        </div>
                    </div>

                    <!-- Feature Card 2 -->
                    <div id="v-val-card-2" class="v-val-card group rounded-[24px] sm:rounded-[32px] p-4 sm:p-5 flex flex-col sm:flex-row items-center gap-3 sm:gap-4 transition-all duration-300 cursor-pointer border border-transparent hover:border-[#DAD1C0] hover:shadow-[0px_5px_11.5px_rgba(204,198,189,0.5)] v-reveal v-reveal-fade-up v-delay-200 text-center sm:text-right">
                        <div class="v-val-icon-box w-[48px] h-[48px] sm:w-[64px] sm:h-[64px] flex-shrink-0 rounded-xl sm:rounded-2xl flex items-center justify-center transition-all duration-300 group-hover:shadow-sm">
                            <svg class="w-[38px] h-[36px] sm:w-[54px] sm:h-[52px] transition-transform duration-300 group-hover:scale-110" viewBox="0 0 54 52" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path opacity="0.4" d="M41.25 40.4375H12.75C12.0945 40.4375 11.5625 39.9055 11.5625 39.25C11.5625 38.5945 12.0945 38.0625 12.75 38.0625H41.25C41.9055 38.0625 42.4375 38.5945 42.4375 39.25C42.4375 39.9055 41.9055 40.4375 41.25 40.4375Z" fill="currentColor"/>
                                <path opacity="0.4" d="M27.7918 34.5H26.2085C24.6252 34.5 23.8335 33.7083 23.8335 32.125V13.125C23.8335 11.5417 24.6252 10.75 26.2085 10.75H27.7918C29.3752 10.75 30.1668 11.5417 30.1668 13.125V32.125C30.1668 33.7083 29.3752 34.5 27.7918 34.5Z" fill="currentColor"/>
                                <path d="M38.8748 34.5H37.2915C35.7082 34.5 34.9165 33.7084 34.9165 32.125V19.4584C34.9165 17.875 35.7082 17.0834 37.2915 17.0834H38.8748C40.4582 17.0834 41.2498 17.875 41.2498 19.4584V32.125C41.2498 33.7084 40.4582 34.5 38.8748 34.5Z" fill="currentColor"/>
                                <path d="M16.7083 34.5H15.125C13.5417 34.5 12.75 33.7084 12.75 32.125V24.2084C12.75 22.625 13.5417 21.8334 15.125 21.8334H16.7083C18.2917 21.8334 19.0833 22.625 19.0833 24.2084V32.125C19.0833 33.7084 18.2917 34.5 16.7083 34.5Z" fill="currentColor"/>
                            </svg>
                        </div>
                        <div class="flex-1 min-w-0">
                            <h3 class="font-bold text-gray-800 text-sm md:text-base tracking-wide transition-colors duration-300"><?php echo esc_html($c2_title); ?></h3>
                            <p class="text-xs text-gray-500 mt-1 font-normal leading-relaxed"><?php echo esc_html($c2_desc); ?></p>
                        </div>
                    </div>

                    <!-- Feature Card 3 -->
                    <div id="v-val-card-3" class="v-val-card group rounded-[24px] sm:rounded-[32px] p-4 sm:p-5 flex flex-col sm:flex-row items-center gap-3 sm:gap-4 transition-all duration-300 cursor-pointer border border-transparent hover:border-[#DAD1C0] hover:shadow-[0px_5px_11.5px_rgba(204,198,189,0.5)] v-reveal v-reveal-fade-up v-delay-300 text-center sm:text-right">
                        <div class="v-val-icon-box w-[48px] h-[48px] sm:w-[64px] sm:h-[64px] flex-shrink-0 rounded-xl sm:rounded-2xl flex items-center justify-center transition-all duration-300 group-hover:shadow-sm">
                            <svg class="w-[38px] h-[36px] sm:w-[54px] sm:h-[52px] transition-transform duration-300 group-hover:scale-110" viewBox="0 0 54 52" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path opacity="0.4" d="M19.875 35.5158C19.875 36.6717 20.2233 37.7166 20.8725 38.6191C16.6292 38.3499 12.75 36.7983 12.75 33.9325V32.5392C14.4125 33.8375 16.8667 34.7083 19.875 34.9933V35.5158ZM19.9225 29.0717C16.8825 28.8025 14.4125 27.9317 12.75 26.6175V28.0109C12.75 30.655 16.0433 32.175 19.875 32.6183V29.5942C19.875 29.4359 19.8909 29.2774 19.9225 29.1191C19.9225 29.1033 19.9225 29.0875 19.9383 29.0717H19.9225ZM22.25 23.5933C18.1492 23.5933 14.8242 22.6433 12.75 21.0125V22.0892C12.75 24.9392 16.5658 26.4908 20.7775 26.76C21.8225 25.24 23.7067 24.0209 26.1133 23.2767C24.9258 23.4825 23.6275 23.5933 22.25 23.5933ZM28.1717 22.7858C29.28 22.5958 30.4675 22.485 31.7183 22.485C31.7341 22.3584 31.75 22.2317 31.75 22.0892V21.0125C30.8 21.7566 29.5967 22.3583 28.1717 22.7858Z" fill="currentColor"/>
                                <path d="M22.25 21.2183C27.4967 21.2183 31.75 19.0988 31.75 16.4842C31.75 13.8695 27.4967 11.75 22.25 11.75C17.0033 11.75 12.75 13.8695 12.75 16.4842C12.75 19.0988 17.0033 21.2183 22.25 21.2183Z" fill="currentColor"/>
                                <path opacity="0.4" d="M41.25 33.9642V35.5159C41.25 38.6667 36.5 40.25 31.75 40.25C27 40.25 22.25 38.6667 22.25 35.5159V33.9642C24.3875 35.6584 27.7758 36.7034 31.75 36.7034C35.7242 36.7034 39.1125 35.6584 41.25 33.9642Z" fill="currentColor"/>
                                <path d="M41.25 29.5943C41.25 32.2068 36.9908 34.3284 31.75 34.3284C26.5092 34.3284 22.25 32.2068 22.25 29.5943C22.25 26.9818 26.5092 24.8601 31.75 24.8601C36.9908 24.8601 41.25 26.9818 41.25 29.5943Z" fill="currentColor"/>
                            </svg>
                        </div>
                        <div class="flex-1 min-w-0">
                            <h3 class="font-bold text-gray-800 text-sm md:text-base tracking-wide transition-colors duration-300"><?php echo esc_html($c3_title); ?></h3>
                            <p class="text-xs text-gray-500 mt-1 font-normal leading-relaxed"><?php echo esc_html($c3_desc); ?></p>
                        </div>
                    </div>

                    <!-- Feature Card 4 -->
                    <div id="v-val-card-4" class="v-val-card group rounded-[24px] sm:rounded-[32px] p-4 sm:p-5 flex flex-col sm:flex-row items-center gap-3 sm:gap-4 transition-all duration-300 cursor-pointer border border-transparent hover:border-[#DAD1C0] hover:shadow-[0px_5px_11.5px_rgba(204,198,189,0.5)] v-reveal v-reveal-fade-up v-delay-400 text-center sm:text-right">
                        <div class="v-val-icon-box w-[48px] h-[48px] sm:w-[64px] sm:h-[64px] flex-shrink-0 rounded-xl sm:rounded-2xl flex items-center justify-center transition-all duration-300 group-hover:shadow-sm">
                            <svg class="w-[28px] h-[28px] sm:w-[38px] sm:h-[38px] transition-transform duration-300 group-hover:scale-110" viewBox="0 0 38 38" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path d="M17.4167 28.4998C13.0514 28.4998 9.5 24.9484 9.5 20.5831C9.5 16.9604 11.9447 13.811 15.4439 12.9212C16.2783 12.709 17.1522 13.2175 17.3676 14.0662C17.5845 14.9148 17.0699 15.7763 16.2228 15.9916C14.1296 16.5236 12.6667 18.4123 12.6667 20.5847C12.6667 23.2035 14.7978 25.3347 17.4167 25.3347C19.5874 25.3347 21.4763 23.8715 22.0099 21.7768C22.253 20.9281 23.0882 20.4153 23.9353 20.6322C24.7823 20.8475 25.2937 21.7106 25.0784 22.5576C24.187 26.0568 21.0377 28.4998 17.4167 28.4998Z" fill="currentColor"/>
                                <path opacity="0.4" d="M17.4165 34.8334C9.55842 34.8334 3.1665 28.4399 3.1665 20.5834C3.1665 12.7269 9.55842 6.33337 17.4165 6.33337C17.7601 6.33337 18.1053 6.3522 18.4457 6.3902C19.315 6.48678 19.9403 7.27054 19.8453 8.1382C19.7472 9.00745 18.9555 9.64404 18.0973 9.53638C17.8693 9.51104 17.6429 9.50004 17.4165 9.50004C11.3064 9.50004 6.33317 14.4717 6.33317 20.5834C6.33317 26.695 11.3064 31.6667 17.4165 31.6667C23.5266 31.6667 28.4998 26.695 28.4998 20.5834C28.4998 20.357 28.4872 20.1321 28.4634 19.9073C28.3652 19.038 28.9875 18.2544 29.8567 18.1546C30.7529 18.047 31.5114 18.6801 31.6079 19.5478C31.6475 19.893 31.6665 20.2382 31.6665 20.5818C31.6665 28.4399 25.2746 34.8334 17.4165 34.8334Z" fill="currentColor"/>
                                <path d="M33.9817 10.7808C33.8597 10.4848 33.57 10.2915 33.2502 10.2915H27.7085V4.74979C27.7085 4.42996 27.5153 4.14034 27.2193 4.01843C26.9248 3.89493 26.5844 3.96287 26.3564 4.18929L22.3015 8.24426C21.7125 8.83326 21.3737 9.65036 21.3737 10.4832V14.3859L16.2959 19.4637C15.6768 20.0827 15.6768 21.0835 16.2959 21.7026C16.6046 22.0113 17.01 22.1665 17.4153 22.1665C17.8207 22.1665 18.2259 22.0113 18.5347 21.7026L23.6125 16.6248H27.5154C28.3482 16.6248 29.1652 16.2876 29.7542 15.6971L33.8092 11.6421C34.0356 11.4157 34.1036 11.0769 33.9817 10.7808Z" fill="currentColor"/>
                            </svg>
                        </div>
                        <div class="flex-1 min-w-0">
                            <h3 class="font-bold text-gray-800 text-sm md:text-base tracking-wide transition-colors duration-300"><?php echo esc_html($c4_title); ?></h3>
                            <p class="text-xs text-gray-500 mt-1 font-normal leading-relaxed"><?php echo esc_html($c4_desc); ?></p>
                        </div>
                    </div>

                    <!-- Mobile Grid Dividers -->
                    <div class="absolute inset-0 pointer-events-none md:hidden flex items-center justify-center">
                        <div class="absolute left-0 right-0 h-[1px] border-t border-dashed border-[#DAD1C0]"></div>
                        <div class="absolute top-0 bottom-0 w-[1px] border-l border-dashed border-[#DAD1C0]"></div>
                        <div class="absolute w-5 h-5 flex items-center justify-center bg-transparent">
                            <svg xmlns="http://www.w3.org/2000/svg" width="10" height="10" viewBox="0 0 24 24" fill="none" stroke="<?php echo esc_attr($icon_bg); ?>" stroke-width="3" stroke-linecap="round" stroke-linejoin="round" class="w-3 h-3">
                                <line x1="12" y1="5" x2="12" y2="19"></line>
                                <line x1="5" y1="12" x2="19" y2="12"></line>
                            </svg>
                        </div>
                    </div>

                </div>

            </div>

            <!-- Right Column (Image Collage) -->
            <div id="v-val-collage-col" class="w-full flex items-center justify-center py-6 overflow-visible order-2 lg:order-first v-reveal v-reveal-scale-up">
                <div class="relative w-[465px] h-[435px] shrink-0 scale-[0.65] xs:scale-[0.8] sm:scale-[0.95] md:scale-100 origin-center transition-all duration-300 my-[-50px] sm:my-0">
                    
                    <div class="absolute inset-x-0 bottom-0 top-1/4 rounded-full bg-radial from-[#B58A33]/15 to-transparent blur-[80px] pointer-events-none"></div>

                    <img 
                        src="<?php echo esc_url(get_theme_mod('royesh_value_img_1', royesh_asset_img('value-creation-1.jpg'))); ?>" 
                        alt="<?php esc_attr_e('رشد زیست‌محیطی و سرمایه', 'royesh'); ?>" 
                        class="absolute top-0 left-0 w-[279px] h-[401px] object-cover rounded-t-[140px] rounded-b-none shadow-2xl border border-white/40 z-0" 
                    />

                    <img 
                        src="<?php echo esc_url(get_theme_mod('royesh_value_img_2', royesh_asset_img('value-creation-2.jpg'))); ?>" 
                        alt="<?php esc_attr_e('ساختمان‌های تجاری تراز اول', 'royesh'); ?>" 
                        class="absolute top-[33px] left-[294px] w-[171px] h-[194px] object-cover rounded-[25px] rounded-bl-none shadow-lg border border-[#DED6CA]/15 z-10" 
                    />

                    <div id="v-val-video-container" class="absolute top-[238px] left-[194px] w-[271px] h-[197px] rounded-[24px] border-4 border-white shadow-2xl overflow-hidden group cursor-pointer z-20" <?php if ($has_video): ?>onclick="document.getElementById('royesh-video-modal').style.display='flex'; document.getElementById('royesh-modal-video').play();"<?php endif; ?>>
                        <img 
                            src="<?php echo esc_url($video_poster); ?>" 
                            alt="<?php esc_attr_e('ویدیو ارزش آفرینی', 'royesh'); ?>" 
                            class="w-full h-full object-cover transition-transform duration-700 group-hover:scale-105" 
                        />
                        <div class="v-val-play-overlay absolute inset-0 bg-[#014235]/15 group-hover:bg-[#014235]/30 transition-all duration-300 flex items-center justify-center">
                            <div class="w-16 h-16 rounded-full border-2 border-white bg-white/20 backdrop-blur-md flex items-center justify-center transition-all duration-300 group-hover:scale-110 shadow-lg">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="currentColor" class="w-6 h-6 text-white transform -translate-x-[1px]">
                                    <polygon points="5 3 19 12 5 21 5 3"></polygon>
                                </svg>
                            </div>
                        </div>
                    </div>

                </div>
            </div>

        </div>
    </div>

    <?php if ($has_video): ?>
    <!-- Fullscreen Video Modal -->
    <div id="royesh-video-modal" class="fixed inset-0 z-[9999] bg-black/90 hidden items-center justify-center p-4 md:p-12 transition-opacity">
        <button onclick="document.getElementById('royesh-video-modal').style.display='none'; document.getElementById('royesh-modal-video').pause();" class="absolute top-6 right-6 text-white hover:text-gray-300 z-10 p-2">
            <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                <line x1="18" y1="6" x2="6" y2="18"></line>
                <line x1="6" y1="6" x2="18" y2="18"></line>
            </svg>
        </button>
        <div class="w-full max-w-5xl aspect-video rounded-2xl overflow-hidden shadow-2xl relative bg-black">
            <video id="royesh-modal-video" src="<?php echo esc_url($video_url); ?>" class="w-full h-full" controls playsinline></video>
        </div>
    </div>
    <?php endif; ?>
</section>
