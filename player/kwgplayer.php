
<title><?php echo $title ?></title>
<link rel="icon" href="../logo.png">
<link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/gh/webgadgets/KwgVideoPlayer@master/kwg-video-player.css" />
<script src="https://cdn.jsdelivr.net/gh/webgadgets/KwgVideoPlayer@master/kwg-video-player.js"></script>
<style>
  html, body {
  height: 100%;
  margin: 0;
  padding: 0;
}

#video1 ,.kwg-video-player-container {
  position: absolute;
  top: 0;
  left: 0;
  width: 100%;
  height: 100%;
}

</style>


<video width="100%" height="100%" id="video1" poster="<?php echo $poster_url ?>">
    <source src="<?php echo $videourl ?>" type="video/mp4">
</video>


<script>
  new kwgVideo('#video1');
</script>