<?php

header('Content-Type: application/json; charset=utf-8');
header('X-Content-Type-Options: nosniff');

require_once __DIR__ . '/../includes/session.php';
require_once __DIR__ . '/../includes/functions.php';
require_once __DIR__ . '/../includes/ai-knowledge.php';

function conciergeResponse(bool $status, string $message, array $extra = [], int $code = 200): void
{
    http_response_code($code);
    echo json_encode(array_merge(['status' => $status, 'message' => $message], $extra), JSON_UNESCAPED_SLASHES);
    exit;
}

function conciergeNavigationActions(string $message): array
{
    $message = mb_strtolower($message);
    $services = [
        'charter' => ['label' => 'Charter air ambulance', 'url' => SITE_URL . '/services/charter-air-ambulance-service-in-india'],
        'air ambulance' => ['label' => 'Air ambulance', 'url' => SITE_URL . '/services/air-ambulance-services-in-india'],
        'commercial stretcher' => ['label' => 'Commercial stretcher', 'url' => SITE_URL . '/services/commercial-stretcher-service'],
        'business class' => ['label' => 'Business-class assistance', 'url' => SITE_URL . '/services/business-class-medical-assistance'],
        'medical escort' => ['label' => 'Medical escort', 'url' => SITE_URL . '/services/medical-escort-and-transport'],
        'road ambulance' => ['label' => 'Road ambulance', 'url' => SITE_URL . '/services/road-ambulance-service-in-india'],
        'train ambulance' => ['label' => 'Train ambulance', 'url' => SITE_URL . '/services/train-ambulance-service-in-india'],
        'neonate' => ['label' => 'Neonatal transport', 'url' => SITE_URL . '/services/neonate-medical-transport-service'],
        'paediatric' => ['label' => 'Paediatric transport', 'url' => SITE_URL . '/services/paediatric-medical-transport-service'],
        'medical tourism' => ['label' => 'Medical tourism', 'url' => SITE_URL . '/services/medical-tourism-india'],
    ];

    foreach ($services as $keyword => $action) {
        if (strpos($message, $keyword) !== false) {
            return [$action, ['label' => 'Plan this transfer', 'action' => 'transfer']];
        }
    }

    if (preg_match('/\b(how.*work|process|steps|arrange)\b/', $message)) {
        return [
            ['label' => 'Start transfer request', 'action' => 'transfer'],
            ['label' => 'Read FAQs', 'url' => SITE_URL . '/faqs'],
            ['label' => 'Contact the team', 'url' => SITE_URL . '/contact'],
        ];
    }

    if (preg_match('/\b(service|option|what do you|explore|transport)\b/', $message)) {
        return [
            $services['air ambulance'],
            $services['commercial stretcher'],
            $services['medical escort'],
            ['label' => 'View all services', 'url' => SITE_URL . '/services'],
        ];
    }

    if (preg_match('/\b(transfer|book|arrange|patient|quote|price|cost)\b/', $message)) {
        return [
            ['label' => 'Start transfer request', 'action' => 'transfer'],
            ['label' => 'View services', 'url' => SITE_URL . '/services'],
        ];
    }

    return [
        ['label' => 'Explore services', 'url' => SITE_URL . '/services'],
        ['label' => 'Start transfer request', 'action' => 'transfer'],
    ];
}

function conciergeAllServiceActions(): array
{
    $actions = [];
    $seenUrls = [];
    foreach (getServices() as $service) {
        $title = trim(strip_tags((string) ($service['title'] ?? '')));
        $slug = trim((string) ($service['slug'] ?? ''));
        if ($title === '' || $slug === '') {
            continue;
        }

        $url = getServiceURL($slug);
        if (isset($seenUrls[$url])) {
            continue;
        }
        $seenUrls[$url] = true;
        $actions[] = ['label' => $title, 'url' => $url];
    }

    $actions[] = ['label' => 'View services overview', 'url' => SITE_URL . '/services'];
    $actions[] = ['label' => 'Help me choose', 'action' => 'transfer'];

    return $actions;
}

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    conciergeResponse(false, 'Invalid request method.', [], 405);
}

$payload = json_decode(file_get_contents('php://input'), true);
if (!is_array($payload) || !validateCSRFToken((string) ($payload['csrf_token'] ?? ''))) {
    conciergeResponse(false, 'Your session expired. Refresh the page and try again.', [], 403);
}

$now = time();
$requests = array_values(array_filter($_SESSION['ai_concierge_requests'] ?? [], static fn($time) => $time > $now - 60));
if (count($requests) >= 12) {
    conciergeResponse(false, 'Please wait a moment before sending another message.', [], 429);
}
$requests[] = $now;
$_SESSION['ai_concierge_requests'] = $requests;

$action = (string) ($payload['action'] ?? 'message');

