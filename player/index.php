<?php


 $url = $_GET['x']);


// Fetch the HTML content
$response = file_get_contents($url);

if ($response === false) {
    $error = error_get_last();
    echo "Error: " . $error['message'];
} else {
    // Display the HTML content
    echo $response;
}
?>
