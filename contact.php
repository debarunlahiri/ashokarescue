<?php
/**
 * Contact Page - Ashoka Rescue Air Ambulance Services
 */

// Page-specific variables
$pageTitle = 'Contact Ashoka Rescue | Quick Quote and Support';
$pageDescription = 'Get in touch with Ashoka Rescue for expert medical transport services. Quick quotes and professional assistance for your medical travel needs.';
$pageKeywords = 'Contact Ashoka Rescue, Medical Transport Quote, Air Ambulance Contact, Emergency Medical Services';
// Auto cache-busting: version string follows the file modification time,
// so browsers always fetch fresh CSS after an edit (no manual version bumps).
$additionalStyles = '<link rel="stylesheet" href="assets/css/home-modern.css?v=' . filemtime(__DIR__ . '/assets/css/home-modern.css') . '">'
    . '<link rel="stylesheet" href="assets/css/pages-modern.css?v=' . filemtime(__DIR__ . '/assets/css/pages-modern.css') . '">'
    . '<link rel="stylesheet" href="assets/css/rx-pages.css?v=' . filemtime(__DIR__ . '/assets/css/rx-pages.css') . '">';

// Include header
include __DIR__ . '/includes/header.php';

// Get services for dropdown
$list = getServices();
?>

<!-- Banner Section -->
<section class="banner-section contact-hero rx-contact-hero rx-dark">
    <span class="rx-orb rx-orb--red" aria-hidden="true"></span>
    <span class="rx-orb rx-orb--cyan" aria-hidden="true"></span>
    <div class="container">
        <div class="banner-content">
            <div class="contact-hero-copy">
                <span class="page-kicker" data-rx><i class="fa-solid fa-headset"></i> Medical coordination available 24/7</span>
                <h1 class="banner-title" data-aos="fade-up" data-aos-duration="1500">Let’s plan the safest<br><span>patient transfer.</span></h1>
                <p data-aos="fade-up" data-aos-duration="2500">Tell us about the patient’s condition, current location, and destination. Our medical transport team will guide you through the next steps.</p>
                <div class="contact-hero-actions">
                    <a href="tel:<?php echo str_replace(' ', '', EMERGENCY_PHONE); ?>" class="btn contact-hero-primary rx-btn rx-btn--red" data-magnetic><i class="fa-solid fa-phone"></i> Call emergency desk</a>
                    <a href="<?php echo WHATSAPP_LINK; ?>" target="_blank" class="btn contact-hero-secondary rx-btn rx-btn--ghost" data-magnetic><i class="fa-brands fa-whatsapp"></i> Message on WhatsApp</a>
                </div>
            </div>
        </div>
    </div>
</section>
<!--/Banner Section -->

<!-- Contact Featured Section -->
<section class="contact-featured rx-channels rx-sec-py">
    <div class="container">
        <div class="row">
            <div class="col-lg-8">
                <div class="section-header">
                    <p class="rx-kicker" data-rx>Reach our team</p>
                    <h2 class="rx-sec-title text-capitalize" data-rx style="--rx-d:.08s">Direct help, wherever your patient needs to travel.</h2>
                </div>
            </div>
        </div>
        <div class="contact-methods">
            <div class="contact-method">
                <div class="contact-method-panel">
                    <div class="contact-method-icon">
                        <i class="fa-solid fa-location-dot" aria-hidden="true"></i>
                    </div>
                    <div class="contact-method-copy">
                        <h3 class="title">Office location</h3>
                        <p>UG 124,Ansal Palam Corporate Plaza, Palam Vihar, Gurugram, Haryana, India - 122017</p>
                    </div>
                </div>
                <!--/card -->
            </div>
            <div class="contact-method">
                <div class="contact-method-panel">
                    <div class="contact-method-icon">
                        <i class="fa-solid fa-comment-dots" aria-hidden="true"></i>
                    </div>
                    <div class="contact-method-copy">
                        <h3 class="title">Send a message</h3>
                        <p>Send us a message, and our team will get back to you promptly</p>
                    </div>
                </div>
                <!--/card -->
            </div>
            <div class="contact-method">
                <div class="contact-method-panel">
                    <div class="contact-method-icon">
                        <i class="fa-solid fa-envelope" aria-hidden="true"></i>
                    </div>
                    <div class="contact-method-copy">
                        <h3 class="title">Contact Us</h3>
                        <span>Phone : <a href="tel:+919818933004">+919818933004</a></span>
                        <span> Email : <a href="mailto:ashokarescue@gmail.com">ashokarescue@gmail.com</a></span>
                        <span><a href="https://www.ashokarescue.com/">www.ashokarescue.com</a></span>
                    </div>
                </div>
                <!--/card -->
            </div>
            <div class="contact-method">
                <div class="contact-method-panel">
                    <div class="contact-method-icon">
                        <i class="fa-solid fa-users" aria-hidden="true"></i>
                    </div>
                    <div class="contact-method-copy">
                        <h3 class="title">Follow Us</h3>
                        <p>Join our community to stay informed and engaged on our social media channels</p>
                    </div>
                </div>
                <!--/card -->
            </div>
        </div>
    </div>
