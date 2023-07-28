<?php
session_start();
// Enable error reporting
error_reporting(E_ALL);
ini_set('display_errors', 1);
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
      <form id="search" action="../../search.php" class="form-inline ml-auto">
        <input name="q" class="form-control mr-sm-2" type="search" placeholder="Search" aria-label="Search">
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

          <p><?php echo youtubeLikeDescription($videoDescription) ?></p>
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
        <div class="mt-4">                <!-- ShareThis BEGIN <div class="sharethis-inline-reaction-buttons"></div> ShareThis END -->
        <div id="disqus_thread"></div>
<script>
    /**
    *  RECOMMENDED CONFIGURATION VARIABLES: EDIT AND UNCOMMENT THE SECTION BELOW TO INSERT DYNAMIC VALUES FROM YOUR PLATFORM OR CMS.
    *  LEARN WHY DEFINING THESE VARIABLES IS IMPORTANT: https://disqus.com/admin/universalcode/#configuration-variables    */
    /*
    var disqus_config = function () {
    this.page.url = PAGE_URL;  // Replace PAGE_URL with your page's canonical URL variable
    this.page.identifier = PAGE_IDENTIFIER; // Replace PAGE_IDENTIFIER with your page's unique identifier variable
    };
    */
    (function() { // DON'T EDIT BELOW THIS LINE
    var d = document, s = d.createElement('script');
    s.src = 'https://driveplyr.disqus.com/embed.js';
    s.setAttribute('data-timestamp', +new Date());
    (d.head || d.body).appendChild(s);
    })();
</script>
<noscript>Please enable JavaScript to view the <a href="https://disqus.com/?ref_noscript">comments powered by Disqus.</a></noscript>
          <script id="dsq-count-scr" src="//driveplyr.disqus.com/count.js" async></script>
          
          <!-- <h4>Comments</h4>
          Sample comment 
          <div class="media">
            <img src="http://aninex.com/images/srvc/web_de_icon.png" width="50px" class="mr-3 rounded-circle" alt="User 1">
            <div class="media-body">
              <h5 class="mt-0"><?php echo getUser($userid)[0]->name ?></h5>
              <p>Currently Comment Section isn't working... </p>
              <button class="btn btn-sm btn-outline-success mr-2">Like</button>
              <button class="btn btn-sm btn-outline-danger">Dislike</button>
            </div>
          </div>-->
          <!-- Add more comments here -->

          <!-- Comment Input Section 
          <div class="mt-4">
            <h4>Leave a Comment</h4>
            <div class="form-group">
              <input type="text" class="form-control" placeholder="Your name">
            </div>
            <div class="form-group">
              <textarea class="form-control" rows="3" placeholder="Your comment"></textarea>
            </div>
            <button class="btn btn-primary">Submit</button>
          </div>-->
        </div>
      </div>

      <!-- Related Videos and Additional Features Column -->
    <!-- Related Videos and Additional Features Column -->
<div class="col-md-4">
  <h3>Related Videos</h3>
  <div class="list-group">
 
  <?php
// Assuming you have already established a database connection
// Replace 'your_table_name' with the actual table name

// Retrieve the video list from the database
//$user = $_SESSION['id'];

// Your PHP variables containing the video information
$video_id = $id; // Replace with the actual video ID
$video_title = $videoTitle; // Replace with the actual video title
$video_description = $videoDescription; // Replace with the actual video description
$video_user = $userid; // Replace with the actual video user


// Prepare the SQL query with placeholders for the variables
// Prepare the SQL query with placeholders for the variables
$sql = "(SELECT *, 1 as priority
         FROM videos
         WHERE id <> $video_id
         AND user = '$video_user'
         AND (
             title LIKE CONCAT('%', '$video_title', '%')
             OR description LIKE CONCAT('%', '$video_description', '%')
         )
         LIMIT 10)
        UNION
        (SELECT *, 0 as priority
         FROM videos
         WHERE id <> $video_id
         AND user <> '$video_user'
         AND id NOT IN (SELECT id FROM videos WHERE id <> $video_id AND user = '$video_user')
         AND (
             title LIKE CONCAT('%', '$video_title', '%')
             OR description LIKE CONCAT('%', '$video_description', '%')
         )
         LIMIT 10)
        UNION
        (SELECT *, -1 as priority
         FROM (
             SELECT *
             FROM videos
             WHERE id NOT IN (SELECT id FROM videos WHERE id <> $video_id AND user = '$video_user')
             AND id NOT IN (SELECT id FROM videos WHERE id <> $video_id AND user <> '$video_user')
             ORDER BY RAND()
             LIMIT 10
         ) AS random_videos
         ORDER BY views DESC
        )
        ORDER BY priority DESC, RAND()
        LIMIT 10";



