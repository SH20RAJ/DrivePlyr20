<?php
$token = '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';
$repositoryOwner = 'sh20raj';
$repositoryName = 'cdns20';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = $_POST['name'];
    $file = $_FILES['file'];

    // Prepare the file data for GitHub API upload
    $content = file_get_contents($file['tmp_name']);
    $base64Content = base64_encode($content);

    // Create the file in the GitHub repository using GitHub API
    $fileUrl = "https://api.github.com/repos/{$repositoryOwner}/{$repositoryName}/contents/{$file['name']}";
    $data = [
        'message' => 'Upload file via API',
        'content' => $base64Content,
    ];

    $options = [
        'http' => [
            'header'  => "Content-type: application/json\r\nAuthorization: token {$token}",
            'method'  => 'PUT',
            'content' => json_encode($data),
        ],
    ];

    $context = stream_context_create($options);
    $fileResult = file_get_contents($fileUrl, false, $context);

    // Decode the JSON response
    $fileResponse = json_decode($fileResult, true);

    // Check if the file upload was successful
    if (isset($fileResponse['content']['download_url'])) {
        $fileDownloadUrl = $fileResponse['content']['download_url'];

        // Create the release using GitHub API
        $releaseUrl = "https://api.github.com/repos/{$repositoryOwner}/{$repositoryName}/releases";
        $releaseData = [
            'tag_name' => 'v1.0.0', // Replace this with your desired release tag/version
            'name' => 'Release v1.0.0', // Replace this with your desired release name
            'body' => 'Release notes and description go here.', // Replace this with your desired release description
            'draft' => false,
            'prerelease' => false,
        ];

        $options = [
            'http' => [
                'header'  => "Content-type: application/json\r\nAuthorization: token {$token}",
                'method'  => 'POST',
                'content' => json_encode($releaseData),
            ],
        ];

        $context = stream_context_create($options);
        $releaseResult = file_get_contents($releaseUrl, false, $context);

        // Decode the JSON response for the release creation
        $releaseResponse = json_decode($releaseResult, true);

        // Check if the release creation was successful
        if (isset($releaseResponse['id'])) {
            // Attach the uploaded file to the release using GitHub API
            $uploadUrl = $releaseResponse['upload_url'];
            $uploadUrl = str_replace('{?name,label}', "?name={$file['name']}", $uploadUrl);

            $uploadData = [
                'name' => $file['name'],
                'label' => 'Uploaded File',
            ];

            $options = [
                'http' => [
                    'header'  => "Content-type: application/octet-stream\r\nAuthorization: token {$token}",
                    'method'  => 'POST',
                    'content' => $content,
                ],
            ];

            $context = stream_context_create($options);
            $uploadResult = file_get_contents($uploadUrl, false, $context);

            // Return the JSON response with the release details
            header('Content-Type: application/json');
            echo $uploadResult;
        } else {
            // Return the JSON response with the error message for release creation
            header('Content-Type: application/json');
            echo json_encode(['success' => false, 'error' => 'Release creation failed.']);
        }
    } else {
        // Return the JSON response with the error message for file upload
        header('Content-Type: application/json');
        echo json_encode(['success' => false, 'error' => 'File upload failed.']);
    }
}
?>

