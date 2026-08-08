<?php
/**
 * Contact Us Section Template Part
 *
 * @package Royesh
 * @version 1.1.0
 */

if (!defined('ABSPATH')) {
    exit;
}

$enable = get_theme_mod('royesh_contact_enable', true);
if (!$enable) return;

$badge    = get_theme_mod('royesh_contact_badge',   'اطلاعات تماس');
$title_1  = get_theme_mod('royesh_contact_title_1', 'به دنبال');
$title_2  = get_theme_mod('royesh_contact_title_2', 'خدمات مالی سفارشی');
$title_3  = get_theme_mod('royesh_contact_title_3', 'باشید.');
$desc     = get_theme_mod('royesh_contact_desc', 'تیم مشاوران و کارشناسان خبره ما در موسسه رویش آماده ارائه راهکارهای دقیق مالی، بهینه‌سازی ساختارهای سرمایه‌گذاری و مدل‌سازی اختصاصی منطبق با نیازها و چشم‌انداز توسعه پایدار کسب‌وکار شما هستند.');
$bg_image = get_theme_mod('royesh_contact_image', royesh_asset_img('contact-us-bg.webp'));

$title_size  = get_theme_mod('royesh_contact_title_size',  '36');
$desc_size   = get_theme_mod('royesh_contact_desc_size',   '15');
$title_color = get_theme_mod('royesh_contact_title_color', '#080206');
$accent_color= get_theme_mod('royesh_contact_accent_color','#004F40');
$btn_bg      = get_theme_mod('royesh_contact_btn_bg',      '#004F40');