// Execute the query
$result = $conn->query($sql);

// Check if the query was successful
if ($result === false) {
    // If there's an error, display the error message
    echo "Error executing query: " . $conn->error;
    exit; // Exit the script to prevent further execution
}

// Fetch the results into an array
$relatedVideos = $result->fetch_all(MYSQLI_ASSOC);

// Now you have the related videos in the $relatedVideos array
// You can use this data to display the related videos on your website

if (count($relatedVideos) > 0) {
    // Loop through each video and generate the HTML for related video thumbnails
    foreach ($relatedVideos as $row) {
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

// Uncomment and execute the update query to increment views count
$query = 'UPDATE your_table_name SET views = views + 1 WHERE id = ' . $video_id;
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
          <center>
  <!-- Telegram -->
  <!-- ... (previous social media icons) ... -->

  <!-- Copy Code Button -->
  <button class="btn btn-success" onclick="copyCodeToClipboard()">Copy Code</button>
</center>

<pre>
  <code class="language-html">
    &lt;div id="driveplyr<?php echo $id ?>"&gt;&lt;/div&gt;
    &lt;script player="plyr" src="https://driveplyr.appspages.online/player.js" data-id="<?php echo $id ?>" data-height="500px" data-width="100%" data-type="driveplyr" defer&gt;&lt;/script&gt;
  </code>
</pre>

<script>
  function copyCodeToClipboard() {
    const codeBlock = document.querySelector("pre code");
    const codeText = codeBlock.innerText;

    const textArea = document.createElement("textarea");
    textArea.value = codeText;
    document.body.appendChild(textArea);

    textArea.select();
    document.execCommand("copy");
    document.body.removeChild(textArea);

    alert("Code copied to clipboard!");
  }
</script>

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css"/>
<!-- ShareThis BEGIN --><div class="sharethis-inline-share-buttons"></div><!-- ShareThis END -->

<center>

<!-- Telegram -->
<a style="color: #ac2bac;" href="#!" role="button" onclick="shareToTelegram(); return false;">
  <i class="fab fa-telegram fa-lg"></i>
</a>

<!-- Facebook -->
<a style="color: #3b5998;" href="#!" role="button" onclick="shareToFacebook(); return false;">
  <i class="fab fa-facebook-f fa-lg"></i>
</a>

<!-- Twitter -->
<a style="color: #55acee;" href="#!" role="button" onclick="shareToTwitter(); return false;">
  <i class="fab fa-twitter fa-lg"></i>
</a>

<!-- Google
<a style="color: #dd4b39;" href="#!" role="button" onclick="shareToGoogle(); return false;">
  <i class="fab fa-google fa-lg"></i>
</a> -->

<!-- Instagram -->
<a style="color: #ac2bac;" href="#!" role="button" onclick="shareToInstagram(); return false;">
  <i class="fab fa-instagram fa-lg"></i>
</a>

<script>
  function shareToTelegram() {
    shareToSocialMedia('https://telegram.me/share/', getCurrentURLAndTitle());
  }

  function shareToFacebook() {
    shareToSocialMedia('https://www.facebook.com/sharer/sharer.php', getCurrentURLAndTitle());
  }

  function shareToTwitter() {
    shareToSocialMedia('https://twitter.com/intent/tweet', getCurrentURLAndTitle());
  }

  function shareToGoogle() {
    shareToSocialMedia('https://plus.google.com/share', getCurrentURLAndTitle());
  }

  function shareToInstagram() {
    shareToSocialMedia('https://www.instagram.com/share/url', getCurrentURLAndTitle());
  }

  function getCurrentURLAndTitle() {
    return {
      url: window.location.href,
      title: document.title
    };
  }

  function shareToSocialMedia(url, data) {
    var params = Object.keys(data).map(function (key) {
      return encodeURIComponent(key) + '=' + encodeURIComponent(data[key]);
    }).join('&');

    window.open(url + '?' + params, 'Share', 'width=600,height=400');
  }
</script>
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
                width:200px;
            }
        }
    </style>
    <!-- Include Bootstrap JS -->
  <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.1/dist/umd/popper.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.2/dist/js/bootstrap.bundle.min.js"></script>
  <?php


include 'tracker.php';


?>
</body>
</html>
