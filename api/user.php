<?php
include '../conn.php';
include '../func.php';
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
// Query to select all data from the users table except the password column
$sql = "SELECT * FROM users where id = $id";
$result = $conn->query($sql);

if ($result) {
    $data = array();
    
    // Fetch the data and remove the password column
    while ($row = $result->fetch_assoc()) {
        unset($row['password']);
        $data[] = $row;
    }

    // Encode the data as JSON
    $data = json_encode($data, JSON_PRETTY_PRINT);


// Set the HTTP header to specify JSON content
header('Content-Type: application/json');

// Output the JSON data with indentation for readability
echo json_encode(json_decode($data), JSON_PRETTY_PRINT);


