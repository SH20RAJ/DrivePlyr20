<?php
// Check if the request method is POST
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Get the JSON data sent from the client-side
    $jsonData = file_get_contents('php://input');

    // Convert the JSON data to an associative array
    $data = json_decode($jsonData, true);

    // Validate data (you should implement proper validation based on your requirements)

    // Perform further actions with the user details as needed
    // For this example, we'll simply log the data
    // Replace this with your desired logic, such as saving the data to a database
    // or using it for user authentication

    // Log the received data
    print_r($data, true);

    // Send a response to the client
} else {
    // Invalid request method
}
?>
