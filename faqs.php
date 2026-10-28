<?php
/**
 * FAQs Page - Ashoka Rescue Air Ambulance Services
 */

// Page-specific variables
$pageTitle = 'Frequently Asked Questions | Ashoka Rescue';
$pageDescription = 'Find answers to common questions about Ashoka Rescue air ambulance services, medical escorts, commercial stretchers, and patient transportation.';
$pageKeywords = 'Air Ambulance FAQs, Medical Transport Questions, Commercial Stretcher Information';
// Auto cache-busting: version string follows the file modification time,
// so browsers always fetch fresh CSS after an edit (no manual version bumps).
$additionalStyles = '<link rel="stylesheet" href="assets/css/home-modern.css?v=' . filemtime(__DIR__ . '/assets/css/home-modern.css') . '">'
    . '<link rel="stylesheet" href="assets/css/pages-modern.css?v=' . filemtime(__DIR__ . '/assets/css/pages-modern.css') . '">'
    . '<link rel="stylesheet" href="assets/css/rx-pages.css?v=' . filemtime(__DIR__ . '/assets/css/rx-pages.css') . '">';

// FAQ Schema markup
$faqSchemaJson = file_get_contents(__DIR__ . '/includes/faq-schema.json');
$schemaMarkup = '<script type="application/ld+json">' . $faqSchemaJson . '</script>';

// Include header
include __DIR__ . '/includes/header.php';
?>

<!-- Banner Section -->
<section class="banner-section about-banner banner-section-bg faq-hero rx-faq-hero rx-dark">
    <span class="rx-orb rx-orb--red" aria-hidden="true"></span>
    <span class="rx-orb rx-orb--cyan" aria-hidden="true"></span>
    <div class="banner-bg">
        <img src="<?php echo IMG_PATH; ?>about-banner.jpg" class="img-fluid" alt="">
    </div>
    <div class="container">
        <div class="banner-content">
            <span class="page-kicker" data-rx><i class="fa-solid fa-circle-question"></i> Clear answers, when you need them</span>
            <h1 class="banner-title" data-aos="fade-up" data-aos-duration="1500">What families<br><span>ask us.</span></h1>
            <p data-aos="fade-up" data-aos-duration="2500">Practical guidance about air ambulances, medical escorts, commercial stretchers, costs, and patient travel.</p>
        </div>
    </div>
</section>
<!--/Banner Section -->

