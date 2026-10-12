<?php
/**
 * Admin Logout
 */

require_once __DIR__ . '/../includes/session.php';

// Destroy session
session_destroy();

// Redirect to login
header('Location: login.php');
exit;
?>