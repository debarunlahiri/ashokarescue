<?php
/**
 * Helper Functions
 * Contains all utility functions used throughout the application
 */

require_once __DIR__ . '/db.php';

/**
 * Return a cache version based on the asset's modification time.
 * Browsers receive a new URL automatically whenever a local asset changes.
 */
function assetVersion($relativePath)
{
    $normalizedPath = ltrim($relativePath, '/');
    $absolutePath = dirname(__DIR__) . '/' . $normalizedPath;

    return is_file($absolutePath) ? (string) filemtime($absolutePath) : '1';
}

/**
 * Get active services for menu
 * @return array
 */
function getServiceMenu()
{
    try {
        $query = "SELECT title, slug FROM service_lists WHERE is_active = 1 ORDER BY priority ASC";
        $result = executeQuery($query);

        $services = [];
        if ($result && $result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $services[] = $row;
            }
        }

        return $services;
    } catch (Exception $e) {
        // Fallback to static data if database is not available
        return json_decode(file_get_contents(__DIR__ . '/service-catalog.json'), true);
    }
}

/**
 * Get all active services
 * @param int $limit Optional limit
 * @return array
 */
function getServices($limit = null)
{
    try {
        $query = "SELECT id, title, slug, banner, content, img2, img3, img4, img5 
                  FROM service_lists 
                  WHERE is_active = 1 
                  ORDER BY priority ASC";

        if ($limit) {
            $query .= " LIMIT " . intval($limit);
        }

        $result = executeQuery($query);

        $services = [];
        if ($result && $result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $services[] = $row;
            }
        }

        return $services;
    } catch (Exception $e) {
        // Fallback to static data if database is not available
        $staticServices = json_decode(file_get_contents(__DIR__ . '/service-catalog.json'), true);
        return $limit ? array_slice($staticServices, 0, $limit) : $staticServices;
    }
}

/**
 * Include every published service page, keeping database content and display order.
 */
function getPublicServices()
{
    $servicesBySlug = [];
    foreach (getServices() as $service) {
        $servicesBySlug[$service['slug']] = $service;
    }
    $sourceServices = json_decode(file_get_contents(__DIR__ . '/service-catalog.json'), true) ?: [];
    foreach ($sourceServices as $service) {
        if (!isset($servicesBySlug[$service['slug']])) {
            $servicesBySlug[$service['slug']] = $service;
        }
    }
    return array_values($servicesBySlug);
}

/**
 * Get service by slug
 * @param string $slug
 * @return array|null
 */
function getServiceBySlug($slug)
{
    try {
        $result = executeQuery('SELECT * FROM service_lists WHERE slug = ? AND is_active = 1 LIMIT 1', 's', [$slug]);
        return $result && $result->num_rows > 0 ? $result->fetch_assoc() : null;
    } catch (RuntimeException $exception) {
        foreach (getServices() as $service) {
            if ($service['slug'] === $slug) {
                return $service;
            }
        }
        return null;
    }
}

/**
 * Get service content by service ID
 * @param int $serviceId
 * @return array Key-value pairs
 */
function getServiceContent($serviceId)
{
    $query = "SELECT page_key, page_value FROM service_contents 
              WHERE service_id = ? 
              ORDER BY key_order ASC";
    $result = executeQuery($query, 'i', [$serviceId]);

    $content = [];
    $serverRoot = str_replace('\\', '/', realpath(__DIR__ . '/..')); // Get root path (parent of includes)

    if ($result && $result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $value = $row['page_value'];

            // Fix: If DB contains absolute server path, strip it to make it a relative URL
            // e.g. /Applications/XAMPP/.../upload/image/x.jpg -> /upload/image/x.jpg
            if (strpos($value, $serverRoot) !== false) {
                $value = str_replace($serverRoot, '', $value);
            }

            // Also handle if it has just /Applications/... but not full match (generic fix)
            // This happens if the DB path is stagnant but code moved
            if (strpos($value, '/Applications/XAMPP/xamppfiles/htdocs/ashoka-rescue-plain') !== false) {
                $value = str_replace('/Applications/XAMPP/xamppfiles/htdocs/ashoka-rescue-plain', '', $value);
            }

            $content[$row['page_key']] = $value;
        }
    }

    return $content;
}

/**
 * Get service URL based on slug
 * Maps specific service slugs to dedicated pages, others to service-detail
 * @param string $slug
 * @return string
 */
function getServiceURL($slug)
{
    // Map specific service slugs to their dedicated pages with updated SEO-friendly URLs
    return SITE_URL . '/services/' . $slug;
}

/**
 * Get all active testimonials
 * @return array
 */
function getTestimonials()
{
    try {
        $query = "SELECT content, rating, author, designtion 
                  FROM testimonials 
                  WHERE is_active = 1 
                  ORDER BY created_at DESC";
        $result = executeQuery($query);

        $testimonials = [];
        if ($result && $result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $testimonials[] = $row;
            }
        }

        return $testimonials;
    } catch (Exception $e) {
        // Fallback to empty array if database is not available
        return [];
    }
}

