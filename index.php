<?php
/**
 * Home Page - Ashoka Rescue Air Ambulance Services
 */

// Page-specific variables
$pageTitle = 'Ashoka Rescue | Air Ambulance & Critical Care Medical Transport';
$pageDescription = 'Doctor-led air ambulance, commercial stretcher and ALS/BLS road ambulance services across India and worldwide. ICU-configured transfers with 24/7 medical coordination since 2004.';
$pageKeywords = 'Air Ambulance India, Medical Evacuation, Critical Care Transport, Commercial Stretcher Service, ALS Ambulance, Road Ambulance Service, Medical Transport Services';
// Auto cache-busting: version string follows the file modification time,
// so browsers always fetch fresh CSS after an edit (no manual version bumps).
$additionalStyles = '<link rel="stylesheet" href="assets/css/home-modern.css?v=' . filemtime(__DIR__ . '/assets/css/home-modern.css') . '">'
    . '<link rel="stylesheet" href="assets/css/hero-slider.css?v=' . filemtime(__DIR__ . '/assets/css/hero-slider.css') . '">'
    . '<link rel="stylesheet" href="assets/css/rx-home.css?v=' . filemtime(__DIR__ . '/assets/css/rx-home.css') . '">';

// Schema markup for home page
$schemaMarkup = <<<SCHEMA
<!-- Organization Schema -->
<script type="application/ld+json">
{
  "@context": "https://schema.org",
  "@type": "Organization",
  "name": "Ashoka Rescue Air Ambulance Services Pvt Ltd",
  "alternateName": "Ashoka Rescue",
  "url": "https://ashokarescue.com",
  "logo": "https://ashokarescue.com/ui/images/logo.png",
  "contactPoint": {
    "@type": "ContactPoint",
    "telephone": "+91 9810 36 4143",
    "contactType": "customer service",
    "areaServed": "IN",
    "availableLanguage": "en"
  },
  "sameAs": [
    "https://www.facebook.com/ashokarescue",
    "https://www.instagram.com/ashoka_rescue/",
    "https://www.linkedin.com/company/ashoka-rescue/"
  ]
}
</script>

<!-- LocalBusiness Schema -->
<script type="application/ld+json">
{
  "@context": "https://schema.org",
  "@type": "LocalBusiness",
  "name": "Ashoka Rescue Air Ambulance Services Pvt. Ltd.",
  "image": "https://ashokarescue.com/ui/images/hero-bg.jpg",
  "@id": "https://ashokarescue.com/ui/images/hero-bg.jpg",
  "url": "https://ashokarescue.com/",
  "telephone": "+91 9810 36 4143",
  "address": {
    "@type": "PostalAddress",
    "streetAddress": "UG 124, Ansal Palam Corporate Plaza, Palam Vihar",
    "addressLocality": "Gurgaon",
    "postalCode": "122017",
    "addressCountry": "IN"
  },
  "geo": {
    "@type": "GeoCoordinates",
    "latitude": 28.5146969,
    "longitude": 77.0348848
  },
  "openingHoursSpecification": {
    "@type": "OpeningHoursSpecification",
    "dayOfWeek": [
      "Monday",
      "Tuesday",
      "Wednesday",
      "Thursday",
      "Friday",
      "Saturday",
      "Sunday"
    ],
    "opens": "00:00",
    "closes": "23:59"
  },
  "sameAs": [
    "https://www.facebook.com/ashokarescue",
    "https://www.instagram.com/ashoka_rescue/",
    "https://www.linkedin.com/company/ashoka-rescue/"
  ]
}
</script>

<!-- Aggregate Rating Schema -->
<script type='application/ld+json'>
{
    "@context": "http://schema.org",
    "@type": "Product",
    "name": "Ashoka Rescue Air Ambulance Services Pvt. Ltd.",
    "aggregateRating": {
        "@type": "AggregateRating",
        "ratingValue": "4.8",
        "ratingCount": "16",
        "reviewCount": "16"
    }
}
</script>

