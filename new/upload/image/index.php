<?php
/**
 * Home Page - Ashoka Rescue Air Ambulance Services
 */

// Page-specific variables
$pageTitle = 'Ashoka Rescue | Premier Medical Transport Services';
$pageDescription = 'Trusted 24/7 medical transport services including air ambulance, commercial stretcher, and road ambulance. Safe, reliable patient transfers domestically and internationally.';
$pageKeywords = 'Medical, Ambulance Services, Medical Transport Services, Air Ambulance Service, Road Ambulance Service';

// Schema markup for home page
$schemaMarkup = <<<SCHEMA
<!-- Organization Schema -->
<script type="application/ld+json">
{
  "@context": "https://schema.org",
  "@type": "Organization",
  "name": "Ashoka Rescue Air Ambulance Services Pvt Ltd",
  "alternateName": "Ashoka Rescue",
  "url": "https://ashokarescue.com",
  "logo": "https://ashokarescue.com/ui/images/logo.png",
  "contactPoint": {
    "@type": "ContactPoint",
    "telephone": "+91 9810 36 4143",
    "contactType": "customer service",
    "areaServed": "IN",
    "availableLanguage": "en"
  },
  "sameAs": [
    "https://www.facebook.com/ashokarescue",
    "https://www.instagram.com/ashoka_rescue/",
    "https://www.linkedin.com/company/ashoka-rescue/"
  ]
}
</script>

<!-- LocalBusiness Schema -->
<script type="application/ld+json">
{
  "@context": "https://schema.org",
  "@type": "LocalBusiness",
  "name": "Ashoka Rescue Air Ambulance Services Pvt. Ltd.",
  "image": "https://ashokarescue.com/ui/images/hero-bg.jpg",
  "@id": "https://ashokarescue.com/ui/images/hero-bg.jpg",
  "url": "https://ashokarescue.com/",
  "telephone": "+91 9810 36 4143",
  "address": {
    "@type": "PostalAddress",
    "streetAddress": "UG 124, Ansal Palam Corporate Plaza, Palam Vihar",
    "addressLocality": "Gurgaon",
    "postalCode": "122017",
    "addressCountry": "IN"
  },
  "geo": {
    "@type": "GeoCoordinates",
    "latitude": 28.5146969,
    "longitude": 77.0348848
  },
  "openingHoursSpecification": {
    "@type": "OpeningHoursSpecification",
    "dayOfWeek": [
      "Monday",
      "Tuesday",
      "Wednesday",
      "Thursday",
      "Friday",
      "Saturday",
      "Sunday"
    ],
    "opens": "00:00",
    "closes": "23:59"
  },
  "sameAs": [
    "https://www.facebook.com/ashokarescue",
    "https://www.instagram.com/ashoka_rescue/",
    "https://www.linkedin.com/company/ashoka-rescue/"
  ]
}
</script>

<!-- Aggregate Rating Schema -->
<script type='application/ld+json'>
{
    "@context": "http://schema.org",
    "@type": "Product",
    "name": "Ashoka Rescue Air Ambulance Services Pvt. Ltd.",
    "aggregateRating": {
        "@type": "AggregateRating",
        "ratingValue": "4.8",
        "ratingCount": "16",
        "reviewCount": "16"
    }
}
</script>

<!-- FAQ Schema for Homepage -->
<script type="application/ld+json">
{
  "@context": "https://schema.org",
  "@type": "FAQPage",
  "mainEntity": [
    {
      "@type": "Question",
      "name": "What is the cost of premier medical transport services in India?",
      "acceptedAnswer": {
        "@type": "Answer",
        "text": "The cost of premier medical transport services in India depends on factors such as distance, mode of transport, patient condition, medical equipment required, and level of medical supervision. Pricing is customized to ensure safe and timely patient transfer based on specific medical needs."
      }
    },
    {
      "@type": "Question",
      "name": "What do premier medical transport services do?",
      "acceptedAnswer": {
        "@type": "Answer",
        "text": "Premier medical transport services provide safe, medically supervised patient transfers for emergencies and planned relocations. These services include advanced ambulances, air ambulances, and critical care transport with trained medical professionals ensuring continuous care during transit."
      }
    },
    {
      "@type": "Question",
      "name": "How do I contact premier medical transport services?",
      "acceptedAnswer": {
        "@type": "Answer",
        "text": "Premier medical transport services can be contacted through their official website, emergency helpline numbers, or online inquiry forms. Most providers offer 24/7 support to assess patient requirements and arrange transportation promptly."
      }
    },
    {
      "@type": "Question",
      "name": "What are the types of premier medical transport services?",
      "acceptedAnswer": {
        "@type": "Answer",
        "text": "Premier medical transport services include road ambulances (basic, advanced, and ICU ambulances), air ambulances using fixed-wing aircraft, helicopter medical services, and train ambulance services. Each option is designed to meet specific medical conditions, distances, and urgency levels."
      }
    },
    {
      "@type": "Question",
      "name": "Which mode of medical transport services is most affordable?",
      "acceptedAnswer": {
        "@type": "Answer",
        "text": "Road ambulance services are generally the most affordable option for medical transport, especially for short to moderate distances. However, the most appropriate mode depends on the patient's medical condition, urgency, and required level of care."
      }
    }
  ]
}
</script>
SCHEMA;

