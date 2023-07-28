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

    $ch = curl_init("https://uploads.github.com/repos/$repositoryOwner/$repositoryName/releases/$releaseId/assets?name=$assetFilename");
    curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
    curl_setopt($ch, CURLOPT_POSTFIELDS, file_get_contents($_FILES['file']['tmp_name']));
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_HTTPHEADER, array(
        'Authorization: token ' . $accessToken,
        'Content-Type: application/octet-stream',
        'User-Agent: YourApp' // Replace with your app's name or identifier
    ));

    $result = curl_exec($ch);
    print_r($result);
    curl_close($ch);

    // You can add additional error handling and success messages here
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
</body>
</html>
