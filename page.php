<?php
/**
 * Default Page Template
 * 
 * @package Royesh
 * @version 1.0.0
 */

if (!defined('ABSPATH')) {
    exit; // Exit if accessed directly
}

get_header();
?>

<main id="primary" class="site-main py-12 px-4 max-w-[1150px] mx-auto min-h-[60vh]">
    <?php
    while (have_posts()) :
        the_post();
        ?>
        <article id="post-<?php the_ID(); ?>" <?php post_class('bg-white p-8 md:p-12 rounded-[24px] shadow-sm border border-[#EBE5D7]/80'); ?>>
            <header class="entry-header mb-8 text-right border-b border-[#EBE5D7]/60 pb-6">
                <h1 class="entry-title text-2xl md:text-4xl font-extrabold text-[#014235]"><?php the_title(); ?></h1>
            </header>

            <?php if (has_post_thumbnail()) : ?>
                <div class="post-thumbnail mb-8 rounded-[20px] overflow-hidden">
                    <?php the_post_thumbnail('large', ['class' => 'w-full h-auto object-cover']); ?>
                </div>
            <?php endif; ?>

            <div class="entry-content text-[#333333] text-base leading-relaxed font-normal text-right space-y-4">
                <?php
                the_content();

                wp_link_pages([
                    'before' => '<div class="page-links">' . esc_html__('صفحات:', 'royesh'),
                    'after'  => '</div>',
                ]);
                ?>
            </div>
        </article>
    <?php
    endwhile;
    ?>
</main>

<?php
get_footer();
