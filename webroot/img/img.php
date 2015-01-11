<?php

$path = str_replace("img", "webroot", __DIR__);
include($path. DIRECTORY_SEPARATOR .'config.php');

define('IMG_PATH', __DIR__ . DIRECTORY_SEPARATOR . 'img' . DIRECTORY_SEPARATOR);
define('CACHE_PATH', __DIR__ . '/cache/');


$message = "";

try {
    $src = isset($_GET['src']) ? $_GET['src'] : null;
    $verbose = isset($_GET['verbose']) ? true : null;
    $saveAs = isset($_GET['save-as']) ? $_GET['save-as'] : null;
    $quality = isset($_GET['quality']) ? (int)$_GET['quality'] : 60;
    $ignoreCache = isset($_GET['no-cache']) ? true : null;
    $newWidth = isset($_GET['width']) ? (int)$_GET['width'] : null;
    $newHeight = isset($_GET['height']) ? (int)$_GET['height'] : null;
    $cropToFit = isset($_GET['crop-to-fit']) ? true : null;
    $sharpen = isset($_GET['sharpen']) ? true : null;
}
catch (Exception $e){
    $message = $e->getMessage();
}

if(empty($message)) {
    $cImage = new CImage($src, $verbose, $saveAs, $quality, $ignoreCache, $newWidth, $newHeight, $cropToFit, $sharpen, IMG_PATH, CACHE_PATH);
}
else {
    echo $message;
}
