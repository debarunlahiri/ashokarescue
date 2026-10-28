<?php
/**
 * Transporting Kidney Failure Patients Service Page
 */

// Page-specific variables
$serviceId = 11;
$pageTitle = 'Transporting Kidney Failure Patients - Safe Transfers';
$pageDescription = 'Expert service for transporting kidney failure patients with medical supervision, advanced care, and safe hospital-to-hospital transfer support.';
$pageKeywords = 'Transporting Kidney Failure Patients';

// Include header
$additionalStyles = '<link rel="stylesheet" href="../assets/css/home-modern.css?v=20260921-cache-reset"><link rel="stylesheet" href="../assets/css/services-modern.css?v=20260921-cache-reset">';
include __DIR__ . '/../includes/header.php';

// Get service content from database
$data = getServiceContent($serviceId);

// Set defaults if data is missing
$data = array_merge([
    'title' => 'TRANSPORTING KIDNEY FAILURE PATIENTS',
    'banner' => '/upload/image/240716102406tkfp.jpg',
    'main_content' => 'Ashoka Rescue Medical Transports specializes in transporting patients with kidney failure, necessitating dialysis or kidney transplants, including those undergoing peritoneal dialysis (PD), for long-distance travel.',
    'services_content' => 'Our services encompass a portable dialysis unit equipped with critical care, a nephrologist, skilled kidney dialysis technicians, and all essential ICU apparatus.',
    'emergency_intro' => 'In cases of kidney emergencies, Ashoka Rescue Medical Transports offers various transportation choices for patients:',
    'mobile_no' => EMERGENCY_PHONE,
    'page_name_without_break' => 'Transporting Kidney Failure Patients'
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
                        <?php echo $data['services_content']; ?>
                    </p>
                    <p>
                        <?php echo $data['emergency_intro']; ?>
                    </p>
                    <ul class="service-list">
                        <li><span class="bullet">◆</span> Air Ambulance</li>
                        <li><span class="bullet">◆</span> Commercial Airline Stretcher</li>
                        <li><span class="bullet">◆</span> Commercial Airline Business Class</li>
                        <li><span class="bullet">◆</span> Train Ambulance</li>
                        <li><span class="bullet">◆</span> Road Ambulance</li>
                    </ul>
                    <p class="mt-3">
                        Each transportation option is designed to provide secure and specialized care tailored to the
                        individual medical requirements of the patient.
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

    .service-list {
        list-style: none;
        padding-left: 0;
        margin-top: 1rem;
    }

    .service-list li {
        padding: 0.5rem 0;
        padding-left: 0 !important;
        display: flex;
        align-items: center;
    }

    .service-list li::before {
        display: none !important;
    }

    .service-list li .bullet {
        color: var(--clr-secondary, #FF4B34);
        margin-right: 0.75rem;
        font-size: 0.875rem;
    }
</style>

<script>
    var content = $("#voice_text").text();
</script>

<?php
include __DIR__ . '/../includes/footer.php';
?>
