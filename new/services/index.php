<?php
/**
 * Services directory - Ashoka Rescue Air Ambulance Services.
 */
$pageTitle = "Our Services | Ashoka Rescue Medical Transport";
$pageDescription =
    "Comprehensive medical transport services including air ambulance, commercial stretcher, road ambulance, and medical tourism assistance.";
$pageKeywords =
    "Medical Services, Ambulance Services, Air Ambulance, Commercial Stretcher, Medical Transport";
$additionalStyles =
    '<link rel="stylesheet" href="../assets/css/services-refresh.css?v=' .
    filemtime(__DIR__ . "/../assets/css/services-refresh.css") .
    '">';
include __DIR__ . "/../includes/header.php";

$list = getPublicServices();
?>

<div class="sr-services">
    <section class="sr-hero" aria-labelledby="sr-title">
        <div class="container sr-hero-grid">
            <div class="sr-hero-copy">
                <p class="sr-label">Our medical transport services</p>
                <h1 id="sr-title">The right care.<br>The right journey.<br><span>All the way there.</span></h1>
                <p class="sr-intro">By air, road, or rail, we connect patients to the care they need. Every transfer is coordinated around their condition, comfort, and destination.</p>
                <div class="sr-actions">
                    <a class="sr-button" href="#service-directory">Find a service <i class="fa-solid fa-arrow-down" aria-hidden="true"></i></a>
                    <a class="sr-text-link" href="<?php echo SITE_URL; ?>/contact">Ask our team <i class="fa-solid fa-arrow-right" aria-hidden="true"></i></a>
                </div>
                <div class="sr-availability"><span class="sr-icon"><i class="fa-solid fa-headset" aria-hidden="true"></i></span><span>Here for your next step.<br><strong>Medical coordination available 24/7</strong></span></div>
            </div>
            <figure class="sr-hero-photo">
                <img src="<?php echo IMG_PATH; ?>service-banner.jpg" alt="Medical transportation with Ashoka Rescue" fetchpriority="high">
                <figcaption><i class="fa-solid fa-shield-heart" aria-hidden="true"></i><span>Patient first.<strong>From bedside to bedside.</strong></span></figcaption>
            </figure>
        </div>
    </section>

    <section class="sr-care-strip" aria-label="Our approach to medical transfers">
        <div class="container sr-care-grid">
            <div><i class="fa-solid fa-user-doctor" aria-hidden="true"></i><span>Doctor-led coordination</span></div>
            <div><i class="fa-solid fa-heart-pulse" aria-hidden="true"></i><span>Care around the patient</span></div>
            <div><i class="fa-solid fa-globe" aria-hidden="true"></i><span>India &amp; international transfers</span></div>
            <div><i class="fa-solid fa-hand-holding-heart" aria-hidden="true"></i><span>Support for every family</span></div>
        </div>
    </section>

    <section class="sr-directory sr-section" id="service-directory" aria-labelledby="sr-directory-title">
        <div class="container">
            <div class="sr-directory-heading">
                <div><p class="sr-label">Explore our services</p><h2 id="sr-directory-title">Different needs.<br>The same commitment to care.</h2></div>
                <p>Explore transport options and specialist patient services. Our team can help you understand which approach fits your medical requirements.</p>
            </div>
            <div class="sr-directory-tools" data-service-tools hidden>
                <div class="sr-search-field"><label for="sr-search">Find the care you need</label><div><i class="fa-solid fa-magnifying-glass" aria-hidden="true"></i><input type="search" id="sr-search" placeholder="Search air ambulance, stretcher, medical escort…" autocomplete="off" aria-controls="sr-service-grid"></div></div>
                <p id="sr-result-count" role="status" aria-live="polite" aria-atomic="true"></p>
            </div>
            <div class="sr-service-grid" id="sr-service-grid">
                <?php foreach ($list as $item):

                    $excerpt = trim(
                        preg_replace(
                            "/\s+/",
                            " ",
                            html_entity_decode(
                                strip_tags((string) $item["content"]),
                                ENT_QUOTES,
                                "UTF-8",
                            ),
                        ),
                    );
                    if (mb_strlen($excerpt) > 165) {
                        $excerpt = mb_substr($excerpt, 0, 165) . "…";
                    }
                    $serviceUrl = htmlspecialchars(
                        getServiceURL($item["slug"]),
                        ENT_QUOTES,
                        "UTF-8",
                    );
                    $serviceTitle = htmlspecialchars(
                        $item["title"],
                        ENT_QUOTES,
                        "UTF-8",
                    );
                    $serviceImage = htmlspecialchars(
                        SITE_URL . $item["banner"],
                        ENT_QUOTES,
                        "UTF-8",
                    );
                    ?>
                    <article class="sr-service-card" data-service-card>
                        <a class="sr-card-image" href="<?php echo $serviceUrl; ?>" aria-label="<?php echo $serviceTitle; ?>"><img src="<?php echo $serviceImage; ?>" alt="<?php echo $serviceTitle; ?>" loading="lazy" decoding="async"><span aria-hidden="true"><i class="fa-solid fa-arrow-up-right-from-square"></i></span></a>
                        <div class="sr-card-copy"><h3><a href="<?php echo $serviceUrl; ?>"><?php echo $serviceTitle; ?></a></h3><p><?php echo htmlspecialchars(
    $excerpt,
    ENT_QUOTES,
    "UTF-8",
); ?></p><a class="sr-card-link" href="<?php echo $serviceUrl; ?>">Explore this service <i class="fa-solid fa-arrow-right" aria-hidden="true"></i><span class="sr-visually-hidden">: <?php echo $serviceTitle; ?></span></a></div>
                    </article>
                <?php
                endforeach; ?>
            </div>
            <?php if (empty($list)): ?>
                <div class="sr-empty"><h3>Our service directory is currently unavailable.</h3><p>Please <a href="<?php echo SITE_URL; ?>/contact">contact our team</a> for help with medical transportation.</p></div>
            <?php endif; ?>
            <div class="sr-empty" id="sr-no-results" hidden><i class="fa-solid fa-magnifying-glass" aria-hidden="true"></i><h3>No services match your search.</h3><p>Try a different term, or contact our team for help finding the right service.</p><button type="button" class="sr-button" id="sr-clear-search">Show all services</button></div>
        </div>
    </section>

    <section class="sr-planning sr-section" aria-labelledby="sr-planning-title">
        <div class="container sr-planning-grid">
            <div><p class="sr-label">A little clarity when it matters</p><h2 id="sr-planning-title">Not sure where<br>to begin?</h2><p>You don’t need to navigate the options alone. Share the patient’s situation with our team, and we’ll help you plan the next step.</p><a class="sr-text-link" href="<?php echo SITE_URL; ?>/contact">Discuss a patient transfer <i class="fa-solid fa-arrow-right" aria-hidden="true"></i></a></div>
            <div class="sr-planning-list">
                <article><span class="sr-icon"><i class="fa-solid fa-notes-medical" aria-hidden="true"></i></span><div><h3>Tell us about the patient</h3><p>Share the current condition and medical requirements so the team can understand the care needed during travel.</p></div></article>
                <article><span class="sr-icon"><i class="fa-solid fa-route" aria-hidden="true"></i></span><div><h3>Share the route</h3><p>Let us know the pickup location and destination. We coordinate the transport around the journey and clinical needs.</p></div></article>
                <article><span class="sr-icon"><i class="fa-solid fa-comments" aria-hidden="true"></i></span><div><h3>Plan with our team</h3><p>Talk through the available options, arrangements, and next steps with our medical coordination team.</p></div></article>
            </div>
        </div>
    </section>

    <section class="sr-contact" aria-labelledby="sr-contact-title"><div class="container sr-contact-grid"><div><p class="sr-label">Always ready to listen</p><h2 id="sr-contact-title">Your next step starts<br>with a conversation.</h2><p>Medical transport assistance, available around the clock.</p></div><div class="sr-contact-actions"><a class="sr-button" href="tel:<?php echo htmlspecialchars(
        preg_replace("/\s+/", "", EMERGENCY_PHONE),
        ENT_QUOTES,
    ); ?>"><i class="fa-solid fa-phone" aria-hidden="true"></i> Call the emergency desk</a><a class="sr-button sr-button-outline" href="<?php echo SITE_URL; ?>/contact">Request assistance <i class="fa-solid fa-arrow-right" aria-hidden="true"></i></a></div></div></section>
</div>
<script src="<?php echo SITE_URL; ?>/assets/js/services-directory.js?v=<?php echo filemtime(
    __DIR__ . "/../assets/js/services-directory.js",
); ?>" defer></script>
<?php include __DIR__ . "/../includes/footer.php"; ?>
