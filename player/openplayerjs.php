<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/openplayerjs@latest/dist/openplayer.min.css" />
<!-- Adding Css CDN -->


  <video class="op-player__media" id="player" controls playsinline width="100%">
            <source src="https://archive.org/download/sample-video_202306/SampleVideo.mp4" type="video/mp4" />
  </video>

<hr>

<script src="https://cdn.jsdelivr.net/npm/openplayerjs@latest/dist/openplayer.min.js"></script>
<!-- Adding JavaScript CDN -->

<script>
   // Check the `API and events` link below for more options
    const player = new OpenPlayerJS('player');
    player.init();
</script>