<!-- FAQ Schema for Homepage -->
<script type="application/ld+json">
{
  "@context": "https://schema.org",
  "@type": "FAQPage",
  "mainEntity": [
    {
      "@type": "Question",
      "name": "What is the cost of premier medical transport services in India?",
      "acceptedAnswer": {
        "@type": "Answer",
        "text": "The cost of premier medical transport services in India depends on factors such as distance, mode of transport, patient condition, medical equipment required, and level of medical supervision. Pricing is customized to ensure safe and timely patient transfer based on specific medical needs."
      }
    },
    {
      "@type": "Question",
      "name": "What do premier medical transport services do?",
      "acceptedAnswer": {
        "@type": "Answer",
        "text": "Premier medical transport services provide safe, medically supervised patient transfers for emergencies and planned relocations. These services include advanced ambulances, air ambulances, and critical care transport with trained medical professionals ensuring continuous care during transit."
      }
    },
    {
      "@type": "Question",
      "name": "How do I contact premier medical transport services?",
      "acceptedAnswer": {
        "@type": "Answer",
        "text": "Premier medical transport services can be contacted through their official website, emergency helpline numbers, or online inquiry forms. Most providers offer 24/7 support to assess patient requirements and arrange transportation promptly."
      }
    },
    {
      "@type": "Question",
      "name": "What are the types of premier medical transport services?",
      "acceptedAnswer": {
        "@type": "Answer",
        "text": "Premier medical transport services include road ambulances (basic, advanced, and ICU ambulances), air ambulances using fixed-wing aircraft, helicopter medical services, and train ambulance services. Each option is designed to meet specific medical conditions, distances, and urgency levels."
      }
    },
    {
      "@type": "Question",
      "name": "Which mode of medical transport services is most affordable?",
      "acceptedAnswer": {
        "@type": "Answer",
        "text": "Road ambulance services are generally the most affordable option for medical transport, especially for short to moderate distances. However, the most appropriate mode depends on the patient's medical condition, urgency, and required level of care."
      }
    }
  ]
}
</script>
SCHEMA;

// Include header (this loads functions.php)
include __DIR__ . '/includes/header.php';

// Get data from database (after functions are loaded)
$list = getServices(5); // Get first 5 services for home page
$ourStories = getOurStories();
$testimonials = getTestimonials();

// Google reviews (4.8 stars, 20 reviews) — hardcoded directly, no DB or API needed.
// Add/remove entries here to change the testimonial slider.
$googleReviews = [
    [
        'content' => 'Exceptional life-saving support and compassionate care — flawless coordination with hospitals and airlines for our critically ill family member\'s journey from the US to India. Thanks to Dr. Ashok, Dr. Surya and Dr. Aditi.',
        'rating' => 5,
        'author' => 'Deep Deepak',
        'designtion' => 'via Google Reviews',
    ],
    [
        'content' => 'True bed to bed service — air ambulance arranged from Udaipur to Delhi and a commercial stretcher flight onward to the USA, with Dr. Ashok and Dr. Mishra escorting throughout.',
        'rating' => 5,
        'author' => 'Abhay Chaudhari',
        'designtion' => 'via Google Reviews',
    ],
    [
        'content' => 'Outstanding service — a man of his word. Highly recommended for air ambulance.',
        'rating' => 5,
        'author' => 'Kid Aarav',
        'designtion' => 'via Google Reviews',
    ],
    [
        'content' => 'Medical evacuation from Thailand to India — Dr. Ashok stayed with us through a stressful boarding episode with continuous skilled monitoring. They saved my life.',
        'rating' => 5,
        'author' => 'Ritil Jindal',
        'designtion' => 'via Google Reviews',
    ],
    [
        'content' => 'Thank you to Dr. Ashok and the team for their support during a tough time — a noble job.',
        'rating' => 5,
        'author' => 'dr grishma Amin',
        'designtion' => 'via Google Reviews',
    ],
    [
        'content' => 'Medical escort for our mother travelling from Canada to India after critical illness — Dr. Ashok Kumar helped before and during the flight. Recommend their services to the fullest.',
        'rating' => 5,
        'author' => 'Prabhjyot Saini',
        'designtion' => 'via Google Reviews',
    ],
    [
        'content' => 'He was God sent — Dr. Suryanarayan Misra evacuated our friend after a fracture in Egypt with kindness and dedication.',
        'rating' => 5,
        'author' => 'Sanjukta Ghosh',
        'designtion' => 'via Google Reviews',
    ],
    [
        'content' => 'Best agency and team — everything arranged on time for my bypass journey from Canada to Mumbai, with Dr. Ashok alongside throughout.',
        'rating' => 5,
        'author' => 'Milan Mehta',
        'designtion' => 'via Google Reviews',
    ],
    [
        'content' => 'Admire how Dr. Ashok Kumar handles high-pressure situations with grace and confidence.',
        'rating' => 5,
        'author' => 'Kavita Devi',
        'designtion' => 'via Google Reviews',
    ],
    [
        'content' => 'Amazing team and service.',
        'rating' => 5,
        'author' => 'BHUMIT GOSALIA',
        'designtion' => 'via Google Reviews',
    ],
    [
        'content' => 'Best service.',
        'rating' => 5,
        'author' => 'Khushwant Singh',
        'designtion' => 'via Google Reviews',
    ],
];

