<?php
session_start();
include '../../conn.php';

function sanitizeInput($input) {
    // Use PHP's built-in functions like htmlspecialchars to encode special characters
    return htmlspecialchars(trim($input), ENT_QUOTES, 'UTF-8');
}

// Check if the user is logged in
if (!isset($_SESSION['username'])) {
    echo "Not Allowed";
    exit;
}

// Get the video ID from the URL parameter
$id = $_GET['id'];

// Fetch the video information from the database
$sql = "SELECT * FROM videos WHERE id = $id";
$result = $conn->query($sql);

// Check if the video exists
if ($result->num_rows === 0) {
    echo "Video not found";
    exit;
}

// Get the form data
$url = $_POST['url'];
$title = $_POST['title'];
$description = sanitizeInput($_POST['description']);
$allowDownload = isset($_POST['allow_download']) ? 1 : 0;
$monetization = isset($_POST['monetization']) ? 1 : 0;
$posterURL = $_POST['poster_url'];
$player = $_POST['player'];

// Extract the user ID from the session
$userID = $_SESSION['id'];

// Update the video details in the database
$updateSql = "UPDATE videos SET url = '$url', title = '$title', description = '$description', allow_download = $allowDownload, monetization = $monetization, player = $player poster_url = '$posterURL' WHERE id = $id AND user = $userID";

if ($conn->query($updateSql) === TRUE) {
    // Video details updated successfully
    header('Location: ../edit.php?id=' . $id);
} else {
    echo "Error updating video details: " . $conn->error;
}
?>