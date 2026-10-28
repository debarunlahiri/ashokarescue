<?php
/**
 * Cost of Transporting a Patient from India to Canada Page
 */

// Page-specific variables
$pageTitle = 'Cost of Transporting a Patient India to Canada';
$pageDescription = 'Know the cost of transporting a patient from India to Canada with safe medical escorts, air ambulance options, and customized medical flight packages.';
$pageKeywords = 'Cost of Transporting a Patient India to Canada';

// Include header
$additionalStyles = '<link rel="stylesheet" href="../assets/css/home-modern.css?v=20260921-cache-reset"><link rel="stylesheet" href="../assets/css/services-modern.css?v=20260921-cache-reset">';
include __DIR__ . '/../includes/header.php';

// Set page data
$data = [
    'title' => 'COST OF TRANSPORTING A PATIENT FROM INDIA TO CANADA',
    'banner' => '/upload/image/24082434153Screenshot_2.png',
    'main_content' => 'Ashoka Rescue Medical Transports Air Ambulance Medical Escorts India facilitates medical evacuation from India to Canada, the United States, Europe, African countries, the UAE, and vice versa, utilizing both air ambulances and commercial stretchers with medical escorts. We provide medical escort services from India to international destinations with a team of qualified and experienced professionals, equipped with the latest medical technology, all at an affordable cost.
    
    </p><p>
    
    Ashoka Rescue Medical Transports Air Ambulance Medical Escorts India operates globally in partnership with other medical escort companies, sharing expertise and resources. We provide medical escort services for transporting patients to destinations worldwide, including Canadian cities such as Toronto, Vancouver, Montreal, Edmonton, Calgary, and all other locations with airport facilities. For cities lacking airport infrastructure, we utilize ground ambulance services to transfer patients to the nearest international airport. We offer cost-effective solutions for patients, regardless of whether they have travel insurance.
    
    </p><h3>Patient Transport Options Between India and Various Destinations</h3><p>
    
    Ashoka Rescue Medical Transports Air Ambulance Medical Escorts India offer patient transport services between India and countries in the United States, the European Union (including France, Germany, Australia, Italy, Belgium, Greece, Hungary, Ireland, Latvia, Lithuania, Luxembourg, Malta, Netherlands, Poland, Portugal, Romania, Slovakia, Slovenia, Spain, Sweden, the Republic of Cyprus, Czech Republic, Finland, and others).
    
    </p><h3>Patient Transport Services from the United States</h3><p>
    
    Ashoka Rescue Medical Transports Air Ambulance Medical Escorts India have facilitated patient transport from numerous cities in the United States, including New York, Chicago, Los Angeles, Houston, San Francisco, San Jose, Phoenix, Dallas, Philadelphia, San Antonio, San Diego, Charlotte, Seattle, Las Vegas, Nashville, Oklahoma City, Columbus, Fort Worth, Jacksonville, Boston, Denver, Indianapolis, El Paso, Tucson, Milwaukee, Detroit, Miami, Washington, Virginia, Florida, Texas, Kansas, and more. Ashoka Rescue Medical Transports has extensive experience in transporting patients between India and neighbouring countries, as well as vice versa.',
    'mobile_no' => EMERGENCY_PHONE,
    'page_name_without_break' => 'Medical Transport from India to Canada'
];
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
                        <a href="<?php echo SITE_URL; ?>/contact" class="btn btn-solid btn-md rounded">Get a Quote</a>
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
