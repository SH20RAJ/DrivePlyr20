<?php

include '../../conn.php';
// Check connection
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}

// Get all the tables in the database
$tables = $conn->query("SHOW TABLES");

// Create a SQL script to export the database
$sql_script = "";
while ($table = $tables->fetch_assoc()) {
  $sql_script .= "DROP TABLE IF EXISTS `" . $table['Tables_name'] . "`;\n";
  $sql_script .= $conn->query("SHOW CREATE TABLE `" . $table['Tables_name'] . "`")->fetch_assoc()['Create Table'];
  $sql_script .= "\n\n";
}

// Save the SQL script to a file
$file_name = $database_name . "_backup_" . time() . ".sql";
$file_handler = fopen($file_name, 'w+');
fwrite($file_handler, $sql_script);
fclose($file_handler);

// Download the SQL backup file to the browser
header('Content-Description: File Transfer');
header('Content-Type: application/octet-stream');
header('Content-Disposition: attachment; filename=' . $file_name);
readfile($file_name);

// Close the database connection
$conn->close();

?>
