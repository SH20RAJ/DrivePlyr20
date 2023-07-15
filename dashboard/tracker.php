<?php
// Database configuration
$host = "srv1020.hstgr.io"; // Hostname
$username = "u212553073_driveplyr"; // Username
$password = "3[!9LW0BHr"; // Password
$database = "u212553073_driveplyr"; // Database name

// Create a database connection
$conn = new mysqli($host, $username, $password, $database);

// Check the connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Set the character set to UTF-8 (optional)
$conn->set_charset("utf8");


// Function to get user IP address
function getIPAddress() {
    if (!empty($_SERVER['HTTP_CLIENT_IP'])) {
        $ip = $_SERVER['HTTP_CLIENT_IP'];
    } elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {
        $ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
    } else {
        $ip = $_SERVER['REMOTE_ADDR'];
    }
    return $ip;
}

// Function to get current timestamp
function getCurrentTimestamp() {
    return date('Y-m-d H:i:s');
}

// Function to get user session ID
function getUserSessionID() {
    if (session_status() === PHP_SESSION_NONE) {
        session_start();
    }
    if (!isset($_SESSION['id'])) {
        $_SESSION['id'] = session_id();
    }
    return $_SESSION['id'];
}

// Retrieve user IP address and timestamp
echo $userIP = getIPAddress();
$timestamp = getCurrentTimestamp();

// Retrieve additional tracking information
$userAgent = $_SERVER['HTTP_USER_AGENT'];
echo $referringPage = 'r4fhfi'; //isset($_SERVER['HTTP_REFERER']) ? $_SERVER['HTTP_REFERER'] : '';
$currentURL = $_SERVER['REQUEST_URI'];

// Retrieve user session ID
echo $userSessionID = getUserSessionID();

// Insert user activity into the database
$insertStmt = $conn->prepare("INSERT INTO user_activity (ip_address, timestamp, user_agent, referring_page, current_url, session_id) VALUES (?, ?, ?, ?, ?, ?)");
$insertStmt->bind_param("ssssss", $userIP, $timestamp, $userAgent, $referringPage, $currentURL, $userSessionID);

if ($insertStmt->execute()) {
    // Activity recorded successfully
    echo "Activity recorded.";
} else {
    echo "Error: " . $insertStmt->error;
}

// Close the prepared statement
$insertStmt->close();

// Close the database connection
$conn->close();
?>
