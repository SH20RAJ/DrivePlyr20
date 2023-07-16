<?php
$videoUrl = "https://commondatastorage.googleapis.com/gtv-videos-bucket/CastVideos/mp4/BigBuckBunny.mp4";

// Set the appropriate content type header
header('Content-Type: video/mp4');

// Get the file size
$fileSize = filesize($videoUrl);

// Set the content length header
header("Content-Length: $fileSize");

// Proxy the video file
$fp = fopen($videoUrl, 'rb');
while (!feof($fp)) {
    echo fread($fp, 8192);
    flush();
}
fclose($fp);
