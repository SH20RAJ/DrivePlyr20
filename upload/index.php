<!DOCTYPE html>
<html>
<head>
    <title>Upload File to GitHub Releases</title>
</head>
<body>
    <h1>Upload a File to GitHub Releases</h1>
    <form id="uploadForm" enctype="multipart/form-data">
        <input type="file" name="file" />
        <button type="submit">Upload</button>
    </form>

    <div id="response"></div>

    <script>
        document.getElementById('uploadForm').addEventListener('submit', function (event) {
            event.preventDefault();

            var form = event.target;
            var formData = new FormData(form);

            var xhr = new XMLHttpRequest();
            xhr.open('POST', 'api.php', true);
            xhr.onload = function () {
                if (xhr.status === 200) {
                    var response = JSON.parse(xhr.responseText);
                    document.getElementById('response').innerHTML = JSON.stringify(response, null, 2);
                } else {
                    document.getElementById('response').innerHTML = 'Error: ' + xhr.status;
                }
            };
            xhr.send(formData);
        });
    </script>
</body>
</html>
