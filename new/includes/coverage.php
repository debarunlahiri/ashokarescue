<section class="coverage-section" aria-labelledby="coverage-title">
    <div class="container coverage-layout">
        <div class="coverage-copy">
            <p class="flight-eyebrow">CONNECTED CARE</p>
            <h2 id="coverage-title">Across cities.<br><em>Beyond borders.</em></h2>
            <p>Medical transportation across India and worldwide, with aircraft, medical escorts, clearances and receiving facilities coordinated around the patient.</p>
            <div class="coverage-options" role="group" aria-label="Explore medical transport coverage">
                <button type="button" class="active" data-coverage="domestic" aria-pressed="true">Within India</button>
                <button type="button" data-coverage="international" aria-pressed="false">International</button>
            </div>
            <p id="coverage-description" class="coverage-description" aria-live="polite">Explore air ambulance, road and train ambulance transfers within India. The coordination team will discuss the route and medical arrangements with you.</p>
            <a class="flight-text-link" href="<?php echo SITE_URL; ?>/contact">Discuss your route <i class="fa-solid fa-arrow-right" aria-hidden="true"></i></a>
        </div>
        <div class="coverage-map" data-route="domestic">
            <div class="domestic-connections geographic-map-view">
                <img src="<?php echo IMG_PATH; ?>coverage-india.svg?v=<?php echo assetVersion('assets/images/coverage-india.svg'); ?>"
                    width="800" height="440" loading="lazy"
                    alt="Geographic map of India showing illustrative connections between Delhi, Mumbai, Chennai and Kolkata">
            </div>
            <div class="international-connections geographic-map-view">
                <img src="<?php echo IMG_PATH; ?>coverage-world.svg?v=<?php echo assetVersion('assets/images/coverage-world.svg'); ?>"
                    width="800" height="440" loading="lazy"
                    alt="Geographic world map showing illustrative connections from India to Canada, France and Thailand">
            </div>
            <p><i class="fa-solid fa-globe" aria-hidden="true"></i> Illustrative connections · Routes subject to coordination</p>
            <a class="coverage-map-source" href="https://www.naturalearthdata.com/" target="_blank" rel="noopener">Map data: Natural Earth</a>
        </div>
    </div>
</section>
