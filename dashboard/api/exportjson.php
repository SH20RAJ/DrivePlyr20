<?php

include '../../conn.php';
// Check connection
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}

// Get all the tables in the database
$tables = $conn->query("SHOW TABLES");

// Create a JSON object to export the database
$json_data = [];
while ($table = $tables->fetch_assoc()) {
  $table_data = [];
  $result = $conn->query("SELECT * FROM `" . $table['Tables_name'] . "`");
  while ($row = $result->fetch_assoc()) {
    $table_data[] = $row;
  }
  $json_data[$table['Tables_name']] = $table_data;
}

// Save the JSON object to a file
$file_name = $database_name . "_backup_" . time() . ".json";
$file_handler = fopen($file_name, 'w+');
fwrite($file_handler, json_encode($json_data, JSON_PRETTY_PRINT));
fclose($file_handler);

// Download the JSON backup file to the browser
header('Content-Description: File Transfer');
header('Content-Type: application/octet-stream');
header('Content-Disposition: attachment; filename=' . $file_name);
readfile($file_name);

// Close the database connection
$conn->close();

?>
