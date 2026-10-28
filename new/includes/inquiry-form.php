<section id="assistance" class="assistance-section request-assistance" aria-labelledby="assistance-title">
    <div class="container">
        <div class="request-shell">
            <aside class="request-contact">
                <p class="request-eyebrow">REQUEST ASSISTANCE</p>
                <h2 id="assistance-title">Medical transport.<br>Personal guidance.</h2>
                <p>Share the essential travel details. Our medical transport team will help you understand the available options.</p>
                <div class="request-contact-options">
                    <a class="request-contact-phone" href="tel:<?php echo str_replace(' ', '', EMERGENCY_PHONE); ?>">
                        <i class="fa-solid fa-phone" aria-hidden="true"></i>
                        <span><small>For urgent assistance</small><strong><?php echo EMERGENCY_PHONE; ?></strong></span>
                    </a>
                    <a class="request-whatsapp" href="<?php echo WHATSAPP_LINK; ?>" target="_blank" rel="noopener">
                        <i class="fa-brands fa-whatsapp" aria-hidden="true"></i>
                        <span>Message us on WhatsApp</span>
                        <i class="fa-solid fa-arrow-up-right-from-square" aria-hidden="true"></i>
                    </a>
                </div>
                <div class="request-contact-note">
                    <i class="fa-solid fa-headset" aria-hidden="true"></i>
                    <p>Medical coordination<br><strong>Available 24 hours, every day.</strong></p>
                </div>
            </aside>
            <form class="assistance-form request-form" action="<?php echo SITE_URL; ?>/api/inquiry.php" method="post" data-inquiry>
                <input type="hidden" name="csrf_token" value="<?php echo generateCSRFToken(); ?>">
                <div class="form-trap" aria-hidden="true"><label>Leave this field empty<input name="website" tabindex="-1" autocomplete="off"></label></div>
                <div class="request-form-heading">
                    <h3>Plan a patient transfer</h3>
                    <p>Tell us about the journey and how to reach you.</p>
                </div>
                <fieldset class="request-fieldset">
                    <legend><i class="fa-solid fa-route" aria-hidden="true"></i> Journey details</legend>
                    <div class="request-fields">
                        <label>Pickup city / country<input name="pickup" maxlength="120" placeholder="Travelling from" required></label>
                        <label>Destination city / country<input name="destination" maxlength="120" placeholder="Travelling to" required></label>
                        <label class="request-field-wide">Transportation service
                            <select name="services" required>
                                <option value="">Select a service</option>
                                <?php foreach (getServiceMenu() as $service): ?>
                                    <option value="<?php echo htmlspecialchars($service['title'], ENT_QUOTES); ?>"><?php echo htmlspecialchars($service['title']); ?></option>
                                <?php endforeach; ?>
                            </select>
                        </label>
                    </div>
                </fieldset>
                <fieldset class="request-fieldset">
                    <legend><i class="fa-regular fa-user" aria-hidden="true"></i> Your contact details</legend>
                    <div class="request-fields">
                        <label>Full name<input name="name" autocomplete="name" maxlength="100" placeholder="Your name" required></label>
                        <label>Phone number<input name="phone" type="tel" autocomplete="tel" maxlength="20" placeholder="Include country code" required></label>
                        <label class="request-field-wide">Email address<input name="email" type="email" autocomplete="email" maxlength="100" placeholder="you@example.com" required></label>
                        <label class="request-field-wide">Travel requirements <small>(optional)</small><textarea name="details" rows="2" maxlength="1500" placeholder="Anything else we should know?"></textarea></label>
                    </div>
                    <p class="request-privacy-note">Please do not include medical records or detailed diagnoses.</p>
                </fieldset>
                <label class="consent-field"><input name="consent" type="checkbox" value="1" required><span>I agree to be contacted about this request and have read the <a href="<?php echo SITE_URL; ?>/privacy">privacy policy</a>.</span></label>
                <div class="request-submit-row">
                    <button class="flight-button flight-button-dark" type="submit">Send assistance request <i class="fa-solid fa-arrow-right" aria-hidden="true"></i></button>
                </div>
                <p class="inquiry-feedback" role="status" aria-live="polite"></p>
            </form>
        </div>
    </div>
</section>
