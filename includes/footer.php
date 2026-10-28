</div><!-- Close voice_text div from header -->

<!-- Footer -->
<footer class="footer">
    <section class="footer-assistance" aria-label="Emergency medical transport assistance">
        <div class="container">
            <div class="footer-assistance-inner">
                <div class="footer-assistance-copy">
                    <span class="footer-assistance-icon"><i class="fa-solid fa-phone-volume"></i></span>
                    <div>
                        <small>24/7 emergency medical transport desk</small>
                        <h2>Need an air ambulance right now?</h2>
                    </div>
                </div>
                <div class="footer-assistance-actions">
                    <a class="footer-call-link" href="tel:<?php echo str_replace(' ', '', EMERGENCY_PHONE); ?>">
                        <i class="fa-solid fa-phone"></i>
                        <span><?php echo EMERGENCY_PHONE; ?><small>Tap to call</small></span>
                    </a>
                    <a class="btn footer-request-btn" href="<?php echo SITE_URL; ?>/contact">Request assistance <i class="fa-solid fa-arrow-right"></i></a>
                </div>
            </div>
        </div>
    </section>
    <section class="main-footer">
        <div class="container">
            <div class="footer-grid">
                <div class="footer-brand-column">
                    <a href="<?php echo SITE_URL; ?>" class="footer-brand" aria-label="<?php echo SITE_NAME; ?> home">
                        <img src="<?php echo IMG_PATH; ?>logo.png" alt="<?php echo SITE_NAME; ?>">
                        <span>Ashoka Rescue</span>
                    </a>
                    <p>Compassionate, clinically coordinated medical transport by air and road in India and across the world.</p>
                    <div class="footer-socials" aria-label="Follow Ashoka Rescue">
                        <a href="<?php echo INSTAGRAM_URL; ?>" target="_blank" aria-label="Instagram">
                            <i class="fa-brands fa-instagram"></i>
                        </a>
                        <a href="<?php echo LINKEDIN_URL; ?>" target="_blank" aria-label="LinkedIn">
                            <i class="fa-brands fa-linkedin-in"></i>
                        </a>
                        <a href="<?php echo FACEBOOK_URL; ?>" target="_blank" aria-label="Facebook">
                            <i class="fa-brands fa-facebook-f"></i>
                        </a>
                        <a href="<?php echo YOUTUBE_URL; ?>" target="_blank" aria-label="YouTube">
                            <i class="fa-brands fa-youtube"></i>
                        </a>
                    </div>
                </div>

                <div class="footer-services-column">
                    <h3 class="footer-title">Medical transport services</h3>
                    <ul class="footer-service-links">
                        <?php
                        $footerServices = getServiceMenu();
                        foreach ($footerServices as $service):
                            ?>
                            <li>
                                <a href="<?php echo getServiceURL($service['slug']); ?>">
                                    <i class="fa-solid fa-arrow-right"></i>
                                    <span><?php echo htmlspecialchars($service['title']); ?></span>
                                </a>
                            </li>
                        <?php endforeach; ?>
                    </ul>
                </div>

                <div class="footer-contact-column">
                    <h3 class="footer-title">Contact</h3>
                    <address class="footer-address">
                        <div>
                            <i class="fa-solid fa-location-dot"></i>
                            <p><?php echo COMPANY_ADDRESS; ?></p>
                        </div>
                        <div>
                            <i class="fa-solid fa-envelope"></i>
                            <a href="mailto:<?php echo SITE_EMAIL; ?>"><?php echo SITE_EMAIL; ?></a>
                        </div>
                    </address>
                    <h3 class="footer-title footer-company-title">Company</h3>
                    <ul class="footer-company-links">
                        <li><a href="<?php echo SITE_URL; ?>/about">About us</a></li>
                        <li><a href="<?php echo SITE_URL; ?>/contact">Contact</a></li>
                        <li><a href="<?php echo SITE_URL; ?>/faqs">FAQs</a></li>
                        <li><a href="<?php echo BLOG_URL; ?>">Blog</a></li>
                    </ul>
                </div>
            </div>
        </div>
    </section>

    <section class="copyright">
        <div class="container">
            <div class="copyright-inner">
                <p>© <?php echo date('Y'); ?> Ashoka Rescue Air Ambulance Services. All rights reserved.</p>
                <ul class="copyright-list">
                    <li><a href="<?php echo SITE_URL; ?>/privacy">Privacy policy</a></li>
                    <li><a href="<?php echo SITE_URL; ?>/terms">Terms and conditions</a></li>
                    <li>
                        <a href="<?php echo GOOGLE_REVIEW_URL; ?>" target="_blank">
                            <i class="fa-solid fa-star"></i> Google reviews
                        </a>
                    </li>
                </ul>
            </div>
        </div>
    </section>
