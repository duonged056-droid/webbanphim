<?php
$html = file_get_contents('https://akko.vn/danh-muc/ban-phim-co/');
preg_match_all('/<img[^>]+src="([^"]+)"/', $html, $matches);
$urls = array_filter($matches[1], function($url) {
    return strpos($url, '.jpg') !== false || strpos($url, '.png') !== false;
});
foreach(array_slice(array_unique($urls), 0, 10) as $url) {
    echo $url . "\n";
}
