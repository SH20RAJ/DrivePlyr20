<?php

if(isset($_GET['player'])){
  $player = $_GET['player'];
}
$videourl = 'https://driveplyr.appspages.online/dashboard/api/getvideo.php?id='.$_GET['id'];
include 'player/griffith.php';

?>
