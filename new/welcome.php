<?php
/**
 * Google Ads landing page for international medical transport enquiries.
 * The page is intentionally self-contained: all page-specific HTML, CSS and
 * JavaScript and form processing live in this file, while the existing secure
 * session, configuration, and database helpers are reused.
 */

// Load the existing environment/configuration, database helpers, and secure session.
// Credentials remain in the project configuration or environment and are never
// written into this public landing-page source.
require_once __DIR__ . '/includes/config.php';
require_once __DIR__ . '/includes/functions.php';
require_once __DIR__ . '/includes/session.php';

$phoneDisplay = EMERGENCY_PHONE;
$phoneLink = preg_replace('/[^0-9+]/', '', EMERGENCY_PHONE);
$csrfToken = generateCSRFToken();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    header('Content-Type: application/json; charset=UTF-8');

    $respond = static function (bool $status, string $message, array $errors = [], int $httpStatus = 200): void {
        http_response_code($httpStatus);
        echo json_encode([
            'status' => $status,
            'message' => $message,
            'errors' => $errors,
        ]);
        exit;
    };

    if (!isset($_POST['csrf_token']) || !validateCSRFToken($_POST['csrf_token'])) {
        $respond(false, 'Your secure session has expired. Please refresh the page and try again.', [], 419);
    }

    // Real visitors never fill this hidden field.
    if (!empty($_POST['website'] ?? '')) {
        $respond(true, 'Thank you. Your inquiry has been received.');
    }

    $formStartedAt = filter_var($_POST['form_started_at'] ?? null, FILTER_VALIDATE_INT);
    $elapsedSeconds = $formStartedAt ? time() - $formStartedAt : 0;
    if (!$formStartedAt || $elapsedSeconds < 3 || $elapsedSeconds > 7200) {
        $respond(false, 'Please refresh the page and complete the form again.', [], 422);
    }

    $recentSubmissions = array_values(array_filter(
        $_SESSION['landing_enquiry_submissions'] ?? [],
        static fn($timestamp) => is_int($timestamp) && $timestamp > time() - 600
    ));
    if (count($recentSubmissions) >= 3) {
        $respond(false, 'Too many inquiries were sent recently. Please call us for immediate assistance.', [], 429);
    }

    $values = [
        'name' => trim((string) ($_POST['name'] ?? '')),
        'relationship' => trim((string) ($_POST['relationship'] ?? '')),
        'phone' => trim((string) ($_POST['phone'] ?? '')),
        'email' => trim((string) ($_POST['email'] ?? '')),
        'origin' => trim((string) ($_POST['origin'] ?? '')),
        'destination' => trim((string) ($_POST['destination'] ?? '')),
        'services' => trim((string) ($_POST['services'] ?? '')),
        'travel_date' => trim((string) ($_POST['travel_date'] ?? '')),
        'case_notes' => trim((string) ($_POST['case_notes'] ?? '')),
        'consent' => (string) ($_POST['consent'] ?? ''),
    ];

    $allowedRelationships = [
        'Family member',
        'Patient',
        'Hospital or doctor',
        'Insurance or assistance company',
        'Other',
    ];
    $allowedServices = [
        'Charter Air Ambulance',
        'Commercial Stretcher',
        'Medical Escort',
        'Road Ambulance',
        'Not Sure',
    ];
    $errors = [];

    if (mb_strlen($values['name']) < 2 || mb_strlen($values['name']) > 80 || !preg_match("/^[\\p{L}][\\p{L} .'-]*$/u", $values['name'])) {
        $errors['name'] = 'Enter a valid full name using letters, spaces, apostrophes, or hyphens.';
    }
    if (!in_array($values['relationship'], $allowedRelationships, true)) {
        $errors['relationship'] = 'Select your relationship to the patient.';
    }

    $normalizedPhone = preg_replace('/[\\s().-]/', '', $values['phone']);
    if (!is_string($normalizedPhone) || !preg_match('/^\\+[1-9][0-9]{7,14}$/', $normalizedPhone)) {
        $errors['phone'] = 'Enter a valid international number beginning with + and the country code.';
    }
    if (!filter_var($values['email'], FILTER_VALIDATE_EMAIL) || mb_strlen($values['email']) > 254) {
        $errors['email'] = 'Enter a valid email address.';
    }
    if (mb_strlen($values['origin']) < 2 || mb_strlen($values['origin']) > 100) {
        $errors['origin'] = 'Enter the patient’s current city and country.';
    }
    if (mb_strlen($values['destination']) < 2 || mb_strlen($values['destination']) > 100) {
        $errors['destination'] = 'Enter the destination city and country.';
    } elseif (mb_strtolower($values['origin']) === mb_strtolower($values['destination'])) {
        $errors['destination'] = 'The destination must be different from the current location.';
    }
    if (!in_array($values['services'], $allowedServices, true)) {
        $errors['services'] = 'Select a transport service or choose “Not sure”.';
    }

    if ($values['travel_date'] !== '') {
        $travelDate = DateTimeImmutable::createFromFormat('!Y-m-d', $values['travel_date']);
        $dateIsValid = $travelDate && $travelDate->format('Y-m-d') === $values['travel_date'];
        $today = new DateTimeImmutable('today');
        if (!$dateIsValid || $travelDate < $today || $travelDate > $today->modify('+2 years')) {
            $errors['travel_date'] = 'Choose a valid date between today and two years from now.';
        }
    }
    if (mb_strlen($values['case_notes']) > 1500) {
        $errors['case_notes'] = 'Keep the patient details within 1,500 characters.';
    }
    if ($values['consent'] !== '1') {
        $errors['consent'] = 'Confirm that we may contact you about this inquiry.';
    }

    if ($errors) {
        $respond(false, 'Please correct the highlighted fields.', $errors, 422);
    }

    $details = implode("\n", [
        'Relationship to patient: ' . $values['relationship'],
        'Patient location: ' . $values['origin'],
        'Requested destination: ' . $values['destination'],
        'Preferred transfer date: ' . ($values['travel_date'] ?: 'Not specified'),
        'Patient condition / notes: ' . ($values['case_notes'] ?: 'Not provided'),
    ]);
    $query = 'INSERT INTO home_footer_quotes (name, email, phone, home_contact, services, details, created_at, updated_at)
              VALUES (?, ?, ?, ?, ?, ?, NOW(), NOW())';
    try {
        $result = executeUpdate($query, 'ssssss', [
            $values['name'],
            $values['email'],
            $normalizedPhone,
            'Google Ads',
            $values['services'],
            $details,
        ]);
    } catch (Throwable $error) {
        error_log('Landing enquiry insert failed: ' . $error->getMessage());
        $result = false;
    }

    if (!$result) {
        $respond(false, 'We could not save your inquiry. Please call us for immediate assistance.', [], 500);
    }

    $safe = static fn(string $value): string => htmlspecialchars($value, ENT_QUOTES, 'UTF-8');
    $adminEmails = array_values(array_filter(array_map('trim', explode(',', ADMIN_EMAILS))));
    $emailBody = '<h2>New Google Ads Medical Transport Inquiry</h2>'
        . '<p><strong>Name:</strong> ' . $safe($values['name']) . '</p>'
        . '<p><strong>Email:</strong> ' . $safe($values['email']) . '</p>'
        . '<p><strong>Phone:</strong> ' . $safe($normalizedPhone) . '</p>'
        . '<p><strong>Service:</strong> ' . $safe($values['services']) . '</p>'
        . '<p><strong>Case details:</strong><br>' . nl2br($safe($details)) . '</p>'
        . '<hr><p><small>Submitted through ' . $safe(COMPANY_NAME)
        . ' &middot; ' . $safe(EMERGENCY_PHONE)
        . ' &middot; ' . $safe(SITE_EMAIL) . '</small></p>';
    $requestHost = (string) ($_SERVER['HTTP_HOST'] ?? '');
    $isLocalRequest = preg_match('/^(localhost|127\.0\.0\.1)(:\d+)?$/i', $requestHost) === 1;
    $emailSent = true;
    if (!$isLocalRequest) {
        $emailSent = sendEmail($adminEmails, 'New Medical Transport Inquiry - ' . COMPANY_NAME, $emailBody);
    }

    $recentSubmissions[] = time();
    $_SESSION['landing_enquiry_submissions'] = $recentSubmissions;

    if (!$emailSent) {
        error_log('Landing enquiry saved, but the operations email notification failed for lead ID ' . $result);
        $respond(
            true,
            'Your inquiry was saved, but the email notification was delayed. Please call us if your request is urgent.'
        );
    }

    $respond(true, 'Thank you. Your inquiry has been verified and sent to our medical transport team.');
}
?>
<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="robots" content="index, follow">
    <meta name="description" content="Arrange 24/7 air ambulance, medical escort, commercial stretcher and international patient transfer services with <?php echo htmlspecialchars(COMPANY_NAME, ENT_QUOTES, 'UTF-8'); ?>.">
    <meta name="theme-color" content="#0b2f56">
    <title>International Air Ambulance & Patient Transfer | <?php echo htmlspecialchars(SITE_NAME, ENT_QUOTES, 'UTF-8'); ?></title>

    <link rel="icon" type="image/png" href="<?php echo SITE_URL; ?>/assets/images/favicons/favicon-32x32.png">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css"
        integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw=="
        crossorigin="anonymous" referrerpolicy="no-referrer">
    <script async src="https://www.googletagmanager.com/gtag/js?id=<?php echo htmlspecialchars(AW_TRACKING_ID, ENT_QUOTES, 'UTF-8'); ?>"></script>
    <script>
        window.dataLayer = window.dataLayer || [];

        function gtag() {
            dataLayer.push(arguments);
        }

        gtag('js', new Date());
        gtag('config', '<?php echo htmlspecialchars(GA_TRACKING_ID, ENT_QUOTES, 'UTF-8'); ?>');
        gtag('config', '<?php echo htmlspecialchars(AW_TRACKING_ID, ENT_QUOTES, 'UTF-8'); ?>');
    </script>

    <style>
        :root {
            --navy: #0b2f56;
            --navy-deep: #071f39;
            --blue: #1769aa;
            --orange: #f45b2a;
            --orange-dark: #d9471c;
            --mist: #f3f7fa;
            --line: #dce6ee;
            --ink: #172b3d;
            --muted: #607386;
            --white: #ffffff;
            --success: #16744a;
            --danger: #b42318;
            --shadow: 0 24px 70px rgba(5, 31, 57, .16);
        }

        *,
        *::before,
        *::after {
            box-sizing: border-box;
        }

        html {
            scroll-behavior: smooth;
        }

        body {
            margin: 0;
            color: var(--ink);
            background: var(--white);
            font-family: Inter, -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, Helvetica, Arial, sans-serif;
            font-size: 16px;
            line-height: 1.6;
            -webkit-font-smoothing: antialiased;
            text-rendering: optimizeLegibility;
        }

        body,
        body * {
            font-family: Inter, -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, Helvetica, Arial, sans-serif;
        }

        button,
        input,
        select,
        textarea {
            font: inherit;
        }

        img {
            display: block;
            max-width: 100%;
        }

        a {
            color: inherit;
        }

        .icon {
            width: 1.1em;
            height: 1.1em;
            flex: 0 0 auto;
            fill: none;
            stroke: currentColor;
            stroke-linecap: round;
            stroke-linejoin: round;
            stroke-width: 2;
        }

        .container {
            width: min(1160px, calc(100% - 40px));
            margin-inline: auto;
        }

        .topbar {
            color: var(--white);
            background: #0a2946;
            border-bottom: 3px solid var(--orange);
            font-family: Arial, Helvetica, sans-serif !important;
            font-size: .78rem;
            letter-spacing: .01em;
        }

        .topbar * {
            font-family: Arial, Helvetica, sans-serif !important;
        }

        .topbar .container,
        .site-header .container {
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 24px;
        }

        .topbar .container {
            min-height: 35px;
        }

        .availability,
        .topbar-call,
        .header-call,
        .feature,
        .trust-item,
        .call-link,
        .footer-call {
            display: inline-flex;
            align-items: center;
            gap: 9px;
        }

        .topbar-call {
            color: var(--white);
            font-weight: 600;
            text-decoration: none;
        }

        .topbar-call .icon {
            width: 14px;
            height: 14px;
        }

        .availability {
            color: #dce7ef;
            font-weight: 500;
        }

        .site-header {
            position: relative;
            z-index: 5;
            background: rgba(255, 255, 255, .98);
            border-bottom: 1px solid rgba(11, 47, 86, .09);
        }

        .site-header .container {
            min-height: 76px;
        }

        .brand img {
            width: 58px;
            height: 58px;
            flex: 0 0 58px;
            object-fit: contain;
        }

        .brand {
            display: inline-flex;
            align-items: center;
            gap: 12px;
            color: var(--navy);
            text-decoration: none;
        }

        .brand-copy {
            display: grid;
            gap: 1px;
            line-height: 1.1;
        }

        .brand-copy strong {
            font-size: 1.02rem;
            font-weight: 800;
            letter-spacing: .015em;
        }

        .brand-copy small {
            color: var(--muted);
            font-size: .67rem;
            font-weight: 600;
            letter-spacing: .045em;
            text-transform: uppercase;
        }

        .header-call {
            padding: 11px 17px;
            color: var(--navy);
            border: 1px solid #cbd8e2;
            border-radius: 10px;
            font-weight: 700;
            text-decoration: none;
            transition: border-color .2s ease, color .2s ease, transform .2s ease;
        }

        .header-call:hover {
            color: var(--orange-dark);
            border-color: var(--orange);
            transform: translateY(-1px);
        }

        .hero {
            position: relative;
            isolation: isolate;
            overflow: hidden;
            color: var(--white);
            background: var(--navy);
        }

        .hero::before {
            position: absolute;
            z-index: -2;
            inset: 0;
            content: "";
            background-image:
                linear-gradient(90deg, rgba(7, 31, 57, .97) 0%, rgba(7, 31, 57, .87) 45%, rgba(7, 31, 57, .56) 100%),
                url("<?php echo SITE_URL; ?>/upload/image/images-air_ambulance/IMG_2474.jpeg");
            background-position: center;
            background-size: cover;
        }

        .hero::after {
            position: absolute;
            z-index: -1;
            top: -220px;
            right: -180px;
            width: 600px;
            height: 600px;
            content: "";
            border: 1px solid rgba(255, 255, 255, .12);
            border-radius: 50%;
        }

        .hero-grid {
            display: grid;
            grid-template-columns: minmax(0, .92fr) minmax(420px, 1.08fr);
            gap: clamp(48px, 7vw, 92px);
            align-items: start;
            padding-block: 64px 72px;
        }

        .hero-copy {
            padding-top: 28px;
        }

        .eyebrow {
            display: inline-flex;
            align-items: center;
            gap: 9px;
            margin-bottom: 18px;
            color: #ffd6c8;
            font-size: .78rem;
            font-weight: 800;
            letter-spacing: .12em;
            text-transform: uppercase;
        }

        h1,
        h2,
        h3 {
            margin-top: 0;
            font-family: Inter, -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, Helvetica, Arial, sans-serif;
            font-weight: 800;
            line-height: 1.15;
        }

        h1 {
            max-width: 690px;
            margin-bottom: 22px;
            font-size: clamp(2.35rem, 5vw, 4.7rem);
            letter-spacing: -.045em;
        }

        .hero-copy > p {
            max-width: 610px;
            margin: 0 0 30px;
            color: #d7e3ed;
            font-size: clamp(1rem, 2vw, 1.16rem);
        }

        .hero-features {
            display: grid;
            grid-template-columns: repeat(2, minmax(0, 1fr));
            gap: 13px 20px;
            margin: 0;
            padding: 0;
            list-style: none;
        }

        .feature {
            color: #eef5fa;
            font-size: .94rem;
            font-weight: 600;
        }

        .feature .icon {
            color: #77d5ff;
        }

        .enquiry-card {
            color: var(--ink);
            background: var(--white);
            border-radius: 18px;
            box-shadow: var(--shadow);
            overflow: hidden;
        }

        .form-heading {
            padding: 25px 28px 20px;
            background: #f8fbfd;
            border-bottom: 1px solid var(--line);
        }

        .form-heading span {
            display: block;
            margin-bottom: 5px;
            color: var(--orange-dark);
            font-size: .76rem;
            font-weight: 800;
            letter-spacing: .09em;
            text-transform: uppercase;
        }

        .form-heading h2 {
            margin-bottom: 5px;
            color: var(--navy);
            font-size: 1.55rem;
            letter-spacing: -.02em;
        }

        .form-heading p {
            margin: 0;
            color: var(--muted);
            font-size: .9rem;
        }

        .enquiry-form {
            display: grid;
            grid-template-columns: repeat(2, minmax(0, 1fr));
            gap: 15px;
            padding: 24px 28px 20px;
        }

        .field {
            display: flex;
            flex-direction: column;
            gap: 6px;
        }

        .field-full,
        .form-status,
        .submit-button,
        .consent-field,
        .privacy-note,
        .form-honeypot {
            grid-column: 1 / -1;
        }

        .form-honeypot {
            position: absolute !important;
            width: 1px !important;
            height: 1px !important;
            padding: 0 !important;
            overflow: hidden !important;
            clip: rect(0, 0, 0, 0) !important;
            white-space: nowrap !important;
            border: 0 !important;
        }

        label {
            color: #2a4359;
            font-size: .79rem;
            font-weight: 700;
        }

        input,
        select,
        textarea {
            width: 100%;
            min-height: 47px;
            padding: 11px 13px;
            color: var(--ink);
            background: var(--white);
            border: 1px solid #cbd8e2;
            border-radius: 8px;
            outline: none;
            transition: border-color .2s ease, box-shadow .2s ease;
        }

        select {
            padding-right: 50px;
            background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='14' height='9' viewBox='0 0 14 9' fill='none'%3E%3Cpath d='M1 1.25 7 7.25l6-6' stroke='%232a4359' stroke-width='1.75' stroke-linecap='round' stroke-linejoin='round'/%3E%3C/svg%3E");
            background-repeat: no-repeat;
            background-position: right 18px center;
            background-size: 14px 9px;
            cursor: pointer;
            appearance: none;
            -webkit-appearance: none;
            -moz-appearance: none;
        }

        select::-ms-expand {
            display: none;
        }

        textarea {
            min-height: 78px;
            resize: vertical;
        }

        input:focus,
        select:focus,
        textarea:focus {
            border-color: var(--blue);
            box-shadow: 0 0 0 3px rgba(23, 105, 170, .12);
        }

        input.is-invalid,
        select.is-invalid,
        textarea.is-invalid {
            border-color: var(--danger);
            box-shadow: 0 0 0 3px rgba(180, 35, 24, .1);
        }

        .field-error {
            min-height: 0;
            margin: 0;
            color: var(--danger);
            font-size: .74rem;
            font-weight: 600;
            line-height: 1.35;
        }

        .consent-field {
            display: flex;
            align-items: flex-start;
            gap: 10px;
            color: var(--muted);
            font-size: .78rem;
            line-height: 1.45;
        }

        .consent-field input {
            width: 17px;
            min-height: 17px;
            margin: 2px 0 0;
            accent-color: var(--orange);
        }

        .consent-field label {
            color: inherit;
            font-size: inherit;
            font-weight: 500;
        }

        .consent-field .field-error {
            display: block;
            margin-top: 3px;
        }

        .submit-button {
            display: inline-flex;
            min-height: 52px;
            align-items: center;
            justify-content: center;
            gap: 10px;
            padding: 13px 20px;
            color: var(--white);
            background: var(--orange);
            border: 0;
            border-radius: 9px;
            cursor: pointer;
            font-weight: 800;
            box-shadow: 0 8px 22px rgba(244, 91, 42, .23);
            transition: background .2s ease, transform .2s ease;
        }

        .submit-button:hover {
            background: var(--orange-dark);
            transform: translateY(-1px);
        }

        .submit-button:disabled {
            cursor: wait;
            opacity: .7;
            transform: none;
        }

        .privacy-note {
            margin: -3px 0 0;
            color: var(--muted);
            font-size: .73rem;
            text-align: center;
        }

        .form-status {
            display: none;
            margin: 0;
            padding: 10px 12px;
            border-radius: 7px;
            font-size: .85rem;
            font-weight: 600;
        }

        .form-status.is-visible {
            display: block;
        }

        .form-status.is-success {
            color: var(--success);
            background: #eaf8f1;
        }

        .form-status.is-error {
            color: var(--danger);
            background: #fff0ee;
        }

        .success-modal {
            width: min(470px, calc(100% - 32px));
            padding: 0;
            color: var(--ink);
            background: var(--white);
            border: 0;
            border-radius: 18px;
            box-shadow: 0 28px 80px rgba(4, 27, 48, .3);
        }

        .success-modal::backdrop {
            background: rgba(4, 24, 42, .68);
            backdrop-filter: blur(3px);
        }

        .success-modal-content {
            position: relative;
            padding: 38px 34px 32px;
            text-align: center;
        }

        .success-modal-close {
            position: absolute;
            top: 14px;
            right: 14px;
            display: grid;
            width: 36px;
            height: 36px;
            place-items: center;
            color: var(--muted);
            background: #f0f4f7;
            border: 0;
            border-radius: 50%;
            cursor: pointer;
        }

        .success-modal-icon {
            display: grid;
            width: 64px;
            height: 64px;
            margin: 0 auto 20px;
            place-items: center;
            color: var(--white);
            background: var(--success);
            border-radius: 50%;
            box-shadow: 0 10px 26px rgba(22, 116, 74, .24);
        }

        .success-modal-icon .fa-solid {
            font-size: 1.55rem;
        }

        .success-modal h2 {
            margin-bottom: 10px;
            color: var(--navy);
            font-size: 1.55rem;
        }

        .success-modal-message {
            margin: 0 0 24px;
            color: var(--muted);
            font-size: .96rem;
        }

        .success-modal-actions {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 10px;
        }

        .success-modal-actions button,
        .success-modal-actions a {
            display: inline-flex;
            min-height: 46px;
            align-items: center;
            justify-content: center;
            gap: 8px;
            padding: 10px 16px;
            border-radius: 8px;
            font-weight: 700;
            text-decoration: none;
        }

        .success-modal-done {
            color: var(--white);
            background: var(--navy);
            border: 1px solid var(--navy);
            cursor: pointer;
        }

        .success-modal-call {
            color: var(--orange-dark);
            background: var(--white);
            border: 1px solid #efc8b9;
        }

        .call-option {
            padding: 17px 28px 20px;
            text-align: center;
            background: #fff8f5;
            border-top: 1px solid #f2d7cc;
        }

        .call-option p {
            margin: 0 0 6px;
            color: var(--muted);
            font-size: .86rem;
        }

        .call-link {
            color: var(--orange-dark);
            font-size: 1.05rem;
            font-weight: 800;
            text-decoration: none;
        }

        .trust-strip {
            background: var(--white);
            border-bottom: 1px solid var(--line);
        }

        .trust-grid {
            display: grid;
            grid-template-columns: repeat(4, minmax(0, 1fr));
        }

        .trust-item {
            min-height: 92px;
            justify-content: center;
            padding: 20px;
            color: var(--navy);
            border-right: 1px solid var(--line);
            font-size: .88rem;
            font-weight: 700;
            text-align: left;
        }

        .trust-item:last-child {
            border-right: 0;
        }

        .trust-item .icon {
            width: 1.45rem;
            height: 1.45rem;
            color: var(--orange);
        }

        .section {
            padding-block: 88px;
        }

        .section-soft {
            background: var(--mist);
        }

        .section-heading {
            max-width: 720px;
            margin: 0 auto 42px;
            text-align: center;
        }

        .section-heading .eyebrow {
            margin-bottom: 12px;
            color: var(--orange-dark);
        }

        .section-heading h2 {
            margin-bottom: 14px;
            color: var(--navy);
            font-size: clamp(1.9rem, 3.5vw, 3rem);
            letter-spacing: -.035em;
        }

        .section-heading p {
            margin: 0;
            color: var(--muted);
        }

        .service-grid {
            display: grid;
            grid-template-columns: repeat(4, minmax(0, 1fr));
            gap: 18px;
        }

        .service-card {
            background: var(--white);
            border: 1px solid var(--line);
            border-radius: 14px;
            box-shadow: 0 10px 34px rgba(8, 42, 72, .06);
            overflow: hidden;
        }

        .service-photo {
            width: 100%;
            height: 190px;
            object-fit: cover;
            object-position: center;
        }

        .service-photo-air {
            object-position: center 58%;
        }

        .service-photo-stretcher {
            object-position: center 40%;
        }

        .service-photo-road {
            object-position: center 44%;
        }

        .service-body {
            position: relative;
            padding: 30px 24px 26px;
        }

        .service-icon {
            position: absolute;
            top: -24px;
            display: grid;
            width: 46px;
            height: 46px;
            place-items: center;
            color: var(--orange);
            background: var(--white);
            border: 1px solid var(--line);
            border-radius: 12px;
            box-shadow: 0 6px 18px rgba(8, 42, 72, .12);
        }

        .service-icon .fa-solid {
            font-size: 1.18rem;
        }

        .service-card h3 {
            margin: 8px 0 10px;
            color: var(--navy);
            font-size: 1.06rem;
        }

        .service-card p {
            margin: 0;
            color: var(--muted);
            font-size: .9rem;
        }

        .process-grid {
            position: relative;
            display: grid;
            grid-template-columns: 1fr;
            gap: 0;
            counter-reset: process-step;
        }

        .process-grid::before {
            position: absolute;
            z-index: 0;
            top: 52px;
            bottom: 52px;
            left: 24px;
            width: 1px;
            height: auto;
            content: "";
            background: #c9d6e0;
        }

        .process-section {
            color: var(--ink);
            background: #f7f9fb;
            border-top: 1px solid var(--line);
            border-bottom: 1px solid var(--line);
        }

        .process-section .container {
            display: grid;
            grid-template-columns: minmax(280px, .75fr) minmax(0, 1.25fr);
            gap: clamp(55px, 8vw, 105px);
            align-items: start;
        }

        .process-section .section-heading {
            margin: 0;
            padding-top: 22px;
            text-align: left;
        }

        .process-section .section-heading h2 {
            max-width: 460px;
            margin-bottom: 18px;
            color: var(--navy);
            font-size: clamp(2rem, 3.6vw, 3.3rem);
        }

        .process-section .section-heading p {
            max-width: 440px;
            color: var(--muted);
            font-size: 1rem;
        }

        .process-section .section-heading .eyebrow {
            color: var(--orange-dark);
        }

        .process-step {
            position: relative;
            z-index: 1;
            min-height: 142px;
            padding: 25px 72px 25px 82px;
            background: transparent;
            border-top: 1px solid var(--line);
        }

        .process-step:last-child {
            border-bottom: 1px solid var(--line);
        }

        .process-step::before {
            position: absolute;
            top: 30px;
            right: 4px;
            color: #a9bac8;
            content: "0" counter(process-step);
            counter-increment: process-step;
            font-size: .78rem;
            font-weight: 700;
            letter-spacing: .08em;
            line-height: 1;
        }

        .step-icon {
            position: absolute;
            top: 24px;
            left: 0;
            display: grid;
            width: 48px;
            height: 48px;
            place-items: center;
            color: var(--white);
            background: var(--navy);
            border: 5px solid #f7f9fb;
            border-radius: 12px;
            box-shadow: 0 0 0 1px #c9d6e0;
        }

        .step-icon .icon {
            width: 22px;
            height: 22px;
        }

        .process-step h3 {
            margin: 0 0 7px;
            color: var(--navy);
            font-size: 1.18rem;
        }

        .process-step p {
            margin: 0;
            max-width: 560px;
            color: var(--muted);
            font-size: .94rem;
            line-height: 1.6;
        }

        .care-grid {
            display: grid;
            grid-template-columns: minmax(0, 1fr) minmax(0, .9fr);
            gap: 58px;
            align-items: center;
        }

        .care-slider {
            position: relative;
            height: 640px;
            background: #dce5ec;
            border-radius: 18px;
            box-shadow: var(--shadow);
            overflow: hidden;
        }

        .care-slides {
            position: relative;
            width: 100%;
            height: 100%;
        }

        .care-slide {
            position: absolute;
            inset: 0;
            margin: 0;
            opacity: 0;
            visibility: hidden;
            transition: opacity .55s ease, visibility .55s ease;
        }

        .care-slide.is-active {
            opacity: 1;
            visibility: visible;
        }

        .care-slide img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            object-position: center;
        }

        .care-slide::after {
            position: absolute;
            inset: auto 0 0;
            height: 24%;
            content: "";
            background: linear-gradient(transparent, rgba(7, 31, 57, .42));
            pointer-events: none;
        }

        .slider-button {
            position: absolute;
            z-index: 3;
            top: 50%;
            display: grid;
            width: 42px;
            height: 42px;
            place-items: center;
            color: var(--navy);
            background: rgba(255, 255, 255, .94);
            border: 0;
            border-radius: 50%;
            cursor: pointer;
            box-shadow: 0 5px 18px rgba(7, 31, 57, .22);
            transform: translateY(-50%);
            transition: color .2s ease, background .2s ease;
        }

        .slider-button:hover,
        .slider-button:focus-visible {
            color: var(--white);
            background: var(--orange);
        }

        .slider-button-previous {
            left: 16px;
        }

        .slider-button-next {
            right: 16px;
        }

        .slider-dots {
            position: absolute;
            z-index: 3;
            right: 18px;
            bottom: 17px;
            left: 18px;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 7px;
        }

        .slider-dot {
            width: 7px;
            height: 7px;
            padding: 0;
            background: rgba(255, 255, 255, .56);
            border: 0;
            border-radius: 50%;
            cursor: pointer;
            transition: width .2s ease, background .2s ease;
        }

        .slider-dot.is-active {
            width: 22px;
            background: var(--white);
            border-radius: 999px;
        }

        .care-copy h2 {
            margin-bottom: 18px;
            color: var(--navy);
            font-size: clamp(2rem, 3.6vw, 3.1rem);
            letter-spacing: -.04em;
        }

        .care-copy > p {
            margin-bottom: 28px;
            color: var(--muted);
        }

        .care-list {
            display: grid;
            gap: 15px;
            margin: 0;
            padding: 0;
            list-style: none;
        }

        .care-list li {
            display: flex;
            align-items: flex-start;
            gap: 12px;
            color: #2c465d;
        }

        .care-list .icon {
            width: 21px;
            height: 21px;
            margin-top: 2px;
            color: var(--success);
        }

        .faq-list {
            max-width: 820px;
            margin-inline: auto;
            border-top: 1px solid var(--line);
        }

        .faq-item {
            border-bottom: 1px solid var(--line);
        }

        .faq-question {
            display: flex;
            width: 100%;
            align-items: center;
            justify-content: space-between;
            gap: 20px;
            padding: 22px 0;
            color: var(--navy);
            background: transparent;
            border: 0;
            cursor: pointer;
            font-weight: 800;
            text-align: left;
        }

        .faq-question .icon {
            transition: transform .2s ease;
        }

        .faq-question[aria-expanded="true"] .icon {
            transform: rotate(45deg);
        }

        .faq-answer {
            display: grid;
            grid-template-rows: 0fr;
            color: var(--muted);
            transition: grid-template-rows .25s ease;
        }

        .faq-answer > div {
            overflow: hidden;
        }

        .faq-answer p {
            margin: 0;
            padding: 0 42px 22px 0;
        }

        .faq-question[aria-expanded="true"] + .faq-answer {
            grid-template-rows: 1fr;
        }

        .bottom-cta {
            padding-block: 56px;
            color: var(--white);
            background: var(--navy);
        }

        .bottom-cta .container {
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 32px;
        }

        .bottom-cta h2 {
            margin-bottom: 7px;
            font-size: clamp(1.55rem, 3vw, 2.3rem);
        }

        .bottom-cta p {
            margin: 0;
            color: #cbdbe8;
        }

        .footer-call {
            flex: 0 0 auto;
            padding: 14px 22px;
            color: var(--white);
            background: var(--orange);
            border-radius: 9px;
            font-weight: 800;
            text-decoration: none;
        }

        .site-footer {
            padding-block: 24px 20px;
            color: #a9bac8;
            background: var(--navy-deep);
            font-size: .82rem;
        }

        .site-footer .container {
            display: grid;
            grid-template-columns: minmax(0, 1fr) auto;
            gap: 18px 30px;
            align-items: center;
        }

        .site-footer a {
            color: #d9e5ee;
            text-decoration: none;
        }

        .site-footer a:hover {
            color: var(--white);
        }

        .footer-company {
            color: #d9e5ee;
            font-weight: 600;
        }

        .footer-links {
            display: flex;
            align-items: center;
            justify-content: flex-end;
            gap: 18px;
        }

        .footer-links a,
        .footer-address {
            display: inline-flex;
            align-items: center;
            gap: 7px;
        }

        .footer-links .fa-solid,
        .footer-address .fa-solid {
            color: #6fa7ce;
            font-size: .78rem;
        }

        .footer-address {
            grid-column: 1 / -1;
            padding-top: 16px;
            border-top: 1px solid rgba(255, 255, 255, .1);
            line-height: 1.5;
        }

        .footer-credit {
            grid-column: 1 / -1;
            color: #8197a9;
            font-size: .76rem;
        }

        .footer-credit a {
            color: #c7d6e1;
            font-weight: 600;
        }

        @media (max-width: 980px) {
            .hero-grid,
            .care-grid {
                grid-template-columns: 1fr;
            }

            .process-section .container {
                grid-template-columns: 1fr;
                gap: 42px;
            }

            .process-section .section-heading {
                max-width: 680px;
                padding-top: 0;
            }

            .hero-copy {
                max-width: 720px;
                padding-top: 0;
            }

            .enquiry-card {
                max-width: 720px;
            }

            .trust-grid,
            .service-grid {
                grid-template-columns: repeat(2, minmax(0, 1fr));
            }

            .trust-item:nth-child(2) {
                border-right: 0;
            }

            .trust-item:nth-child(-n + 2) {
                border-bottom: 1px solid var(--line);
            }

            .care-slider {
                width: 100%;
                height: min(88vw, 620px);
            }
        }

        @media (max-width: 720px) {
            .container {
                width: min(100% - 28px, 1160px);
            }

            .topbar .container {
                justify-content: center;
            }

            .availability {
                display: none;
            }

            .site-header .container {
                min-height: 68px;
            }

            .brand img {
                width: 50px;
                height: 50px;
                flex-basis: 50px;
            }

            .brand {
                gap: 9px;
            }

            .brand-copy strong {
                font-size: .88rem;
            }

            .brand-copy small {
                display: none;
            }

            .header-call span {
                display: none;
            }

            .header-call {
                width: 44px;
                height: 44px;
                justify-content: center;
                padding: 0;
                border-radius: 50%;
            }

            .hero-grid {
                gap: 34px;
                padding-block: 44px 54px;
            }

            h1 {
                font-size: clamp(2.25rem, 12vw, 3.25rem);
            }

            .hero-features,
            .enquiry-form,
            .service-grid,
            .process-grid {
                grid-template-columns: 1fr;
            }

            .enquiry-form {
                padding: 21px 20px 18px;
            }

            .form-heading,
            .call-option {
                padding-right: 20px;
                padding-left: 20px;
            }

            .process-grid::before {
                top: 50px;
                bottom: 50px;
                left: 24px;
                width: 1px;
                height: auto;
                background: #c9d6e0;
            }

            .section {
                padding-block: 68px;
            }

            .bottom-cta .container {
                flex-direction: column;
                align-items: flex-start;
            }

            .site-footer .container {
                grid-template-columns: 1fr;
                gap: 14px;
            }

            .footer-links {
                justify-content: flex-start;
                flex-wrap: wrap;
            }

            .footer-address {
                grid-column: 1;
            }

            .footer-call {
                width: 100%;
                justify-content: center;
            }
        }

        @media (max-width: 500px) {
            .success-modal-content {
                padding: 34px 22px 24px;
            }

            .success-modal-actions {
                grid-template-columns: 1fr;
            }

            .trust-grid {
                grid-template-columns: 1fr;
            }

            .trust-item,
            .trust-item:nth-child(2) {
                justify-content: flex-start;
                border-right: 0;
                border-bottom: 1px solid var(--line);
            }

            .trust-item:last-child {
                border-bottom: 0;
            }
        }

        @media (prefers-reduced-motion: reduce) {
            html {
                scroll-behavior: auto;
            }

            *,
            *::before,
            *::after {
                scroll-behavior: auto !important;
                transition-duration: .01ms !important;
            }
        }
    </style>
    <link rel="stylesheet" href="<?php echo htmlspecialchars(SITE_URL, ENT_QUOTES, 'UTF-8'); ?>/assets/css/tech-landing.css?v=<?php echo filemtime(__DIR__ . '/assets/css/tech-landing.css'); ?>">
