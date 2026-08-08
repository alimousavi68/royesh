<?php
/**
 * Main Header Template
 * 
 * @package Royesh
 * @version 1.0.0
 */

if (!defined('ABSPATH')) {
    exit;
}

// ── تشخیص صفحه فعال ───────────────────────────────────────
$current_path = isset($_SERVER['REQUEST_URI']) ? parse_url(esc_url_raw(wp_unslash($_SERVER['REQUEST_URI'])), PHP_URL_PATH) : '/';
$current_path = rtrim($current_path, '/') ?: '/';

// ── خواندن آیتم‌های منو از Customizer ────────────────────
$_raw_nav   = get_theme_mod('royesh_nav_items', '');
$_nav_items = [];
if (!empty($_raw_nav)) {
    $_decoded = json_decode(stripslashes($_raw_nav), true);
    if (is_array($_decoded)) {
        $_nav_items = array_values(array_filter($_decoded, fn($i) => !empty($i['enabled'])));
    }
}
// fallback به آیتم‌های پیش‌فرض اگر خالی باشد یا آیتم خانه در آن نباشد
if (empty($_nav_items)) {
    $_nav_items = [
        ['label' => 'خانه',       'url' => home_url('/'),         'enabled' => true, 'icon_type' => 'img', 'icon_src' => royesh_asset_img('r-home.svg'),     'match_path' => '/'],
        ['label' => 'خدمات',      'url' => home_url('/services'), 'enabled' => true, 'icon_type' => 'img', 'icon_src' => royesh_asset_img('r-services.svg'), 'match_path' => '/services'],
        ['label' => 'اخبار',      'url' => home_url('/news'),     'enabled' => true, 'icon_type' => 'img', 'icon_src' => royesh_asset_img('r-news.svg'),     'match_path' => '/news'],
        ['label' => 'درباره ما',  'url' => home_url('/about'),    'enabled' => true, 'icon_type' => 'img', 'icon_src' => royesh_asset_img('r-about.svg'),    'match_path' => '/about'],
        ['label' => 'تماس با ما', 'url' => home_url('/contact'),  'enabled' => true, 'icon_type' => 'img', 'icon_src' => royesh_asset_img('r-contacts.svg'), 'match_path' => '/contact'],
    ];
} else {
    // اگر آیتم خانه در منوی سفارشی تعریف نشده بود، آن را در ابتدای لیست درج کن
    $has_home = false;
    foreach ($_nav_items as $item) {
        if (($item['label'] ?? '') === 'خانه' || ($item['match_path'] ?? '') === '/' || ($item['url'] ?? '') === '/' || ($item['url'] ?? '') === home_url('/')) {
            $has_home = true;
            break;
        }
    }
    if (!$has_home) {
        array_unshift($_nav_items, [
            'label'      => 'خانه',
            'url'        => home_url('/'),
            'enabled'    => true,
            'icon_type'  => 'img',
            'icon_src'   => royesh_asset_img('r-home.svg'),
            'match_path' => '/',
        ]);
    }
}

// ── رنگ‌های منوی هدر از Customizer ──────────────────────
$_nav_c_normal      = get_theme_mod('royesh_nav_color_normal',      '#374151');
$_nav_c_normal_icon = get_theme_mod('royesh_nav_color_normal_icon', '#374151');
$_nav_bg_normal     = get_theme_mod('royesh_nav_bg_normal',         'transparent');
$_nav_c_hover       = get_theme_mod('royesh_nav_color_hover',       '#014235');
$_nav_c_hover_icon  = get_theme_mod('royesh_nav_color_hover_icon',  '#014235');
$_nav_bg_hover      = get_theme_mod('royesh_nav_bg_hover',          '#E8E2D2');
$_nav_c_active      = get_theme_mod('royesh_nav_color_active',      '#014235');
$_nav_c_active_icon = get_theme_mod('royesh_nav_color_active_icon', '#014235');
$_nav_bg_active     = get_theme_mod('royesh_nav_bg_active',         '#E8E2D2');

