<?php
include 'conn.php';
include 'func.php';
// Allow cross-origin requests
header("Access-Control-Allow-Origin: *"); // Replace '*' with the specific origin(s) you want to allow

// Set content type to JSON
header("Content-Type: application/json");
// Get the video ID from the URL parameter
$id = $_GET['id'];


// Check if the ID is valid (you should also validate and sanitize user input)
if (!is_numeric($id)) {
    echo "Invalid video ID";
    exit;
}

// Fetch the video information from the database using prepared statements to prevent SQL injection
$sql = "SELECT videos.*, users.name, users.username
        FROM videos
        INNER JOIN users ON videos.user = users.id
        WHERE videos.id = ?";

$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $id);
$stmt->execute();
$result = $stmt->get_result();

// Check if the video exists
if ($result->num_rows === 0) {
    echo "Video not found";
    exit;
}

// Get the video data as an associative array
$row = $result->fetch_assoc();

// Encode the data as JSON
$data = json_encode($row);



// Output the JSON data with indentation for readability
echo json_encode(json_decode($data), JSON_PRETTY_PRINT);
?>
