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

    <section class="ar-facts" aria-label="Ashoka Rescue at a glance">
        <div class="container ar-facts-grid">
            <div><strong>20+</strong><span>Years of medical transport experience</span></div>
            <div><strong>5,000+</strong><span>Air ambulance patient transfers</span></div>
            <div><strong>3,000+</strong><span>Commercial stretcher transfers</span></div>
            <div><strong>24/7</strong><span>Medical coordination &amp; assistance</span></div>
        </div>
    </section>

    <section class="ar-section ar-story" id="our-story" aria-labelledby="ar-story-title">
        <div class="container ar-story-grid">
            <div class="ar-story-heading">
                <p class="ar-label">Our story</p>
                <h2 id="ar-story-title">A purpose that goes<br>beyond transport.</h2>
                <p class="ar-statement">Connecting patients to the care they need, wherever that care may be.</p>
                <a class="ar-text-link" href="<?php echo SITE_URL; ?>/services">Explore our services <i class="fa-solid fa-arrow-right" aria-hidden="true"></i></a>
            </div>
            <div class="ar-story-copy">
                    <p>Established in 2004, Ashoka Rescue Air Ambulance Services Pvt Ltd offers worldclass
                                medical transportation, through road and air ambulances in India and across the globe.
                                Our comprehensive services include expert air medical evacuation, commercial medical
                                stretchers, medical transport assistance, and medical tourism patient treatment in India
                                and abroad, ensuring effective and timely delivery through proper medical transport
                                assistance.</p>
                    <p>We cover almost all major cities in India, including Delhi, Mumbai, Chennai, Kolkata,
                                Hyderabad, Bengaluru, Ludhiana, Pana, Punjab, Goa, Bhopal, Raipur, Srinagar, Jodhpur,
                                Udaipur, Kochi, and Trivandrum. Additionally, we extend our services to international
                                destinations such as the USA, Canada, London, UK, Australia, Germany, France, Italy,
                                Switzerland, Belgium, Bangkok, Hong Kong, Dhaka, Bangladesh, Dubai, Arab Emirates,
                                Kuwait, South Africa, Nigeria, Thailand ,Nepal, Sri Lanka, and various countries within
                                the European Union.</p>
                
                <details class="ar-document">
                    <summary><i class="fa-solid fa-file-circle-check" aria-hidden="true"></i> Our certificate of incorporation <i class="fa-solid fa-chevron-down" aria-hidden="true"></i></summary>
                    <a href="<?php echo IMG_PATH; ?>certificate.jpg" target="_blank" rel="noopener"><img src="<?php echo IMG_PATH; ?>certificate.jpg" alt="Certificate of incorporation of Ashoka Rescue Air Ambulance Services Private Limited" loading="lazy"></a>
                </details>
            </div>
        </div>
    </section>

    <section class="ar-leadership ar-section" aria-labelledby="ar-leader-title">
        <div class="container ar-leader-grid">
            <figure class="ar-portrait"><img src="<?php echo IMG_PATH; ?>mentor.jpg" alt="Dr. Ashok Kumar, Director of Ashoka Rescue" loading="lazy"><figcaption><i class="fa-solid fa-user-doctor" aria-hidden="true"></i> Clinical expertise. Personal commitment.</figcaption></figure>
            <div class="ar-leader-copy">
                <p class="ar-label">The expertise behind the care</p>
                <h2 id="ar-leader-title">Led by experience.<br>Driven by compassion.</h2>
                <div class="ar-doctor"><h3>Dr. Ashok Kumar</h3><span>M.D., FEM RCGP · Director &amp; flight physician</span></div>
                
                    <p>Dr. Ashok Kumar M.D., FEM RCGP, is the esteemed Director of Ashoka Rescue Air Ambulance Services
                        Pvt. Ltd. With a profound background in Emergency Medicine and extensive fellowships in Critical
                        Care Medicine, and flight physician. As the Managing Director, Dr. Ashok Kumar has been
                        instrumental in establishing Ashoka Rescue as a leader in the industry. His experience as a
                        flight physician transporting critical patients worldwide has equipped the company with
                        invaluable insights into the complexities of medical evacuation and patient care during transit.
                    </p>
                    <p>Dr. Kumar's commitment to excellence is reflected in Ashoka Rescue's adherence to international
                        standards and protocols, ensuring the highest level of care and safety for every patient. Under
                        his leadership, the company has earned a stellar reputation for reliability, professionalism,
                        and compassion. His vision to provide word class medical transportation have guided the company
                        to excel in delivering world-class medical transportation solutions with dedication, compassion,
                        and commitment to excellence, both domestically in India and internationally .</p>
                
            </div>
        </div>
    </section>

    <section class="ar-section" aria-labelledby="ar-journey-title">
        <div class="container">
            <div class="ar-section-heading"><div><p class="ar-label">One coordinated journey</p><h2 id="ar-journey-title">Care without the gaps.</h2></div><p>Every transfer is planned around the patient’s condition, clinical requirements, route, and comfort.</p></div>
            <div class="ar-journey">
                <article><span class="ar-icon"><i class="fa-solid fa-clipboard-check" aria-hidden="true"></i></span><h3>Understand the need</h3><p>A clinical assessment with the treating team helps us plan the appropriate commercial or charter transfer, with patient safety and comfort at the centre.</p></article>
                <article><span class="ar-icon"><i class="fa-solid fa-bed-pulse" aria-hidden="true"></i></span><h3>Prepare every detail</h3><p>For commercial stretcher transfers, we coordinate airline medical clearances, certified stretcher space, and continuous nurse-led monitoring.</p></article>
                <article><span class="ar-icon"><i class="fa-solid fa-plane-departure" aria-hidden="true"></i></span><h3>Connect the journey</h3><p>For complex or time-critical cases, a dedicated medical aircraft is configured to the patient’s needs, with ground transfers at both ends.</p></article>
                <article><span class="ar-icon"><i class="fa-solid fa-hand-holding-heart" aria-hidden="true"></i></span><h3>Support the family</h3><p>Clear communication and compassionate guidance keep patients and families supported before, during, and after the transfer.</p></article>
            </div>
        </div>
    </section>

    <section class="ar-standard ar-section" aria-labelledby="ar-standard-title">
        <div class="container ar-standard-grid">
            <div class="ar-standard-copy"><p class="ar-label">Our commitment to you</p><h2 id="ar-standard-title">Confidence comes<br>from how we care.</h2><p>From critical-care equipment to a reassuring conversation, every detail plays a part in a safe, coordinated patient transfer.</p><img src="<?php echo IMG_PATH; ?>approach.jpg" alt="Ashoka Rescue medical transport and patient care" loading="lazy"></div>
            <div class="ar-values">
                <article><span class="ar-icon"><i class="fa-solid fa-comments" aria-hidden="true"></i></span><div><h3>Communication that reassures</h3><p>We explain the options, keep families informed, and offer personalised guidance through commercial and charter transfers, from healthcare facilities and accident scenes.</p></div></article>
                <article><span class="ar-icon"><i class="fa-solid fa-handshake-angle" aria-hidden="true"></i></span><div><h3>Trust through transparency</h3><p>We provide documentation, qualifications, experience, and worldwide references so families can make informed decisions with confidence.</p></div></article>
                <article><span class="ar-icon"><i class="fa-solid fa-heart-pulse" aria-hidden="true"></i></span><div><h3>Prepared for complex care</h3><p>Qualified medical crew, ACLS life-saving equipment, and international standard protocols support seamless bed-to-bed transportation for critical patients.</p></div></article>
                <article><span class="ar-icon"><i class="fa-solid fa-chart-line" aria-hidden="true"></i></span><div><h3>Always moving care forward</h3><p>Experienced staff, current skills, and advanced equipment help us continually improve the efficiency and effectiveness of medical transport.</p></div></article>
            </div>
        </div>
    </section>

    <section class="ar-section ar-purpose" aria-label="Our mission and vision">
        <div class="container ar-purpose-grid">
            <article><p class="ar-label"><i class="fa-solid fa-bullseye" aria-hidden="true"></i> Our mission</p><h2>Make every transfer<br>a journey of care.</h2><p>At Ashoka Rescue, our mission is to provide compassionate and reliable medical transportation
                        services to patients globally. Using our extensive expertise and global partnerships, we strive
                        to ensure every patient reaches their destination safely and comfortably, upholding the highest
                        standards of care and trust.</p></article>
            <article><p class="ar-label"><i class="fa-solid fa-eye" aria-hidden="true"></i> Our vision</p><h2>A future with better<br>access to safe transport.</h2><p>Our vision is to transform medical transportation into a service that everyone can rely on with
                        confidence, by setting new benchmarks for quality, safety, and reliability. We dream of a world
                        where medical transport is always safe, high-quality, and readily available. By committing to
                        excellence and continuous improvement, we aim to lead the industry toward a future where every
                        patient and their family feels supported and secure on their journey.</p></article>
        </div>
    </section>

    <section class="ar-contact" aria-labelledby="ar-contact-title">
        <div class="container ar-contact-grid"><div><p class="ar-label">Here when you need us</p><h2 id="ar-contact-title">Let’s plan the next<br>step, together.</h2><p>Speak with our team about your patient’s medical transport needs. Assistance is available around the clock.</p></div><div class="ar-contact-actions"><a class="ar-button" href="tel:<?php echo htmlspecialchars(
            preg_replace("/\s+/", "", EMERGENCY_PHONE),
            ENT_QUOTES,
        ); ?>"><i class="fa-solid fa-phone" aria-hidden="true"></i> Call our emergency desk</a><a class="ar-button ar-button-outline" href="<?php echo SITE_URL; ?>/contact">Request assistance <i class="fa-solid fa-arrow-right" aria-hidden="true"></i></a><span><i class="fa-solid fa-headset" aria-hidden="true"></i> Available 24 hours, every day</span></div></div>
    </section>
</div>

<?php include __DIR__ . "/includes/footer.php"; ?>
