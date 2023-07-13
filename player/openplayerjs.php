<link rel="icon" href="./logo.png" />
<title><?php echo $title ?></title>
 <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/openplayerjs@latest/dist/openplayer.min.css" />
 <style>
html, body {
  height: 100%;
  margin: 0;
  padding: 0;
}

#player  {
  position: absolute;
  top: 0;
  left: 0;
  width: 100%;
  height: 100%;
  /*object-fit: cover;
  z-index: -1;*/
}
</style>

  <video class="op-player__media" id="player" controls playsinline width="100%">
            <source src="<?php echo $videourl ?>" type="video/mp4" />
  </video>

<hr>

<script src="https://cdn.jsdelivr.net/npm/openplayerjs@latest/dist/openplayer.min.js"></script>
<!-- Adding JavaScript CDN -->

<script>
   // Check the `API and events` link below for more options
    const player = new OpenPlayerJS('player');
    player.init();
</script>