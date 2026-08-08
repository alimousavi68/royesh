<?php
/**
 * Blog / News Slider Section Template Part
 * 
 * @package Royesh
 * @version 1.2.0
 */

if (!defined('ABSPATH')) {
    exit; // Exit if accessed directly
}

$enable = get_theme_mod('royesh_blog_enable', true);
if (!$enable) return;

$title = get_theme_mod('royesh_blog_title', 'اخبار و اطلاعیه‌ها');
$count = get_theme_mod('royesh_blog_count', 6);

$bg_color    = get_theme_mod('royesh_blog_bg_color', '#004F40');
$title_color = get_theme_mod('royesh_blog_title_color', '#ffffff');
$card_bg     = get_theme_mod('royesh_blog_card_bg', '#ffffff');
$title_size  = get_theme_mod('royesh_blog_title_size', '32');

// کوئری مقالات منتشرشده
$recent_posts = new WP_Query([
    'post_type'      => 'post',
    'posts_per_page' => $count ? (int) $count : 6,
    'post_status'    => 'publish',
]);

$demo_fallbacks = [
    [
        'title'   => __('آینده تأمین مالی و نوآوری‌های بازار سرمایه', 'royesh'),
        'excerpt' => __('بررسی جامع تحول مدل‌های سنتی بانکی به سمت اکوسیستم‌های مالی هوشمند و چندلایه.', 'royesh'),
        'image'   => royesh_asset_img('post/post_101_v3_1785331719243.png'),
        'url'     => royesh_page_url('news'),
    ],
    [
        'title'   => __('مدیریت استراتژیک جریان نقدینگی و سرمایه در گردش', 'royesh'),
        'excerpt' => __('رویکردهای تخصصی برای صیانت از ارزش منابع نقدی و بهینه‌سازی زنجیره دریافت و پرداخت.', 'royesh'),
        'image'   => royesh_asset_img('post/post_102_v3_1785331729555.png'),
        'url'     => royesh_page_url('news'),
    ],
    [
        'title'   => __('الگوهای ارزش‌آفرینی در سبد دارایی‌های شرکتی', 'royesh'),
        'excerpt' => __('ساختاردهی و بازآرایی پرتفوی دارایی‌های مشهود و نامشهود با هدف ارتقای بازدهی پایدار.', 'royesh'),
        'image'   => royesh_asset_img('post/post_103_v3_1785331739544.png'),
        'url'     => royesh_page_url('news'),
    ],
];
?>

<style>
    #v-blog-top-bg {
        background-color: <?php echo esc_attr($bg_color); ?>;
    }
    #v-blog-title {
        color: <?php echo esc_attr($title_color); ?>;
        font-size: <?php echo esc_attr($title_size); ?>px;
    }
    .v-blog-card-content {
        background-color: <?php echo esc_attr($card_bg); ?>;
    }
</style>

