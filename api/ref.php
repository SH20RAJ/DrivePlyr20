<?php
// ref.php

// Check if the "ref" parameter was posted
if (isset($_POST['ref'])) {
    // Retrieve the "ref" parameter value
    $refValue = $_POST['ref'];

    // Here you can perform any actions or operations with the "ref" value as needed
    // For example, you can store it in a database, perform some calculations, etc.

    // In this example, we'll just echo the "ref" value as a response to the POST request
    echo json_encode(['status' => 'success', 'ref' => $refValue]);
} else {
    // If the "ref" parameter is not provided, return an error response
    echo json_encode(['status' => 'error', 'message' => 'No "ref" parameter provided']);
}
?>
