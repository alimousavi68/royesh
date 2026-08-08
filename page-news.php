<?php
/**
 * Template Name: اخبار و مقالات (News Archive)
 * 
 * @package Royesh
 * @version 1.0.0
 */

if (!defined('ABSPATH')) {
    exit; // Exit if accessed directly
}

get_header();

$paged = (get_query_var('paged')) ? get_query_var('paged') : ((get_query_var('page')) ? get_query_var('page') : 1);
$news_query = new WP_Query([
    'post_type'      => 'post',
    'post_status'    => 'publish',
    'posts_per_page' => get_option('posts_per_page', 9),
    'paged'          => $paged,
]);

$categories = get_categories(['hide_empty' => false]);
?>

<!-- HERO SECTION -->
<section class="relative w-full bg-[#004F40] py-20 px-4 md:px-12 overflow-hidden border-b border-[#2E7063]">
    <div class="absolute inset-0 opacity-100 pointer-events-none select-none z-0">
        <img src="<?php echo royesh_asset_img('bg vector patt.svg'); ?>" alt="Pattern" class="w-full h-full object-cover" />
    </div>
    <div class="absolute top-[10%] left-[10%] w-[350px] h-[350px] rounded-full bg-[#2E7063]/25 blur-[100px] pointer-events-none z-0"></div>
    <div class="absolute bottom-[5%] right-[5%] w-[250px] h-[250px] rounded-full bg-[#B1862D]/10 blur-[80px] pointer-events-none z-0"></div>

    <div class="max-w-[1150px] mx-auto relative z-10 text-center text-white">
        <span class="text-[#B1862D] text-sm md:text-base font-bold tracking-wider block mb-3 font-sans"><?php esc_html_e('رویش رسانه', 'royesh'); ?></span>
        <h1 class="text-3xl md:text-5xl font-black leading-tight mb-6">
            <?php esc_html_e('اخبار، مقالات و اطلاعیه‌ها', 'royesh'); ?>
        </h1>
        <p class="text-white/80 text-base md:text-lg max-w-2xl mx-auto leading-relaxed font-light">
            <?php esc_html_e('آخرین تحلیل‌ها و خبرهای دنیای اقتصاد، نوآوری و توسعه کسب‌وکار را در رویش دنبال کنید.', 'royesh'); ?>
        </p>
    </div>
</section>

<!-- SEARCH & FILTER SECTION -->
<section class="w-full pt-12 pb-6 px-4 md:px-12">
    <div class="max-w-[1150px] mx-auto flex flex-col md:flex-row gap-6 justify-between items-center bg-white p-4 md:p-6 rounded-[24px] border border-[#EBE5D7]/50 shadow-sm">
        
        <!-- Dynamic Category Filters -->
        <div id="category-filters" class="flex flex-wrap gap-2.5 items-center relative">
            <a href="<?php echo esc_url(get_permalink()); ?>" class="px-5 py-2 rounded-full text-xs font-bold bg-[#014235] text-white transition-all">
                <?php esc_html_e('همه', 'royesh'); ?>
            </a>
            <?php foreach ($categories as $cat) : ?>
                <a href="<?php echo esc_url(get_category_link($cat->term_id)); ?>" class="px-5 py-2 rounded-full text-xs font-bold bg-[#FAF8F4] text-gray-700 hover:bg-[#E8E2D2] transition-all">
                    <?php echo esc_html($cat->name); ?>
                </a>
            <?php endforeach; ?>
        </div>

        <!-- Search input form -->
        <form role="search" method="get" action="<?php echo esc_url(home_url('/')); ?>" class="relative w-full md:w-80">
            <input type="search" name="s" value="<?php echo get_search_query(); ?>" placeholder="<?php esc_attr_e('جستجو در مقالات...', 'royesh'); ?>" class="w-full bg-[#FAF8F4] border border-[#EBE5D7] rounded-full py-2.5 pr-4 pl-10 text-xs text-gray-700 outline-none focus:border-[#B1862D] font-sans" />
            <button type="submit" class="absolute left-4 top-1/2 -translate-y-1/2 text-gray-400 hover:text-[#004F40]">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                </svg>
            </button>
        </form>

    </div>
</section>

<!-- ARTICLES GRID -->
<section class="w-full pb-20 px-4 md:px-12">
    <div class="max-w-[1150px] mx-auto">
        
        <?php if ($news_query->have_posts()) : ?>
            <div id="articles-grid" class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-x-8 gap-y-16">
                <?php
                while ($news_query->have_posts()) :
                    $news_query->the_post();
                    get_template_part('template-parts/archive/news-card');
                endwhile;
                wp_reset_postdata();
                ?>
            </div>

            <!-- Pagination Grid -->
            <div class="flex justify-center items-center gap-3 mt-16">
                <?php
                echo paginate_links([
                    'total'     => $news_query->max_num_pages,
                    'current'   => $paged,
                    'mid_size'  => 2,
                    'prev_text' => __('قبلی', 'royesh'),
                    'next_text' => __('بعدی', 'royesh'),
                ]);
                ?>
            </div>
        <?php else : ?>
            <div class="text-center py-16">
                <p class="text-gray-500 text-sm"><?php esc_html_e('هیچ مقاله‌ای یافت نشد.', 'royesh'); ?></p>
            </div>
        <?php endif; ?>

    </div>
</section>

<?php
get_footer();
