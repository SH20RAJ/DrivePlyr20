<?php
function getGoogleDriveVideoUrl($url)
{
    $matches = [];
    $pattern = '/https:\/\/drive\.google\.com\/file\/d\/([a-zA-Z0-9_-]+)/';
    preg_match($pattern, $url, $matches);

    if (count($matches) >= 2) {
        $fileId = $matches[1];
        $videoUrl = "https://drive.google.com/uc?export=download&id={$fileId}";
        return $videoUrl;
    }

    return null;
}

// Usage example
$url = $_GET['URL'] ?? ''; // Retrieve the URL parameter

if (!empty($url)) {
    $videoUrl = getGoogleDriveVideoUrl($url);

    if (!is_null($videoUrl)) {
        // Output the video as a video content type
        header("Content-Type: video/mp4");
        readfile($videoUrl);
    } else {
        echo "Invalid Google Drive URL or unable to retrieve video URL.";
    }
} else {
    echo "Please provide a Google Drive URL as a parameter (e.g., ?URL=https://drive.google.com/file/d/VIDEO_ID/).";
}
?>