// ── تابع کمکی: رندر آیکون ────────────────────────────────
function royesh_render_nav_icon(array $item, int $size = 18): string {
    $type = $item['icon_type'] ?? 'img';
    $src  = $item['icon_src']  ?? '';
    if ($type === 'svg' && !empty($src)) {
        return '<span class="v-nav-icon" style="width:' . $size . 'px;height:' . $size . 'px;display:inline-flex;align-items:center;justify-content:center">' . $src . '</span>';
    } elseif (!empty($src)) {
        return '<img src="' . esc_url($src) . '" alt="" class="v-nav-icon w-[18px] h-[18px] object-contain transition-all duration-300 ease-in-out" style="width:' . $size . 'px;height:' . $size . 'px" />';
    }
    return '';
}

// ── تابع کمکی: تبدیل لینک به URL معتبر وردپرس ───────────
function royesh_resolve_nav_url(string $url): string {
    $url = trim($url);
    if (empty($url) || $url === '/' || $url === '#') {
        return home_url('/');
    }
    if (str_starts_with($url, 'http://') || str_starts_with($url, 'https://') || str_starts_with($url, 'tel:') || str_starts_with($url, 'mailto:')) {
        return $url;
    }
    return home_url('/' . ltrim($url, '/'));
}

$is_index    = is_front_page();
$is_services = is_page('services');
$is_about    = is_page('about');
$is_news     = (is_home() || is_archive() || is_singular('post') || is_page('news'));
$is_contact  = is_page('contact');
?>
<!DOCTYPE html>
<html <?php language_attributes(); ?> dir="rtl">
<head>
    <meta charset="<?php bloginfo('charset'); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <?php wp_head(); ?>
</head>
<body <?php body_class('min-h-screen bg-white flex flex-col font-sans select-none transition-all duration-200'); ?> dir="rtl">
<?php wp_body_open(); ?>

<?php get_template_part('template-parts/global/topbar'); ?>

