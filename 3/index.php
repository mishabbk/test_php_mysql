<?php

function addHashToHtmlImg(string $html): string
{
    $hash = mt_rand(1000000, 9999999);
    $dom = new DOMDocument();
    $dom->loadHTML($html, LIBXML_HTML_NOIMPLIED | LIBXML_HTML_NODEFDTD);
    $images = $dom->getElementsByTagName('img');
    foreach ($images as $image) {
        $src = $image->getAttribute('src');
        $src .= (parse_url($src, PHP_URL_QUERY) ? '&' : '?') . '?v='.$hash;
        $image->setAttribute('src', $src);
    }

    return $dom->saveHTML();
}

$html = '<div><h1>test1</h1><img src="https://site.com/images/test-1.jpg" alt="Test"><h1>test2</h1><img src="https://site.com/images/test-2.jpg" alt="Test"><h1>test3</h1><img src="https://site.com/images/test-1.jpg" alt="Test"><h1>test4</h1><img src="https://site.com/images/test-1.jpg" alt="Test"><h1>test5</h1><img src="https://site.com/images/test-1.jpg" alt="Test"><p>end</p></div>';
echo addHashToHtmlImg($html);
