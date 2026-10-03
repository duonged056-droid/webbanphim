<?php
function getImage($query) {
    $html = @file_get_contents("https://html.duckduckgo.com/html/?q=" . urlencode($query . " keyboard"));
    if ($html) {
        preg_match('/<img[^>]+src="\/\/([^"]+)"/', $html, $matches);
        if (isset($matches[1])) {
            return "https://" . $matches[1];
        }
    }
    return "https://placehold.co/600x400/2a2a2a/FFFFFF/png?text=" . urlencode($query);
}

echo "Aula F75: " . getImage("Aula F75") . "\n";
echo "Rainy75: " . getImage("Rainy75") . "\n";
