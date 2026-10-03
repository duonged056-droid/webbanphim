<?php
$html = @file_get_contents('https://hacom.vn/ban-phim-co');
preg_match_all('/<img[^>]+data-src="([^"]+)"[^>]*alt="([^"]+)"/i', $html, $matches);
if (empty($matches[1])) {
    preg_match_all('/<img[^>]+src="([^"]+)"[^>]*alt="([^"]+)"/i', $html, $matches);
}
for ($i = 0; $i < min(20, count($matches[1])); $i++) {
    $url = $matches[1][$i];
    if (strpos($url, 'http') === false) $url = 'https://hacom.vn' . $url;
    echo trim($matches[2][$i]) . " | " . $url . "\n";
}
