<?php
// Check if the request method is POST
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Get all POST data and store it in an array
    $postData = $_POST;

    // Convert the array to JSON and echo it
    echo json_encode($postData);
} else {
    // Invalid request method
    echo json_encode(array('error' => 'Invalid request method.'));
}
?>
