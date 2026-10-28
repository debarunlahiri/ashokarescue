<?php if (defined('AI_CONCIERGE_ENABLED') && AI_CONCIERGE_ENABLED): ?>
    <?php $isAiHomepage = realpath($_SERVER['SCRIPT_FILENAME'] ?? '') === realpath(dirname(__DIR__) . '/index.php'); ?>
    <aside class="ai-concierge" data-ai-concierge data-endpoint="<?php echo SITE_URL; ?>/api/ai-concierge.php"<?php echo $isAiHomepage ? ' data-auto-open="true"' : ''; ?>>
        <button class="ai-concierge__launcher" type="button" aria-expanded="false" aria-controls="ai-concierge-panel" aria-label="Open Ashoka AI transfer assistant">
            <i class="fa-solid fa-comment-dots" aria-hidden="true"></i>
            <span>Ask Ashoka AI</span>
        </button>

        <section class="ai-concierge__panel" id="ai-concierge-panel" aria-label="Ashoka Rescue transfer assistant" hidden>
            <header class="ai-concierge__header">
                <div>
                    <span class="ai-concierge__eyebrow">Ashoka Rescue assistant</span>
                    <h2>How can we help?</h2>
                </div>
                <div class="ai-concierge__header-actions">
                    <button class="ai-concierge__restart" type="button" aria-label="Restart conversation" title="Restart conversation">
                        <i class="fa-solid fa-rotate-right" aria-hidden="true"></i>
                    </button>
                    <button class="ai-concierge__close" type="button" aria-label="Close assistant">
                        <i class="fa-solid fa-xmark" aria-hidden="true"></i>
                    </button>
                </div>
            </header>

            <div class="ai-concierge__notice">
                For an immediate medical emergency, contact local emergency services first.
            </div>

            <a class="ai-concierge__call" href="tel:<?php echo htmlspecialchars(str_replace(' ', '', EMERGENCY_PHONE), ENT_QUOTES); ?>">
                <i class="fa-solid fa-phone" aria-hidden="true"></i>
                <span><strong>24/7 medical assistance</strong><small><?php echo htmlspecialchars(EMERGENCY_PHONE); ?></small></span>
                <i class="fa-solid fa-arrow-up-right-from-square" aria-hidden="true"></i>
            </a>

            <div class="ai-flow-progress" hidden>
                <div><span>Transfer request</span><strong>Step <b>1</b> of 8</strong></div>
                <div class="ai-flow-progress__track"><span></span></div>
            </div>

            <div class="ai-concierge__messages" role="log" aria-live="polite" aria-relevant="additions">
                <div class="ai-message ai-message--assistant" style="display:block; min-height:0; padding:11px 13px; text-align:left !important; justify-content:flex-start !important; align-items:flex-start !important;">
                    <span class="ai-message__text">Hi, I’m Ashoka AI. I can explain our services, guide a transfer request, or take you to the right page.</span>
                </div>
                <div class="ai-suggested-replies" aria-label="Suggested replies">
                    <span>Suggested replies</span>
                    <div>
                        <button type="button" data-prompt="Tell me about your medical transport services">Show me services</button>
                        <button type="button" data-start-transfer>I need a transfer</button>
                        <button type="button" data-prompt="Compare your medical transport options">Compare options</button>
                        <button type="button" data-prompt="How does Ashoka Rescue arrange a patient transfer?">How it works</button>
                        <button type="button" data-prompt="How is the price of a patient transfer calculated?">What does it cost?</button>
                    </div>
                </div>
            </div>

            <form class="ai-concierge__chat-form">
                <label class="visually-hidden" for="ai-concierge-message">Message</label>
                <textarea id="ai-concierge-message" name="message" rows="1" maxlength="1000" placeholder="Type your question…" required></textarea>
                <button type="submit" aria-label="Send message">
                    <i class="fa-solid fa-paper-plane" aria-hidden="true"></i>
                </button>
            </form>

            <form class="ai-concierge__enquiry" hidden>
                <div class="ai-concierge__enquiry-heading">
                    <button type="button" data-hide-enquiry aria-label="Back to conversation"><i class="fa-solid fa-arrow-left" aria-hidden="true"></i></button>
                    <div><strong>Request a callback</strong><span>Share the essentials. Our team will confirm the next step.</span></div>
                </div>
                <div class="ai-concierge__field-row">
                    <label>From<input name="origin" maxlength="120" required autocomplete="address-level2"></label>
                    <label>To<input name="destination" maxlength="120" required autocomplete="address-level2"></label>
                </div>
                <label>Preferred date or urgency<input name="travel_date" maxlength="80" placeholder="For example: today or 24 September"></label>
                <label>Transport preference
                    <select name="service">
                        <option value="Not sure">Not sure — please advise</option>
                        <option>Charter air ambulance</option>
                        <option>Commercial stretcher</option>
                        <option>Business-class assistance</option>
                        <option>Medical escort</option>
                        <option>Road ambulance</option>
                        <option>Train ambulance</option>
                    </select>
                </label>
                <label>Mobility or support needs<textarea name="patient_needs" rows="2" maxlength="600" placeholder="Only details needed to plan the transfer"></textarea></label>
                <div class="ai-concierge__field-row">
                    <label>Your name<input name="name" maxlength="100" required autocomplete="name"></label>
                    <label>Phone<input name="phone" maxlength="20" required autocomplete="tel" inputmode="tel"></label>
                </div>
                <label>Email (optional)<input name="email" type="email" maxlength="150" autocomplete="email"></label>
                <label class="ai-concierge__consent"><input name="consent" type="checkbox" value="1" required><span>I agree to be contacted about this enquiry.</span></label>
                <button class="ai-concierge__submit" type="submit">Send enquiry <i class="fa-solid fa-arrow-right" aria-hidden="true"></i></button>
                <p class="ai-concierge__privacy">Please do not share medical records, identity documents, or payment details here.</p>
            </form>
        </section>
    </aside>
<?php endif; ?>
