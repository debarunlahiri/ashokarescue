<?php
/**
 * Paediatric Medical Transport Service Page
 */

// Page-specific variables
$serviceId = 10;
$pageTitle = 'Paediatric Medical Transport Service - Safe Care';
$pageDescription = 'Reliable paediatric medical transport service with expert doctors and advanced equipment ensuring safe, comfortable, and timely transfer for children.';
$pageKeywords = 'Paediatric Medical Transport Service';

// Include header
$additionalStyles = '<link rel="stylesheet" href="../assets/css/home-modern.css?v=20260921-cache-reset"><link rel="stylesheet" href="../assets/css/services-modern.css?v=20260921-cache-reset">';
include __DIR__ . '/../includes/header.php';

// Get service content from database
$data = getServiceContent($serviceId);

// Set defaults if data is missing
$data = array_merge([
    'title' => 'PAEDIATRIC MEDICAL<br/>TRANSPORT',
    'tagline' => 'Specialized medical transport for children and adolescents',
    'banner' => '/assets/images/images-ambulance_others/005 AM.jpg',
    'main_content' => 'Ashoka Rescue Medical Transports offers comprehensive transportation services for paediatric patients through various means such as air ambulance, commercial stretcher, train ambulance, road ambulance, both domestically and internationally.

The transportation of paediatric patients requires specialized expertise due to unique anatomical and physiological considerations, necessitating a proficient medical team comprising critical care paediatricians, paediatric nurses, and specialized paediatric ICU equipment. Ashoka Rescue is dedicated to paediatric air ambulance and intensive care transport, with a primary focus on safety and delivering top-tier medical services.

Our paediatric medical staff and nurses are equipped with cutting-edge medical technology, including incubators, ventilators, cardiac monitors, perfusers, video laryngoscopes, vein finding systems, mobile blood gas analysers, and oxygen supply to ensure the highest quality care.

We take pride in our 24-hour rapid response services that guarantee prompt and seamless door-to-door transportation for paediatric patients.',
    'mobile_no' => EMERGENCY_PHONE,
    'middle_banner' => '/upload/image/240716102317pmt.jpg',
    'paediatric_content' => 'Our paediatric transport team is specially trained to care for children from infancy through adolescence. We use age-appropriate equipment, provide family-centered care, and ensure a comfortable, less stressful transport experience for young patients. Our team includes pediatric intensivists, pediatric nurses, and child life specialists.',
    'medical_staff_image' => '/upload/image/240716102317pmt.jpg',
    'medical_staff_content' => 'Our paediatric transport specialists include board-certified pediatricians, pediatric critical care physicians, PICU-trained nurses, and respiratory therapists with extensive experience in pediatric emergency medicine and transport.',
    'faq_tag_line' => 'Comprehensive paediatric transport with child-focused care',
    'faq_title_1' => 'Pediatric Specialists',
    'faq_content_1' => 'Board-certified pediatricians, PICU nurses, and child life specialists trained in pediatric emergency care and transport medicine.',
    'faq_title_2' => 'Age-Appropriate Equipment',
    'faq_content_2' => 'Pediatric-sized medical equipment, monitors, ventilators, and supplies suitable for infants, children, and adolescents.',
    'faq_title_3' => 'Family-Centered Care',
    'faq_content_3' => 'We accommodate family members when possible and provide emotional support to reduce stress for both patients and families.',
    'faq_title_4' => 'Comfort and Safety',
    'faq_content_4' => 'Child-friendly environment with toys, comfort items, and distraction techniques to reduce anxiety during transport.',
    'footer_image_1' => '/upload/image/240716102317pmt.jpg',
    'footer_image_2' => '/upload/image/240716102317pmt.jpg',
    'footer_image_3' => '/upload/image/240716102317pmt.jpg',
    'page_name_without_break' => 'Paediatric Medical Transport'
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

<style>
    .about-section .about-img {
        position: relative;
        width: 100%;
        padding-bottom: 100%;
        /* 16:9 aspect ratio */
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
</style>

<script>
    var content = $("#voice_text").text();
</script>

<?php
include __DIR__ . '/../includes/footer.php';
?>
