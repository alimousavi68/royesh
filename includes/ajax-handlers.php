<?php
/**
 * AJAX Form Processors & Handlers
 *
 * @package Royesh
 * @version 1.2.0
 */

if (!defined('ABSPATH')) {
    exit;
}

// ────────────────────────────────────────────────────────────────
// فرم تماس با ما
// ────────────────────────────────────────────────────────────────

function royesh_handle_contact_submit() {
    // ۱. Nonce
    $nonce = $_POST['nonce'] ?? $_POST['royesh_contact_nonce'] ?? '';
    if (empty($nonce) || !wp_verify_nonce($nonce, 'royesh_nonce_action')) {
        wp_send_json_error(['message' => __('خطای اعتبارسنجی امنیتی. لطفا صفحه را مجددا بارگذاری کنید.', 'royesh')], 403);
    }

    // ۲. Honeypot
    if (!empty($_POST['website_hp'])) {
        wp_send_json_error(['message' => __('درخواست مشکوک شناسایی شد.', 'royesh')], 400);
    }

    // ۳. Math CAPTCHA
    $captcha_token  = isset($_POST['captcha_token'])  ? sanitize_text_field($_POST['captcha_token'])  : '';
    $captcha_answer = isset($_POST['captcha_answer']) ? sanitize_text_field($_POST['captcha_answer']) : '';
    if (!royesh_verify_captcha($captcha_token, $captcha_answer)) {
        wp_send_json_error([
            'message'     => __('پاسخ کد امنیتی اشتباه است. لطفاً دوباره تلاش کنید.', 'royesh'),
            'new_captcha' => royesh_generate_captcha(),
        ], 400);
    }

    // ۴. Rate Limiting (حداکثر ۳ ارسال در ۱۵ دقیقه)
    if (!royesh_check_rate_limit('contact_form', 3, 900)) {
        wp_send_json_error(['message' => __('شما بیش از حد مجاز فرم ارسال کرده‌اید. لطفا ۱۵ دقیقه بعد مجددا تلاش کنید.', 'royesh')], 429);
    }

    // ۵. Sanitize ورودی‌ها
    $name    = isset($_POST['fullname']) ? sanitize_text_field($_POST['fullname']) : '';
    $email   = isset($_POST['email'])   ? sanitize_email($_POST['email'])          : '';
    $phone   = isset($_POST['phone'])   ? sanitize_text_field($_POST['phone'])     : '';
    $subject = isset($_POST['subject']) ? sanitize_text_field($_POST['subject'])   : '';
    $message = isset($_POST['message']) ? sanitize_textarea_field($_POST['message']) : '';

    if (empty($name) || empty($phone)) {
        wp_send_json_error(['message' => __('لطفا نام و شماره تماس را وارد کنید.', 'royesh')], 400);
    }

    // ۶. ذخیره در صندوق پیام داخلی
    royesh_save_message([
        'form_type' => 'contact',
        'name'      => $name,
        'email'     => $email,
        'phone'     => $phone,
        'subject'   => $subject,
        'message'   => $message,
    ]);

    // ۷. ارسال ایمیل اطلاع‌رسانی (اختیاری — اگر SMTP تنظیم باشد)
    $to      = get_option('admin_email');
    $subj    = sprintf(__('درخواست تماس جدید از طرف: %s', 'royesh'), $name);
    $body    = "نام: $name\nایمیل: $email\nتلفن: $phone\nموضوع: $subject\n\nمتن پیام:\n$message";
    $headers = ['Content-Type: text/plain; charset=UTF-8'];

    $mail_sent = wp_mail($to, $subj, $body, $headers);
    if (!$mail_sent) {
        error_log('Royesh Mailer Failure: contact form for ' . $name);
    }

    wp_send_json_success([
        'message'     => __('پیام شما با موفقیت دریافت شد. کارشناسان ما به زودی با شما تماس خواهند گرفت.', 'royesh'),
        'new_captcha' => royesh_generate_captcha(),
    ]);
}
add_action('wp_ajax_royesh_contact_submit',        'royesh_handle_contact_submit');
add_action('wp_ajax_nopriv_royesh_contact_submit', 'royesh_handle_contact_submit');


// ────────────────────────────────────────────────────────────────
// فرم خبرنامه
// ────────────────────────────────────────────────────────────────

