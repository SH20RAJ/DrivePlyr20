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
