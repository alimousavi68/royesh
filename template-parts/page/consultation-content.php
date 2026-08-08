<?php
/**
 * Consultation Page Content Template Part
 * 
 * @package Royesh
 * @version 1.2.0
 */

if (!defined('ABSPATH')) {
    exit; // Exit if accessed directly
}

$post_id = get_the_ID();

// مقادیر پویا از متاباکس برگه
$hero_enable  = royesh_get_page_meta($post_id, '_royesh_hero_enable', '1');
$hero_badge   = royesh_get_page_meta($post_id, '_royesh_hero_badge', __('همگام با نیازهای شما', 'royesh'));
$hero_title   = royesh_get_page_meta($post_id, '_royesh_hero_title', get_the_title());
$hero_desc    = royesh_get_page_meta($post_id, '_royesh_hero_desc', __('برای دریافت مشاوره اختصاصی مالی، فرم زیر را پر کنید. کارشناسان ما در کوتاه‌ترین زمان با شما تماس خواهند گرفت.', 'royesh'));
$hero_bg      = royesh_get_page_meta($post_id, '_royesh_hero_bg_color', '#004F40');

$cns_btn_text = royesh_get_page_meta($post_id, '_royesh_cns_btn_text', __('ثبت نهایی درخواست مشاوره', 'royesh'));
$cns_badge    = royesh_get_page_meta($post_id, '_royesh_cns_side_badge', __('خدمات مشاوره حرفه‌ای', 'royesh'));
$cns_title    = royesh_get_page_meta($post_id, '_royesh_cns_side_title', __('چرا مشاوره با رویش سرمایه؟', 'royesh'));
$cns_desc     = royesh_get_page_meta($post_id, '_royesh_cns_side_desc', __('ما در گروه رویش به دنبال روابط طولانی‌مدت و خلق ارزش واقعی هستیم. پس از ثبت درخواست، پرونده شما مستقیماً توسط یکی از کارشناسان خبره ما تحلیل شده و در کوتاه‌ترین زمان با شما ارتباط برقرار خواهد شد.', 'royesh'));

$feat_1_t     = royesh_get_page_meta($post_id, '_royesh_cns_feat_1_t', __('تماس در کمتر از ۲۴ ساعت', 'royesh'));
$feat_1_d     = royesh_get_page_meta($post_id, '_royesh_cns_feat_1_d', __('کارشناسان ما به محض دریافت فرم، بررسی اولیه را انجام داده و با شما تماس می‌گیرند.', 'royesh'));

$feat_2_t     = royesh_get_page_meta($post_id, '_royesh_cns_feat_2_t', __('محرمانگی و امنیت اطلاعات', 'royesh'));
$feat_2_d     = royesh_get_page_meta($post_id, '_royesh_cns_feat_2_d', __('تمام اطلاعات مالی، ایده ها و اسناد تجاری شما به عنوان راز تجاری نزد ما محفوظ خواهد ماند.', 'royesh'));

// تولید کد امنیتی ریاضی
$captcha = royesh_generate_captcha();
?>

<?php if ($hero_enable !== '0') : ?>
<!-- HERO SECTION -->
<section class="relative w-full py-16 px-4 md:px-12 overflow-hidden border-b border-[#2E7063] bg-[#004F40]" style="background-color: <?php echo esc_attr(!empty($hero_bg) && $hero_bg !== '#ffffff' ? $hero_bg : '#004F40'); ?>;">
    <div class="absolute inset-0 opacity-100 pointer-events-none select-none z-0">
        <img src="<?php echo royesh_asset_img('bg vector patt.svg'); ?>" alt="Pattern" class="w-full h-full object-cover" />
    </div>
    <div class="absolute top-[10%] left-[10%] w-[350px] h-[350px] rounded-full bg-[#2E7063]/25 blur-[100px] pointer-events-none z-0"></div>
    <div class="absolute bottom-[5%] right-[5%] w-[250px] h-[250px] rounded-full bg-[#B1862D]/10 blur-[80px] pointer-events-none z-0"></div>

    <div class="max-w-[1150px] mx-auto relative z-10 text-center text-white">
        <span class="text-[#B1862D] text-sm md:text-base font-bold tracking-wider block mb-3 font-sans"><?php echo esc_html($hero_badge); ?></span>
        <h1 class="text-3xl md:text-5xl font-black leading-tight mb-4"><?php echo esc_html($hero_title); ?></h1>
        <p class="text-white/80 text-base md:text-lg max-w-2xl mx-auto leading-relaxed font-light font-sans">
            <?php echo esc_html($hero_desc); ?>
        </p>
    </div>
</section>
<?php endif; ?>

