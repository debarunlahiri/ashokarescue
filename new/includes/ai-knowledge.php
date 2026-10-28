<?php

/**
 * Approved public knowledge for the Ashoka Rescue concierge.
 * Keep this concise and factual. The model must not infer medical suitability,
 * availability, pricing, or capabilities that are not listed here.
 */
function getAiConciergeKnowledge(): string
{
    return <<<'KNOWLEDGE'
Ashoka Rescue coordinates medical transport and patient-transfer assistance.

Approved services:
- Charter air ambulance: a dedicated aircraft arranged for a medically supported domestic or international transfer, subject to case review, aircraft availability, and clearances.
- Commercial airline stretcher: a specially arranged stretcher area on an eligible scheduled flight, subject to airline approval and case review.
- Business-class medical assistance: premium-cabin travel with planned mobility or escort support for eligible patients.
- Medical escort and transport: a suitable medical professional accompanies an eligible patient during travel.
- Road ambulance: local, intercity, airport, railway, and hospital connection transfers with the required support confirmed after review.
- Train ambulance: selected long-distance rail transfers with coordinated care support, subject to berth availability and case review.
- Neonatal and paediatric medical transport coordination
- Medical tourism and hospital-transfer assistance

The coordination team is available 24/7. Every case is reviewed by the Ashoka Rescue team before service suitability, medical arrangements, availability, schedule, or price is confirmed.

Published website facts:
- Ashoka Rescue says it transports ICU and coma patients after reviewing vital stability, haemoglobin, oxygen requirements, and the treating doctor's information.
- Air-ambulance arrangements can include ventilators, oxygen, advanced life support equipment, monitoring, and critical-care medical crew.
- Air ambulances can fly at night when both airports have the required night-landing, immigration, and ground-handling facilities.
- A charter air ambulance can typically carry two family attendants, subject to aircraft, route, equipment, and case requirements.
- Bed-to-bed service coordinates the connected journey from the current bed to the destination bed using the required ground and air or rail services.

For a transfer enquiry, collect only what is needed: origin, destination, preferred date or urgency, service preference, the patient's mobility or current support needs, hospital details when relevant, and the caller's name and phone or email.

Never diagnose, interpret symptoms, determine fitness to travel, recommend treatment, guarantee availability, or quote a price. For an immediate or life-threatening situation, tell the visitor to contact local emergency services first and offer Ashoka Rescue's emergency desk at +91 9810 36 4143.
KNOWLEDGE;
}

function getAiServiceKnowledgeFromWebsite(): string
{
    if (!function_exists('getServices')) {
        return '';
    }

    $lines = [];
    foreach (getServices() as $service) {
        $title = trim(strip_tags((string) ($service['title'] ?? '')));
        $content = trim(preg_replace('/\s+/', ' ', strip_tags((string) ($service['content'] ?? ''))));
        if ($title === '' || $content === '') {
            continue;
        }
        $lines[] = '- ' . $title . ': ' . mb_substr($content, 0, 350);
    }

    return implode("\n", array_slice($lines, 0, 20));
}

function getAiSearchTokens(string $text): array
{
    $text = mb_strtolower(html_entity_decode($text, ENT_QUOTES | ENT_HTML5, 'UTF-8'));
    preg_match_all('/[a-z0-9]+/u', $text, $matches);
    $stopWords = ['a', 'an', 'and', 'are', 'as', 'at', 'be', 'can', 'do', 'does', 'for', 'from', 'how', 'i', 'in', 'is', 'it', 'me', 'my', 'of', 'on', 'or', 'our', 'the', 'this', 'to', 'we', 'what', 'when', 'where', 'which', 'who', 'with', 'you', 'your'];

    return array_values(array_unique(array_filter($matches[0], static function ($word) use ($stopWords) {
        return strlen($word) > 2 && !in_array($word, $stopWords, true);
    })));
}

