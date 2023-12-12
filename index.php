<?php
$publicPath = __DIR__ . '/public';

if (strpos($_SERVER['REQUEST_URI'], '/public/') === false) {
    $redirectUrl = 'https://' . $_SERVER['HTTP_HOST'] . '/public/';
    
    header('Location: ' . $redirectUrl, true, 301);
    exit;
}

require $publicPath . '/index.php';

