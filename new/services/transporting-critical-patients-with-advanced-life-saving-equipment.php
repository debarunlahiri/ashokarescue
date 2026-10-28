<?php
/**
 * Transporting Critical Patients with Advanced Life-Saving Equipment Service Page
 */

// Page-specific variables
$serviceId = 12;
$pageTitle = 'Transporting Critical Patients - Advanced Life Support';
$pageDescription = 'Safe and efficient transport for critical patients with advanced life-saving equipment, expert medical teams, and continuous ICU-level monitoring.';
$pageKeywords = 'Transporting Critical Patients';

// Include header
$additionalStyles = '<link rel="stylesheet" href="../assets/css/home-modern.css?v=20260921-cache-reset"><link rel="stylesheet" href="../assets/css/services-modern.css?v=20260921-cache-reset">';
include __DIR__ . '/../includes/header.php';

// Get service content from database
$data = getServiceContent($serviceId);

// Set defaults if data is missing
$data = array_merge([
    'title' => 'TRANSPORTING CRITICAL PATIENTS WITH ADVANCED LIFE-SAVING EQUIPMENT',
    'banner' => '/assets/images/images-ambulance_others/004 AM.jpg',
    'main_content' => 'Ashoka Rescue Medical Transports specialize in the transportation of critically ill patients with compromised vital hemodynamic parameters. Our comprehensive services include:',
    'footer_content' => 'We uphold the highest standards of care during transit to enhance patient outcomes.',
    'mobile_no' => EMERGENCY_PHONE,
    'page_name_without_break' => 'Transporting Critical Patients with Advanced Life-Saving Equipment'
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
                    <ul class="service-list">
                        <li><span class="bullet">◆</span> Oxygen therapy</li>
                        <li><span class="bullet">◆</span> Cardiac monitoring</li>
                        <li><span class="bullet">◆</span> Ventilator and BiPAP support</li>
                        <li><span class="bullet">◆</span> Syringe pumps for medication delivery</li>
                        <li><span class="bullet">◆</span> Suction equipment</li>
                        <li><span class="bullet">◆</span> Peritoneal dialysis machines</li>
                        <li><span class="bullet">◆</span> High-flow nasal cannula (HNF)</li>
                        <li><span class="bullet">◆</span> Infant incubators</li>
                        <li><span class="bullet">◆</span> Intra-aortic balloon pump (IABP)</li>
                        <li><span class="bullet">◆</span> External pacemaker</li>
                        <li><span class="bullet">◆</span> ECMO (Extracorporeal membrane oxygenation)</li>
                        <li><span class="bullet">◆</span> Temporary pacemaker placement</li>
                        <li><span class="bullet">◆</span> Invasive blood pressure monitoring</li>
                    </ul>
                    <p class="mt-3">
                        <?php echo $data['footer_content']; ?>
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
    /* .about-section .about-img {
        position: relative;
        width: 100%;
        padding-bottom: 100%;
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
    } */

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
