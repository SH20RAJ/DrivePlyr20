<?php
include '../../conn.php';

// Get the video ID from the URL parameter
$id = $_GET['id'];

// Fetch the video information from the database
$sql = "SELECT * FROM videos WHERE id = $id";
$result = $conn->query($sql);

// Check if the video exists
if ($result->num_rows === 0) {
    echo "Video not found";
    exit;
}

// Get the video details
$video = $result->fetch_assoc();
$url = $video['url'];
if(isset($_GET['poster'])){header('Location: '.$video['poster_url'].'');exit();}

 if (strpos($url, 'drive.google.com') !== false) {
        //return 'drive';
    } elseif (strpos($url, 'mediafire.com') !== false) {
       // return 'mediafire';
    } elseif (strpos($url, 'youtube.com') !== false || strpos($url, 'youtu.be') !== false) {
       // return 'youtube';
    } elseif (strpos($url, 'vimeo.com') !== false) {
        //return 'vimeo';
    } elseif (strpos($url, 'archive.org') !== false) {
        //return 'archive.org';
    } else {
        //return 'unknown';
        header('Location: '.$url.'');
        exit();
    }   





?>
