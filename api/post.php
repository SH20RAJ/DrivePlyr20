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

    // Perform further actions with the user details as needed
    // For this example, we'll simply echo the data

    // Echo the individual data fields as a response to the client
    echo 'Email: ' . $email . '<br>';
    echo 'Full Name: ' . $fullName . '<br>';
    echo 'Profile Picture: ' . $profilePicture . '<br>';

    // Send a response to the client
    echo json_encode(array('success' => true, 'message' => 'Data received successfully.'));
} else {
    // Invalid request method
    echo json_encode(array('success' => false, 'message' => 'Invalid request method.'));
}
?>