// Include header (this loads functions.php)
include __DIR__ . '/includes/header.php';

// Get data from database (after functions are loaded)
$list = getServices(5); // Get first 5 services for home page
$ourStories = getOurStories();
$testimonials = getTestimonials();
?>

<!-- Hero Section -->
<section class="hero-section">
    <div class="hero-bg">
        <img src="<?php echo IMG_PATH; ?>front_page_image.jpg" class="img-fluid" alt="Ashoka Rescue Air Ambulance"
            width="1920" height="1080" fetchpriority="high">
    </div>
    <div class="hero-content" style="padding-left: 2rem;">
        <div class="container-fluid">
            <h1 class="hero-title" data-aos="fade-down" data-aos-duration="1500">Welcome to Ashoka Rescue</h1>
            <h3 style="color:#fff;" class="mt-0" data-aos="fade-right" data-aos-duration="1500">Air Ambulance Services
            </h3>
            <p data-aos="fade-right" data-aos-duration="1500">Your trusted partner for medical transportation services
                anywhere anytime. Whether you require medical evacuation, transportation assistance, or an air
                ambulance, we have you covered.</p>
            <a href="<?php echo SITE_URL; ?>/contact" class="btn btn-white btn-md rounded text-uppercase"
                data-aos="fade-up" data-aos-duration="1500">Contact Us</a>
        </div>
    </div>
</section>
<!--/Hero Section -->

<!-- Service Section -->
<section class="service-section sec-py">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-8">
                <div class="section-header text-center">
                    <h2 class="section-title">Services We Offer</h2>
                    <p>At Ashoka Rescue, your safety and health are our top concerns. We strive to deliver the highest
                        standard of medical care throughout your journey.</p>
                </div>
            </div>
        </div>
        <div class="service-carousel">
            <div class="swiper serviceSwiper swiper-h">
                <div class="swiper-wrapper">
                    <?php foreach ($list as $item): ?>
                        <div class="swiper-slide">
                            <div class="card" data-aos="fade-down" data-aos-duration="3000">
                                <div class="img-box-wrap">
                                    <div class="swiper innerSwiper swiper-h">
                                        <div class="swiper-wrapper">
                                            <div class="swiper-slide">
                                                <div class="img-box">
                                                    <img src="<?php echo SITE_URL . $item['banner']; ?>" class="img-fluid"
                                                        alt="<?php echo htmlspecialchars($item['title']); ?>" loading="lazy"
                                                        width="800" height="600">
                                                </div>
                                            </div>
                                            <?php
                                            for ($i = 2; $i <= 5; $i++):
                                                $imgKey = 'img' . $i;
                                                if (!empty($item[$imgKey])):
                                                    ?>
                                                    <div class="swiper-slide">
                                                        <div class="img-box">
                                                            <img src="<?php echo SITE_URL . $item[$imgKey]; ?>" class="img-fluid"
                                                                alt="<?php echo htmlspecialchars($item['title']); ?>" loading="lazy"
                                                                width="800" height="600">
                                                        </div>
                                                    </div>
                                                    <?php
                                                endif;
                                            endfor;
                                            ?>
                                        </div>
                                    </div>
                                </div>
                                <div class="card-body">
                                    <h3 class="title">
                                        <?php echo htmlspecialchars($item['title']); ?>
                                    </h3>
                                    <p>
                                        <?php echo $item['content']; ?>
                                    </p>
                                </div>
                                <div class="card-footer">
                                    <a href="<?php echo getServiceURL($item['slug']); ?>"
                                        class="btn btn-solid btn-fluid">Read More Details</a>
                                </div>
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>
                <div class="swiper-button-next"></div>
                <div class="swiper-button-prev"></div>
                <div class="swiper-pagination"></div>
            </div>
        </div>
    </div>