// تولید سوال کپچا — هر بار صفحه لود می‌شود
$captcha = royesh_generate_captcha();
?>
<style>
    #contact h2 { font-size: <?php echo esc_attr($title_size); ?>px; color: <?php echo esc_attr($title_color); ?>; }
    #contact h2 span { color: <?php echo esc_attr($accent_color); ?>; }
    #contact p { font-size: <?php echo esc_attr($desc_size); ?>px; }
    #contact button[type=submit] { background-color: <?php echo esc_attr($btn_bg); ?> !important; }

    /* کپچا — همخوان با استایل فرم */
    .royesh-captcha-row {
        display: flex;
        align-items: center;
        gap: 10px;
        background: #fff;
        border: 1px solid #E2DDD4;
        border-radius: 9999px;
        padding: 4px 4px 4px 16px;
        direction: rtl;
    }
    .royesh-captcha-question {
        font-size: 14px;
        font-weight: 600;
        color: #004F40;
        white-space: nowrap;
        flex-shrink: 0;
        letter-spacing: 0.02em;
    }
    .royesh-captcha-input {
        width: 80px;
        border: 1px solid #E2DDD4;
        border-radius: 9999px;
        padding: 8px 14px;
        font-size: 14px;
        text-align: center;
        outline: none;
        transition: border-color 0.2s, box-shadow 0.2s;
        background: #F3ECE3;
        color: #333;
    }
    .royesh-captcha-input:focus { border-color: #004F40; box-shadow: 0 0 0 3px rgba(0,79,64,0.12); }
    .royesh-captcha-refresh {
        background: none;
        border: none;
        cursor: pointer;
        color: #888;
        display: flex;
        align-items: center;
        padding: 6px;
        border-radius: 50%;
        transition: color 0.2s, background 0.2s;
        margin-right: auto;
    }
    .royesh-captcha-refresh:hover { color: #004F40; background: rgba(0,79,64,0.08); }
    .royesh-captcha-refresh svg { width: 16px; height: 16px; }
</style>

<section id="contact" dir="rtl" class="w-full bg-white select-none py-24 sm:py-32">
    <div class="max-w-[1440px] mx-auto px-4 md:px-12 grid grid-cols-1 lg:grid-cols-2 gap-12 lg:gap-16 items-start">

        <!-- RIGHT COLUMN: Contact Form -->
        <div class="royesh-contact-form-bg bg-[#F3ECE3] rounded-[32px] p-4 md:p-4 relative overflow-hidden shadow-sm border border-[#E5DDD0] w-full v-reveal v-reveal-fade-right order-2 lg:order-1">
            <div class="absolute -right-20 -top-20 w-64 h-64 rounded-full bg-[#004F40]/5 blur-3xl pointer-events-none"></div>

            <form id="royesh-home-contact-form" class="grid grid-cols-1 md:grid-cols-2 gap-y-2.5 gap-x-4 relative z-10">
                <?php wp_nonce_field('royesh_nonce_action', 'royesh_contact_nonce'); ?>

                <!-- Honeypot -->
                <div style="display:none;" aria-hidden="true">
                    <input type="text" name="website_hp" tabindex="-1" autocomplete="off" />
                </div>

                <!-- Captcha token (hidden) -->
                <input type="hidden" name="captcha_token" id="royesh-captcha-token-home" value="<?php echo esc_attr($captcha['token']); ?>" />

                <!-- Name -->
                <div class="col-span-1">
                    <input type="text" name="fullname" required
                        placeholder="<?php esc_attr_e('نام و نام خانوادگی', 'royesh'); ?>"
                        class="bg-white w-full px-6 py-4 rounded-full text-sm text-gray-700 placeholder-gray-400 border border-[#E2DDD4] focus:outline-none focus:ring-2 focus:ring-[#004F40]/20 transition-all font-sans"
                    />
                </div>

                <!-- Phone -->
                <div class="col-span-1">
                    <input type="text" name="phone" required
                        placeholder="<?php esc_attr_e('شماره تماس', 'royesh'); ?>"
                        class="bg-white w-full px-6 py-4 rounded-full text-sm text-gray-700 placeholder-gray-400 border border-[#E2DDD4] focus:outline-none focus:ring-2 focus:ring-[#004F40]/20 transition-all font-sans"
                    />
                </div>

                <!-- Email -->
                <div class="col-span-1 md:col-span-2">
                    <input type="email" name="email"
                        placeholder="<?php esc_attr_e('ایمیل', 'royesh'); ?>"
                        class="bg-white w-full px-6 py-4 rounded-full text-sm text-gray-700 placeholder-gray-400 border border-[#E2DDD4] focus:outline-none focus:ring-2 focus:ring-[#004F40]/20 transition-all font-sans"
                    />
                </div>

                <!-- Subject -->
                <div class="col-span-1 md:col-span-2 relative">
                    <select name="subject"
                        class="bg-white w-full px-6 py-4 rounded-full text-sm text-gray-700 placeholder-gray-400 border border-[#E2DDD4] focus:outline-none focus:ring-2 focus:ring-[#004F40]/20 transition-all appearance-none font-sans cursor-pointer">
                        <option value="" disabled selected hidden><?php esc_html_e('موضوع پیام', 'royesh'); ?></option>
                        <option value="consulting"><?php esc_html_e('مشاوره مالی', 'royesh'); ?></option>
                        <option value="partnership"><?php esc_html_e('درخواست همکاری', 'royesh'); ?></option>
                        <option value="support"><?php esc_html_e('پشتیبانی', 'royesh'); ?></option>
                    </select>
                    <div class="absolute inset-y-0 left-0 flex items-center pl-6 pointer-events-none text-gray-400">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/>
                        </svg>
                    </div>
                </div>

                <!-- Textarea -->
                <div class="col-span-1 md:col-span-2">
                    <textarea name="message"
                        placeholder="<?php esc_attr_e('متن پیام', 'royesh'); ?>"
                        class="bg-white w-full px-6 py-4 rounded-[24px] text-sm text-gray-700 placeholder-gray-400 border border-[#E2DDD4] focus:outline-none focus:ring-2 focus:ring-[#004F40]/20 transition-all resize-none h-32 font-sans"
                    ></textarea>
                </div>

                <!-- Feedback Alert Container -->
                <div id="royesh-home-contact-feedback" class="hidden col-span-1 md:col-span-2 p-4 rounded-2xl text-sm font-sans my-1"></div>

                <!-- Math CAPTCHA & Submit Button Row -->
                <div class="col-span-1 md:col-span-2 flex flex-col sm:flex-row items-stretch sm:items-center gap-3 mt-1.5">
                    <!-- Compact Math CAPTCHA Pill -->
                    <div class="w-full sm:w-auto flex items-center justify-between sm:justify-start gap-2.5 bg-white px-4 py-2.5 rounded-full border border-[#E2DDD4] shadow-sm">
                        <span class="text-xs font-bold text-[#004F40] whitespace-nowrap" id="royesh-captcha-question-home"><?php echo esc_html($captcha['question']); ?></span>
                        <span class="text-gray-400 font-bold text-xs">=</span>
                        <input
                            type="number"
                            name="captcha_answer"
                            id="royesh-captcha-answer-home"
                            class="w-14 h-8 text-center bg-[#FAF8F4] border border-[#E2DDD4] rounded-lg text-sm font-bold text-gray-800 focus:outline-none focus:border-[#004F40]"
                            required
                            min="0"
                            max="18"
                            placeholder="؟"
                            autocomplete="off"
                        />
                        <button type="button" class="text-gray-400 hover:text-[#004F40] transition-colors p-1"
                            id="royesh-captcha-refresh-home"
                            title="<?php esc_attr_e('سوال جدید', 'royesh'); ?>"
                            aria-label="<?php esc_attr_e('دریافت سوال جدید', 'royesh'); ?>">
                            <svg class="w-4 h-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                <path d="M23 4v6h-6"/><path d="M1 20v-6h6"/>
                                <path d="M3.51 9a9 9 0 0 1 14.85-3.36L23 10M1 14l4.64 4.36A9 9 0 0 0 20.49 15"/>
                            </svg>
                        </button>
                    </div>

                    <!-- Submit Button -->
                    <button type="submit"
                        class="w-full sm:flex-1 bg-[#004F40] hover:bg-[#003b30] text-white font-bold py-3.5 px-8 rounded-full transition-all duration-300 hover:scale-[1.01] shadow-md cursor-pointer text-sm font-sans flex items-center justify-center gap-2">
                        <span><?php esc_html_e('ثبت درخواست', 'royesh'); ?></span>
                        <svg class="w-4 h-4 -rotate-90" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M19 9l-7 7-7-7" />
                        </svg>
                    </button>
                </div>
            </form>
        </div>

        <!-- LEFT COLUMN: Text & Image -->
        <div class="flex flex-col items-start text-right w-full v-reveal v-reveal-fade-left order-1 lg:order-2">
            <div class="bg-[#F2EBE1] text-[#333333] text-sm font-bold px-5 py-2 rounded-full mb-6 font-sans">
                <?php echo esc_html($badge); ?>
            </div>

            <h2 class="text-3xl md:text-4xl font-extrabold text-[#080206] leading-snug mb-4 font-heading text-right">
                <?php echo esc_html($title_1); ?> <span class="text-[#004F40]"><?php echo esc_html($title_2); ?></span> <?php echo esc_html($title_3); ?>
            </h2>

            <p class="text-gray-600 text-sm md:text-[15px] font-light leading-relaxed mb-8 text-justify font-sans">
                <?php echo esc_html($desc); ?>
            </p>

            <div class="w-full relative overflow-hidden rounded-[32px] group">
                <img
                    src="<?php echo esc_url($bg_image); ?>"
                    alt="<?php esc_attr_e('مشاوره و خدمات مالی سفارشی', 'royesh'); ?>"
                    class="w-full h-[220px] object-cover transition-transform duration-700 group-hover:scale-105"
                />
                <div class="absolute inset-0 bg-gradient-to-t from-black/25 via-transparent to-transparent pointer-events-none"></div>
            </div>
        </div>

    </div>
</section>

<script>
(function () {
    // رفرش کپچا با AJAX
    document.getElementById('royesh-captcha-refresh-home')?.addEventListener('click', function () {
        var btn = this;
        btn.style.pointerEvents = 'none';
        btn.style.opacity = '0.5';

        fetch('<?php echo esc_url(admin_url('admin-ajax.php')); ?>', {
            method: 'POST',
            headers: { 'Content-Type': 'application/x-www-form-urlencoded' },
            body: new URLSearchParams({
                action: 'royesh_new_captcha',
                nonce:  '<?php echo esc_js(wp_create_nonce('royesh_nonce_action')); ?>'
            })
        })
        .then(r => r.json())
        .then(data => {
            if (data.success) {
                document.getElementById('royesh-captcha-question-home').textContent = data.data.question;
                document.getElementById('royesh-captcha-token-home').value          = data.data.token;
                document.getElementById('royesh-captcha-answer-home').value         = '';
                document.getElementById('royesh-captcha-answer-home').focus();
            }
        })
        .finally(() => {
            btn.style.pointerEvents = '';
            btn.style.opacity = '';
        });
    });
})();
</script>
