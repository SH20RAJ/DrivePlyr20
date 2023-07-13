<?php

$video = json_decode(file_get_contents('https://driveplyr.appspages.online/dashboard/api/video.php?id='.$_GET['id']));

 $poster_url = $video->poster_url;
 $title = $video->title;
 $views = $video->views;
 $downloads = $video->downloads;
 $description = $video->description;
 $videourl = 'https://driveplyr.appspages.online/dashboard/api/getvideo.php?id='.$_GET['id'];

 if(isset($_GET['player'])){
    $player = $_GET['player'];
    include 'player/'.$player.'.php';
} else {
    include 'player/plyr.php';
}

?>
