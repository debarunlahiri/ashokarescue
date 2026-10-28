<?php
/**
 * Contact Page - Ashoka Rescue Air Ambulance Services
 */

// Page-specific variables
$pageTitle = "Contact Ashoka Rescue | Quick Quote and Support";
$pageDescription =
    "Get in touch with Ashoka Rescue for expert medical transport services. Quick quotes and professional assistance for your medical travel needs.";
$pageKeywords =
    "Contact Ashoka Rescue, Medical Transport Quote, Air Ambulance Contact, Emergency Medical Services";
// Auto cache-busting: version string follows the file modification time,
// so browsers always fetch fresh CSS after an edit (no manual version bumps).
$additionalStyles =
    '<link rel="stylesheet" href="assets/css/home-modern.css?v=' .
    filemtime(__DIR__ . "/assets/css/home-modern.css") .
    '">' .
    '<link rel="stylesheet" href="assets/css/pages-modern.css?v=' .
    filemtime(__DIR__ . "/assets/css/pages-modern.css") .
    '">' .
    '<link rel="stylesheet" href="assets/css/rx-pages.css?v=' .
    filemtime(__DIR__ . "/assets/css/rx-pages.css") .
    '">' .
    '<link rel="stylesheet" href="assets/css/page-hero.css?v=' .
    filemtime(__DIR__ . "/assets/css/page-hero.css") .
    '">';

$additionalStyles .=
    '<link rel="stylesheet" href="assets/css/contact-refresh.css?v=' .
    filemtime(__DIR__ . "/assets/css/contact-refresh.css") .
    '">';

// Include header
include __DIR__ . "/includes/header.php";

// Get services for dropdown
$list = getServices();
?>

<!-- Banner Section -->
<div class="page-hero">
    <section class="ph-hero" aria-labelledby="page-hero-title">
        <div class="container ph-hero-grid">
            <div class="ph-hero-copy">
                <p class="ph-label">Contact Ashoka Rescue</p>
                <h1 id="page-hero-title">Let’s plan a<br>safe transfer.<br><span>Together.</span></h1>
                <p class="ph-intro">Tell us about the patient’s condition, current location, and destination. Our medical transport team will guide you through the next steps.</p>
                <div class="ph-actions"><a class="ph-button" href="tel:<?php echo htmlspecialchars(
                    preg_replace("/\s+/", "", EMERGENCY_PHONE),
                    ENT_QUOTES,
                ); ?>"><i class="fa-solid fa-phone" aria-hidden="true"></i> Call emergency desk</a><a class="ph-text-link" href="<?php echo htmlspecialchars(
    WHATSAPP_LINK,
    ENT_QUOTES,
); ?>" target="_blank" rel="noopener"><i class="fa-brands fa-whatsapp" aria-hidden="true"></i> Message on WhatsApp</a></div>
                <div class="ph-availability"><span class="ph-icon"><i class="fa-solid fa-headset" aria-hidden="true"></i></span><span>Here for your next step.<br><strong>Medical coordination available 24/7</strong></span></div>
            </div>
            <figure class="ph-hero-photo">
                <img src="<?php echo IMG_PATH; ?>ambulance-service-about.jpg" alt="Ashoka Rescue medical transport assistance" fetchpriority="high">
                <figcaption><i class="fa-solid fa-headset" aria-hidden="true"></i><span>A team ready to listen.<strong>Care starts with a conversation.</strong></span></figcaption>
            </figure>
        </div>
    </section>
</div>
<!--/Banner Section -->

<div class="cr-contact">
    <section class="cr-reach" aria-labelledby="cr-reach-title">
        <div class="container">
            <div class="cr-heading"><div><p class="cr-label">Reach our team</p><h2 id="cr-reach-title">Real people.<br>Ready to help.</h2></div><p>Whether you’re arranging a transfer or exploring your options, start with the conversation that works for you.</p></div>
            <div class="cr-channels">
                <a class="cr-channel" href="tel:+919818933004"><span class="cr-icon"><i class="fa-solid fa-phone" aria-hidden="true"></i></span><span class="cr-channel-label">Speak to us</span><h3>Let’s talk it through.</h3><p>Speak with our team about medical transport and the next steps.</p><span class="cr-channel-action">+91 98189 33004 <i class="fa-solid fa-arrow-up-right-from-square" aria-hidden="true"></i></span></a>
                <a class="cr-channel" href="<?php echo htmlspecialchars(
                    WHATSAPP_LINK,
                    ENT_QUOTES,
                ); ?>" target="_blank" rel="noopener"><span class="cr-icon"><i class="fa-brands fa-whatsapp" aria-hidden="true"></i></span><span class="cr-channel-label">Message our team</span><h3>A conversation, your way.</h3><p>Connect on WhatsApp for help planning a patient’s journey.</p><span class="cr-channel-action">Open WhatsApp <i class="fa-solid fa-arrow-up-right-from-square" aria-hidden="true"></i></span></a>
                <a class="cr-channel" href="mailto:ashokarescue@gmail.com"><span class="cr-icon"><i class="fa-solid fa-envelope" aria-hidden="true"></i></span><span class="cr-channel-label">Write to us</span><h3>Start with an email.</h3><p>Send your enquiry and contact details so our team can get in touch.</p><span class="cr-channel-action">ashokarescue@gmail.com <i class="fa-solid fa-arrow-up-right-from-square" aria-hidden="true"></i></span></a>
            </div>
            <div class="cr-office"><span class="cr-icon"><i class="fa-solid fa-location-dot" aria-hidden="true"></i></span><div><h3>Our office in Gurugram</h3><address>UG 124, Ansal Palam Corporate Plaza, Palam Vihar,<br>Gurugram, Haryana, India — 122017</address></div><a href="https://www.google.com/maps/search/?api=1&amp;query=UG+124+Ansal+Palam+Corporate+Plaza+Palam+Vihar+Gurugram" target="_blank" rel="noopener">Find us on the map <i class="fa-solid fa-arrow-up-right-from-square" aria-hidden="true"></i></a></div>
        </div>
    </section>
    <div class="cr-enquiry">
        <?php include __DIR__ . "/includes/inquiry-form.php"; ?>
    </div>
    <section class="cr-next" aria-labelledby="cr-next-title"><div class="container"><p class="cr-label">What happens next</p><h2 id="cr-next-title">A clearer path forward.</h2><div class="cr-next-grid"><article><i class="fa-solid fa-comments" aria-hidden="true"></i><h3>We understand your needs</h3><p>Our team discusses the journey and the patient’s transport requirements with you.</p></article><article><i class="fa-solid fa-route" aria-hidden="true"></i><h3>We explore the options</h3><p>We help you understand suitable transport arrangements for the route and care needed.</p></article><article><i class="fa-solid fa-hand-holding-heart" aria-hidden="true"></i><h3>We guide you through</h3><p>You’ll have support with the coordination and next steps for the transfer.</p></article></div></div></section>
</div>

<?php // Include footer

include __DIR__ . "/includes/footer.php";
?>
