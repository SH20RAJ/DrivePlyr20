<!DOCTYPE html>
<html>
<head>
    <title>GitHub File Upload</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
</head>
<body>
    <div class="container mt-5">
        <h1>GitHub File Upload</h1>
        <form id="uploadForm" action="api.php" method="post" enctype="multipart/form-data">
            <div class="form-group">
                <label for="name">Name:</label>
                <input type="text" class="form-control" name="name" id="name" required>
            </div>
            <div class="form-group">
                <label for="file">File:</label>
                <input type="file" class="form-control-file" name="file" id="file" required>
            </div>
            <button type="submit" class="btn btn-primary" id="uploadButton">Upload</button>
            <div class="progress mt-3" style="display: none;">
                <div class="progress-bar progress-bar-striped progress-bar-animated" role="progressbar" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100" style="width: 0%"></div>
            </div>
        </form>
    </div>

    <script>
        $(document).ready(function () {
            $("#uploadForm").on("submit", function (event) {
                event.preventDefault();
                var form = $(this);
                var formData = new FormData(form[0]);

                $("#uploadButton").prop("disabled", true);
                $(".progress").show();

                $.ajax({
                    url: form.attr("action"),
                    type: "POST",
                    data: formData,
                    dataType: "json",
                    contentType: false,
                    processData: false,
                    xhr: function () {
                        var xhr = new window.XMLHttpRequest();
                        xhr.upload.addEventListener("progress", function (e) {
                            if (e.lengthComputable) {
                                var percentage = (e.loaded / e.total) * 100;
                                $(".progress-bar").css("width", percentage + "%");
                                $(".progress-bar").attr("aria-valuenow", percentage);
                            }
                        });
                        return xhr;
                    },
                    success: function (response) {
                        console.log(response); // You can handle the response here
                    },
                    error: function (xhr, status, error) {
                        console.error(error);
                    },
                    complete: function () {
                        $("#uploadButton").prop("disabled", false);
                        $(".progress").hide();
                        $(".progress-bar").css("width", "0%");
                        $(".progress-bar").attr("aria-valuenow", "0");
                        $("#uploadForm")[0].reset();
                    },
                });
            });
        });
    </script>
</body>
</html>
