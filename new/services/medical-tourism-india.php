<?php
/**
 * Medical Tourism Service Page
 */

// Page-specific variables
$serviceId = 5;
$pageTitle = 'Medical Tourism India - Affordable Healthcare Abroad';
$pageDescription = 'Explore medical tourism in India with expert care, world-class hospitals, and affordable treatment packages tailored for international patients.';
$pageKeywords = 'Medical Tourism India';

// Include header
$additionalStyles = '<link rel="stylesheet" href="../assets/css/home-modern.css?v=20260921-cache-reset"><link rel="stylesheet" href="../assets/css/services-modern.css?v=20260921-cache-reset">';
include __DIR__ . '/../includes/header.php';

// Get service content from database
$data = getServiceContent($serviceId);

// Set defaults if data is missing
$data = array_merge([
    'title' => 'MEDICAL<br/>TOURISM',
    'tagline' => 'Quality healthcare abroad with complete assistance',
    'banner' => '/assets/images/hero-bg.jpg',
    'main_content' => 'Ashoka Rescue Medical Transports specializes in facilitating medical tourism for patients seeking major medical procedures in India. Our services cater to patients traveling for critical surgeries and treatments such as lung transplants, liver transplants, kidney transplants, cancer treatments, and joint replacements. We ensure that patients receive care at the best hospitals under the supervision of top consultants and specialists.',
    'mobile_no' => EMERGENCY_PHONE,
    'middle_banner' => '/assets/images/Rectangle-2033.jpg',
    'medical_tourism_content' => 'Medical tourism refers to the practice of traveling to another country to receive medical treatment. We facilitate access to specialized surgeries including cardiac surgery, orthopedic surgery, and bariatric surgery. Our services include critical treatments such as cancer treatment with access to leading oncologists, organ transplantation with expert care in lung, liver, and kidney transplants, and joint replacement using cutting-edge techniques.',
    'medical_staff_image' => '/assets/images/hero-bg.jpg',
    'medical_staff_content' => 'We coordinate with top hospitals and medical facilities that employ highly skilled and experienced medical professionals, including board-certified physicians, surgeons, nurses, and allied healthcare professionals. These professionals have specialized training and expertise in their respective fields, ensuring you receive the highest quality of care during your medical tourism journey.',
    'faq_tag_line' => 'Medical tourism refers to facilitating major medical treatment in India.',
    'faq_title_1' => 'Specialized Surgeries',
    'faq_content_1' => '1.) Cardiac Surgery 2.) Orthopedic Surgery 3.) Bariatric Surgery',
    'faq_title_2' => 'Critical Treatments',
    'faq_content_2' => '1.) Cancer Treatment: Access to leading oncologists and advanced treatment protocols. 2.) Organ Transplantation: Expert care in lung, liver, and kidney transplants. 3.) Joint Replacement: Cutting-edge techniques for hip, knee, and other joint replacements.',
    'faq_title_3' => 'Wellness and Preventive Care',
    'faq_content_3' => '1.) Comprehensive health check-ups 2.) Preventive treatments',
    'faq_title_4' => 'Logistics & Support Services',
    'faq_content_4' => 'Medical tourism providers and facilitators assist patients with travel arrangements, including transportation, accommodation, visa assistance, and language interpretation services.',
    'footer_image_1' => '/upload/image/24052352854Medical Tourism (1).jpg',
    'footer_image_2' => '/upload/image/240520104057Medical Tourism (2).jpg',
    'footer_image_3' => '/upload/image/24071914914240716102317pmt.jpg',
    'page_name_without_break' => 'Medical Tourism'
], $data);

function renderMedicalTourismDetail($content)
{
    $plainContent = trim(strip_tags((string) $content));
    $items = preg_split('/\s*\d+\.\)\s*/', $plainContent, -1, PREG_SPLIT_NO_EMPTY);

    if (count($items) < 2) {
        return '<p>' . htmlspecialchars($plainContent) . '</p>';
    }

    $html = '<ul class="medical-tourism-detail-list">';
    foreach ($items as $item) {
        $html .= '<li><i class="fa-solid fa-circle-check" aria-hidden="true"></i><span>'
            . htmlspecialchars(trim($item)) . '</span></li>';
    }

    return $html . '</ul>';
}
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

<section class="emergency-section medical-tourism-options sec-py bg-light">
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
                                <?php echo renderMedicalTourismDetail($data['faq_content_1']); ?>
                            </li>
                        <?php endif; ?>
                        <?php if (!empty($data['faq_title_2'])): ?>
                            <li data-aos="fade-up" data-aos-duration="1500">
                                <h3 class="title">
                                    <?php echo $data['faq_title_2']; ?>
                                </h3>
                                <?php echo renderMedicalTourismDetail($data['faq_content_2']); ?>
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
                                <?php echo renderMedicalTourismDetail($data['faq_content_3']); ?>
                            </li>
                        <?php endif; ?>
                        <?php if (!empty($data['faq_title_4'])): ?>
                            <li data-aos="fade-up" data-aos-duration="2500">
                                <h3 class="title">
                                    <?php echo $data['faq_title_4']; ?>
                                </h3>
                                <?php echo renderMedicalTourismDetail($data['faq_content_4']); ?>
                            </li>
                        <?php endif; ?>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</section>
<!--/Features Section -->

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

<script>
    var content = $("#voice_text").text();
</script>

<?php
include __DIR__ . '/../includes/footer.php';
?>
