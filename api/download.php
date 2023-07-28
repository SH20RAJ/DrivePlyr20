<?php
// Check if the video_url parameter is set in the URL
if (isset($_GET['url'])) {
    $videoUrl = $_GET['url'];

    // Generate a unique name for the video file
    $uniqueName = 'DrivePlyr-Video-' . uniqid() . '.mp4';

    // Fetch the video content
    $videoContent = file_get_contents($videoUrl);

    // Save the video content to a file
    file_put_contents($uniqueName, $videoContent);

    // Set headers to force download the video file
    header('Content-Description: File Transfer');
    header('Content-Type: application/octet-stream');
    header('Content-Disposition: attachment; filename="' . basename($uniqueName) . '"');
    header('Expires: 0');
    header('Cache-Control: must-revalidate');
    header('Pragma: public');
    header('Content-Length: ' . filesize($uniqueName));

    // Clear the output buffer and send the video file to the browser
    ob_clean();
    flush();
    readfile($uniqueName);

    // Delete the temporary video file
    unlink($uniqueName);
    exit;
} else {
    echo "Please provide a url parameter in the URL.";
}
?>