<section id="v-blog" dir="rtl" class="w-full relative pt-16 pb-12 select-none">
    
    <div id="v-blog-top-bg" class="absolute top-0 left-0 w-full h-[500px] z-0 overflow-x-hidden">
        <div class="absolute inset-0 opacity-100 pointer-events-none select-none z-0">
            <img src="<?php echo royesh_asset_img('bg vector patt.svg'); ?>" alt="Pattern" class="w-full h-full object-cover" />
        </div>
        <div class="absolute top-0 left-1/2 -translate-x-1/2 w-[500px] h-[150px] bg-white/5 blur-[80px] rounded-full pointer-events-none"></div>
    </div>

    <div class="w-[60px] h-[60px] bg-[#FAF8F4] rounded-[20px] flex items-center justify-center shadow-[0_12px_30px_rgba(0,0,0,0.25)] border border-white/10 transition-transform duration-500 hover:rotate-6 absolute top-0 left-1/2 -translate-x-1/2 -translate-y-1/2 z-20">
        <img src="<?php echo royesh_asset_img('book-open-text.svg'); ?>" alt="<?php esc_attr_e('اخبار', 'royesh'); ?>" class="w-8 h-8 object-contain" />
    </div>

    <div class="relative z-10 text-center mt-3 mb-10 v-reveal v-reveal-fade-up">
        <h2 id="v-blog-title" class="font-bold text-center tracking-tight leading-tight font-sans">
            <?php echo esc_html($title); ?>
        </h2>
    </div>

    <div class="w-full overflow-x-hidden">
        <div class="max-w-[1440px] mx-auto px-4 md:px-16 relative">
            
            <button class="swiper-btn-prev absolute -right-2 md:-right-10 top-[40%] -translate-y-1/2 text-white/80 hover:text-white z-20 transition-all duration-300 focus:outline-none cursor-pointer hover:scale-110 active:scale-95">
                <svg class="w-10 h-10" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M9 5l7 7-7 7"></path>
                </svg>
            </button>
            <button class="swiper-btn-next absolute -left-2 md:-left-10 top-[40%] -translate-y-1/2 text-white/80 hover:text-white z-20 transition-all duration-300 focus:outline-none cursor-pointer hover:scale-110 active:scale-95">
                <svg class="w-10 h-10" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M15 19l-7-7 7-7"></path>
                </svg>
            </button>

            <div class="swiper blog-swiper overflow-hidden py-8 relative z-20 v-reveal v-reveal-fade-up v-delay-200" dir="rtl">
                <div class="swiper-wrapper">

                <?php 
                $rendered_count = 0;

                if ($recent_posts->have_posts()) :
                    while ($recent_posts->have_posts()) : $recent_posts->the_post();
                        $rendered_count++;
                ?>
                    <div class="swiper-slide">
                        <div class="v-blog-card-content blog-card relative w-full max-w-[310px] h-[430px] mx-auto select-none rounded-[29px] rounded-t-[99px]">
                            <?php if (has_post_thumbnail()) : ?>
                                <?php the_post_thumbnail('royesh-blog-card', ['class' => 'absolute top-0 left-0 w-full h-[375px] object-cover rounded-t-[99px] rounded-b-[42px]']); ?>
                            <?php else : ?>
                                <img src="<?php echo royesh_asset_img('post/post_101_v3_1785331719243.png'); ?>" alt="<?php the_title_attribute(); ?>" class="absolute top-0 left-0 w-full h-[375px] object-cover rounded-t-[99px] rounded-b-[42px]" />
                            <?php endif; ?>
                            <div class="absolute inset-0 bg-gradient-to-t from-black/60 to-transparent pointer-events-none rounded-t-[99px] rounded-b-[42px] h-[375px]"></div>
                            <div class="blog-content absolute bottom-0 left-1/2 -translate-x-1/2 w-[90%] z-10 p-5 rounded-[29px] flex flex-col justify-end min-h-[160px] text-white">
                                <h3 class="blog-title font-extrabold text-xl mb-1.5 font-sans drop-shadow-md"><?php the_title(); ?></h3>
                                <p class="blog-excerpt text-xs leading-relaxed mb-4 font-sans font-light drop-shadow-md"><?php echo esc_html(wp_trim_words(get_the_excerpt(), 14, '...')); ?></p>
                                <a href="<?php the_permalink(); ?>" class="blog-link hover:opacity-80 text-sm font-bold inline-flex items-center gap-2 transition-all font-sans mr-auto mt-auto">
                                    <span><?php esc_html_e('اطلاعات بیشتر', 'royesh'); ?></span>
                                    <svg class="w-4 h-4 transform rotate-180" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" d="M14 5l7 7m0 0l-7 7m7-7H3"></path></svg>
                                </a>
                            </div>
                        </div>
                    </div>
                <?php 
                    endwhile;
                    wp_reset_postdata();
                endif;

                // اگر تعداد مقالات موجود در دیتابیس کمتر از ۳ باشد، اسلایدهای تکمیلی را رندر می‌کنیم تا اسلایدر پر و بی‌نقص باشد
                if ($rendered_count < 3) :
                    for ($i = $rendered_count; $i < 3; $i++) :
                        $fb = $demo_fallbacks[$i] ?? $demo_fallbacks[0];
                ?>
                    <div class="swiper-slide">
                        <div class="v-blog-card-content blog-card relative w-full max-w-[310px] h-[430px] mx-auto select-none rounded-[29px] rounded-t-[99px]">
                            <img src="<?php echo esc_url($fb['image']); ?>" alt="<?php echo esc_attr($fb['title']); ?>" class="absolute top-0 left-0 w-full h-[375px] object-cover rounded-t-[99px] rounded-b-[42px]" />
                            <div class="absolute inset-0 bg-gradient-to-t from-black/60 to-transparent pointer-events-none rounded-t-[99px] rounded-b-[42px] h-[375px]"></div>
                            <div class="blog-content absolute bottom-0 left-1/2 -translate-x-1/2 w-[90%] z-10 p-5 rounded-[29px] flex flex-col justify-end min-h-[160px] text-white">
                                <h3 class="blog-title font-extrabold text-xl mb-1.5 font-sans drop-shadow-md"><?php echo esc_html($fb['title']); ?></h3>
                                <p class="blog-excerpt text-xs leading-relaxed mb-4 font-sans font-light drop-shadow-md"><?php echo esc_html($fb['excerpt']); ?></p>
                                <a href="<?php echo esc_url($fb['url']); ?>" class="blog-link hover:opacity-80 text-sm font-bold inline-flex items-center gap-2 transition-all font-sans mr-auto mt-auto">
                                    <span><?php esc_html_e('اطلاعات بیشتر', 'royesh'); ?></span>
                                    <svg class="w-4 h-4 transform rotate-180" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" d="M14 5l7 7m0 0l-7 7m7-7H3"></path></svg>
                                </a>
                            </div>
                        </div>
                    </div>
                <?php 
                    endfor;
                endif;
                ?>

                </div>
            </div>
            
            <div class="swiper-pagination !relative !bottom-auto mt-6 pt-4 pb-2 z-20"></div>
        </div>
    </div>
</section>
