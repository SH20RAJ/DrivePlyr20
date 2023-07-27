<?php
// ref.php

// Check if the "ref" parameter is provided in the URL
if (isset($_GET['ref'])) {
    // Retrieve the "ref" parameter value
    $refValue = $_GET['ref'];

    // Get user IP address
    $userIP = $_SERVER['REMOTE_ADDR'];

    // Get current timestamp
    $timestamp = time();

    // Get user agent (browser) details
    $userAgent = $_SERVER['HTTP_USER_AGENT'];


    // SQL query to insert data into the 'ref' table
    $sql = "INSERT INTO ref (ref_value, user_ip, timestamp, user_agent) VALUES ('$refValue', '$userIP', '$timestamp', '$userAgent')";

    if ($conn->query($sql)) {
        // Data inserted successfully
        echo "Data recorded successfully!";
    } else {
        // Error in inserting data
        echo "Error recording data: " . $conn->error;
    }

    // Close the database connection
    $conn->close();
} else {
    // If the "ref" parameter is not provided, display an error message
    echo "No 'ref' parameter provided.";
}
?>