function royesh_handle_newsletter_submit() {
    if (!isset($_POST['nonce']) || !wp_verify_nonce($_POST['nonce'], 'royesh_nonce_action')) {
        wp_send_json_error(['message' => __('خطای اعتبارسنجی امنیتی.', 'royesh')], 403);
    }

    $email = isset($_POST['email']) ? sanitize_email($_POST['email']) : '';
    if (empty($email) || !is_email($email)) {
        wp_send_json_error(['message' => __('لطفاً یک آدرس ایمیل معتبر وارد کنید.', 'royesh')], 400);
    }

    $subscribers = get_option('royesh_newsletter_subscribers', []);
    if (!in_array($email, $subscribers, true)) {
        $subscribers[] = $email;
        update_option('royesh_newsletter_subscribers', $subscribers);
    }

    wp_send_json_success(['message' => __('عضویت شما در خبرنامه با موفقیت ثبت شد.', 'royesh')]);
}
add_action('wp_ajax_royesh_newsletter_submit',        'royesh_handle_newsletter_submit');
add_action('wp_ajax_nopriv_royesh_newsletter_submit', 'royesh_handle_newsletter_submit');


// ────────────────────────────────────────────────────────────────
// فرم درخواست مشاوره
// ────────────────────────────────────────────────────────────────

function royesh_handle_consultation_submit() {
    // ۱. Nonce
    if (!isset($_POST['nonce']) || !wp_verify_nonce($_POST['nonce'], 'royesh_nonce_action')) {
        wp_send_json_error(['message' => __('خطای اعتبارسنجی امنیتی. لطفا صفحه را مجددا بارگذاری کنید.', 'royesh')], 403);
    }

    // ۲. Honeypot
    if (!empty($_POST['website_hp'])) {
        wp_send_json_error(['message' => __('درخواست مشکوک شناسایی شد.', 'royesh')], 400);
    }

    // ۳. Math CAPTCHA
    $captcha_token  = isset($_POST['captcha_token'])  ? sanitize_text_field($_POST['captcha_token'])  : '';
    $captcha_answer = isset($_POST['captcha_answer']) ? sanitize_text_field($_POST['captcha_answer']) : '';
    if (!royesh_verify_captcha($captcha_token, $captcha_answer)) {
        wp_send_json_error([
            'message'     => __('پاسخ کد امنیتی اشتباه است. لطفاً دوباره تلاش کنید.', 'royesh'),
            'new_captcha' => royesh_generate_captcha(),
        ], 400);
    }

    // ۴. Rate Limiting
    if (!royesh_check_rate_limit('consultation_form', 3, 900)) {
        wp_send_json_error(['message' => __('شما بیش از حد مجاز فرم ارسال کرده‌اید. لطفا ۱۵ دقیقه بعد مجددا تلاش کنید.', 'royesh')], 429);
    }

    // ۵. Sanitize
    $name    = isset($_POST['fullname']) ? sanitize_text_field($_POST['fullname'])   : '';
    $phone   = isset($_POST['phone'])   ? sanitize_text_field($_POST['phone'])       : '';
    $email   = isset($_POST['email'])   ? sanitize_email($_POST['email'])             : '';
    $company = isset($_POST['company']) ? sanitize_text_field($_POST['company'])     : '';
    $subject = isset($_POST['subject']) ? sanitize_text_field($_POST['subject'])     : '';
    $message = isset($_POST['message']) ? sanitize_textarea_field($_POST['message']) : '';

    if (empty($name) || empty($phone) || empty($subject) || empty($message)) {
        wp_send_json_error(['message' => __('لطفا فیلدهای ستاره‌دار و ضروری را تکمیل فرمایید.', 'royesh')], 400);
    }

    // ۶. ذخیره در صندوق پیام داخلی
    royesh_save_message([
        'form_type' => 'consultation',
        'name'      => $name,
        'email'     => $email,
        'phone'     => $phone,
        'subject'   => $subject . ($company ? ' — ' . $company : ''),
        'message'   => $message,
    ]);

    // ۷. ارسال ایمیل اطلاع‌رسانی
    $to           = get_option('admin_email');
    $mail_subject = sprintf(__('درخواست مشاوره تخصصی جدید: %s (%s)', 'royesh'), $name, $subject);
    $body         = "نام: $name\nتلفن: $phone\nایمیل: $email\nشرکت: $company\nموضوع: $subject\n\nتوضیحات:\n$message";
    $headers      = ['Content-Type: text/plain; charset=UTF-8'];

    $mail_sent = wp_mail($to, $mail_subject, $body, $headers);
    if (!$mail_sent) {
        error_log('Royesh Consultation Mailer Failure for ' . $name);
    }

    wp_send_json_success([
        'message'     => __('درخواست مشاوره شما با موفقیت ثبت شد. کارشناسان ما به زودی با شما تماس خواهند گرفت.', 'royesh'),
        'new_captcha' => royesh_generate_captcha(),
    ]);
}
add_action('wp_ajax_royesh_consultation_submit',        'royesh_handle_consultation_submit');
add_action('wp_ajax_nopriv_royesh_consultation_submit', 'royesh_handle_consultation_submit');
