<?php
/**
 * Database Connection File
 * Establishes MySQLi connection to the database
 */

require_once __DIR__ . '/config.php';

$conn = null;
try {
    mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);
    $conn = mysqli_init();
    $conn->options(MYSQLI_OPT_CONNECT_TIMEOUT, 2);
    $conn->real_connect(DB_HOST, DB_USER, DB_PASS, DB_NAME);
    $conn->set_charset('utf8mb4');
} catch (Throwable $exception) {
    $conn = null;
    error_log('Ashoka Rescue: database connection unavailable.');
}

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

    if (!$conn) {
        throw new RuntimeException('Database temporarily unavailable');
    }

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

    if (!$conn) {
        throw new RuntimeException('Database temporarily unavailable');
    }

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

    if (!$conn) {
        throw new RuntimeException('Database temporarily unavailable');
    }
    return $conn->real_escape_string($string);
}

?>