</section>
<!--/Service Section -->

<!-- Why Choose Us Section -->
<section class="wh-us-section">
    <div class="container-fluid px-0">
        <div class="row gx-0">
            <div class="col-lg-6">
                <div class="wh-img" data-aos="fade-right" data-aos-duration="2000">
                    <img src="<?php echo IMG_PATH; ?>wh-choose-us.jpg" class="img-fluid" alt="">
                </div>
            </div>
            <div class="col-lg-6">
                <div class="wh-content" data-aos="fade-left" data-aos-duration="2000">
                    <h2 class="section-title text-uppercase">Why choose us?</h2>
                    <span class="sub-title">"We accept, what we can" <br> "What we can, we assure that"</span>
                    <p>Established in 2004, Ashoka Rescue Air Ambulance Services Pvt Ltd offers worldclass medical
                        transportation, through road and air ambulances in India and across the globe. Our comprehensive
                        services include expert air medical evacuation, commercial medical stretchers, medical transport
                        assistance, and medical tourism patient treatment in India and abroad, ensuring effective and
                        timely delivery through proper medical transport assistance.</p>
                    <ul>
                        <li>
                            <span class="icon"><img src="<?php echo IMG_PATH; ?>icons/star.svg" class="img-fluid"
                                    alt=""></span>
                            Most Reputed company
                        </li>
                        <li>
                            <span class="icon"><img src="<?php echo IMG_PATH; ?>icons/doc-md.svg" class="img-fluid"
                                    alt=""></span>
                            Consult the Treating Doctor & family
                        </li>
                        <li>
                            <span class="icon"><img src="<?php echo IMG_PATH; ?>icons/medical-care.svg"
                                    class="img-fluid" alt=""></span>
                            Best Medical Care
                        </li>
                        <li>
                            <span class="icon"><img src="<?php echo IMG_PATH; ?>icons/experience.svg" class="img-fluid"
                                    alt=""></span>
                            20 + Years Industry Experience
                        </li>
                    </ul>
                    <a href="<?php echo SITE_URL; ?>/about" class="btn btn-solid rounded">Know More</a>
                </div>
            </div>
        </div>
    </div>
</section>
<!--/Why Choose Us Section -->

<!-- Our Service/Story Section -->
<section class="story-section sec-py">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-8">
                <div class="section-header text-center">
                    <h2 class="section-title" data-aos="fade-down" data-aos-duration="1500">Our Service</h2>
                    <p data-aos="fade-down" data-aos-duration="2500">At Ashoka Rescue, we specialize in providing
                        comprehensive assistance to patients both commercially and through charter services, ensuring
                        their comfort, safety, and well-being throughout the entire journey.</p>
                </div>
            </div>
        </div>
        <div class="story-carousel">
            <div class="swiper storySwiper">
                <div class="swiper-wrapper">
                    <?php foreach ($ourStories as $story): ?>
                        <div class="swiper-slide">
                            <div class="row">
                                <div class="col-lg-5 order-last order-lg-first">
                                    <div class="story-content" data-aos="fade-right" data-aos-duration="2000">
                                        <h2 class="section-title">
                                            <?php echo htmlspecialchars($story['title']); ?>
                                        </h2>
                                        <?php echo $story['content']; ?>
                                    </div>
                                </div>
                                <div class="col-lg-7 order-first order-lg-last">
                                    <div class="story-img-container">
                                        <div class="row align-items-center">
                                            <div class="col-lg-6">
                                                <div class="story-img first-col-img" data-aos="fade-down"
                                                    data-aos-duration="1000">
                                                    <img src="<?php echo SITE_URL . $story['img1']; ?>" class="img-fluid"
                                                        alt="">
                                                </div>
                                                <div class="story-img first-col-img" data-aos="fade-down"
                                                    data-aos-duration="3000">
                                                    <img src="<?php echo SITE_URL . $story['img2']; ?>" class="img-fluid"
                                                        alt="" style="height: 160px">
                                                </div>
                                            </div>
                                            <div class="col-lg-6">
                                                <div class="story-img second-col-img" data-aos="fade-down"
                                                    data-aos-duration="2500">
                                                    <img src="<?php echo SITE_URL . $story['img3']; ?>" class="img-fluid"
                                                        alt="">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <!--/story-img-container -->
                                </div>
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>
                <div class="swiper-button-next"></div>
                <div class="swiper-button-prev"></div>
            </div>
        </div>
    </div>
