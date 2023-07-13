<!DOCTYPE html>
<html>
<head>
  <title><?php echo $title ?></title>
  <link rel="stylesheet" href="https://cdn.plyr.io/3.6.3/plyr.css">
  <script src="https://cdn.plyr.io/3.6.3/plyr.js"></script>
</head>
<body>
  <div class="plyr__video-container">
    <video class="plyr__video" controls>
      <source src="<?php echo $videourl ?>" type="video/mp4">
    </video>
  </div>
  <script>
    var player = new Plyr(document.querySelector('.plyr__video'));
  </script>
</body>
</html>