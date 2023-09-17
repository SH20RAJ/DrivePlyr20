<?php
// Allow cross-origin requests
header("Access-Control-Allow-Origin: *"); // Replace '*' with the specific origin(s) you want to allow

// Set content type to JSON
header("Content-Type: application/json");

include "../conn.php";
include "../func.php";

$limit = isset($_GET['limit']) ? $_GET['limit']:20; // Set limit to 1 to get only one result
$sql = isset($_GET['sql']) ? $_GET['sql'] : "SELECT * FROM videos ORDER BY RAND() LIMIT " . $limit;

$result = $conn->query($sql);

if ($result->num_rows > 0) {
    // Fetch and encode the first row as JSON
    $row = $result->fetch_assoc();
    echo json_encode($row);
} else {
    // No results found
    echo json_encode(array("message" => "No results found"));
}
?>