</section>
<!--/Story Section -->

<!-- How It Works Section -->
<section class="hw-section sec-py">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-8">
                <div class="section-header text-center" data-aos="fade-down" data-aos-duration="2000">
                    <h2 class="section-title">How It Works</h2>
                </div>
            </div>
        </div>
        <div class="tab-container">
            <div class="row align-items-start">
                <div class="col-lg-6">
                    <ul class="nav flex-column d-none d-lg-flex" id="v-pills-tab" role="tablist"
                        aria-orientation="vertical">
                        <li class="nav-item" role="presentation" data-aos="fade-down" data-aos-duration="500">
                            <button class="nav-link active" id="tab-1" aria-selected="true">Call Our Expert</button>
                        </li>
                        <li class="nav-item" role="presentation" data-aos="fade-down" data-aos-duration="800">
                            <button class="nav-link" id="tab-2" aria-selected="false">Send Your Report</button>
                        </li>
                        <li class="nav-item" role="presentation" data-aos="fade-down" data-aos-duration="1000">
                            <button class="nav-link" id="tab-3" data-bs-toggle="tab" data-bs-target="#tab-pane-3"
                                aria-selected="false">Consult with Doctor & Treating Doctor</button>
                        </li>
                        <li class="nav-item" role="presentation" data-aos="fade-down" data-aos-duration="1200">
                            <button class="nav-link" id="tab-4" aria-selected="false">Make a conference with
                                Doctor</button>
                        </li>
                        <li class="nav-item" role="presentation" data-aos="fade-down" data-aos-duration="1500">
                            <button class="nav-link" id="tab-5" aria-selected="false">Medical Clearance & Requirement
                                Discussion</button>
                        </li>
                        <li class="nav-item" role="presentation" data-aos="fade-down" data-aos-duration="1800">
                            <button class="nav-link" id="tab-6" aria-selected="false">Ask Our Team About Your
                                Requirement</button>
                        </li>
                        <li class="nav-item" role="presentation" data-aos="fade-down" data-aos-duration="2000">
                            <button class="nav-link" id="tab-7" aria-selected="false">Quote</button>
                        </li>
                    </ul>
                </div>

                <div class="col-lg-6">
                    <div class="tab-content accordion" id="myTabContent">
                        <div class="tab-pane fade show active accordion-item" id="tab-pane-1" role="tabpanel"
                            aria-labelledby="tab-1" tabindex="0">
                            <h2 class="accordion-header d-lg-none" id="heading_1">
                                <button class="accordion-button" type="button" data-bs-toggle="collapse"
                                    data-bs-target="#collapse_1" aria-expanded="true" aria-controls="collapse_1">Call
                                    Our Expert</button>
                            </h2>
                            <div id="collapse_1" class="accordion-collapse collapse show  d-lg-block"
                                aria-labelledby="heading_1" data-bs-parent="#myTabContent">
                                <div class="accordion-body">
                                    <div class="img-box" data-aos="zoom-in-down" data-aos-duration="2000">
                                        <img src="<?php echo IMG_PATH; ?>hw-works.jpg" class="img-fluid" alt="">
                                    </div>
                                    <div data-aos="zoom-in-up" data-aos-duration="1000">
                                        <h3 class="title">Call our Experts who have years of experience in medical
                                            escort services</h3>
                                        <p>Ashoka Rescue medical escorts have vast network made up of different medical
                                            professionals including doctors from across the globe. They can make
                                            provisions with best escorting doctors, nurses and paramedics. Our Process
                                            is simple & quick</p>
                                        <a href="<?php echo SITE_URL; ?>/contact" class="btn btn-solid btn-md rounded"
                                            data-aos="zoom-in" data-aos-duration="2000">Contact Us</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!--/accordion-item -->

                        <!-- Other accordion items (2-7) would follow the same pattern -->
                        <div class="tab-pane fade accordion-item" id="tab-pane-2" role="tabpanel"
                            aria-labelledby="tab-2" tabindex="0">
                            <h2 class="accordion-header d-lg-none" id="heading_2">
                                <button class="accordion-button collapsed">Send Your Report</button>
                            </h2>
                        </div>
                        <div class="tab-pane fade accordion-item" id="tab-pane-3" role="tabpanel"
                            aria-labelledby="tab-3" tabindex="0">
                            <h2 class="accordion-header d-lg-none" id="heading_3">
                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                                    data-bs-target="#collapse_3" aria-expanded="false"
                                    aria-controls="collapse_3">Consult with Doctor & Treating Doctor</button>
                            </h2>
                        </div>
                        <div class="tab-pane fade accordion-item" id="tab-pane-4" role="tabpanel"
                            aria-labelledby="tab-4" tabindex="0">
                            <h2 class="accordion-header d-lg-none" id="heading_4">
                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                                    data-bs-target="#collapse_4" aria-expanded="false" aria-controls="collapse_4">Make a
                                    conference with Doctor</button>
                            </h2>
                        </div>
                        <div class="tab-pane fade accordion-item" id="tab-pane-5" role="tabpanel"
                            aria-labelledby="tab-5" tabindex="0">
                            <h2 class="accordion-header d-lg-none" id="heading_5">
                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                                    data-bs-target="#collapse_5" aria-expanded="false"
                                    aria-controls="collapse_5">Medical Clearance & Requirement Discussion</button>
                            </h2>
                        </div>
                        <div class="tab-pane fade accordion-item" id="tab-pane-6" role="tabpanel"
                            aria-labelledby="tab-6" tabindex="0">
                            <h2 class="accordion-header d-lg-none" id="heading_6">
                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                                    data-bs-target="#collapse_6" aria-expanded="false" aria-controls="collapse_6">Ask
                                    Our Team About Your Requirement</button>
                            </h2>
                        </div>
                        <div class="tab-pane fade accordion-item" id="tab-pane-7" role="tabpanel"
                            aria-labelledby="tab-7" tabindex="0">
                            <h2 class="accordion-header d-lg-none" id="heading_7">
                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                                    data-bs-target="#collapse_7" aria-expanded="false"
                                    aria-controls="collapse_7">Quote</button>
                            </h2>
                        </div>
                    </div>
                    <!--/tab-content -->
                </div>
            </div>
        </div>
        <!--/tab-container -->
    </div>