// Hero slider slides. Add/remove entries here to change the carousel.
// The first slide keeps the <h1> for SEO; the rest use <h2>.
$heroSlides = [
    [
        'image' => IMG_PATH . 'front_page_image.jpg',
        'alt' => 'Patient on a stretcher being transferred to an Ashoka Rescue air ambulance',
        'kicker' => 'Doctor-led medical transport · Est. 2004',
        'title' => 'Critical-care transport.<br><span>Bedside to bedside.</span>',
        'text' => 'Aeromedical and ground ambulance coordination — ICU-configured aircraft and ALS/BLS road ambulances, dispatched 24/7 across India and worldwide.',
    ],
    [
        'image' => IMG_PATH . 'air-ambulance-banner-image.jpg',
        'alt' => 'Ashoka Rescue air ambulance aircraft ready for medical evacuation',
        'kicker' => 'Charter air ambulance · Domestic & international',
        'title' => 'ICU in the air.<br><span>Monitored throughout.</span>',
        'text' => 'Fixed-wing air ambulances configured for high-acuity transfers, escorted by critical-care doctors and paramedics from bedside to bedside.',
    ],
    [
        'image' => IMG_PATH . 'charter-ambulance.jpg',
        'alt' => 'Ashoka Rescue advanced life-support ground ambulance',
        'kicker' => 'ALS/BLS ground ambulance · Inter-facility transfers',
        'title' => 'Advanced life support.<br><span>On every mile.</span>',
        'text' => 'ALS and BLS road ambulances with cardiac monitoring and oxygen support for safe inter-hospital and airport transfers, day and night.',
    ],
];

// Hero slider initialization (printed by footer.php via $additionalScripts)
$additionalScripts = <<<'SCRIPTS'
<script>
    document.addEventListener('DOMContentLoaded', function () {
        if (typeof Swiper === 'undefined') {
            return;
        }
        var reduceMotion = window.matchMedia('(prefers-reduced-motion: reduce)').matches;
        var heroSwiper = new Swiper('.heroSwiper', {
            effect: 'fade',
            fadeEffect: { crossFade: true },
            speed: 1000,
            loop: true,
            autoplay: reduceMotion ? false : {
                delay: 6000,
                disableOnInteraction: false,
                pauseOnMouseEnter: true
            },
            keyboard: { enabled: true },
            a11y: { enabled: true },
            on: {
                slideChange: function () {
                    var idx = this.realIndex;
                    document.querySelectorAll('.rx-copy-pane').forEach(function (pane, pi) {
                        pane.classList.toggle('active', pi === idx);
                    });
                    document.querySelectorAll('.rx-thumbs button').forEach(function (btn, bi) {
                        btn.classList.toggle('active', bi === idx);
                    });
                }
            }
        });

        // Command-deck thumbnails drive the hero viewport
        document.querySelectorAll('.rx-thumbs button').forEach(function (btn) {
            btn.addEventListener('click', function () {
                heroSwiper.slideToLoop(parseInt(btn.getAttribute('data-goto'), 10));
            });
        });

        // How It Works — vertical stepper tab switching (desktop)
        var hwNav = document.getElementById('v-pills-tab');
        var hwPanes = document.querySelectorAll('#myTabContent .tab-pane');
        function hwActivate(index) {
            hwPanes.forEach(function (pane, i) {
                pane.classList.toggle('show', i === index);
                pane.classList.toggle('active', i === index);
            });
            if (hwNav) {
                hwNav.querySelectorAll('.nav-link').forEach(function (btn, i) {
                    btn.classList.toggle('active', i === index);
                    btn.classList.toggle('done', i < index);
                    btn.setAttribute('aria-selected', i === index ? 'true' : 'false');
                });
            }
        }
        if (hwNav) {
            hwNav.querySelectorAll('.nav-link').forEach(function (btn, idx) {
                btn.addEventListener('click', function () { hwActivate(idx); });
            });
        }
        // Keep the fade transition in sync with the mobile accordion
        document.querySelectorAll('#myTabContent .accordion-collapse').forEach(function (collapseEl) {
            collapseEl.addEventListener('show.bs.collapse', function () {
                var pane = collapseEl.closest('.tab-pane');
                if (pane) pane.classList.add('show');
            });
            collapseEl.addEventListener('hide.bs.collapse', function () {
                var pane = collapseEl.closest('.tab-pane');
                if (pane && !pane.classList.contains('active')) pane.classList.remove('show');
            });
        });

        // Testimonials — custom arrows
        var tstEl = document.querySelector('.testimonialSwiper');
        var tstSwiper = tstEl && tstEl.swiper;
        if (tstSwiper) {
            var tstPrev = document.querySelector('.tst-prev');
            var tstNext = document.querySelector('.tst-next');
            if (tstPrev) tstPrev.addEventListener('click', function () { tstSwiper.slidePrev(); });
            if (tstNext) tstNext.addEventListener('click', function () { tstSwiper.slideNext(); });
        }
    });
</script>
SCRIPTS;
?>

