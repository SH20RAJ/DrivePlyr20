<?php

$video = json_decode(file_get_contents('https://driveplyr.appspages.online/dashboard/api/video.php?id='.$_GET['id']));

print_r($video);
echo $poster = $video['poster_url'];
echo $title = $video['title'];
echo $views = $video['views'];
echo $downloads = $video['downloads'];
echo $description = $video['description'];


?>