</footer>

<!-- Scroll to Top Button -->
<div class="scroll-top">
    <div class="scroll-top-inner"><i class="fa-solid fa-arrow-up"></i></div>
</div>

<!-- JavaScript Libraries -->
<!-- jQuery -->
<script src="https://cdn.jsdelivr.net/npm/jquery@3.7.0/dist/jquery.min.js"
    integrity="sha256-2Pmvv0kuTBOenSvLm6bvfBSSHrUJ+3A7x6P5Ebd07/g=" crossorigin="anonymous" defer></script>

<!-- Bootstrap JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz" crossorigin="anonymous"
    defer></script>

<!-- Swiper JS -->
<script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js" defer></script>

<!-- Custom JS -->
<script src="<?php echo JS_PATH; ?>app.js?v=<?php echo assetVersion('assets/js/app.js'); ?>" defer></script>

<!-- AOS Animation JS -->
<script src="https://unpkg.com/aos@2.3.1/dist/aos.js" defer></script>

<!-- jQuery Validation -->
<script src="https://cdn.jsdelivr.net/npm/jquery-validation@1.19.5/dist/jquery.validate.js" defer></script>

<!-- SweetAlert2 -->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11" defer></script>

<script>
    // Wait for deferred scripts to load
    document.addEventListener('DOMContentLoaded', function () {
        // Keep carousel transforms independent from scroll-reveal transforms.
        document.querySelectorAll('.swiper [data-aos]').forEach(function (element) {
            element.removeAttribute('data-aos');
            element.removeAttribute('data-aos-duration');
            element.removeAttribute('data-aos-delay');
        });

        // Normalize legacy page animations to one short, predictable reveal.
        document.querySelectorAll('[data-aos]').forEach(function (element) {
            element.setAttribute('data-aos', 'fade-up');
            element.removeAttribute('data-aos-duration');
            element.removeAttribute('data-aos-delay');
            element.removeAttribute('data-aos-offset');
        });

        if (typeof AOS !== 'undefined') {
            AOS.init({
                duration: 520,
                easing: 'ease-out-cubic',
                once: true,
                mirror: false,
                offset: 24,
                delay: 0,
                anchorPlacement: 'top-bottom',
                disable: function () {
                    return window.matchMedia('(prefers-reduced-motion: reduce)').matches;
                },
                throttleDelay: 99,
                debounceDelay: 50
            });
        }

        // Global function for service menu toggle
        window.toggleServiceMenu = function (element) {
            const hiddenItems = $(".hide_nav");

            if (hiddenItems.length > 0) {
                hiddenItems.toggle();

                // Change button text
                const currentText = $(element).text();
                if (currentText.includes("Show More")) {
                    $(element).text("Show Less..");
                } else {
                    $(element).text("Show More..");
                }
            }
        };

        // jQuery ready
        if (typeof $ !== 'undefined') {
            $(document).ready(function () {
                $("#toggleButton").show();
            });
        }
    });

    let isSpeaking = false;
    let utterance;

    const toggleSpeech = () => {
        const button = document.getElementById('toggleButton');
        const icon = document.getElementById('toggleIcon');
        if (isSpeaking) {
            stopSpeaking();
            button.innerHTML = '<i id="toggleIcon" class="fas fa-volume-up"></i>';
        } else {
            speak();
            button.innerHTML = '<i id="toggleIcon" class="fas fa-volume-mute"></i>';
        }
        isSpeaking = !isSpeaking;
    }

    const speak = () => {
        try {
            if ('speechSynthesis' in window) {
                utterance = new SpeechSynthesisUtterance(content);
                utterance.rate = 1.4;
                window.speechSynthesis.speak(utterance);

                utterance.onerror = (event) => {
                    if (event.error != 'interrupted') {
                        Swal.fire({
                            title: 'TTS Error',
                            text: event.error,
                            icon: 'info',
                        });
                    }
                }
            } else {
                Swal.fire({
                    title: 'TTS Error',
                    text: "The Web Speech API is not supported by the browser.",
                    icon: 'info',
                });
            }
        } catch (error) {
            Swal.fire({
                title: 'TTS Error Type 1',
                text: error,
                icon: 'info',
            });
        }
    }

    function stopSpeaking() {
        window.speechSynthesis.cancel();
    }

    window.speechSynthesis.onvoiceschanged = function () {
        const voices = window.speechSynthesis.getVoices();
    };