<!-- Hero Section: command deck -->
<section class="hero-section hero-slider rx-hero rx-command">
    <span class="rx-orb rx-orb--red" aria-hidden="true"></span>
    <span class="rx-orb rx-orb--cyan" aria-hidden="true"></span>
    <div class="rx-ghostword" aria-hidden="true">Rescue</div>
    <div class="container rx-command-grid">
        <div class="rx-command-copy">
            <div class="rx-copy-panes">
                <?php foreach ($heroSlides as $slideIndex => $slide): ?>
                    <?php $titleTag = $slideIndex === 0 ? 'h1' : 'h2'; ?>
                    <div class="rx-copy-pane<?php echo $slideIndex === 0 ? ' active' : ''; ?>">
                        <span class="hero-kicker"><i class="fa-solid fa-circle-check"></i> <?php echo htmlspecialchars($slide['kicker']); ?></span>
                        <<?php echo $titleTag; ?> class="hero-title" data-rx-words><?php echo $slide['title']; ?></<?php echo $titleTag; ?>>
                        <p><?php echo htmlspecialchars($slide['text']); ?></p>
                    </div>
                <?php endforeach; ?>
            </div>
            <div class="hero-actions">
                <a href="tel:<?php echo str_replace(' ', '', EMERGENCY_PHONE); ?>" class="btn hero-primary rx-btn rx-btn--red" data-magnetic>
                    <i class="fa-solid fa-phone"></i> Call emergency desk
                </a>
                <a href="<?php echo SITE_URL; ?>/contact" class="btn hero-secondary rx-btn rx-btn--ghost" data-magnetic>Request assistance <i class="fa-solid fa-arrow-right"></i></a>
            </div>
            <div class="rx-dispatch" aria-label="Dispatch status">
                <span class="rx-live" aria-hidden="true"></span>
                <span><strong>Dispatch active</strong> — medical crews on standby, 24/7</span>
            </div>
            <div class="hero-meta" aria-label="Service highlights">
                <div><strong>24/7</strong><span>Response team</span></div>
                <div><strong>20+</strong><span>Years of care</span></div>
                <div><strong>Global</strong><span>Coordination</span></div>
            </div>
        </div>
        <div class="rx-command-visual" data-rx="left">
            <div class="rx-viewport rx-ticks">
                <div class="swiper heroSwiper">
                    <div class="swiper-wrapper">
                        <?php foreach ($heroSlides as $slideIndex => $slide): ?>
                            <div class="swiper-slide">
                                <div class="rx-viewport-img">
                                    <img src="<?php echo $slide['image']; ?>" class="img-fluid"
                                        alt="<?php echo htmlspecialchars($slide['alt']); ?>"
                                        width="1920" height="1080"
                                        <?php echo $slideIndex === 0 ? 'fetchpriority="high" decoding="async"' : 'loading="lazy" decoding="async"'; ?>>
                                </div>
                            </div>
                        <?php endforeach; ?>
                    </div>
                </div>
                <div class="rx-viewport-hud" aria-hidden="true"><span class="rx-live"></span> Fleet feed</div>
            </div>
            <div class="rx-thumbs" role="group" aria-label="Choose hero story">
                <?php foreach ($heroSlides as $slideIndex => $slide): ?>
                    <button type="button" data-goto="<?php echo $slideIndex; ?>" class="<?php echo $slideIndex === 0 ? 'active' : ''; ?>" aria-label="Show: <?php echo htmlspecialchars($slide['kicker']); ?>">
                        <img src="<?php echo $slide['image']; ?>" alt="" loading="lazy">
                    </button>
                <?php endforeach; ?>
            </div>
        </div>
    </div>
    <div class="rx-scroll-cue" aria-hidden="true"></div>
</section>
<!--/Hero Section -->

<section class="rx-ticker-band" aria-label="Ashoka Rescue service assurances">
    <div class="rx-ticker" data-ticker>
        <div class="rx-ticker-track">
            <span class="rx-ticker-item"><i class="fa-solid fa-user-doctor"></i><strong>Doctor-led medical escorts</strong> Critical-care doctors, nurses &amp; paramedics</span>
            <span class="rx-ticker-dot" aria-hidden="true"></span>
            <span class="rx-ticker-item"><i class="fa-solid fa-plane-departure"></i><strong>Bedside-to-bedside coordination</strong> Aircraft, clearances &amp; receiving facility</span>
            <span class="rx-ticker-dot" aria-hidden="true"></span>
            <span class="rx-ticker-item"><i class="fa-solid fa-shield-heart"></i><strong>Fit-to-fly assessment</strong> Medical clearance before every transfer</span>
            <span class="rx-ticker-dot" aria-hidden="true"></span>
            <span class="rx-ticker-item"><i class="fa-solid fa-phone-volume"></i><strong>24/7 emergency desk</strong> <?php echo EMERGENCY_PHONE; ?></span>
            <span class="rx-ticker-dot" aria-hidden="true"></span>
        </div>
    </div>
