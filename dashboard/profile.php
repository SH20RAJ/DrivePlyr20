 <?php 
  session_start();
  
  ?>
<!DOCTYPE html>
<html>
<head>
<script src="https://www.google.com/recaptcha/enterprise.js?render=6LdVlx0nAAAAADK-GzZf-wC3NDc1HEpb5mTrVoth"></script>

  <?php 
  include 'head.php';

include '../conn.php'; // Replace with the file containing your database connection code

if ($_SERVER["REQUEST_METHOD"] === "GET") {
    if (isset($_SESSION['id'])) {
        $id = $_SESSION['id'];

        // Validate and sanitize the ID (you should implement this)

        // Prepare the SQL query
        $sql = "SELECT * FROM users WHERE id = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("i", $id);

        // Execute the query
        $stmt->execute();

        // Get the result
        $result = $stmt->get_result();

        if ($result->num_rows > 0) {
            // Fetch user details
            $userDetails = $result->fetch_assoc();
            $name = $userDetails['name'];
            $user_name = $userDetails['username'] ;
            $email = $userDetails['email'];
            $avatar = $userDetails['avatar'] ?: 'https://i.imgur.com/n5MBy0m.jpg';
        } else {
            echo "User not found.";
        }

    } else {
        echo "Invalid request: No user ID provided.";
    }
} else {
    echo "Invalid request method.";
}
?>

</head>
<body>
  <!-- Sidenav -->
  <?php include 'nav.php' ?>
  <!-- Main content -->
  <div class="main-content" id="panel">
    <!-- Topnav -->
    <?php include 'topnav.php' ?>
    <!-- Page content -->
    <div class="container-fluid mt-6">
      <div class="row">
        <div class="col-xl-4 order-xl-2">
          
                  <div class="container mt-5">
                    <div class="card">
                      <div class="card-body text-center">
                        <!-- Circular logo with background image -->
                        <div class="user-logo mx-auto mb-4">
                          <!-- Replace 'logo.png' with the actual logo image URL -->
                          <img src="<?php echo $avatar ?>" alt="Logo">
                        </div>

                        <!-- User Name -->
                        <h4 class="card-title"><?php echo $name ?></h4>

                        <!-- Website -->
                        <p class="card-text"><a href="https://appspages.online" target="_blank">www.appspages.online</a></p>

                        <!-- Follow button (you can replace '#' with the follow action URL) -->
                        <button class="btn btn-primary mb-3" onclick="followUser('#')">Follow</button>

                        <!-- Row with number of followers, views, and videos -->
                        <div class="row text-center">
                          <div class="col">
                            <h5>100</h5>
                            <p>Followers</p>
                          </div>
                          <div class="col">
                            <h5>500</h5>
                            <p>Views</p>
                          </div>
                          <div class="col">
                            <h5>50</h5>
                            <p>Videos</p>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>



        </div>
        <div class="col-xl-8 order-xl-1">
          <div class="card">
            <div class="card-header">
              <div class="row align-items-center">
                <div class="col-8">
                  <h3 class="mb-0">Edit profile</h3>
                </div>
                <div class="col-4 text-right">
                  <button onclick="document.getElementById('preview').src = document.getElementById('input-url').value ;" class="btn btn-sm btn-primary">Preview</button>
                </div>
              </div>
            </div>
            <div class="card-body">
            <form id="userupdate" class="needs-validation" action="api/update_user.php" method="post" enctype="multipart/form-data">
  <h6 class="heading-small text-muted mb-6">Update User Information</h6>
  <div class="pl-lg-4">
    <div class="row">
      <div class="col-md-12">
        <div class="form-group">
          <label class="form-control-label" for="input-username">User Name</label>
          <input id="input-username" class="form-control" placeholder="User Name" name="username" value="<?php echo $userDetails['username'] ?>" type="text" required>
          <div class="invalid-feedback">
            Please enter a valid user name.
          </div>
        </div>
      </div>
    </div>
    <div class="row">
      <div class="col-lg-6">
        <div class="form-group">
          <label class="form-control-label" for="input-email">Email</label>
          <input type="email" id="input-email" class="form-control" placeholder="Email" name="email" value="<?php echo $email ?>" required>
        </div>
      </div>
      <div class="col-lg-6">
        <div class="form-group">
          <label class="form-control-label" for="input-name">Name</label>
          <input type="text" id="input-name" class="form-control" placeholder="Name" name="name" value="<?php echo $name ?>" required>
        </div>
      </div>
      <div class="col-lg-6">
        <div class="form-group">
          <label class="form-control-label" for="input-password">Password</label>
          <input type="password" id="input-password" class="form-control" placeholder="Enter New Password" name="password" >
        </div>
      </div>
    </div>
    <div class="row">
      <div class="col-lg-12">
        <div class="form-group">
          <label class="form-control-label" for="input-icon-url">Avatar</label>
          <input type="url" id="input-icon-url" class="form-control" placeholder="Icon URL" name="avatar" value="<?php echo $avatar ?>" required>
        </div>
      </div>
    </div>
    <div class="row">
      <div class="col-lg-12">
        <div class="form-group">
          <label class="form-control-label" for="input-description">Description</label>
          <textarea rows="3" class="form-control" placeholder="Description" name="description" required><?php echo $userDetails['description']; ?></textarea>
        </div>
      </div>
    </div>
    <div class="row">
      <div class="col-lg-12">
        <div class="form-group">
          <label class="form-control-label" for="input-website">Website</label>
          <input type="url" id="input-website" class="form-control" placeholder="Website" name="website" value="<?php echo $userDetails['website']; ?>" required>
        </div>
      </div>
    </div>
  </div>
  <hr class="my-4"></hr>
  <button class="btn btn-primary btn-lg btn-block" type="submit">Update</button>
