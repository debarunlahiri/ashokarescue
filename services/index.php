<?php
/**
 * Services Listing Page - Ashoka Rescue Air Ambulance Services
 */

// Page-specific variables
$pageTitle = 'Our Services | Ashoka Rescue Medical Transport';
$pageDescription = 'Comprehensive medical transport services including air ambulance, commercial stretcher, road ambulance, and medical tourism assistance.';
$pageKeywords = 'Medical Services, Ambulance Services, Air Ambulance, Commercial Stretcher, Medical Transport';

// Include header
// Auto cache-busting: version string follows the file modification time,
// so browsers always fetch fresh CSS after an edit (no manual version bumps).
$additionalStyles = '<link rel="stylesheet" href="../assets/css/home-modern.css?v=' . filemtime(__DIR__ . '/../assets/css/home-modern.css') . '">'
    . '<link rel="stylesheet" href="../assets/css/services-modern.css?v=' . filemtime(__DIR__ . '/../assets/css/services-modern.css') . '">';
include __DIR__ . '/../includes/header.php';

// Get all services
$list = getServices();
?>

<!-- Banner Section -->
<section class="banner-section banner-section-bg services-hero">
    <div class="banner-bg">
        <img src="<?php echo IMG_PATH; ?>about-banner.jpg" class="img-fluid" alt="">
    </div>
    <div class="container">
        <div class="banner-content">
            <span class="svc-hero-kicker">Doctor-led medical transport</span>
            <h1 class="banner-title" data-aos="fade-up" data-aos-duration="1500">Critical care,<br><span>in transit.</span></h1>
            <p data-aos="fade-up" data-aos-duration="2500">Air ambulance, commercial stretcher, road and rail transfers — every service configured around the patient's condition, route and clinical needs.</p>
        </div>
    </div>
</section>
<!--/Banner Section -->

<!-- Services Index -->
<section class="services-index sec-py">
    <div class="container">
        <div class="section-header">
            <p class="svc-kicker">Service index</p>
            <h2 class="section-title">Medical transport services</h2>
            <p>Doctor-led transfers by air, road and rail — every service configured around the patient's clinical needs.</p>
        </div>
        <div class="svc-grid">
            <?php foreach ($list as $item):
                $excerpt = trim(preg_replace('/\s+/', ' ', strip_tags((string) $item['content'])));
                if (mb_strlen($excerpt) > 150) {
                    $excerpt = mb_substr($excerpt, 0, 150) . '…';
                }
                $serviceUrl = getServiceURL($item['slug']);
                $serviceTitle = htmlspecialchars($item['title']);
            ?>
                <article class="svc-card" data-aos="fade-up" data-aos-duration="800">
                    <a class="svc-media" href="<?php echo $serviceUrl; ?>" aria-label="<?php echo $serviceTitle; ?>">
                        <img src="<?php echo SITE_URL . $item['banner']; ?>" class="img-fluid"
                            alt="<?php echo $serviceTitle; ?>" loading="lazy">
                    </a>
                    <div class="svc-body">
                        <h3 class="svc-title">
                            <a href="<?php echo $serviceUrl; ?>"><?php echo $serviceTitle; ?></a>
                        </h3>
                        <p class="svc-excerpt"><?php echo htmlspecialchars($excerpt); ?></p>
                        <a class="svc-link" href="<?php echo $serviceUrl; ?>">
                            View service brief <i class="fa-solid fa-arrow-right" aria-hidden="true"></i>
                        </a>
                    </div>
                </article>
            <?php endforeach; ?>
        </div>
    </div>
</section>
<!--/Services Index -->

<script>
    // Set content for text-to-speech
    var content = $("#voice_text").text();
</script>

<?php
// Include footer
include __DIR__ . '/../includes/footer.php';
?>
