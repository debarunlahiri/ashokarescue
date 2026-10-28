<?php

/**
 * Common Header Include
 * Used across all frontend pages
 */

require_once __DIR__ . '/session.php';
require_once __DIR__ . '/functions.php';

// Get services for menu
$menuServices = getServiceMenu();
$navigationServices = $menuServices;
$navigationSlugs = array_column($navigationServices, 'slug');
if (!in_array('air-ambulance-services-in-india', $navigationSlugs, true)) {
    $navigationServices[] = [
        'title' => 'Air Ambulance India / Medical Escort India',
        'slug' => 'air-ambulance-services-in-india',
    ];
    $navigationSlugs[] = 'air-ambulance-services-in-india';
}
$sourceServices = json_decode(file_get_contents(__DIR__ . '/service-catalog.json'), true) ?: [];
foreach ($sourceServices as $sourceService) {
    if (!in_array($sourceService['slug'], $navigationSlugs, true)) {
        $navigationServices[] = $sourceService;
        $navigationSlugs[] = $sourceService['slug'];
    }
}
$navigationIcons = [
    'commercial-stretcher-service' => 'fa-bed-pulse',
    'charter-air-ambulance-service-in-india' => 'fa-plane',
    'business-class-medical-assistance' => 'fa-chair',
    'medical-tourism-india' => 'fa-globe',
    'road-ambulance-service-in-india' => 'fa-truck-medical',
    'train-ambulance-service-in-india' => 'fa-train',
    'medical-escort-and-transport' => 'fa-user-doctor',
    'patient-transfer-on-ecmo' => 'fa-heart-pulse',
    'neonate-medical-transport-service' => 'fa-baby',
    'paediatric-medical-transport-service' => 'fa-child',
];