<!-- Main Header Container -->
<header id="v-main-header" dir="rtl" class="w-full bg-[#F5F4EE] relative select-none z-40 h-[83px] md:h-[83px] px-4 md:px-12 border-b border-[#DED6CA] flex items-center">
    <div class="max-w-[1440px] mx-auto w-full flex items-center justify-between">
        
        <!-- RIGHT PACKAGE: Logo + Vertical Divider + Header Navigation -->
        <div id="v-header-right-package" class="flex items-center gap-2">
            <?php 
                $logo_height = get_theme_mod('royesh_logo_height', '58');
            ?>
            <!-- Logo link / Wrapper -->
            <?php if (has_custom_logo()) : ?>
                <div class="flex items-center focus:outline-none v-header-animate max-w-[175px] overflow-hidden" style="max-height: <?php echo esc_attr($logo_height + 4); ?>px" data-delay="50" id="v-logo-wrapper">
                    <?php the_custom_logo(); ?>
                </div>
            <?php else : ?>
                <a href="<?php echo esc_url(home_url('/')); ?>" class="flex items-center focus:outline-none v-header-animate max-w-[175px]" style="max-height: <?php echo esc_attr($logo_height + 4); ?>px" data-delay="50" id="v-logo-link">
                    <img src="<?php echo royesh_asset_img('royesh_logo.webp'); ?>" alt="<?php echo esc_attr(get_bloginfo('name')); ?>" class="w-[145px] h-auto object-contain" style="max-height: <?php echo esc_attr($logo_height); ?>px" id="v-logo-img" />
                </a>
            <?php endif; ?>
            
            <!-- Thin Vertical Divider Line (Desktop only) -->
            <div id="v-logo-divider" class="hidden lg:block border-l border-[#DED6CA] h-8 mx-3 v-header-animate" data-delay="100"></div>
            
            <!-- CENTER: Navigation Links -->
            <?php
            // ── inline CSS برای حالت‌های Hover و Active ──────────────────
            $nav_css = sprintf(
                '<style id="royesh-nav-styles">
                    .v-nav-link { color: %1$s; background: %2$s; transition: all 0.3s ease-in-out; }
                    .v-nav-link img.v-nav-icon, .v-nav-link span.v-nav-icon svg { filter: none; opacity:0.9; }
                    .v-nav-link:hover { color: %3$s !important; background: %4$s !important; }
                    .v-nav-link.v-nav--active { color: %5$s !important; background: %6$s !important; font-weight:700; }
                </style>',
                esc_attr($_nav_c_normal),
                esc_attr($_nav_bg_normal),
                esc_attr($_nav_c_hover),
                esc_attr($_nav_bg_hover),
                esc_attr($_nav_c_active),
                esc_attr($_nav_bg_active)
            );
            echo $nav_css;
            ?>
            <nav id="v-header-nav" class="hidden lg:flex items-center">
                <ul class="flex items-center gap-1.5 text-[16px] font-medium">
                    <?php
                    $delay = 150;
                    foreach (array_values($_nav_items) as $idx => $nav_item) :
                        $item_label = $nav_item['label'] ?? '';
                        $item_url   = !empty($nav_item['url']) ? $nav_item['url'] : home_url('/');
                        $item_match = rtrim($nav_item['match_path'] ?? $nav_item['url'] ?? '', '/') ?: '/';
                        
                        // تشخیص فعال بودن آیتم
                        $is_home_btn = ($item_label === 'خانه' || $item_match === '/' || $item_match === '' || $item_url === '/' || $item_url === '#' || $item_url === home_url('/'));
                        if ($is_index && $is_home_btn) {
                            $is_active = true;
                            $link_href = '#';
                        } elseif (!$is_index && $is_home_btn) {
                            $is_active = false;
                            $link_href = esc_url(home_url('/'));
                        } elseif ($is_services && (str_contains($item_match, 'services') || $item_label === 'خدمات')) {
                            $is_active = true;
                            $link_href = esc_url($item_url);
                        } elseif ($is_news && (str_contains($item_match, 'news') || $item_label === 'اخبار')) {
                            $is_active = true;
                            $link_href = esc_url($item_url);
                        } elseif ($is_about && (str_contains($item_match, 'about') || $item_label === 'درباره ما')) {
                            $is_active = true;
                            $link_href = esc_url($item_url);
                        } elseif ($is_contact && (str_contains($item_match, 'contact') || $item_label === 'تماس با ما')) {
                            $is_active = true;
                            $link_href = esc_url($item_url);
                        } else {
                            $is_active = ($current_path === $item_match || ($item_match !== '/' && str_starts_with($current_path, $item_match)));
                            $link_href = esc_url($item_url);
                        }

                        $active_cls = $is_active ? ' v-nav--active' : '';
                        $link_id    = 'v-nav-item-' . $idx;
                    ?>
                    <?php if ($idx > 0) : ?>
                        <li class="text-[#DED6CA] mx-1 v-header-animate" data-delay="<?php echo $delay - 30; ?>">|</li>
                    <?php endif; ?>
                    <li class="flex items-center v-header-animate" data-delay="<?php echo $delay; ?>">
                        <a href="<?php echo $link_href; ?>" id="<?php echo esc_attr($link_id); ?>"
                           class="v-nav-link flex items-center gap-2 px-4 py-2 rounded-full transform transition-all duration-300 ease-in-out hover:scale-105<?php echo $active_cls; ?>">
                            <?php echo royesh_render_nav_icon($nav_item, 18); ?>
                            <span><?php echo esc_html($item_label); ?></span>
                        </a>
                    </li>
                    <?php
                        $delay += 60;
                    endforeach;
                    ?>
                </ul>
            </nav>
        </div>

        <!-- LEFT SIDE: CTA Button -->
        <div id="v-header-left" class="hidden lg:flex items-center">
            <a href="<?php echo esc_url(royesh_consultation_url()); ?>" id="v-cta-button" class="v-header-animate flex items-center gap-2 bg-[#B1862D] text-white rounded-[15px] px-6 py-3 text-[16px] transition-all duration-300 hover:bg-[#9c7524] hover:scale-[1.03] shadow-sm font-bold cursor-pointer" data-delay="450">
                <img src="<?php echo royesh_asset_img('r-consultion.svg'); ?>" alt="<?php esc_attr_e('درخواست مشاوره', 'royesh'); ?>" class="w-5 h-5" />
                <span><?php esc_html_e('درخواست مشاوره', 'royesh'); ?></span>
            </a>
        </div>

        <!-- MOBILE HAMBURGER BUTTON -->
        <div id="v-hamburger-container" class="block lg:hidden v-header-animate" data-delay="150">
            <button id="v-hamburger-btn" class="p-2 text-gray-800 hover:bg-gray-200/50 rounded-lg transition-all focus:outline-none" aria-label="<?php esc_attr_e('منوی ناوبری', 'royesh'); ?>">
                <svg id="v-hamburger-icon" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="w-6 h-6 transition-all duration-200">
                    <line x1="4" x2="20" y1="12" y2="12" />
                    <line x1="4" x2="20" y1="6" y2="6" />
                    <line x1="4" x2="20" y1="18" y2="18" />
                </svg>
            </button>
        </div>

    </div>

    <!-- MOBILE MENU DRAWER OVERLAY -->
    <div id="v-mobile-menu" class="hidden absolute top-[calc(100%)] left-0 w-full bg-[#F5F4EE] border-t border-[#DED6CA] shadow-xl transition-all duration-300 origin-top transform scale-y-95 opacity-0 z-50">
        <ul class="flex flex-col p-5 gap-3.5 text-right font-medium">
            <?php foreach (array_values($_nav_items) as $midx => $mnav_item) :
                $m_label    = $mnav_item['label'] ?? '';
                $m_url      = !empty($mnav_item['url']) ? $mnav_item['url'] : home_url('/');
                $m_match    = rtrim($mnav_item['match_path'] ?? $mnav_item['url'] ?? '', '/') ?: '/';
                $m_is_home  = ($m_label === 'خانه' || $m_match === '/' || $m_match === '' || $m_url === '/' || $m_url === '#' || $m_url === home_url('/'));
                
                if ($is_index && $m_is_home) {
                    $m_active = true;
                    $m_href = '#';
                } elseif (!$is_index && $m_is_home) {
                    $m_active = false;
                    $m_href = esc_url(home_url('/'));
                } elseif ($is_services && (str_contains($m_match, 'services') || $m_label === 'خدمات')) {
                    $m_active = true;
                    $m_href = esc_url($m_url);
                } elseif ($is_news && (str_contains($m_match, 'news') || $m_label === 'اخبار')) {
                    $m_active = true;
                    $m_href = esc_url($m_url);
                } elseif ($is_about && (str_contains($m_match, 'about') || $m_label === 'درباره ما')) {
                    $m_active = true;
                    $m_href = esc_url($m_url);
                } elseif ($is_contact && (str_contains($m_match, 'contact') || $m_label === 'تماس با ما')) {
                    $m_active = true;
                    $m_href = esc_url($m_url);
                } else {
                    $m_active = ($current_path === $m_match || ($m_match !== '/' && str_starts_with($current_path, $m_match)));
                    $m_href = esc_url($m_url);
                }

                $m_cls = $m_active
                    ? 'v-nav-link v-nav--active flex items-center gap-3 px-4 py-3 rounded-xl transition-all'
                    : 'v-nav-link flex items-center gap-3 px-4 py-3 rounded-xl transition-all';
            ?>
            <li>
                <a href="<?php echo $m_href; ?>" class="<?php echo esc_attr($m_cls); ?>">
                    <?php echo royesh_render_nav_icon($mnav_item, 18); ?>
                    <span><?php echo esc_html($m_label); ?></span>
                </a>
            </li>
            <?php endforeach; ?>
            <li class="mt-4 pt-4 border-t border-[#DED6CA]">
                <a href="<?php echo esc_url(royesh_consultation_url()); ?>" class="w-full flex items-center justify-center gap-2 bg-[#B1862D] text-white rounded-[14px] py-3.5 text-sm font-semibold transition-all duration-300 hover:bg-[#9c7524] hover:scale-[1.03] cursor-pointer">
                    <span><?php esc_html_e('درخواست مشاوره', 'royesh'); ?></span>
                    <img src="<?php echo royesh_asset_img('r-contacts.svg'); ?>" alt="<?php esc_attr_e('درخواست مشاوره', 'royesh'); ?>" class="w-[24px] h-[24px]" />
                </a>
            </li>
        </ul>
    </div>
</header>
