<!DOCTYPE html>
<html>
<head>
  <title>Video Player</title>
  <style>
    #player {
  position: fixed;
  top: 0;
  left: 0;
  width: 100vw;
  height: 100vh;
  background-color: #000; /* Set the background color to your preference */
  z-index: 9999; /* Adjust the z-index as needed */
}

  </style>
</head>
<body>
    <div id="player"></div>
    <script
      crossorigin
      src="https://unpkg.com/griffith-standalone/dist/index.umd.min.js"
    ></script>
    <script>
            // Get the video ID from the URL parameters
    const urlParams = new URLSearchParams(window.location.search);
    const videoID = urlParams.get('id');
    const videoURL = `https://driveplyr.appspages.online/dashboard/api/getvideo.php?id=${videoID}`;
    const target = document.getElementById('player')
    
      const sources = {
        hd: {
          play_url: videoURL,
        },
        sd: {
          play_url: videoURL,
        },
      }
    
      // create player instance
      const player = Griffith.createPlayer(target)
    
      // load video
      player.render({sources})
    
      // dispose video
      //player.dispose();//This sunction will remove your player
    </script>
    


</body>
</html>
