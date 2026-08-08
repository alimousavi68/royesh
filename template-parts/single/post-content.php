<?php
/**
 * Single Post Content Template Part
 * 
 * @package Royesh
 * @version 1.0.0
 */

if (!defined('ABSPATH')) {
    exit; // Exit if accessed directly
}

$categories = get_the_category();
$cat_name   = !empty($categories) ? esc_html($categories[0]->name) : esc_html__('اخبار', 'royesh');

// Related posts query
$related_posts = new WP_Query([
    'post_type'      => 'post',
    'posts_per_page' => 3,
    'post__not_in'   => [get_the_ID()],
    'post_status'    => 'publish',
]);
?>

<!-- HERO / BANNER SECTION -->
<section class="relative w-full bg-[#004F40] pt-16 pb-28 px-4 md:px-12 overflow-hidden border-b border-[#2E7063] z-0">
    <div class="absolute inset-0 opacity-100 pointer-events-none select-none z-0">
        <img src="<?php echo royesh_asset_img('bg vector patt.svg'); ?>" alt="Pattern" class="w-full h-full object-cover" />
    </div>
    <div class="absolute top-[10%] left-[10%] w-[350px] h-[350px] rounded-full bg-[#2E7063]/25 blur-[100px] pointer-events-none z-0"></div>
    <div class="absolute bottom-[5%] right-[5%] w-[250px] h-[250px] rounded-full bg-[#B1862D]/10 blur-[80px] pointer-events-none z-0"></div>

    <div class="max-w-[1150px] mx-auto relative z-10 text-center flex flex-col items-center">
        
        <!-- Breadcrumbs -->
        <nav class="flex items-center justify-center gap-2 text-xs md:text-sm text-white/60 mb-6 font-sans">
            <a href="<?php echo esc_url(home_url('/')); ?>" class="hover:text-white transition-colors"><?php esc_html_e('خانه', 'royesh'); ?></a>
            <span>&gt;</span>
            <a href="<?php echo esc_url(royesh_page_url('news')); ?>" class="hover:text-white transition-colors"><?php esc_html_e('اخبار و مقالات', 'royesh'); ?></a>
            <span>&gt;</span>
            <span class="text-white truncate max-w-[200px] md:max-w-none"><?php the_title(); ?></span>
        </nav>

        <!-- Category Badge -->
        <span class="inline-block bg-[#FAF8F4]/10 text-[#E8D2AF] text-xs font-bold px-4 py-1.5 rounded-full border border-[#FAF8F4]/20 mb-4 tracking-wider">
            <?php echo $cat_name; ?>
        </span>

        <!-- Main Heading -->
        <h1 class="text-2xl md:text-4xl lg:text-5xl font-black text-white leading-tight mb-6 max-w-4xl text-center">
            <?php the_title(); ?>
        </h1>

        <!-- Meta Data Row -->
        <div class="flex flex-wrap items-center justify-center gap-y-3 gap-x-6 text-xs md:text-sm text-white/70 font-light border-t border-white/10 pt-4 max-w-2xl w-full">
            <div class="flex items-center gap-1.5">
                <svg class="w-4 h-4 text-[#B1862D]" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                </svg>
                <span><?php esc_html_e('نویسنده:', 'royesh'); ?> <strong><?php the_author(); ?></strong></span>
            </div>
            <div class="flex items-center gap-1.5">
                <svg class="w-4 h-4 text-[#B1862D]" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                </svg>
                <span><?php echo esc_html(get_the_date('j F Y')); ?></span>
            </div>
            <div class="flex items-center gap-1.5">
                <svg class="w-4 h-4 text-[#B1862D]" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 6v6h4.5m4.5 0a9 9 0 11-18 0 9 9 0 0118 0z" />
                </svg>
                <span><?php esc_html_e('زمان مطالعه:', 'royesh'); ?> <?php echo royesh_reading_time(); ?></span>
            </div>
        </div>

    </div>
</section>

