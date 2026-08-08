/* ==========================================================================
   Royesh Economic Group - Unified JavaScript
   ========================================================================== */

(function () {
    document.addEventListener('DOMContentLoaded', function () {

        // 1. Mobile Hamburger Menu Drawer Toggle
        const hamburgerBtn = document.getElementById('v-hamburger-btn');
        const hamburgerIcon = document.getElementById('v-hamburger-icon');
        const mobileMenu = document.getElementById('v-mobile-menu');

        if (hamburgerBtn && mobileMenu && hamburgerIcon) {
            hamburgerBtn.addEventListener('click', function (e) {
                e.stopPropagation();
                const isHidden = mobileMenu.classList.contains('hidden');

                if (isHidden) {
                    // Open animation sequence
                    mobileMenu.classList.remove('hidden');
                    // Force reflow
                    mobileMenu.offsetHeight;
                    // Trigger styles
                    mobileMenu.classList.remove('scale-y-95', 'opacity-0');
                    mobileMenu.classList.add('scale-y-100', 'opacity-100');

                    // transform hamburger into an X
                    hamburgerIcon.innerHTML = `
                        <line x1="18" x2="6" y1="6" y2="18"></line>
                        <line x1="6" x2="18" y1="6" y2="18"></line>
                    `;
                } else {
                    closeMenu();
                }
            });

            // Close menu if user clicks outside
            document.addEventListener('click', function (e) {
                if (!mobileMenu.classList.contains('hidden')) {
                    const isClickInside = mobileMenu.contains(e.target) || hamburgerBtn.contains(e.target);
                    if (!isClickInside) {
                        closeMenu();
                    }
                }
            });

            function closeMenu() {
                mobileMenu.classList.remove('scale-y-100', 'opacity-100');
                mobileMenu.classList.add('scale-y-95', 'opacity-0');

                // Return hamburger to original state
                hamburgerIcon.innerHTML = `
                    <line x1="4" x2="20" y1="12" y2="12"></line>
                    <line x1="4" x2="20" y1="6" y2="6"></line>
                    <line x1="4" x2="20" y1="18" y2="18"></line>
                `;

                // Hide completely after transition completes
                setTimeout(() => {
                    if (mobileMenu.classList.contains('opacity-0')) {
                        mobileMenu.classList.add('hidden');
                    }
                }, 200); // Wait matches CSS duration-200
            }
        }

        // 1.5. Staggered load for the Header Elements
        const headerAnimates = document.querySelectorAll('.v-header-animate');
        headerAnimates.forEach(function (element) {
            const delay = element.getAttribute('data-delay') || 0;
            setTimeout(function () {
                element.classList.add('v-active');
            }, parseInt(delay));
        });

        // 2. Staggered load for the Hero Content (tagline, title, description, actions)
        const heroFaders = document.querySelectorAll('.v-hero-fade');
        heroFaders.forEach(function (element, index) {
            setTimeout(function () {
                element.classList.add('v-active');
            }, 100 + (index * 150)); // smooth spacing
        });

        // 3. Trigger Features Bar Slide Up after Hero finishes initial load
        const featuresBar = document.getElementById('v-features-bar');
        if (featuresBar) {
            setTimeout(function () {
                featuresBar.classList.add('v-active');

                // Sequential load of individual feature items from Right to Left (staggered)
                const featureItems = document.querySelectorAll('.v-feature-item');
                featureItems.forEach(function (item, index) {
                    setTimeout(function () {
                        item.classList.add('v-active');
                    }, 200 + (index * 130)); // premium responsive delay spacing
                });

            }, 800); // delays perfectly matching hero layout sequence
        }

        // 4. Initialize Swiper Slider (Blog/News Section)
        if (document.querySelector('.blog-swiper')) {
            const swiper = new Swiper('.blog-swiper', {
                slidesPerView: 1,
                centeredSlides: true,
                loop: false,
                initialSlide: 0,
                spaceBetween: 20,
                autoplay: {
                    delay: 3000,
                    disableOnInteraction: false,
                },
                pagination: {
                    el: '.swiper-pagination',
                    clickable: true,
                },
                navigation: {
                    nextEl: '.swiper-btn-next',
                    prevEl: '.swiper-btn-prev',
                },
                breakpoints: {
                    640: {
                        slidesPerView: 1.5,
                        spaceBetween: 30,
                        centeredSlides: true,
                    },
                    1024: {
                        slidesPerView: 3,
                        spaceBetween: 40,
                        centeredSlides: false,
                    }
                }
            });
        }

        // 5. Scroll Reveal System using Intersection Observer
        const revealCallback = (entries, observer) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    entry.target.classList.add('v-active');
                    // Remove transition-delay classes after the entrance transition finishes (1.2s duration + up to 0.5s delay)
                    setTimeout(() => {
                        entry.target.classList.remove('v-delay-100', 'v-delay-200', 'v-delay-300', 'v-delay-400', 'v-delay-500');
                    }, 2000);
                    // Unobserve to keep performance optimal after revealing
                    observer.unobserve(entry.target);
                }
            });
        };

        const revealObserver = new IntersectionObserver(revealCallback, {
            root: null, // viewport
            threshold: 0.1, // trigger when 10% is visible
            rootMargin: "0px 0px -60px 0px"
        });

        document.querySelectorAll('.v-reveal').forEach(el => revealObserver.observe(el));

        // 6. Smooth Scroll Parallax System
        let ticking = false;

        const updateParallax = () => {
            const currentScrollY = window.scrollY || window.pageYOffset;

            // A. Hero Background Parallax
            const heroBg = document.getElementById('v-hero-bg');
            if (heroBg) {
                // Subtle downward movement
                heroBg.style.transform = `translate3d(0, ${currentScrollY * 0.15}px, 0) scale(1.05)`;
            }

            // B. Value Creation Collage Parallax
            const valCollage = document.getElementById('v-val-collage-col');
            if (valCollage) {
                const rect = valCollage.getBoundingClientRect();
                if (rect.top < window.innerHeight && rect.bottom > 0) {
                    const relativeScroll = window.innerHeight - rect.top;

                    // Image 1 (Central Arch - Slow rise)
                    const img1 = valCollage.querySelector('img:nth-child(2)');
                    if (img1) img1.style.transform = `translate3d(0, ${relativeScroll * -0.03}px, 0)`;

                    // Image 2 (Top Right - Faster rise)
                    const img2 = valCollage.querySelector('img:nth-child(3)');
                    if (img2) img2.style.transform = `translate3d(0, ${relativeScroll * -0.06}px, 0)`;

                    // Sprout Video Container (Bottom Right - Very slow sink)
                    const videoCont = document.getElementById('v-val-video-container');
                    if (videoCont) videoCont.style.transform = `translate3d(0, ${relativeScroll * 0.02}px, 0)`;
                }
            }

            // C. Brand Philosophy Collage Parallax
            const philosophyCollage = document.getElementById('v-philosophy-collage');
            if (philosophyCollage) {
                const rect = philosophyCollage.getBoundingClientRect();
                if (rect.top < window.innerHeight && rect.bottom > 0) {
                    const relativeScroll = window.innerHeight - rect.top;

                    // Left Image / Wrapper (Grayscale capsule - Slow rise)
                    const imgLeft = philosophyCollage.querySelector('.v-parallax-left') || philosophyCollage.querySelector('img:nth-child(1)');
                    if (imgLeft) imgLeft.style.transform = `translate3d(0, ${relativeScroll * -0.04}px, 0)`;

                    // Right Image (Main capsule - Faster rise)
                    const imgRight = philosophyCollage.querySelector('.v-parallax-right') || philosophyCollage.querySelector('img:nth-child(2)');
                    if (imgRight) imgRight.style.transform = `translate3d(0, ${relativeScroll * -0.07}px, 0)`;

                    // Floating Green Banner (Slow float up)
                    const banner = philosophyCollage.querySelector('.v-parallax-banner') || philosophyCollage.querySelector('.bg-\\[\\#004F40\\]');
                    if (banner) banner.style.transform = `translate3d(0, ${relativeScroll * -0.10}px, 0)`;
                }
            }

            ticking = false;
        };

        window.addEventListener('scroll', () => {
            if (!ticking) {
                window.requestAnimationFrame(updateParallax);
                ticking = true;
            }
        }, { passive: true });

        // 7. Interactive slow motion golden particles & bokeh canvas
        const canvas = document.getElementById('v-hero-particles');
        if (canvas) {
            const ctx = canvas.getContext('2d');
            let particles = [];
            const particleCount = 20; // Subtle, not overcrowded
            
            const resizeCanvas = () => {
                const rect = canvas.getBoundingClientRect();
                canvas.width = rect.width;
                canvas.height = rect.height;
            };
            
            window.addEventListener('resize', resizeCanvas);
            resizeCanvas();
            
            class Particle {
                constructor() {
                    this.reset();
                    // Distribute initially across screen height
                    this.y = Math.random() * canvas.height;
                }
                
                reset() {
                    this.x = Math.random() * canvas.width;
                    this.y = canvas.height + Math.random() * 20;
                    this.size = Math.random() * 15 + 4; // various sizes for depth of field (bokeh)
                    this.speedY = -(Math.random() * 0.18 + 0.04); // ultra slow motion
                    this.speedX = (Math.random() - 0.5) * 0.06; // slow sway
                    this.alpha = 0;
                    this.targetAlpha = Math.random() * 0.35 + 0.15; // subtle opacity
                    this.fadeSpeed = Math.random() * 0.004 + 0.001;
                    this.life = 0;
                    this.maxLife = Math.random() * 800 + 450; // long life
                }
                
                update() {
                    this.y += this.speedY;
                    this.x += this.speedX;
                    this.life++;
                    
                    // Fade in at start
                    if (this.alpha < this.targetAlpha && this.life < this.maxLife - 100) {
                        this.alpha += this.fadeSpeed;
                    }
                    
                    // Fade out near end of life or top of canvas
                    if (this.life > this.maxLife - 100 || this.y < 50) {
                        this.alpha -= this.fadeSpeed;
                    }
                    
                    if (this.alpha <= 0 || this.y < 0) {
                        this.reset();
                    }
                }
                
                draw() {
                    ctx.beginPath();
                    // Golden/bokeh radial gradient for high-fidelity look
                    const gradient = ctx.createRadialGradient(this.x, this.y, 0, this.x, this.y, this.size);
                    gradient.addColorStop(0, `rgba(255, 235, 170, ${this.alpha})`);
                    gradient.addColorStop(0.3, `rgba(224, 185, 96, ${this.alpha * 0.4})`);
                    gradient.addColorStop(1, 'rgba(224, 185, 96, 0)');
                    
                    ctx.fillStyle = gradient;
                    ctx.arc(this.x, this.y, this.size, 0, Math.PI * 2);
                    ctx.fill();
                }
            }
            
            for (let i = 0; i < particleCount; i++) {
                particles.push(new Particle());
            }
            
            const animate = () => {
                ctx.clearRect(0, 0, canvas.width, canvas.height);
                particles.forEach(p => {
                    p.update();
                    p.draw();
                });
                requestAnimationFrame(animate);
            };
            
            // Start particle animation after hero starts loading
            setTimeout(animate, 200);
        }

        // 8. AJAX Form Handlers (Contact Form & Newsletter Form)
        const contactForm = document.getElementById('royesh-contact-page-form');
        if (contactForm && typeof royeshData !== 'undefined') {
            contactForm.addEventListener('submit', function (e) {
                e.preventDefault();
                const submitBtn = contactForm.querySelector('button[type="submit"]');
                const origBtnText = submitBtn ? submitBtn.innerText : '';
                if (submitBtn) {
                    submitBtn.disabled = true;
                    submitBtn.innerText = 'در حال ارسال...';
                }

                const formData = new FormData(contactForm);
                formData.append('action', 'royesh_contact_submit');
                formData.append('nonce', royeshData.nonce);

                fetch(royeshData.ajaxUrl, {
                    method: 'POST',
                    body: formData
                })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        alert(data.data.message || 'پیام شما با موفقیت ارسال شد.');
                        contactForm.reset();
                    } else {
                        alert(data.data.message || 'خطا در ارسال پیام. لطفا مجددا تلاش کنید.');
                    }
                })
                .catch(() => {
                    alert('خطای ارتباط با سرور. لطفا اتصال اینترنت خود را بررسی کنید.');
                })
                .finally(() => {
                    if (submitBtn) {
                        submitBtn.disabled = false;
                        submitBtn.innerText = origBtnText;
                    }
                });
            });
        }

        const newsletterForm = document.getElementById('royesh-newsletter-form');
        if (newsletterForm && typeof royeshData !== 'undefined') {
            newsletterForm.addEventListener('submit', function (e) {
                e.preventDefault();
                const emailInput = newsletterForm.querySelector('input[type="email"]');
                const submitBtn = newsletterForm.querySelector('button[type="submit"]');
                const origBtnText = submitBtn ? submitBtn.innerText : '';

                if (!emailInput || !emailInput.value) return;

                if (submitBtn) {
                    submitBtn.disabled = true;
                    submitBtn.innerText = '...';
                }

                const formData = new FormData();
                formData.append('action', 'royesh_newsletter_submit');
                formData.append('email', emailInput.value);
                formData.append('nonce', royeshData.nonce);

                fetch(royeshData.ajaxUrl, {
                    method: 'POST',
                    body: formData
                })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        alert(data.data.message || 'عضویت شما با موفقیت ثبت شد.');
                        newsletterForm.reset();
                    } else {
                        alert(data.data.message || 'خطا در ثبت ایمیل.');
                    }
                })
                .catch(() => {
                    alert('خطای ارتباط با سرور.');
                })
                .finally(() => {
                    if (submitBtn) {
                        submitBtn.disabled = false;
                        submitBtn.innerText = origBtnText;
                    }
                });
            });
        }

        const consultationForm = document.getElementById('royesh-consultation-form');
        if (consultationForm && typeof royeshData !== 'undefined') {
            consultationForm.addEventListener('submit', function (e) {
                e.preventDefault();
                const submitBtn = consultationForm.querySelector('button[type="submit"]');
                const origBtnText = submitBtn ? submitBtn.innerText : '';

                if (submitBtn) {
                    submitBtn.disabled = true;
                    submitBtn.innerText = 'در حال ثبت درخواست...';
                }

                const formData = new FormData(consultationForm);
                formData.append('action', 'royesh_consultation_submit');
                formData.append('nonce', royeshData.nonce);

                fetch(royeshData.ajaxUrl, {
                    method: 'POST',
                    body: formData
                })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        alert(data.data.message || 'درخواست مشاوره شما با موفقیت ثبت شد.');
                        consultationForm.reset();
                    } else {
                        alert(data.data.message || 'خطا در ثبت درخواست. لطفاً دوباره تلاش فرمایید.');
                    }
                })
                .catch(() => {
                    alert('خطای ارتباط با سرور.');
                })
                .finally(() => {
                    if (submitBtn) {
                        submitBtn.disabled = false;
                        submitBtn.innerText = origBtnText;
                    }
                });
            });
        }

    });
})();