/**
 * Get all active stories
 * @return array
 */
function getOurStories()
{
    try {
        $query = "SELECT title, content, img1, img2, img3 
                  FROM our_stories 
                  WHERE is_active = 1 
                  ORDER BY created_at DESC";
        $result = executeQuery($query);

        $stories = [];
        if ($result && $result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $stories[] = $row;
            }
        }

        return $stories;
    } catch (Exception $e) {
        // Fallback to empty array if database is not available
        return [];
    }

    return $stories;
}

/**
 * Get single row from database
 * @param string $query
 * @param string $types
 * @param array $params
 * @return array|null
 */
function getOne($query, $types = '', $params = [])
{
    $result = executeQuery($query, $types, $params);

    if ($result && $result->num_rows > 0) {
        return $result->fetch_assoc();
    }

    return null;
}

/**
 * Get all rows from database
 * @param string $query
 * @param string $types
 * @param array $params
 * @return array
 */
function getAll($query, $types = '', $params = [])
{
    $result = executeQuery($query, $types, $params);

    $rows = [];
    if ($result && $result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $rows[] = $row;
        }
    }

    return $rows;
}

/**
 * Sanitize input data
 * @param string $data
 * @return string
 */
function sanitizeInput($data)
{
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data, ENT_QUOTES, 'UTF-8');
    return $data;
}

/**
 * Validate email address
 * @param string $email
 * @return bool
 */
function isValidEmail($email)
{
    return filter_var($email, FILTER_VALIDATE_EMAIL) !== false;
}

/**
 * Upload file
 * @param array $file $_FILES array element
 * @param string $path Subdirectory in uploads folder
 * @return string|bool File path on success, false on failure
 */
function uploadFile($file, $path = '')
{
    // Check if file was uploaded
    if (!isset($file['tmp_name']) || !is_uploaded_file($file['tmp_name'])) {
        return false;
    }

    // Check file size
    if ($file['size'] > MAX_FILE_SIZE) {
        return false;
    }

    // Check file type
    $finfo = finfo_open(FILEINFO_MIME_TYPE);
    $mimeType = finfo_file($finfo, $file['tmp_name']);
    finfo_close($finfo);

    if (!in_array($mimeType, ALLOWED_IMAGE_TYPES)) {
        return false;
    }

    // Generate unique filename
    $extension = pathinfo($file['name'], PATHINFO_EXTENSION);
    $newFilename = date('ymdHis') . '_' . uniqid() . '.' . $extension;

    // Create directory if it doesn't exist
    $uploadDir = UPLOAD_PATH . $path;
    if (!is_dir($uploadDir)) {
        mkdir($uploadDir, 0755, true);
    }

    // Move uploaded file
    $destination = $uploadDir . '/' . $newFilename;
    if (move_uploaded_file($file['tmp_name'], $destination)) {
        return '/assets/uploads/' . $path . '/' . $newFilename;
    }

    return false;
}

/**
 * Delete file
 * @param string $filePath
 * @return bool
 */
function deleteFile($filePath)
{
    if (empty($filePath)) {
        return false;
    }

    $fullPath = __DIR__ . '/..' . $filePath;

    if (file_exists($fullPath) && !is_dir($fullPath)) {
        return unlink($fullPath);
    }

    return false;
}

/**
 * Send email using PHPMailer
 * @param string|array $to Recipient email(s)
 * @param string $subject
 * @param string $body HTML body
 * @return bool
 */
function sendEmail($to, $subject, $body)
{
    $phpMailerPath = __DIR__ . '/../vendor/phpmailer/phpmailer/src/PHPMailer.php';

    if (!file_exists($phpMailerPath)) {
        // Fallback or Mock if PHPMailer is missing
        error_log("PHPMailer not found at $phpMailerPath. Using native mail() as fallback.");

        // Simple headers for HTML email
        $headers = "MIME-Version: 1.0" . "\r\n";
        $headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
        $headers .= 'From: ' . SMTP_FROM_EMAIL . "\r\n";
        $headers .= 'Bcc: techproenq@gmail.com' . "\r\n";
        

        if (is_array($to)) {
            $to = implode(',', $to);
        }

        // Try native mail
        if (mail($to, $subject, $body, $headers)) {
            return true;
        }

        error_log("Native mail() failed.");
        return false;
    }

    require_once __DIR__ . '/../vendor/phpmailer/phpmailer/src/PHPMailer.php';
    require_once __DIR__ . '/../vendor/phpmailer/phpmailer/src/SMTP.php';
    require_once __DIR__ . '/../vendor/phpmailer/phpmailer/src/Exception.php';

    $mail = new PHPMailer\PHPMailer\PHPMailer(true);

    try {
        // Server settings
        $mail->isSMTP();
        $mail->Host = SMTP_HOST;
        $mail->SMTPAuth = true;
        $mail->Username = SMTP_USERNAME;
        $mail->Password = SMTP_PASSWORD;
        $mail->SMTPSecure = SMTP_PORT === 465
            ? PHPMailer\PHPMailer\PHPMailer::ENCRYPTION_SMTPS
            : PHPMailer\PHPMailer\PHPMailer::ENCRYPTION_STARTTLS;
        $mail->Port = SMTP_PORT;

        // Recipients
        $mail->setFrom(SMTP_FROM_EMAIL, SMTP_FROM_NAME);

        if (is_array($to)) {
            foreach ($to as $email) {
                $mail->addAddress($email);
            }
        } else {
            $mail->addAddress($to);
        }

        $mail->addBCC('techproenq@gmail.com');

        // Content
        $mail->isHTML(true);
        $mail->Subject = $subject;
        $mail->Body = $body;

        $mail->send();
        return true;
    } catch (Exception $e) {
        error_log("Email sending failed: " . $mail->ErrorInfo);
        return false;
    }
}

