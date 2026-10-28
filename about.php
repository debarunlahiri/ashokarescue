<?php
/**
 * About Page - Ashoka Rescue Air Ambulance Services
 */

// Page-specific variables
$pageTitle = 'About Ashoka Rescue | Expert Medical Transport';
$pageDescription = 'Discover Ashoka Rescue\'s mission and trusted expertise in medical transport since 2004. Safe, efficient patient transfers with top-notch care.';
$pageKeywords = 'About Ashoka Rescue, Expert Medical Transport, Medical Ambulance Services, Air Ambulance Service, Road Ambulance Service';
$additionalStyles = '<link rel="stylesheet" href="assets/css/home-modern.css?v=' . filemtime(__DIR__ . '/assets/css/home-modern.css') . '">'
    . '<link rel="stylesheet" href="assets/css/about-modern.css?v=' . filemtime(__DIR__ . '/assets/css/about-modern.css') . '">'
    . '<link rel="stylesheet" href="assets/css/rx-about.css?v=' . filemtime(__DIR__ . '/assets/css/rx-about.css') . '">';

// Include header
include __DIR__ . '/includes/header.php';
?>

<!-- Banner Section -->
<section class="banner-section about-banner banner-section-bg rx-banner rx-dark">
    <span class="rx-orb rx-orb--red" aria-hidden="true"></span>
    <span class="rx-orb rx-orb--cyan" aria-hidden="true"></span>
    <div class="banner-bg">
        <img src="<?php echo IMG_PATH; ?>about-banner.jpg" class="img-fluid" alt="">
    </div>
    <div class="container">
        <div class="banner-content">
            <span class="about-eyebrow" data-rx><i class="fa-solid fa-shield-heart"></i> Trusted medical transport since 2004</span>
            <h1 class="banner-title" data-aos="fade-up" data-aos-duration="1500">Care that travels<br><span>wherever you need it.</span></h1>
            <p>Specialist medical teams, seamless coordination, and compassionate support for patients in India and across the world.</p>
        </div>
    </div>
</section>
<!--/Banner Section -->

<!-- About Section -->
<section class="about-section rx-about rx-sec-py">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-12">
                <div class="row align-items-center">
                    <div class="col-lg-4">
                        <div class="about-img rx-frame rx-ticks" data-rx="zoom">
                            <img src="<?php echo IMG_PATH; ?>certificate.jpg" class="img-fluid" alt="Ashoka Rescue certification">
                        </div>
                    </div>
                    <div class="col-lg-8">
                        <div class="about-content" data-rx="left">
                            <p class="rx-kicker">Who we are</p>
                            <h2 class="rx-sec-title">Ashoka Rescue Air Ambulance</h2>
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
                            <div class="about-stat-grid rx-about-stat" aria-label="Ashoka Rescue at a glance" data-rx style="--rx-d:.15s">
                                <div><strong>20+</strong><span>Years of experience</span></div>
                                <div><strong>8,000+</strong><span>Patient transfers</span></div>
                                <div><strong>24/7</strong><span>Medical coordination</span></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!--/About Section -->

<!-- Mentor Section -->
<section class="mentor-section rx-mentor rx-sec-py">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-lg-7 order-last order-lg-first">
                <div class="mentor-about" data-rx="right">
                    <p class="rx-kicker rx-kicker--light">Clinical leadership</p>
                    <h2 class="rx-sec-title rx-sec-title--light">About Our Mentor</h2>
                    <span class="mentor-cred">DR. ASHOK KUMAR M.D., FEM RCGP.</span>
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
            <div class="col-lg-5 order-first order-lg-last">
                <div class="mentor-img rx-frame rx-ticks rx-ticks--cyan" data-rx="zoom">
                    <img src="<?php echo IMG_PATH; ?>mentor.jpg" class="img-fluid" alt="Dr. Ashok Kumar, Director of Ashoka Rescue">
                </div>
            </div>
        </div>
    </div>
</section>
<!--/Mentor Section -->

