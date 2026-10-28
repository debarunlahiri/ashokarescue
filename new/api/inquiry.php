<?php
/** Initial travel enquiries use the existing contact_quotes table. */
declare(strict_types=1);

require_once __DIR__ . "/../includes/session.php";
header("Content-Type: application/json; charset=utf-8");
header("Cache-Control: no-store");

function inquiryResponse(bool $status, string $message, int $code = 200): never
{
    http_response_code($code);
    if (str_contains($_SERVER["HTTP_ACCEPT"] ?? "", "application/json")) {
        echo json_encode(["status" => $status, "message" => $message]);
    } else {
        header("Content-Type: text/html; charset=utf-8");
        echo '<!doctype html><html lang="en"><meta charset="utf-8"><meta name="viewport" content="width=device-width,initial-scale=1"><title>Medical transport request</title><body><main><h1>Medical transport request</h1><p>' .
            htmlspecialchars($message, ENT_QUOTES, "UTF-8") .
            '</p><p><a href="' .
            htmlspecialchars(SITE_URL . "/contact", ENT_QUOTES) .
            '">Return to contact</a></p></main></body></html>';
    }
    exit();
}

if ($_SERVER["REQUEST_METHOD"] !== "POST") {
    header("Allow: POST");
    inquiryResponse(false, "Please submit the assistance form.", 405);
}
if (
    !is_string($_POST["csrf_token"] ?? null) ||
    !validateCSRFToken($_POST["csrf_token"])
) {
    inquiryResponse(
        false,
        "Your session expired. Refresh this page and try again.",
        403,
    );
}
if (!empty($_POST["website"])) {
    inquiryResponse(
        false,
        "Unable to accept this request. Please call the medical coordination desk.",
        422,
    );
}

$fields = [];
$limits = [
    "name" => 100,
    "email" => 100,
    "phone" => 20,
    "pickup" => 120,
    "destination" => 120,
    "services" => 100,
    "details" => 1500,
];
foreach ($limits as $field => $limit) {
    $value = $_POST[$field] ?? "";
    if (!is_string($value) || mb_strlen(trim($value)) > $limit) {
        inquiryResponse(
            false,
            "Please check the length of your form entries.",
            422,
        );
    }
    $fields[$field] = trim($value);
}
foreach (
    ["name", "email", "phone", "pickup", "destination", "services"]
    as $required
) {
    if ($fields[$required] === "") {
        inquiryResponse(false, "Please complete all required fields.", 422);
    }
}
if (
    !filter_var($fields["email"], FILTER_VALIDATE_EMAIL) ||
    !preg_match('/^\+?[0-9() .-]{7,20}$/', $fields["phone"]) ||
    strlen(preg_replace("/\D/", "", $fields["phone"])) < 7
) {
    inquiryResponse(
        false,
        "Please enter a valid email address and phone number.",
        422,
    );
}
if (($_POST["consent"] ?? "") !== "1") {
    inquiryResponse(false, "Please confirm your consent to be contacted.", 422);
}
$allowedServices = array_column(getServiceMenu(), "title");
if (!in_array($fields["services"], $allowedServices, true)) {
    inquiryResponse(false, "Please choose a service from the list.", 422);
}

// Shared, locked IP buckets survive session resets. No submitted personal data is stored here.
$rateDirectory =
    getenv("INQUIRY_RATE_DIR") ?: sys_get_temp_dir() . "/ashoka-inquiry-rates";
if (
    !is_dir($rateDirectory) &&
    !@mkdir($rateDirectory, 0700, true) &&
    !is_dir($rateDirectory)
) {
    inquiryResponse(
        false,
        "Requests are temporarily unavailable. Please call us.",
        503,
    );
}
$identity = hash("sha256", __DIR__ . ($_SERVER["REMOTE_ADDR"] ?? "unknown"));
$handle = @fopen($rateDirectory . "/" . $identity . ".json", "c+");
if (!$handle || !flock($handle, LOCK_EX)) {
    if ($handle) {
        fclose($handle);
    }
    inquiryResponse(
        false,
        "Requests are temporarily unavailable. Please call us.",
        503,
    );
}
$attempts = json_decode(stream_get_contents($handle), true) ?: [];
$attempts = array_values(
    array_filter(
        $attempts,
        static fn($time) => is_int($time) && $time > time() - 3600,
    ),
);
if (count($attempts) >= 5) {
    flock($handle, LOCK_UN);
    fclose($handle);
    header("Retry-After: 3600");
    inquiryResponse(
        false,
        "Too many requests. Please call us for immediate assistance or try again later.",
        429,
    );
}
$attempts[] = time();
ftruncate($handle, 0);
rewind($handle);
fwrite($handle, json_encode($attempts));
fflush($handle);
flock($handle, LOCK_UN);
fclose($handle);

$details = "Phone: {$fields["phone"]}\nPickup: {$fields["pickup"]}\nDestination: {$fields["destination"]}\nConsent to contact: yes\n\n{$fields["details"]}";
try {
    $accepted = executeUpdate(
        "INSERT INTO contact_quotes (name, email, services, details, created_at, updated_at) VALUES (?, ?, ?, ?, NOW(), NOW())",
        "ssss",
        [$fields["name"], $fields["email"], $fields["services"], $details],
    );
    if (!$accepted) {
        throw new RuntimeException("Enquiry insert failed");
    }
} catch (Throwable $exception) {
    error_log("Ashoka Rescue: enquiry storage unavailable.");
    inquiryResponse(
        false,
        "Your request could not be saved. Please call the medical coordination desk or try again later.",
        503,
    );
}

// Acceptance means the request exists in the staff inbox. Mail is a secondary notification.
try {
    $body =
        "<h2>Medical transport enquiry</h2><pre>" .
        htmlspecialchars(
            "Name: {$fields["name"]}\nEmail: {$fields["email"]}\nService: {$fields["services"]}\n{$details}",
            ENT_QUOTES,
            "UTF-8",
        ) .
        "</pre>";
    sendEmail(explode(",", ADMIN_EMAILS), "Medical transport enquiry", $body);
} catch (Throwable $exception) {
    error_log(
        "Ashoka Rescue: enquiry accepted; email notification unavailable.",
    );
}
inquiryResponse(
    true,
    "Thank you. Your request has been received. For urgent assistance, please call our medical coordination desk.",
);