if ($action === 'lead') {
    $fields = [];
    foreach (['origin', 'destination', 'travel_date', 'service', 'patient_needs', 'name', 'phone', 'email'] as $field) {
        $fields[$field] = trim(strip_tags((string) ($payload[$field] ?? '')));
    }

    if ($fields['origin'] === '' || $fields['destination'] === '' || $fields['name'] === '' || $fields['phone'] === '') {
        conciergeResponse(false, 'Please complete the route, name, and phone fields.', [], 422);
    }
    if (empty($payload['consent'])) {
        conciergeResponse(false, 'Please confirm that we may contact you.', [], 422);
    }
    if ($fields['email'] !== '' && !filter_var($fields['email'], FILTER_VALIDATE_EMAIL)) {
        conciergeResponse(false, 'Please enter a valid email address.', [], 422);
    }

    $details = implode("\n", array_filter([
        'AI concierge enquiry',
        'Route: ' . $fields['origin'] . ' to ' . $fields['destination'],
        $fields['travel_date'] !== '' ? 'Timing: ' . $fields['travel_date'] : '',
        'Preference: ' . ($fields['service'] ?: 'Not sure'),
        $fields['patient_needs'] !== '' ? 'Mobility/support needs: ' . $fields['patient_needs'] : '',
        'Phone: ' . $fields['phone'],
    ]));
    $email = $fields['email'] !== '' ? $fields['email'] : 'callback@ashokarescue.com';
    $result = executeUpdate(
        'INSERT INTO contact_quotes (name, email, services, details, created_at, updated_at) VALUES (?, ?, ?, ?, NOW(), NOW())',
        'ssss',
        [$fields['name'], $email, $fields['service'] ?: 'Transfer assistance', $details]
    );

    if ($result === false) {
        conciergeResponse(false, 'We could not save the enquiry. Please call our team instead.', ['phone' => EMERGENCY_PHONE], 500);
    }

    conciergeResponse(true, 'Your enquiry has been sent. Our coordination team will contact you shortly.', ['lead_id' => $result]);
}

$message = trim(strip_tags((string) ($payload['message'] ?? '')));
if ($message === '' || mb_strlen($message) > 1000) {
    conciergeResponse(false, 'Enter a question of up to 1,000 characters.', [], 422);
}

$lowerMessage = mb_strtolower($message);
$serviceListIntent = preg_match('/\b(all|your|show|list|available|offer|provide|explore)\b.*\b(service|services|options)\b|\b(service|services|options)\b.*\b(all|your|show|list|available|offer|provide|explore)\b/', $lowerMessage);
if ($serviceListIntent) {
    conciergeResponse(true, 'Here are the medical transport services currently listed on the Ashoka Rescue website. Select any service to open its details, or choose “Help me choose” to start a guided transfer request.', [
        'mode' => 'website',
        'source' => 'Ashoka Rescue services',
        'actions' => conciergeAllServiceActions(),
    ]);
}

$emergencyPattern = '/\b(not breathing|unconscious|cardiac arrest|severe bleeding|cannot breathe|can.t breathe|life[ -]threatening|emergency now)\b/i';
if (preg_match($emergencyPattern, $message)) {
    conciergeResponse(true, 'This may need immediate emergency help. Contact your local emergency services now. You can also call the Ashoka Rescue emergency desk at ' . EMERGENCY_PHONE . '.', [
        'urgent' => true,
        'actions' => [['label' => 'Call emergency desk', 'url' => 'tel:' . str_replace(' ', '', EMERGENCY_PHONE)]],
    ]);
}

$websiteAnswer = searchAiWebsiteContent($message);
if ($websiteAnswer === null) {
    $websiteAnswer = getAiWebsiteAnswer($message);
}
if ($websiteAnswer !== null) {
    conciergeResponse(true, $websiteAnswer['message'], [
        'mode' => 'website',
        'actions' => $websiteAnswer['actions'],
        'source' => $websiteAnswer['source'] ?? null,
    ]);
}

$navigationActions = conciergeNavigationActions($message);

