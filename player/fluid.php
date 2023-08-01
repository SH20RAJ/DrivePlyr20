
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
		"autoPlay": false,
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
				"vastTag": "https://pubads.g.doubleclick.net/gampad/ads?iu=/21775744923/external/vmap_ad_samples&sz=640x480&cust_params=sample_ar%3Dpreonly&ciu_szs=300x250%2C728x90&gdfp_req=1&ad_rule=1&output=vmap&unviewed_position_start=1&env=vp&impl=s&correlator=",
				"adText": ""
			},
			{
				"roll": "midRoll",
				"vastTag": "https://pubads.g.doubleclick.net/gampad/ads?iu=/21775744923/external/vmap_ad_samples&sz=640x480&cust_params=sample_ar%3Dpremidpostoptimizedpodbumper&ciu_szs=300x250&gdfp_req=1&ad_rule=1&output=vmap&unviewed_position_start=1&env=vp&impl=s&cmsid=496&vid=short_onecue&correlator=",
				"adText": ""
			},
			{
				"roll": "postRoll",
				"vastTag": "https://pubads.g.doubleclick.net/gampad/ads?iu=/21775744923/external/vmap_ad_samples&sz=640x480&cust_params=sample_ar%3Dpremidpostoptimizedpodbumper&ciu_szs=300x250&gdfp_req=1&ad_rule=1&output=vmap&unviewed_position_start=1&env=vp&impl=s&cmsid=496&vid=short_onecue&correlator=",
				"adText": ""
			},
			{
				"roll": "onPauseRoll",
				"vastTag": "https://pubads.g.doubleclick.net/gampad/ads?iu=/21775744923/external/vmap_ad_samples&sz=640x480&cust_params=sample_ar%3Dpremidpostoptimizedpodbumper&ciu_szs=300x250&gdfp_req=1&ad_rule=1&output=vmap&unviewed_position_start=1&env=vp&impl=s&cmsid=496&vid=short_onecue&correlator=",
				"adText": ""
			}
		],
		"adCTAText": false,
		"adCTATextPosition": ""
	}
});
</script>
