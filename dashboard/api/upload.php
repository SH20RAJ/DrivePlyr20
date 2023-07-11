<?php
session_start();
if(!isset($_SESSION)){
    echo "Not Allowed";
}
// Get the form data
$user = $_SESSION['user'];
$url = $_POST['url'];
$hosting = $_POST['hosting'];
$title = $_POST['title'];
$description = $_POST['description'];
$allow_download = $_POST['allow_download'];

// Connect to the database
$db = new PDO('mysql:host=localhost;dbname=videos', 'root', '');

// Insert the data into the database
$sql = "INSERT INTO videos (user, url, hosting, title, description, allow_download) VALUES ('$user', '$url', '$hosting', '$title', '$description', $allow_download)";
$stmt = $db->prepare($sql);
$stmt->execute();

// Redirect the user to the home page
header('Location: /');

?>