</script>

<!-- Swiper Initialization -->
<script>
    document.addEventListener('DOMContentLoaded', function () {
        // Wait for Swiper to be available
        if (typeof Swiper !== 'undefined') {
            // Safe init: skip selectors with no matching element, so a page
            // can drop a carousel without breaking this shared script.
            var initSwiper = function (selector, params) {
                var el = typeof selector === 'string' ? document.querySelector(selector) : selector;
                if (!el) return null;
                return new Swiper(el, params);
            };
            var swiper = initSwiper(".serviceSwiper", {
                slidesPerView: "auto",
                spaceBetween: 10,
                loop: true,
                navigation: {
                    nextEl: ".swiper-button-next",
                    prevEl: ".swiper-button-prev",
                },
                pagination: {
                    el: ".swiper-pagination",
                    clickable: true,
                },
                breakpoints: {
                    768: {
                        slidesPerView: 2,
                        spaceBetween: 20,
                    },
                    1024: {
                        slidesPerView: 3,
                        spaceBetween: 24,
                    },
                },
            });

            var swiper2 = initSwiper(".innerSwiper", {
                spaceBetween: 50,
                loop: true,
                autoplay: {
                    delay: 2500,
                    disableOnInteraction: false,
                },
            });

            var swiperStory = initSwiper(".storySwiper", {
                slidesPerView: 1,
                spaceBetween: 30,
                loop: true,
                speed: 800,
                autoplay: window.matchMedia('(prefers-reduced-motion: reduce)').matches ? false : {
                    delay: 4500,
                    disableOnInteraction: false,
                    pauseOnMouseEnter: true,
                },
                pagination: {
                    el: ".swiper-pagination",
                    clickable: true,
                },
                navigation: {
                    nextEl: ".journal-next",
                    prevEl: ".journal-prev",
                },
            });

            var swiperTestimonial = initSwiper(".testimonialSwiper", {
                slidesPerView: 1,
                spaceBetween: 30,
                loop: true,
                autoHeight: true,
                pagination: {
                    el: ".swiper-pagination",
                    clickable: true,
                },
                navigation: {
                    nextEl: ".swiper-button-next",
                    prevEl: ".swiper-button-prev",
                },
                breakpoints: {
                    768: {
                        slidesPerView: 1,
                        spaceBetween: 20,
                    },
                    1024: {
                        slidesPerView: 1,
                        spaceBetween: 24,
                    },
                },
            });
        }
    });
</script>

<!-- Scroll to Top Button Animation -->
<script>
    document.addEventListener('DOMContentLoaded', function () {
        if (typeof $ !== 'undefined') {
            $(document).ready(function () {
                // Scroll to top button fade in/fade out
                $(window).scroll(function () {
                    if ($(this).scrollTop() > 300) {
                        $('.scroll-top').addClass('scrolltopactive');
                    } else {
                        $('.scroll-top').removeClass('scrolltopactive');
                    }
                });

                // Smooth scroll to top on click
                $('.scroll-top').click(function () {
                    $('html, body').animate({
                        scrollTop: 0
                    }, 600);
                    return false;
                });
            });
        }
    });
</script>

<?php require __DIR__ . '/ai-concierge.php'; ?>
<script src="<?php echo JS_PATH; ?>ai-concierge.js?v=<?php echo assetVersion('assets/js/ai-concierge.js'); ?>" defer></script>
<script src="<?php echo JS_PATH; ?>flipboard.js?v=<?php echo assetVersion('assets/js/flipboard.js'); ?>" defer></script>
<script src="<?php echo JS_PATH; ?>redesign.js?v=<?php echo assetVersion('assets/js/redesign.js'); ?>" defer></script>

<?php if (isset($additionalScripts))
    echo $additionalScripts; ?>

</body>

</html>
