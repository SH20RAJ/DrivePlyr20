<!DOCTYPE html>
<html>
<head>
  <title><?php echo $title ?></title>
  <link rel="stylesheet" href="https://cdn.plyr.io/3.6.3/plyr.css">
  <script src="https://cdn.plyr.io/3.6.3/plyr.js"></script>
  <style>
    #player {
  position: fixed;
  top: 0;
  left: 0;
  width: 100vw;
  height: 100vh;
  background-color: #000; /* Set the background color to your preference */
  z-index: 9999; /* Adjust the z-index as needed */
}

  </style>
</head>
<body>
  <div id="player" class="plyr__video-container">
    <video class="plyr__video" controls>
      <source src="<?php echo $videourl ?>" type="video/mp4">
    </video>
  </div>
  <script>
    var player = new Plyr(document.querySelector('.plyr__video'));
  </script>
</body>
</html>