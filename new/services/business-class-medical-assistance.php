<?php
/**
 * Business Class Assistance Service Page
 */

// Page-specific variables
$serviceId = 3;
$pageTitle = 'Business Class Medical Assistance - Safe Patient Travel';
$pageDescription = 'Book trusted business class medical assistance with Ashoka Rescue. Comfortable air travel for patients with medical support, safety, and 24/7 coordination.';
$pageKeywords = 'Business Class Medical Assistance';

// Include header
$additionalStyles = '<link rel="stylesheet" href="../assets/css/home-modern.css?v=20260921-cache-reset"><link rel="stylesheet" href="../assets/css/services-modern.css?v=20260921-cache-reset">';
include __DIR__ . '/../includes/header.php';

// Get service content from database
$data = getServiceContent($serviceId);

// Set defaults if data is missing
$data = array_merge([
    'title' => 'BUSINESS CLASS<br/>ASSISTANCE',
    'tagline' => 'This service typically refers to the transportation of the patients who are relatively stable and can travel on wheelchairs with medical assistance of our doctors.',
    'banner' => '/assets/images/hero-bg.jpg',
    'main_content' => 'Business class medical assistance typically refers to the medical transportation in an airline business class that provides medical assistance for the patient on board. This service is designed to offer a more comfortable and convenient travel experience while being assisted by a doctor or a nurse with required medical equipment and oxygen. Business class passengers often have dedicated check-in counters or priority lanes to expedite the check-in process.',
    'mobile_no' => EMERGENCY_PHONE,
    'middle_banner' => '/assets/images/Rectangle-2033.jpg',
    'premium_facility_content' => 'At Ashoka Rescue, we aim to provide exceptional assistance to patients traveling in premium classes on various airlines. This option is viable for patients who can sit in reclined chairs. You can choose your preferred flight, and we will be there to support you every step of the way. Our specialized doctors will accompany you throughout your journey, ensuring you receive the best care possible on the airline of your choice.',
    'medical_staff_image' => '/assets/images/hero-bg.jpg',
    'medical_staff_content' => 'Premium medical facilities typically employ highly skilled and experienced medical professionals, including board-certified physicians, nurses, and allied healthcare professionals assisting you during your flight. These professionals often have specialized training and expertise in their respective fields of medical transportation.',
    'faq_tag_line' => 'A Premium Medical Facility Aims To Provide An Exceptional Healthcare Experience By Combining Clinical Excellence With Personalized Care',
    'faq_title_1' => 'Focus on Privacy and Confidentiality',
    'faq_content_1' => 'Premium medical facilities prioritize patient privacy and confidentiality, ensuring that patient information is handled securely and discreetly. They may implement strict privacy policies and security measures to protect patient data and ensure compliance with healthcare regulations.',
    'faq_title_2' => 'Premium Facility',
    'faq_content_2' => 'Premium medical facilities may offer personalized care plans tailored to each patient\'s individual needs and preferences. This may involve comprehensive assessments, multidisciplinary care teams, and coordinated care throughout the patient\'s treatment journey.',
    'faq_title_3' => '',
    'faq_content_3' => '',
    'footer_image_1' => '/upload/image/240520102610Business Class Assistance - image1 (1).jpg',
    'footer_image_2' => '/upload/image/24052351949Business Class Assistance - image1 (1).jpg',
    'footer_image_3' => '/upload/image/24052351828Business Class Assistance - image1 (2).jpg',
    'page_name_without_break' => 'Business Class Assistance'
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

<section class="about-section sec-py bg-light">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-lg-7">
                <div class="about-content" data-aos="fade-up" data-aos-duration="1500">
                    <h2 class="section-title">
                        PREMIUM MEDICAL TRAVEL FACILITY
                    </h2>
                    <p>
                        <?php echo $data['premium_facility_content']; ?>
                    </p>
                    <div class="button-group mt-3 mt-lg-4">
                        <a href="<?php echo SITE_URL; ?>/contact" class="btn btn-solid btn-md rounded">Contact Now</a>
                    </div>
                </div>
            </div>
            <div class="col-lg-5">
                <div class="about-img" data-aos="fade-left" data-aos-duration="1000">
                    <img src="<?php echo SITE_URL . $data['middle_banner']; ?>" class="img-fluid" alt="">
                </div>
            </div>
        </div>
    </div>
</section>
<!--/Premium Medical Travel Facility Section -->

<section class="about-section sec-py bg-light">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-lg-5">
                <div class="about-img" data-aos="fade-right" data-aos-duration="1000">
                    <img src="<?php echo SITE_URL . $data['medical_staff_image']; ?>" class="img-fluid" alt="">
                </div>
            </div>
            <div class="col-lg-7">
                <div class="about-content" data-aos="fade-up" data-aos-duration="1500">
                    <h2 class="section-title">
                        HIGHLY QUALIFIED MEDICAL STAFF
                    </h2>
                    <p>
                        <?php echo $data['medical_staff_content']; ?>
                    </p>
                </div>
            </div>
        </div>
    </div>
</section>
<!--/Highly Qualified Medical Staff Section -->

<section class="emergency-section business-assistance-benefits sec-py">
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
                    </ul>
                </div>
            </div>
            <div class="col-lg-6">
                <div class="emergency-list">
                    <ul>
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
        </div>
    </div>
</section>
<!--/Emergency Section -->

<section class="featured-section sec-pb">
    <div class="container">
        <div class="row">
            <div class="col-lg-4">
                <div class="card" data-aos="fade-right" data-aos-duration="1500">
                    <div class="img-box">
                        <img src="<?php echo SITE_URL . $data['footer_image_1']; ?>" class="img-fluid" alt="">
                    </div>
                </div>
            </div>
            <div class="col-lg-4">
                <div class="card" data-aos="fade-down" data-aos-duration="2500">
                    <div class="img-box">
                        <img src="<?php echo SITE_URL . $data['footer_image_2']; ?>" class="img-fluid" alt="">
                    </div>
                </div>
            </div>
            <div class="col-lg-4">
                <div class="card" data-aos="fade-left" data-aos-duration="1000">
                    <div class="img-box">
                        <img src="<?php echo SITE_URL . $data['footer_image_3']; ?>" class="img-fluid" alt="">
                    </div>
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