<!-- FORM & INFO SECTION -->
<section class="w-full py-20 px-4 md:px-12 relative">
    <div class="max-w-[1150px] mx-auto grid grid-cols-1 lg:grid-cols-12 gap-12 items-start">
        
        <!-- RIGHT COLUMN: Premium Consultation Form -->
        <div class="lg:col-span-7 bg-[#F3ECE3] rounded-[32px] p-6 md:p-8 relative overflow-hidden shadow-sm border border-[#E5DDD0] w-full v-reveal v-reveal-fade-right">
            <div class="absolute -right-20 -top-20 w-64 h-64 rounded-full bg-[#004F40]/5 blur-3xl pointer-events-none"></div>

            <form id="royesh-consultation-form" class="grid grid-cols-1 md:grid-cols-2 gap-y-4 gap-x-4 relative z-10">
                <?php wp_nonce_field('royesh_nonce_action', 'royesh_consultation_nonce'); ?>

                <!-- Honeypot -->
                <div style="display:none;" aria-hidden="true">
                    <input type="text" name="website_hp" tabindex="-1" autocomplete="off" />
                </div>

                <!-- Captcha Token -->
                <input type="hidden" name="captcha_token" id="royesh-captcha-token-consult" value="<?php echo esc_attr($captcha['token']); ?>" />

                <div class="col-span-1">
                    <label class="block text-xs font-bold text-gray-700 mb-2 font-sans"><?php esc_html_e('نام و نام خانوادگی *', 'royesh'); ?></label>
                    <input type="text" name="fullname" required placeholder="<?php esc_attr_e('مثال: علی علوی', 'royesh'); ?>" class="bg-white w-full px-5 py-3.5 rounded-full text-sm text-gray-700 placeholder-gray-400 border border-[#E2DDD4] focus:outline-none focus:ring-2 focus:ring-[#004F40]/20 font-sans" />
                </div>

                <div class="col-span-1">
                    <label class="block text-xs font-bold text-gray-700 mb-2 font-sans"><?php esc_html_e('شماره تماس *', 'royesh'); ?></label>
                    <input type="text" name="phone" required placeholder="<?php esc_attr_e('مثال: ۰۹۱۲۳۴۵۶۷۸۹', 'royesh'); ?>" class="bg-white w-full px-5 py-3.5 rounded-full text-sm text-gray-700 placeholder-gray-400 border border-[#E2DDD4] focus:outline-none focus:ring-2 focus:ring-[#004F40]/20 font-sans" />
                </div>

                <div class="col-span-1">
                    <label class="block text-xs font-bold text-gray-700 mb-2 font-sans"><?php esc_html_e('ایمیل', 'royesh'); ?></label>
                    <input type="email" name="email" placeholder="<?php esc_attr_e('مثال: info@royesh.com', 'royesh'); ?>" class="bg-white w-full px-5 py-3.5 rounded-full text-sm text-gray-700 placeholder-gray-400 border border-[#E2DDD4] focus:outline-none focus:ring-2 focus:ring-[#004F40]/20 font-sans" />
                </div>

                <div class="col-span-1">
                    <label class="block text-xs font-bold text-gray-700 mb-2 font-sans"><?php esc_html_e('نام شرکت / سازمان', 'royesh'); ?></label>
                    <input type="text" name="company" placeholder="<?php esc_attr_e('مثال: شرکت رویش', 'royesh'); ?>" class="bg-white w-full px-5 py-3.5 rounded-full text-sm text-gray-700 placeholder-gray-400 border border-[#E2DDD4] focus:outline-none focus:ring-2 focus:ring-[#004F40]/20 font-sans" />
                </div>

                <div class="col-span-1 md:col-span-2 relative">
                    <label class="block text-xs font-bold text-gray-700 mb-2 font-sans"><?php esc_html_e('موضوع مشاوره *', 'royesh'); ?></label>
                    <select name="subject" required class="bg-white w-full px-5 py-3.5 rounded-full text-sm text-gray-700 placeholder-gray-400 border border-[#E2DDD4] focus:outline-none focus:ring-2 focus:ring-[#004F40]/20 appearance-none font-sans cursor-pointer">
                        <option value="" disabled selected hidden><?php esc_html_e('یک مورد را انتخاب کنید', 'royesh'); ?></option>
                        <option value="financing"><?php esc_html_e('خدمات تأمین مالی', 'royesh'); ?></option>
                        <option value="credit"><?php esc_html_e('خدمات اعتباری', 'royesh'); ?></option>
                        <option value="liquidity"><?php esc_html_e('مدیریت نقدینگی', 'royesh'); ?></option>
                        <option value="asset"><?php esc_html_e('مدیریت دارایی', 'royesh'); ?></option>
                        <option value="other"><?php esc_html_e('سایر موارد', 'royesh'); ?></option>
                    </select>
                </div>

                <div class="col-span-1 md:col-span-2">
                    <label class="block text-xs font-bold text-gray-700 mb-2 font-sans"><?php esc_html_e('جزئیات و توضیحات درخواست *', 'royesh'); ?></label>
                    <textarea name="message" required placeholder="<?php esc_attr_e('لطفاً خلاصه چالش یا موضوع مورد نیاز خود را شرح دهید...', 'royesh'); ?>" class="bg-white w-full px-5 py-3.5 rounded-[24px] text-sm text-gray-700 placeholder-gray-400 border border-[#E2DDD4] focus:outline-none focus:ring-2 focus:ring-[#004F40]/20 resize-none h-32 font-sans"></textarea>
                </div>

                <!-- Math CAPTCHA -->
                <div class="col-span-1 md:col-span-2">
                    <label class="block text-xs font-bold text-gray-700 mb-2 font-sans">
                        <?php esc_html_e('کد امنیتی *', 'royesh'); ?>
                    </label>
                    <div class="royesh-captcha-row flex items-center gap-3 flex-wrap">
                        <span class="royesh-captcha-question bg-[#FAF8F4] border border-[#E2DDD4] px-4 py-3 rounded-full text-sm font-bold text-[#004F40] min-w-[70px] text-center" id="royesh-captcha-question-consult" dir="ltr">
                            <?php echo esc_html($captcha['question']); ?>
                        </span>
                        <input type="text"
                               name="captcha_answer"
                               id="royesh-captcha-answer-consult"
                               class="royesh-captcha-input bg-white w-28 px-4 py-3.5 rounded-full text-sm text-gray-700 text-center border border-[#E2DDD4] focus:outline-none focus:ring-2 focus:ring-[#004F40]/20 font-sans"
                               placeholder="؟"
                               required
                               inputmode="numeric"
                               autocomplete="off" />
                        <button type="button"
                                class="royesh-captcha-refresh flex items-center gap-1.5 px-4 py-3 bg-white border border-[#E2DDD4] hover:border-[#004F40] rounded-full text-xs text-gray-600 hover:text-[#004F40] transition-colors cursor-pointer"
                                id="royesh-captcha-refresh-consult"
                                title="<?php esc_attr_e('کد جدید', 'royesh'); ?>"
                                aria-label="<?php esc_attr_e('کد جدید', 'royesh'); ?>">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15"></path></svg>
                            <span class="font-sans"><?php esc_html_e('تغییر کد', 'royesh'); ?></span>
                        </button>
                    </div>
                </div>

                <!-- Inline Feedback Alert Box -->
                <div id="royesh-consultation-feedback" class="col-span-1 md:col-span-2 hidden p-4 rounded-2xl text-sm font-sans" role="alert"></div>

                <div class="col-span-1 md:col-span-2">
                    <button type="submit" class="w-full bg-[#B1862D] hover:bg-[#9c7524] text-white font-bold py-4 rounded-full transition-all duration-300 shadow-md cursor-pointer font-sans">
                        <?php echo esc_html($cns_btn_text); ?>
                    </button>
                </div>
            </form>
        </div>

        <!-- LEFT COLUMN -->
        <div class="lg:col-span-5 flex flex-col text-right items-start v-reveal v-reveal-fade-left">
            <div class="bg-[#FAF8F4] border border-[#E5DDD0] text-[#333333] text-xs font-bold px-4 py-2 rounded-full mb-6 font-sans">
                <?php echo esc_html($cns_badge); ?>
            </div>

            <h2 class="text-2xl md:text-3xl font-extrabold text-[#014235] leading-snug mb-4 font-heading text-right">
                <?php echo esc_html($cns_title); ?>
            </h2>

            <p class="text-gray-600 text-sm leading-relaxed mb-8 text-justify font-sans">
                <?php echo nl2br(esc_html($cns_desc)); ?>
            </p>

            <div class="flex flex-col gap-6 w-full">
                <div class="flex items-start gap-4">
                    <div class="w-10 h-10 rounded-xl bg-[#FAF8F4] border border-[#B1862D]/10 flex items-center justify-center text-[#B1862D] shadow-sm shrink-0">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                    </div>
                    <div>
                        <h3 class="text-sm font-bold text-black mb-1 font-sans"><?php echo esc_html($feat_1_t); ?></h3>
                        <p class="text-xs text-gray-500 font-sans leading-relaxed"><?php echo nl2br(esc_html($feat_1_d)); ?></p>
                    </div>
                </div>

                <div class="flex items-start gap-4">
                    <div class="w-10 h-10 rounded-xl bg-[#FAF8F4] border border-[#B1862D]/10 flex items-center justify-center text-[#B1862D] shadow-sm shrink-0">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"></path></svg>
                    </div>
                    <div>
                        <h3 class="text-sm font-bold text-black mb-1 font-sans"><?php echo esc_html($feat_2_t); ?></h3>
                        <p class="text-xs text-gray-500 font-sans leading-relaxed"><?php echo nl2br(esc_html($feat_2_d)); ?></p>
                    </div>
                </div>
            </div>
        </div>

    </div>
</section>
