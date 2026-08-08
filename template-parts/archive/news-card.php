<?php
/**
 * Archive News Card Template Part
 * 
 * @package Royesh
 * @version 1.0.0
 */

if (!defined('ABSPATH')) {
    exit; // Exit if accessed directly
}

$categories = get_the_category();
$cat_name   = !empty($categories) ? esc_html($categories[0]->name) : esc_html__('اخبار', 'royesh');
?>

<div class="news-card group relative w-full h-[450px] mx-auto select-none transition-all duration-300">
    <div class="absolute top-0 left-0 w-full h-[375px] overflow-hidden rounded-t-[99px] rounded-b-[42px] shadow-sm">
        <?php if (has_post_thumbnail()) : ?>
            <?php the_post_thumbnail('royesh-blog-card', ['class' => 'w-full h-full object-cover transition-transform duration-500 group-hover:scale-105']); ?>
        <?php else : ?>
            <img src="<?php echo royesh_asset_img('post/post_101_v3_1785331719243.png'); ?>" alt="<?php the_title_attribute(); ?>" class="w-full h-full object-cover transition-transform duration-500 group-hover:scale-105" />
        <?php endif; ?>
    </div>
    <div class="absolute inset-0 bg-gradient-to-t from-black/20 via-transparent to-transparent pointer-events-none rounded-t-[99px] rounded-b-[42px] h-[375px]"></div>
    
    <div class="news-card-content absolute bottom-0 left-1/2 -translate-x-1/2 w-[90%] z-10 p-5 rounded-[29px] flex flex-col justify-end min-h-[170px] shadow-md bg-[#FAF8F4] border border-[#EBE5D7] text-[#333333]">
        <div class="flex items-center justify-between mb-1">
            <span class="text-[10px] uppercase tracking-wider text-[#B1862D] font-bold"><?php echo $cat_name; ?></span>
            <span class="text-[10px] text-gray-400"><?php echo esc_html(get_the_date('j F Y')); ?></span>
        </div>
        <h3 class="news-title font-extrabold text-lg mb-1.5 font-sans text-black transition-colors duration-300">
            <a href="<?php the_permalink(); ?>" class="text-inherit hover:underline"><?php the_title(); ?></a>
        </h3>
        <p class="news-excerpt text-xs leading-relaxed mb-4 font-sans font-light text-gray-600 transition-colors duration-300">
            <?php echo esc_html(wp_trim_words(get_the_excerpt(), 15, '...')); ?>
        </p>
        <a href="<?php the_permalink(); ?>" class="news-link hover:opacity-80 text-xs font-bold inline-flex items-center gap-1.5 transition-all font-sans text-[#B1862D] mr-auto mt-auto">
            <span><?php esc_html_e('ادامه مطلب', 'royesh'); ?></span>
            <svg class="w-3.5 h-3.5 transform rotate-180" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                <path stroke-linecap="round" stroke-linejoin="round" d="M14 5l7 7m0 0l-7 7m7-7H3"></path>
            </svg>
        </a>
    </div>
</div>