// Set default page title and meta if not set
if (!isset($pageTitle)) {
    $pageTitle = SITE_NAME;
}
if (!isset($pageDescription)) {
    $pageDescription = 'Trusted 24/7 medical transport services including air ambulance, commercial stretcher, and road ambulance. Safe, reliable patient transfers domestically and internationally.';
}
if (!isset($pageKeywords)) {
    $pageKeywords = 'Medical, Ambulance Services, Medical Transport Services, Air Ambulance Service, Road Ambulance Service';
}
?>
<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <meta name="google-site-verification" content="oCRSEek5ikhd4ugWzOGZ8MrSjy3Zq-MgoOk2zngFqzI" />

    <!-- SEO Meta Tags -->
    <title>
        <?php echo htmlspecialchars($pageTitle); ?>
    </title>
    <meta name="description" content="<?php echo htmlspecialchars($pageDescription); ?>">
    <meta name="keywords" content="<?php echo htmlspecialchars($pageKeywords); ?>">

    <!-- Open Graph Meta Tags -->
    <meta property="og:title" content="<?php echo htmlspecialchars($pageTitle); ?>" />
    <meta property="og:description" content="<?php echo htmlspecialchars($pageDescription); ?>">
    <meta property="og:type" content="website">
    <meta property="og:url" content="<?php echo getCurrentURL(); ?>">

    <meta name="csrf_token" content="<?php echo generateCSRFToken(); ?>" />

    <!-- Favicons -->
    <link rel="icon" type="image/png" sizes="32x32"
        href="<?php echo SITE_URL; ?>/assets/images/favicons/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="16x16"
        href="<?php echo SITE_URL; ?>/assets/images/favicons/favicon-16x16.png">
    <link rel="apple-touch-icon" sizes="180x180"
        href="<?php echo SITE_URL; ?>/assets/images/favicons/apple-touch-icon.png">
    <link rel="manifest" href="<?php echo SITE_URL; ?>/site.webmanifest">
    <meta name="theme-color" content="#ffffff">

    <!-- Resource Hints for Performance -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link rel="preconnect" href="https://cdn.jsdelivr.net">
    <link rel="preconnect" href="https://cdnjs.cloudflare.com">
    <link rel="preconnect" href="https://unpkg.com">
    <link rel="dns-prefetch" href="https://www.googletagmanager.com">

    <!-- Google Site Verification -->
    <meta name="google-site-verification" content="xXQTA-nFBodmn87FOZOsBs3olT8xRCcesvMMvGsExKQ" />

    <!-- Bootstrap CSS - Critical -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">

    <!-- Google Fonts with font-display for performance -->
    <link
        href="https://fonts.googleapis.com/css2?family=Lato:ital,wght@0,100;0,300;0,400;0,700;0,900;1,100;1,300;1,400;1,700;1,900&family=Montserrat:ital,wght@0,100..900;1,100..900&display=swap"
        rel="stylesheet" media="print" onload="this.media='all'">
    <noscript>
        <link
            href="https://fonts.googleapis.com/css2?family=Lato:ital,wght@0,100;0,300;0,400;0,700;0,900;1,100;1,300;1,400;1,700;1,900&family=Montserrat:ital,wght@0,100..900;1,100..900&display=swap"
            rel="stylesheet">
    </noscript>

    <!-- Swiper CSS - Deferred -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css" media="print"
        onload="this.media='all'" />
    <noscript>
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css" />
    </noscript>

    <!-- Font Awesome - Deferred -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css"
        integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw=="
        crossorigin="anonymous" referrerpolicy="no-referrer" media="print" onload="this.media='all'" />
    <noscript>
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css"
            integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw=="
            crossorigin="anonymous" referrerpolicy="no-referrer" />
    </noscript>

    <!-- Bootstrap Icons - Deferred -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css"
        media="print" onload="this.media='all'">
    <noscript>
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    </noscript>

    <!-- AOS Animation CSS - Deferred -->
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet" media="print" onload="this.media='all'">
    <noscript>
        <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
    </noscript>

    <!-- Custom CSS -->
    <link rel="stylesheet" href="<?php echo CSS_PATH; ?>app_v6.css?v=<?php echo assetVersion('assets/css/app_v6.css'); ?>">
    <link rel="stylesheet" href="<?php echo CSS_PATH; ?>utilities.css?v=<?php echo assetVersion('assets/css/utilities.css'); ?>">
    <link rel="stylesheet" href="<?php echo CSS_PATH; ?>responsive-seo.css?v=<?php echo assetVersion('assets/css/responsive-seo.css'); ?>">
    <link rel="stylesheet" href="<?php echo CSS_PATH; ?>ai-concierge.css?v=<?php echo assetVersion('assets/css/ai-concierge.css'); ?>">
    <link rel="stylesheet" href="<?php echo CSS_PATH; ?>footer-modern.css?v=<?php echo assetVersion('assets/css/footer-modern.css'); ?>">
    <link rel="stylesheet" href="<?php echo CSS_PATH; ?>redesign-system.css?v=<?php echo assetVersion('assets/css/redesign-system.css'); ?>">

    <script>
        var weburl = "<?php echo SITE_URL; ?>";
    </script>

    <?php if (isset($additionalStyles))
        echo $additionalStyles; ?>

    <style>
        .topbar-section {
            position: relative;
            width: 100%;
            overflow: hidden;
            padding: 0;
            color: #ffffff;
            background: #ff5722;
            border-bottom: 1px solid rgba(120, 35, 10, .16);
        }

        .topbar-section .container-fluid {
            width: 100%;
            max-width: 1180px;
            margin-inline: auto;
            padding-right: 1.5rem;
            padding-left: 1.5rem;
        }

        .topbar-section .topbar-content {
            position: relative;
            z-index: 2;
            display: flex;
            min-height: 38px;
            align-items: center;
            justify-content: space-between;
            gap: 1rem;
            color: #ffffff;
        }

        .topbar-status,
        .topbar-actions,
        .topbar-actions a {
            display: flex;
            align-items: center;
        }

        .topbar-status {
            gap: .6rem;
            font-size: .75rem;
            letter-spacing: .015em;
        }

        .topbar-status-icon {
            position: relative;
            display: block;
            width: 24px;
            height: 24px;
            flex: 0 0 24px;
            place-items: center;
            border-radius: 50%;
            color: #ffffff;
            background: rgba(111, 29, 5, .2);
            font-size: .68rem;
            overflow: hidden;
        }

        .topbar-status-icon i {
            position: absolute;
            inset: 0;
            display: grid;
            place-items: center;
            opacity: 0;
            transform: translateY(100%);
            animation: topbar-icon-cycle 15s ease-in-out infinite;
        }

        .topbar-status-icon i:nth-child(2) {
            animation-delay: -10s;
        }

        .topbar-status-icon i:nth-child(3) {
            animation-delay: -5s;
        }

        @keyframes topbar-icon-cycle {
            0%, 28% { opacity: 1; transform: translateY(0); }
            33%, 94% { opacity: 0; transform: translateY(-100%); }
            95% { opacity: 0; transform: translateY(100%); }
            100% { opacity: 1; transform: translateY(0); }
        }

        .topbar-status strong {
            color: #ffffff;
            font-weight: 800;
        }

        .topbar-status-divider {
            width: 1px;
            height: 16px;
            background: rgba(255, 255, 255, .35);
        }

        .topbar-status-secondary {
            color: rgba(255, 255, 255, .82);
            font-weight: 600;
        }

        .topbar-actions {
            gap: .2rem;
        }

        .topbar-actions a {
            gap: .4rem;
            min-height: 28px;
            padding: .3rem .6rem;
            border-radius: 6px;
            color: #dce6ef;
            font-size: .72rem;
            font-weight: 800;
            text-decoration: none;
        }

        .topbar-actions a:hover,
        .topbar-actions a:focus-visible {
            color: #ffffff;
            background: rgba(255, 255, 255, .07);
        }

        .topbar-actions .topbar-whatsapp {
            color: #ffffff;
            border-left: 1px solid rgba(255, 255, 255, .3);
            border-radius: 0;
        }

        .topbar-motion {
            position: absolute;
            inset: 0;
            z-index: 1;
            overflow: hidden;
            pointer-events: none;
        }

        .topbar-motion span {
            position: absolute;
            top: 50%;
            color: rgba(112, 27, 2, .2);
            font-size: 1.15rem;
            transform: translateY(-50%);
            will-change: transform;
        }

        .topbar-motion-ambulance {
            left: -50px;
            width: 58px;
            height: 29px;
            animation: topbar-drive 14s linear infinite;
        }

        .topbar-motion-plane {
            right: -50px;
            width: 66px;
            height: 30px;
            opacity: 0;
            animation: topbar-fly 18s linear 4s infinite;
        }

        .topbar-motion-ambulance img,
        .topbar-motion-plane img {
            display: block;
            width: 100%;
            height: 100%;
            object-fit: contain;
            filter: drop-shadow(0 2px 2px rgba(92, 23, 3, .22));
        }

        .topbar-motion-train {
            left: -60px;
            width: 86px;
            height: 29px;
            opacity: 0;
            animation: topbar-train 20s linear 7s infinite;
        }

        .topbar-motion-train img {
            display: block;
            width: 100%;
            height: 100%;
            object-fit: contain;
            filter: drop-shadow(0 2px 2px rgba(92, 23, 3, .22));
        }

        @keyframes topbar-drive {
            from { transform: translate(-60px, -50%); }
            to { transform: translate(calc(100vw + 110px), -50%); }
        }

        @keyframes topbar-fly {
            from { opacity: 1; transform: translate(60px, -50%); }
            to { opacity: 1; transform: translate(calc(-100vw - 110px), -50%); }
        }

        @keyframes topbar-train {
            from { opacity: 1; transform: translate(-70px, -50%); }
            to { opacity: 1; transform: translate(calc(100vw + 130px), -50%); }
        }

        @media (max-width: 767.98px) {
            .topbar-section .container-fluid {
                padding-inline: .85rem;
            }

            .topbar-section .topbar-content {
                min-height: 36px;
            }

            .topbar-status-secondary,
            .topbar-status-divider,
            .topbar-actions a span,
            .topbar-status strong span {
                display: none;
            }

            .topbar-status {
                font-size: .7rem;
            }

            .topbar-actions a {
                width: 28px;
                padding: 0;
                justify-content: center;
            }
        }

        @media (prefers-reduced-motion: reduce) {
            .topbar-motion {
                display: none;
            }

            .topbar-status-icon i {
                display: none;
                animation: none;
            }

            .topbar-status-icon i:first-child {
                display: grid;
                opacity: 1;
                transform: none;
            }
        }

        .btn-custom {
            font-size: 15px;
            padding: 5px 5px;
            position: fixed;
            transform: translateY(-50%);
            top: 50%;
            z-index: 999;
            border-radius: 0 5px 5px 0;
        }

        /* ============ Techy header (shared across all pages) ============ */

        /* Navbar: sliding underline links */
        #header .navbar-nav .nav-item .nav-link {
            position: relative;
            font-weight: 600;
            letter-spacing: .03em;
        }

        #header .navbar-nav .nav-item .nav-link::after {
            content: '';
            position: absolute;
            left: 0;
            right: 0;
            bottom: 6px;
            height: 2px;
            border-radius: 2px;
            background: #e44343;
            transform: scaleX(0);
            transform-origin: left center;
            transition: transform .28s ease;
        }

        #header .navbar-nav .nav-item:hover .nav-link::after,
        #header .navbar-nav .nav-item .nav-link.active::after {
            transform: scaleX(1);
        }

        /* Sticky navbar: topbar scrolls away, nav stays fixed on every page.
           body{overflow-x:hidden} in the base stylesheet creates a scroll
           container that breaks sticky -- overflow-x:clip clips the same way
           without breaking it. */
        body {
            overflow-x: clip;
        }

        #header {
            position: sticky;
            top: 0;
            z-index: 1030;
            background: #fff;
        }

        /* Mobile header: tidy rows, no collisions */
        @media (max-width: 991.98px) {
            #header .navbar > .container-fluid {
                flex-wrap: wrap;
            }

            #header .navbar-brand {
                order: 1;
            }

            #header .navbar-toggler {
                order: 2;
                margin-left: auto;
            }

            #header .navbar-end {
                order: 3;
                flex: 1 1 100%;
                margin: .65rem 0 0;
                padding: .55rem 1rem;
                text-align: center;
            }

            #header .navbar-end span {
                margin-bottom: .1rem;
            }

            #header .navbar-end .btn-text {
                font-size: 1rem;
            }

            #header .navbar-collapse {
                order: 4;
                flex: 1 1 100%;
            }
        }

        @media (max-width: 767.98px) {
            /* Park the animated vehicles on small screens: they drive through the text */
            .topbar-motion {
                display: none;
            }
        }
    </style>

    <?php if (isset($schemaMarkup))
        echo $schemaMarkup; ?>

    <?php
    // Include global schema markup
    include __DIR__ . '/schema.php';
    ?>
    <link rel="stylesheet" href="<?php echo CSS_PATH; ?>tech-public.css?v=<?php echo assetVersion('assets/css/tech-public.css'); ?>">
    <link rel="canonical" href="<?php echo htmlspecialchars(strtok(getCurrentURL(), '?'), ENT_QUOTES); ?>">
    <link rel="stylesheet" href="<?php echo CSS_PATH; ?>tailwind.css">
    <link rel="stylesheet" href="<?php echo CSS_PATH; ?>experience.css?v=<?php echo assetVersion('assets/css/experience.css'); ?>">
    <link rel="stylesheet" href="<?php echo CSS_PATH; ?>theme.css?v=<?php echo assetVersion('assets/css/theme.css'); ?>">
