<!DOCTYPE html>
<html>
<head>
<script src="https://www.google.com/recaptcha/enterprise.js?render=6LdVlx0nAAAAADK-GzZf-wC3NDc1HEpb5mTrVoth"></script>

  <?php 
  include 'head.php';
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
          Card Here
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
            <form class="needs-validation" action="api/update_user.php" method="post" enctype="multipart/form-data">
  <h6 class="heading-small text-muted mb-6">Update User Information</h6>
  <div class="pl-lg-4">
    <div class="row">
      <div class="col-md-12">
        <div class="form-group">
          <label class="form-control-label" for="input-username">User Name</label>
          <input id="input-username" class="form-control" placeholder="User Name" name="username" value="" type="text" required>
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
          <input type="email" id="input-email" class="form-control" placeholder="Email" name="email" value="" required>
        </div>
      </div>
      <div class="col-lg-6">
        <div class="form-group">
          <label class="form-control-label" for="input-password">Password</label>
          <input type="password" id="input-password" class="form-control" placeholder="Password" name="password" required>
        </div>
      </div>
    </div>
    <div class="row">
      <div class="col-lg-12">
        <div class="form-group">
          <label class="form-control-label" for="input-icon-url">Icon URL</label>
          <input type="url" id="input-icon-url" class="form-control" placeholder="Icon URL" name="iconUrl" value="" required>
        </div>
      </div>
    </div>
    <div class="row">
      <div class="col-lg-12">
        <div class="form-group">
          <label class="form-control-label" for="input-description">Description</label>
          <textarea rows="3" class="form-control" placeholder="Description" name="description" required></textarea>
        </div>
      </div>
    </div>
    <div class="row">
      <div class="col-lg-12">
        <div class="form-group">
          <label class="form-control-label" for="input-website">Website</label>
          <input type="url" id="input-website" class="form-control" placeholder="Website" name="website" value="" required>
        </div>
      </div>
    </div>
  </div>
  <hr class="my-4"></hr>
  <button class="btn btn-primary btn-lg btn-block" type="submit">Update</button>
</form>

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
</body>
</html>
