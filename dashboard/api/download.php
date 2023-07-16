<?php

header('Content-Type: video/mp4');
header('Content-Disposition: inline');

readfile($url);
exit();
?>
