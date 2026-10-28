# Ashoka Rescue redesign

This is the independent `/new` copy of the existing PHP site. Existing parent files were not modified. The copied public content, service pages, admin area, uploads and backend field contracts are retained.

## Local website

Open `http://localhost:8080/ashokarescue/new/` on the existing Apache server. Do not run a Node development server; this is a server-rendered PHP application.

Requirements: PHP 8.2+, mysqli, mbstring, Apache mod_rewrite, and the existing MySQL schema. The database must contain the existing service/content tables and `contact_quotes`. The original schema is in the parent project's `sql` folder. Configure PHP environment variables using `.env.example` as a reference; PHP does **not** automatically load that file. Never commit secrets or expose them in the web directory. `SITE_URL` explicitly sets the deployment URL; otherwise it is derived from the document root. `BLOG_URL` preserves the existing externally hosted WordPress blog.

## Assets

```sh
npm ci
npm run build
```

Tailwind utilities use a `tw-` prefix and no preflight to coexist safely with inherited Bootstrap layouts. Custom design CSS is in `assets/css/experience.css`; JavaScript source is in `resources/js/experience.js`. Deploy the compiled `assets/css/tailwind.css` and `assets/js/experience.min.js`. Node and node_modules are not required on the production server.

## Enquiries

Homepage and Contact share `includes/inquiry-form.php`, posting to `api/inquiry.php`. This endpoint validates required fields, lengths, phone/email, selected service, consent, CSRF and a honeypot. A locked, shared IP bucket limits accepted-form attempts to five per hour across sessions. Configure `INQUIRY_RATE_DIR` to a private writable directory; the default is the system temporary directory. No medical files are accepted. Phone, pickup, destination, consent and the brief message are stored in the existing contact_quotes.details column. The existing protected admin contact inbox reads these records.

Success requires a completed database insert. A failure never reports acceptance. Email notifications use the existing mail helper; configure the server's native mail transport or install PHPMailer and supply SMTP_PASSWORD. Database acceptance does not prove email delivery. Legacy quote endpoints retain their original request fields for the copied landing pages; their prior contracts remain separate from the new endpoint.

## Deployment

Set the production SITE_URL and environment credentials in the hosting control panel. Serve only over HTTPS, use an HTTPS-only session cookie, restrict staff access, and back up the database. Keep Apache AllowOverride enabled so `.htaccess` clean routes and private-file restrictions apply. Test contact receipt in the staff inbox and email separately before enabling public traffic. Existing private-file restrictions deny direct access to includes, resources, docs, node_modules and environment/configuration manifests. Keep node_modules and documentation out of the upload package when possible.

Review existing business contact inconsistencies and the inherited content items listed in `docs/IMPLEMENTATION.md`. Arrange retention and authorized access for enquiry data according to the business's approved policy. No retention duration was invented by this implementation.

## Verification

See `docs/IMPLEMENTATION.md` for the audit, requirement mapping, architecture, verification results and remaining checks. No Lighthouse score or production delivery guarantee is claimed.

## Google Reviews

The homepage now requests Google Places reviews when the review section approaches the viewport. Configure `GOOGLE_PLACES_API_KEY` and `GOOGLE_PLACES_PLACE_ID` in the PHP server environment. Alternatively, add `google_places_api_key` and `google_places_place_id` to the ignored `includes/secrets.local.php` returned array. Do not put the API key in browser JavaScript or commit it. Enable Places API (New) in the key's Google Cloud project, configure its billing and server/API restrictions, and use the Place ID of the verified Ashoka Rescue listing.

The API requests Google's available relevant reviews, which are a limited selection rather than the complete business review history. Review text is fetched on demand, not stored in MySQL, files, or browser caches. Author attribution, profile links, photo, rating, relative date, Google Maps attribution and source links are displayed. Local testimonials and previously hardcoded review excerpts are no longer used by this section. Missing credentials or an API failure displays an honest unavailable message and a direct Google reviews link. No successful Google request was tested because credentials were not configured.

Official integration reference: https://developers.google.com/maps/documentation/places/web-service/place-details
Attribution and storage reference: https://developers.google.com/maps/documentation/places/web-service/policies

## Source-site chatbot and motion

The parent site's concierge is enabled in this copy: the original approved-content knowledge, service navigation, guided transfer flow, enquiry handling, CSRF and session rate limits are retained. The widget and endpoint use this installation's SITE_URL. `AI_CONCIERGE_ENABLED=false` explicitly disables it; it defaults to enabled. Set `GEMINI_API_KEY` in the PHP environment or ignored local secrets array for the optional generative branch; deterministic site-content answers and guided intake work without it.

Source reveal effects are restored, and the new sections receive matching entrance transitions. Chatbot opening/closing, messages, buttons and flow progress animate with reduced-motion support. The launcher is stacked above the emergency call control. Validation confirmed a real approved-content service response from `/new/api/ai-concierge.php`, correct `/new` action links and CSRF rejection. No test lead or external AI-provider request was submitted.
