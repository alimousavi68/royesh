<?php
/**
 * Main Template File (Fallback)
 * 
 * @package Royesh
 * @version 1.0.0
 */

if (!defined('ABSPATH')) {
    exit; // Exit if accessed directly
}

get_header();
?>

<main id="primary" class="site-main py-12 px-4 max-w-[1440px] mx-auto min-h-[50vh]">
    <?php
    if (have_posts()) :
        while (have_posts()) :
            the_post();
            get_template_part('template-parts/post/content', get_post_type());
        endwhile;

        the_posts_navigation();
    else :
        get_template_part('template-parts/post/content', 'none');
    endif;
    ?>
</main>

<?php
get_footer();
