
    <?php
// Function to get the size of the file to calculate progress
function getFileSize($filePath) {
    return filesize($filePath);
}

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

// Replace these variables with your own values
$token = "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";
$repositoryOwner = "jokes4ush";
$repositoryName = "music";
$filePath = "token.txt";

$ch = curl_init("https://api.github.com/repos/$repositoryOwner/$repositoryName/contents/$filePath");
curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "PUT");
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_HTTPHEADER, array(
    "Authorization: Bearer $token",
    "Content-Type: application/json"
));

$fileContent = file_get_contents($filePath);
$fileContentEncoded = base64_encode($fileContent);

$data = json_encode(array(
    "message" => "txt file",
    "content" => $fileContentEncoded
));

curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
curl_setopt($ch, CURLOPT_NOPROGRESS, false);
curl_setopt($ch, CURLOPT_PROGRESSFUNCTION, 'handleProgress');
curl_setopt($ch, CURLOPT_INFILE, fopen($filePath, 'rb'));
curl_setopt($ch, CURLOPT_INFILESIZE, getFileSize($filePath));

$result = curl_exec($ch);
curl_close($ch);

// Decode the result to get the uploaded file details
$responseData = json_decode($result, true);
?>

<!DOCTYPE html>
<html>
<head>
    <title>Upload File to GitHub</title>
</head>
<body>
    <h1>Upload a File to GitHub</h1>
    <form action="" method="post" enctype="multipart/form-data">
        <input type="file" name="file" />
        <button type="submit">Upload</button>
    </form>
    <progress id="progressBar" value="0" max="100"></progress>
    <span id="progressLabel">0%</span>
</body>
</html>