</section>
<!--/Contact Featured Section -->

<!-- Contact Form Section -->
<section class="contact-section rx-form-sec rx-sec-py">
    <div class="container">
        <div class="row g-4 contact-layout">
            <div class="col-lg-7">
                <form action="#" id="request-quote-form" class="contact-form-card rx-form-card" data-rx="left">
                    <input type="hidden" name="csrf_token" value="<?php echo generateCSRFToken(); ?>">
                    <div class="contact-form p-3 p-lg-5">
                        <p class="rx-kicker">Request assistance</p>
                        <h3 class="rx-sec-title text-capitalize">Tell us how we can help</h3>
                        <p class="form-intro">Share the essential details and our team will contact you to discuss the safest available option.</p>
                        <div class="form-group">
                            <label for="contact-name" class="form-label">Full Name<span>*</span></label>
                            <input type="text" id="contact-name" class="form-control" placeholder="Your Full Name" name="name" required>
                        </div>
                        <div class="form-group">
                            <label for="contact-email" class="form-label">Email<span>*</span></label>
                            <input type="email" id="contact-email" class="form-control" placeholder="Your Email Address" name="email"
                                required>
                        </div>
                        <div class="form-group">
                            <label for="contact-service" class="form-label">Service<span>*</span></label>
                            <select id="contact-service" class="form-select" name="services" required>
                                <option value="" selected>Type of Service</option>
                                <?php foreach ($list as $item): ?>
                                    <option value="<?php echo htmlspecialchars($item['title']); ?>">
                                        <?php echo htmlspecialchars($item['title']); ?>
                                    </option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="contact-message" class="form-label">Message<span>*</span></label>
                            <textarea id="contact-message" class="form-control" rows="3" name="details" required></textarea>
                        </div>
                        <button type="button" id="request-quote-form_btn"
                            class="btn btn-solid btn-md rounded rx-btn rx-btn--red" data-magnetic>Send request <i class="fa-solid fa-arrow-right"></i></button>
                    </div>
                </form>
            </div>
            <div class="col-lg-5">
                <div class="contact-rail">
                    <div class="contact-emergency-card rx-emergency-card" data-rx="right">
                        <span class="page-kicker">Urgent transfer</span>
                        <h3>Need help right now?</h3>
                        <p>Our medical coordination desk answers around the clock, anywhere in the world.</p>
                        <a href="tel:<?php echo str_replace(' ', '', EMERGENCY_PHONE); ?>" class="btn contact-emergency-call">
                            <i class="fa-solid fa-phone"></i> <?php echo EMERGENCY_PHONE; ?>
                        </a>
                        <a href="<?php echo WHATSAPP_LINK; ?>" target="_blank" class="btn contact-emergency-wa">
                            <i class="fa-brands fa-whatsapp"></i> WhatsApp us
                        </a>
                    </div>
                    <div class="contact-map-frame rx-map-frame" data-rx="right" style="--rx-d:.12s">
                        <iframe
                            src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3505.8527819200453!2d77.04145307456797!3d28.514076689451855!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x390cfd309eebed77%3A0x164e92a2202ddf78!2sAshoka%20Rescue%20Air%20Ambulance%20Services%20Pvt%20Ltd!5e0!3m2!1sen!2sin!4v1714708811414!5m2!1sen!2sin"
                            style="border:0;" allowfullscreen="" loading="lazy"
                            referrerpolicy="no-referrer-when-downgrade" title="Ashoka Rescue office location"></iframe>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!--/contact Section -->

<?php
$additionalScripts = <<<SCRIPTS
<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Assign to global window object so speak() in footer can access it
        window.content = $("#voice_text").text();

        $("#request-quote-form_btn").click(function() {
            var form = $("#request-quote-form");
            form.validate();
            if (form.valid()) {
                $.ajax({
                    type: 'POST',
                    url: weburl + '/api/submit-quote3.php',
                    data: form.serialize(),
                    dataType: "json",
                    beforeSend: function() {
                        $("#request-quote-form_btn").prop("disabled", true);
                    },
                    success: function(data) {
                        $("#request-quote-form_btn").prop("disabled", false);
                        $('#request-quote-form').trigger("reset");
                        
                        if (data.status == true) {
                            Swal.fire({
                                title: '',
                                text: data.message,
                                icon: 'success',
                            });
                        } else {
                            Swal.fire({
                                title: '',
                                text: data.message,
                                icon: 'error',
                            });
                        }
                    },
                    error: function() {
                        $("#request-quote-form_btn").prop("disabled", false);
                        Swal.fire({
                            title: 'Error',
                            text: 'Something went wrong. Please try again.',
                            icon: 'error',
                        });
                    }
                });
            }
        });
    });
</script>
SCRIPTS;

// Include footer
include __DIR__ . '/includes/footer.php';
?>
