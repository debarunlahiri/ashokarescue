<?php
/**
 * API Endpoint - Submit Contact Quote (Form 3)
 * Handles contact form submissions from contact.php
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

if (empty($services)) {
    $errors[] = 'Service selection is required';
}

if (!empty($errors)) {
    echo json_encode(['status' => false, 'message' => implode(', ', $errors)]);
    exit;
}

// Insert into database
$query = "INSERT INTO contact_quotes (name, email, services, details, created_at, updated_at) 
          VALUES (?, ?, ?, ?, NOW(), NOW())";

$result = executeUpdate($query, 'ssss', [$name, $email, $services, $details]);

if ($result) {
    // Send email notification
    $adminEmails = explode(',', ADMIN_EMAILS);

    $emailSubject = 'New Contact Form Submission - Ashoka Rescue';
    $emailBody = "
        <h2>New Contact Form Submission</h2>
        <p><strong>Name:</strong> {$name}</p>
        <p><strong>Email:</strong> {$email}</p>
        <p><strong>Service:</strong> {$services}</p>
        <p><strong>Message:</strong><br>{$details}</p>
        <p><strong>Submitted:</strong> " . date('Y-m-d H:i:s') . "</p>
    ";

    sendEmail($adminEmails, $emailSubject, $emailBody);

    echo json_encode([
        'status' => true,
        'message' => 'Thank you for contacting us! We will get back to you soon.'
    ]);
} else {
    echo json_encode([
        'status' => false,
        'message' => 'Failed to submit form. Please try again.'
    ]);
}
?>