</form>


<script>
    document.getElementById("userupdate").addEventListener("submit", function (event) {
        event.preventDefault();

        const form = event.target;
        const formData = new FormData(form);

        // Replace "your_api_endpoint" with the actual API endpoint URL
        const apiUrl = "./api/userupdate.php";

        fetch(apiUrl, {
            method: "POST",
            body: formData,
        })
        .then(response => response.text())
        .then(data => {
            // Handle the API response here, if needed
            console.log(data);
            alert(data);
        })
        .catch(error => {
            // Handle errors here, if any
            console.error(error);
            alert(error);
        });
    });
</script>

            </div>
          </div>
        </div>
      </div>
      <!-- Footer -->
      <?php include 'footer.php' ?>
    </div>
  </div>
  <!-- Argon Scripts -->
  <!-- Core -->
  <script src="https://cdn.jsdelivr.net/gh/creativetimofficial/argon-dashboard-bs4@main/assets/vendor/jquery/dist/jquery.min.js"></script>
  <script src="https://cdn.jsdelivr.net/gh/creativetimofficial/argon-dashboard-bs4@main/assets/vendor/bootstrap/dist/js/bootstrap.bundle.min.js"></script>
  <script src="https://cdn.jsdelivr.net/gh/creativetimofficial/argon-dashboard-bs4@main/assets/vendor/js-cookie/js.cookie.js"></script>
  <script src="https://cdn.jsdelivr.net/gh/creativetimofficial/argon-dashboard-bs4@main/assets/vendor/jquery.scrollbar/jquery.scrollbar.min.js"></script>
  <script src="https://cdn.jsdelivr.net/gh/creativetimofficial/argon-dashboard-bs4@main/assets/vendor/jquery-scroll-lock/dist/jquery-scrollLock.min.js"></script>
  <!-- Argon JS -->
  <script src="https://cdn.jsdelivr.net/gh/creativetimofficial/argon-dashboard-bs4@main/assets/js/argon.js?v=1.2.0"></script>
  <script>
    document.addEventListener('DOMContentLoaded', function() {
      checkVideoURL();
    });
  </script>
  <style>
   /* Custom CSS for the circular logo with background image */
    .user-logo {
                      width: 150px;
                      height: 150px;
                      border-radius: 50%;
                      background-color: #f2f2f2;
                      display: flex;
                      align-items: center;
                      justify-content: center;
                      overflow: hidden;
                      background-image: url('background.jpg'); /* Replace 'background.jpg' with the actual background image URL */
                      background-size: cover;
                    }
                    .user-logo img {
                      max-width: 100%;                
                      max-height: 100%;
                    }                 
                  </style>
</body>
</html>
