<?php
session_start();
include '../../conn.php';
if(!isset($_SESSION)){
    echo "Not Allowed";
} else {
    print_r($_SESSION);die();
// Get the form data
$user = 2;//$_SESSION['user'];
$url = $_POST['url'];
$hosting = $_POST['hosting'];
$title = $_POST['title'];
$description = $_POST['description'];
$allow_download = $_POST['allow_download'];

// Connect to the database
//$db = new PDO('mysql:host=localhost;dbname=videos', 'root', '');

// Insert the data into the database
$sql = "INSERT INTO videos (user, url, hosting, title, description, allow_download) VALUES ('$user', '$url', '$hosting', '$title', '$description', $allow_download)";
$stmt = $conn->prepare($sql);
$stmt->execute();

// Redirect the user to the home page
header('Location: /');

}


?>
