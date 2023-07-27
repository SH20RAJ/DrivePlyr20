<?php
session_start();
include 'conn.php';
include 'func.php';
// Check if the user is logged in


// Get the video ID from the URL parameter
$id = $_GET['id'];

// Fetch the video information from the database
$sql = "SELECT * FROM videos where id = $id";
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
$views = $row['views'];
$userid = $row['user'];


/*print_r($row);
die();*/
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
<meta name="title" content="<?php echo $videoTitle ?> - DrivePlyr ">
<meta name="description" content="<?php echo $videoDescription ?> - DrivePlyr :- Custom Video Player for You">
<meta name="keywords" content="DrivePlyr, Video Player, Custom HTML5 Video Player, Video Player, Plyr, YouTube Alternatives,Drive">
<meta property="og:image" content="<?php echo $videoPosterURL ?>" />
<meta name="robots" content="index, follow">
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<meta name="language" content="English">
<meta name="author" content="Shade">
    
  <link rel="shortcut icon" href="../../logo.png" type="image/x-icon">
  <title><?php echo $videoTitle ?> - DrivePlyr</title>
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootswatch@4.5.2/dist/lux/bootstrap.min.css">
  <script type='text/javascript' src='https://platform-api.sharethis.com/js/sharethis.js#property=64bd1f4e71afd40013e96b95&product=sop' async='async'></script>
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
      <form id="search" class="form-inline ml-auto">
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
        <!-- Sample comment -->
        <div class="media">
            <img src="https://imgur.com/n5MBy0m.png" width="50px" class="mr-3 rounded-circle" alt="User 1">
            <div class="media-body">
              <a href="../../channel/<?php echo $userid ?>"><h5 class="mt-0"><?php echo getUser($userid)[0]->name ?></h5></a>
              <p>Subscribe</p>
              <button class="btn btn-sm btn-outline-success mr-2">Follow</button>
              <button class="btn btn-sm btn-outline-danger">Messege</button>
            </div>
          </div>
        <p><?php echo $videoDescription ?></p>
<?php echo $views ?> Views
                <!-- Additional Features -->
                 <div class="mt-4">
                  <!-- <button class="btn btn-success">Like</button>
                  <button class="btn btn-danger">Dislike</button>
                  <button class="btn btn-info">Download</button> -->
                  <!-- Button to trigger the modal -->
  <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#myModal">Share</button>
                 <a href="mailto:mail@appspages.online?subject=REPORT-OF-VIDEO-ID-<?php echo $id ;  ?>"> <button class="btn btn-warning">Report</button></a>
                </div>

        <!-- Comment Section -->
        <div class="mt-4">                <!-- ShareThis BEGIN --><div class="sharethis-inline-reaction-buttons"></div><!-- ShareThis END -->

          <h4>Comments</h4>
          <!-- Sample comment -->
          <div class="media">
            <img src="http://aninex.com/images/srvc/web_de_icon.png" width="50px" class="mr-3 rounded-circle" alt="User 1">
            <div class="media-body">
              <h5 class="mt-0"><?php echo getUser($userid)[0]->name ?></h5>
              <p>Currently Comment Section isn't working... </p>
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
// Assuming you have already established a database connection
// Replace 'your_table_name' with the actual table name

// Your PHP variables containing the video information
$video_id = $id; // Replace with the actual video ID
$video_title = $videoTitle; // Replace with the actual video title
$video_description = $videoDescription; // Replace with the actual video description
$video_user = $userid; // Replace with the actual video user

// Prepare the SQL query with placeholders for the variables
$sql = "SELECT *
        FROM videos
        WHERE id <> :video_id
        AND (
            title LIKE CONCAT('%', :video_title, '%')
            OR description LIKE CONCAT('%', :video_description, '%')
        )
        AND user = :video_user
        LIMIT 10";

// Prepare the statement
$stmt = $pdo->prepare($sql);

