<?php
/**
 * Template Name: صفحه اصلی (Home / Front Page)
 *
 * The Front Page Template (HomePage)
 * 
 * @package Royesh
 * @version 1.2.0
 */

if (!defined('ABSPATH')) {
    exit; // Exit if accessed directly
}

get_header();
?>

<main id="primary" class="site-main">

    <?php
    // 1. Hero Section & Attached Features Bar
    if (get_theme_mod('royesh_hero_enable', true)) {
        get_template_part('template-parts/front-page/hero');
    }

    // 2. Value Creation Section
    if (get_theme_mod('royesh_value_enable', true)) {
        get_template_part('template-parts/front-page/value-creation');
    }

    // 3. Services Home Section
    if (get_theme_mod('royesh_services_enable', true)) {
        get_template_part('template-parts/front-page/services');
    }

    // 4. Rooyesh Visual Separator Divider
    get_template_part('template-parts/front-page/divider-rooyesh');

    // 5. Brand Philosophy Section
    if (get_theme_mod('royesh_philosophy_enable', true)) {
        get_template_part('template-parts/front-page/brand-philosophy');
    }

    // 6. Call To Action (CTA) Divider
    if (get_theme_mod('royesh_cta_enable', true)) {
        get_template_part('template-parts/front-page/cta-divider');
    }

    // 7. Contact Us Home Section
    if (get_theme_mod('royesh_contact_enable', true)) {
        get_template_part('template-parts/front-page/contact');
    }

    // 8. Blog / News Slider Section
    if (get_theme_mod('royesh_blog_enable', true)) {
        get_template_part('template-parts/front-page/blog');
    }
    ?>

</main>

<?php
get_footer();
