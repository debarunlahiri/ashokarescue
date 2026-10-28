<?php
/**
 * Privacy Policy Page - Ashoka Rescue Air Ambulance Services
 */

// Page-specific variables
$pageTitle = 'Privacy Policy | Ashoka Rescue';
$pageDescription = 'Read the Privacy Policy of Ashoka Rescue to Learn how we protect your personal information while providing top-notch air and road ambulance services.';
$pageKeywords = 'Privacy Policy, Data Protection, Ashoka Rescue Privacy';

// Include header
include __DIR__ . '/includes/header.php';
?>

<style>
    .term_style p {
        margin-bottom: 0.5rem;
    }
</style>

<!-- Banner Section -->
<section class="banner-section about-banner banner-section-bg">
    <div class="banner-bg">
        <img src="<?php echo IMG_PATH; ?>about-banner.jpg" class="img-fluid" alt="">
    </div>
    <div class="container">
        <div class="banner-content">
            <h1 class="banner-title" data-aos="fade-up" data-aos-duration="1500">Privacy Policy</h1>
        </div>
    </div>
</section>
<!--/Banner Section -->

<!-- Privacy Content Section -->
<section class="hw-we-section  sec-py">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-lg-12">
                <div class="hw-we-content term_style" data-aos="fade-left" data-aos-duration="2000">

                    <p> At Ashoka Rescue, we are committed to protecting the privacy and confidentiality of our
                        clients' personal information. This Privacy Policy outlines how we collect, use, disclose, and
                        safeguard the personal data provided to us through our website and emergency medical evacuation
                        services.</p>

                    <br>
                    <h4>Collection of Personal Information:</h4>
                    <p>We may collect personal information from clients when they contact us to request emergency
                        medical evacuation services or interact with our website.</p>
                    <p> Personal information may include but is not limited to name, contact details, medical history,
                        and any other relevant information necessary to provide the requested services.</p>

                    <br>
                    <h4>Use of Personal Information:</h4>
                    <p>We use personal information collected from clients solely for the purpose of providing emergency
                        medical evacuation services and related assistance.</p>
                    <p>Personal information may also be used for internal record-keeping, billing, and operational
                        purposes.</p>

                    <br>
                    <h4> Disclosure of Personal Information:</h4>
                    <p>Ashoka Rescue may disclose personal information to authorized personnel involved in providing
                        emergency medical evacuation services, including medical staff, transport personnel, and
                        administrative staff.</p>
                    <p>Personal information may also be disclosed to third-party service providers engaged by Ashoka
                        Ambulance to facilitate the provision of services, such as logistics partners, medical
                        facilities, and insurance providers.</p>

                    <br>
                    <h4>Data Security:</h4>
                    <p>We implement appropriate security measures to protect the personal information we collect from
                        unauthorized access, disclosure, alteration, or destruction.</p>
                    <p>Access to personal information is restricted to authorized personnel who require access to
                        perform their duties.</p>

                    <br>
                    <h4> Data Retention:</h4>
                    <p>We retain personal information for as long as necessary to fulfill the purposes for which it was
                        collected and to comply with legal and regulatory requirements.</p>
                    <p>Upon completion of the retention period, personal information is securely disposed of or
                        anonymized to prevent unauthorized access.</p>

                    <br>
                    <h4> Consent:</h4>
                    <p>By availing of our emergency medical evacuation services or interacting with our website, clients
                        consent to the collection, use, and disclosure of their personal information as outlined in this
                        Privacy Policy.</p>
                    <p>Clients have the right to withdraw consent at any time, subject to legal and contractual
                        obligations.</p>

                    <br>
                    <h4> Amendments:</h4>
                    <p>Ashoka Rescue reserves the right to amend or update this Privacy Policy at any time without
                        prior notice.</p>
                    <p>Clients are encouraged to review this Privacy Policy periodically for any changes or updates.</p>
                    <br>
                    <p> If you have any questions or concerns about our Privacy Policy or the handling of your personal
                        information, please contact us for further assistance.</p>

                    <h2>Google Reviews</h2>
                    <p>Our Google reviews section uses Google Maps Platform to display public reviewer names, profile photos, ratings and review text. Review content is requested from Google and is not stored in our review database. Loading reviewer photos or opening Google links connects your browser to Google. Google's handling of data is described in the <a href="https://policies.google.com/privacy" target="_blank" rel="noopener">Google Privacy Policy</a>.</p>

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