<!-- FAQs Section -->
<section class="faq-page-section rx-faq-sec rx-sec-py">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-4">
                <div class="faq-page-intro rx-faq-intro" data-rx="left">
                    <p class="rx-kicker rx-kicker--light">General information</p>
                    <h2>Answers for patients and families</h2>
                    <p>Browse the most common questions about arranging medical transport. For advice about a specific patient, speak directly with our coordination team.</p>
                    <a href="tel:<?php echo str_replace(' ', '', EMERGENCY_PHONE); ?>" class="faq-support-link">
                        <i class="fa-solid fa-phone"></i>
                        <span><small>Emergency desk</small><?php echo EMERGENCY_PHONE; ?></span>
                    </a>
                </div>
            </div>

            <!-- FAQs Accordion -->
            <div class="col-lg-8">
            <div class="accordion faq-page-accordion rx-faq-acc" id="accordionGeneral" data-rx="right">
                <!-- FAQ 1 -->
                <div class="accordion-item">
                    <h2 class="accordion-header" id="faqs_heading_1">
                        <button class="accordion-button" type="button" data-bs-toggle="collapse"
                            data-bs-target="#collapsp_1" aria-expanded="true" aria-controls="collapsp_1">
                            Who needs an air ambulance?
                        </button>
                    </h2>
                    <div id="collapsp_1" class="accordion-collapse collapse show" aria-labelledby="faqs_heading_1"
                        data-bs-parent="#accordionGeneral">
                        <div class="accordion-body">
                            Air ambulances are crucial for patients requiring immediate medical attention. In life-or-death situations where time is of the essence, air ambulances provide swift transport needed to reach the hospital for urgent treatment.
                        </div>
                    </div>
                </div>

                <!-- FAQ 2 -->
                <div class="accordion-item">
                    <h2 class="accordion-header" id="faqs_heading_2">
                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                            data-bs-target="#collapsp_2" aria-expanded="false" aria-controls="collapsp_2">
                            What is a Medical Information Form / Medif?
                        </button>
                    </h2>
                    <div id="collapsp_2" class="accordion-collapse collapse" aria-labelledby="faqs_heading_2"
                        data-bs-parent="#accordionGeneral">
                        <div class="accordion-body">
                            A Medif is a confidential airline form used to get medical clearance for a patient to fly. Ashoka Rescue's doctors coordinate with the patient's attending physician to provide details about the patient's status, maintenance, and travel needs, enabling the airline's medical department to assess and grant travel clearance.
                        </div>
                    </div>
                </div>

                <!-- FAQ 3 -->
                <div class="accordion-item">
                    <h2 class="accordion-header" id="faqs_heading_3">
                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                            data-bs-target="#collapsp_3" aria-expanded="false" aria-controls="collapsp_3">
                            What is a commercial stretcher, and how do you book a stretcher in flight?
                        </button>
                    </h2>
                    <div id="collapsp_3" class="accordion-collapse collapse" aria-labelledby="faqs_heading_3"
                        data-bs-parent="#accordionGeneral">
                        <div class="accordion-body">
                            A commercial air ambulance stretcher is assembled on a commercial airline with oxygen and medical equipment. Patients travel assisted by medical escort doctors and nurses. To book, call our hotline at +91-9810364143 or email ashokarescue@gmail.com with the patient's medical summary.
                        </div>
                    </div>
                </div>

                <!-- FAQ 4 -->
                <div class="accordion-item">
                    <h2 class="accordion-header" id="faqs_heading_4">
                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                            data-bs-target="#collapsp_4" aria-expanded="false" aria-controls="collapsp_4">
                            What is the difference between an air ambulance and a commercial stretcher?
                        </button>
                    </h2>
                    <div id="collapsp_4" class="accordion-collapse collapse" aria-labelledby="faqs_heading_4"
                        data-bs-parent="#accordionGeneral">
                        <div class="accordion-body">
                            An air ambulance can be arranged within 24 hours and has no oxygen limitations, but is significantly more expensive. A commercial stretcher takes 4-5 working days for airline approval, has an oxygen limit of 5 litres per minute, but is a much more cost-effective option.
                        </div>
                    </div>
                </div>

                <!-- FAQ 5 -->
                <div class="accordion-item">
                    <h2 class="accordion-header" id="faqs_heading_5">
                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                            data-bs-target="#collapsp_5" aria-expanded="false" aria-controls="collapsp_5">
                            How many attendants can fly in an Air Ambulance?
                        </button>
                    </h2>
                    <div id="collapsp_5" class="accordion-collapse collapse" aria-labelledby="faqs_heading_5"
                        data-bs-parent="#accordionGeneral">
                        <div class="accordion-body">
                            In a charter air ambulance, two patient family members can typically accompany the patient. Ashoka Rescue also provides a medical crew consisting of two medical members (doctors, nurses, or paramedics) and two pilots.
                        </div>
                    </div>
                </div>

                <!-- FAQ 6 -->
                <div class="accordion-item">
                    <h2 class="accordion-header" id="faqs_heading_6">
                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                            data-bs-target="#collapsp_6" aria-expanded="false" aria-controls="collapsp_6">
                            Who provides reliable Air Medical Escort Services in India?
                        </button>
                    </h2>
                    <div id="collapsp_6" class="accordion-collapse collapse" aria-labelledby="faqs_heading_6"
                        data-bs-parent="#accordionGeneral">
                        <div class="accordion-body">
                            Ashoka Rescue provides reliable, economical international medical escort services to and from India. Our team includes qualified flight doctors and nurses who assist patients on commercial flights worldwide with minimum documentation and high-standard care.
                        </div>
                    </div>
                </div>

                <!-- FAQ 7 -->
                <div class="accordion-item">
                    <h2 class="accordion-header" id="faqs_heading_7">
                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                            data-bs-target="#collapsp_7" aria-expanded="false" aria-controls="collapsp_7">
                            What is bed-to-bed medical transportation?
                        </button>
                    </h2>
                    <div id="collapsp_7" class="accordion-collapse collapse" aria-labelledby="faqs_heading_7"
                        data-bs-parent="#accordionGeneral">
                        <div class="accordion-body">
                            Bed-to-bed service means transporting a patient seamlessly from their current hospital bed to their destination bed (e.g., from Vancouver, Canada to New Delhi, India). This involves coordinating ground ambulances, air ambulances, or commercial stretchers to ensure a continuous chain of care.
                        </div>
                    </div>
                </div>

                <!-- FAQ 8 -->
                <div class="accordion-item">
                    <h2 class="accordion-header" id="faqs_heading_8">
                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                            data-bs-target="#collapsp_8" aria-expanded="false" aria-controls="collapsp_8">
                            Can you fly a coma patient?
                        </button>
                    </h2>
                    <div id="collapsp_8" class="accordion-collapse collapse" aria-labelledby="faqs_heading_8"
                        data-bs-parent="#accordionGeneral">
                        <div class="accordion-body">
                            Yes, we transport ICU and coma patients, including those with brain hemorrhages or hypoxic brain injuries. We evaluate vital stability, hemoglobin, and oxygen requirements to determine if they should travel via air ambulance or a commercial stretcher with a medical escort.
                        </div>
                    </div>
                </div>

                <!-- FAQ 9 -->
                <div class="accordion-item">
                    <h2 class="accordion-header" id="faqs_heading_9">
                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                            data-bs-target="#collapsp_9" aria-expanded="false" aria-controls="collapsp_9">
                            What services does Ashoka Rescue provide?
                        </button>
                    </h2>
                    <div id="collapsp_9" class="accordion-collapse collapse" aria-labelledby="faqs_heading_9"
                        data-bs-parent="#accordionGeneral">
                        <div class="accordion-body">
                            Based in Gurugram, India, Ashoka Rescue specializes in Air Ambulance, Commercial Stretchers, Business Class Medical Escorts, Train Ambulances, and Ground Ambulance services. We have over 30 years of experience and have transported over 2,500 patients globally.
                        </div>
                    </div>
                </div>

                <!-- FAQ 10 -->
                <div class="accordion-item">
                    <h2 class="accordion-header" id="faqs_heading_10">
                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                            data-bs-target="#collapsp_10" aria-expanded="false" aria-controls="collapsp_10">
                            Can Air Ambulances fly at night?
                        </button>
                    </h2>
                    <div id="collapsp_10" class="accordion-collapse collapse" aria-labelledby="faqs_heading_10"
                        data-bs-parent="#accordionGeneral">
                        <div class="accordion-body">
                            Yes, air ambulances can fly at night, provided the departure and arrival airports have night landing facilities, international immigration, and ground handling services available.
                        </div>
                    </div>
                </div>

                <!-- FAQ 11 -->
                <div class="accordion-item">
                    <h2 class="accordion-header" id="faqs_heading_11">
                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                            data-bs-target="#collapsp_11" aria-expanded="false" aria-controls="collapsp_11">
                            Does the Air Ambulance have a ventilator?
                        </button>
                    </h2>
                    <div id="collapsp_11" class="accordion-collapse collapse" aria-labelledby="faqs_heading_11"
                        data-bs-parent="#accordionGeneral">
                        <div class="accordion-body">
                            Yes, our air ambulances are equipped with complete ICU equipment, including ventilators, Advanced Life Support (ALS) equipment, and are staffed by critical care medical crews.
                        </div>
                    </div>
                </div>

                <!-- FAQ 12 -->
                <div class="accordion-item">
                    <h2 class="accordion-header" id="faqs_heading_12">
                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                            data-bs-target="#collapsp_12" aria-expanded="false" aria-controls="collapsp_12">
                            How much does an air ambulance cost from Australia to India?
                        </button>
                    </h2>
                    <div id="collapsp_12" class="accordion-collapse collapse" aria-labelledby="faqs_heading_12"
                        data-bs-parent="#accordionGeneral">
                        <div class="accordion-body">
                            An Air Ambulance from Australia to India costs approximately $180,000 USD. Alternatively, a Commercial Stretcher with two medical escorts on a commercial airline costs approximately $40,000 USD, excluding ground ambulance charges.
                        </div>
                    </div>
                </div>

                <!-- FAQ 13 -->
                <div class="accordion-item">
                    <h2 class="accordion-header" id="faqs_heading_13">
                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                            data-bs-target="#collapsp_13" aria-expanded="false" aria-controls="collapsp_13">
                            How much does a medical escort from India to Canada cost?
                        </button>
                    </h2>
                    <div id="collapsp_13" class="accordion-collapse collapse" aria-labelledby="faqs_heading_13"
                        data-bs-parent="#accordionGeneral">
                        <div class="accordion-body">
                            The cost for a medical escort from North America to India typically ranges from $3,000 USD to $7,000 USD plus logistics expenses. This includes assistance from certified ICU/Anesthesia doctors or registered nurses.
                        </div>
                    </div>
                </div>

                <!-- FAQ 14 -->
                <div class="accordion-item">
                    <h2 class="accordion-header" id="faqs_heading_14">
                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                            data-bs-target="#collapsp_14" aria-expanded="false" aria-controls="collapsp_14">
                            How to bring a patient from the USA to India?
                        </button>
                    </h2>
                    <div id="collapsp_14" class="accordion-collapse collapse" aria-labelledby="faqs_heading_14"
                        data-bs-parent="#accordionGeneral">
                        <div class="accordion-body">
                            Patients can be brought from the USA to India via a private Air Ambulance (using aircraft like Learjet or Cessna Excel) or via a Commercial Stretcher with a medical escort. Ashoka Rescue has handled over 2,000 such cases between North America and India.
                        </div>
                    </div>
                </div>

                <!-- FAQ 15 -->
                <div class="accordion-item">
                    <h2 class="accordion-header" id="faqs_heading_15">
                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                            data-bs-target="#collapsp_15" aria-expanded="false" aria-controls="collapsp_15">
                            How to book Ashoka Rescue Air Ambulance Services?
                        </button>
                    </h2>
                    <div id="collapsp_15" class="accordion-collapse collapse" aria-labelledby="faqs_heading_15"
                        data-bs-parent="#accordionGeneral">
                        <div class="accordion-body">
                            To book, you can email ashokarescue@gmail.com, call +91-9810364143, or message us on WhatsApp at the same number. Please provide a medical summary and travel details for a prompt quote.
                        </div>
                    </div>
                </div>

            </div>
            <!--/accordion -->
            </div>

        </div>
    </div>
</section>

<section class="faq-contact-cta rx-faq-cta">
    <div class="container">
        <div class="faq-contact-inner" data-rx>
            <div>
                <span>Still need help?</span>
                <h2>Discuss your patient’s journey with our medical team.</h2>
            </div>
            <a href="<?php echo SITE_URL; ?>/contact" class="rx-btn rx-btn--ghost" data-magnetic>Contact Ashoka Rescue <i class="fa-solid fa-arrow-right"></i></a>
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
