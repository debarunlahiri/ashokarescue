<?php
/**
 * Medical Escort Service Page
 */

// Page-specific variables
$serviceId = 7;
$pageTitle = 'Medical Escort Services | Ashoka Rescue';
$pageDescription = 'Professional medical escort services with Ashoka Rescue. Expert medical professionals accompanying patients on commercial flights for safe medical transport.';
$pageKeywords = 'Medical Escort, Patient Transport, Commercial Flight Medical, Medical Professionals, Ashoka Rescue';

// Include header
$additionalStyles = '<link rel="stylesheet" href="../assets/css/home-modern.css?v=20260921-cache-reset"><link rel="stylesheet" href="../assets/css/services-modern.css?v=20260921-cache-reset">';
include __DIR__ . '/../includes/header.php';

// Get service content from database
$data = getServiceContent($serviceId);

// Set defaults if data is missing
$data = array_merge([
    'title' => 'ASHOKA RESCUE MEDICAL ESCORT',
    'banner' => '/assets/images/images-ambulance_others/001 AM.jpg',
    'main_content' => 'Ashoka Rescue Medical Escort specializes in providing non-emergency medical patient transport services via commercial aircraft. Our team comprises skilled medical professionals, including doctors, nurses, and paramedics, who deliver tailored care to address each patient\'s unique needs.',
    'section1_content' => 'Our Medical Escort service offers a cost-effective option compared to air ambulances, with our medical escorts capable of providing necessary medical attention during the journey for pre-existing emergency cases. Operating globally, Ashoka Rescue ensures reliable 24/7 patient transport services on commercial airlines, offering stretcher services managed by our proficient medical escort team. Our certified and experienced medical escorts are dedicated to their role, equipped with ACLS/ICU gear tailored to individual patient requirements. To guarantee swift and economical medical transport, our flight coordinators are on hand around the clock, managing both domestic and international travel.',
    'section1_footer' => 'Moreover, our medical staff are proficient in diverse languages and possess international visas to prevent any delays in transportation, with Ashoka Rescue Medical Escorts having delivered this crucial service since 2004.',
    'section2_image' => '/assets/images/images-ambulance_others/002 AM.jpg',
    'section2_content1' => 'Our primary objective is to provide exceptional air ambulance services through robust collaborations. Over the years, our medical escorts have successfully facilitated the repatriation of more than 200 stretcher cases across various countries, including India, Canada, the USA, Europe, the UK, the UAE, and Africa.',
    'section2_content2' => 'Our medical escort services cater to patients who do not necessitate air ambulance support. We handle airline medical clearances, in-flight oxygen provisions, ticketing, and ground transportation logistics. The choice between commercial stretcher, first class, or business class accommodations is guided by the patient\'s specific needs, considering factors like additional legroom, reclining capabilities, and medical equipment requirements. The decision to engage a medical escort is contingent upon the patient\'s medical condition.',
    'section2_content3' => 'For inquiries, kindly reach out to us via phone or email to discuss your case. Our medical escorts are recognized by various titles, including flying doctors, flying nurses, RNs, med flights, and sky nurses, among others.',
    'mobile_no' => EMERGENCY_PHONE,
    'page_name_without_break' => 'Ashoka Rescue Medical Escort'
], $data);

?>

<section class="banner-section sec-py">
    <div class="container">
        <div class="banner-content">
            <div class="row align-items-end">
                <div class="col-lg-12">
                    <h1 class="banner-title text-center" data-aos="fade-up" data-aos-duration="1500">
                        <?php echo $data['title']; ?>
                    </h1>
                </div>
            </div>
        </div>
    </div>
</section>
<!--/Banner Section -->

<section class="about-section sec-py">
    <div class="container">
        <div class="row align-items-start">
            <div class="col-lg-5">
                <div class="about-img" data-aos="fade-right" data-aos-duration="1000">
                    <img src="<?php echo SITE_URL . $data['banner']; ?>" class="img-fluid"
                        alt="<?php echo $data['page_name_without_break']; ?>">
                </div>
            </div>
            <div class="col-lg-7">
                <div class="about-content" data-aos="fade-up" data-aos-duration="1500">
                    <h2 class="section-title">
                        <?php echo $data['page_name_without_break']; ?>
                    </h2>
                    <p>
                        <?php echo $data['main_content']; ?>
                    </p>
                    <p>
                        <?php echo $data['section1_content']; ?>
                    </p>
                    <p>
                        <?php echo $data['section1_footer']; ?>
                    </p>
                    <div class="button-group mt-4">
                        <a href="<?php echo SITE_URL; ?>/contact" class="btn btn-solid btn-md rounded">Contact Us</a>
                        <a href="tel:<?php echo str_replace(' ', '', $data['mobile_no']); ?>"
                            class="text-secondary title-font fs-20 fw-800 ms-3">
                            <i class="bi bi-telephone me-2"></i>
                            <?php echo $data['mobile_no']; ?>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!--/First Section -->

<section class="about-section sec-py bg-light">
    <div class="container">
        <div class="row align-items-start">
            <div class="col-lg-7 order-lg-1 order-2">
                <div class="about-content" data-aos="fade-up" data-aos-duration="1500">
                    <p>
                        <?php echo $data['section2_content1']; ?>
                    </p>
                    <p>
                        <?php echo $data['section2_content2']; ?>
                    </p>
                    <p>
                        <?php echo $data['section2_content3']; ?>
                    </p>
                </div>
            </div>
            <div class="col-lg-5 order-lg-2 order-1">
                <div class="about-img" data-aos="fade-left" data-aos-duration="1000">
                    <img src="<?php echo SITE_URL . $data['section2_image']; ?>" class="img-fluid"
                        alt="<?php echo $data['page_name_without_break']; ?>">
                </div>
            </div>
        </div>
    </div>
</section>
<!--/Second Section -->

<style>
    .about-section .about-img {
        position: relative;
        width: 100%;
        padding-bottom: 100%;
        /* Square aspect ratio */
        overflow: hidden;
    }

    .about-section .about-img img {
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        object-fit: cover;
        object-position: top;
    }

    @media (max-width: 991.98px) {
        .about-section .about-img {
            margin-bottom: 1.5rem;
        }
    }
</style>

<script>
    var content = $("#voice_text").text();
</script>

<?php
include __DIR__ . '/../includes/footer.php';
?>
