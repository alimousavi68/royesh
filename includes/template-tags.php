<?php
/**
 * Dynamic Template Tags & Markup Helpers
 * 
 * @package Royesh
 * @version 1.0.0
 */

if (!defined('ABSPATH')) {
    exit; // Exit if accessed directly
}

if (!function_exists('royesh_posted_on')) :
    /**
     * نمایش تاریخ انتشار مقاله با فرمت ایمن
     */
    function royesh_posted_on() {
        $time_string = '<time class="entry-date published updated" datetime="%1$s">%2$s</time>';
        
        $time_string = sprintf(
            $time_string,
            esc_attr(get_the_date(DATE_W3C)),
            esc_html(get_the_date())
        );

        echo '<span class="posted-on">' . $time_string . '</span>';
    }
endif;

if (!function_exists('royesh_posted_by')) :
    /**
     * نمایش نام نویسنده مقاله
     */
    function royesh_posted_by() {
        $byline = sprintf(
            /* translators: %s: post author. */
            esc_html_x('توسط %s', 'post author', 'royesh'),
            '<span class="author vcard"><a class="url fn n text-[#004F40] font-bold" href="' . esc_url(get_author_posts_url(get_the_author_meta('ID'))) . '">' . esc_html(get_the_author()) . '</a></span>'
        );

        echo '<span class="byline"> ' . $byline . '</span>';
    }
endif;

if (!function_exists('royesh_reading_time')) :
    /**
     * محاسبه و نمایش تخمینی زمان مطالعه مقاله
     */
    function royesh_reading_time() {
        $content = get_post_field('post_content', get_the_ID());
        $word_count = mb_strlen(strip_tags($content), 'UTF-8');
        $reading_time = ceil($word_count / 1200); // میانگین ۲۰۰ کلمه در دقیقه به فارسی
        
        if ($reading_time < 1) {
            $reading_time = 1;
        }

        return sprintf(esc_html__('%d دقیقه مطالعه', 'royesh'), $reading_time);
    }
endif;