</section>
<!--/How It Works Section -->

<!-- Testimonials Section -->
<section class="testimonial-section sec-py">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-8">
                <div class="section-header text-center">
                    <h2 class="section-title">Testimonials</h2>
                    <p>Few Customers Who Trust Us And Our Services</p>
                </div>
            </div>
        </div>
        <div class="testimonial-carousel">
            <div class="swiper testimonialSwiper">
                <div class="swiper-wrapper">
                    <?php foreach ($testimonials as $testimonial): ?>
                        <div class="swiper-slide">
                            <div class="card">
                                <div class="star-rating">
                                    <?php for ($i = 0; $i < $testimonial['rating']; $i++): ?>
                                        <i class="fa-solid fa-star"></i>
                                    <?php endfor; ?>
                                </div>
                                <h3>
                                    <?php echo htmlspecialchars($testimonial['content']); ?>
                                </h3>
                                <div class="client-info">
                                    <h4 class="client-name">
                                        <?php echo htmlspecialchars($testimonial['author']); ?>
                                    </h4>
                                    <span class="client-position">
                                        <?php echo htmlspecialchars($testimonial['designtion']); ?>
                                    </span>
                                </div>
                            </div>
                            <!--/card -->
                        </div>
                    <?php endforeach; ?>
                </div>
                <div class="swiper-button-next"></div>
                <div class="swiper-button-prev"></div>
                <div class="swiper-pagination"></div>
            </div>
        </div>
        <!--/Testimonial-carousel -->
    </div>
</section>
<!--/Testimonial Section -->

<script>
    // Set content for text-to-speech
    var content = $("#voice_text").text();
</script>

<?php
// Include footer
include __DIR__ . '/includes/footer.php';
?>