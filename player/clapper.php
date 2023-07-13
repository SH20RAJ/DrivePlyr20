
<title><?php echo $title ?></title>
<link href="https://cdn.jsdelivr.net/gh/SH20RAJ/Sopplayer/sopplayer.min.css" rel="stylesheet" />
  <!--Here is the Css Library-->
<link rel="icon" href="../logo.png">
<script type="text/javascript" src="https://cdn.jsdelivr.net/npm/@clappr/player@latest/dist/clappr.min.js"></script>


<style>
  html, body {
  height: 100%;
  margin: 0;
  padding: 0;
}

#player {
  position: absolute;
  top: 0;
  left: 0;
  width: 100%;
  height: 100%;
}


</style>
    <div id="player"></div>
  <script>
    var player = new Clappr.Player({source: "<?php echo $videourl ?>", parentId: "#player"});
  </script>

    <!--Here is the JavaScript Library-->