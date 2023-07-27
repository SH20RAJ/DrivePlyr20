<?php
// Check if the request method is POST
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Get the JSON data sent from the client-side
    $jsonData = file_get_contents('php://input');

    // Convert the JSON data to an associative array
    $data = json_decode($jsonData, true);

    // Validate data (you should implement proper validation based on your requirements)
    $email = $data['email'] ?? '';
    $fullName = $data['fullName'] ?? '';
    $profilePicture = $data['profilePicture'] ?? '';
}

?>
