<?php
/**
 * About Page - Ashoka Rescue Air Ambulance Services
 */

// Page-specific variables
$pageTitle = "About Ashoka Rescue | Expert Medical Transport";
$pageDescription =
    'Discover Ashoka Rescue\'s mission and trusted expertise in medical transport since 2004. Safe, efficient patient transfers with top-notch care.';
$pageKeywords =
    "About Ashoka Rescue, Expert Medical Transport, Medical Ambulance Services, Air Ambulance Service, Road Ambulance Service";
$additionalStyles =
    '<link rel="stylesheet" href="assets/css/about-refresh.css?v=' .
    filemtime(__DIR__ . "/assets/css/about-refresh.css") .
    '">';

$additionalStyles .=
    '<link rel="stylesheet" href="assets/css/about-reimagined.css?v=' .
    filemtime(__DIR__ . "/assets/css/about-reimagined.css") .
    '">';

include __DIR__ . "/includes/header.php";
?>

<div class="ar-about">
    <section class="ar-hero" aria-labelledby="ar-about-title">
        <div class="container ar-hero-grid">
            <div class="ar-hero-copy">
                <p class="ar-label">About Ashoka Rescue</p>
                <h1 id="ar-about-title">Every journey.<br>Every patient.<br><em>Care comes first.</em></h1>
                <p class="ar-intro">When the journey matters most, we bring medical expertise and human care together. By your side, from one bedside to the next.</p>
                <div class="ar-actions">
                    <a class="ar-button" href="<?php echo SITE_URL; ?>/contact">Talk to our team <i class="fa-solid fa-arrow-right" aria-hidden="true"></i></a>
                    <a class="ar-text-link" href="#our-story">Discover our story <i class="fa-solid fa-arrow-down" aria-hidden="true"></i></a>
                </div>
                <div class="ar-hero-note"><i class="fa-solid fa-shield-heart" aria-hidden="true"></i><span>Medical transport in India &amp; worldwide<br><strong>Serving patients since 2004</strong></span></div>
            </div>
            <figure class="ar-hero-image">
                <img src="<?php echo IMG_PATH; ?>hero-flight.jpg" alt="Aircraft used for medical air transportation" fetchpriority="high">
                <figcaption><span class="ar-icon"><i class="fa-solid fa-heart-pulse" aria-hidden="true"></i></span><span>Expertise in motion.<br><strong>Compassion at every step.</strong></span></figcaption>
                <span class="ar-image-label">Across cities. Across borders.</span>
            </figure>
        </div>
    </section>

    <div id="about-content">
        <section class="ab-overview ab-section" id="our-story" aria-labelledby="ab-story-title">
            <div class="ab-wrap">
                <div class="ab-overview-heading">
                    <div><p class="ab-eyebrow">WHO WE ARE</p><h2 id="ab-story-title">Medical expertise.<br>A human commitment.</h2></div>
                    <p class="ab-overview-intro">Helping patients reach the care they need, with a team that understands what the journey means.</p>
                </div>
                <div class="ab-story-grid">
                    <div class="ab-story-photo">
                        <img src="<?php echo IMG_PATH; ?>approach.jpg" alt="Medical transport and patient care" loading="lazy" width="900" height="650">
                        <div class="ab-established"><i class="fa-solid fa-shield-heart" aria-hidden="true"></i><span>Established in<strong>2004</strong></span></div>
                    </div>
                    <div class="ab-story-copy">
                        <h3>Care that connects.<br>From one bedside to the next.</h3>
                        <p>Ashoka Rescue Air Ambulance Services Pvt. Ltd. provides medical transportation across India and internationally. Since 2004, we have brought medical expertise and transport coordination together for patients and families.</p>
                        <p>Our services include charter air ambulance, commercial stretcher travel, medical escorts, road ambulance transfers and medical tourism assistance. Each journey is planned around the patient’s needs and destination.</p>
                        <div class="ab-story-services"><span><i class="fa-solid fa-plane" aria-hidden="true"></i> Air ambulance</span><span><i class="fa-solid fa-user-doctor" aria-hidden="true"></i> Medical escorts</span><span><i class="fa-solid fa-truck-medical" aria-hidden="true"></i> Ground transfers</span></div>
                        <a class="ab-link" href="<?php echo SITE_URL; ?>/services">Explore our services <i class="fa-solid fa-arrow-right" aria-hidden="true"></i></a>
                    </div>
                </div>
                <div class="ab-track-record" aria-label="Ashoka Rescue at a glance">
                    <div><strong>20<span>+</span></strong><p>Years of medical<br>transport experience</p></div>
                    <div><strong>5,000<span>+</span></strong><p>Air ambulance<br>patient transfers</p></div>
                    <div><strong>3,000<span>+</span></strong><p>Commercial<br>stretcher transfers</p></div>
                    <div><strong>24<span>/</span>7</strong><p>Medical coordination<br>and assistance</p></div>
                </div>
            </div>
        </section>

        <section class="ab-leadership ab-section" aria-labelledby="ab-leader-title">
            <div class="ab-wrap ab-leader-grid">
                <div class="ab-leader-copy">
                    <p class="ab-eyebrow">MEET OUR DIRECTOR</p>
                    <h2 id="ab-leader-title">Experience behind<br>every decision.</h2>
                    <p class="ab-leader-intro">Medical leadership with first-hand experience of caring for patients in transit.</p>
                    <p>Dr. Ashok Kumar brings a background in emergency medicine, critical care and flight medicine to Ashoka Rescue. His experience transporting critical patients worldwide informs the way our team approaches medical evacuation.</p>
                    <p>As Director and flight physician, his focus is on patient safety, thoughtful planning and continuity of care, with clear support for patients and families throughout the transfer.</p>
                    <div class="ab-credentials"><span><i class="fa-solid fa-stethoscope" aria-hidden="true"></i> Emergency medicine</span><span><i class="fa-solid fa-heart-pulse" aria-hidden="true"></i> Critical care</span><span><i class="fa-solid fa-plane-departure" aria-hidden="true"></i> Flight medicine</span></div>
                </div>
                <figure class="ab-doctor-card">
                    <div class="ab-portrait"><img src="<?php echo IMG_PATH; ?>mentor.jpg" alt="Dr. Ashok Kumar, Director of Ashoka Rescue" loading="lazy" width="650" height="760"></div>
                    <figcaption><div><h3>Dr. Ashok Kumar</h3><p>M.D., FEM RCGP</p><span>Director &amp; flight physician</span></div><span class="ab-doctor-icon"><i class="fa-solid fa-user-doctor" aria-hidden="true"></i></span></figcaption>
                </figure>
            </div>
        </section>

        <section class="ab-principles ab-section" aria-labelledby="ab-principles-title">
            <div class="ab-wrap">
                <div class="ab-section-heading"><div><p class="ab-eyebrow">WHAT YOU CAN EXPECT</p><h2 id="ab-principles-title">The details make<br>the difference.</h2></div><p>Medical transport involves many moving parts. These are the principles that guide how we bring them together.</p></div>
                <div class="ab-principle-grid">
                    <article><span class="ab-icon"><i class="fa-solid fa-clipboard-check" aria-hidden="true"></i></span><span class="ab-card-number">01</span><h3>Patient-led planning</h3><p>We review the patient’s condition with the treating team to help determine the appropriate transport and medical support.</p></article>
                    <article><span class="ab-icon"><i class="fa-solid fa-comments" aria-hidden="true"></i></span><span class="ab-card-number">02</span><h3>Clear communication</h3><p>Families receive guidance on transport options, travel arrangements and the next steps in their loved one’s journey.</p></article>
                    <article><span class="ab-icon"><i class="fa-solid fa-route" aria-hidden="true"></i></span><span class="ab-card-number">03</span><h3>Connected care</h3><p>Medical crew, equipment, airline requirements and ground transfers are considered together, from pickup to handover.</p></article>
                    <article><span class="ab-icon"><i class="fa-solid fa-hand-holding-heart" aria-hidden="true"></i></span><span class="ab-card-number">04</span><h3>Personal support</h3><p>We treat every transfer as a personal journey, with respect for the patient’s comfort and the family’s concerns.</p></article>
                </div>
            </div>
        </section>

        <section class="ab-purpose ab-section" aria-labelledby="ab-purpose-title">
            <div class="ab-wrap">
                <div class="ab-purpose-heading"><p class="ab-eyebrow">OUR PURPOSE</p><h2 id="ab-purpose-title">Better journeys.<br>Better access to care.</h2></div>
                <div class="ab-purpose-grid">
                    <article><div class="ab-purpose-top"><span class="ab-icon"><i class="fa-solid fa-bullseye" aria-hidden="true"></i></span><p>OUR MISSION</p></div><h3>Make reliable medical<br>transport personal.</h3><p>To provide compassionate medical transportation for patients globally, drawing on our clinical experience and international partnerships to support safe, comfortable journeys.</p></article>
                    <article><div class="ab-purpose-top"><span class="ab-icon"><i class="fa-solid fa-eye" aria-hidden="true"></i></span><p>OUR VISION</p></div><h3>A journey families<br>can approach with confidence.</h3><p>To improve access to dependable medical transport through continued attention to quality, safety and patient support, so more families can reach the care they need.</p></article>
                </div>
            </div>
        </section>

        <section class="ab-reach ab-section" aria-labelledby="ab-reach-title">
            <div class="ab-wrap ab-reach-grid">
                <div><p class="ab-eyebrow">ACROSS INDIA &amp; WORLDWIDE</p><h2 id="ab-reach-title">Different destinations.<br>One coordinated team.</h2><p>From transfers between Indian cities to international medical journeys, our team helps connect the route, medical requirements and receiving care.</p><a class="ab-link" href="<?php echo SITE_URL; ?>/contact">Discuss a destination <i class="fa-solid fa-arrow-right" aria-hidden="true"></i></a></div>
                <div class="ab-reach-details"><div><i class="fa-solid fa-location-dot" aria-hidden="true"></i><div><h3>Domestic coordination</h3><p>Serving major cities including Delhi, Mumbai, Chennai, Kolkata, Hyderabad and Bengaluru.</p></div></div><div><i class="fa-solid fa-earth-asia" aria-hidden="true"></i><div><h3>International journeys</h3><p>Transport assistance to destinations in North America, Europe, Asia, the Middle East, Africa and Australia, subject to medical and travel approvals.</p></div></div></div>
            </div>
        </section>

        <section class="ab-document-section" aria-label="Company documentation">
            <div class="ab-wrap">
                <details class="ab-document"><summary><span class="ab-document-icon"><i class="fa-solid fa-file-circle-check" aria-hidden="true"></i></span><span><strong>Our certificate of incorporation</strong><small>View Ashoka Rescue’s company registration document.</small></span><i class="fa-solid fa-chevron-down" aria-hidden="true"></i></summary><div class="ab-document-preview"><a href="<?php echo IMG_PATH; ?>certificate.jpg" target="_blank" rel="noopener"><img src="<?php echo IMG_PATH; ?>certificate.jpg" alt="Certificate of incorporation of Ashoka Rescue Air Ambulance Services Private Limited" loading="lazy"><span>Open full certificate <i class="fa-solid fa-arrow-up-right-from-square" aria-hidden="true"></i></span></a></div></details>
            </div>
        </section>

        <section class="ab-contact" aria-labelledby="ab-contact-title">
            <div class="ab-wrap ab-contact-grid"><div><p class="ab-eyebrow">HERE WHEN YOU NEED US</p><h2 id="ab-contact-title">Let’s talk about<br>the next step.</h2><p>Our medical transport coordination team is available 24 hours, every day.</p></div><div class="ab-contact-actions"><a class="ab-button" href="tel:<?php echo htmlspecialchars(
                preg_replace("/\s+/", "", EMERGENCY_PHONE),
                ENT_QUOTES,
            ); ?>"><i class="fa-solid fa-phone" aria-hidden="true"></i> <?php echo htmlspecialchars(
    EMERGENCY_PHONE,
); ?></a><a class="ab-button ab-button-outline" href="<?php echo SITE_URL; ?>/contact">Request assistance <i class="fa-solid fa-arrow-right" aria-hidden="true"></i></a></div></div>
        </section>
    </div>
</div>

<?php include __DIR__ . "/includes/footer.php"; ?>
