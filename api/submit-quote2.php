<?php
/**
 * API Endpoint - Submit Home Footer Quote (Form 2)
 * Handles quote form submissions from home page footer section
 */

header('Content-Type: application/json');

require_once __DIR__ . '/../includes/session.php';
require_once __DIR__ . '/../includes/functions.php';

// Check if POST request
if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    echo json_encode(['status' => false, 'message' => 'Invalid request method']);
    exit;
}

// Validate CSRF token
if (!isset($_POST['csrf_token']) || !validateCSRFToken($_POST['csrf_token'])) {
    echo json_encode(['status' => false, 'message' => 'Invalid security token']);
    exit;
}

// Sanitize and validate input
$name = isset($_POST['name']) ? sanitizeInput($_POST['name']) : '';
$email = isset($_POST['email']) ? sanitizeInput($_POST['email']) : '';
$phone = isset($_POST['phone']) ? sanitizeInput($_POST['phone']) : '';
$home_contact = isset($_POST['home_contact']) ? sanitizeInput($_POST['home_contact']) : '';
$services = isset($_POST['services']) ? sanitizeInput($_POST['services']) : '';
$details = isset($_POST['details']) ? sanitizeInput($_POST['details']) : '';

// Validation
$errors = [];

if (empty($name)) {
    $errors[] = 'Name is required';
}

if (empty($email) || !isValidEmail($email)) {
    $errors[] = 'Valid email is required';
}

if (empty($phone)) {
    $errors[] = 'Phone number is required';
}

if (empty($services)) {
    $errors[] = 'Service selection is required';
}

if (!empty($errors)) {
    echo json_encode(['status' => false, 'message' => implode(', ', $errors)]);
    exit;
}

// Insert into database
$query = "INSERT INTO home_footer_quotes (name, email, phone, home_contact, services, details, created_at, updated_at) 
          VALUES (?, ?, ?, ?, ?, ?, NOW(), NOW())";

$result = executeUpdate($query, 'ssssss', [$name, $email, $phone, $home_contact, $services, $details]);

if ($result) {
    // Send email notification
    $adminEmails = explode(',', ADMIN_EMAILS);

    $emailSubject = 'New Footer Quote Request - Ashoka Rescue';
    $emailBody = "
        <h2>New Quote Request from Footer</h2>
        <p><strong>Name:</strong> {$name}</p>
        <p><strong>Email:</strong> {$email}</p>
        <p><strong>Phone:</strong> {$phone}</p>
        <p><strong>Home Contact:</strong> {$home_contact}</p>
        <p><strong>Service:</strong> {$services}</p>
        <p><strong>Details:</strong><br>{$details}</p>
        <p><strong>Submitted:</strong> " . date('Y-m-d H:i:s') . "</p>
    ";

    sendEmail($adminEmails, $emailSubject, $emailBody);

    echo json_encode([
        'status' => true,
        'message' => 'Thank you! Your quote request has been submitted. We will contact you soon.'
    ]);
} else {
    echo json_encode([
        'status' => false,
        'message' => 'Failed to submit quote. Please try again.'
    ]);
}
?>