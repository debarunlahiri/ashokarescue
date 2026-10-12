<?php
/**
 * API Endpoint - Submit Home Quote (Form 1)
 * Handles quote form submissions from home page hero section
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
$email = isset($_POST['email']) ? sanitizeInput($_POST['email']) : '';
$departing_from = isset($_POST['departing_from']) ? sanitizeInput($_POST['departing_from']) : '';
$destination = isset($_POST['destination']) ? sanitizeInput($_POST['destination']) : '';
$services = isset($_POST['services']) ? sanitizeInput($_POST['services']) : '';
$date = isset($_POST['date']) ? sanitizeInput($_POST['date']) : '';
$contact_no = isset($_POST['contact_no']) ? sanitizeInput($_POST['contact_no']) : '';

// Validation
$errors = [];

if (empty($email) || !isValidEmail($email)) {
    $errors[] = 'Valid email is required';
}

if (empty($departing_from)) {
    $errors[] = 'Departing location is required';
}

if (empty($destination)) {
    $errors[] = 'Destination is required';
}

if (empty($services)) {
    $errors[] = 'Service selection is required';
}

if (empty($contact_no)) {
    $errors[] = 'Contact number is required';
}

if (!empty($errors)) {
    echo json_encode(['status' => false, 'message' => implode(', ', $errors)]);
    exit;
}

// Insert into database
$query = "INSERT INTO home_quotes (email, departing_from, destination, services, date, contact_no, created_at, updated_at) 
          VALUES (?, ?, ?, ?, ?, ?, NOW(), NOW())";

$result = executeUpdate($query, 'ssssss', [$email, $departing_from, $destination, $services, $date, $contact_no]);

if ($result) {
    // Send email notification
    $adminEmails = explode(',', ADMIN_EMAILS);

    $emailSubject = 'New Home Quote Request - Ashoka Rescue';
    $emailBody = "
        <h2>New Quote Request from Home Page</h2>
        <p><strong>Email:</strong> {$email}</p>
        <p><strong>Departing From:</strong> {$departing_from}</p>
        <p><strong>Destination:</strong> {$destination}</p>
        <p><strong>Service:</strong> {$services}</p>
        <p><strong>Date:</strong> {$date}</p>
        <p><strong>Contact Number:</strong> {$contact_no}</p>
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