function getUrlType($url) {
    if (strpos($url, 'drive.google.com') !== false) {
        return 'drive';
    } elseif (strpos($url, 'mediafire.com') !== false) {
        return 'mediafire';
    } elseif (strpos($url, 'youtube.com') !== false || strpos($url, 'youtu.be') !== false) {
        return 'youtube';
    } elseif (strpos($url, 'vimeo.com') !== false) {
        return 'vimeo';
    } elseif (strpos($url, 'archive.org') !== false) {
        return 'archive.org';
    } else {
        return 'unknown';
    }
}

// Example usage:
$url = 'https://drive.google.com/file/d/ABC123/view';
$type = getUrlType($url);
echo $type; // Output: drive