</section>

<!-- Services: expandable editorial directory -->
<section class="service-section transport-directory rx-sec-py">
    <div class="container transport-directory-layout">
        <div class="transport-directory-intro">
            <p class="rx-kicker">Fleet &amp; capability</p>
            <h2 class="rx-sec-title">Medical Transport Services</h2>
            <p class="rx-lead">Charter air ambulance, commercial airline stretcher services, and ALS/BLS ground ambulances — matched to patient acuity, with ICU-configured equipment and doctor-led medical escorts.</p>
            <a href="<?php echo SITE_URL; ?>/services" class="transport-directory-all">
                All services <i class="fa-solid fa-arrow-right" aria-hidden="true"></i>
            </a>
        </div>
        <div class="transport-directory-list">
            <?php foreach ($list as $serviceIndex => $item): ?>
                <details class="transport-entry" name="transport-services"<?php echo $serviceIndex === 0 ? ' open' : ''; ?>>
                    <summary class="transport-entry-heading">
                        <span class="transport-entry-thumbnail">
                            <img src="<?php echo SITE_URL . $item['banner']; ?>"
                                alt="" loading="lazy" width="144" height="112">
                        </span>
                        <h3><?php echo htmlspecialchars($item['title']); ?></h3>
                        <span class="transport-entry-toggle" aria-hidden="true">
                            <i class="fa-solid fa-plus"></i>
                        </span>
                    </summary>
                    <div class="transport-entry-content">
                        <a class="transport-entry-image" href="<?php echo getServiceURL($item['slug']); ?>"
                            aria-label="<?php echo htmlspecialchars($item['title']); ?>">
                            <img src="<?php echo SITE_URL . $item['banner']; ?>"
                                alt="<?php echo htmlspecialchars($item['title']); ?>"
                                loading="lazy" width="800" height="600">
                            <span aria-hidden="true"><i class="fa-solid fa-arrow-up-right-from-square"></i></span>
                        </a>
                        <div class="transport-entry-description"><?php echo $item['content']; ?></div>
                        <a class="transport-entry-link" href="<?php echo getServiceURL($item['slug']); ?>">
                            View service brief <i class="fa-solid fa-arrow-right" aria-hidden="true"></i>
                        </a>
                    </div>
                </details>
            <?php endforeach; ?>
        </div>
    </div>
</section>
<!--/Service Section -->

<!-- Why Choose Us Section -->
<section class="wh-us-section rx-why rx-sec-py">
    <div class="container">
        <div class="rx-overlap">
            <div class="rx-overlap-media">
                <div class="rx-frame rx-ticks" data-rx="zoom">
                    <img src="<?php echo IMG_PATH; ?>images-ambulance_others/001 AM.jpg" class="img-fluid" alt="Ashoka Rescue ambulance on standby">
                    <div class="rx-float-badge" style="left:1.2rem;bottom:1.2rem;"><strong>20+</strong><small>Years of<br>aeromedical care</small></div>
                </div>
            </div>
            <div class="rx-overlap-card" data-rx="left">
                <div class="wh-content rx-why-copy">
                    <p class="rx-kicker" data-rx>The clinical edge</p>
                    <h2 class="rx-sec-title" data-rx style="--rx-d:.08s">Why choose us?</h2>
                    <span class="sub-title">"We accept, what we can" <br> "What we can, we assure that"</span>
                    <p>Established in 2004, Ashoka Rescue Air Ambulance Services Pvt Ltd provides doctor-led
                        aeromedical and ground medical transport across India and internationally. Every transfer is
                        planned around patient acuity — treating-doctor consultation, fit-to-fly assessment, an
                        ICU-configured aircraft or ALS/BLS road ambulance, and bedside-to-bedside handover.</p>
                    <ul class="rx-spec-list" data-rx style="--rx-d:.15s">
                        <li>
                            <span class="icon"><img src="<?php echo IMG_PATH; ?>icons/star.svg" class="img-fluid"
                                    alt=""></span>
                            20+ years in aeromedical transport
                        </li>
                        <li>
                            <span class="icon"><img src="<?php echo IMG_PATH; ?>icons/doc-md.svg" class="img-fluid"
                                    alt=""></span>
                            Treating-doctor &amp; family consultation
                        </li>
                        <li>
                            <span class="icon"><img src="<?php echo IMG_PATH; ?>icons/medical-care.svg"
                                    class="img-fluid" alt=""></span>
                            ICU-configured equipment
                        </li>
                        <li>
                            <span class="icon"><img src="<?php echo IMG_PATH; ?>icons/experience.svg" class="img-fluid"
                                    alt=""></span>
                            Domestic &amp; international coverage
                        </li>
                    </ul>
                    <a href="<?php echo SITE_URL; ?>/about" class="rx-btn rx-btn--navy" data-magnetic>Know More <i class="fa-solid fa-arrow-right"></i></a>
                </div>
            </div>
        </div>
    </div>
