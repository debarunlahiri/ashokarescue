<?php
/**
 * Database Connection File
 * Establishes MySQLi connection to the database
 */

require_once __DIR__ . '/config.php';

// Create connection
$conn = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Set charset to utf8mb4
$conn->set_charset("utf8mb4");

/**
 * Execute a prepared statement query
 * @param string $query SQL query with placeholders
 * @param string $types Parameter types (s=string, i=integer, d=double, b=blob)
 * @param array $params Parameters to bind
 * @return mysqli_result|bool
 */
function executeQuery($query, $types = '', $params = [])
{
    global $conn;

    $stmt = $conn->prepare($query);
    if (!$stmt) {
        error_log("Prepare failed: " . $conn->error);
        return false;
    }

    if (!empty($types) && !empty($params)) {
        $stmt->bind_param($types, ...$params);
    }

    $stmt->execute();
    $result = $stmt->get_result();
    $stmt->close();

    return $result;
}

/**
 * Execute an INSERT/UPDATE/DELETE query
 * @param string $query SQL query with placeholders
 * @param string $types Parameter types
 * @param array $params Parameters to bind
 * @return int|bool Insert ID for INSERT, affected rows for UPDATE/DELETE, false on failure
 */
function executeUpdate($query, $types = '', $params = [])
{
    global $conn;

    $stmt = $conn->prepare($query);
    if (!$stmt) {
        error_log("Prepare failed: " . $conn->error);
        return false;
    }

    if (!empty($types) && !empty($params)) {
        $stmt->bind_param($types, ...$params);
    }

    $success = $stmt->execute();

    if (!$success) {
        error_log("Execute failed: " . $stmt->error);
        $stmt->close();
        return false;
    }

    // Return insert ID for INSERT queries, affected rows for others
    if (stripos($query, 'INSERT') === 0) {
        $result = $stmt->insert_id;
    } else {
        $result = $stmt->affected_rows;
    }

    $stmt->close();
    return $result;
}

/**
 * Escape string for SQL (use prepared statements instead when possible)
 * @param string $string
 * @return string
 */
function escapeString($string)
{
    global $conn;
    return $conn->real_escape_string($string);
}

?>