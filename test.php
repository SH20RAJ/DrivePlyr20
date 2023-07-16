<?php
$videoUrl = "https://downloadmovie1click.online/Transformers.Rise.Of.The.Beasts.2023.mp4";

header('Content-Type: video/mp4');
readfile($videoUrl);