</section>
<!--/Why Choose Us Section -->

<!-- Our Service/Story Section -->
<section class="clinical-journal rx-sec-py">
    <div class="container">
        <div class="clinical-journal-heading">
            <div>
                <p class="rx-kicker">Case files</p>
                <h2 class="rx-sec-title">Clinical Transport, End to End</h2>
            </div>
            <p class="clinical-journal-intro">From referral call to handover, our medical team plans
                each transfer around the patient's condition — acuity assessment, treating-doctor review, aircraft
                or ambulance configuration, and bedside-to-bedside escort, by charter or commercial carrier,
                across India and worldwide.</p>
        </div>
        <div class="swiper storySwiper clinical-journal-slider">
            <div class="clinical-journal-toolbar">
                <p class="rx-kicker">Case file</p>
                <div class="clinical-journal-controls">
                    <button class="journal-prev" type="button" aria-label="Previous story"><i class="fa-solid fa-arrow-left" aria-hidden="true"></i></button>
                    <button class="journal-next" type="button" aria-label="Next story"><i class="fa-solid fa-arrow-right" aria-hidden="true"></i></button>
                </div>
            </div>
            <div class="swiper-wrapper">
                <?php foreach ($ourStories as $story): ?>
                    <article class="swiper-slide clinical-journal-entry story-feature">
                        <div class="clinical-journal-gallery">
                            <img src="<?php echo SITE_URL . $story['img1']; ?>"
                                alt="<?php echo htmlspecialchars($story['title']); ?>" loading="lazy" width="1000" height="650">
                        </div>
                        <div class="clinical-journal-copy">
                            <h3><?php echo htmlspecialchars($story['title']); ?></h3>
                            <div class="clinical-journal-text"><?php echo $story['content']; ?></div>
                        </div>
                    </article>
                <?php endforeach; ?>
            </div>
        </div>
    </div>
</section>
<!--/Story Section -->

