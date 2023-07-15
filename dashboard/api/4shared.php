<?php

// URL to scrape
$url = $_GET['url'];

// Fetch the HTML content
$html = file_get_contents($url);

// Extract the title
preg_match('/<title>(.*?)<\/title>/', $html, $titleMatches);
$title = isset($titleMatches[1]) ? trim($titleMatches[1]) : '';

// Extract the size
preg_match('/class="jsFileSize">(.*?)<\/span>/', $html, $sizeMatches);
$size = isset($sizeMatches[1]) ? trim($sizeMatches[1]) : '';

// Extract the resolution
preg_match('/class="jsResolution">(.*?)<\/span>/', $html, $resolutionMatches);
$resolution = isset($resolutionMatches[1]) ? trim($resolutionMatches[1]) : '';

// Extract the video link
preg_match('/<video.*?src="(.*?)".*?>/s', $html, $videoMatches);
$videoLink = isset($videoMatches[1]) ? trim($videoMatches[1]) : '';

// Create an array with the extracted information
$videoInfo = [
    'title' => $title,
    'size' => $size,
    'resolution' => $resolution,
    'video_link' => $videoLink
];

// Convert the video information to JSON
$jsonContent = json_encode($videoInfo, JSON_PRETTY_PRINT);

// Set the content type header to JSON
header('Content-Type: application/json');

// Output the JSON content
echo $jsonContent;
