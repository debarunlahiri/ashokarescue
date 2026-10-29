<?php
/**
 * Home Page - Ashoka Rescue Air Ambulance Services
 */

// Page-specific variables
$pageTitle = "Ashoka Rescue | Air Ambulance & Critical Care Medical Transport";
$pageDescription =
    "Doctor-led air ambulance, commercial stretcher and ALS/BLS road ambulance services across India and worldwide. ICU-configured transfers with 24/7 medical coordination since 2004.";
$pageKeywords =
    "Air Ambulance India, Medical Evacuation, Critical Care Transport, Commercial Stretcher Service, ALS Ambulance, Road Ambulance Service, Medical Transport Services";
$additionalStyles =
    '<link rel="stylesheet" href="assets/css/home-reimagined.css?v=' .
    filemtime(__DIR__ . "/assets/css/home-reimagined.css") .
    '">';

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

$additionalScripts =
    '<script src="assets/js/home-hero-carousel.js?v=' .
    filemtime(__DIR__ . "/assets/js/home-hero-carousel.js") .
    '" defer></script>';

include __DIR__ . "/includes/header.php";

$homeServices = [
    [
        "title" => "Charter air ambulance",
        "slug" => "charter-air-ambulance-service-in-india",
        "image" => "charter-air.jpg",
        "icon" => "fa-plane",
        "label" => "Dedicated aircraft",
        "description" =>
            "A dedicated flight with medical support planned around the patient’s condition.",
    ],
    [
        "title" => "Commercial stretcher",
        "slug" => "commercial-stretcher-service",
        "image" => "hero-flight.jpg",
        "icon" => "fa-bed-pulse",
        "label" => "Scheduled flights",
        "description" =>
            "Supported stretcher travel on commercial airlines, subject to medical and airline approval.",
    ],
    [
        "title" => "Medical escort",
        "slug" => "medical-escort-and-transport",
        "image" => "businessclass-about-img.jpg",
        "icon" => "fa-user-doctor",
        "label" => "Care on the move",
        "description" =>
            "Professional medical assistance for patients who need support throughout their journey.",
    ],
    [
        "title" => "Road ambulance",
        "slug" => "road-ambulance-service-in-india",
        "image" => "ambulance-service-about.jpg",
        "icon" => "fa-truck-medical",
        "label" => "Ground connections",
        "description" =>
            "ALS and BLS ambulance arrangements for hospital transfers and airport connections.",
    ],
];
$homeQuestions =
    json_decode(file_get_contents(__DIR__ . "/includes/faq-schema.json"), true)[
        "mainEntity"
    ] ?? [];
?>

