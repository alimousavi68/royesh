# قالب Royesh — گروه اقتصادی رویش سرمایه

**نسخه:** 2.0.0  
**حداقل وردپرس:** 6.4  
**حداقل PHP:** 8.1  
**Text Domain:** `royesh`

---

## ساختار فایل‌ها

```
royesh-theme/
├── front-page.php          صفحه اصلی
├── single.php              نمای تک مقاله
├── archive.php / home.php  آرشیو اخبار
├── page-about.php          درباره ما
├── page-services.php       خدمات
├── page-contact.php        تماس با ما
├── page-consultation.php   درخواست مشاوره
├── header.php / footer.php هدر و فوتر مشترک
├── functions.php           نقطه ورود هسته تم
├── includes/
│   ├── setup.php           ثبت theme support، منوها، image sizes
│   ├── enqueue.php         بارگذاری CSS/JS/Fonts (همه محلی)
│   ├── customizer.php      تنظیمات Customizer
│   ├── customizer-controls.php  کنترل‌های سفارشی Customizer
│   ├── ajax-handlers.php   پردازشگرهای فرم تماس، مشاوره و خبرنامه
│   ├── security.php        Rate limiting، Nonce helpers
│   ├── sidebars.php        ثبت Widget Areas
│   ├── helpers.php         توابع کمکی
│   └── template-tags.php   توابع template
├── template-parts/
│   ├── front-page/         سکشن‌های صفحه اصلی
│   ├── page/               قالب‌های صفحات داخلی
│   ├── single/             قالب مقاله تکی
│   ├── archive/            کارت‌های لیست اخبار
│   └── global/             topbar و المان‌های مشترک
└── assets/
    ├── css/
    │   ├── tailwind.css        خروجی build Tailwind (محلی)
    │   ├── style.css           استایل اصلی + فونت‌های محلی
    │   ├── swiper-bundle.min.css  کتابخانه Swiper (محلی)
    │   └── tilt-warp.css       فونت Tilt Warp (محلی)
    ├── js/
    │   ├── main.js             اسکریپت اصلی تعاملی
    │   └── swiper-bundle.min.js  کتابخانه Swiper (محلی)
    ├── fonts/                  فونت‌های محلی (YekanBakh, Peyda, TiltWarp)
    └── images/                 تصاویر قالب
```

---

## بارگذاری Tailwind CSS

این قالب از **Tailwind CSS** با build محلی استفاده می‌کند (نه Play CDN).

### دستور build:
```bash
cd royesh-theme
npm install
npm run build:css
```

> **مهم:** هر بار که کلاس Tailwind جدیدی اضافه شد، دستور build را مجدداً اجرا کنید.

---

## مدیریت محتوا از Customizer

**مسیر:** Appearance > Customize

| بخش | محتوای قابل ویرایش |
|---|---|
| هیرو صفحه اصلی | عنوان، زیرعنوان، دکمه CTA، تصویر |
| حوزه‌های خلق ارزش | عنوان، ویدیو، ۳ کارت |
| خدمات | عنوان، ۴ خدمت با آیکون |
| فلسفه برند | عنوان، متن، تصاویر |
| بنر CTA | عنوان، متن، دکمه، تصویر زمینه |
| اطلاعات تماس | آدرس، تلفن، ایمیل، مختصات نقشه |
| هدر | لوگو، آیکون‌های ناوبری |
| فوتر | لوگو، ستون‌ها، منوها |
| شبکه‌های اجتماعی | تلگرام، لینکدین، اینستاگرام |

---

## پیکربندی وردپرس لازم

۱. **Settings > Reading:**
   - `Your homepage displays` → `A static page`
   - `Homepage` → صفحه «خانه»
   - `Posts page` → صفحه «اخبار» (slug: `news`)

۲. **Appearance > Menus:** ایجاد منوی ناوبری هدر

---

## پیش‌نیازهای سرور

- PHP 8.1+
- WordPress 6.4+
- برای ارسال فرم: پلاگین SMTP (توصیه: WP Mail SMTP)

---

## امنیت

- فرم‌ها: `wp_nonce_field()` + Honeypot + Rate Limiting (۳ ارسال / ۱۵ دقیقه)
- خروجی‌ها: `esc_html()`, `esc_attr()`, `esc_url()`, `wp_kses_post()`
- همه include ها: `defined('ABSPATH') || exit;`
- مختصات نقشه از Customizer خوانده می‌شود (نه hardcode در JS)
