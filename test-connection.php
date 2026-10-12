<?php
// Database connection test file
// DELETE THIS FILE AFTER TESTING

error_reporting(E_ALL);
ini_set('display_errors', 1);

echo "<h1>Database Connection Test</h1>";

// Test 1: PHP Version
echo "<h2>1. PHP Version</h2>";
echo "PHP Version: " . phpversion() . "<br>";

// Test 2: Database credentials
echo "<h2>2. Database Configuration</h2>";
define('DB_HOST', '158.106.137.11');
define('DB_USER', 'ashokrtech_ashokrtech');
define('DB_PASS', 'ashokrtech123');
define('DB_NAME', 'ashokrtech_cms');

echo "Host: " . DB_HOST . "<br>";
echo "User: " . DB_USER . "<br>";
echo "Database: " . DB_NAME . "<br>";

// Test 3: MySQLi extension
echo "<h2>3. MySQLi Extension</h2>";
if (extension_loaded('mysqli')) {
    echo "✓ MySQLi extension is loaded<br>";
} else {
    echo "✗ MySQLi extension is NOT loaded<br>";
}

// Test 4: Database connection
echo "<h2>4. Database Connection Test</h2>";
try {
    $conn = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);

    if ($conn->connect_error) {
        echo "✗ Connection failed: " . $conn->connect_error . "<br>";
    } else {
        echo "✓ Database connection successful!<br>";
        echo "Server info: " . $conn->server_info . "<br>";
        $conn->close();
    }
} catch (Exception $e) {
    echo "✗ Exception: " . $e->getMessage() . "<br>";
}

// Test 5: File paths
echo "<h2>5. File Paths</h2>";
echo "Current file: " . __FILE__ . "<br>";
echo "Document root: " . $_SERVER['DOCUMENT_ROOT'] . "<br>";
echo "Script name: " . $_SERVER['SCRIPT_NAME'] . "<br>";

// Test 6: Check if includes directory exists
echo "<h2>6. Directory Check</h2>";
$includesPath = __DIR__ . '/includes';
if (is_dir($includesPath)) {
    echo "✓ Includes directory exists<br>";
    echo "Path: " . $includesPath . "<br>";
} else {
    echo "✗ Includes directory NOT found<br>";
}

echo "<hr>";
echo "<p style='color: red;'><strong>IMPORTANT: Delete this file after testing!</strong></p>";
?>
