# Audit and implementation

## Source inventory

Source: `/Users/debarunlahiri/Development/PHPProjects/ashokarescue`. Target: its initially empty `new` directory. Parent working tree contained prior edits and was left untouched.

Preserved navigation order: Home, About Us, Our Services, Contact Us, FAQs, Blog. Service dropdown data continues to come from the existing database. All 17 dedicated service detail PHP pages are copied, together with service listing, dynamic detail route, About, Contact, FAQs, privacy, terms, 404, existing landing page, admin, API helpers, imagery and uploads. Public clean slugs are preserved inside the `/new` installation. Blog remains the existing WordPress site, not an empty local replacement.

Reusable media includes the original aircraft/transfer photograph, ambulance photography, original medical team images, company logo and service icons. Existing FAQ JSON, testimonials, service descriptions, stories, addresses and social profiles are reused. Reviews come from the existing database, with the source site's existing Google review entries as an offline fallback; no aggregate rating claim was added. The hero uses the existing approved headline and service description.

## Content issues requiring business review

- The configured emergency line is +91 9810 36 4143; the original Contact content also lists +919818933004. Primary controls use the configured emergency line; original Contact content is retained.
- Original FAQ content contains specific timing and oxygen assertions. These were preserved, not newly verified clinical or operational guarantees. Business review is required before publication.
- Existing stories contain equipment, tracking and availability assertions. They remain inherited business content, not new independent verification.
- Original Google review excerpts were already present in source. Their provenance and publication consent have not been independently re-audited.
- Original configuration contained hardcoded database/mail secrets. The new configuration reads secret values from environment variables instead. The original copy was not changed.

## Design system

Midnight #081B30, aviation #123969, cyan #79DCEA, ice #F3F7F9, ink #102A40. Coral is reserved for urgent assistance. Existing Lato/Montserrat typography is retained; large headings use moderate weight and tight tracking. A 1240px container, responsive grids, restrained glass navigation, 5–10px control radii and consistent section spacing define the new visual layer. Real source photography is used rather than fabricated aircraft imagery. Hero imagery is resized and recompressed for the initial viewport.

## Requirement mapping

| Requirement | Implementation |
| --- | --- |
| PHP and source preservation | Copied PHP architecture, public pages and original backend contracts |
| Cinematic hero | Fixed emergency content over authentic aircraft/transfer photo; call and assistance links |
| Navigation | Original menu order, dropdown labels/data and destinations retained; compact responsive header |
| Service pages | Original complete pages with common aviation/medical styling; source-backed offline catalog |
| Trust and capabilities | Existing doctor-led care, company history and source medical stories retained |
| Global coverage | Keyboard-operable domestic/international selector and explicitly illustrative route visualization |
| Transfer journey | Existing interactive desktop tabs/mobile accordion and original seven-step wording |
| Testimonials | Existing reviews in a manual, keyboard/touch-scrollable carousel with previous/next buttons |
| Inquiry | Reusable PHP form, CSRF, length/type/service checks, honeypot, locked IP rate limiting, existing database inbox |
| FAQ | Existing accordion/content, homepage subset, search with live matching count |
| Blog | Existing hosted WordPress integration and verified article destinations rendered by PHP |
| Emergency access | Header/topbar, hero call link, WhatsApp and fixed assistance button |
| Accessibility | Semantic main, skip link, labels, focus styles, native disclosures, reduced-motion rules, live form feedback |
| SEO | Existing metadata/schema, canonical links, original slugs, installation-aware XML sitemap and robots endpoints |
| Analytics | New shared header removes automatic Google Analytics/Ads loads; tracking is disabled pending an approved consent workflow |
| Admin (optional P2) | Existing protected admin copied; no new CMS or database migration required |

## Architecture and changed areas

- `includes/header.php`, `includes/footer.php`: shared shell, design assets, navigation and semantic main.
- `index.php`: static-message cinematic hero, original service/story/journey content, new reusable sections.
- `includes/coverage.php`, `reviews.php`, `inquiry-form.php`, `home-faq.php`, `journal.php`: focused server-rendered components.
- `contact.php`, `faqs.php`: common secure assistance form and FAQ search.
- `assets/css/experience.css`, `resources/css/input.css`, `resources/js/experience.js`: design system, prefixed utilities and interactions.
- `api/inquiry.php`: new validated initial enquiry path, existing prepared insert and notification helper.
- `includes/config.php`, `db.php`, `session.php`, `functions.php`: environment secrets, secure HTTPS cookies, resilient content reads, full source catalog and SMTP transport correction.
- `.htaccess`: subfolder-safe redirects, hosted blog destination and private-file protection.
- `package.json`, lockfile, Tailwind config: repeatable production asset build.

## Verified

- Production CSS/JavaScript compilation passed.
- PHP lint passed across copied and added PHP files.
- HTTP 200 without visible PHP warnings/errors for homepage, About, Contact, FAQs, privacy, terms, service listing and all 17 dedicated service pages (24 routes total).
- HTTP 403 for direct requests to includes/config.php, .env.example, package.json and private documentation.
- Missing CSRF returned 403; missing required fields, invalid email, absent consent, honeypot and invalid service returned 422 with accurate rejection feedback. These checks did not send any messages or create enquiry records.
- Browser accessibility tree confirms the new hero, complete service list, original content, labelled inquiry fields and emergency controls.
- Browser interaction confirms coverage selection updates both selection state and description.
- Responsive iframe layouts at nominal 320, 375, 768 and 1440 pixels showed no horizontal document overflow. Actual content widths were 309, 364, 757 and 1429 pixels after scrollbars. Narrow mobile navigation expanded successfully. No screenshots were taken.

## Remaining deployment checks

A successful enquiry insert/email notification has not been submitted in this run, to avoid sending test messages to the business recipients. Confirm successful receipt in the staff inbox and mail transport before release. No production deployment, Lighthouse score, formal WCAG certification, or real-device touch testing is claimed. Inherited Bootstrap/jQuery/Swiper/icon/font dependencies remain; this is a PHP redesign with compatibility preserved rather than a complete dependency removal. Verify CDN availability and hosting configuration in the deployment environment.

## Geographic coverage maps

The previous schematic polygons were replaced by locally generated geographic SVGs using Natural Earth country boundaries from world-atlas. `npm run build:map` rebuilds both assets with d3-geo and topojson-client at build time; no additional browser dependencies or map API are required. The India view uses a Mercator projection fitted to India; the international view uses a Natural Earth projection. Delhi, Mumbai, Chennai, Kolkata, Toronto, Paris and Bangkok markers use geographic coordinates. Routes remain explicitly illustrative. Source: https://github.com/topojson/world-atlas and https://www.naturalearthdata.com/.
