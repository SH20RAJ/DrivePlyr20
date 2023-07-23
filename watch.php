<?php
session_start();
include 'conn.php';
include 'func.php';
// Check if the user is logged in
if (!isset($_SESSION['username'])) {
    echo "Not Allowed";
    exit;
}

// Get the video ID from the URL parameter
$id = $_GET['id'];

// Fetch the video information from the database
$sql = "SELECT * FROM videos order by views desc";
$result = $conn->query($sql);

// Check if the video exists
if ($result->num_rows === 0) {
    echo "Video not found";
    exit;
}

// Get the video data
$row = $result->fetch_assoc();
$videoURL = $row['url'];
$videoHosting = $row['hosting'];
$videoTitle = $row['title'];
$videoDescription = $row['description'];
$videoAllowDownload = $row['allow_download'];
$videoPosterURL = $row['poster_url'];
/*print_r($row);
die();*/
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="shortcut icon" href="../../logo.png" type="image/x-icon">
  <title><?php echo $videoTitle ?> - DrivePlyr</title>
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootswatch@4.5.2/dist/lux/bootstrap.min.css">
</head>
<body>
  <style>
    h1, h2, h3, h4, h5, h6 {
    text-transform: none;
}
    </style>
  <!-- Navbar -->
  <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <div class="container">
      <a class="navbar-brand" href="../../">DrivePlyr</a>

      <!-- Responsive Search Bar -->
      <form class="form-inline ml-auto">
        <input class="form-control mr-sm-2" type="search" placeholder="Search" aria-label="Search">
        <button class="btn btn-outline-light my-2 my-sm-0" type="submit">Search</button>
      </form>

      <!-- Add your navigation links here if needed -->
    </div>
  </nav>
  <!-- Main Content Area -->
  <div class="container mt-4">
    <div class="row">
      <!-- Video Player Column -->
      <div class="col-md-8">
        <div class="embed-responsive embed-responsive-16by9">
          <div id="driveplyr<?php echo $id ?>"></div>
<script player="plyr" src="https://driveplyr.appspages.online/player.js" data-id="<?php echo $id ?>" data-height="500px" data-width="100%" data-type="driveplyr" defer></script>
        </div>
        <h3 class="mt-3"><?php echo $videoTitle ?></h3>
        <p><?php echo $videoDescription ?></p>
                <!-- Additional Features -->
                <div class="mt-4">
                  <button class="btn btn-success">Like</button>
                  <button class="btn btn-danger">Dislike</button>
                  <button class="btn btn-info">Download</button>
                  <button class="btn btn-info">Embed</button>
                  <button class="btn btn-warning">Report</button>
                </div>

        <!-- Comment Section -->
        <div class="mt-4">
          <h4>Comments</h4>
          <!-- Sample comment -->
          <div class="media">
            <img src="https://via.placeholder.com/50" class="mr-3 rounded-circle" alt="User 1">
            <div class="media-body">
              <h5 class="mt-0">User 1</h5>
              <p>Sample comment 1 goes here.</p>
              <button class="btn btn-sm btn-outline-success mr-2">Like</button>
              <button class="btn btn-sm btn-outline-danger">Dislike</button>
            </div>
          </div>
          <!-- Add more comments here -->

          <!-- Comment Input Section -->
          <div class="mt-4">
            <h4>Leave a Comment</h4>
            <div class="form-group">
              <input type="text" class="form-control" placeholder="Your name">
            </div>
            <div class="form-group">
              <textarea class="form-control" rows="3" placeholder="Your comment"></textarea>
            </div>
            <button class="btn btn-primary">Submit</button>
          </div>
        </div>
      </div>

      <!-- Related Videos and Additional Features Column -->
    <!-- Related Videos and Additional Features Column -->
<div class="col-md-4">
  <h3>Popular Videos</h3>
  <div class="list-group">
  <?php
// Retrieve the video list from the database
$user = $_SESSION['id'];
$sql = "SELECT * FROM videos where order by id desc limit 20";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    // Loop through each video and generate the table rows
    while ($row = $result->fetch_assoc()) {
        $videoId = $row['id'];
        $videoTitle = $row['title'];
        $videoPosterURL = $row['poster_url'] ?: 'https://driveplyr.appspages.online/dashboard/api/Image_not_available.png';
        $videoStatus = 'Public';//$row['status'];
        $videoViews = $row['views'];
        $videoDownloads = $row['downloads'];
        $videoScore = '100%';//$row['progress'];

        echo '
        <!-- Sample related video thumbnails -->
        <a href="../../watch/'.$videoId.'/'.generateSlug($videoTitle).' class="list-group-item">
          <img src="'.$videoPosterURL.'" class="img-fluid rounded" alt="Sample Video 1">
          <p class="mt-2">'.$videoTitle.'</p>
        </a>';
    }
} else {
    echo '<tr><td colspan="6">No videos found.</td></tr>';
}
?>


    
    <!-- Add more related videos here -->
  </div>
</div>
<style>.list-group-item {border: none;}</style>
    </div>
  </div>

  <!-- Footer -->
  <footer class="bg-dark text-white text-center py-3 mt-4">
    &copy; 2023 Your Website Name
  </footer>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
