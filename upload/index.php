<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $accessToken = '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';
    $repositoryOwner = 'jokes4ush';
    $repositoryName = 'music';

    $releaseData = array(
        'tag_name' => 'v1.0.0'.uniqid(), // Replace with your desired tag/version
        'name' => 'Release Name', // Replace with your desired release name
        'body' => 'Release description goes here', // Replace with your desired release description
        'draft' => false,
        'prerelease' => false
    );

    // Step 1: Create the release
    $ch = curl_init("https://api.github.com/repos/$repositoryOwner/$repositoryName/releases");
    curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
    curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($releaseData));
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_HTTPHEADER, array(
        'Authorization: token ' . $accessToken,
        'User-Agent: YourApp' // Replace with your app's name or identifier
    ));

    $result = curl_exec($ch);
    curl_close($ch);

    $releaseData = json_decode($result, true);

    // Step 2: Upload the selected file as a release asset
    $releaseId = $releaseData['id']; // Get the release ID from the previous step
    $assetFilename = $_FILES['file']['name']; // Get the filename of the uploaded file
    $assetPath = $_FILES['file']['tmp_name']; // Get the path to the temporary uploaded file

    // Function to get the size of the file to calculate progress
    function getFileSize($filePath) {
        return filesize($filePath);
    }

    // Prepare cURL for asset upload
    $ch = curl_init("https://uploads.github.com/repos/$repositoryOwner/$repositoryName/releases/$releaseId/assets?name=$assetFilename");
    curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_HTTPHEADER, array(
        'Authorization: token ' . $accessToken,
        'Content-Type: application/octet-stream',
        'User-Agent: YourApp' // Replace with your app's name or identifier
    ));

    // Function to handle the progress updates during file upload
    function handleProgress($resource, $download_size, $downloaded, $upload_size, $uploaded) {
        // Calculate and update the progress percentage
        $progress = ($upload_size > 0) ? ($uploaded / $upload_size) * 100 : 0;

        // Send progress to the client using JavaScript
        echo '<script>';
        echo 'document.getElementById("progressBar").value = ' . intval($progress) . ';';
        echo 'document.getElementById("progressLabel").innerText = "' . intval($progress) . '%";';
        echo '</script>';
        // Flush the output buffer to ensure the progress is sent immediately
        ob_flush();
        flush();
    }

    // Function to read the file content in chunks and upload it
    function uploadFile($ch, $filePath, $releaseId, $assetFilename) {
        $handle = fopen($filePath, 'rb');
        curl_setopt($ch, CURLOPT_UPLOAD, true);
        curl_setopt($ch, CURLOPT_INFILE, $handle);
        curl_setopt($ch, CURLOPT_INFILESIZE, getFileSize($filePath));
        curl_setopt($ch, CURLOPT_NOPROGRESS, false);
        curl_setopt($ch, CURLOPT_PROGRESSFUNCTION, 'handleProgress');
        $result = curl_exec($ch);
        fclose($handle);
        return $result;
    }

    $uploadResult = uploadFile($ch, $assetPath, $releaseId, $assetFilename);
    echo '<script>';
    echo 'document.getElementById("progressLabel").innerText = "Upload Complete";';
    echo '</script>';
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Upload File to GitHub Releases</title>
</head>
<body>
    <h1>Upload a File to GitHub Releases</h1>
    <form action="" method="post" enctype="multipart/form-data">
        <input type="file" name="file" />
        <button type="submit">Upload</button>
    </form>
    <progress id="progressBar" value="0" max="100"></progress>
    <span id="progressLabel">0%</span>
</body>
</html>
