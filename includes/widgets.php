<?php
/**
 * Dedicated Royesh Custom Widgets
 * 
 * @package Royesh
 * @version 1.0.0
 */

if (!defined('ABSPATH')) {
    exit; // Exit if accessed directly
}

/**
 * ۱. ویجت اختصاصی اطلاعات تماس رویش
 */
class Royesh_Contact_Info_Widget extends WP_Widget {

    public function __construct() {
        parent::__construct(
            'royesh_contact_info_widget',
            __('رویش — اطلاعات تماس و آدرس', 'royesh'),
            ['description' => __('نمایش کارت اطلاعات تماس، آدرس و ایمیل با استایل سازمانی رویش', 'royesh')]
        );
    }

    public function widget($args, $instance) {
        echo $args['before_widget'];
        
        $title = !empty($instance['title']) ? apply_filters('widget_title', $instance['title']) : '';
        $phone = !empty($instance['phone']) ? $instance['phone'] : get_theme_mod('royesh_phone', '۰۲۱ ۵۵۵ ۸۴۶۵');
        $email = !empty($instance['email']) ? $instance['email'] : get_theme_mod('royesh_email', 'info@royeshcapital.com');
        $address = !empty($instance['address']) ? $instance['address'] : get_theme_mod('royesh_address', 'تهران، میدان ونک، خیابان ملاصدرا، پلاک ۴۲');

        if (!empty($title)) {
            echo $args['before_title'] . esc_html($title) . $args['after_title'];
        }
        ?>
        <div class="royesh-widget-contact flex flex-col gap-3 text-sm leading-relaxed">
            <?php if (!empty($address)) : ?>
                <div class="flex items-start gap-2.5">
                    <span class="text-[#B58A33] mt-1 shrink-0">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path></svg>
                    </span>
                    <span><?php echo esc_html($address); ?></span>
                </div>
            <?php endif; ?>

            <?php if (!empty($phone)) : ?>
                <div class="flex items-center gap-2.5">
                    <span class="text-[#B58A33] shrink-0">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.94.725l.548 2.2a1 1 0 01-.321.988l-1.305.98a10.582 10.582 0 004.872 4.872l.98-1.305a1 1 0 01.988-.321l2.2.548a1 1 0 01.725.94V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"></path></svg>
                    </span>
                    <a href="tel:<?php echo esc_attr(preg_replace('/[^\d\+]/', '', $phone)); ?>" class="hover:text-[#B58A33] transition-colors" dir="ltr"><?php echo esc_html($phone); ?></a>
                </div>
            <?php endif; ?>

            <?php if (!empty($email)) : ?>
                <div class="flex items-center gap-2.5">
                    <span class="text-[#B58A33] shrink-0">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path></svg>
                    </span>
                    <a href="mailto:<?php echo esc_attr($email); ?>" class="hover:text-[#B58A33] transition-colors" dir="ltr"><?php echo esc_html($email); ?></a>
                </div>
            <?php endif; ?>
        </div>
        <?php
        echo $args['after_widget'];
    }

    public function form($instance) {
        $title = !empty($instance['title']) ? $instance['title'] : __('اطلاعات تماس', 'royesh');
        $phone = !empty($instance['phone']) ? $instance['phone'] : '';
        $email = !empty($instance['email']) ? $instance['email'] : '';
        $address = !empty($instance['address']) ? $instance['address'] : '';
        ?>
        <p>
            <label for="<?php echo esc_attr($this->get_field_id('title')); ?>"><?php esc_html_e('عنوان ابزارک:', 'royesh'); ?></label>
            <input class="widefat" id="<?php echo esc_attr($this->get_field_id('title')); ?>" name="<?php echo esc_attr($this->get_field_name('title')); ?>" type="text" value="<?php echo esc_attr($title); ?>">
        </p>
        <p>
            <label for="<?php echo esc_attr($this->get_field_id('phone')); ?>"><?php esc_html_e('شماره تلفن (اختیاری):', 'royesh'); ?></label>
            <input class="widefat" id="<?php echo esc_attr($this->get_field_id('phone')); ?>" name="<?php echo esc_attr($this->get_field_name('phone')); ?>" type="text" value="<?php echo esc_attr($phone); ?>">
        </p>
        <p>
            <label for="<?php echo esc_attr($this->get_field_id('email')); ?>"><?php esc_html_e('آدرس ایمیل (اختیاری):', 'royesh'); ?></label>
            <input class="widefat" id="<?php echo esc_attr($this->get_field_id('email')); ?>" name="<?php echo esc_attr($this->get_field_name('email')); ?>" type="email" value="<?php echo esc_attr($email); ?>">
        </p>
        <p>
            <label for="<?php echo esc_attr($this->get_field_id('address')); ?>"><?php esc_html_e('آدرس متنی (اختیاری):', 'royesh'); ?></label>
            <textarea class="widefat" rows="3" id="<?php echo esc_attr($this->get_field_id('address')); ?>" name="<?php echo esc_attr($this->get_field_name('address')); ?>"><?php echo esc_textarea($address); ?></textarea>
        </p>
        <?php
    }

