<?php
$heroSlides = [
    [
        "image" =>
            "https://images.unsplash.com/photo-1767868277770-d8cb69800992?auto=format&fit=crop&w=1800&q=85",
        "alt" => "Passenger aircraft on an airport runway",
        "eyebrow" => "INTERNATIONAL MEDICAL TRANSPORTATION",
        "heading" => "Critical-care transport.",
        "accent" => "Bedside to bedside.",
        "description" =>
            "Aeromedical and ground ambulance coordination — ICU-configured aircraft and ALS/BLS road ambulances, dispatched 24/7 across India and worldwide.",
        "photographer" => "Sevcan Alkan",
        "source" =>
            "https://unsplash.com/photos/airplane-on-the-runway-at-an-airport-XIIemdIapJs",
    ],
    [
        "image" =>
            "https://images.unsplash.com/photo-1766225534572-09ab3be9bd73?auto=format&fit=crop&w=1800&q=85",
        "alt" => "Medical professional with supplies inside an aircraft",
        "eyebrow" => "DOCTOR-LED MEDICAL ESCORTS",
        "heading" => "Care throughout",
        "accent" => "the journey.",
        "description" =>
            "Medical escorts, patient monitoring and transport planning shaped around the patient’s needs, with treating-doctor consultation and coordination from bedside to bedside.",
        "photographer" => "Annie Spratt",
        "source" =>
            "https://unsplash.com/photos/doctor-sitting-in-cargo-plane-with-medical-supplies-lA1CPo7mxVY",
    ],
    [
        "image" =>
            "https://images.unsplash.com/photo-1716166112462-9afeaaf3d4f6?auto=format&fit=crop&w=1800&q=85",
        "alt" => "Passenger aircraft departing an international airport",
        "eyebrow" => "DOMESTIC & INTERNATIONAL COORDINATION",
        "heading" => "Across destinations.",
        "accent" => "Connected by care.",
        "description" =>
            "Explore charter air ambulance, commercial stretcher and medical escort services. Our coordination team helps arrange the journey, medical clearances and destination handover.",
        "photographer" => "David Syphers",
        "source" =>
            "https://unsplash.com/photos/a-large-jetliner-flying-over-an-airport-runway-6gGbPKKdWp8",
    ],
]; ?>
<section class="flight-hero flight-carousel" aria-label="Medical transportation services" aria-roledescription="carousel" data-hero-carousel>
    <div class="flight-slides">
        <?php foreach ($heroSlides as $slideIndex => $slide): ?>
            <div class="flight-slide<?php echo $slideIndex === 0
                ? " is-active"
                : ""; ?>"
                role="group" aria-roledescription="slide" aria-label="<?php echo $slideIndex +
                    1 .
                    " of " .
                    count($heroSlides); ?>"
                aria-hidden="<?php echo $slideIndex === 0
                    ? "false"
                    : "true"; ?>"<?php echo $slideIndex === 0
    ? ""
    : " inert"; ?>>
                <img class="flight-hero-image" src="<?php echo htmlspecialchars(
                    $slide["image"],
                    ENT_QUOTES,
                ); ?>"
                    data-fallback="<?php echo IMG_PATH; ?>hero-flight.jpg"
                    alt="<?php echo htmlspecialchars(
                        $slide["alt"],
                        ENT_QUOTES,
                    ); ?>" width="1800" height="1100"
                    <?php echo $slideIndex === 0
                        ? 'fetchpriority="high"'
                        : 'loading="lazy"'; ?> decoding="async">
                <div class="flight-grid" aria-hidden="true"></div>
                <div class="container flight-hero-content">
                    <p class="flight-eyebrow"><?php echo htmlspecialchars(
                        $slide["eyebrow"],
                    ); ?></p>
                    <?php $headingTag = $slideIndex === 0 ? "h1" : "h2"; ?>
                    <<?php echo $headingTag; ?> class="flight-slide-title"><?php echo htmlspecialchars(
     $slide["heading"],
 ); ?><br><em><?php echo htmlspecialchars(
    $slide["accent"],
); ?></em></<?php echo $headingTag; ?>>
                    <p class="flight-description"><?php echo htmlspecialchars(
                        $slide["description"],
                    ); ?></p>
                    <div class="flight-actions">
                        <a class="flight-button flight-button-primary" href="#assistance">Request assistance <i class="fa-solid fa-arrow-right" aria-hidden="true"></i></a>
                        <a class="flight-button flight-button-outline" href="<?php echo SITE_URL; ?>/services">Explore our services</a>
                    </div>
                    <div class="flight-reassurance"><i class="fa-solid fa-user-doctor" aria-hidden="true"></i> Doctor-led medical transport <span>Est. 2004</span></div>
                </div>
                <a class="flight-image-credit" href="<?php echo htmlspecialchars(
                    $slide["source"],
                    ENT_QUOTES,
                ); ?>" target="_blank" rel="noopener">Illustrative photo: <?php echo htmlspecialchars(
    $slide["photographer"],
); ?> / Unsplash</a>
            </div>
        <?php endforeach; ?>
    </div>
    <div class="container flight-carousel-controls" aria-label="Hero slideshow controls">
        <div class="flight-slide-indicators">
            <?php foreach ($heroSlides as $slideIndex => $slide): ?>
                <button type="button" class="flight-slide-indicator<?php echo $slideIndex ===
                0
                    ? " is-active"
                    : ""; ?>"
                    data-hero-slide="<?php echo $slideIndex; ?>" aria-label="Show slide <?php echo $slideIndex +
    1; ?>: <?php echo htmlspecialchars($slide["heading"], ENT_QUOTES); ?>"
                    aria-current="<?php echo $slideIndex === 0
                        ? "true"
                        : "false"; ?>"><span></span></button>
            <?php endforeach; ?>
        </div>
        <div class="flight-carousel-navigation">
            <span class="flight-slide-count" aria-hidden="true">01 / 03</span>
            <button type="button" data-hero-previous aria-label="Previous slide"><i class="fa-solid fa-arrow-left" aria-hidden="true"></i></button>
            <button type="button" data-hero-next aria-label="Next slide"><i class="fa-solid fa-arrow-right" aria-hidden="true"></i></button>
        </div>
        <span class="visually-hidden" data-hero-status role="status" aria-live="polite"></span>
    </div>
    <div class="container flight-hero-bottom">
        <p>Compassion on the ground.<br><strong>Continuity of care in the air.</strong></p>
        <a href="tel:<?php echo str_replace(
            " ",
            "",
            EMERGENCY_PHONE,
        ); ?>"><i class="fa-solid fa-phone-volume" aria-hidden="true"></i><span>24/7 medical coordination<strong><?php echo EMERGENCY_PHONE; ?></strong></span></a>
    </div>
</section>
