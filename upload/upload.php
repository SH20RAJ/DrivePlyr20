<?php

$accessToken = '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';
$repositoryOwner = 'jokes4ush';
$repositoryName = 'music';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $fileToUpload = $_FILES['fileToUpload']['tmp_name'];
    $uploadUrl = "https://api.github.com/repos/{$repositoryOwner}/{$repositoryName}/releases";

    // Create the release and get the upload URL
    $ch = curl_init($uploadUrl);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_HTTPHEADER, [
        "Authorization: token {$accessToken}",
        "User-Agent: MyGitHubUploaderApp" // Provide a unique user-agent name for your application
    ]);
    curl_setopt($ch, CURLOPT_POST, true);
    curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode(['tag_name' => $_POST['tagName'], 'name' => $_POST['tagName']]));
    $response = curl_exec($ch);
    $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);

    // Check for cURL errors
    if (curl_errno($ch)) {
        die("cURL error: " . curl_error($ch));
    }

    curl_close($ch);

    if ($httpCode !== 201) {
        die("Failed to create a release. HTTP Code: {$httpCode}\n{$response}");
    }

    $releaseData = json_decode($response, true);
    $uploadUrl = str_replace('{?name,label}', '', $releaseData['upload_url']);

    // Upload the file to the release using chunked file upload
    $chunkSize = 1024 * 1024; // 1 MB chunks (adjust as needed)
    $file = fopen($fileToUpload, 'r');
    while (!feof($file)) {
        $content = fread($file, $chunkSize);
        $ch = curl_init($uploadUrl . "?name=" . basename($_FILES['fileToUpload']['name']));
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, [
            "Authorization: token {$accessToken}",
            "User-Agent: MyGitHubUploaderApp", // Provide the same user-agent name as above
            "Content-Type: application/octet-stream",
            "Content-Length: " . strlen($content)
        ]);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $content);

        // Add this line to get cURL error messages
        curl_setopt($ch, CURLOPT_VERBOSE, true);

        $response = curl_exec($ch);
        $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);

        // Check for cURL errors
        if (curl_errno($ch)) {
            die("cURL error: " . curl_error($ch));
        }

        curl_close($ch);

        if ($httpCode !== 201) {
            die("Failed to upload the file. HTTP Code: {$httpCode}\n{$response}");
        }
    }
    fclose($file);

    // Display the success message
    echo "File uploaded to GitHub Releases successfully!";
}
?>
