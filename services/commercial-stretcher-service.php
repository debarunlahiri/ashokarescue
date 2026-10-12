<?php
/**
 * Commercial Stretcher Service Page
 */

// Page-specific variables
$serviceId = 2;
$pageTitle = 'Commercial Stretcher Service - Safe Medical Travel India';
$pageDescription = 'Book reliable commercial stretcher service in India with Ashoka Rescue. Safe patient travel on flights with medical support, 24/7 assistance, and care.';
$pageKeywords = 'Commercial Stretcher Service';

// Include header
$additionalStyles = '<link rel="stylesheet" href="../assets/css/home-modern.css?v=20260921-cache-reset"><link rel="stylesheet" href="../assets/css/services-modern.css?v=20260921-cache-reset">';
include __DIR__ . '/../includes/header.php';

// Get service content from database
$data = getServiceContent($serviceId);

// Set defaults if data is missing
$data = array_merge([
    'title' => 'COMMERCIAL<br/>STRETCHER',
    'tagline' => 'Affordable medical transport on commercial flights',
    'banner' => '/assets/images/images-commercial_strectcher/003 CS.jpg',
    'main_content' => '',
    'mobile_no' => EMERGENCY_PHONE,
    'middle_banner' => '/assets/images/images-commercial_strectcher/IMG_0650.jpeg',
    'utility1' => 'Trusted Doctors',
    'utility2' => 'Award Winning',
    'utility3' => 'Professional Work',
    'utility4' => '24*7 Available',
    'faq_tag_line' => 'Commercial Stretcher Medical Services',
    'faq_title_1' => 'Cost-Effective Solution',
    'faq_content_1' => '',
    'faq_title_2' => 'Medical Supervision',
    'faq_content_2' => '',
    'faq_title_3' => 'Comfortable Transport',
    'faq_content_3' => '',
    'footer_image_1' => '/assets/images/images-commercial_strectcher/001 CS.jpg',
    'footer_image_2' => '/assets/images/images-commercial_strectcher/004 CS.jpg',
    'footer_image_3' => '/assets/images/images-commercial_strectcher/005 CS.jpg',
    'page_name_without_break' => 'Commercial Stretcher'
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
                        <a href="<?php echo SITE_URL; ?>/contact" class="btn btn-solid btn-md rounded">Know More</a>
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

<section class="cta-section">
    <div class="cta-bg-img" data-aos="zoom-in" data-aos-duration="1000">
        <img src="<?php echo SITE_URL . $data['middle_banner']; ?>" class="img-fluid" alt="">
    </div>
    <div class="cta-section-bg">
        <div class="container">
            <div class="cta-content">
                <ul>
                    <li data-aos="fade-right" data-aos-duration="1000">
                        <div class="icon-box">
                            <img src="<?php echo IMG_PATH; ?>icons/trusted-white.svg" class="img-fluid" alt="">
                        </div>
                        <h3 class="title">
                            <?php echo $data['utility1']; ?>
                        </h3>
                    </li>
                    <li data-aos="fade-right" data-aos-duration="1500">
                        <div class="icon-box">
                            <img src="<?php echo IMG_PATH; ?>icons/award-white.svg" class="img-fluid" alt="">
                        </div>
                        <h3 class="title">
                            <?php echo $data['utility2']; ?>
                        </h3>
                    </li>
                    <li data-aos="fade-right" data-aos-duration="2000">
                        <div class="icon-box">
                            <img src="<?php echo IMG_PATH; ?>icons/professional-white.svg" class="img-fluid" alt="">
                        </div>
                        <h3 class="title">
                            <?php echo $data['utility3']; ?>
                        </h3>
                    </li>
                    <li data-aos="fade-right" data-aos-duration="2500">
                        <div class="icon-box">
                            <img src="<?php echo IMG_PATH; ?>icons/24-7-white.svg" class="img-fluid" alt="">
                        </div>
                        <h3 class="title">
                            <?php echo $data['utility4']; ?>
                        </h3>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</section>
<!--/CTA Section -->

<section class="emergency-section sec-py">
    <div class="container">
        <div class="row">
            <div class="col-lg-6">
                <div class="section-header">
                    <h2 class="section-title text-capitalize" data-aos="fade-right" data-aos-duration="1000">
                        <?php echo $data['faq_tag_line']; ?>
                    </h2>
                </div>
            </div>
            <div class="col-lg-5 offset-lg-1">
                <div class="emergency-list">
                    <ul>
                        <li data-aos="fade-up" data-aos-duration="1000">
                            <h3 class="title">
                                <?php echo $data['faq_title_1']; ?>
                            </h3>
                            <p>
                                <?php echo $data['faq_content_1']; ?>
                            </p>
                        </li>
                        <li data-aos="fade-up" data-aos-duration="1500">
                            <h3 class="title">
                                <?php echo $data['faq_title_2']; ?>
                            </h3>
                            <p>
                                <?php echo $data['faq_content_2']; ?>
                            </p>
                        </li>
                        <li data-aos="fade-up" data-aos-duration="2000">
                            <h3 class="title">
                                <?php echo $data['faq_title_3']; ?>
                            </h3>
                            <p>
                                <?php echo $data['faq_content_3']; ?>
                            </p>
                        </li>
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