if (GEMINI_API_KEY === '') {
    $lowerMessage = mb_strtolower($message);
    if (preg_match('/\b(price|cost|quote|charge|fare)\b/', $lowerMessage)) {
        $reply = 'Pricing depends on the route, timing, transport type, and required support. Our team must review those details before providing a quote. I can help you prepare a callback request.';
    } elseif (preg_match('/\b(compare|difference|which option)\b/', $lowerMessage)) {
        $reply = "A dedicated air ambulance offers a private aircraft and medical setup. A commercial stretcher uses an approved stretcher area on a scheduled flight. Business-class assistance supports eligible seated travellers, while a medical escort accompanies a patient during travel. Road and train options may suit selected routes. The team must confirm suitability after reviewing the case.";
    } elseif (preg_match('/\b(how.*work|process|steps)\b/', $lowerMessage)) {
        $reply = 'Start by sharing the route, timing, mobility, and support needs. The assistant structures those details, then an Ashoka Rescue coordinator reviews the case, discusses appropriate options, and confirms availability, arrangements, and pricing with you.';
    } elseif (preg_match('/commercial.*stretcher|stretcher.*commercial/', $lowerMessage)) {
        $reply = 'Commercial stretcher service is for eligible patients travelling on a scheduled airline using a specially arranged stretcher area, with appropriate escort support. Airline approval, route, timing, and patient requirements must be reviewed before the team can confirm this option.';
    } elseif (preg_match('/business.?class/', $lowerMessage)) {
        $reply = 'Business-class medical assistance supports eligible patients who can travel in a premium cabin but need planned mobility or medical escort support. The airline and Ashoka Rescue team must review the case before confirming suitability.';
    } elseif (preg_match('/medical escort/', $lowerMessage)) {
        $reply = 'A medical escort accompanies an eligible patient during travel and helps coordinate the journey. The required professional and support level depend on the case and are confirmed after review.';
    } elseif (preg_match('/train ambulance/', $lowerMessage)) {
        $reply = 'Train ambulance coordination can support selected long-distance transfers by rail with an arranged care team and equipment. Route, berth availability, timing, and patient needs must be reviewed first.';
    } elseif (preg_match('/road ambulance/', $lowerMessage)) {
        $reply = 'Road ambulance coordination covers local or intercity patient transfers, including connections to airports, railway stations, and hospitals. The team confirms the appropriate vehicle and support after reviewing the case.';
    } elseif (preg_match('/air ambulance|charter/', $lowerMessage)) {
        $reply = 'Charter air ambulance uses a dedicated aircraft arranged for a medically supported transfer. It can support domestic or international routes, subject to case review, aircraft availability, clearances, and the required medical setup.';
    } elseif (preg_match('/\b(service|option|ambulance|stretcher|escort|train|road|flight|air)\b/', $lowerMessage)) {
        $reply = 'We coordinate charter air ambulance, commercial stretcher, business-class assistance, medical escort, road ambulance, and train ambulance transfers. The team will confirm which options are suitable and available for the case.';
    } elseif (preg_match('/\b(transfer|book|arrange|patient|travel)\b/', $lowerMessage)) {
        $reply = 'I can help prepare the enquiry. Please share the starting city, destination, preferred date or urgency, and any mobility or in-transit support needs. The coordination team will review and confirm the next step.';
    } else {
        $reply = 'I can explain Ashoka Rescue transport options or help prepare a transfer enquiry. For case-specific medical, price, or availability decisions, our coordination team will review the details with you.';
    }
    conciergeResponse(true, $reply, ['mode' => 'guided', 'actions' => $navigationActions]);
}

$history = [];
foreach (array_slice((array) ($payload['history'] ?? []), -6) as $item) {
    $role = ($item['role'] ?? '') === 'assistant' ? 'model' : 'user';
    $text = trim(strip_tags((string) ($item['text'] ?? '')));
    if ($text !== '') {
        $history[] = ['role' => $role, 'parts' => [['text' => mb_substr($text, 0, 1000)]]];
    }
}
$history[] = ['role' => 'user', 'parts' => [['text' => $message]]];

$requestBody = [
    'systemInstruction' => ['parts' => [['text' => getAiConciergeSystemInstruction()
        . "\n\nAPPROVED KNOWLEDGE:\n" . getAiConciergeKnowledge()
        . "\n\nCURRENT SERVICE CONTENT FROM THE WEBSITE:\n" . getAiServiceKnowledgeFromWebsite()]]],
    'contents' => $history,
    'generationConfig' => ['temperature' => 0.2, 'maxOutputTokens' => 220],
];

$ch = curl_init('https://generativelanguage.googleapis.com/v1beta/models/' . rawurlencode(GEMINI_MODEL) . ':generateContent');
curl_setopt_array($ch, [
    CURLOPT_POST => true,
    CURLOPT_RETURNTRANSFER => true,
    CURLOPT_CONNECTTIMEOUT => 5,
    CURLOPT_TIMEOUT => 12,
    CURLOPT_HTTPHEADER => ['Content-Type: application/json', 'x-goog-api-key: ' . GEMINI_API_KEY],
    CURLOPT_POSTFIELDS => json_encode($requestBody),
]);
$rawResponse = curl_exec($ch);
$httpCode = (int) curl_getinfo($ch, CURLINFO_HTTP_CODE);
$curlError = curl_error($ch);
curl_close($ch);

if ($rawResponse === false || $httpCode < 200 || $httpCode >= 300) {
    error_log('AI concierge provider error: HTTP ' . $httpCode . ($curlError ? ' ' . $curlError : ''));
    conciergeResponse(true, 'I can help prepare a transfer enquiry. Share the route, preferred timing, and transport needs, or request a callback from our coordination team.', ['mode' => 'fallback', 'actions' => $navigationActions]);
}

$decoded = json_decode($rawResponse, true);
$reply = trim((string) ($decoded['candidates'][0]['content']['parts'][0]['text'] ?? ''));
if ($reply === '') {
    conciergeResponse(true, 'Our coordination team can help with this. Please request a callback or call ' . EMERGENCY_PHONE . '.', ['mode' => 'fallback', 'actions' => $navigationActions]);
}

conciergeResponse(true, $reply, ['mode' => 'ai', 'actions' => $navigationActions]);
