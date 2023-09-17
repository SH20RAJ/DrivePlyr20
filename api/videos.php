<?php

// Allow cross-origin requests
header("Access-Control-Allow-Origin: *"); // Replace '*' with the specific origin(s) you want to allow

// Set content type to JSON
header("Content-Type: application/json");

include "../conn.php";
include "../func.php";


$sql = $_GEt['sql'];
$limit = isset($_GET['limit'])?$_GET['limit']:20;
$sql = isset($sql) ? $sql : "SELECT * FROM videos ORDER BY RAND() LIMIT ".$limit."";

$result = $conn->query($sql);

if ($result->num_rows > 0) {
    // Loop through each video and generate the table rows
    $row = $result->fetch_assoc();

    echo json_encode($row);
}