// Bind the PHP variables to the placeholders in the query
$stmt->bindParam(':video_id', $video_id, PDO::PARAM_INT);
$stmt->bindParam(':video_title', $video_title, PDO::PARAM_STR);
$stmt->bindParam(':video_description', $video_description, PDO::PARAM_STR);
$stmt->bindParam(':video_user', $video_user, PDO::PARAM_STR);

// Execute the query
$stmt->execute();

// Fetch the results into an array
$relatedVideos = $stmt->fetchAll(PDO::FETCH_ASSOC);

// Now you have the related videos in the $relatedVideos array
// You can use this data to display the related videos on your website

$result = $relatedVideos;

if (count($result) > 0) {
    // Loop through each video and generate the HTML for related video thumbnails
    foreach ($result as $row) {
        $videoId = $row['id'];
        $videoTitle = $row['title'];
        $videoPosterURL = $row['poster_url'] ?: 'https://driveplyr.appspages.online/dashboard/api/Image_not_available.png';
        $videoStatus = 'Public'; //$row['status'];
        $videoViews = $row['views'];
        $videoDownloads = $row['downloads'];
        $videoScore = '100%'; //$row['progress'];

        echo '
        <!-- Sample related video thumbnails -->
        <a href="../../watch/' . $videoId . '/' . generateSlug($videoTitle) . '" class="list-group-item">
          <img src="' . $videoPosterURL . '" class="img-fluid rounded" alt="Sample Video 1">
          <p class="mt-2">' . $videoTitle . '</p>
        </a>';
    }
} else {
    echo '<p>No videos found.</p>';
}
?>
$query = 'UPDATE videos SET views = views + 1 WHERE id = '. $id .'';
//$result = $conn->query($query);   

?>


    
    <!-- Add more related videos here -->
  </div>
</div>
<style>.list-group-item {border: none;}</style>
    </div>
  </div>

  <!-- Footer -->
  <footer class="bg-dark text-white text-center py-3 mt-4">
    &copy; 2023 DrivePlyr
  </footer>
    <!-- The Modal -->
    <div class="modal" id="myModal">
    <div class="modal-dialog">
      <div class="modal-content">
        <!-- Modal Header -->
        <div class="modal-header">
          <h4 class="modal-title">Share</h4>
          <button type="button" class="close" data-dismiss="modal">&times;</button>
        </div>

        <!-- Modal body -->
        <div class="modal-body">
          <h4>Copy Code to Embed This Video</h4>
<pre>
  <code class="lanuage-html">
&#x3C;div id=&#x22;driveplyr<?php echo $id ?>&#x22;&#x3E;&#x3C;/div&#x3E;
&#x3C;script player=&#x22;plyr&#x22; src=&#x22;https://driveplyr.appspages.online/player.js&#x22; data-id=&#x22;<?php echo $id ?>&#x22; data-height=&#x22;500px&#x22; data-width=&#x22;100%&#x22; data-type=&#x22;driveplyr&#x22; defer&#x3E;&#x3C;/script&#x3E;
  </code>
</pre>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css"/>
<!-- ShareThis BEGIN --><div class="sharethis-inline-share-buttons"></div><!-- ShareThis END -->
<center>
<!-- Facebook -->
<a style="color: #3b5998;" href="#!" role="button"
  ><i class="fab fa-facebook-f fa-lg"></i
></a>

<!-- Twitter -->
<a style="color: #55acee;" href="#!" role="button"
  ><i class="fab fa-twitter fa-lg"></i
></a>

<!-- Google -->
<a style="color: #dd4b39;" href="#!" role="button"
  ><i class="fab fa-google fa-lg"></i
></a>

<!-- Instagram -->
<a style="color: #ac2bac;" href="#!" role="button"
  ><i class="fab fa-instagram fa-lg"></i
></a>
</center>

        </div>

        <!-- Modal footer -->
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        </div>

      </div>
    </div>
  </div>
</div>
  <style>
        @media (max-width: 600px) {
            #search {
                display: none;
            }
        }
    </style>
    <!-- Include Bootstrap JS -->
  <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.1/dist/umd/popper.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
