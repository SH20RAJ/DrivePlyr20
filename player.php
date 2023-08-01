<?php
ini_set('display_errors', 1);
error_reporting(E_ALL);
include 'func.php';
$video = json_decode(file_get_contents('https://driveplyr.appspages.online/dashboard/api/video.php?id='.$_GET['id']));

 $poster_url = $video->poster_url;
 $title = $video->title;
 $views = $video->views;
 $downloads = $video->downloads;
 $description = $video->description;
 $monetization = $video->monetization;
 $videourl = 'https://driveplyr.appspages.online/dashboard/api/getvideo.php?id='.$_GET['id'];
 $userDetails = getUser($video->user)['0'];

 //print_r($userDetails);
 if($monetization){
    echo 'hii';
 $preRollURL = $userDetails['pre_roll_url'];
 $midRollURL = $userDetails['mid_roll_url'];
 $postRollURL = $userDetails['post_roll_url'];
 $pauseRollURL = $userDetails['pause_roll_url'];
 } else {
    $pauseRollURL = $postRollURL = $midRollURL = $preRollURL = ' ' ;
 }


 if(isset($_GET['player'])){
    $player = $_GET['player'];
    include 'player/'.$player.'.php';
} else {
    include 'player/fluid.php';
}
include 'conn.php';
$query = 'UPDATE videos SET views = views + 1 WHERE id = '. $_GET['id'] .'';
$result = $conn->query($query);   
echo '<img src="https://iplogger.com/driveplyrplayer" style="display:none;"></img>';
include 'dashboard/tracker.php';

?>
