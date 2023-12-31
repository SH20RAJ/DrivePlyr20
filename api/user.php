<?php
include '../conn.php';
include '../func.php';
// Allow cross-origin requests
header("Access-Control-Allow-Origin: *"); // Replace '*' with the specific origin(s) you want to allow

// Set content type to JSON
header("Content-Type: application/json");

if(isset($_GET['id'])){
   // Get the video ID from the URL parameter
$id = $_GET['id']; 
// Query to select all data from the users table except the password column
$sql = "SELECT * FROM users where id = $id";
} else {
    $sql = "SELECT * FROM users";
}

$result = $conn->query($sql);

if ($result) {
    $data = array();
    
    // Fetch the data and remove the password column
    while ($row = $result->fetch_assoc()) {
        unset($row['password']);
        $data[] = $row;
    }

    // Encode the data as JSON with pretty printing for readability
    $jsonResult = json_encode($data, JSON_PRETTY_PRINT);

    // Output the JSON data
    echo $jsonResult;
} else {
    echo "Error executing query: " . $conn->error;
}
