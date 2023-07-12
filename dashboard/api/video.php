<?php
include '../../conn.php';

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

// Get the video details
$video = $result->fetch_assoc();


// Return the video as a JSON response
header('Content-Type: application/json');
echo json_encode($video);
?>
