<?php
// API endpoint URL
$url = 'https://getintotouch.sh20raj.com/api.php?id=1479193538';

// Data to send in the POST request
$data = array(
    'New User Registration on DrivePlyr' => 'sh20raj',
    'param2' => 'value2',
    // Add more parameters and their values as needed
);

// Initialize cURL session
$curl = curl_init();

// Set the cURL options
curl_setopt($curl, CURLOPT_URL, $url);
curl_setopt($curl, CURLOPT_POST, 1);
curl_setopt($curl, CURLOPT_POSTFIELDS, http_build_query($data));
curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);

// Execute cURL session and store the response
$response = curl_exec($curl);

// Check for cURL errors
if (curl_errno($curl)) {
    echo 'cURL Error: ' . curl_error($curl);
}

// Close cURL session
curl_close($curl);

// Output the API response
echo $response;
?>
