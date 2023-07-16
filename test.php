<?php
$videoUrl = "https://downloadmovie1click.online/Transformers.Rise.Of.The.Beasts.2023.mp4";
$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, $videoUrl);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1); 
curl_setopt($ch, CURLOPT_HEADER, 0);
$out = curl_exec($ch);
curl_close($ch);


header('Content-type: video/mp4');
header('Content-type: video/mpeg');
header('Content-disposition: inline');
header("Content-Transfer-Encoding:­ binary");
header("Content-Length: ".filesize($out));
echo $out;
exit();
?>
