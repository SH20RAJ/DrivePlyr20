<?php
// Allow cross-origin requests
header("Access-Control-Allow-Origin: *"); // Replace '*' with the specific origin(s) you want to allow

// Set content type to JSON
header("Content-Type: application/json");

include "../conn.php";
include "../func.php";

$limit = isset($_GET['limit']) ? $_GET['limit'] : 20; // Set the limit to 20 results
$sql = isset($_GET['sql']) ? $_GET['sql'] : "SELECT videos.*, users.name,users.username
        FROM videos
        INNER JOIN users ON videos.user = users.id
        ORDER BY RAND()
        LIMIT $limit";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    $rows = array();
    while ($row = $result->fetch_assoc()) {
        $rows[] = $row;
    }
    echo json_encode($rows, JSON_PRETTY_PRINT);
} else {
    // No results found
    echo json_encode(array("message" => "No results found"), JSON_PRETTY_PRINT);
}
?>