<div id="new-home">
    <?php include __DIR__ . "/includes/home-hero-carousel.php"; ?>

    <section class="nh-transfer-desk" aria-label="Medical transport coordination desk">
        <div class="nh-desk-title"><span class="nh-live-dot"></span><div><span>YOUR FIRST POINT OF CONTACT</span><h2>Need a patient transfer?</h2></div></div>
        <p>Tell us where you are.<br>We’ll help plan what comes next.</p>
        <a href="tel:<?php echo htmlspecialchars(
            str_replace(" ", "", EMERGENCY_PHONE),
            ENT_QUOTES,
        ); ?>"><i class="fa-solid fa-phone-volume" aria-hidden="true"></i><span><small>Speak to our team · 24/7</small><strong><?php echo htmlspecialchars(
    EMERGENCY_PHONE,
); ?></strong></span></a>
        <a class="nh-desk-message" href="<?php echo htmlspecialchars(
            WHATSAPP_LINK,
            ENT_QUOTES,
        ); ?>" target="_blank" rel="noopener"><i class="fa-brands fa-whatsapp" aria-hidden="true"></i><span>Message us</span><i class="fa-solid fa-arrow-up-right-from-square" aria-hidden="true"></i></a>
    </section>

    <section class="nh-services nh-section" id="nh-services" aria-labelledby="nh-services-title">
        <div class="nh-section-heading"><div><p class="nh-kicker">OUR SERVICES</p><h2 id="nh-services-title">The right transport.<br>The right medical support.</h2></div><div><p>From a dedicated aircraft to a supported airline journey, find the right starting point for your transfer.</p><a class="nh-link" href="<?php echo SITE_URL; ?>/services">Explore every service <i class="fa-solid fa-arrow-right" aria-hidden="true"></i></a></div></div>
        <div class="nh-service-grid">
            <?php foreach ($homeServices as $index => $service): ?>
                <a class="nh-service" href="<?php echo htmlspecialchars(
                    getServiceURL($service["slug"]),
                    ENT_QUOTES,
                ); ?>">
                    <div class="nh-service-photo"><img src="<?php echo IMG_PATH .
                        htmlspecialchars(
                            $service["image"],
                            ENT_QUOTES,
                        ); ?>" alt="<?php echo htmlspecialchars(
    $service["title"],
    ENT_QUOTES,
); ?>" loading="lazy" width="700" height="480"><span><i class="fa-solid <?php echo $service[
    "icon"
]; ?>" aria-hidden="true"></i> <?php echo htmlspecialchars(
    $service["label"],
); ?></span></div>
                    <div class="nh-service-body"><span class="nh-service-number"><?php echo sprintf(
                        "%02d",
                        $index + 1,
                    ); ?></span><h3><?php echo htmlspecialchars(
    $service["title"],
); ?></h3><p><?php echo htmlspecialchars(
    $service["description"],
); ?></p><span class="nh-service-arrow" aria-hidden="true"><i class="fa-solid fa-arrow-right"></i></span></div>
                </a>
            <?php endforeach; ?>
        </div>
    </section>

    <section class="nh-care" aria-labelledby="nh-care-title">
        <div class="nh-care-image"><img src="<?php echo IMG_PATH; ?>hw-works.jpg" alt="Medical transport care and equipment" loading="lazy" width="800" height="900"><span><i class="fa-solid fa-heart-pulse" aria-hidden="true"></i> People first. Always.</span></div>
        <div class="nh-care-copy"><p class="nh-kicker">PATIENT-FIRST CARE</p><h2 id="nh-care-title">Every patient deserves<br>personal attention.</h2><p class="nh-care-lead">A patient. A family. A moment that matters.</p><p>Medical transport is about more than reaching a destination. It means understanding the patient’s needs, keeping the family informed and making sure each stage of the journey connects.</p><div class="nh-care-points"><div><i class="fa-solid fa-user-doctor" aria-hidden="true"></i><h3>Led by medical needs</h3><p>Transport planning begins with the patient’s condition and treating team.</p></div><div><i class="fa-solid fa-route" aria-hidden="true"></i><h3>Joined-up arrangements</h3><p>Aircraft, ground connections and receiving teams coordinated together.</p></div></div><a class="nh-link" href="<?php echo SITE_URL; ?>/about">Get to know Ashoka Rescue <i class="fa-solid fa-arrow-right" aria-hidden="true"></i></a></div>
    </section>

    <section class="nh-journey nh-section" aria-labelledby="nh-journey-title">
        <div class="nh-section-heading"><div><p class="nh-kicker">HOW IT WORKS</p><h2 id="nh-journey-title">A clear plan.<br>From your first call to arrival.</h2></div><a class="nh-button nh-button-light" href="#assistance">Let’s plan the journey <i class="fa-solid fa-arrow-right" aria-hidden="true"></i></a></div>
        <ol class="nh-steps">
            <li><span>01</span><i class="fa-regular fa-comments" aria-hidden="true"></i><h3>Talk to us</h3><p>Share the pickup location, destination and the kind of support the patient needs.</p></li>
            <li><span>02</span><i class="fa-solid fa-clipboard-check" aria-hidden="true"></i><h3>Review the options</h3><p>Our team reviews the medical requirements and discusses suitable transport arrangements.</p></li>
            <li><span>03</span><i class="fa-solid fa-plane-departure" aria-hidden="true"></i><h3>Connect the journey</h3><p>Medical clearances, travel arrangements and ground connections are coordinated.</p></li>
            <li><span>04</span><i class="fa-solid fa-hospital-user" aria-hidden="true"></i><h3>Continue the care</h3><p>The transfer is supported through to the receiving team and destination handover.</p></li>
        </ol>
    </section>

    <section class="nh-reach nh-section" aria-labelledby="nh-reach-title">
        <div><p class="nh-kicker">OUR REACH</p><h2 id="nh-reach-title">Care that goes<br>the distance.</h2><p>Within India or across countries, our team helps connect the medical and travel arrangements for each patient’s route.</p><a class="nh-link" href="<?php echo SITE_URL; ?>/contact">Discuss your destination <i class="fa-solid fa-arrow-right" aria-hidden="true"></i></a></div>
        <div class="nh-reach-options"><article><i class="fa-solid fa-location-dot" aria-hidden="true"></i><div><span>WITHIN INDIA</span><h3>City to city.<br>Bedside to bedside.</h3><p>Air and ground medical transport with connected hospital and airport transfers.</p></div></article><article><i class="fa-solid fa-earth-asia" aria-hidden="true"></i><div><span>INTERNATIONAL TRANSFERS</span><h3>Different countries.<br>One coordinated journey.</h3><p>Medical escorts, commercial stretchers and charter arrangements, subject to route and medical approvals.</p></div></article></div>
    </section>

    <?php include __DIR__ . "/includes/inquiry-form.php"; ?>

    <section class="nh-faq nh-section" aria-labelledby="nh-faq-title">
        <div><p class="nh-kicker">FREQUENTLY ASKED QUESTIONS</p><h2 id="nh-faq-title">Questions about<br>your transfer?</h2><a class="nh-link" href="<?php echo SITE_URL; ?>/faqs">All your questions <i class="fa-solid fa-arrow-right" aria-hidden="true"></i></a></div>
        <div class="nh-questions">
            <?php foreach (
                array_slice($homeQuestions, 0, 4)
                as $index => $question
            ): ?>
                <details><summary><span><?php echo sprintf(
                    "%02d",
                    $index + 1,
                ); ?></span><?php echo htmlspecialchars(
    $question["name"],
); ?><i class="fa-solid fa-plus" aria-hidden="true"></i></summary><p><?php echo htmlspecialchars(
    $question["acceptedAnswer"]["text"],
); ?></p></details>
            <?php endforeach; ?>
        </div>
    </section>
    <section class="nh-last-call"><p>Wherever the next step takes you,<br><strong>let’s take it together.</strong></p><a href="tel:<?php echo htmlspecialchars(
        str_replace(" ", "", EMERGENCY_PHONE),
        ENT_QUOTES,
    ); ?>">Talk to our team <i class="fa-solid fa-arrow-up-right-from-square" aria-hidden="true"></i></a></section>
</div>

<?php include __DIR__ . "/includes/footer.php"; ?>
