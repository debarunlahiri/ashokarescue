<?php
$homeHeroSlides = [
    [
        "eyebrow" => "ASHOKA RESCUE / MEDICAL TRANSPORT",
        "title" => "Medical transport.",
        "accent" => "Care at every step.",
        "description" =>
            "Air ambulance, medical escorts and ground transfers. Our team helps coordinate your loved one’s journey, from bedside to bedside, in India and worldwide.",
        "image" => "hero-flight.jpg",
        "alt" => "Medical transfer team assisting a patient beside an aircraft",
        "label" => "CARE WITHOUT DISTANCE",
        "captionLabel" => "ON THE GROUND. IN THE AIR.",
        "caption" => "From bedside to bedside.",
        "icon" => "fa-plane-departure",
    ],
    [
        "eyebrow" => "ASHOKA RESCUE / AIR AMBULANCE",
        "title" => "Dedicated aircraft.",
        "accent" => "Focused on your care.",
        "description" =>
            "Charter air ambulance arrangements shaped around the patient’s medical needs. Our team coordinates the medical crew, equipment and ground connections for the journey.",
        "image" => "charter-air.jpg",
        "alt" =>
            "Medical professional attending to a patient inside an air ambulance",
        "label" => "MEDICAL CARE IN THE AIR",
        "captionLabel" => "A JOURNEY PLANNED AROUND YOU.",
        "caption" => "Medical support throughout.",
        "icon" => "fa-heart-pulse",
    ],
    [
        "eyebrow" => "ASHOKA RESCUE / ROAD AMBULANCE",
        "title" => "Every connection.",
        "accent" => "Considered with care.",
        "description" =>
            "From hospital transfers to airport connections, our team helps arrange ALS and BLS road ambulance support to connect each stage of your loved one’s journey.",
        "image" => "ambulance-service-about.jpg",
        "alt" => "Road ambulance for patient transport and ground connections",
        "label" => "CONNECTED GROUND TRANSFERS",
        "captionLabel" => "FROM PICKUP TO HANDOVER.",
        "caption" => "Care beyond the flight.",
        "icon" => "fa-truck-medical",
    ],
]; ?>
<section class="nh-hero-carousel" data-home-carousel aria-label="Medical transport highlights" aria-roledescription="carousel">
    <div class="nh-hero-slides">
        <?php foreach ($homeHeroSlides as $slideIndex => $slide): ?>
            <div class="nh-hero nh-hero-slide<?php echo $slideIndex === 0
                ? " is-active"
                : ""; ?>" id="nh-hero-slide-<?php echo $slideIndex; ?>" data-home-slide role="group" aria-roledescription="slide" aria-label="<?php echo $slideIndex +
    1 .
    " of " .
    count($homeHeroSlides); ?>" aria-hidden="<?php echo $slideIndex === 0
    ? "false"
    : "true"; ?>"<?php echo $slideIndex === 0 ? "" : " inert"; ?>>
                <div class="nh-hero-copy">
                    <p class="nh-kicker"><span></span><?php echo htmlspecialchars(
                        $slide["eyebrow"],
                    ); ?></p>
                    <?php $headingTag = $slideIndex === 0 ? "h1" : "h2"; ?>
                    <<?php echo $headingTag; ?> class="nh-hero-title"><?php echo htmlspecialchars(
     $slide["title"],
 ); ?><br><em><?php echo htmlspecialchars(
    $slide["accent"],
); ?></em></<?php echo $headingTag; ?>>
                    <p class="nh-intro"><?php echo htmlspecialchars(
                        $slide["description"],
                    ); ?></p>
                    <div class="nh-actions">
                        <a class="nh-button" href="#assistance">Arrange a transfer <i class="fa-solid fa-arrow-up-right-from-square" aria-hidden="true"></i></a>
                        <a class="nh-link" href="#nh-services">Find your service <i class="fa-solid fa-arrow-down" aria-hidden="true"></i></a>
                    </div>
                    <div class="nh-hero-foot"><i class="fa-solid fa-shield-heart" aria-hidden="true"></i><span>Doctor-led coordination.<br><strong>With you at every connection.</strong></span><span class="nh-since">Since<br><strong>2004</strong></span></div>
                </div>
                <div class="nh-hero-visual">
                    <img src="<?php echo IMG_PATH .
                        htmlspecialchars(
                            $slide["image"],
                            ENT_QUOTES,
                        ); ?>" alt="<?php echo htmlspecialchars(
    $slide["alt"],
    ENT_QUOTES,
); ?>" <?php echo $slideIndex === 0
    ? 'fetchpriority="high"'
    : 'loading="lazy"'; ?> decoding="async">
                    <div class="nh-visual-top"><span><?php echo htmlspecialchars(
                        $slide["label"],
                    ); ?></span><i class="fa-solid <?php echo $slide[
    "icon"
]; ?>" aria-hidden="true"></i></div>
                    <div class="nh-visual-caption"><span><?php echo htmlspecialchars(
                        $slide["captionLabel"],
                    ); ?></span><p><?php echo htmlspecialchars(
    $slide["caption"],
); ?></p></div>
                    <a class="nh-photo-link" href="<?php echo SITE_URL; ?>/about" aria-label="Meet Ashoka Rescue"><i class="fa-solid fa-arrow-right" aria-hidden="true"></i></a>
                </div>
            </div>
        <?php endforeach; ?>
    </div>
    <div class="nh-carousel-controls" aria-label="Slideshow controls">
        <div class="nh-carousel-dots">
            <?php foreach ($homeHeroSlides as $slideIndex => $slide): ?>
                <button type="button" data-home-goto="<?php echo $slideIndex; ?>" aria-controls="nh-hero-slide-<?php echo $slideIndex; ?>" aria-label="Show slide <?php echo $slideIndex +
    1; ?>: <?php echo htmlspecialchars(
    $slide["title"],
    ENT_QUOTES,
); ?>" aria-current="<?php echo $slideIndex === 0
    ? "true"
    : "false"; ?>"><span></span></button>
            <?php endforeach; ?>
        </div>
    </div>
    <span class="visually-hidden" data-home-status role="status" aria-live="polite"></span>
</section>