</head>

<body>
    <div class="topbar">
        <div class="container">
            <span class="availability">International patient transfer desk &middot; Available 24/7</span>
            <a class="topbar-call js-call-link" href="tel:<?php echo htmlspecialchars($phoneLink, ENT_QUOTES, 'UTF-8'); ?>">
                <svg class="icon" aria-hidden="true" viewBox="0 0 24 24"><path d="M22 16.92v3a2 2 0 0 1-2.18 2 19.79 19.79 0 0 1-8.63-3.07 19.5 19.5 0 0 1-6-6A19.79 19.79 0 0 1 2.12 4.18 2 2 0 0 1 4.11 2h3a2 2 0 0 1 2 1.72c.12.9.33 1.78.62 2.63a2 2 0 0 1-.45 2.11L8 9.73a16 16 0 0 0 6 6l1.27-1.27a2 2 0 0 1 2.11-.45c.85.29 1.73.5 2.63.62A2 2 0 0 1 22 16.92z"/></svg>
                <?php echo htmlspecialchars($phoneDisplay, ENT_QUOTES, 'UTF-8'); ?>
            </a>
        </div>
    </div>

    <header class="site-header">
        <div class="container">
            <a class="brand" href="<?php echo SITE_URL; ?>" aria-label="<?php echo htmlspecialchars(SITE_NAME, ENT_QUOTES, 'UTF-8'); ?> home">
                <img src="<?php echo SITE_URL; ?>/assets/images/logo.png" alt="<?php echo htmlspecialchars(SITE_NAME, ENT_QUOTES, 'UTF-8'); ?>">
                <span class="brand-copy">
                    <strong>Ashoka Rescue</strong>
                    <small>Air Ambulance Services</small>
                </span>
            </a>
            <a class="header-call js-call-link" href="tel:<?php echo htmlspecialchars($phoneLink, ENT_QUOTES, 'UTF-8'); ?>">
                <svg class="icon" aria-hidden="true" viewBox="0 0 24 24"><path d="M22 16.92v3a2 2 0 0 1-2.18 2 19.79 19.79 0 0 1-8.63-3.07 19.5 19.5 0 0 1-6-6A19.79 19.79 0 0 1 2.12 4.18 2 2 0 0 1 4.11 2h3a2 2 0 0 1 2 1.72c.12.9.33 1.78.62 2.63a2 2 0 0 1-.45 2.11L8 9.73a16 16 0 0 0 6 6l1.27-1.27a2 2 0 0 1 2.11-.45c.85.29 1.73.5 2.63.62A2 2 0 0 1 22 16.92z"/></svg>
                <span>Speak with a coordinator</span>
            </a>
        </div>
    </header>

    <main>
        <section class="hero">
            <div class="container hero-grid">
                <div class="hero-copy">
                    <span class="eyebrow">
                        <svg class="icon" aria-hidden="true" viewBox="0 0 24 24"><path d="M22 2 11 13"/><path d="m22 2-7 20-4-9-9-4Z"/></svg>
                        India and worldwide
                    </span>
                    <h1>Medical transport, coordinated from bedside to bedside.</h1>
                    <p>Tell us where the patient is and where they need to go. Our medical transport team will review the case and help plan a safe air ambulance, commercial stretcher, or medical escort transfer.</p>
                    <ul class="hero-features">
                        <li class="feature">
                            <svg class="icon" aria-hidden="true" viewBox="0 0 24 24"><path d="M20 6 9 17l-5-5"/></svg>
                            24/7 case coordination
                        </li>
                        <li class="feature">
                            <svg class="icon" aria-hidden="true" viewBox="0 0 24 24"><path d="M20 6 9 17l-5-5"/></svg>
                            Critical care medical teams
                        </li>
                        <li class="feature">
                            <svg class="icon" aria-hidden="true" viewBox="0 0 24 24"><path d="M20 6 9 17l-5-5"/></svg>
                            International repatriation
                        </li>
                        <li class="feature">
                            <svg class="icon" aria-hidden="true" viewBox="0 0 24 24"><path d="M20 6 9 17l-5-5"/></svg>
                            Hospital and ground coordination
                        </li>
                    </ul>
                </div>

                <div class="enquiry-card" id="inquiry">
                    <div class="form-heading">
                        <span>Start here</span>
                        <h2>Request medical transport assistance</h2>
                        <p>Share the essentials. A coordinator will contact you to discuss the case.</p>
                    </div>

                    <form class="enquiry-form" id="landing-enquiry-form" novalidate>
                        <input type="hidden" name="csrf_token" value="<?php echo htmlspecialchars($csrfToken, ENT_QUOTES, 'UTF-8'); ?>">
                        <input type="hidden" name="form_started_at" value="<?php echo time(); ?>">
                        <div class="form-honeypot" aria-hidden="true">
                            <label for="website">Website</label>
                            <input id="website" name="website" type="text" tabindex="-1" autocomplete="off">
                        </div>

                        <div class="field">
                            <label for="name">Your name</label>
                            <input id="name" name="name" type="text" autocomplete="name" required minlength="2" maxlength="80" placeholder="Full name">
                        </div>

                        <div class="field">
                            <label for="relationship">Relationship to patient</label>
                            <select id="relationship" name="relationship" required>
                                <option value="">Please select</option>
                                <option>Family member</option>
                                <option>Patient</option>
                                <option>Hospital or doctor</option>
                                <option>Insurance or assistance company</option>
                                <option>Other</option>
                            </select>
                        </div>

                        <div class="field">
                            <label for="phone">Phone / WhatsApp with country code</label>
                            <input id="phone" name="phone" type="tel" autocomplete="tel" inputmode="tel" required maxlength="24" placeholder="e.g. +1 555 123 4567">
                        </div>

                        <div class="field">
                            <label for="email">Email</label>
                            <input id="email" name="email" type="email" autocomplete="email" required maxlength="254" placeholder="name@example.com">
                        </div>

                        <div class="field">
                            <label for="origin">Patient is currently in</label>
                            <input id="origin" name="origin" type="text" autocomplete="off" required minlength="2" maxlength="100" placeholder="City, country">
                        </div>

                        <div class="field">
                            <label for="destination">Transfer required to</label>
                            <input id="destination" name="destination" type="text" autocomplete="off" required minlength="2" maxlength="100" placeholder="City, country">
                        </div>

                        <div class="field">
                            <label for="services">Transport required</label>
                            <select id="services" name="services" required>
                                <option value="">Select a service</option>
                                <option value="Charter Air Ambulance">Charter air ambulance</option>
                                <option value="Commercial Stretcher">Commercial airline stretcher</option>
                                <option value="Medical Escort">Medical escort / business class</option>
                                <option value="Road Ambulance">Road ambulance</option>
                                <option value="Not Sure">Not sure — please advise</option>
                            </select>
                        </div>

                        <div class="field">
                            <label for="travel-date">Preferred transfer date</label>
                            <input id="travel-date" name="travel_date" type="date">
                        </div>

                        <div class="field field-full">
                            <label for="case-notes">Patient condition or other important details</label>
                            <textarea id="case-notes" name="case_notes" maxlength="1500" placeholder="A short summary helps our team assess the request"></textarea>
                        </div>

                        <div class="consent-field" data-field-wrapper="consent">
                            <input id="consent" name="consent" type="checkbox" value="1" required>
                            <div>
                                <label for="consent">I confirm that the details are accurate and agree to be contacted about this medical transport inquiry.</label>
                                <p class="field-error" data-error-for="consent" aria-live="polite"></p>
                            </div>
                        </div>

                        <p class="form-status" id="form-status" role="status" aria-live="polite"></p>

                        <button class="submit-button" type="submit">
                            Send inquiry
                            <svg class="icon" aria-hidden="true" viewBox="0 0 24 24"><path d="M5 12h14"/><path d="m13 6 6 6-6 6"/></svg>
                        </button>

                        <p class="privacy-note">Your details are used only to respond to this medical transport enquiry.</p>
                    </form>

                    <div class="call-option">
                        <p>Or, please call on this number</p>
                        <a class="call-link js-call-link" href="tel:<?php echo htmlspecialchars($phoneLink, ENT_QUOTES, 'UTF-8'); ?>">
                            <svg class="icon" aria-hidden="true" viewBox="0 0 24 24"><path d="M22 16.92v3a2 2 0 0 1-2.18 2 19.79 19.79 0 0 1-8.63-3.07 19.5 19.5 0 0 1-6-6A19.79 19.79 0 0 1 2.12 4.18 2 2 0 0 1 4.11 2h3a2 2 0 0 1 2 1.72c.12.9.33 1.78.62 2.63a2 2 0 0 1-.45 2.11L8 9.73a16 16 0 0 0 6 6l1.27-1.27a2 2 0 0 1 2.11-.45c.85.29 1.73.5 2.63.62A2 2 0 0 1 22 16.92z"/></svg>
                            <?php echo htmlspecialchars($phoneDisplay, ENT_QUOTES, 'UTF-8'); ?>
                        </a>
                    </div>
                </div>
            </div>
        </section>

        <section class="trust-strip" aria-label="Service highlights">
            <div class="container trust-grid">
                <div class="trust-item">
                    <svg class="icon" aria-hidden="true" viewBox="0 0 24 24"><circle cx="12" cy="12" r="9"/><path d="M12 7v5l3 2"/></svg>
                    Available 24 hours a day
                </div>
                <div class="trust-item">
                    <svg class="icon" aria-hidden="true" viewBox="0 0 24 24"><path d="M12 21a9 9 0 1 0 0-18 9 9 0 0 0 0 18Z"/><path d="M3.6 9h16.8M3.6 15h16.8M12 3a15 15 0 0 1 0 18M12 3a15 15 0 0 0 0 18"/></svg>
                    Domestic and international transfers
                </div>
                <div class="trust-item">
                    <svg class="icon" aria-hidden="true" viewBox="0 0 24 24"><path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10Z"/><path d="m9 12 2 2 4-4"/></svg>
                    Patient-focused medical planning
                </div>
                <div class="trust-item">
                    <svg class="icon" aria-hidden="true" viewBox="0 0 24 24"><path d="M3 11h18M5 11l2-6h10l2 6M6 11v7M18 11v7M3 18h18"/><path d="M9 8h6"/></svg>
                    Bed-to-bed coordination
                </div>
            </div>
        </section>

        <section class="section section-soft">
            <div class="container">
                <div class="section-heading">
                    <span class="eyebrow">Transport options</span>
                    <h2>The right level of care for the journey</h2>
                    <p>Our coordinators assess the route, timing, and patient’s medical needs to help identify a suitable transfer option.</p>
                </div>

                <div class="service-grid">
                    <article class="service-card">
                        <img class="service-photo service-photo-air" src="<?php echo SITE_URL; ?>/upload/image/images-air_ambulance/001%20AA.jpg" alt="Patient being prepared inside a charter air ambulance" loading="lazy">
                        <div class="service-body">
                            <span class="service-icon">
                                <i class="fa-solid fa-plane" aria-hidden="true"></i>
                            </span>
                            <h3>Charter air ambulance</h3>
                            <p>Dedicated aircraft configured for patients who require critical-care monitoring and a specialist medical team.</p>
                        </div>
                    </article>

                    <article class="service-card">
                        <img class="service-photo service-photo-stretcher" src="<?php echo SITE_URL; ?>/upload/image/images-commercial_strectcher/IMG_2418.jpeg" alt="Patient receiving medical support on a commercial airline stretcher" loading="lazy">
                        <div class="service-body">
                            <span class="service-icon">
                                <i class="fa-solid fa-bed-pulse" aria-hidden="true"></i>
                            </span>
                            <h3>Commercial stretcher</h3>
                            <p>A medically supported stretcher arrangement on a scheduled airline for eligible long-distance patients.</p>
                        </div>
                    </article>

                    <article class="service-card">
                        <img class="service-photo service-photo-stretcher" src="<?php echo SITE_URL; ?>/upload/image/images-commercial_strectcher/005%20CS.jpg" alt="Medical escort caring for a patient during a commercial flight" loading="lazy">
                        <div class="service-body">
                            <span class="service-icon">
                                <i class="fa-solid fa-user-doctor" aria-hidden="true"></i>
                            </span>
                            <h3>Medical escort</h3>
                            <p>A doctor, nurse, or paramedic accompanies suitable patients on a commercial flight with planned support.</p>
                        </div>
                    </article>

                    <article class="service-card">
                        <img class="service-photo service-photo-road" src="<?php echo SITE_URL; ?>/upload/image/images-ambulance_others/005%20AM.jpg" alt="Medical team attending a patient inside a road ambulance" loading="lazy">
                        <div class="service-body">
                            <span class="service-icon">
                                <i class="fa-solid fa-truck-medical" aria-hidden="true"></i>
                            </span>
                            <h3>Ground ambulance</h3>
                            <p>Coordinated road transport to connect the patient with hospitals, airports, and receiving facilities.</p>
                        </div>
                    </article>
                </div>
            </div>
        </section>

        <section class="section">
            <div class="container care-grid">
                <div class="care-slider" id="care-slider" aria-label="<?php echo htmlspecialchars(SITE_NAME, ENT_QUOTES, 'UTF-8'); ?> patient transport gallery">
                    <div class="care-slides">
                        <figure class="care-slide is-active">
                            <img src="<?php echo SITE_URL; ?>/upload/image/images-air_ambulance/001%20AA.jpg" alt="Patient transport setup inside an air ambulance" loading="lazy">
                        </figure>
                        <figure class="care-slide">
                            <img src="<?php echo SITE_URL; ?>/upload/image/images-air_ambulance/D954164F-C0C4-4E88-9661-0F90AEF5439F.JPG" alt="Air ambulance aircraft on the airport apron" loading="lazy">
                        </figure>
                        <figure class="care-slide">
                            <img src="<?php echo SITE_URL; ?>/upload/image/images-air_ambulance/IMG_0103.jpg" alt="Medical equipment prepared inside an air ambulance" loading="lazy">
                        </figure>
                        <figure class="care-slide">
                            <img src="<?php echo SITE_URL; ?>/upload/image/images-ambulance_others/001%20AM.jpg" alt="Ground ambulance patient transfer" loading="lazy">
                        </figure>
                        <figure class="care-slide">
                            <img src="<?php echo SITE_URL; ?>/upload/image/images-ambulance_others/004%20AM.jpg" alt="Medical team working inside a ground ambulance" loading="lazy">
                        </figure>
                        <figure class="care-slide">
                            <img src="<?php echo SITE_URL; ?>/upload/image/images-commercial_strectcher/002%20CS.jpg" alt="Commercial airline stretcher preparation" loading="lazy">
                        </figure>
                        <figure class="care-slide">
                            <img src="<?php echo SITE_URL; ?>/upload/image/images-commercial_strectcher/004%20CS.jpg" alt="Medical monitoring during a commercial stretcher transfer" loading="lazy">
                        </figure>
                        <figure class="care-slide">
                            <img src="<?php echo SITE_URL; ?>/upload/image/images-commercial_strectcher/006%20CS.jpg" alt="Commercial stretcher medical transport arrangement" loading="lazy">
                        </figure>
                        <figure class="care-slide">
                            <img src="<?php echo SITE_URL; ?>/upload/image/images-commercial_strectcher/007%20CS.jpg" alt="Medical escort supporting a commercial stretcher patient" loading="lazy">
                        </figure>
                        <figure class="care-slide">
                            <img src="<?php echo SITE_URL; ?>/upload/image/images-commercial_strectcher/008%20CS.jpg" alt="Patient care equipment during commercial air transport" loading="lazy">
                        </figure>
                    </div>

                    <button class="slider-button slider-button-previous" type="button" aria-label="Show previous transport photo">
                        <i class="fa-solid fa-chevron-left" aria-hidden="true"></i>
                    </button>
                    <button class="slider-button slider-button-next" type="button" aria-label="Show next transport photo">
                        <i class="fa-solid fa-chevron-right" aria-hidden="true"></i>
                    </button>
                    <div class="slider-dots" aria-label="Select a transport photo"></div>
                </div>
                <div class="care-copy">
                    <span class="eyebrow">Coordinated medical care</span>
                    <h2>One team connecting every part of the transfer</h2>
                    <p>International patient transport can involve hospitals, airlines, airports, medical teams, and ground ambulances. <?php echo htmlspecialchars(COMPANY_NAME, ENT_QUOTES, 'UTF-8'); ?> brings those moving parts into one coordinated plan.</p>
                    <ul class="care-list">
                        <li>
                            <svg class="icon" aria-hidden="true" viewBox="0 0 24 24"><path d="M20 6 9 17l-5-5"/></svg>
                            Review of the patient’s condition and travel requirements
                        </li>
                        <li>
                            <svg class="icon" aria-hidden="true" viewBox="0 0 24 24"><path d="M20 6 9 17l-5-5"/></svg>
                            Planning with the sending and receiving facilities
                        </li>
                        <li>
                            <svg class="icon" aria-hidden="true" viewBox="0 0 24 24"><path d="M20 6 9 17l-5-5"/></svg>
                            Medical crew and equipment selected for the case
                        </li>
                        <li>
                            <svg class="icon" aria-hidden="true" viewBox="0 0 24 24"><path d="M20 6 9 17l-5-5"/></svg>
                            Ground and flight logistics coordinated around the route
                        </li>
                    </ul>
                </div>
            </div>
        </section>

        <section class="section process-section">
            <div class="container">
                <div class="section-heading">
                    <span class="eyebrow">How it works</span>
                    <h2>A clear path from inquiry to transfer</h2>
                    <p>Our team guides families and referring professionals through the information needed to plan the journey.</p>
                </div>

                <div class="process-grid">
                    <article class="process-step">
                        <span class="step-icon">
                            <svg class="icon" aria-hidden="true" viewBox="0 0 24 24"><path d="M21 15a4 4 0 0 1-4 4H8l-5 3V7a4 4 0 0 1 4-4h10a4 4 0 0 1 4 4Z"/></svg>
                        </span>
                        <h3>Share the case</h3>
                        <p>Send the route, preferred date, contact details, and a brief summary of the patient’s condition.</p>
                    </article>

                    <article class="process-step">
                        <span class="step-icon">
                            <svg class="icon" aria-hidden="true" viewBox="0 0 24 24"><path d="M12 3 4 7v5c0 5 3.5 8 8 9 4.5-1 8-4 8-9V7Z"/><path d="M9 12h6M12 9v6"/></svg>
                        </span>
                        <h3>Medical review and plan</h3>
                        <p>The team reviews the needs of the patient and discusses an appropriate transport approach with you.</p>
                    </article>

                    <article class="process-step">
                        <span class="step-icon">
                            <svg class="icon" aria-hidden="true" viewBox="0 0 24 24"><path d="m22 2-7 20-4-9-9-4Z"/><path d="M22 2 11 13"/></svg>
                        </span>
                        <h3>Coordinate the journey</h3>
                        <p>Once confirmed, the medical, flight, hospital, and ground arrangements are brought together.</p>
                    </article>
                </div>
            </div>
        </section>

        <section class="section">
            <div class="container">
                <div class="section-heading">
                    <span class="eyebrow">Common questions</span>
                    <h2>Before you request a transfer</h2>
                </div>

                <div class="faq-list">
                    <div class="faq-item">
                        <button class="faq-question" type="button" aria-expanded="false">
                            What information should I have ready?
                            <svg class="icon" aria-hidden="true" viewBox="0 0 24 24"><path d="M12 5v14M5 12h14"/></svg>
                        </button>
                        <div class="faq-answer"><div><p>Please share the patient’s current location, intended destination, general medical condition, hospital contact if available, and preferred date of travel. A coordinator can explain anything else needed.</p></div></div>
                    </div>

                    <div class="faq-item">
                        <button class="faq-question" type="button" aria-expanded="false">
                            Can you arrange international transport to or from India?
                            <svg class="icon" aria-hidden="true" viewBox="0 0 24 24"><path d="M12 5v14M5 12h14"/></svg>
                        </button>
                        <div class="faq-answer"><div><p>Yes. <?php echo htmlspecialchars(COMPANY_NAME, ENT_QUOTES, 'UTF-8'); ?> coordinates domestic and international patient transfers, including air ambulance, commercial stretcher, and medical escort options, subject to medical and travel requirements.</p></div></div>
                    </div>

                    <div class="faq-item">
                        <button class="faq-question" type="button" aria-expanded="false">
                            How is the transport option selected?
                            <svg class="icon" aria-hidden="true" viewBox="0 0 24 24"><path d="M12 5v14M5 12h14"/></svg>
                        </button>
                        <div class="faq-answer"><div><p>The appropriate option depends on the patient’s condition, oxygen and monitoring needs, route, urgency, airline requirements, and whether the patient can sit for takeoff and landing.</p></div></div>
                    </div>

                    <div class="faq-item">
                        <button class="faq-question" type="button" aria-expanded="false">
                            Is the service available outside Indian business hours?
                            <svg class="icon" aria-hidden="true" viewBox="0 0 24 24"><path d="M12 5v14M5 12h14"/></svg>
                        </button>
                        <div class="faq-answer"><div><p>Yes. The medical transfer desk is available 24/7. If your need is urgent, call the number shown on this page for the fastest contact.</p></div></div>
                    </div>
                </div>
            </div>
        </section>

        <section class="bottom-cta">
            <div class="container">
                <div>
                    <h2>Need to discuss the patient’s journey now?</h2>
                    <p>Call the 24/7 medical transfer desk and speak directly with a coordinator.</p>
                </div>
                <a class="footer-call js-call-link" href="tel:<?php echo htmlspecialchars($phoneLink, ENT_QUOTES, 'UTF-8'); ?>">
                    <svg class="icon" aria-hidden="true" viewBox="0 0 24 24"><path d="M22 16.92v3a2 2 0 0 1-2.18 2 19.79 19.79 0 0 1-8.63-3.07 19.5 19.5 0 0 1-6-6A19.79 19.79 0 0 1 2.12 4.18 2 2 0 0 1 4.11 2h3a2 2 0 0 1 2 1.72c.12.9.33 1.78.62 2.63a2 2 0 0 1-.45 2.11L8 9.73a16 16 0 0 0 6 6l1.27-1.27a2 2 0 0 1 2.11-.45c.85.29 1.73.5 2.63.62A2 2 0 0 1 22 16.92z"/></svg>
                    <?php echo htmlspecialchars($phoneDisplay, ENT_QUOTES, 'UTF-8'); ?>
                </a>
            </div>
        </section>
    </main>

    <footer class="site-footer">
        <div class="container">
            <span class="footer-company">&copy; <?php echo date('Y'); ?> <?php echo htmlspecialchars(COMPANY_NAME, ENT_QUOTES, 'UTF-8'); ?></span>
            <nav class="footer-links" aria-label="Footer links">
                <a href="<?php echo SITE_URL; ?>/privacy">
                    <i class="fa-solid fa-shield-halved" aria-hidden="true"></i>
                    Privacy policy
                </a>
                <a href="mailto:<?php echo htmlspecialchars(SITE_EMAIL, ENT_QUOTES, 'UTF-8'); ?>">
                    <i class="fa-solid fa-envelope" aria-hidden="true"></i>
                    <?php echo htmlspecialchars(SITE_EMAIL, ENT_QUOTES, 'UTF-8'); ?>
                </a>
            </nav>
            <span class="footer-address">
                <i class="fa-solid fa-location-dot" aria-hidden="true"></i>
                <?php echo htmlspecialchars(COMPANY_ADDRESS, ENT_QUOTES, 'UTF-8'); ?>
            </span>
            <span class="footer-credit">
                Designed and Developed by
                <a href="http://techproitsolutions.in/" target="_blank" rel="noopener noreferrer">Techpro IT Solutions</a>
            </span>
        </div>
    </footer>

    <dialog class="success-modal" id="success-modal" aria-labelledby="success-modal-title">
        <div class="success-modal-content">
            <button class="success-modal-close" type="button" aria-label="Close confirmation">
                <i class="fa-solid fa-xmark" aria-hidden="true"></i>
            </button>
            <span class="success-modal-icon" aria-hidden="true">
                <i class="fa-solid fa-check"></i>
            </span>
            <h2 id="success-modal-title">Inquiry received</h2>
            <p class="success-modal-message" id="success-modal-message">Your inquiry has been sent to our medical transport team.</p>
            <div class="success-modal-actions">
                <button class="success-modal-done" type="button">Done</button>
                <a class="success-modal-call js-call-link" href="tel:<?php echo htmlspecialchars($phoneLink, ENT_QUOTES, 'UTF-8'); ?>">
                    <i class="fa-solid fa-phone" aria-hidden="true"></i>
                    Call now
                </a>
            </div>
        </div>
    </dialog>

    <script>
        (function () {
            'use strict';

            const form = document.getElementById('landing-enquiry-form');
            const status = document.getElementById('form-status');
            const submitButton = form.querySelector('button[type="submit"]');
            const submitButtonContent = submitButton.innerHTML;
            const travelDate = document.getElementById('travel-date');
            const careSlider = document.getElementById('care-slider');
            const successModal = document.getElementById('success-modal');
            const successModalMessage = document.getElementById('success-modal-message');

            function formatLocalDate(date) {
                const year = date.getFullYear();
                const month = String(date.getMonth() + 1).padStart(2, '0');
                const day = String(date.getDate()).padStart(2, '0');
                return year + '-' + month + '-' + day;
            }

            const maximumTravelDate = new Date();
            maximumTravelDate.setFullYear(maximumTravelDate.getFullYear() + 2);
            travelDate.min = formatLocalDate(new Date());
            travelDate.max = formatLocalDate(maximumTravelDate);

            if (careSlider) {
                const slides = Array.from(careSlider.querySelectorAll('.care-slide'));
                const previousButton = careSlider.querySelector('.slider-button-previous');
                const nextButton = careSlider.querySelector('.slider-button-next');
                const dotsContainer = careSlider.querySelector('.slider-dots');
                const reduceMotion = window.matchMedia('(prefers-reduced-motion: reduce)').matches;
                let activeSlide = 0;
                let autoplayTimer = null;

                const dots = slides.map(function (_, index) {
                    const dot = document.createElement('button');
                    dot.type = 'button';
                    dot.className = 'slider-dot' + (index === 0 ? ' is-active' : '');
                    dot.setAttribute('aria-label', 'Show transport photo ' + (index + 1));
                    dot.setAttribute('aria-current', index === 0 ? 'true' : 'false');
                    dot.addEventListener('click', function () {
                        showSlide(index);
                        restartAutoplay();
                    });
                    dotsContainer.appendChild(dot);
                    return dot;
                });

                function showSlide(index) {
                    activeSlide = (index + slides.length) % slides.length;

                    slides.forEach(function (slide, slideIndex) {
                        const isActive = slideIndex === activeSlide;
                        slide.classList.toggle('is-active', isActive);
                        slide.setAttribute('aria-hidden', String(!isActive));
                    });

                    dots.forEach(function (dot, dotIndex) {
                        const isActive = dotIndex === activeSlide;
                        dot.classList.toggle('is-active', isActive);
                        dot.setAttribute('aria-current', String(isActive));
                    });
                }

                function stopAutoplay() {
                    if (autoplayTimer) {
                        window.clearInterval(autoplayTimer);
                        autoplayTimer = null;
                    }
                }

                function startAutoplay() {
                    if (reduceMotion || autoplayTimer || document.hidden) {
                        return;
                    }

                    autoplayTimer = window.setInterval(function () {
                        showSlide(activeSlide + 1);
                    }, 4500);
                }

                function restartAutoplay() {
                    stopAutoplay();
                    startAutoplay();
                }

                previousButton.addEventListener('click', function () {
                    showSlide(activeSlide - 1);
                    restartAutoplay();
                });

                nextButton.addEventListener('click', function () {
                    showSlide(activeSlide + 1);
                    restartAutoplay();
                });

                careSlider.addEventListener('mouseenter', stopAutoplay);
                careSlider.addEventListener('mouseleave', startAutoplay);
                careSlider.addEventListener('focusin', stopAutoplay);
                careSlider.addEventListener('focusout', function (event) {
                    if (!careSlider.contains(event.relatedTarget)) {
                        startAutoplay();
                    }
                });
                careSlider.addEventListener('keydown', function (event) {
                    if (event.key === 'ArrowLeft') {
                        showSlide(activeSlide - 1);
                        restartAutoplay();
                    } else if (event.key === 'ArrowRight') {
                        showSlide(activeSlide + 1);
                        restartAutoplay();
                    }
                });
                document.addEventListener('visibilitychange', function () {
                    if (document.hidden) {
                        stopAutoplay();
                    } else {
                        startAutoplay();
                    }
                });

                showSlide(0);
                startAutoplay();
            }

            function showStatus(message, type) {
                status.textContent = message;
                status.className = 'form-status is-visible ' + (type === 'success' ? 'is-success' : 'is-error');
            }

            function showSuccessPopup(message) {
                successModalMessage.textContent = message;
                if (typeof successModal.showModal === 'function') {
                    successModal.showModal();
                } else {
                    showStatus(message, 'success');
                }
            }

            function closeSuccessPopup() {
                if (successModal.open) {
                    successModal.close();
                }
            }

            successModal.querySelector('.success-modal-close').addEventListener('click', closeSuccessPopup);
            successModal.querySelector('.success-modal-done').addEventListener('click', closeSuccessPopup);
            successModal.addEventListener('click', function (event) {
                if (event.target === successModal) {
                    closeSuccessPopup();
                }
            });

            function getErrorElement(fieldName) {
                let errorElement = form.querySelector('[data-error-for="' + fieldName + '"]');
                if (errorElement) {
                    return errorElement;
                }

                const field = form.elements[fieldName];
                const wrapper = field ? field.closest('.field') : null;
                if (!wrapper) {
                    return null;
                }

                errorElement = document.createElement('p');
                errorElement.className = 'field-error';
                errorElement.dataset.errorFor = fieldName;
                errorElement.id = fieldName + '-error';
                errorElement.setAttribute('aria-live', 'polite');
                wrapper.appendChild(errorElement);
                return errorElement;
            }

            function setFieldError(fieldName, message) {
                const field = form.elements[fieldName];
                const errorElement = getErrorElement(fieldName);
                if (!field || !errorElement) {
                    return;
                }

                field.classList.add('is-invalid');
                field.setAttribute('aria-invalid', 'true');
                field.setAttribute('aria-describedby', errorElement.id || fieldName + '-error');
                errorElement.textContent = message;
            }

            function clearFieldError(fieldName) {
                const field = form.elements[fieldName];
                const errorElement = form.querySelector('[data-error-for="' + fieldName + '"]');
                if (field) {
                    field.classList.remove('is-invalid');
                    field.removeAttribute('aria-invalid');
                    field.removeAttribute('aria-describedby');
                }
                if (errorElement) {
                    errorElement.textContent = '';
                }
            }

            function validateForm() {
                const errors = {};
                const name = form.elements.name.value.trim();
                const phone = form.elements.phone.value.trim().replace(/[\s().-]/g, '');
                const email = form.elements.email.value.trim();
                const origin = form.elements.origin.value.trim();
                const destination = form.elements.destination.value.trim();
                const travelDateValue = form.elements.travel_date.value;

                if (name.length < 2 || name.length > 80 || !/^\p{L}[\p{L} .'-]*$/u.test(name)) {
                    errors.name = 'Enter a valid full name.';
                }
                if (!form.elements.relationship.value) {
                    errors.relationship = 'Select your relationship to the patient.';
                }
                if (!/^\+[1-9][0-9]{7,14}$/.test(phone)) {
                    errors.phone = 'Use an international number beginning with + and the country code.';
                }
                if (!/^[^\s@]+@[^\s@]+\.[^\s@]{2,}$/.test(email) || email.length > 254) {
                    errors.email = 'Enter a valid email address.';
                }
                if (origin.length < 2) {
                    errors.origin = 'Enter the patient’s current city and country.';
                }
                if (destination.length < 2) {
                    errors.destination = 'Enter the destination city and country.';
                } else if (origin.toLocaleLowerCase() === destination.toLocaleLowerCase()) {
                    errors.destination = 'The destination must be different from the current location.';
                }
                if (!form.elements.services.value) {
                    errors.services = 'Select a service or choose “Not sure”.';
                }
                if (travelDateValue) {
                    const selectedDate = new Date(travelDateValue + 'T00:00:00');
                    const today = new Date();
                    const latestDate = new Date();
                    today.setHours(0, 0, 0, 0);
                    latestDate.setFullYear(latestDate.getFullYear() + 2);
                    latestDate.setHours(23, 59, 59, 999);
                    if (Number.isNaN(selectedDate.getTime()) || selectedDate < today || selectedDate > latestDate) {
                        errors.travel_date = 'Choose a valid date within the next two years.';
                    }
                }
                if (form.elements.case_notes.value.length > 1500) {
                    errors.case_notes = 'Keep the patient details within 1,500 characters.';
                }
                if (!form.elements.consent.checked) {
                    errors.consent = 'Confirm that we may contact you about this inquiry.';
                }

                ['name', 'relationship', 'phone', 'email', 'origin', 'destination', 'services', 'travel_date', 'case_notes', 'consent'].forEach(clearFieldError);
                Object.entries(errors).forEach(function (entry) {
                    setFieldError(entry[0], entry[1]);
                });

                const firstInvalidField = Object.keys(errors)[0];
                if (firstInvalidField && form.elements[firstInvalidField]) {
                    form.elements[firstInvalidField].focus();
                }

                return Object.keys(errors).length === 0;
            }

            ['name', 'relationship', 'phone', 'email', 'origin', 'destination', 'services', 'travel_date', 'case_notes', 'consent'].forEach(function (fieldName) {
                const field = form.elements[fieldName];
                const eventName = field.type === 'checkbox' || field.tagName === 'SELECT' || field.type === 'date' ? 'change' : 'input';
                field.addEventListener(eventName, function () {
                    clearFieldError(fieldName);
                    status.className = 'form-status';
                });
            });

            form.addEventListener('submit', async function (event) {
                event.preventDefault();

                if (!validateForm()) {
                    showStatus('Please correct the highlighted fields.', 'error');
                    return;
                }

                const formData = new FormData(form);

                submitButton.disabled = true;
                submitButton.textContent = 'Sending inquiry…';
                status.className = 'form-status';

                try {
                    const response = await fetch(window.location.href, {
                        method: 'POST',
                        body: formData,
                        headers: {
                            'X-Requested-With': 'XMLHttpRequest'
                        }
                    });

                    const result = await response.json().catch(function () {
                        throw new Error('The server returned an invalid response.');
                    });

                    if (!result.status) {
                        if (result.errors) {
                            Object.entries(result.errors).forEach(function (entry) {
                                setFieldError(entry[0], entry[1]);
                            });
                            const firstServerError = Object.keys(result.errors)[0];
                            if (firstServerError && form.elements[firstServerError]) {
                                form.elements[firstServerError].focus();
                            }
                        }
                        throw new Error(result.message || 'We could not send your inquiry.');
                    }

                    showSuccessPopup(result.message);
                    form.reset();
                    travelDate.min = formatLocalDate(new Date());
                    form.elements.form_started_at.value = Math.floor(Date.now() / 1000);

                    if (typeof gtag === 'function') {
                        gtag('event', 'generate_lead', {
                            event_category: 'Google Ads landing page',
                            event_label: 'Medical transport inquiry'
                        });
                    }
                } catch (error) {
                    showStatus(error.message + ' You can call <?php echo addslashes($phoneDisplay); ?> for immediate assistance.', 'error');
                } finally {
                    submitButton.disabled = false;
                    submitButton.innerHTML = submitButtonContent;
                }
            });

            document.querySelectorAll('.faq-question').forEach(function (button) {
                button.addEventListener('click', function () {
                    const expanded = button.getAttribute('aria-expanded') === 'true';
                    button.setAttribute('aria-expanded', String(!expanded));
                });
            });

            document.querySelectorAll('.js-call-link').forEach(function (link) {
                link.addEventListener('click', function () {
                    if (typeof gtag === 'function') {
                        gtag('event', 'phone_call_click', {
                            event_category: 'Google Ads landing page',
                            event_label: '<?php echo addslashes($phoneDisplay); ?>'
                        });
                    }
                });
            });
        }());
    </script>
</body>

</html>
