<section class="review-section" aria-labelledby="review-title" data-google-reviews
    data-reviews-endpoint="<?php echo SITE_URL; ?>/api/google-reviews.php">
    <div class="container">
        <div class="review-heading">
            <div>
                <p class="flight-eyebrow">GOOGLE REVIEWS</p>
                <h2 id="review-title">Care that stays with you.</h2>
            </div>
            <div class="review-controls" hidden>
                <button type="button" data-review-direction="-1" aria-label="Previous review"><i class="fa-solid fa-arrow-left" aria-hidden="true"></i></button>
                <button type="button" data-review-direction="1" aria-label="Next review"><i class="fa-solid fa-arrow-right" aria-hidden="true"></i></button>
            </div>
        </div>
        <p class="google-reviews-status" role="status" aria-live="polite">Loading reviews from Google…</p>
        <div class="review-track" tabindex="0" role="region" aria-label="Reviews from Google" hidden></div>
        <div class="google-reviews-footer">
            <span class="google-maps-attribution" translate="no">Google Maps</span>
            <span class="google-reviews-order" hidden>Selected by Google, ordered by relevance.</span>
            <a class="flight-text-link" data-google-reviews-link href="<?php echo htmlspecialchars(
                GOOGLE_REVIEW_URL,
                ENT_QUOTES,
            ); ?>" target="_blank" rel="noopener">Read reviews on Google <i class="fa-solid fa-arrow-up-right-from-square" aria-hidden="true"></i></a>
        </div>
        <div class="google-reviews-attributions"></div>
        <noscript><p><a href="<?php echo htmlspecialchars(
            GOOGLE_REVIEW_URL,
            ENT_QUOTES,
        ); ?>" target="_blank" rel="noopener">Read our reviews on Google.</a></p></noscript>
    </div>
</section>
