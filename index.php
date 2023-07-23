<?php

include 'func.php';


?>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />

    <!-- Material Icons -->

    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet" />
    <!-- CSS File -->
    <link rel="stylesheet" href="styles.css" />
    <title>Final - Youtube UI Clone</title>
  </head>
  <body>
    <!-- Header Starts -->
    <div class="header">
      <div class="header__left">
        <i id="menu" class="material-icons">menu</i>
        <img
          src="https://driveplyr.appspages.online/dp.png"
          alt=""
        />
      </div>

      <div class="header__search">
        <form action="">
          <input type="text" placeholder="Search" />
          <button><i class="material-icons">search</i></button>
        </form>
      </div>

      <div class="header__icons">
        <i class="material-icons display-this">search</i>
        <i class="material-icons">videocam</i>
        <i class="material-icons">apps</i>
        <i class="material-icons">notifications</i>
       <a href="./dashboard/"><i class="material-icons display-this">account_circle</i></a>
      </div>
    </div>
    <!-- Header Ends -->

    <!-- Main Body Starts -->
    <div class="mainBody">
      <!-- Sidebar Starts -->
      <div class="sidebar">
        <div class="sidebar__categories">
          <div class="sidebar__category">
            <i class="material-icons">home</i>
            <span>Home</span>
          </div>
          <div class="sidebar__category">
            <i class="material-icons">local_fire_department</i>
            <span>Trending</span>
          </div>
          <div class="sidebar__category">
            <i class="material-icons">subscriptions</i>
            <span>Subcriptions</span>
          </div>
        </div>
        <hr />
        <div class="sidebar__categories">
          <div class="sidebar__category">
            <i class="material-icons">library_add_check</i>
            <span>Library</span>
          </div>
          <div class="sidebar__category">
            <i class="material-icons">history</i>
            <span>History</span>
          </div>
          <div class="sidebar__category">
            <i class="material-icons">play_arrow</i>
            <span>Your Videos</span>
          </div>
          <div class="sidebar__category">
            <i class="material-icons">watch_later</i>
            <span>Watch Later</span>
          </div>
          <div class="sidebar__category">
            <i class="material-icons">thumb_up</i>
            <span>Liked Videos</span>
          </div>
        </div>
        <hr />
      </div>
      <!-- Sidebar Ends -->

      <!-- Videos Section -->
      <div class="videos">
        <h1>Recommended</h1>

        <div class="videos__container">
        <?php
        
        
        // Example usage:
        $viewsCount = 1000;

        include 'conn.php';
// Retrieve the video list from the database
$user = $_SESSION['id'];
$sql = "SELECT * FROM videos order by id desc limit 200";
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

        echo '          <!-- Single Video starts -->
        <div class="video">
          <div class="video__thumbnail">
            <img src="'.$videoPosterURL.'" alt="" />
          </div>
          <div class="video__details">
            <div class="author">
              <img src="http://aninex.com/images/srvc/web_de_icon.png" alt="" />
            </div>
            <div class="title">
              <h3>
              <a href="watch/'.$videoId.'">
                '.$videoTitle.'
              </a>
                </h3>
              <a href="">FutureCoders</a>
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


        </div>
      </div>
    </div>
    <script>
        const menu = document.querySelector('#menu');
console.log(menu);
const sidebar = document.querySelector('.sidebar');
console.log(sidebar);

menu.addEventListener('click', function () {
  sidebar.classList.toggle('show-sidebar');
});

    </script>
    <!-- Main Body Ends -->
  </body>
</html>