<?php
/**
 * Ambulance Service Page
 */

// Page-specific variables
$serviceId = 4;
$pageTitle = 'Road Ambulance Service in Delhi & Across India | Ashoka Rescue';
$pageDescription = 'Looking for a reliable road ambulance service in Delhi with across India? Ashoka Rescue provides 24/7 emergency transport with trained medical staff.';
$pageKeywords = 'road ambulance service in delhi, road ambulance service in India, ambulance on road in india';

// Include header
$additionalStyles = '<link rel="stylesheet" href="../assets/css/home-modern.css?v=20260921-cache-reset"><link rel="stylesheet" href="../assets/css/services-modern.css?v=20260921-cache-reset">';
include __DIR__ . '/../includes/header.php';

// Get service content from database
$data = getServiceContent($serviceId);

// Set defaults if data is missing
$data = array_merge([
    'title' => 'AMBULANCE<br/>SERVICE',
    'tagline' => 'Providing ambulance service to and from airlines and hospitals for any further assistance.',
    'banner' => '/assets/images/images-ambulance_others/002 AM.jpg',
    'main_content' => 'Ambulance services offer seamless transportations for patients bed to bed.',
    'mobile_no' => EMERGENCY_PHONE,
    'middle_banner' => '/assets/images/images-ambulance_others/005 AM.jpg',
    'ambulance_service_content' => 'Our services encompass the pickup and drop-off of patients and medical assistance personnel, including doctors, paramedics, and RNs, at airports. Our dedicated ambulance crew members facilitate the transportation of medical personnel to and from airports, ensuring a smooth handover process and proceeding to the designated destination. Rest assured, Ashoka Rescue Ambulances makes sure to maintain the highest level of care and safety for our patients throughout their journey.',
    'medical_staff_image' => '/assets/images/images-ambulance_others/001 AM.jpg',
    'medical_staff_content' => 'Premium medical facilities typically employ highly skilled and experienced medical professionals, including board-certified physicians, surgeons, nurses, and allied healthcare professionals. These professionals often have specialized training and expertise in their respective fields.',
    'faq_tag_line' => 'Ambulance services offer seamless transportations for patients bed to bed.',
    'faq_title_1' => 'Seamless response',
    'faq_content_1' => 'Our ambulance and partners provide patients with solutions that allow them to seamlessly travel to their destination of care and treatment. Further whether it\'s curbside or tarmac-side pickup and drop-off, our ambulances are equipped to provide wheelchair assistance at airports and drop-offs.',
    'faq_title_2' => 'Specialized Ambulance',
    'faq_content_2' => 'Ashoka Rescue Ambulance maintains certification in Basic Life Support (BLS), Advanced Cardiac Life Support (ACLS), and Advanced Trauma Life Support (ATLS), ensuring the highest level of care for our patients.',
    'faq_title_3' => 'Transportation Bed to bed',
    'faq_content_3' => 'If you are traveling by commercial stretcher or Business class assistance our ambulances are there to provide transportations assistance bed to bed through the travel.',
    'faq_title_4' => 'Medical Consultation:',
    'faq_content_4' => 'We coordinate with your healthcare providers to understand your medical needs and ensure all necessary arrangements are made',
    'footer_image_1' => '/assets/images/images-ambulance_others/IMG_8442.jpg',
    'footer_image_2' => '/assets/images/images-ambulance_others/IMG_9779.jpg',
    'footer_image_3' => '/assets/images/images-ambulance_others/005 AM.jpg',
    'page_name_without_break' => 'Ambulance Service'
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
                    <img src="<?php echo SITE_URL . "/assets/images/images-ambulance_others/002 AM.jpg"; ?>"
                        class="img-fluid" alt="">
                </div>
            </div>
            <div class="col-lg-7">
                <div class="about-content" data-aos="fade-up" data-aos-duration="1500">
                    <h2 class="section-title">
                        <?php echo $data['page_name_without_break']; ?>
                    </h2>
                    <p>
                        Ashoka Rescue Medical Transports offers non-emergency ambulance services at International
                        airports worldwide, facilitating the pickup and drop-off of repatriating patients via commercial
                        airlines, including Business class, stretcher, and air ambulance travel options. We adhere to
                        international standards, providing pre-booked services staffed by qualified ambulance
                        professionals, including critical care doctors, respiratory physicians, registered nurses (RN),
                        paramedics, and advanced-level Emergency Medical Technicians (EMT) as per the patient's
                        requirements. Through our extensive network of ambulance providers worldwide, we ensure seamless
                        coordination and reliable services.
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

<section class="emergency-section road-ambulance-capabilities sec-py">
    <div class="container">
        <div class="section-header mb-4">
            <span class="road-capability-kicker"><i class="fa-solid fa-truck-medical"></i> Ready across every mile</span>
            <h2 class="section-title" data-aos="fade-up" data-aos-duration="1000">
                Complete care from pickup to handover
            </h2>
            <p><?php echo $data['faq_tag_line']; ?></p>
        </div>
        <div class="row">
            <div class="col-lg-6">
                <div class="emergency-list">
                    <ul>
                        <?php if (!empty($data['faq_title_1'])): ?>
                            <li data-aos="fade-up" data-aos-duration="1000">
                                <span class="capability-icon"><i class="fa-solid fa-bolt"></i></span>
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
                                <span class="capability-icon"><i class="fa-solid fa-kit-medical"></i></span>
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
                                <span class="capability-icon"><i class="fa-solid fa-bed-pulse"></i></span>
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
                                <span class="capability-icon"><i class="fa-solid fa-user-doctor"></i></span>
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
<!--/Features Section -->

<section class="about-section sec-py">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-lg-7">
                <div class="about-content" data-aos="fade-up" data-aos-duration="1500">
                    <h2 class="section-title">
                        AMBULANCE SERVICE
                    </h2>
                    <p>
                        <?php echo $data['ambulance_service_content']; ?>
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
<!--/Ambulance Service Section -->

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