<!-- How It Works Section -->
<section class="hw-section rx-hw workflow-redesign rx-sec-py">
    <span class="rx-orb rx-orb--red" style="bottom:-140px;right:-120px;" aria-hidden="true"></span>
    <div class="container" style="position:relative;z-index:1;">
        <div class="row justify-content-center">
            <div class="col-lg-8">
                <div class="section-header text-center" data-rx>
                    <p class="rx-kicker rx-kicker--center rx-kicker--light">Mission protocol</p>
                    <h2 class="rx-sec-title rx-sec-title--light">How It Works</h2>
                    <p class="rx-lead rx-lead--light">A clinical workflow — from referral call to bedside handover.</p>
                </div>
            </div>
        </div>
        <div class="tab-container">
            <div class="row">
                <div class="col-lg-6">
                    <p class="hw-rail-label d-none d-lg-block">Flight plan</p>
                    <div class="rx-hw-rail">
                    <svg class="rx-hw-route" viewBox="0 0 4 100" preserveAspectRatio="none" aria-hidden="true"><line x1="2" y1="0" x2="2" y2="100" vector-effect="non-scaling-stroke"/></svg>
                    <ul class="nav flex-column d-none d-lg-flex" id="v-pills-tab" role="tablist"
                        aria-orientation="vertical">
                        <li class="nav-item" role="presentation">
                            <button class="nav-link active" id="tab-1" aria-selected="true" type="button" role="tab" aria-controls="tab-pane-1"><i class="fa-solid fa-phone" aria-hidden="true"></i><span>Call Our Expert</span></button>
                        </li>
                        <li class="nav-item" role="presentation">
                            <button class="nav-link" id="tab-2" aria-selected="false" type="button" role="tab" aria-controls="tab-pane-2"><i class="fa-solid fa-file-medical" aria-hidden="true"></i><span>Send Your Report</span></button>
                        </li>
                        <li class="nav-item" role="presentation">
                            <button class="nav-link" id="tab-3" aria-selected="false" type="button" role="tab" aria-controls="tab-pane-3"><i class="fa-solid fa-user-doctor" aria-hidden="true"></i><span>Consult with Doctor & Treating Doctor</span></button>
                        </li>
                        <li class="nav-item" role="presentation">
                            <button class="nav-link" id="tab-4" aria-selected="false" type="button" role="tab" aria-controls="tab-pane-4"><i class="fa-solid fa-video" aria-hidden="true"></i><span>Make a conference with
                                Doctor</span></button>
                        </li>
                        <li class="nav-item" role="presentation">
                            <button class="nav-link" id="tab-5" aria-selected="false" type="button" role="tab" aria-controls="tab-pane-5"><i class="fa-solid fa-clipboard-check" aria-hidden="true"></i><span>Medical Clearance & Requirement
                                Discussion</span></button>
                        </li>
                        <li class="nav-item" role="presentation">
                            <button class="nav-link" id="tab-6" aria-selected="false" type="button" role="tab" aria-controls="tab-pane-6"><i class="fa-solid fa-kit-medical" aria-hidden="true"></i><span>Ask Our Team About Your
                                Requirement</span></button>
                        </li>
                        <li class="nav-item" role="presentation">
                            <button class="nav-link" id="tab-7" aria-selected="false" type="button" role="tab" aria-controls="tab-pane-7"><i class="fa-solid fa-file-invoice" aria-hidden="true"></i><span>Quote</span></button>
                        </li>
                    </ul>
                    </div>
                </div>

                <div class="col-lg-6">
                    <div class="tab-content accordion" id="myTabContent">
                        <div class="tab-pane fade show active accordion-item" id="tab-pane-1" role="tabpanel"
                            aria-labelledby="tab-1" tabindex="0">
                            <h2 class="accordion-header d-lg-none" id="heading_1">
                                <button class="accordion-button" type="button" data-bs-toggle="collapse"
                                    data-bs-target="#collapse_1" aria-expanded="true" aria-controls="collapse_1">Call
                                    Our Expert</button>
                            </h2>
                            <div id="collapse_1" class="accordion-collapse collapse show  d-lg-block"
                                aria-labelledby="heading_1" data-bs-parent="#myTabContent">
                                <div class="accordion-body">
                                    <div class="img-box">
                                        <img src="https://images.unsplash.com/photo-1511707171634-5f897ff02aa9?auto=format&fit=crop&w=900&q=70" class="img-fluid" alt="Hand holding a phone to call our medical transport experts" loading="lazy" decoding="async" width="900" height="506">
                                    </div>
                                    <div>
                                        <h3 class="title">Speak with our medical transport coordinators</h3>
                                        <p>Our dispatch team assesses patient acuity, location and timeline to recommend
                                            the right modality — charter air ambulance, commercial airline stretcher, or
                                            ALS/BLS ground ambulance — and assigns a doctor-led escort team.</p>
                                        <a href="<?php echo SITE_URL; ?>/contact" class="btn btn-solid btn-md rounded">Contact Us</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!--/accordion-item -->

                        <!-- Other accordion items (2-7) would follow the same pattern -->
                        <div class="tab-pane fade accordion-item" id="tab-pane-2" role="tabpanel"
                            aria-labelledby="tab-2" tabindex="0">
                            <h2 class="accordion-header d-lg-none" id="heading_2">
                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                                    data-bs-target="#collapse_2" aria-expanded="false"
                                    aria-controls="collapse_2">Send Your Report</button>
                            </h2>
                            <div id="collapse_2" class="accordion-collapse collapse d-lg-block"
                                aria-labelledby="heading_2" data-bs-parent="#myTabContent">
                                <div class="accordion-body">
                                    <div class="img-box">
                                        <img src="https://images.unsplash.com/photo-1576091160399-112ba8d25d1d?auto=format&fit=crop&w=900&q=70" class="img-fluid" alt="Doctor reviewing patient medical records on a tablet" loading="lazy" decoding="async" width="900" height="506">
                                    </div>
                                    <div>
                                        <h3 class="title">Share the patient's medical records</h3>
                                        <p>Send recent reports, investigations and the treating doctor's summary. Our team
                                            reviews diagnosis, vitals, oxygen and ventilator requirements to configure the
                                            right equipment and crew for the transfer.</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="tab-pane fade accordion-item" id="tab-pane-3" role="tabpanel"
                            aria-labelledby="tab-3" tabindex="0">
                            <h2 class="accordion-header d-lg-none" id="heading_3">
                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                                    data-bs-target="#collapse_3" aria-expanded="false"
                                    aria-controls="collapse_3">Consult with Doctor & Treating Doctor</button>
                            </h2>
                            <div id="collapse_3" class="accordion-collapse collapse d-lg-block"
                                aria-labelledby="heading_3" data-bs-parent="#myTabContent">
                                <div class="accordion-body">
                                    <div class="img-box">
                                        <img src="https://images.unsplash.com/photo-1579684385127-1ef15d508118?auto=format&fit=crop&w=900&q=70" class="img-fluid" alt="Doctor in clinical consultation" loading="lazy" decoding="async" width="900" height="506">
                                    </div>
                                    <div>
                                        <h3 class="title">Clinical review with the treating doctor</h3>
                                        <p>Our medical lead confers with the treating doctor to confirm fitness for transport,
                                            agree on the in-transit care plan, and define monitoring and intervention protocols
                                            for the journey.</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="tab-pane fade accordion-item" id="tab-pane-4" role="tabpanel"
                            aria-labelledby="tab-4" tabindex="0">
                            <h2 class="accordion-header d-lg-none" id="heading_4">
                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                                    data-bs-target="#collapse_4" aria-expanded="false" aria-controls="collapse_4">Make a
                                    conference with Doctor</button>
                            </h2>
                            <div id="collapse_4" class="accordion-collapse collapse d-lg-block"
                                aria-labelledby="heading_4" data-bs-parent="#myTabContent">
                                <div class="accordion-body">
                                    <div class="img-box">
                                        <img src="https://images.unsplash.com/photo-1573164713988-8665fc963095?auto=format&fit=crop&w=900&q=70" class="img-fluid" alt="Video conference aligning the medical team and family" loading="lazy" decoding="async" width="900" height="506">
                                    </div>
                                    <div>
                                        <h3 class="title">Align everyone on the plan</h3>
                                        <p>A joint call with the family, the treating doctor and our medical team to align on
                                            risks, the transport plan, timelines and cost — before anything is dispatched.</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="tab-pane fade accordion-item" id="tab-pane-5" role="tabpanel"
                            aria-labelledby="tab-5" tabindex="0">
                            <h2 class="accordion-header d-lg-none" id="heading_5">
                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                                    data-bs-target="#collapse_5" aria-expanded="false"
                                    aria-controls="collapse_5">Medical Clearance & Requirement Discussion</button>
                            </h2>
                            <div id="collapse_5" class="accordion-collapse collapse d-lg-block"
                                aria-labelledby="heading_5" data-bs-parent="#myTabContent">
                                <div class="accordion-body">
                                    <div class="img-box">
                                        <img src="https://images.unsplash.com/photo-1576091160550-2173dba999ef?auto=format&fit=crop&w=900&q=70" class="img-fluid" alt="Doctor reviewing fit-to-fly medical clearance on a tablet" loading="lazy" decoding="async" width="900" height="506">
                                    </div>
                                    <div>
                                        <h3 class="title">Fit-to-fly and fit-for-transfer clearance</h3>
                                        <p>Formal medical clearance for the journey, airline medical approval where required,
                                            and confirmation of the receiving facility and bed — completed before we move the patient.</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="tab-pane fade accordion-item" id="tab-pane-6" role="tabpanel"
                            aria-labelledby="tab-6" tabindex="0">
                            <h2 class="accordion-header d-lg-none" id="heading_6">
                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                                    data-bs-target="#collapse_6" aria-expanded="false" aria-controls="collapse_6">Ask
                                    Our Team About Your Requirement</button>
                            </h2>
                            <div id="collapse_6" class="accordion-collapse collapse d-lg-block"
                                aria-labelledby="heading_6" data-bs-parent="#myTabContent">
                                <div class="accordion-body">
                                    <div class="img-box">
                                        <img src="https://images.unsplash.com/photo-1516549655169-df83a0774514?auto=format&fit=crop&w=900&q=70" class="img-fluid" alt="Clinical team preparing medical equipment for transfer" loading="lazy" decoding="async" width="900" height="506">
                                    </div>
                                    <div>
                                        <h3 class="title">Finalise the equipment configuration</h3>
                                        <p>We lock down oxygen, suction, monitoring and stretcher requirements, plus ground
                                            handling, airport transfers and travel documentation for the patient and escort team.</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="tab-pane fade accordion-item" id="tab-pane-7" role="tabpanel"
                            aria-labelledby="tab-7" tabindex="0">
                            <h2 class="accordion-header d-lg-none" id="heading_7">
                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                                    data-bs-target="#collapse_7" aria-expanded="false"
                                    aria-controls="collapse_7">Quote</button>
                            </h2>
                            <div id="collapse_7" class="accordion-collapse collapse d-lg-block"
                                aria-labelledby="heading_7" data-bs-parent="#myTabContent">
                                <div class="accordion-body">
                                    <div class="img-box">
                                        <img src="https://images.unsplash.com/photo-1554224155-6726b3ff858f?auto=format&fit=crop&w=900&q=70" class="img-fluid" alt="Transparent itemised quote documentation" loading="lazy" decoding="async" width="900" height="506">
                                    </div>
                                    <div>
                                        <h3 class="title">Transparent, itemised quote</h3>
                                        <p>A written quote covering the aircraft or ambulance, medical crew, equipment, ground
                                            handling and permits — confirmed before dispatch, with no hidden charges.</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!--/tab-content -->
                </div>
            </div>
        </div>
        <!--/tab-container -->
    </div>
</section>
<!--/How It Works Section -->

<script>
    // Set content for text-to-speech
    var content = $("#voice_text").text();
</script>

<?php
// Include footer
include __DIR__ . '/includes/footer.php';
?>
