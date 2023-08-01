<title><?php echo $title ?></title>
<link rel="icon" href="../logo.png">
<style>
  body {
    margin: 0;
    padding: 0;
    overflow: hidden;
  }
</style>
<script src="https://cdn.fluidplayer.com/v3/current/fluidplayer.min.js"></script>
<video poster="<?php echo $poster_url ?>" width="100%" id="video-id">
  <source src="<?php echo $videourl ?>" type="video/mp4" />
</video>

<script>
  var myFP = fluidPlayer(
    'video-id',
    {
      "layoutControls": {
        // Controls configuration...
      },
      <?php 
      if($monetization){
        echo '
          "vastOptions": {
            "adList": [
              {
                "roll": "preRoll",
                "vastTag": "' . $preRollURL . '",
                "adText": ""
              },
              {
                "roll": "midRoll",
                "vastTag": "' . $midRollURL . '",
                "adText": ""
              },
              {
                "roll": "postRoll",
                "vastTag": "' . $postRollURL . '",
                "adText": ""
              },
              {
                "roll": "onPauseRoll",
                "vastTag": "' . $PauseRollURL . '",
                "adText": ""
              }
            ],
            "adCTAText": false,
            "adCTATextPosition": ""
          }
        ';
      }
      ?>
    }
  );
</script>