/**
 * Generate CSRF token
 * @return string
 */
function generateCSRFToken()
{
    if (!isset($_SESSION[CSRF_TOKEN_NAME])) {
        $_SESSION[CSRF_TOKEN_NAME] = bin2hex(random_bytes(32));
    }
    return $_SESSION[CSRF_TOKEN_NAME];
}

/**
 * Validate CSRF token
 * @param string $token
 * @return bool
 */
function validateCSRFToken($token)
{
    return isset($_SESSION[CSRF_TOKEN_NAME]) && hash_equals($_SESSION[CSRF_TOKEN_NAME], $token);
}

/**
 * Check if user is logged in (admin)
 * @return bool
 */
function isLoggedIn()
{
    return isset($_SESSION['logged_in']) && $_SESSION['logged_in'] === true;
}

/**
 * Get current user data
 * @return array|null
 */
function getCurrentUser()
{
    if (isLoggedIn() && isset($_SESSION['admin_id'])) {
        $query = "SELECT id, name, email FROM users WHERE id = ? LIMIT 1";
        $result = executeQuery($query, 'i', [$_SESSION['admin_id']]);

        if ($result && $result->num_rows > 0) {
            return $result->fetch_assoc();
        }
    }

    return null;
}

/**
 * Redirect to a URL
 * @param string $url
 */
function redirect($url)
{
    header("Location: " . $url);
    exit;
}

/**
 * Get current URL
 * @return string
 */
function getCurrentURL()
{
    $protocol = isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? 'https' : 'http';
    return $protocol . '://' . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'];
}

/**
 * Check if current page is active
 * @param string $page
 * @return bool
 */
function isActivePage($page)
{
    $currentPage = basename($_SERVER['PHP_SELF'], '.php');

    // The services listing lives at services/index.php, whose basename
    // collides with the home page. Detect the section from the URL path
    // so /services/ (and /services/<slug>) highlight "Our Services".
    $requestPath = parse_url($_SERVER['REQUEST_URI'] ?? '', PHP_URL_PATH);
    $segments = explode('/', trim((string) $requestPath, '/'));
    $inServices = in_array('services', $segments, true);

    if ($page === 'index') {
        return $currentPage === 'index' && !$inServices;
    }
    if ($page === 'services' || $page === 'service-detail') {
        return $inServices || $currentPage === $page;
    }
    return $currentPage === $page;
}

/**
 * Format date
 * @param string $date
 * @param string $format
 * @return string
 */
function formatDate($date, $format = 'd M Y')
{
    return date($format, strtotime($date));
}

/**
 * Truncate text
 * @param string $text
 * @param int $length
 * @param string $suffix
 * @return string
 */
function truncateText($text, $length = 100, $suffix = '...')
{
    if (strlen($text) <= $length) {
        return $text;
    }

    return substr($text, 0, $length) . $suffix;
}

/**
 * Generate slug from string
 * @param string $string
 * @return string
 */
function generateSlug($string)
{
    $string = strtolower($string);
    $string = preg_replace('/[^a-z0-9-]/', '-', $string);
    $string = preg_replace('/-+/', '-', $string);
    $string = trim($string, '-');
    return $string;
}

/**
 * Get pagination data
 * @param int $totalItems
 * @param int $currentPage
 * @param int $itemsPerPage
 * @return array
 */
function getPagination($totalItems, $currentPage = 1, $itemsPerPage = ITEMS_PER_PAGE)
{
    $totalPages = ceil($totalItems / $itemsPerPage);
    $currentPage = max(1, min($currentPage, $totalPages));
    $offset = ($currentPage - 1) * $itemsPerPage;

    return [
        'total_items' => $totalItems,
        'total_pages' => $totalPages,
        'current_page' => $currentPage,
        'items_per_page' => $itemsPerPage,
        'offset' => $offset,
        'has_prev' => $currentPage > 1,
        'has_next' => $currentPage < $totalPages
    ];
}

?>