</head>

<body>
    <a class="skip-link" href="#main-content">Skip to content</a>

    <!-- WhatsApp Button -->
    <a href="<?php echo WHATSAPP_LINK; ?>" target="_blank" class="social-icon whatsapp">
        <img class="whatsapp-opne-icon" src="<?php echo IMG_PATH; ?>WhatsApp-Icon.jpg"
            style="width: 60px; border-radius: 100%; overflow: hidden; position: fixed; bottom: 25%; right: 20px; box-shadow: 0 3px 4px -2px rgba(0, 0, 0, 0.5); z-index: 999999; display: block;"
            alt="whatsapp">
    </a>

    <!-- Topbar Section -->
    <section class="topbar-section">
        <div class="topbar-motion" aria-hidden="true">
            <span class="topbar-motion-ambulance"><img src="<?php echo IMG_PATH; ?>medical-ambulance-3d.png?v=<?php echo assetVersion('assets/images/medical-ambulance-3d.png'); ?>" alt=""></span>
            <span class="topbar-motion-plane"><img src="<?php echo IMG_PATH; ?>medical-plane-3d.png?v=<?php echo assetVersion('assets/images/medical-plane-3d.png'); ?>" alt=""></span>
            <span class="topbar-motion-train"><img src="<?php echo IMG_PATH; ?>medical-train-3d.png?v=<?php echo assetVersion('assets/images/medical-train-3d.png'); ?>" alt=""></span>
        </div>
        <div class="container-fluid">
            <div class="topbar-content">
                <div class="topbar-status">
                    <span class="topbar-status-icon" aria-hidden="true">
                        <i class="fa-solid fa-plane"></i>
                        <i class="fa-solid fa-truck-medical"></i>
                        <i class="fa-solid fa-train"></i>
                    </span>
                    <strong>Medical transfer desk <span>available 24/7</span></strong>
                    <span class="topbar-status-divider" aria-hidden="true"></span>
                    <span class="topbar-status-secondary">India and worldwide</span>
                </div>
                <div class="topbar-actions" aria-label="Quick contact">
                    <a href="tel:<?php echo str_replace(' ', '', EMERGENCY_PHONE); ?>">
                        <i class="fa-solid fa-phone" aria-hidden="true"></i>
                        <span>Call <?php echo EMERGENCY_PHONE; ?></span>
                    </a>
                    <a href="<?php echo WHATSAPP_LINK; ?>" target="_blank" rel="noopener" class="topbar-whatsapp">
                        <i class="fa-brands fa-whatsapp" aria-hidden="true"></i>
                        <span>Message us</span>
                    </a>
                </div>
            </div>
        </div>
    </section>
    <!--/Topbar Section -->

    <!-- Header -->
    <header id="header" class="header">
        <nav class="navbar navbar-expand-lg">
            <div class="container-fluid">
                <a class="navbar-brand" href="<?php echo SITE_URL; ?>">
                    <img src="<?php echo IMG_PATH; ?>logo.png" class="img-fluid" alt="Ashoka Rescue">
                </a>
                <div class="navbar-end order-lg-last">
                    <span>Emergency Contact</span>
                    <a href="tel:<?php echo str_replace(' ', '', EMERGENCY_PHONE); ?>" class="btn-text">
                        <i class="bi bi-telephone me-2"></i>
                        <?php echo EMERGENCY_PHONE; ?>
                    </a>
                </div>
                <button class="navbar-toggler collapsed" type="button" data-bs-toggle="collapse"
                    data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
                    aria-expanded="false" aria-label="Toggle navigation">
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav mx-auto mb-2 mb-lg-0">
                        <li class="nav-item">
                            <a class="nav-link <?php echo isActivePage('index') ? 'active' : ''; ?>" <?php echo isActivePage('index') ? 'aria-current="page"' : ''; ?>
                                href="<?php echo SITE_URL; ?>">Home</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link <?php echo isActivePage('about') ? 'active' : ''; ?>"
                                href="<?php echo SITE_URL; ?>/about">About Us</a>
                        </li>
                        <li class="nav-item dropdown services-menu-item">
                            <a class="nav-link <?php echo (isActivePage('services') || isActivePage('service-detail')) ? 'active' : ''; ?>"
                                href="<?php echo SITE_URL; ?>/services">Our Services</a>
                            <button class="services-menu-toggle" type="button" data-bs-toggle="dropdown"
                                data-bs-display="static" aria-expanded="false" aria-controls="services-submenu"
                                aria-label="Show all medical transport services">
                                <i class="fa-solid fa-chevron-down" aria-hidden="true"></i>
                            </button>
                            <div class="dropdown-menu services-dropdown" id="services-submenu">
                                <div class="services-menu-heading">
                                    <div>
                                        <span>CARE FOR EVERY JOURNEY</span>
                                        <h2>Medical transport services</h2>
                                    </div>
                                    <a href="<?php echo SITE_URL; ?>/services">View all services <i class="fa-solid fa-arrow-right" aria-hidden="true"></i></a>
                                </div>
                                <ul class="services-menu-grid">
                                    <?php foreach ($navigationServices as $service): ?>
                                        <li>
                                            <a class="services-menu-link" href="<?php echo htmlspecialchars(getServiceURL($service['slug']), ENT_QUOTES); ?>">
                                                <span class="services-menu-icon" aria-hidden="true">
                                                    <i class="fa-solid <?php echo $navigationIcons[$service['slug']] ?? 'fa-kit-medical'; ?>"></i>
                                                </span>
                                                <span><?php echo htmlspecialchars($service['title']); ?></span>
                                                <i class="fa-solid fa-arrow-right services-menu-arrow" aria-hidden="true"></i>
                                            </a>
                                        </li>
                                    <?php endforeach; ?>
                                </ul>
                            </div>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link <?php echo isActivePage('contact') ? 'active' : ''; ?>"
                                href="<?php echo SITE_URL; ?>/contact">Contact Us</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link <?php echo isActivePage('faqs') ? 'active' : ''; ?>"
                                href="<?php echo SITE_URL; ?>/faqs">FAQs</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="<?php echo BLOG_URL; ?>">Blog</a>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>
    </header>
    <!--/Header -->

    <!-- Text-to-Speech Button -->
    <button id="toggleButton" type="button" class="read-aloud-button" onclick="toggleSpeech()" aria-label="Read page aloud" aria-pressed="false" title="Read page aloud" style="display: none">
        <i id="toggleIcon" class="fa-solid fa-volume-high" aria-hidden="true"></i>
    </button>

    <main id="voice_text"><span id="main-content" tabindex="-1"></span>
