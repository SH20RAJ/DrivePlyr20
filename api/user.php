<?php
include '../conn.php';
include '../func.php';
// Set the HTTP header to specify JSON content
header('Content-Type: application/json');

// Get the video ID from the URL parameter
$id = $_GET['id'];


// Check if the ID is valid (you should also validate and sanitize user input)
if (!is_numeric($id)) {
    echo "Invalid video ID";
    exit;
}
// Query to select all data from the users table except the password column
$sql = "SELECT * FROM users where id = $id";
$result = $conn->query($sql);

if ($result) {
    $data = array();
    
    // Fetch the data and remove the password column
    while ($row = $result->fetch_assoc()) {
        unset($row['password']);
        $data[] = $row;
    }

    // Encode the data as JSON
    $jsonResult = json_encode($data, JSON_PRETTY_PRINT);

    // Save JSON to a separate file
    $jsonFilePath = 'users_data.json';
    file_put_contents($jsonFilePath, $jsonResult);

    // Close the database connection
    $conn->close();

    echo "Data has been saved to $jsonFilePath";
} else {
    echo "Error executing query: " . $conn->error;
}




?>
