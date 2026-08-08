<?php
/**
 * Security & Anti-Spam Helpers
 *
 * @package Royesh
 * @version 1.1.0
 */

if (!defined('ABSPATH')) {
    exit;
}

// ────────────────────────────────────────────────────────────────
// Rate Limiting
// ────────────────────────────────────────────────────────────────

if (!function_exists('royesh_check_rate_limit')) {
    /**
     * بررسی Rate Limiting جهت جلوگیری از اسپم در فرم‌ها
     *
     * @param string $action_name
     * @param int    $max_attempts
     * @param int    $decay_seconds
     * @return bool
     */
    function royesh_check_rate_limit($action_name = 'form_submit', $max_attempts = 3, $decay_seconds = 900) {
        $ip            = isset($_SERVER['REMOTE_ADDR']) ? sanitize_text_field($_SERVER['REMOTE_ADDR']) : '0.0.0.0';
        $transient_key = 'royesh_rl_' . md5($action_name . '_' . $ip);
        $attempts      = get_transient($transient_key);

        if ($attempts === false) {
            set_transient($transient_key, 1, $decay_seconds);
            return true;
        }
        if ((int) $attempts >= $max_attempts) {
            return false;
        }
        set_transient($transient_key, (int) $attempts + 1, $decay_seconds);
        return true;
    }
}

// ────────────────────────────────────────────────────────────────
// Honeypot
// ────────────────────────────────────────────────────────────────

if (!function_exists('royesh_verify_honeypot')) {
    /**
     * اعتبارسنجی Honeypot
     *
     * @param string $honeypot_value
     * @return bool  true = پاک / بدون ربات
     */
    function royesh_verify_honeypot($honeypot_value) {
        return empty($honeypot_value);
    }
}

// ────────────────────────────────────────────────────────────────
// Math CAPTCHA
// ────────────────────────────────────────────────────────────────

if (!function_exists('royesh_generate_captcha')) {
    /**
     * تولید سوال کپچای ریاضی
     * خروجی: ['question' => '۳ + ۵ = ?', 'token' => 'uuid']
     *
     * @return array{question:string, token:string}
     */
    function royesh_generate_captcha() {
        $num1 = wp_rand(1, 9);
        $num2 = wp_rand(1, 9);
        $ops  = ['+', '-'];
        $op   = $ops[array_rand($ops)];

        // اطمینان از عدم منفی بودن جواب
        if ($op === '-' && $num1 < $num2) {
            [$num1, $num2] = [$num2, $num1];
        }

        $answer = $op === '+' ? $num1 + $num2 : $num1 - $num2;
        $token  = wp_generate_uuid4();

        // ذخیره پاسخ با توکن — ۱۵ دقیقه
        set_transient('royesh_captcha_' . $token, $answer, 900);

        // تبدیل اعداد به فارسی
        $fa_digits = ['۰', '۱', '۲', '۳', '۴', '۵', '۶', '۷', '۸', '۹'];
        $toFa      = static fn($n) => strtr((string) $n, array_combine(range(0, 9), $fa_digits));

        $question = $toFa($num1) . ' ' . $op . ' ' . $toFa($num2) . ' = ?';

        return ['question' => $question, 'token' => $token];
    }
}

if (!function_exists('royesh_verify_captcha')) {
    /**
     * اعتبارسنجی پاسخ کپچا
     *
     * @param string $token
     * @param mixed  $answer
     * @return bool
     */
    function royesh_verify_captcha($token, $answer) {
        if (empty($token) || !is_string($token)) {
            return false;
        }

        $key            = 'royesh_captcha_' . sanitize_text_field($token);
        $correct_answer = get_transient($key);

        if ($correct_answer === false) {
            return false;
        }

        delete_transient($key); // یک‌بار مصرف

        return (int) $answer === (int) $correct_answer;
    }
}

if (!function_exists('royesh_ajax_new_captcha')) {
    /**
     * AJAX endpoint برای دریافت سوال کپچای جدید
     */
    function royesh_ajax_new_captcha() {
        check_ajax_referer('royesh_nonce_action', 'nonce');
        wp_send_json_success(royesh_generate_captcha());
    }
    add_action('wp_ajax_royesh_new_captcha', 'royesh_ajax_new_captcha');
    add_action('wp_ajax_nopriv_royesh_new_captcha', 'royesh_ajax_new_captcha');
}
