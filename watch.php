<?php 

include 'conn.php';
$id = $_GET['id'];


?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Video Watch Page</title>
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootswatch@4.5.2/dist/lux/bootstrap.min.css">
</head>
<body>

  <!-- Navbar -->
  <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <div class="container">
      <a class="navbar-brand" href="#">Video Watch Page</a>

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
        <h2 class="mt-3">Sample Video Title</h2>
        <p>Description of the sample video goes here.</p>
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
  <h3>Related Videos</h3>
  <div class="list-group">
    <!-- Sample related video thumbnails -->
    <a href="#" class="list-group-item">
      <img src="https://via.placeholder.com/350x200" class="img-fluid rounded" alt="Sample Video 1">
      <p class="mt-2">Perfect Nature Scene</p>
    </a>
    <a href="#" class="list-group-item">
      <img src="https://via.placeholder.com/350x200" class="img-fluid rounded" alt="Sample Video 2">
      <p class="mt-2">Stunning Wildlife Footage</p>
    </a>
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