    public function update($new_instance, $old_instance) {
        $instance = [];
        $instance['title'] = (!empty($new_instance['title'])) ? sanitize_text_field($new_instance['title']) : '';
        $instance['phone'] = (!empty($new_instance['phone'])) ? sanitize_text_field($new_instance['phone']) : '';
        $instance['email'] = (!empty($new_instance['email'])) ? sanitize_email($new_instance['email']) : '';
        $instance['address'] = (!empty($new_instance['address'])) ? sanitize_textarea_field($new_instance['address']) : '';
        return $instance;
    }
}


/**
 * ۲. ویجت اختصاصی بنر مشاوره و CTA
 */
class Royesh_CTA_Banner_Widget extends WP_Widget {

    public function __construct() {
        parent::__construct(
            'royesh_cta_banner_widget',
            __('رویش — بنر دعوت به اقدام و مشاوره', 'royesh'),
            ['description' => __('نمایش بنر جذاب دعوت به دریافت مشاوره یا همکاری در سایدبار', 'royesh')]
        );
    }

    public function widget($args, $instance) {
        echo $args['before_widget'];
        
        $title = !empty($instance['title']) ? $instance['title'] : __('نیاز به مشاوره مالی دارید؟', 'royesh');
        $desc = !empty($instance['desc']) ? $instance['desc'] : __('کارشناسان رویش آماده همراهی شما در مسیر توسعه کسب‌وکار هستند.', 'royesh');
        $btn_text = !empty($instance['btn_text']) ? $instance['btn_text'] : __('درخواست جلسه', 'royesh');
        $btn_url = !empty($instance['btn_url']) ? $instance['btn_url'] : home_url('/consultation');
        ?>
        <div class="royesh-widget-cta bg-gradient-to-br from-[#014235] to-[#081B17] text-white p-6 rounded-[20px] text-center shadow-md">
            <h4 class="text-lg font-bold text-white mb-2 font-heading"><?php echo esc_html($title); ?></h4>
            <p class="text-xs text-white/80 mb-5 leading-relaxed"><?php echo esc_html($desc); ?></p>
            <a href="<?php echo esc_url($btn_url); ?>" class="inline-block bg-[#B1862D] hover:bg-[#9c7524] text-white text-xs font-bold px-5 py-2.5 rounded-full transition-all duration-300 shadow">
                <?php echo esc_html($btn_text); ?>
            </a>
        </div>
        <?php
        echo $args['after_widget'];
    }

    public function form($instance) {
        $title = !empty($instance['title']) ? $instance['title'] : __('نیاز به مشاوره مالی دارید؟', 'royesh');
        $desc = !empty($instance['desc']) ? $instance['desc'] : '';
        $btn_text = !empty($instance['btn_text']) ? $instance['btn_text'] : __('درخواست جلسه', 'royesh');
        $btn_url = !empty($instance['btn_url']) ? $instance['btn_url'] : '';
        ?>
        <p>
            <label for="<?php echo esc_attr($this->get_field_id('title')); ?>"><?php esc_html_e('عنوان بنر:', 'royesh'); ?></label>
            <input class="widefat" id="<?php echo esc_attr($this->get_field_id('title')); ?>" name="<?php echo esc_attr($this->get_field_name('title')); ?>" type="text" value="<?php echo esc_attr($title); ?>">
        </p>
        <p>
            <label for="<?php echo esc_attr($this->get_field_id('desc')); ?>"><?php esc_html_e('توضیحات کوتاه:', 'royesh'); ?></label>
            <textarea class="widefat" rows="2" id="<?php echo esc_attr($this->get_field_id('desc')); ?>" name="<?php echo esc_attr($this->get_field_name('desc')); ?>"><?php echo esc_textarea($desc); ?></textarea>
        </p>
        <p>
            <label for="<?php echo esc_attr($this->get_field_id('btn_text')); ?>"><?php esc_html_e('متن دکمه:', 'royesh'); ?></label>
            <input class="widefat" id="<?php echo esc_attr($this->get_field_id('btn_text')); ?>" name="<?php echo esc_attr($this->get_field_name('btn_text')); ?>" type="text" value="<?php echo esc_attr($btn_text); ?>">
        </p>
        <p>
            <label for="<?php echo esc_attr($this->get_field_id('btn_url')); ?>"><?php esc_html_e('لینک دکمه:', 'royesh'); ?></label>
            <input class="widefat" id="<?php echo esc_attr($this->get_field_id('btn_url')); ?>" name="<?php echo esc_attr($this->get_field_name('btn_url')); ?>" type="url" value="<?php echo esc_attr($btn_url); ?>">
        </p>
        <?php
    }

    public function update($new_instance, $old_instance) {
        $instance = [];
        $instance['title'] = (!empty($new_instance['title'])) ? sanitize_text_field($new_instance['title']) : '';
        $instance['desc'] = (!empty($new_instance['desc'])) ? sanitize_textarea_field($new_instance['desc']) : '';
        $instance['btn_text'] = (!empty($new_instance['btn_text'])) ? sanitize_text_field($new_instance['btn_text']) : '';
        $instance['btn_url'] = (!empty($new_instance['btn_url'])) ? esc_url_raw($new_instance['btn_url']) : '';
        return $instance;
    }
}


/**
 * ثبت ابزارک‌های اختصاصی رویش
 */
function royesh_register_custom_widgets() {
    register_widget('Royesh_Contact_Info_Widget');
    register_widget('Royesh_CTA_Banner_Widget');
}
add_action('widgets_init', 'royesh_register_custom_widgets');
