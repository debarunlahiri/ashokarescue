<?php
/**
 * Patient Transfer on ECMO Service Page
 */

// Page-specific variables
$serviceId = 8;
$pageTitle = 'Patient Transfer on ECMO - Safe Critical Care';
$pageDescription = 'Expert patient transfer on ECMO with advanced life support, ICU-level monitoring, and skilled critical care teams for safe hospital-to-hospital transport.';
$pageKeywords = 'Patient Transfer on ECMO';

// Include header
$additionalStyles = '<link rel="stylesheet" href="../assets/css/home-modern.css?v=20260921-cache-reset"><link rel="stylesheet" href="../assets/css/services-modern.css?v=20260921-cache-reset">';
include __DIR__ . '/../includes/header.php';

// Get service content from database
$data = getServiceContent($serviceId);

// Set defaults if data is missing
$data = array_merge([
    'title' => 'PATIENT TRANSFER<br/>ON ECMO',
    'tagline' => 'Specialized transport for critically ill patients requiring ECMO support',
    'banner' => '/upload/image/240716102155ecmo.jpg',
    'main_content' => 'Ashoka Rescue Medical Transport (ARMT) specializes in the transportation of critically unstable patients requiring simultaneous respiratory and circulatory support through Extracorporeal Membrane Oxygenation (ECMO) technology. ECMO serves as an external artificial heart and lung system, maintaining the patient\'s blood circulation outside the body.

Our specialized medical teams, comprising cardiovascular thoracic surgeons, critical care physicians, and perfusionists, are proficient in traveling to hospitals, conducting cannulation on-site, initiating ECMO support, and arranging transportation. We facilitate both domestic and international transfers for patients receiving ECMO therapy.

Throughout ECMO treatment, the patient\'s heart remains operational with assistance from the ECMO device, significantly alleviating the heart and lung workload. This approach aims to temporarily stabilize patients by ensuring adequate blood flow and oxygenation, thereby supporting cardiovascular and respiratory functions.',
    'mobile_no' => EMERGENCY_PHONE,
    'middle_banner' => '/upload/image/240716102155ecmo.jpg',
    'ecmo_content' => 'Our ECMO transport team consists of highly specialized critical care physicians, perfusionists, and nurses trained in managing ECMO circuits during transport. We use state-of-the-art portable ECMO machines and monitoring equipment to ensure continuous, safe support throughout the transfer process.',
    'medical_staff_image' => '/upload/image/240716102155ecmo.jpg',
    'medical_staff_content' => 'Our ECMO transport specialists include board-certified intensivists, certified perfusionists, and critical care nurses with extensive experience in ECMO management. Each team member undergoes rigorous training in transport medicine and ECMO troubleshooting.',
    'faq_tag_line' => 'Advanced ECMO transport services for critically ill patients',
    'faq_title_1' => 'ECMO Expertise',
    'faq_content_1' => 'Our team includes certified ECMO specialists and perfusionists with years of experience in managing ECMO patients during critical transport situations.',
    'faq_title_2' => 'Advanced Equipment',
    'faq_content_2' => 'We utilize portable ECMO machines, advanced monitoring systems, and backup equipment to ensure uninterrupted support during transport.',
    'faq_title_3' => 'Continuous Monitoring',
    'faq_content_3' => 'Real-time monitoring of ECMO circuit parameters, patient vitals, and blood gas analysis throughout the entire transport process.',
    'faq_title_4' => 'Rapid Response',
    'faq_content_4' => '24/7 availability for emergency ECMO transports with rapid mobilization of specialized teams and equipment.',
    'footer_image_1' => '/upload/image/240716102155ecmo.jpg',
    'footer_image_2' => '/upload/image/240716102155ecmo.jpg',
    'footer_image_3' => '/upload/image/240716102155ecmo.jpg',
    'page_name_without_break' => 'Patient Transfer on ECMO'
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
