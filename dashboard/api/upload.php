<?php
session_start();
include '../../conn.php';

// Check if the user is logged in
if (!isset($_SESSION['username'])) {
    echo "Not Allowed";
} else {
    // Get the form data
    $user = $_SESSION['id'];
    $url = $_POST['url'];
    $hosting = $_POST['hosting'];
    $title = $_POST['title'];
    $description = $_POST['description'];
    $allow_download = isset($_POST['allow_download']) ? 1 : 0;
    $poster_url = $_POST['poster_url'];

    // Insert the data into the database
    $sql = "INSERT INTO videos (user, url, hosting, title, description, allow_download, poster_url) VALUES (?, ?, ?, ?, ?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("sssssds", $user, $url, $hosting, $title, $description, $allow_download, $poster_url);
    $stmt->execute();

    // Redirect the user to the home page or a success page
    header('Location: ../videos.php');
    exit();
}
?>
