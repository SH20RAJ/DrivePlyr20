<?php
$token = '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';
$repositoryOwner = 'sh20raj';
$repositoryName = 'cdns20';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = $_POST['name'];
    $file = $_FILES['file'];

    // Prepare the file data for GitHub release upload
    $content = file_get_contents($file['tmp_name']);
    $base64Content = base64_encode($content);

    // Create the release using GitHub Releases API
    $releaseUrl = "https://api.github.com/repos/{$repositoryOwner}/{$repositoryName}/releases";
    $releaseData = [
        'tag_name' => 'v1.0.0', // Replace this with your desired release tag/version
        'target_commitish' => 'main', // Replace this with your desired branch
        'name' => 'Release v1.0.0', // Replace this with your desired release name
        'body' => 'Release notes and description go here.', // Replace this with your desired release description
        'draft' => false,
        'prerelease' => false,
    ];

    $ch = curl_init($releaseUrl);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_HTTPHEADER, [
        "Content-Type: application/json",
        "Authorization: token {$token}",
    ]);
    curl_setopt($ch, CURLOPT_POST, true);
    curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($releaseData));

    $releaseResult = curl_exec($ch);
    $releaseInfo = curl_getinfo($ch);
    curl_close($ch);

    // Decode the JSON response for the release creation
    $releaseResponse = json_decode($releaseResult, true);

    // Check if the release creation was successful
    if ($releaseInfo['http_code'] === 201 && isset($releaseResponse['id'])) {
        // Upload the asset (file) to the release using GitHub Releases API
        $uploadUrl = $releaseResponse['upload_url'];
        $uploadUrl = str_replace('{?name}', "?name={$file['name']}", $uploadUrl);

        $ch = curl_init($uploadUrl);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, [
            "Content-Type: application/octet-stream",
            "Authorization: token {$token}",
        ]);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $content);

        $uploadResult = curl_exec($ch);
        $uploadInfo = curl_getinfo($ch);
        curl_close($ch);

        // Decode the JSON response for the asset upload
        $uploadResponse = json_decode($uploadResult, true);

        // Check if the asset upload was successful
        if ($uploadInfo['http_code'] === 201 && isset($uploadResponse['browser_download_url'])) {
            // Return the JSON response with the release details and asset upload response
            header('Content-Type: application/json');
            echo json_encode(['success' => true, 'release' => $releaseResponse, 'asset_upload' => $uploadResponse]);
        } else {
            // Return the JSON response with the asset upload error
            header('Content-Type: application/json');
            echo $uploadResult;
        }
    } else {
        // Return the JSON response with the release creation error
        header('Content-Type: application/json');
        echo $releaseResult;
    }
}
?>
