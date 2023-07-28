<?php
require 'vendor/autoload.php';

use GuzzleHttp\Client;

function uploadFileToGitHub($filePath, $token, $repositoryOwner, $repositoryName)
{
    // Read the file as binary data
    $fileContent = file_get_contents($filePath);

    // Set up the request headers, including the GitHub access token
    $headers = [
        'Authorization' => 'Bearer ' . $token,
        'Content-Type' => 'application/octet-stream',
    ];

    // Compose the API endpoint for creating a new release asset
    $uploadUrl = "https://api.github.com/repos/{$repositoryOwner}/{$repositoryName}/releases/latest/assets?name=" . urlencode(basename($filePath));

    // Make the API request to upload the file using cURL
    $client = new Client();
    $response = $client->request('POST', $uploadUrl, [
        'headers' => $headers,
        'body' => $fileContent,
    ]);

    $statusCode = $response->getStatusCode();
    if ($statusCode === 201) {
        echo 'File uploaded successfully!' . PHP_EOL;
        $data = json_decode($response->getBody(), true);
        echo 'Download URL: ' . $data['browser_download_url'] . PHP_EOL;
    } else {
        echo 'Error uploading file. Status Code: ' . $statusCode . PHP_EOL;
        echo 'Response: ' . $response->getBody() . PHP_EOL;
    }
}

// Example usage:
$filePath = 'token.txt';
$token = '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';
$repositoryOwner = 'sh20raj';
$repositoryName = 'cdns20';

uploadFileToGitHub($filePath, $token, $repositoryOwner, $repositoryName);
