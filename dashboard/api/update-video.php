<?php
session_start();
include '../../conn.php';

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
$description = $_POST['description'];
$allowDownload = isset($_POST['allow_download']) ? 1 : 0;
$posterURL = $_POST['poster_url'];


// Extract the user ID from the session
$userID = $_SESSION['id'];

// Update the video details in the database
echo $updateSql = "UPDATE videos SET url = '$url', title = '$title', description = '$description', allow_download = $allowDownload, poster_url = '$posterURL' WHERE id = $id AND user = $userID";

if ($conn->query($updateSql) === TRUE) {
    // Video details updated successfully
    header('Location: ../edit.php?id=' . $id);
} else {
    echo "Error updating video details: " . $conn->error;
}
?>