<?php

if(isset($_GET['pass'])){
  $pass= $_GET['pass'];
} else {
  $pass= "";

}

// URL for the GET request
$url = "https://terabox-dl.qtcloud.workers.dev/api/get-info?shorturl=1".$_GET['id']."&pwd=".$pass;

// Make the GET request and get the JSON response
$response = file_get_contents($url);

// Check if the response is not empty
if (!empty($response)) {
    // Decode the JSON response into an associative array
    $responseData = json_decode($response, true);

    // Set the Content-Type header to JSON
    //header('Content-Type: application/json');

    // Output the JSON response
    //echo json_encode($responseData);
} else {
    echo "Error: No response received.";
}
// API endpoint URL
$url = "https://terabox-dl.qtcloud.workers.dev/api/get-download";

// POST data
$data = array(
    "shareid" => $responseData['shareid'],
    "uk" => $responseData['uk'],
    "sign" => $responseData['sign'],
    "timestamp" => $responseData['timestamp'],
    "fs_id" => $responseData['list'][0]['fs_id']
);

// Initialize cURL session
$ch = curl_init($url);

// Set cURL options for POST request
curl_setopt($ch, CURLOPT_POST, 1);
curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($data));
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_HTTPHEADER, array(
    'Content-Type: application/json'
));

// Execute cURL session
$response = curl_exec($ch);

// Check for cURL errors
if (curl_errno($ch)) {
    echo 'Error: ' . curl_error($ch);
}

// Close cURL session
curl_close($ch);

// Handle the response
if (!empty($response)) {
    $responseData = json_decode($response, true);
   // print_r($responseData);
  // Convert the PHP array to a JSON string
$jsonString = json_encode($responseData, JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE);

// Output the JSON string
echo $jsonString;
} else {
    echo "Error: No response received.";
}
