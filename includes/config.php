<?php
/**
 * Configuration File
 * Contains all site-wide configuration settings
 */

// Error Reporting (set to 0 in production)
error_reporting(E_ALL);
ini_set('display_errors', 1);

// Timezone
date_default_timezone_set('Asia/Kolkata');

// Optional local secrets file. This file is ignored by Git.
$localSecrets = [];
$localSecretsPath = __DIR__ . '/secrets.local.php';
if (is_readable($localSecretsPath)) {
    $loadedSecrets = require $localSecretsPath;
    if (is_array($loadedSecrets)) {
        $localSecrets = $loadedSecrets;
    }
}

// Database Configuration
$requestHost = $_SERVER['HTTP_HOST'] ?? '';
$isLocalEnvironment = preg_match('/^(localhost|127\.0\.0\.1)(:\d+)?$/i', $requestHost) === 1;

if ($isLocalEnvironment) {
    define('DB_HOST', getenv('DB_HOST') ?: '127.0.0.1');
    define('DB_USER', getenv('DB_USER') ?: 'root');
    define('DB_PASS', getenv('DB_PASS') !== false ? getenv('DB_PASS') : '');
    define('DB_NAME', getenv('DB_NAME') ?: 'ashokrtech_cms');
} else {
    define('DB_HOST', '158.106.137.11');
    define('DB_USER', 'ashokrtech_ashokrtech');
    define('DB_PASS', 'ashokrtech123');
    define('DB_NAME', 'ashokrtech_cms');
}

// Site Configuration - Dynamic URL Detection
$protocol = (!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] !== 'off' || $_SERVER['SERVER_PORT'] == 443) ? "https://" : "http://";
$host = $_SERVER['HTTP_HOST'];
$projectRoot = dirname(__DIR__);
$docRoot = rtrim($_SERVER['DOCUMENT_ROOT'], '/');
$relativePath = str_replace($docRoot, '', $projectRoot);

// Ensure relative path is clean
$relativePath = '/' . ltrim($relativePath, '/');

$siteUrl = $protocol . $host . $relativePath;

define('SITE_URL', rtrim($siteUrl, '/'));
define('SITE_NAME', 'Ashoka Rescue Air Ambulance Services');
define('SITE_EMAIL', 'ashokarescue@gmail.com');

// Email Configuration (SMTP)
define('SMTP_HOST', 'mail.ashokarescue.com');
define('SMTP_PORT', 465);
define('SMTP_USERNAME', 'contact@ashokarescue.com');
define('SMTP_PASSWORD', 'Qhmpl@4036');
define('SMTP_FROM_EMAIL', 'contact@ashokarescue.com');
define('SMTP_FROM_NAME', 'ashokarescue');

// Admin Email Recipients
define('ADMIN_EMAILS', 'ops@ashokarescue.com,ashokarescue@gmail.com,techproenq@gmail.com');

// Upload Configuration
define('UPLOAD_PATH', __DIR__ . '/../assets/uploads/');
define('UPLOAD_URL', SITE_URL . '/assets/uploads/');
define('MAX_FILE_SIZE', 5242880); // 5MB in bytes
define('ALLOWED_IMAGE_TYPES', ['image/jpeg', 'image/png', 'image/jpg', 'image/gif']);

// Session Configuration
define('SESSION_LIFETIME', 3600); // 1 hour in seconds
define('SESSION_NAME', 'ashoka_rescue_session');

// Security
define('CSRF_TOKEN_NAME', 'csrf_token');
define('PASSWORD_MIN_LENGTH', 6);

// Pagination
define('ITEMS_PER_PAGE', 20);

// Asset Paths
define('CSS_PATH', SITE_URL . '/assets/css/');
define('JS_PATH', SITE_URL . '/assets/js/');
define('IMG_PATH', SITE_URL . '/assets/images/');

// Blog URL (external WordPress blog)
define('BLOG_URL', rtrim($siteUrl, '/') . '/blog');

// Google Analytics
define('GA_TRACKING_ID', 'G-59J8TPZ0XB');
define('AW_TRACKING_ID', 'AW-16692834342');

// WhatsApp Link
define('WHATSAPP_LINK', 'https://wa.link/g90d9x');

// Emergency Contact
define('EMERGENCY_PHONE', '+91 9810 36 4143');

// AI Concierge (keep the API key in the server environment, never in source control)
define('AI_CONCIERGE_ENABLED', filter_var(getenv('AI_CONCIERGE_ENABLED') ?: 'true', FILTER_VALIDATE_BOOLEAN));
define('GEMINI_API_KEY', getenv('GEMINI_API_KEY') ?: ($localSecrets['gemini_api_key'] ?? ''));
define('GEMINI_MODEL', getenv('GEMINI_MODEL') ?: 'gemini-2.5-flash-lite');

// Company Details
define('COMPANY_NAME', 'Ashoka Rescue Air Ambulance Services Pvt. Ltd.');
define('COMPANY_ADDRESS', 'UG 124, Ansal Palam Corporate Plaza, Palam Vihar, Gurgaon Haryana (India) - 122017');
define('COMPANY_LATITUDE', '28.5146969');
define('COMPANY_LONGITUDE', '77.0348848');

// Social Media Links
define('FACEBOOK_URL', 'https://www.facebook.com/ashokarescue');
define('INSTAGRAM_URL', 'https://www.instagram.com/ashoka_rescue/');
define('LINKEDIN_URL', 'https://www.linkedin.com/company/ashoka-rescue/');
define('YOUTUBE_URL', 'https://www.youtube.com/@ashokarescue8111?si=gUj6iVZZuU-nNJPA');

// Google Review Link
define('GOOGLE_REVIEW_URL', 'https://www.google.com/search?q=ashokarescue&oq=ashokarescue&gs_lcrp=EgZjaHJvbWUyBggAEEUYOTIGCAEQRRg8MhIIAhAuGA0YrwEYxwEYgAQYjgUyCggDEAAYgAQYogQyCggEEAAYgAQYogQyCggFEAAYgAQYogQyCggGEAAYgAQYogQyBggHEEUYPdIBCDM3OTNqMGo3qAIAsAIA&sourceid=chrome&ie=UTF-8#lrd=0x390cfd309eebed77:0x164e92a2202ddf78,3,,,,');

?>
