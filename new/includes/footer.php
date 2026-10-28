</main><!-- Close main content from header -->

<!-- Footer -->
<footer class="site-footer">
    <div class="site-footer-contact-band">
        <div class="container site-footer-contact-row">
            <div><p>24/7 MEDICAL COORDINATION</p><h2>Need an air ambulance right now?</h2></div>
            <a class="site-footer-phone" href="tel:<?php echo str_replace(' ', '', EMERGENCY_PHONE); ?>"><?php echo EMERGENCY_PHONE; ?></a>
            <a class="site-footer-request" href="<?php echo SITE_URL; ?>/contact">Request assistance <i class="fa-solid fa-arrow-right" aria-hidden="true"></i></a>
        </div>
    </div>
    <div class="container">
        <div class="site-footer-brand-row">
            <a class="site-footer-brand" href="<?php echo SITE_URL; ?>" aria-label="Ashoka Rescue home">
                <img src="<?php echo IMG_PATH; ?>logo.png" alt="Ashoka Rescue" width="54" height="54" loading="lazy">
            </a>
            <nav class="site-footer-company" aria-label="Company links">
                <a href="<?php echo SITE_URL; ?>/about"><i class="fa-solid fa-circle-info" aria-hidden="true"></i><span>About us</span></a>
                <a href="<?php echo SITE_URL; ?>/contact"><i class="fa-solid fa-envelope" aria-hidden="true"></i><span>Contact</span></a>
                <a href="<?php echo SITE_URL; ?>/faqs"><i class="fa-solid fa-circle-question" aria-hidden="true"></i><span>FAQs</span></a>
                <a href="<?php echo BLOG_URL; ?>"><i class="fa-solid fa-newspaper" aria-hidden="true"></i><span>Blog</span></a>
            </nav>
        </div>
        <div class="site-footer-directory">
            <nav class="site-footer-services" aria-labelledby="footer-services-title">
                <h3 id="footer-services-title">Medical transport services</h3>
                <ul>
                    <?php foreach ($navigationServices ?? getServiceMenu() as $service): ?>
                        <li>
                            <a href="<?php echo htmlspecialchars(getServiceURL($service['slug']), ENT_QUOTES); ?>">
                                <i class="fa-solid <?php echo htmlspecialchars($navigationIcons[$service['slug']] ?? 'fa-kit-medical', ENT_QUOTES); ?>" aria-hidden="true"></i>
                                <span><?php echo htmlspecialchars($service['title']); ?></span>
                            </a>
                        </li>
                    <?php endforeach; ?>
                </ul>
            </nav>
            <div class="site-footer-office">
                <h3>Talk to our team</h3>
                <a class="site-footer-email" href="mailto:<?php echo SITE_EMAIL; ?>"><i class="fa-solid fa-envelope" aria-hidden="true"></i><?php echo SITE_EMAIL; ?> <i class="fa-solid fa-arrow-up-right-from-square" aria-hidden="true"></i></a>
                <address><i class="fa-solid fa-location-dot" aria-hidden="true"></i><span><?php echo htmlspecialchars(COMPANY_ADDRESS); ?></span></address>
                <div class="site-footer-socials" aria-label="Follow Ashoka Rescue">
                    <a href="<?php echo INSTAGRAM_URL; ?>" target="_blank" rel="noopener" aria-label="Instagram"><i class="fa-brands fa-instagram" aria-hidden="true"></i></a>
                    <a href="<?php echo LINKEDIN_URL; ?>" target="_blank" rel="noopener" aria-label="LinkedIn"><i class="fa-brands fa-linkedin-in" aria-hidden="true"></i></a>
                    <a href="<?php echo FACEBOOK_URL; ?>" target="_blank" rel="noopener" aria-label="Facebook"><i class="fa-brands fa-facebook-f" aria-hidden="true"></i></a>
                    <a href="<?php echo YOUTUBE_URL; ?>" target="_blank" rel="noopener" aria-label="YouTube"><i class="fa-brands fa-youtube" aria-hidden="true"></i></a>
                </div>
                <p class="site-footer-description">Compassionate, clinically coordinated medical transport by air and road in India and across the world.</p>
            </div>
        </div>
        <div class="site-footer-bottom">
            <p>© <?php echo date('Y'); ?> Ashoka Rescue Air Ambulance Services. All rights reserved.</p>
            <nav aria-label="Legal and review links">
                <a href="<?php echo SITE_URL; ?>/privacy">Privacy policy</a>
                <a href="<?php echo SITE_URL; ?>/terms">Terms and conditions</a>
                <a href="<?php echo GOOGLE_REVIEW_URL; ?>" target="_blank" rel="noopener">Google reviews <i class="fa-solid fa-arrow-up-right-from-square" aria-hidden="true"></i></a>
            </nav>
        </div>
    </div>
</footer>

<!-- Scroll to Top Button -->
<button type="button" class="scroll-top" aria-label="Back to top" title="Back to top">
    <span class="scroll-top-inner"><i class="fa-solid fa-arrow-up" aria-hidden="true"></i></span>
</button>

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
        if (isSpeaking) {
            stopSpeaking();
            button.innerHTML = '<i id="toggleIcon" class="fa-solid fa-volume-high" aria-hidden="true"></i>';
        } else {
            speak();
            button.innerHTML = '<i id="toggleIcon" class="fa-solid fa-volume-xmark" aria-hidden="true"></i>';
        }
        isSpeaking = !isSpeaking;
        button.setAttribute('aria-pressed', String(isSpeaking));
        button.setAttribute('aria-label', isSpeaking ? 'Stop reading aloud' : 'Read page aloud');
        button.title = isSpeaking ? 'Stop reading aloud' : 'Read page aloud';
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

<script src="<?php echo JS_PATH; ?>experience.min.js?v=<?php echo assetVersion('assets/js/experience.min.js'); ?>" defer></script>
</body>

</html>