<!-- POST CONTENT BODY FRAME -->
<main class="w-full relative px-4 md:px-12 z-10 flex-grow">
    <div class="max-w-[950px] mx-auto w-full -mt-16 mb-20 relative">
        
        <article class="bg-[#FAF8F4] border border-[#EBE5D7] rounded-[36px] shadow-xl overflow-hidden p-6 md:p-12 v-reveal v-reveal-fade-up">
            
            <?php if (has_post_thumbnail()) : ?>
                <div class="relative w-full h-[250px] md:h-[480px] overflow-hidden rounded-t-[72px] rounded-b-[36px] shadow-sm mb-10 border border-[#EBE5D7]/40">
                    <?php the_post_thumbnail('full', ['class' => 'w-full h-full object-cover transition-transform duration-700 hover:scale-102']); ?>
                    <div class="absolute inset-0 bg-gradient-to-t from-black/20 via-transparent to-transparent"></div>
                </div>
            <?php endif; ?>

            <?php if (has_excerpt()) : ?>
                <div class="bg-[#FAF8F4] border-r-4 border-[#B1862D] p-5 mb-8 rounded-[16px] shadow-sm text-right">
                    <h3 class="font-extrabold text-lg text-[#014235] mb-2"><?php esc_html_e('خلاصه مقاله:', 'royesh'); ?></h3>
                    <p class="text-sm text-gray-700 leading-relaxed font-light mb-0">
                        <?php echo esc_html(get_the_excerpt()); ?>
                    </p>
                </div>
            <?php endif; ?>

            <!-- Main Content Area -->
            <div class="post-body-content text-gray-800 font-sans text-right space-y-4">
                <?php the_content(); ?>
            </div>

            <!-- Share and Back Row -->
            <div class="flex flex-col sm:flex-row items-center justify-between gap-6 border-t border-[#EBE5D7] mt-12 pt-8">
                
                <div class="flex items-center gap-3">
                    <span class="text-xs text-gray-500 font-bold"><?php esc_html_e('اشتراک‌گذاری:', 'royesh'); ?></span>
                    <div class="flex items-center gap-2">
                        <a href="https://t.me/share/url?url=<?php echo urlencode(get_permalink()); ?>&text=<?php echo urlencode(get_the_title()); ?>" target="_blank" class="w-8 h-8 rounded-full bg-white border border-[#EBE5D7] flex items-center justify-center text-gray-600 hover:bg-[#E8E2D2] hover:text-[#014235] transition-all hover:scale-110" title="تلگرام">
                            <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 24 24"><path d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm4.64 6.8c-.15 1.58-.8 5.42-1.13 7.19-.14.75-.42 1-.68 1.03-.58.05-1.02-.38-1.58-.75-.88-.58-1.38-.94-2.23-1.5-1-.65-.35-1 .22-1.62.15-.15 2.7-2.46 2.75-2.68.01-.03.01-.14-.06-.2-.07-.06-.17-.04-.25-.02-.11.02-1.87 1.18-5.27 3.47-.5.34-.95.5-1.35.49-.44-.01-1.29-.25-1.92-.45-.77-.25-1.39-.39-1.34-.83.03-.23.35-.47.96-.71 3.76-1.63 6.27-2.71 7.53-3.23 3.58-1.48 4.32-1.74 4.81-1.75.11 0 .35.03.5.16.13.11.17.26.19.37z"/></svg>
                        </a>
                        <a href="https://www.linkedin.com/sharing/share-offsite/?url=<?php echo urlencode(get_permalink()); ?>" target="_blank" class="w-8 h-8 rounded-full bg-white border border-[#EBE5D7] flex items-center justify-center text-gray-600 hover:bg-[#E8E2D2] hover:text-[#014235] transition-all hover:scale-110" title="لینکدین">
                            <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 24 24"><path d="M19 0h-14c-2.761 0-5 2.239-5 5v14c0 2.761 2.239 5 5 5h14c2.762 0 5-2.239 5-5v-14c0-2.761-2.238-5-5-5zm-11 19h-3v-11h3v11zm-1.5-12.268c-.966 0-1.75-.779-1.75-1.75s.784-1.75 1.75-1.75 1.75.779 1.75 1.75-.784 1.75-1.75 1.75zm13.5 12.268h-3v-5.604c0-3.368-4-3.113-4 0v5.604h-3v-11h3v1.765c1.396-2.586 7-2.777 7 2.476v6.759z"/></svg>
                        </a>
                    </div>
                </div>

                <a href="<?php echo esc_url(royesh_page_url('news')); ?>" class="inline-flex items-center gap-2 bg-[#014235] text-white hover:bg-[#2E7063] px-6 py-2.5 rounded-full text-xs font-bold shadow-sm transition-all duration-300 hover:scale-[1.03] active:scale-95">
                    <span><?php esc_html_e('بازگشت به مقالات', 'royesh'); ?></span>
                    <svg class="w-3.5 h-3.5 transform rotate-180" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M14 5l7 7m0 0l-7 7m7-7H3"></path>
                    </svg>
                </a>

            </div>

        </article>

    </div>
</main>

<!-- RELATED ARTICLES SECTION -->
<?php if ($related_posts->have_posts()) : ?>
<section class="w-full bg-[#FAF8F4] border-t border-[#EBE5D7] py-20 px-4 md:px-12 relative z-10">
    <div class="max-w-[1150px] mx-auto">
        
        <div class="flex items-center justify-between mb-12">
            <h2 class="text-2xl md:text-3xl font-black text-[#014235]"><?php esc_html_e('مقالات پیشنهادی و مرتبط', 'royesh'); ?></h2>
            <a href="<?php echo esc_url(royesh_page_url('news')); ?>" class="text-xs md:text-sm font-bold text-[#B1862D] hover:text-[#9c7524] flex items-center gap-1.5">
                <span><?php esc_html_e('مشاهده همه مقالات', 'royesh'); ?></span>
                <svg class="w-4 h-4 transform rotate-180" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M14 5l7 7m0 0l-7 7m7-7H3"></path>
                </svg>
            </a>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
            <?php
            while ($related_posts->have_posts()) :
                $related_posts->the_post();
                get_template_part('template-parts/archive/news-card');
            endwhile;
            wp_reset_postdata();
            ?>
        </div>

    </div>
</section>
<?php endif; ?>
