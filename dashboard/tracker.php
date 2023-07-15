<?php
// Include the database connection file
require_once '../conn.php';

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
$userIP = getIPAddress();
$timestamp = getCurrentTimestamp();

// Retrieve additional tracking information
$userAgent = $_SERVER['HTTP_USER_AGENT'];
$referringPage = isset($_SERVER['HTTP_REFERER']) ? $_SERVER['HTTP_REFERER'] : '';
$currentURL = $_SERVER['REQUEST_URI'];

// Retrieve user session ID
$userSessionID = getUserSessionID();

// Prepare the SQL statement
$sql = "INSERT INTO tracker (ip_address, timestamp, user_agent, referring_page, current_url, session_id) VALUES (?, ?, ?, ?, ?, ?)";
$stmt = $conn->prepare($sql);
$stmt->bind_param("ssssss", $userIP, $timestamp, $userAgent, $referringPage, $currentURL, $userSessionID);

// Execute the prepared statement
if ($stmt->execute()) {
    // Activity recorded successfully
    echo "Activity recorded.";
} else {
    echo "Error: " . $stmt->error;
}

// Close the prepared statement and database connection
$stmt->close();
$conn->close();
?>
