<?php
/**
 * The Single Post Template
 * 
 * @package Royesh
 * @version 1.0.0
 */

if (!defined('ABSPATH')) {
    exit; // Exit if accessed directly
}

get_header();
?>

<main id="primary" class="site-main">

    <?php
    while (have_posts()) :
        the_post();
        get_template_part('template-parts/single/post-content');
    endwhile;
    ?>

</main>

<?php
get_footer();
