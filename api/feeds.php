<?php
session_start(); 

error_reporting(E_ALL);
ini_set('display_errors', 1);

include "../conn.php";
// Retrieve the video list from the database
// $user = $_SESSION['id'];
// $uploader = $_GET['id'];

// $limit = isset($_GET['limit'])?$limit:20;
$sql = isset($sql) ? $sql : "SELECT * FROM videos limit 20";//ORDER BY RAND() LIMIT ".$limit."";

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
        $userid = $row['user'];

        echo '          <!-- Single Video starts -->
        <div class="video">
          <div class="video__thumbnail">
          <a href="../watch/'.$videoId.'/'.generateSlug($videoTitle).'">
          <img src="'.$videoPosterURL.'" alt="" />
          </a>
          </div>
          <div class="video__details">
            <div class="author">
              <img src="'.$logo.'" alt="" />
            </div>
            <div class="title">
              <h3>
              <a href="../watch/'.$videoId.'/'.generateSlug($videoTitle).'">
                '.$videoTitle.' 
              </a>
                </h3>
              <a href="../channel/'.$userid.'">'.getUser($userid)[0]->name.'</a>
              <span>'.formatViewsCount($videoViews).' Views • '.convertToRelativeTime($row['date']).'</span>
            </div>
          </div>
        </div>
        <!-- Single Video Ends -->
';
    }
} else {
    echo '<tr><td colspan="6">No videos found.</td></tr>';
}
?>
