<?php
/**
 * Cancer Patients Transportation Service Page
 */

// Page-specific variables
$serviceId = 13;
$pageTitle = 'Cancer Patients Transportation Service - Safe Transfers';
$pageDescription = 'Compassionate cancer patients transportation service with medical escorts and safe, comfortable hospital-to-hospital transfers tailored to patient needs.';
$pageKeywords = 'Cancer Patients Transportation Service';

// Include header
$additionalStyles = '<link rel="stylesheet" href="../assets/css/home-modern.css?v=20260921-cache-reset"><link rel="stylesheet" href="../assets/css/services-modern.css?v=20260921-cache-reset">';
include __DIR__ . '/../includes/header.php';

// Get service content from database
$data = getServiceContent($serviceId);

// Set defaults if data is missing
$data = array_merge([
    'title' => 'CANCER PATIENTS TRANSPORTATION',
    'banner' => '/assets/images/images-ambulance_others/003 AM.jpg',
    'main_content' => 'Ashoka Rescue Medical Transports specializes in providing comprehensive medical assistance and transportation services via air ambulance, commercial stretcher, business class, train ambulance, and road ambulance tailored to meet the specific needs of each patient.
 </p><p>
Ashoka Rescue assists cancer patients by addressing critical transportation challenges, particularly concerning those managing chemotherapy, radiotherapy, and surgical treatments, as well as individuals with compromised immune systems. Our services adhere strictly to established safety protocols throughout patient care.
 </p><p>
Our primary mission at Ashoka Rescue Medical Transports is to eliminate transportation barriers that may impede access to essential healthcare services. Our guiding principle asserts that "No individual should be denied life-saving cancer treatment due to transportation constraints." We are committed to minimizing transportation costs and alleviating travel-related stress through meticulous pre-planning and preparation. Prior to departure, we ensure close coordination with both patients and their medical providers.
 </p><p>
Throughout the journey, our team provides unwavering physical, psychological, and medical support, prioritizing patient hygiene and offering nourishment prepared under strict infection control protocols.
 </p><p>
For patients undergoing treatment, it may be possible to schedule travel between therapy sessions. We strongly advise consulting with your oncologist to determine the optimal timing for travel, ensuring all necessary supplies and dietary requirements are addressed.
',
    'mobile_no' => EMERGENCY_PHONE,
    'page_name_without_break' => 'Cancer Patients Transportation'
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
<!--/About Section -->

<script>
    var content = $("#voice_text").text();
</script>

<?php
include __DIR__ . '/../includes/footer.php';
?>
