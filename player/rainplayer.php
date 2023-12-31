
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <link rel="icon" href="./logo.png" />
  <link rel="stylesheet" href="https://sh20raj.github.io/Sopplayer/rainplayer/styles/style.css" />
  <link rel="preconnect" href="https://fonts.googleapis.com" />
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@100;400;700&display=swap" rel="stylesheet" />
  <title><?php echo $title ?></title>
</head>

<body>
  <main id="wrapper" class="wrapper">
    <div class="player">
      <div class="player-overlay" data-fullscreen="false">
        <div class="container">
          <div class="information-container">
            <h2 id="title" class="title"><?php echo $title ?></h2>
            <p id="description" class="description">
              <?php echo $description ?>
            </p>
          </div>
          <div class="player-container">
            <div class="video-progress">
              <div class="video-progress-filled"></div>
            </div>
            <div class="player-controls">
              <div class="player-buttons">
                <button aria-label="play" class="button play" title="play" type="button"></button>
                <button aria-label="pause" class="button pause" hidden title="pause" type="button"></button>
                <button aria-label="backward" class="button backward" title="backward" type="button"></button>
                <button aria-label="forward" class="button forward" title="forward" type="button"></button>
                <button aria-label="volume" class="button volume" title="volume" type="button"></button>
                <button aria-label="silence" class="button silence" hidden title="silence" type="button"></button>
                <div class="volume-progress">
                  <div class="volume-progress-filled"></div>
                </div>
                <div class="time-container">
                  <p class="current-time">0:00</p>
                  <p class="time-separator">/</p>
                  <p class="duration-video">0:00</p>
                </div>
              </div>
              <div class="expand-container">
                <button aria-label="expand" class="button expand" title="expand" type="button"></button>
                <button aria-label="reduce" class="button reduce" hidden title="reduce" type="button"></button>
              </div>
            </div>
          </div>
        </div>
      </div>
      <video id="video" class="video" poster="<?php echo $poster_url ?>" src="<?php echo $videourl ?>"></video>
    </div>
  </main>
  <script src="https://sh20raj.github.io/Sopplayer/rainplayer/js/index.js"></script>

</body>

</html>