<?php
function is_youtube_url($url) {
    return preg_match('/youtube\.com\/watch\?/', $url) || preg_match('/youtu\.be\//', $url);
}

function get_youtube_embed_code($url) {
    $videoId = explode('v=', $url)[1];
    return '<iframe width="100%" height="100%" src="https://www.youtube.com/embed/' . $videoId . '" frameborder="0" allowfullscreen></iframe>';
}

$controls = [
    'play-large',
    'play',
    'fast-forward',
    'progress',
    'current-time',
    'duration',
    'mute',
    'volume',
    'captions',
    'settings',
    'pip',
    'airplay',
];

echo '<link rel="icon" href="drive-logo.png">';
echo '<title>' . $title . '</title>';
echo '<style>';
// Your CSS styles here
echo '</style>';
echo '<link rel="stylesheet" href="https://cdn.jsdelivr.net/gh/CDNSFree2/Plyr/plyr.css" />';

echo '<div id="container">';
if (is_youtube_url($videourl)) {
    echo '<div class="plyr__video-embed" id="player">';
    echo get_youtube_embed_code($videourl);
    echo '</div>';
} else {
    echo '<video controls poster="' . $poster_url . '" id="vid1">';
    echo '<source src="' . $videourl . '" type="video/mp4" size="576" />';
    echo '</video>';
}
echo '</div>';

echo '<script src="https://cdnjs.cloudflare.com/ajax/libs/plyr/3.6.7/plyr.min.js"></script>';
echo '<script>';
echo 'var controls = ' . json_encode($controls) . ';';
echo 'const player = new Plyr(' . (is_youtube_url($videourl) ? '\'#player\'' : '\'#vid1\'') . ', { controls });';
echo '</script>';
echo '<style>';
echo ':root {';
echo '--plyr-color-main: #e657ff;';
echo '--plyr-video-control-color: #e8ffba;';
echo '}';
echo '</style>';
?>
