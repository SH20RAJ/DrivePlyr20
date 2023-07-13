
<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title><?php echo $title ?></title>
    <link rel="stylesheet" href="https://hunzaboy.github.io/Ckin-Video-Player/dist/css/ckin.css">
    <link rel="icon" type="image/png" href="../logo.png" sizes="32x32">
    
    <style>
html, body {
  height: 100%;
  margin: 0;
  padding: 0;
}

#player, .ckin__player  {
  position: absolute;
  top: 0;
  left: 0;
  width: 100%;
  height: 100%;
  /*object-fit: cover;
  z-index: -1;*/
}
</style>
</head>

<body>

    <video poster="<?php echo $poster_url ?>" src="<?php echo $videourl ?>" data-ckin="default"></video>
       
    <script src="https://cdn.jsdelivr.net/gh/SH20RAJ/Sopplayer@main/ckin/ckin.js"></script>
  
</body>

</html>
