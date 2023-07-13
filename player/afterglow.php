
<title><?php echo $title ?></title>
<link rel="icon" href="../logo.png">
<style>
html, body {
  height: 100%;
  margin: 0;
  padding: 0;
}

.afterglow  {
  position: absolute;
  top: 0;
  left: 0;
  width: 100%;
  height: 100%;
}
</style>

<video class="afterglow" id="my-video" width="1280" height="720" data-skin="dark" poster="<?php echo $poster_url ?>">
        <source type="video/mp4" src="<?php echo $videourl ?>" />
    </video>

<script type="text/javascript" src="https://cdn.jsdelivr.net/npm/afterglowplayer@1.x"></script>
