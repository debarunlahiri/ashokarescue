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

$additionalStyles .= '<link rel="stylesheet" href="assets/css/home-services-refresh.css?v=' . filemtime(__DIR__ . '/assets/css/home-services-refresh.css') . '">';

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

// Feature air-medical services here; the service directory retains the full catalog.
$homeServiceSlugs = [
    'air-ambulance-services-in-india',
    'charter-air-ambulance-service-in-india',
    'commercial-stretcher-service',
    'business-class-medical-assistance',
    'medical-escort-and-transport',
];
$allPublicServices = array_column(getPublicServices(), null, 'slug');
$list = [];
foreach ($homeServiceSlugs as $slug) {
    if (isset($allPublicServices[$slug])) {
        $list[] = $allPublicServices[$slug];
    }
}
// Existing transfer workflow interactions.
$additionalScripts = <<<'SCRIPTS'
<script>
    document.addEventListener('DOMContentLoaded', function () {
        if (typeof Swiper === 'undefined') {
            return;
        }
        var reduceMotion = window.matchMedia('(prefers-reduced-motion: reduce)').matches;
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

<?php include __DIR__ . '/includes/hero-carousel.php'; ?>

<section class="service-assurances" aria-label="Ashoka Rescue service assurances">
    <ul class="container service-assurances-list">
        <li>
            <i class="fa-solid fa-user-doctor" aria-hidden="true"></i>
            <div>
                <strong>Doctor-led medical escorts</strong>
                <span>Critical-care doctors, nurses &amp; paramedics</span>
            </div>
        </li>
        <li>
            <i class="fa-solid fa-plane-departure" aria-hidden="true"></i>
            <div>
                <strong>Bedside-to-bedside coordination</strong>
                <span>Aircraft, clearances &amp; receiving facility</span>
            </div>
        </li>
        <li>
            <i class="fa-solid fa-shield-heart" aria-hidden="true"></i>
            <div>
                <strong>Fit-to-fly assessment</strong>
                <span>Medical clearance before every transfer</span>
            </div>
        </li>
        <li>
            <i class="fa-solid fa-phone-volume" aria-hidden="true"></i>
            <div>
                <strong>24/7 emergency desk</strong>
                <a href="tel:<?php echo str_replace(' ', '', EMERGENCY_PHONE); ?>">
                    <?php echo EMERGENCY_PHONE; ?>
                </a>
            </div>
        </li>
    </ul>
</section>

<!-- Medical transport service explorer -->
<section id="medical-services" class="hx-services" aria-labelledby="hx-title">
    <div class="container">
        <header class="hx-heading"><div><p class="hx-eyebrow">Care, connected.</p><h2 id="hx-title">Every journey needs<br><span>the right kind of care.</span></h2></div><a class="hx-directory" href="<?php echo SITE_URL; ?>/services/">Discover all services <i class="fa-solid fa-arrow-right" aria-hidden="true"></i></a></header>
        <div class="hx-explorer" data-service-explorer>
            <div class="hx-selector">
                <p class="hx-selector-label">Explore your options</p>
                <div class="hx-tabs" aria-label="Medical transport services">
                    <?php foreach ($list as $serviceIndex => $item): ?>
                        <a class="hx-tab" id="hx-tab-<?php echo $serviceIndex; ?>" href="#hx-panel-<?php echo $serviceIndex; ?>" data-service-tab><span class="hx-tab-icon"><i class="fa-solid <?php echo ['fa-plane', 'fa-plane-departure', 'fa-bed-pulse', 'fa-chair', 'fa-user-doctor'][$serviceIndex] ?? 'fa-heart-pulse'; ?>" aria-hidden="true"></i></span><span><?php echo htmlspecialchars($item['title'], ENT_QUOTES, 'UTF-8'); ?></span><i class="fa-solid fa-arrow-right hx-tab-arrow" aria-hidden="true"></i></a>
                    <?php endforeach; ?>
                </div>
                <div class="hx-help"><i class="fa-solid fa-headset" aria-hidden="true"></i><div><strong>Not sure where to start?</strong><a href="<?php echo SITE_URL; ?>/contact">Let’s find the right option together.</a></div></div>
            </div>
            <div class="hx-panels">
                <?php foreach ($list as $serviceIndex => $item):
                    $title = htmlspecialchars($item['title'], ENT_QUOTES, 'UTF-8');
                    $url = htmlspecialchars(getServiceURL($item['slug']), ENT_QUOTES, 'UTF-8');
                    $image = htmlspecialchars(SITE_URL . $item['banner'], ENT_QUOTES, 'UTF-8');
                    $summary = trim(preg_replace('/\s+/', ' ', html_entity_decode(strip_tags($item['content']), ENT_QUOTES, 'UTF-8')));
                    if (mb_strlen($summary) > 180) {
                        $short = mb_substr($summary, 0, 180);
                        $space = mb_strrpos($short, ' ');
                        $summary = ($space !== false ? mb_substr($short, 0, $space) : $short) . '…';
                    }
                ?>
                    <article class="hx-panel" id="hx-panel-<?php echo $serviceIndex; ?>" data-service-panel>
                        <img class="hx-photo" src="<?php echo $image; ?>" alt="<?php echo $title; ?>" loading="lazy" decoding="async">
                        <span class="hx-photo-label"><i class="fa-solid fa-shield-heart" aria-hidden="true"></i> Patient first. Always.</span>
                        <div class="hx-panel-copy"><p class="hx-panel-eyebrow">Ashoka Rescue · Medical transport</p><h3><?php echo $title; ?></h3><p class="hx-summary"><?php echo htmlspecialchars($summary, ENT_QUOTES, 'UTF-8'); ?></p><a class="hx-service-link" href="<?php echo $url; ?>">Explore this service <span><i class="fa-solid fa-arrow-right" aria-hidden="true"></i></span></a></div>
                    </article>
                <?php endforeach; ?>
            </div>
        </div>
        <div class="hx-footer"><span><i class="fa-solid fa-heart-pulse" aria-hidden="true"></i> Planned around the patient. Coordinated for the journey.</span><span>India &amp; worldwide</span></div>
    </div>
</section>
<script src="<?php echo SITE_URL; ?>/assets/js/home-services-explorer.js?v=<?php echo filemtime(__DIR__ . '/assets/js/home-services-explorer.js'); ?>" defer></script>
<!--/Service Section -->

<!-- Why Choose Us Section -->
<section class="care-perspective" aria-labelledby="care-perspective-title">
    <div class="container">
        <div class="care-perspective-heading">
            <div>
                <p class="care-eyebrow">THE CLINICAL EDGE</p>
                <h2 id="care-perspective-title">Why choose <span>us?</span></h2>
            </div>
            <div class="care-perspective-intro">
                <p>Established in 2004, Ashoka Rescue Air Ambulance Services Pvt Ltd provides doctor-led
                    aeromedical and ground medical transport across India and internationally. Every transfer is
                    planned around patient acuity — treating-doctor consultation, fit-to-fly assessment, an
                    ICU-configured aircraft or ALS/BLS road ambulance, and bedside-to-bedside handover.</p>
                <a href="<?php echo SITE_URL; ?>/about" class="care-about-link">Know More
                    <span><i class="fa-solid fa-arrow-right" aria-hidden="true"></i></span>
                </a>
            </div>
        </div>
        <div class="care-perspective-story">
            <figure class="care-team-photo">
                <img src="<?php echo IMG_PATH; ?>images-ambulance_others/001 AM.jpg"
                    alt="Ashoka Rescue medical team beside an ambulance during a patient transfer"
                    width="1200" height="900" loading="lazy">
                <figcaption><span></span> ASHOKA RESCUE <span class="care-photo-divider"></span> BEDSIDE TO BEDSIDE</figcaption>
            </figure>
            <div class="care-principle">
                <i class="fa-solid fa-quote-left" aria-hidden="true"></i>
                <p>We accept,<br>what we can.</p>
                <p>What we can,<br><em>we assure that.</em></p>
                <span>OUR COMMITMENT TO CARE</span>
            </div>
        </div>
        <ul class="care-capabilities" aria-label="Why families choose Ashoka Rescue">
            <li>
                <i class="fa-solid fa-calendar-check" aria-hidden="true"></i>
                <h3>20+ years</h3>
                <p>in aeromedical transport</p>
            </li>
            <li>
                <i class="fa-solid fa-user-doctor" aria-hidden="true"></i>
                <h3>Doctor &amp; family</h3>
                <p>consultation for every transfer</p>
            </li>
            <li>
                <i class="fa-solid fa-heart-pulse" aria-hidden="true"></i>
                <h3>ICU-configured</h3>
                <p>equipment around patient needs</p>
            </li>
            <li>
                <i class="fa-solid fa-globe" aria-hidden="true"></i>
                <h3>Beyond borders</h3>
                <p>domestic &amp; international coverage</p>
            </li>
        </ul>
    </div>
</section>
<!--/Why Choose Us Section -->



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

<?php include __DIR__ . '/includes/coverage.php'; ?>
<?php include __DIR__ . '/includes/reviews.php'; ?>
<?php include __DIR__ . '/includes/inquiry-form.php'; ?>
<?php include __DIR__ . '/includes/home-faq.php'; ?>
<?php include __DIR__ . '/includes/journal.php'; ?>
<?php
// Include footer
include __DIR__ . '/includes/footer.php';
?>
