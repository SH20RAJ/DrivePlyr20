
<title><?php echo $title ?></title>
<link rel="icon" href="../logo.png">
<link href="https://cdn.jsdelivr.net/npm/vlitejs@4/dist/vlite.css" rel="stylesheet" />
<style>
  html, body {
  height: 100%;
  margin: 0;
  padding: 0;
}

.v-vlite {
  position: absolute;
  top: 0;
  left: 0;
  width: 100%;
  height: 100%;
}

</style>

<video poster="<?php echo $poster_url ?>" 
height="100%" width="100%" id="player" 
class="vlite-js" 
src="<?php echo $videourl ?>"></video>

<script src="https://cdn.jsdelivr.net/npm/vlitejs@4" ></script>
<script>
  new Vlitejs('#player');
</script>