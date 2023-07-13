
<title><?php echo $title ?></title>
<link href="https://cdn.jsdelivr.net/gh/SH20RAJ/Sopplayer/sopplayer.min.css" rel="stylesheet" />
  <!--Here is the Css Library-->
<link rel="icon" href="../logo.png">
   <script src="https://rebrand.ly/SopPlayerJS" ></script>

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

</style>

    <video id="my-video" class="sopplayer" controls preload="auto" data-setup="{}" width= "100%" poster="<?php echo $poster_url ?>">
      <!--Use class="sopplayer" and data-setup="{}" -->
      <source src="<?php echo $videourl ?>" type="video/mp4" />
    </video>

    <!--Here is the JavaScript Library-->