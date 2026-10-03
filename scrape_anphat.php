<?php
$html = file_get_contents('https://www.anphatpc.com.vn/ban-phim-co.html');
preg_match_all('/<a[^>]*href="([^"]+)"[^>]*>\s*<img[^>]*src="([^"]+)"[^>]*alt="([^"]+)"/i', $html, $matches);
for ($i = 0; $i < min(10, count($matches[3])); $i++) {
    echo "Title: " . $matches[3][$i] . " - Img: " . $matches[2][$i] . "\n";
}
