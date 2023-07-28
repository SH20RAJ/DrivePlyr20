<!DOCTYPE html>
<html>
<head>
    <title>Upload to GitHub Releases</title>
</head>
<body>
    <h2>Upload to GitHub Releases</h2>
    <form id="uploadForm" action="upload.php" method="post" enctype="multipart/form-data">
        <input type="file" id="fileInput" name="fileToUpload" />
        <input type="submit" value="Upload" />
    </form>
    <div id="progressBarContainer" style="display: none;">
        <progress id="progressBar" max="100"></progress>
        <span id="progressPercentage">0%</span>
    </div>
    <div id="responseContainer"></div>

    <script>
        document.getElementById('uploadForm').addEventListener('submit', function (event) {
            event.preventDefault();
            const fileInput = document.getElementById('fileInput');
            if (fileInput.files.length === 0) {
                alert('Please select a file to upload.');
                return;
            }
            const file = fileInput.files[0];
            const formData = new FormData();
            formData.append('fileToUpload', file);

            // Generate a unique tag name using the current timestamp
            const tagName = 'v' + Date.now();

            formData.append('tagName', tagName);

            const xhr = new XMLHttpRequest();
            xhr.open('POST', 'upload.php', true);

            xhr.upload.addEventListener('progress', function (event) {
                const progressBar = document.getElementById('progressBar');
                const progressPercentage = document.getElementById('progressPercentage');
                const progress = Math.round((event.loaded / event.total) * 100);
                progressBar.value = progress;
                progressPercentage.innerHTML = `${progress}%`;
            });

            xhr.onreadystatechange = function () {
                if (xhr.readyState === XMLHttpRequest.DONE) {
                    const responseContainer = document.getElementById('responseContainer');
                    responseContainer.innerHTML = xhr.responseText;
                }
            };

            xhr.send(formData);
            document.getElementById('progressBarContainer').style.display = 'block';
        });
    </script>
</body>
</html>
