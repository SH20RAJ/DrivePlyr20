<?php
function getGoogleDriveVideoUrl($url)
{
    $matches = [];
    $pattern = '/https:\/\/drive\.google\.com\/file\/d\/([a-zA-Z0-9_-]+)\/view/';
    preg_match($pattern, $url, $matches);
    
    if (count($matches) >= 2) {
        $fileId = $matches[1];
        $apiUrl = "https://www.googleapis.com/drive/v3/files/{$fileId}?fields=webViewLink";
        $response = file_get_contents($apiUrl);
        
        if ($response !== false) {
            $data = json_decode($response, true);
            
            if (isset($data['webViewLink'])) {
                return $data['webViewLink'];
            }
        }
    }
    
    return null;
}

// Usage example
$url = $_GET['URL'] ?? ''; // Retrieve the URL parameter

if (!empty($url)) {
    $videoUrl = getGoogleDriveVideoUrl($url);
    
    if (!is_null($videoUrl)) {
        echo "Video URL: $videoUrl";
    } else {
        echo "Invalid Google Drive URL or unable to retrieve video URL.";
    }
} else {
    echo "Please provide a Google Drive URL as a parameter (e.g., ?URL=https://drive.google.com/file/d/VIDEO_ID/view).";
}
?>
