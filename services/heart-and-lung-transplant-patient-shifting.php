<?php
/**
 * Heart and Lung Transplant Patient Shifting Service Page
 */

// Page-specific variables
$serviceId = 14;
$pageTitle = 'Heart and Lung Transplant Patient Shifting Service';
$pageDescription = 'Safe heart and lung transplant patient shifting with expert medical teams, ICU-level support, and advanced transport for critical care transfers.';
$pageKeywords = 'Heart and Lung Transplant Patient Shifting';

// Include header
$additionalStyles = '<link rel="stylesheet" href="../assets/css/home-modern.css?v=20260921-cache-reset"><link rel="stylesheet" href="../assets/css/services-modern.css?v=20260921-cache-reset">';
include __DIR__ . '/../includes/header.php';

// Get service content from database
$data = getServiceContent($serviceId);

// Set defaults if data is missing
$data = array_merge([
    'title' => 'HEART AND LUNG TRANSPLANT PATIENT SHIFTING',
    'banner' => '/upload/image/240806105837WhatsApp%20Image%202024-07-27%20at%202.05.33%20PM.jpeg',
    'main_content' => 'Ashoka Rescue Medical Transports patients globally for heart and lung transplants using air ambulances, commercial stretchers, train ambulances, and road ambulances equipped with ECMO, ventilators, BI-PAP, and oxygen in both lying and sitting positions. Ashoka Rescue specializes in transporting patients with interstitial lung disease in business class, seated positions with oxygen supplementation, providing comprehensive bedside-to-bedside assistance.
    
    </p><p>
    
    Ashoka Rescue has extensive expertise in long-distance patient transportation for lung and heart transplants, spanning domestic and international routes. This service caters particularly to critically ill individuals suffering from end-stage cardiac and respiratory failure who require urgent transport. For patients with severe left ventricular failure or end-stage cardiomyopathy, cardiac transplantation transport is considered, with ECMO being utilized to enhance oxygenation and reduce cardiac strain during transit.
    
    </p><p>
    
    Frequently asked questions by patients often center around the logistics of lung transplant transportation. Air travel poses challenges for patients with advanced lung disease due to high-altitude hypoxia. To address this, patients receive necessary oxygen supplementation during flights and are closely monitored using portable oximeters, accompanied by critical care physicians. Through meticulous preparation, adequate oxygen provision, oximetric monitoring, and medical supervision, nearly all patients with severe lung disease can safely undertake essential journeys.

    </p><p>
    
    A thorough pre-flight medical evaluation is essential to assess the suitability of pulmonary disease patients for air travel, including the determination of supplemental oxygen requirements or advisability of alternative travel arrangements. Patients with pulmonary diseases exhibiting pre-flight arterial oxygen tension below 70 mmHg or oximetry saturation below 92% necessitate supplemental oxygen during air travel.
    
    </p><p>
    
    Our medical team is proficient in managing patients with interstitial lung disease (ILD), understanding their unique vulnerabilities, sensitivities, and varying oxygen demands even under minimal exertion. Supplemental oxygen remains pivotal in the comprehensive care of hypoxemic ILD patients.
    
    </p><p>
    
    During bed-to-bed transportation, our Ashoka Rescue Medical Transports team maintains SPO2 levels above 90%. We conduct thorough evaluations of all ILD patients embarking on journeys or undergoing lung transplants.
    
    </p><p>
    
    Our team has successfully transported patients globally for heart and lung transplants using air ambulances and commercial airlines. Our overarching mission is to minimize travel expenses for patients, ensuring financial accessibility. Urgent cases requiring immediate lung or heart transplants and feasible financial means are accommodated with air ambulances, while planned transplant cases on waiting lists are encouraged to utilize cost-effective commercial airline transfers. Patients are transported in business class or on stretchers, supported with oxygen, Bi-PAP, ventilators, or ECMO as required.',
    'mobile_no' => EMERGENCY_PHONE,
    'page_name_without_break' => 'Heart and Lung Transplant Patient Shifting'
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
