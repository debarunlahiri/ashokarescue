<?php
/** Fetch Google Places reviews without exposing credentials or storing review content. */
declare(strict_types=1);
require_once __DIR__ . "/../includes/config.php";
header("Content-Type: application/json; charset=utf-8");
header("Cache-Control: no-store, private");

function reviewsResponse(array $payload, int $status = 200): never
{
    http_response_code($status);
    echo json_encode(
        $payload,
        JSON_UNESCAPED_UNICODE | JSON_INVALID_UTF8_SUBSTITUTE,
    );
    exit();
}

if ($_SERVER["REQUEST_METHOD"] !== "GET") {
    header("Allow: GET");
    reviewsResponse(["status" => false], 405);
}
$apiKey =
    getenv("GOOGLE_PLACES_API_KEY") ?:
    $localSecrets["google_places_api_key"] ?? "";
$placeId =
    getenv("GOOGLE_PLACES_PLACE_ID") ?:
    $localSecrets["google_places_place_id"] ?? "";
if (
    !$apiKey ||
    !$placeId ||
    !preg_match('/^[A-Za-z0-9_-]{5,255}$/', $placeId) ||
    !function_exists("curl_init")
) {
    reviewsResponse(
        [
            "status" => false,
            "message" =>
                "Google reviews are currently unavailable. Please read reviews on Google.",
        ],
        503,
    );
}

$curl = curl_init(
    "https://places.googleapis.com/v1/places/" .
        rawurlencode($placeId) .
        "?languageCode=en",
);
curl_setopt_array($curl, [
    CURLOPT_RETURNTRANSFER => true,
    CURLOPT_CONNECTTIMEOUT => 3,
    CURLOPT_TIMEOUT => 8,
    CURLOPT_FOLLOWLOCATION => false,
    CURLOPT_HTTPHEADER => [
        "Accept: application/json",
        "X-Goog-Api-Key: " . $apiKey,
        "X-Goog-FieldMask: reviews,rating,userRatingCount,googleMapsUri,attributions",
    ],
]);
$body = curl_exec($curl);
$status = curl_getinfo($curl, CURLINFO_HTTP_CODE);
curl_close($curl);
if ($body === false || $status !== 200) {
    error_log(
        "Ashoka Rescue: Google reviews request unavailable; HTTP " . $status,
    );
    reviewsResponse(
        [
            "status" => false,
            "message" =>
                "Google reviews are currently unavailable. Please read reviews on Google.",
        ],
        502,
    );
}
$place = json_decode($body, true);
if (!is_array($place) || isset($place["error"])) {
    reviewsResponse(["status" => false], 502);
}

$reviews = [];
foreach ($place["reviews"] ?? [] as $review) {
    $text = $review["text"]["text"] ?? ($review["originalText"]["text"] ?? "");
    $author = $review["authorAttribution"] ?? [];
    if (!is_string($text) || !is_string($author["displayName"] ?? null)) {
        continue;
    }
    $reviews[] = [
        "text" => $text,
        "author" => $author["displayName"],
        "authorUrl" => $author["uri"] ?? "",
        "avatar" => $author["photoUri"] ?? "",
        "rating" => $review["rating"] ?? null,
        "date" => $review["relativePublishTimeDescription"] ?? "",
        "url" => $review["googleMapsUri"] ?? ($place["googleMapsUri"] ?? ""),
    ];
}
reviewsResponse([
    "status" => true,
    "reviews" => $reviews,
    "rating" => $place["rating"] ?? null,
    "count" => $place["userRatingCount"] ?? null,
    "url" => $place["googleMapsUri"] ?? "",
    "attributions" => array_map(
        static fn(array $attribution): array => [
            "name" => $attribution["provider"] ?? "",
            "url" => $attribution["providerUri"] ?? "",
        ],
        $place["attributions"] ?? [],
    ),
]);
