<?php

header('Content-Type: video/mp4');
header('Content-Disposition: inline');
$url = $_GET['url'];
readfile($url);
exit();
?>