<!-- How We Assist Section -->
<section class="hw-we-section rx-assist rx-sec-py">
    <div class="container">
        <div class="hw-we-content">
            <div class="section-header">
                <p class="rx-kicker" data-rx>End-to-end support</p>
                <h2 class="rx-sec-title" data-rx style="--rx-d:.08s">How we assist patients</h2>
                <p class="rx-lead" data-rx style="--rx-d:.15s">Every transfer is planned around the patient’s condition, route, clinical requirements, and comfort.</p>
            </div>
            <div class="hw-assist-grid rx-assist-grid">
                <article class="hw-assist-card rx-assist-card" data-rx>
                    <span class="hw-assist-icon"><i class="fa-solid fa-clipboard-check"></i></span>
                    <h3>Commercial &amp; charter assistance</h3>
                    <p>Comprehensive support across commercial and charter services — patient comfort, safety and well-being managed through every stage of the journey.</p>
                </article>
                <article class="hw-assist-card rx-assist-card" data-rx style="--rx-d:.1s">
                    <span class="hw-assist-icon"><i class="fa-solid fa-bed-pulse"></i></span>
                    <h3>Commercial stretcher protocol</h3>
                    <p>A full clinical assessment first, coordinated with the treating team. We secure airline medical clearances, convert cabin seating into certified stretcher space, and provide continuous nurse-led monitoring throughout the flight.</p>
                </article>
                <article class="hw-assist-card rx-assist-card" data-rx style="--rx-d:.2s">
                    <span class="hw-assist-icon"><i class="fa-solid fa-plane-departure"></i></span>
                    <h3>Bespoke charter operations</h3>
                    <p>For complex or time-critical cases: a dedicated medical aircraft configured to the patient's needs, with coordinated ground transfers at both ends of the journey.</p>
                </article>
                <article class="hw-assist-card rx-assist-card" data-rx style="--rx-d:.3s">
                    <span class="hw-assist-icon"><i class="fa-solid fa-hand-holding-heart"></i></span>
                    <h3>Family-centred commitment</h3>
                    <p>Clear communication and compassionate support for patients and families at every step — before, during and after the transfer.</p>
                </article>
            </div>
        </div>
    </div>
</section>
<!--/How We Section -->

<!-- CTA Section -->
<section class="cta-section rx-cta">
    <div class="cta-img" data-aos="zoom-in" data-aos-duration="1000">
        <img src="<?php echo IMG_PATH; ?>Rectangle-2033.jpg" class="img-fluid" alt="">
    </div>
    <div class="about-cta-content">
        <span>Medical assistance is available around the clock</span>
        <h2>Need help planning a safe patient transfer?</h2>
        <div class="about-cta-actions">
            <a href="tel:<?php echo str_replace(' ', '', EMERGENCY_PHONE); ?>" class="btn about-cta-primary rx-btn rx-btn--red" data-magnetic><i class="fa-solid fa-phone"></i> Call emergency desk</a>
            <a href="<?php echo SITE_URL; ?>/contact" class="btn about-cta-secondary rx-btn rx-btn--ghost" data-magnetic>Request assistance <i class="fa-solid fa-arrow-right"></i></a>
        </div>
    </div>
</section>
<!--/CTA Section -->

<!-- Our Company Section -->
<section class="reputation-section rx-sec-py">
    <div class="container reputation-layout">
        <div class="reputation-intro">
            <p class="rx-kicker rx-kicker--light">Why families choose us</p>
            <h2>Our Company Brand &amp; Reputation</h2>
            <div class="reputation-track-record">
                <span class="reputation-record-icon" aria-hidden="true"><i class="fa-solid fa-plane-departure"></i></span>
                <p>We have successfully shifted over <strong>5000</strong> patients by air
                ambulance and <strong>3000</strong> commercial stretchers worldwide, delivering the best results.</p>
            </div>
        </div>
        <ul class="reputation-points">
                <li class="reputation-point">
                    <span class="reputation-icon" aria-hidden="true"><i class="fa-solid fa-heart-pulse"></i></span>
                    <p>Our reputation is built on our ability to handle critical,
                complex patients with all required ACLS life-saving equipment, ensuring seamless bed-to-bed
                transportation.</p>
                </li>
                <li class="reputation-point">
                    <span class="reputation-icon" aria-hidden="true"><i class="fa-solid fa-shield-heart"></i></span>
                    <p>We adhere to international standard protocols, equipped with
                certified qualified medical crew and state-of-the-art equipment.</p>
                </li>
                <li class="reputation-point">
                    <span class="reputation-icon" aria-hidden="true"><i class="fa-solid fa-globe"></i></span>
                    <p>Genuine references worldwide will bolster your confidence in
                our services.</p>
                </li>
                <li class="reputation-point">
                    <span class="reputation-icon" aria-hidden="true"><i class="fa-solid fa-hand-holding-heart"></i></span>
                    <p>Our team is committed to assisting individual clients with
                utmost dedication, compassion, and commitment to excellence.</p>
                </li>
        </ul>
    </div>
</section>
<!--/Our Company Section -->

