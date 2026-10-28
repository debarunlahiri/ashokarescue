<?php
/**
 * Service Detail Page - Ashoka Rescue Air Ambulance Services
 * Dynamic page that displays service details based on slug parameter
 */

// Include required files first
require_once __DIR__ . '/includes/config.php';
require_once __DIR__ . '/includes/functions.php';

// Get slug from URL
$slug = isset($_GET['slug']) ? sanitizeInput($_GET['slug']) : '';

if (empty($slug)) {
    http_response_code(404);
    include __DIR__ . '/404.php';
    exit;
}

// Get service data
$service = getServiceBySlug($slug);

// Unknown slug: serve the 404 page with a proper 404 status instead of
// redirecting (redirects mask broken links from users and search engines).
if (!$service) {
    http_response_code(404);
    include __DIR__ . '/404.php';
    exit;
}

// Include header
$additionalStyles = '<link rel="stylesheet" href="assets/css/rx-services.css?v=' . filemtime(__DIR__ . '/assets/css/rx-services.css') . '">';
include __DIR__ . '/includes/header.php';
$data = getServiceContent($service['id']);

// Set page title and description
$pageTitle = htmlspecialchars($service['title']) . ' | Ashoka Rescue';
$pageDescription = strip_tags($service['content']);

// Default values if content doesn't exist
$defaults = [
    'title' => $service['title'],
    'tagline' => $service['content'],
    'page_name_without_break' => $service['title'],
    'main_content' => $service['content'],
    'mobile_no' => EMERGENCY_PHONE,
    'middle_banner' => $service['banner'],
    'utility1' => 'Trusted Service',
    'utility2' => 'Award Winning',
    'utility3' => 'Professional Team',
    'utility4' => '24/7 Available',
    'faq_tag_line' => 'Common Questions',
    'faq_title_1' => 'What is this service?',
    'faq_content_1' => 'Professional medical transport service.',
    'faq_title_2' => 'How to book?',
    'faq_content_2' => 'Contact us via phone or email.',
    'faq_title_3' => 'Is it available 24/7?',
    'faq_content_3' => 'Yes, we are available round the clock.',
    'footer_image_1' => $service['banner'],
    'footer_image_2' => $service['img2'] ?? $service['banner'],
    'footer_image_3' => $service['img3'] ?? $service['banner'],
];

// Merge with database content
$data = array_merge($defaults, $data);
?>

<!-- Banner Section -->
<section class="banner-section rx-svc-banner rx-dark">
    <span class="rx-orb rx-orb--red" aria-hidden="true"></span>
    <span class="rx-orb rx-orb--cyan" aria-hidden="true"></span>
    <div class="container">
        <div class="banner-content">
            <div class="row align-items-end">
                <div class="col-lg-5">
                    <p class="rx-kicker rx-kicker--light" data-rx>Service brief</p>
                    <h1 class="banner-title" data-rx style="--rx-d:.08s">
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

<!-- About Section -->
<section class="about-section rx-svc-about rx-sec-py">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-lg-5">
                <div class="about-img rx-frame rx-ticks" data-rx="zoom">
                    <img src="<?php echo SITE_URL . $service['banner']; ?>" class="img-fluid" alt="<?php echo htmlspecialchars($service['title']); ?>">
                </div>
            </div>
            <div class="col-lg-7">
                <div class="about-content" data-rx="left">
                    <p class="rx-kicker">Service brief</p>
                    <h2 class="rx-sec-title">
                        <?php echo $data['page_name_without_break']; ?>
                    </h2>
                    <p>
                        <?php echo $data['main_content']; ?>
                    </p>
                    <div class="button-group mt-3 mt-lg-4">
                        <a href="#" class="btn btn-solid btn-md rounded rx-btn rx-btn--red" data-magnetic>Know More <i class="fa-solid fa-arrow-right"></i></a>
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

<!-- CTA Section -->
<section class="cta-section rx-svc-cta">
    <div class="cta-bg-img" data-rx="zoom">
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

<!-- Emergency Section -->
<section class="emergency-section rx-svc-faq rx-sec-py">
    <div class="container">
        <div class="row">
            <div class="col-lg-6">
                <div class="section-header">
                    <p class="rx-kicker" data-rx>Good to know</p>
                    <h2 class="rx-sec-title text-capitalize" data-rx style="--rx-d:.08s">
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
<!--/Emergency Section -->

<!-- Featured Section -->
<section class="featured-section rx-svc-gallery rx-sec-py">
    <div class="container">
        <div class="row">
            <div class="col-lg-4">
                <div class="card rx-g-card" data-rx="zoom">
                    <div class="img-box">
                        <img src="<?php echo SITE_URL . $data['footer_image_1']; ?>" class="img-fluid" alt="">
                    </div>
                </div>
                <!--/card -->
            </div>
            <div class="col-lg-4">
                <div class="card rx-g-card" data-rx="zoom" style="--rx-d:.12s">
                    <div class="img-box">
                        <img src="<?php echo SITE_URL . $data['footer_image_2']; ?>" class="img-fluid" alt="">
                    </div>
                </div>
                <!--/card -->
            </div>
            <div class="col-lg-4">
                <div class="card rx-g-card" data-rx="zoom" style="--rx-d:.24s">
                    <div class="img-box">
                        <img src="<?php echo SITE_URL . $data['footer_image_3']; ?>" class="img-fluid" alt="">
                    </div>
                </div>
                <!--/card -->
            </div>
        </div>
    </div>
</section>

<script>
    // Set content for text-to-speech
    var content = $("#voice_text").text();
</script>

<?php
// Include footer
include __DIR__ . '/includes/footer.php';
?>