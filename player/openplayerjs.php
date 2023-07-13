<link rel="icon" href="./logo.png" />
<title><?php echo $title ?></title>
 <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/openplayerjs@latest/dist/openplayer.min.css" />


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