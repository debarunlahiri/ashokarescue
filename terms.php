<?php
/**
 * Terms and Conditions Page - Ashoka Rescue Air Ambulance Services
 */

// Page-specific variables
$pageTitle = 'Terms and Conditions | Ashoka Rescue';
$pageDescription = 'Read the Terms and Conditions for Ashoka Rescue. Understand guidelines for using our air and road ambulance services, ensuring your safety and satisfaction.';
$pageKeywords = 'Terms and Conditions, Ashoka Rescue Terms, Medical Transport Terms';

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
            <h1 class="banner-title" data-aos="fade-up" data-aos-duration="1500">Terms and Conditions</h1>
        </div>
    </div>
</section>
<!--/Banner Section -->

<!-- Terms Content Section -->
<section class="hw-we-section  sec-py">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-lg-12">
                <div class="hw-we-content term_style" data-aos="fade-left" data-aos-duration="2000">

                    <h4>Emergency Medical Evacuation Services:</h4>
                    <p>Ashoka Rescue provides emergency medical evacuation services to individuals in need of urgent
                        medical assistance.</p>
                    <p> By using our services, you agree to abide by all terms and conditions outlined herein.</p><br>

                    <h4>Service Availability:</h4>
                    <p> While we strive to provide timely and reliable services, the availability of our emergency
                        medical
                        evacuation services may vary depending on factors such as location, weather conditions, and
                        operational constraints.</p>
                    <p> Ashoka Rescue reserves the right to refuse or discontinue service if deemed necessary for
                        safety or operational reasons.</p>

                    <br>
                    <h4>Patient Responsibility:</h4>
                    <p> Patients availing of our emergency medical evacuation services are responsible for providing
                        accurate and up-to-date medical information to our medical team.</p>
                    <p> Patients must adhere to all instructions provided by our medical staff during transportation for
                        their safety and well-being.</p>

                    <br>
                    <h4>Payment and Billing:</h4>
                    <p>Payment for emergency medical evacuation services must be made in accordance with the terms
                        outlined in the billing agreement provided by Ashoka Rescue.</p>
                    <p> Clients are responsible for all fees and charges associated with the services rendered,
                        including
                        transportation, medical care, and any additional services requested.</p>

                    <br>
                    <h4>Liability:</h4>
                    <p>Ashoka Rescue shall not be liable for any loss, damage, injury, or delay arising from
                        circumstances beyond our control, including but not limited to natural disasters, accidents, or
                        acts
                        of God.</p>
                    <p>Our liability is limited to the extent permitted by law, and we shall not be held responsible for
                        any consequential or incidental damages.</p>

                    <br>
                    <h4>Privacy Policy:</h4>
                    <p> Ashoka Rescue respects the privacy of our clients and complies with all applicable data
                        protection laws and regulations.</p>
                    <p> Any personal information collected from clients will be used solely for the purpose of providing
                        emergency medical evacuation services and will not be shared with third parties without consent.
                    </p>

                    <br>
                    <h4> Amendments:</h4>
                    <p>Ashoka Rescue reserves the right to amend or update these terms and conditions at any time
                        without prior notice.</p>
                    <p> Clients are advised to review these terms periodically for any changes or updates.</p><br>

                    <p>By availing of our emergency medical evacuation services, you acknowledge that you have read,
                        understood, and agreed to abide by the terms and conditions outlined above. If you have any
                        questions or concerns, please contact us for further clarification.</p>

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