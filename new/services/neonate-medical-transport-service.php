<?php
/**
 * Neonate Medical Transportation Service Page
 */

// Page-specific variables
$serviceId = 9;
$pageTitle = 'Neonate Medical Transport Service - Safe NICU Transfers';
$pageDescription = 'Specialized neonate medical transport service with NICU-level care, incubators, and expert neonatal teams for safe hospital-to-hospital transfers.';
$pageKeywords = 'Neonate Medical Transport Service';

// Include header
$additionalStyles = '<link rel="stylesheet" href="../assets/css/home-modern.css?v=20260921-cache-reset"><link rel="stylesheet" href="../assets/css/services-modern.css?v=20260921-cache-reset">';
include __DIR__ . '/../includes/header.php';

// Get service content from database
$data = getServiceContent($serviceId);

// Set defaults if data is missing
$data = array_merge([
    'title' => 'NEONATE MEDICAL<br/>TRANSPORTATION',
    'tagline' => 'Specialized transport for newborn and premature infants',
    'banner' => '/upload/image/240716102241nmt.jpg',
    'main_content' => 'The Ashoka Rescue Medical Transports team specializes in the transportation of neonate patients on a national and international scale, utilizing various means such as air ambulance, commercial stretcher, train ambulance, and ground ambulance. 

Our services are also for new-borns in need of urgent and specialized care for transportation to Neonatal Intensive Care Units (NICU), ensuring prompt medical attention post-birth. Ashoka Rescue provides air transports for neonates, fostering effective collaboration among all stakeholders involved in transferring patients from NICU settings. Comprising critical care neonatologists, neonatal nurses, respiratory therapists, and paramedics. Our neonatal team possesses expertise in neonatal resuscitation and interventions, sharpened through extensive transport experience.

Neonatal transportation is facilitated in incubators equipped with essential Paediatric Advanced Life Support (PALS) equipment, guaranteeing uninterrupted care during transitions between locations.',
    'mobile_no' => EMERGENCY_PHONE,
    'middle_banner' => '/upload/image/240716102241nmt.jpg',
    'neonate_content' => 'Our neonatal transport team uses specialized incubators, ventilators, and monitoring equipment designed specifically for newborns. We maintain precise temperature control, humidity levels, and provide continuous respiratory support during transport. Our team includes neonatologists, NICU nurses, and respiratory therapists trained in neonatal critical care.',
    'medical_staff_image' => '/upload/image/240716102241nmt.jpg',
    'medical_staff_content' => 'Our neonatal transport specialists include board-certified neonatologists, NICU-trained nurses, and neonatal respiratory therapists. Each team member has extensive experience in managing premature and critically ill newborns during transport.',
    'faq_tag_line' => 'Comprehensive neonatal transport services with specialized care',
    'faq_title_1' => 'Specialized Equipment',
    'faq_content_1' => 'Transport incubators with precise temperature control, neonatal ventilators, phototherapy units, and advanced monitoring systems designed for newborns.',
    'faq_title_2' => 'Expert Neonatal Team',
    'faq_content_2' => 'Neonatologists, NICU nurses, and respiratory therapists with specialized training in neonatal transport and critical care.',
    'faq_title_3' => 'Temperature Management',
    'faq_content_3' => 'Strict temperature control and humidity regulation to maintain optimal thermal environment for premature and critically ill newborns.',
    'faq_title_4' => 'Continuous Monitoring',
    'faq_content_4' => 'Real-time monitoring of vital signs, oxygen saturation, blood pressure, and other critical parameters throughout transport.',
    'footer_image_1' => '/upload/image/240716102241nmt.jpg',
    'footer_image_2' => '/upload/image/240716102241nmt.jpg',
    'footer_image_3' => '/upload/image/240716102241nmt.jpg',
    'page_name_without_break' => 'Neonate Medical Transportation'
], $data);
?>

<section class="banner-section sec-py">
    <div class="container">
        <div class="banner-content">
            <div class="row align-items-end">
                <div class="col-lg-5">
                    <h1 class="banner-title" data-aos="fade-up" data-aos-duration="1500">
                        <?php echo $data['title']; ?>
                    </h1>
                </div>
                <div class="col-lg-6 offset-lg-1">
                    <p data-aos="fade-up" data-aos-duration="2500">
                        <?php echo $data['tagline']; ?>
                    </p>
                </div>
            </div>
        </div>
    </div>
</section>
<!--/Banner Section -->

<section class="about-section sec-py">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-lg-5">
                <div class="about-img" data-aos="fade-right" data-aos-duration="1000">
                    <img src="<?php echo SITE_URL . $data['banner']; ?>" class="img-fluid" alt="">
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
                    <div class="button-group mt-3 mt-lg-4">
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
<!--/About Section -->

<section class="emergency-section sec-py bg-light">
    <div class="container">
        <div class="section-header mb-4">
            <h2 class="section-title" data-aos="fade-up" data-aos-duration="1000">
                <?php echo $data['faq_tag_line']; ?>
            </h2>
        </div>
        <div class="row">
            <div class="col-lg-6">
                <div class="emergency-list">
                    <ul>
                        <?php if (!empty($data['faq_title_1'])): ?>
                            <li data-aos="fade-up" data-aos-duration="1000">
                                <h3 class="title">
                                    <?php echo $data['faq_title_1']; ?>
                                </h3>
                                <p>
                                    <?php echo $data['faq_content_1']; ?>
                                </p>
                            </li>
                        <?php endif; ?>
                        <?php if (!empty($data['faq_title_2'])): ?>
                            <li data-aos="fade-up" data-aos-duration="1500">
                                <h3 class="title">
                                    <?php echo $data['faq_title_2']; ?>
                                </h3>
                                <p>
                                    <?php echo $data['faq_content_2']; ?>
                                </p>
                            </li>
                        <?php endif; ?>
                    </ul>
                </div>
            </div>
            <div class="col-lg-6">
                <div class="emergency-list">
                    <ul>
                        <?php if (!empty($data['faq_title_3'])): ?>
                            <li data-aos="fade-up" data-aos-duration="2000">
                                <h3 class="title">
                                    <?php echo $data['faq_title_3']; ?>
                                </h3>
                                <p>
                                    <?php echo $data['faq_content_3']; ?>
                                </p>
                            </li>
                        <?php endif; ?>
                        <?php if (!empty($data['faq_title_4'])): ?>
                            <li data-aos="fade-up" data-aos-duration="2500">
                                <h3 class="title">
                                    <?php echo $data['faq_title_4']; ?>
                                </h3>
                                <p>
                                    <?php echo $data['faq_content_4']; ?>
                                </p>
                            </li>
                        <?php endif; ?>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</section>

<script>
    var content = $("#voice_text").text();
</script>

<?php
include __DIR__ . '/../includes/footer.php';
?>