function getAiWebsiteSearchIndex(): array
{
    static $index = null;
    if ($index !== null) {
        return $index;
    }

    $index = [];
    $root = dirname(__DIR__);
    $faqSource = @file_get_contents($root . '/faqs.php');
    if ($faqSource !== false) {
        preg_match_all(
            '/<button[^>]*class="accordion-button[^"]*"[^>]*>(.*?)<\/button>.*?<div class="accordion-body">(.*?)<\/div>/si',
            $faqSource,
            $faqMatches,
            PREG_SET_ORDER
        );
        foreach ($faqMatches as $match) {
            $question = trim(preg_replace('/\s+/', ' ', strip_tags($match[1])));
            $answer = trim(preg_replace('/\s+/', ' ', strip_tags($match[2])));
            if ($question !== '' && $answer !== '') {
                $index[] = ['title' => $question, 'content' => $answer, 'url' => SITE_URL . '/faqs', 'type' => 'faq'];
            }
        }
    }

    if (function_exists('getServices')) {
        foreach (getServices() as $service) {
            $title = trim(strip_tags((string) ($service['title'] ?? '')));
            $content = trim(preg_replace('/\s+/', ' ', strip_tags((string) ($service['content'] ?? ''))));
            $slug = trim((string) ($service['slug'] ?? ''));
            if ($title !== '' && $content !== '' && $slug !== '') {
                $index[] = ['title' => $title, 'content' => $content, 'url' => SITE_URL . '/services/' . $slug, 'type' => 'service'];
            }
        }
    }

    $pageFiles = array_merge(
        glob($root . '/*.php') ?: [],
        glob($root . '/services/*.php') ?: []
    );
    foreach ($pageFiles as $pageFile) {
        $source = @file_get_contents($pageFile);
        if ($source === false || !preg_match('/\$pageTitle\s*=\s*[\'\"](.+?)[\'\"]\s*;/', $source, $titleMatch)) {
            continue;
        }

        $title = trim(stripcslashes($titleMatch[1]));
        $contentParts = [];
        if (preg_match('/\$pageDescription\s*=\s*[\'\"](.+?)[\'\"]\s*;/', $source, $descriptionMatch)) {
            $contentParts[] = stripcslashes($descriptionMatch[1]);
        }
        if (preg_match('/[\'\"]main_content[\'\"]\s*=>\s*[\'\"](.*?)[\'\"]\s*,\s*(?:\r?\n|[\'\"])/s', $source, $mainContentMatch)) {
            $contentParts[] = stripcslashes($mainContentMatch[1]);
        }

        $inlineHtml = preg_replace('/<\?php.*?\?>/s', ' ', $source);
        $inlineText = trim(preg_replace('/\s+/', ' ', strip_tags((string) $inlineHtml)));
        if ($inlineText !== '') {
            $contentParts[] = mb_substr($inlineText, 0, 12000);
        }

        $content = trim(preg_replace('/\s+/', ' ', strip_tags(implode(' ', $contentParts))));
        if ($content === '') {
            continue;
        }

        $relative = str_replace($root . '/', '', $pageFile);
        if ($relative === 'index.php') {
            $url = SITE_URL;
        } elseif (strpos($relative, 'services/') === 0) {
            $url = SITE_URL . '/services/' . basename($relative, '.php');
        } else {
            $url = SITE_URL . '/' . basename($relative, '.php');
        }
        $index[] = ['title' => $title, 'content' => $content, 'url' => $url, 'type' => 'page'];
    }

    return $index;
}

function getAiRelevantExcerpt(string $content, array $tokens): string
{
    $sentences = preg_split('/(?<=[.!?])\s+/', trim($content)) ?: [];
    $ranked = [];
    foreach ($sentences as $sentence) {
        $score = 0;
        $lower = mb_strtolower($sentence);
        foreach ($tokens as $token) {
            if (strpos($lower, $token) !== false) {
                $score++;
            }
        }
        if ($score > 0 && mb_strlen($sentence) >= 25) {
            $ranked[] = ['score' => $score, 'text' => trim($sentence)];
        }
    }
    usort($ranked, static fn($a, $b) => $b['score'] <=> $a['score']);
    $excerpt = implode(' ', array_column(array_slice($ranked, 0, 2), 'text'));

    return mb_substr($excerpt !== '' ? $excerpt : $content, 0, 700);
}

function searchAiWebsiteContent(string $message): ?array
{
    $tokens = getAiSearchTokens($message);
    if ($tokens === []) {
        return null;
    }

    $results = [];
    foreach (getAiWebsiteSearchIndex() as $entry) {
        $title = mb_strtolower($entry['title']);
        $content = mb_strtolower($entry['content']);
        $score = 0;
        foreach ($tokens as $token) {
            if (strpos($title, $token) !== false) {
                $score += 5;
            }
            $score += min(substr_count($content, $token), 3);
        }
        if ($score > 0) {
            $entry['score'] = $score;
            $results[] = $entry;
        }
    }

    usort($results, static fn($a, $b) => $b['score'] <=> $a['score']);
    $best = $results[0] ?? null;
    if ($best === null || $best['score'] < 5) {
        return null;
    }

    $answer = $best['type'] === 'faq'
        ? $best['content']
        : 'According to our ' . $best['title'] . ' page: ' . getAiRelevantExcerpt($best['content'], $tokens);

    return [
        'message' => $answer,
        'actions' => [
            ['label' => 'Read ' . ($best['type'] === 'faq' ? 'the FAQs' : 'this page'), 'url' => $best['url']],
            ['label' => 'Discuss a transfer', 'action' => 'transfer'],
        ],
        'source' => $best['title'],
    ];
}

