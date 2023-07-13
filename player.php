<?php

$video = json_decode(file_get_contents('https://driveplyr.appspages.online/dashboard/api/video.php?id='.$_GET['id']));

print_r($video);
if(isset($_GET['player'])){
  $player = $_GET['player'];
}
$videourl = 'https://driveplyr.appspages.online/dashboard/api/getvideo.php?id='.$_GET['id'];
$title = 
include 'player/griffith.php';

?>
