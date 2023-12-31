<?php
session_start();

// Check if the user is logged in (session is set)
$isLoggedIn = isset($_SESSION['username']);
include 'func.php';
?>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="shortcut icon" href="logo.png" type="image/x-icon">
    <!-- Material Icons -->
    <script type='text/javascript' src='https://platform-api.sharethis.com/js/sharethis.js#property=64bd1f4e71afd40013e96b95&product=sop' async='async'></script>
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet" />
    <!-- CSS File -->
    <link rel="stylesheet" href="styles.css" />
    <title><?php echo $_GET['q'] ?> - Search - DrivePlyr</title>
    <style>

    </style>
<meta name="theme-color" content="#007bff">
<link rel="manifest" href="manifest.json">

<script>
    // Check if the browser supports the beforeinstallprompt event
    if ('serviceWorker' in navigator && 'BeforeInstallPromptEvent' in window) {
      window.addEventListener('load', () => {
        // Wait for the beforeinstallprompt event
        window.addEventListener('beforeinstallprompt', (event) => {
          // Prevent the default "Add to Home Screen" prompt
          event.preventDefault();

          // Automatically show the "Add to Home Screen" prompt on page load
          event.prompt();
        });
      });
    }
  </script>
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
      <form action="search.php">
          <input name="q" type="text" placeholder="Search" value="<?php echo $_GET['q'] ?>"/>
          <button type="submit"><i class="material-icons">search</i></button>
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
            <a href="../../"><span>Home</span></a>
          </div>
          <div class="sidebar__category">
            <i class="material-icons">local_fire_department</i>
            <span>Trending</span>
          </div>
          <div class="sidebar__category">
            <i class="material-icons">subscriptions</i>
            <a href="../../sitemaps.php"><span>Sitemaps</span></a>
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
          <div class="sidebar__category">
            <!-- <i class="material-icons">thumb_up</i> -->
           <a href="tos.php"><span>Terms of Service</span></a> 
          </div>
        </div>
        <hr />
      </div>
      <!-- Sidebar Ends -->

      <!-- Videos Section -->
      <div class="videos">
     <center>
      <div class="header__search" style="display:block;">
      <form action="search.php">
          <input name="q" type="text" placeholder="Search" value="<?php echo $_GET['q'] ?>"/>
          <button type="submit"><i class="material-icons">search</i></button>
        </form>
      </div>
    </center>
        <h1>Recommended</h1>

        <div class="videos__container">
        <?php
include 'conn.php';

// Sanitize the search query to prevent SQL injection
$searchQuery = $_GET['q'];
$searchQuery = '%' . $searchQuery . '%';

// Prepare the SQL query with placeholders for the search query
$sql = "SELECT *
        FROM videos
        WHERE title LIKE '$searchQuery'
        OR description LIKE '$searchQuery'
        LIMIT 10";

// Execute the query
$result = mysqli_query($conn, $sql);

// Check if the query was successful and has results
if ($result && mysqli_num_rows($result) > 0) {
    // Loop through each video and generate the HTML for related video thumbnails
    while ($row = mysqli_fetch_assoc($result)) {
        $videoId = $row['id'];
        $videoTitle = $row['title'];
        $videoPosterURL = $row['poster_url'] ?: 'https://driveplyr.appspages.online/dashboard/api/Image_not_available.png';
        $videoStatus = 'Public'; //$row['status'];
        $videoViews = $row['views'];
        $videoDownloads = $row['downloads'];
        $videoScore = '100%'; //$row['progress'];
        $userid = $row['user'];

        echo '
        <!-- Single Video starts -->
        <div class="video">
          <div class="video__thumbnail">
            <a href="watch/' . $videoId . '/' . generateSlug($videoTitle) . '">
              <img src="' . $videoPosterURL . '" alt="" />
            </a>
          </div>
          <div class="video__details">
            <div class="author">
              <img src="http://aninex.com/images/srvc/web_de_icon.png" alt="" />
            </div>
            <div class="title">
              <h3>
                <a href="watch/' . $videoId . '/' . generateSlug($videoTitle) . '">
                  ' . $videoTitle . '
                </a>
              </h3>
              <a href="channel/' . $userid . '">' . getUser($userid)[0]->name . '</a>
              <span>' . formatViewsCount($videoViews) . ' Views • ' . convertToRelativeTime($row['date']) . '</span>
            </div>
          </div>
        </div>
        <!-- Single Video Ends -->';
    }
} else {
    echo '<p>No videos found.</p>';
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

<?php 


$html = <<<HTML
    <script src="https://accounts.google.com/gsi/client" async defer></script>
<div id="g_id_onload"
     data-client_id="911384899570-6qiojk3cl3e47jjorfj9att0l1a8gg59.apps.googleusercontent.com"
     data-callback="handleCredentialResponse">
</div>
<div class="g_id_signin" data-type="standard"></div>

<script>
  function handleCredentialResponse(response) {
    if (response.credential) {
      const credential = response.credential;
      const jwtToken = credential;

      // Decode and parse the JWT token to access user details
      const userTokenData = JSON.parse(atob(jwtToken.split('.')[1]));

      console.log(userTokenData)
      // Check if the required user details are available
      if (userTokenData.email && userTokenData.name) {
        const email = userTokenData.email;
        const fullName = userTokenData.name;
        const profilePicture = userTokenData.picture;

        // Log user details to the console
        console.log('Email: ' + email);
        console.log('Full Name: ' + fullName);
        console.log('Profile Picture: ' + profilePicture);
        // Perform further actions with the user details as needed
        // Now, let's post the data to the server using fetch
        const url = 'api/google.php'; // Replace this with the correct endpoint URL
        const data = {
          email: email,
          fullName: fullName,
          profilePicture: profilePicture
        };

        fetch(url, {
          method: 'POST',
          headers: {
            'Content-Type': 'application/json'
          },
          body: JSON.stringify(data)
        })
        .then(response => response.json())
        .then(data => {
          // Handle the response from the server if needed
          console.log('Server Response:', data);
        })
        .catch(error => {
          console.error('Error posting data:', error);
        });
      } else {
        console.log('User details not available in the token.');
      }
    } else {
      // Handle the case where no credential is received or the user cancels the sign-in
      console.log('No credential received or user canceled the sign-in.');
    }
  }
</script>
HTML;


if(!$isLoggedIn){
echo $html;
}


include 'tracker.php';

include 'api/ref.php';


?>

<script>
    // Function to remove query strings from the URL
    function removeQueryStrings() {
      // Get the current URL
      var currentURL = window.location.href;

      // Check if the URL contains any query strings (i.e., '?')
      if (currentURL.includes('?')) {
        // Remove the query strings by taking the URL before the '?'
        var newURL = currentURL.split('?')[0];

        // Update the browser URL without reloading the page
       // window.history.replaceState({}, document.title, newURL);
      }
    }

    // Call the function to remove query strings when the page loads
    window.onload = removeQueryStrings;
  </script>

    <!-- Main Body Ends -->
  </body>
</html>
