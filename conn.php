<?php

// Database configuration
$host = "srv1020.hstgr.io"; // Hostname
$username = "u212553073_driveplyr"; // Username
$password = "3[!9LW0BHr"; // Password
$database = "u212553073_driveplyr"; // Database name

// Create a database connection
$conn = new mysqli($host, $username, $password, $database);

// Check the connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Set the character set to UTF-8 (optional)
$conn->set_charset("utf8");

// Close the connection (optional - usually not needed as PHP automatically closes the connection)
// $conn->close();

?>
