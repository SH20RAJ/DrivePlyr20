
<link rel="icon" href="drive-logo.png">
<title><?php echo $title ?></title>
<style>
html, body {
  height: 100%;
  margin: 0;
  padding: 0;
}

.plyr  {
  position: absolute;
  top: 0;
  left: 0;
  width: 100%;
  height: 100%;
  /*object-fit: cover;
  z-index: -1;*/
}
</style>

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/gh/CDNSFree2/Plyr/plyr.css" />
    <?php
function is_youtube_url($url) {
    return preg_match('/youtube\.com\/watch\?/', $url) || preg_match('/youtu\.be\//', $url);
}
?>

    <div id="container">
        <?php
        if (is_youtube_url($videourl)) {
            echo '<div class="plyr__video-embed" id="player">';
            echo get_youtube_embed_code($videourl);
            echo '</div>';
        } else {
            echo '<video controls poster="' . $poster_url . '" id="vid1">';
            echo '<source src="' . $videourl . '" type="video/mp4" size="576" />';
            echo '</video>';
        }
        ?>
    </div>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/plyr/3.6.7/plyr.min.js"></script>
    <script>
        var controls = [
            // Your existing controls here
        ];

        const player = new Plyr(isYouTubeVideo() ? '#player' : '#vid1', { controls });

        function is_youtube_url(url) {
            return /youtube\.com\/watch\?/.test(url) || /youtu\.be\//.test(url);
        }

        function get_youtube_embed_code(url) {
            var videoId = url.split('v=')[1];
            return '<iframe width="100%" height="100%" src="https://www.youtube.com/embed/' + videoId + '" frameborder="0" allowfullscreen></iframe>';
        }
    </script>


<style>
  :root {
  --plyr-color-main: #e657ff;
    --plyr-video-control-color  :#e8ffba;
}

</style>


