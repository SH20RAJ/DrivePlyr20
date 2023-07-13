
<title><?php echo $title ?></title>

<link rel="icon" href="../logo.png">

<link rel="stylesheet" href="https://cdn.jsdelivr.net/gh/sh20raj/SopPlayer@main/CatSu/catsu.min.css"/>
<link rel='stylesheet' href='https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css'>
<link rel='stylesheet' href='https://fonts.googleapis.com/css?family=Questrial'>

<style>
  html, body {
  height: 100%;
  margin: 0;
  padding: 0;
}

#my-video {
  position: absolute;
  top: 0;
  left: 0;
  width: 100%;
  height: 100%;
}

.vjs-poster {
  background-color: transparent;
}

</style>

<video
id="my-video" class="video-js"
controls  poster="<?php echo $poster_url ?>" data-setup='' loop>

<source src="<?php echo $videourl ?>" type='video/mp4'/>

</video>

<script src="https://cdn.jsdelivr.net/gh/sh20raj/SopPlayer@main/CatSu/catsu.min.js"></script>