function getAiConciergeSystemInstruction(): string
{
    return <<<'INSTRUCTION'
You are the Ashoka Rescue transfer concierge. Answer only from the approved knowledge supplied below. Be calm, concise, and practical. Use no more than 90 words unless a short list is genuinely clearer.

You are not a doctor. Do not diagnose, give treatment advice, assess fitness to travel, interpret symptoms, promise a price or availability, or invent service capabilities. If asked for any of those, explain that the coordination or medical team must confirm it. If the message suggests immediate danger, tell the visitor to contact local emergency services now, then provide the emergency-desk number.

When the visitor wants to arrange a transfer, ask for one or two missing details at a time. Do not ask for full medical records or identity documents. Encourage them to use the secure enquiry form in the assistant when enough details are available.
INSTRUCTION;
}

/**
 * Answers backed directly by facts already published on this website.
 * These take precedence over generic guided replies and model generation.
 */
function getAiWebsiteAnswer(string $message): ?array
{
    $message = mb_strtolower($message);

    if (preg_match('/\b(coma|unconscious)\b/', $message)) {
        return [
            'message' => 'Ashoka Rescue states that it transports ICU and coma patients, including patients with brain haemorrhage or hypoxic brain injury. The team first reviews vital stability, haemoglobin, oxygen requirements, and the treating doctor’s information before deciding whether air ambulance or a commercial stretcher with medical escort may be appropriate. Final fitness and transport arrangements require medical-team and airline review.',
            'actions' => [
                ['label' => 'Critical-patient transport', 'url' => SITE_URL . '/services/transporting-critical-patients-with-advanced-life-saving-equipment'],
                ['label' => 'Read the FAQs', 'url' => SITE_URL . '/faqs'],
                ['label' => 'Discuss this transfer', 'action' => 'transfer'],
            ],
        ];
    }

    if (preg_match('/\b(ventilator|life support|icu equipment)\b/', $message)) {
        return [
            'message' => 'According to the Ashoka Rescue service pages, its air-ambulance and critical-patient transport arrangements can include ventilators, oxygen, monitoring, and advanced life-support equipment with a critical-care crew. The exact equipment and crew must be selected after the team reviews the patient’s current support requirements.',
            'actions' => [
                ['label' => 'Air ambulance details', 'url' => SITE_URL . '/services/air-ambulance-services-in-india'],
                ['label' => 'Critical-patient transport', 'url' => SITE_URL . '/services/transporting-critical-patients-with-advanced-life-saving-equipment'],
                ['label' => 'Start transfer request', 'action' => 'transfer'],
            ],
        ];
    }

    if (preg_match('/\b(fly at night|night flight|at night)\b/', $message)) {
        return [
            'message' => 'The website says air ambulances can operate at night when the departure and arrival airports have suitable night-landing, immigration, and ground-handling facilities. The coordination team must confirm the route and airport permissions for the requested journey.',
            'actions' => [
                ['label' => 'Read the FAQs', 'url' => SITE_URL . '/faqs'],
                ['label' => 'Plan this route', 'action' => 'transfer'],
            ],
        ];
    }

    if (preg_match('/\b(attendant|family member|relative).*\b(fly|come|travel)|how many.*\b(attendant|family)/', $message)) {
        return [
            'message' => 'The website states that a charter air ambulance can typically accommodate two patient family members, alongside the medical crew and pilots. Capacity can vary with aircraft, route, medical equipment, and patient requirements, so the team must confirm it for the specific case.',
            'actions' => [
                ['label' => 'Charter air ambulance', 'url' => SITE_URL . '/services/charter-air-ambulance-service-in-india'],
                ['label' => 'Ask about a journey', 'action' => 'transfer'],
            ],
        ];
    }

    if (preg_match('/bed.?to.?bed/', $message)) {
        return [
            'message' => 'Bed-to-bed coordination means arranging the connected journey from the patient’s current bed to the destination bed. Depending on the case, that may combine ground ambulances with an air ambulance, commercial stretcher, or medical escort so the handovers are coordinated.',
            'actions' => [
                ['label' => 'Explore services', 'url' => SITE_URL . '/services'],
                ['label' => 'Plan a bed-to-bed transfer', 'action' => 'transfer'],
            ],
        ];
    }

    return null;
}
