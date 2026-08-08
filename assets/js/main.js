/**
 * Main Theme JavaScript
 * 
 * @package Royesh
 * @version 1.5.1
 */

(function () {
    'use strict';

    document.addEventListener('DOMContentLoaded', function () {
        
        // 0. Header Entrance Animations
        const headerAnimElements = document.querySelectorAll('.v-header-animate');
        if (headerAnimElements.length > 0) {
            headerAnimElements.forEach(el => {
                const delay = parseInt(el.getAttribute('data-delay') || '0', 10);
                setTimeout(() => {
                    el.classList.add('v-active', 'v-revealed');
                }, delay + 40);
            });
        }

        // Hero Content Entrance Animations
        const heroFadeElements = document.querySelectorAll('.v-hero-fade');
        if (heroFadeElements.length > 0) {
            heroFadeElements.forEach((el, index) => {
                setTimeout(() => {
                    el.classList.add('v-active', 'v-revealed');
                }, 100 + (index * 120));
            });
        }

        // Features Bar Entrance Animations
        const featuresBar = document.querySelectorAll('.v-features-bar-fade');
        if (featuresBar.length > 0) {
            featuresBar.forEach(el => {
                setTimeout(() => {
                    el.classList.add('v-active', 'v-revealed');
                }, 350);
            });
        }

        const featureItems = document.querySelectorAll('.v-feature-item');
        if (featureItems.length > 0) {
            featureItems.forEach((el, index) => {
                setTimeout(() => {
                    el.classList.add('v-active', 'v-revealed');
                }, 450 + (index * 80));
            });
        }

        // 1. Mobile Menu Toggle
        const menuToggleBtn = document.getElementById('v-menu-toggle');
        const mobileMenu = document.getElementById('v-mobile-menu');

        if (menuToggleBtn && mobileMenu) {
            menuToggleBtn.addEventListener('click', function () {
                const isHidden = mobileMenu.classList.contains('hidden');
                if (isHidden) {
                    mobileMenu.classList.remove('hidden');
                    menuToggleBtn.setAttribute('aria-expanded', 'true');
                } else {
                    mobileMenu.classList.add('hidden');
                    menuToggleBtn.setAttribute('aria-expanded', 'false');
                }
            });
        }

        // 2. Smooth Scroll for internal navigation links
        document.querySelectorAll('a[href^="#"]').forEach(anchor => {
            anchor.addEventListener('click', function (e) {
                const targetId = this.getAttribute('href');
                if (targetId === '#' || !targetId.startsWith('#')) return;
                
                const targetEl = document.querySelector(targetId);
                if (targetEl) {
                    e.preventDefault();
                    targetEl.scrollIntoView({
                        behavior: 'smooth',
                        block: 'start'
                    });
                    
                    // Close mobile menu if open
                    if (mobileMenu && !mobileMenu.classList.contains('hidden')) {
                        mobileMenu.classList.add('hidden');
                        if (menuToggleBtn) menuToggleBtn.setAttribute('aria-expanded', 'false');
                    }
                }
            });
        });

        // 3. Scroll Reveal Animations (Intersection Observer)
        const revealElements = document.querySelectorAll('.v-reveal');
        if ('IntersectionObserver' in window && revealElements.length > 0) {
            const revealObserver = new IntersectionObserver((entries, observer) => {
                entries.forEach(entry => {
                    if (entry.isIntersecting) {
                        entry.target.classList.add('v-active', 'v-revealed');
                        observer.unobserve(entry.target);
                    }
                });
            }, {
                root: null,
                threshold: 0.05,
                rootMargin: '0px 0px 50px 0px'
            });

            revealElements.forEach(el => revealObserver.observe(el));
        } else {
            // Fallback: reveal all immediately
            revealElements.forEach(el => el.classList.add('v-active', 'v-revealed'));
        }

        // 4. Header Shadow on Scroll (Preserving the warm luxury brand color)
        const mainHeader = document.querySelector('header');
        if (mainHeader) {
            window.addEventListener('scroll', function () {
                if (window.scrollY > 15) {
                    mainHeader.classList.add('shadow-md');
                } else {
                    mainHeader.classList.remove('shadow-md');
                }
            }, { passive: true });
        }

        // 5. Parallax Letters in Divider Section (Optimized RAF & will-change)
        const dividerSection = document.getElementById('royesh-divider-parallax');
        const parallaxLetters = document.querySelectorAll('.parallax-letter');

        if (dividerSection && parallaxLetters.length > 0) {
            let lastScrollY = window.scrollY;
            let ticking = false;

            const updateParallax = () => {
                const rect = dividerSection.getBoundingClientRect();
                const windowHeight = window.innerHeight;

                // Only calculate if the section is approaching or in viewport
                if (rect.top < windowHeight && rect.bottom > 0) {
                    const sectionCenter = rect.top + rect.height / 2;
                    const screenCenter = windowHeight / 2;
                    const distanceFromCenter = (sectionCenter - screenCenter) / (windowHeight / 2);

                    parallaxLetters.forEach(letter => {
                        const speed = parseFloat(letter.getAttribute('data-speed')) || 0.1;
                        const direction = parseFloat(letter.getAttribute('data-direction')) || 1;
                        
                        const translateY = distanceFromCenter * speed * 120 * direction;
                        const rotate = distanceFromCenter * speed * 8 * direction;
                        
                        letter.style.transform = `translate3d(0, ${translateY.toFixed(2)}px, 0) rotate(${rotate.toFixed(2)}deg)`;
                    });
                }

                ticking = false;
            };

            window.addEventListener('scroll', () => {
                lastScrollY = window.scrollY;
                if (!ticking) {
                    window.requestAnimationFrame(updateParallax);
                    ticking = true;
                }
            }, { passive: true });
            
            // Initial calculation
            updateParallax();
        }

        // 6. Luxury Parallax for Hero & Philosophy Section Images
        const heroSection = document.getElementById('royesh-hero-parallax');
        const heroMainBadge = document.querySelector('.v-hero-badge');
        const heroBadgeLeft = document.querySelector('.v-hero-badge-left');
        const heroBadgeRight = document.querySelector('.v-hero-badge-right');
        const heroImageMain = document.querySelector('.v-hero-img-main');
        const philosophyCollage = document.getElementById('philosophy-collage');

        let ticking = false;

        const updateParallax = () => {
            const scrollY = window.scrollY;
            const windowHeight = window.innerHeight;

            // Hero Section Parallax
            if (heroSection) {
                const heroRect = heroSection.getBoundingClientRect();
                if (heroRect.bottom > 0 && heroRect.top < windowHeight) {
                    if (heroMainBadge) {
                        heroMainBadge.style.transform = `translate3d(0, ${scrollY * 0.08}px, 0)`;
                    }
                    if (heroBadgeLeft) {
                        heroBadgeLeft.style.transform = `translate3d(0, ${scrollY * 0.12}px, 0)`;
                    }
                    if (heroBadgeRight) {
                        heroBadgeRight.style.transform = `translate3d(0, ${scrollY * 0.05}px, 0)`;
                    }
                    if (heroImageMain) {
                        heroImageMain.style.transform = `translate3d(0, ${scrollY * 0.04}px, 0)`;
                    }
                }
            }

            // Brand Philosophy Section Floating Elements
            if (philosophyCollage) {
                const philRect = philosophyCollage.getBoundingClientRect();
                if (philRect.top < windowHeight && philRect.bottom > 0) {
                    const relativeScroll = (windowHeight - philRect.top);

                    // Left Image
                    const imgLeft = philosophyCollage.querySelector('.v-parallax-left') || philosophyCollage.querySelector('img:nth-child(1)');
                    if (imgLeft) imgLeft.style.transform = `translate3d(0, ${relativeScroll * -0.04}px, 0)`;

                    // Right Image
                    const imgRight = philosophyCollage.querySelector('.v-parallax-right') || philosophyCollage.querySelector('img:nth-child(2)');
                    if (imgRight) imgRight.style.transform = `translate3d(0, ${relativeScroll * -0.07}px, 0)`;

                    // Floating Green Banner
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
            const particleCount = 20;
            
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
                    this.y = Math.random() * canvas.height;
                }
                
                reset() {
                    this.x = Math.random() * canvas.width;
                    this.y = canvas.height + Math.random() * 20;
                    this.size = Math.random() * 15 + 4;
                    this.speedY = -(Math.random() * 0.18 + 0.04);
                    this.speedX = (Math.random() - 0.5) * 0.06;
                    this.alpha = 0;
                    this.targetAlpha = Math.random() * 0.35 + 0.15;
                    this.fadeSpeed = Math.random() * 0.004 + 0.001;
                    this.life = 0;
                    this.maxLife = Math.random() * 800 + 450;
                }
                
                update() {
                    this.y += this.speedY;
                    this.x += this.speedX;
                    this.life++;
                    
                    if (this.life < 80) {
                        this.alpha = Math.min(this.targetAlpha, this.alpha + this.fadeSpeed * 2);
                    } else if (this.life > this.maxLife - 100) {
                        this.alpha = Math.max(0, this.alpha - this.fadeSpeed * 1.5);
                    }
                    
                    if (this.life >= this.maxLife || this.y < -30 || this.alpha <= 0 && this.life > 100) {
                        this.reset();
                    }
                }
                
                draw() {
                    ctx.save();
                    ctx.beginPath();
                    const gradient = ctx.createRadialGradient(
                        this.x, this.y, 0,
                        this.x, this.y, this.size
                    );
                    gradient.addColorStop(0, `rgba(232, 210, 175, ${this.alpha * 1.2})`);
                    gradient.addColorStop(0.4, `rgba(177, 134, 45, ${this.alpha * 0.8})`);
                    gradient.addColorStop(1, `rgba(177, 134, 45, 0)`);
                    
                    ctx.fillStyle = gradient;
                    ctx.arc(this.x, this.y, this.size, 0, Math.PI * 2);
                    ctx.fill();
                    ctx.restore();
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
            
            setTimeout(animate, 200);
        }

        // ────────────────────────────────────────────────────────────
        // 8. Math CAPTCHA Helper & Refresh Handlers
        // ────────────────────────────────────────────────────────────
        function setupCaptcha(btnId, questionId, tokenId, answerId) {
            const btn = document.getElementById(btnId);
            if (!btn || typeof royeshData === 'undefined') return;

            btn.addEventListener('click', function () {
                btn.style.opacity = '0.5';
                const fd = new FormData();
                fd.append('action', 'royesh_new_captcha');
                fd.append('nonce', royeshData.nonce);

                fetch(royeshData.ajaxUrl, {
                    method: 'POST',
                    body: fd
                })
                .then(r => r.json())
                .then(data => {
                    if (data.success && data.data) {
                        const qEl = document.getElementById(questionId);
                        const tEl = document.getElementById(tokenId);
                        const aEl = document.getElementById(answerId);
                        if (qEl) qEl.textContent = data.data.question;
                        if (tEl) tEl.value       = data.data.token;
                        if (aEl) {
                            aEl.value = '';
                            aEl.focus();
                        }
                    }
                })
                .catch(() => {})
                .finally(() => {
                    btn.style.opacity = '1';
                });
            });
        }

        setupCaptcha('royesh-captcha-refresh-home',    'royesh-captcha-question-home',    'royesh-captcha-token-home',    'royesh-captcha-answer-home');
        setupCaptcha('royesh-captcha-refresh-contact', 'royesh-captcha-question-contact', 'royesh-captcha-token-contact', 'royesh-captcha-answer-contact');
        setupCaptcha('royesh-captcha-refresh-consult', 'royesh-captcha-question-consult', 'royesh-captcha-token-consult', 'royesh-captcha-answer-consult');

        // Helper to show inline form feedback
        function displayFeedback(containerId, message, isSuccess) {
            const box = document.getElementById(containerId);
            if (!box) {
                alert(message);
                return;
            }
            box.classList.remove('hidden');
            box.className = 'col-span-1 md:col-span-2 p-4 rounded-2xl text-sm font-sans block transition-all duration-300 ' + 
                (isSuccess ? 'bg-[#e8f5f0] text-[#004F40] border border-[#a3d9c9]' : 'bg-[#fff0f0] text-[#b32d2e] border border-[#f5c2c3]');
            box.innerHTML = '<strong>' + (isSuccess ? '✓ ' : '✕ ') + '</strong> ' + message;
            box.scrollIntoView({ behavior: 'smooth', block: 'nearest' });
        }

        // ────────────────────────────────────────────────────────────
        // 9. Contact Forms Submission (Front page & Contact page)
        // ────────────────────────────────────────────────────────────
        const contactForms = document.querySelectorAll('#royesh-home-contact-form, #royesh-contact-form, #royesh-contact-page-form');
        contactForms.forEach(form => {
            if (!form || typeof royeshData === 'undefined') return;

            form.addEventListener('submit', function (e) {
                e.preventDefault();
                const isHomeForm = (form.id === 'royesh-home-contact-form');
                const feedbackId = isHomeForm ? 'royesh-home-contact-feedback' : 'royesh-contact-feedback';
                const refreshBtnId = isHomeForm ? 'royesh-captcha-refresh-home' : 'royesh-captcha-refresh-contact';

                const submitBtn = form.querySelector('button[type="submit"]');
                const origBtnText = submitBtn ? submitBtn.innerText : '';

                if (submitBtn) {
                    submitBtn.disabled = true;
                    submitBtn.innerText = 'در حال ارسال پیام...';
                }

                const formData = new FormData(form);
                formData.append('action', 'royesh_contact_submit');
                formData.append('nonce', royeshData.nonce);

                fetch(royeshData.ajaxUrl, {
                    method: 'POST',
                    body: formData
                })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        displayFeedback(feedbackId, data.data.message || 'پیام شما با موفقیت ارسال شد.', true);
                        form.reset();
                        document.getElementById(refreshBtnId)?.click();
                    } else {
                        const errMsg = (data.data && data.data.message) ? data.data.message : 'خطا در ارسال پیام. لطفاً مجدداً بررسی فرمایید.';
                        displayFeedback(feedbackId, errMsg, false);
                        
                        if (data.data && data.data.new_captcha) {
                            const qEl = isHomeForm ? document.getElementById('royesh-captcha-question-home') : document.getElementById('royesh-captcha-question-contact');
                            const tEl = isHomeForm ? document.getElementById('royesh-captcha-token-home') : document.getElementById('royesh-captcha-token-contact');
                            const aEl = isHomeForm ? document.getElementById('royesh-captcha-answer-home') : document.getElementById('royesh-captcha-answer-contact');
                            if (qEl) qEl.textContent = data.data.new_captcha.question;
                            if (tEl) tEl.value       = data.data.new_captcha.token;
                            if (aEl) {
                                aEl.value = '';
                                aEl.focus();
                            }
                        }
                    }
                })
                .catch(() => {
                    displayFeedback(feedbackId, 'خطای ارتباط با سرور. لطفاً اتصال اینترنت خود را بررسی نمایید.', false);
                })
                .finally(() => {
                    if (submitBtn) {
                        submitBtn.disabled = false;
                        submitBtn.innerText = origBtnText;
                    }
                });
            });
        });

        // ────────────────────────────────────────────────────────────
        // 10. Newsletter Form
        // ────────────────────────────────────────────────────────────
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

        // ────────────────────────────────────────────────────────────
        // 11. Consultation Form Submission
        // ────────────────────────────────────────────────────────────
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
                        displayFeedback('royesh-consultation-feedback', data.data.message || 'درخواست مشاوره شما با موفقیت ثبت شد.', true);
                        consultationForm.reset();
                        document.getElementById('royesh-captcha-refresh-consult')?.click();
                    } else {
                        const errMsg = (data.data && data.data.message) ? data.data.message : 'خطا در ثبت درخواست. لطفاً دوباره تلاش فرمایید.';
                        displayFeedback('royesh-consultation-feedback', errMsg, false);

                        if (data.data && data.data.new_captcha) {
                            const qEl = document.getElementById('royesh-captcha-question-consult');
                            const tEl = document.getElementById('royesh-captcha-token-consult');
                            const aEl = document.getElementById('royesh-captcha-answer-consult');
                            if (qEl) qEl.textContent = data.data.new_captcha.question;
                            if (tEl) tEl.value       = data.data.new_captcha.token;
                            if (aEl) {
                                aEl.value = '';
                                aEl.focus();
                            }
                        }
                    }
                })
                .catch(() => {
                    displayFeedback('royesh-consultation-feedback', 'خطای ارتباط با سرور. لطفاً اتصال اینترنت خود را بررسی نمایید.', false);
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
