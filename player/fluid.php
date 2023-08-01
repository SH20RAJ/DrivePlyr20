
<title><?php echo $title ?></title>
<link rel="icon" href="../logo.png">
<style>
  body {
    margin : 0;
    padding: 0;
  }
</style>
<script src="https://cdn.fluidplayer.com/v3/current/fluidplayer.min.js"></script>
<video poster="<?php echo $poster_url ?>" 
width="100%" id="video-id">
<source src="<?php echo $videourl ?>" type="video/mp4" />

<script>
    var myFP = fluidPlayer(
        'video-id',	{
	"layoutControls": {
		"controlBar": {
			"autoHideTimeout": 3,
			"animated": true,
			"autoHide": false
		},
		"htmlOnPauseBlock": {
			"html": null,
			"height": null,
			"width": null
		},
		"autoPlay": true,
		"mute": false,
		"allowTheatre": true,
		"playPauseAnimation": true,
		"playbackRateEnabled": true,
		"allowDownload": true,
		"playButtonShowing": true,
		"fillToContainer": true,
		"primaryColor": "blue",
		"posterImage": ""
	},
	"vastOptions": {
		"adList": [
			{
				"roll": "preRoll",
				"vastTag": "<?php echo $preRollURL ?>",
				"adText": ""
			},
			{
				"roll": "midRoll",
				"vastTag": "<?php echo $midRollURL ?>",
				"adText": ""
			},
			{
				"roll": "postRoll",
				"vastTag": "<?php echo $postRollURL ?>",
				"adText": ""
			},
			{
				"roll": "onPauseRoll",
				"vastTag": "<?php echo $PauseRollURL ?>",
				"adText": ""
			}
		],
		"adCTAText": false,
		"adCTATextPosition": ""
	}
});
</script>
