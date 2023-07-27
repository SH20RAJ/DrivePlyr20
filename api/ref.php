<?php
// ref.php

// Check if the "ref" parameter is provided in the URL
if (!isset($_GET['ref'])) {
    // Retrieve the "ref" parameter value
    $refValue = $_GET['ref'];

    // Get user IP address
    $userIP = $_SERVER['REMOTE_ADDR'];
    // Get current timestamp
    $timestamp = time();

    // Get user agent (browser) details
    $userAgent = $_SERVER['HTTP_USER_AGENT'];


    // SQL query to insert data into the 'ref' table
    echo $sql = "INSERT INTO ref (ref_value, user_ip, timestamp, user_agent) VALUES ('$refValue', '$userIP', '$timestamp', '$userAgent')";

    $conn->query($sql)
}
?>