<!-- Featured Section -->
<section class="about-featured-section rx-values rx-sec-py">
    <div class="container">
        <div class="row">
            <div class="col-lg-4">
                <div class="card rx-value-card" data-rx data-tilt="5">
                    <div class="value-icon"><i class="fa-solid fa-comments"></i></div>
                    <div class="card-body">
                        <h3 class="title">Communication</h3>
                        <p>Ashoka Rescue Air Ambulance Services provides comprehensive air transportation solutions for
                            aeromedical evacuation needs. Our services encompass the use of airplanes to facilitate the
                            swift and efficient transfer of patients to and from healthcare facilities and accident
                            scenes.</p>
                    </div>
                </div>
                <!--/card -->
            </div>
            <div class="col-lg-4">
                <div class="card rx-value-card" data-rx style="--rx-d:.12s" data-tilt="5">
                    <div class="value-icon"><i class="fa-solid fa-handshake-angle"></i></div>
                    <div class="card-body">
                        <h3 class="title">Trust</h3>
                        <p>Trust is earned through transparency, reliability, and accountability. At Ashoka Rescue, we
                            strive to build and maintain trust between our clients and our company resources by
                            providing all necessary documents, qualifications, experiences, and references worldwide.
                        </p>
                    </div>
                </div>
                <!--/card -->
            </div>
            <div class="col-lg-4">
                <div class="card rx-value-card" data-rx style="--rx-d:.24s" data-tilt="5">
                    <div class="value-icon"><i class="fa-solid fa-chart-line"></i></div>
                    <div class="card-body">
                        <h3 class="title">Effectiveness</h3>
                        <p>Our effectiveness is the result of a combination of factors, including the latest skills,
                            experienced staff, and cutting-edge equipment. We continuously strive to enhance our
                            efficiency and effectiveness by staying abreast of the latest advancements in medical
                            transportation technology and practices.</p>
                    </div>
                </div>
                <!--/card -->
            </div>
        </div>
    </div>
</section>
<!--/Featured Section -->

<!-- Approach Section -->
<section class="approach-section rx-approach rx-sec-py">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-lg-5">
                <div class="approach-img rx-frame rx-ticks" data-rx="zoom">
                    <img src="<?php echo IMG_PATH; ?>approach.jpg" class="img-fluid" alt="Ashoka Rescue patient-first approach">
                </div>
            </div>
            <div class="col-lg-7">
                <div class="approach-content" data-rx="left">
                    <p class="rx-kicker">Patient-first by design</p>
                    <h2 class="rx-sec-title">Our Approach, Care & Guidance</h2>
                    <p>At Ashoka Rescue, our approach to patient care is characterized by compassion, professionalism,
                        and unwavering dedication. We understand that each patient's situation is unique, which is why
                        we take a personalized approach to every case. From the moment you reach out to us, our team has
                        been dedicated to providing comprehensive care and guidance every step of the way. </p>
                    <p>We prioritize clear communication, ensuring that you are fully informed and supported throughout
                        the entire process. Whether you require medical transportation services commercially or through
                        charter, we offer expert guidance and assistance tailored to your specific needs. Our commitment
                        to excellence extends beyond mere transportation – we provide comfort, reassurance, and peace of
                        mind to patients and their families during what can often be a challenging time. With Ashoka
                        Rescue, you can trust that you are in capable hands, receiving the highest standard of care and
                        support throughout your journey</p>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Mission Statement Section -->
<section class="purpose-section rx-purpose rx-sec-py">
    <div class="container">
        <div class="row g-4">
            <div class="col-lg-6">
                <div class="purpose-card rx-purpose-card" data-rx>
                    <span class="purpose-icon"><i class="fa-solid fa-bullseye"></i></span>
                    <span class="section-kicker">Our purpose</span>
                    <h2 class="section-title">Mission</h2>
                    <p>At Ashoka Rescue, our mission is to provide compassionate and reliable medical transportation
                        services to patients globally. Using our extensive expertise and global partnerships, we strive
                        to ensure every patient reaches their destination safely and comfortably, upholding the highest
                        standards of care and trust.</p>
                </div>
            </div>
            <div class="col-lg-6">
                <div class="purpose-card purpose-card-dark rx-purpose-card rx-purpose-card--dark" data-rx style="--rx-d:.12s">
                    <span class="purpose-icon"><i class="fa-solid fa-eye"></i></span>
                    <span class="section-kicker section-kicker-light">Our future</span>
                    <h2 class="section-title">Vision</h2>
                    <p>Our vision is to transform medical transportation into a service that everyone can rely on with
                        confidence, by setting new benchmarks for quality, safety, and reliability. We dream of a world
                        where medical transport is always safe, high-quality, and readily available. By committing to
                        excellence and continuous improvement, we aim to lead the industry toward a future where every
                        patient and their family feels supported and secure on their journey.</p>
                </div>
            </div>
        </div>
    </div>
</section>

<script>
    // Set content for text-to-speech
    var content = $("#voice_text").text();
</script>

<?php
// Include footer
include __DIR__ . '/includes/footer.php';
?>
