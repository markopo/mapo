<?php

$maxWidth = 2000;
$maxHeight = 2000;

$width = 850;
$height = 480;

$src = isset($_GET['src']) ? $_GET['src'] : null;


// Get the incoming arguments
$newWidth   = isset($_GET['width']) && is_numeric($_GET['width'])  ? (int)$_GET['width']    : null;
$newHeight  = isset($_GET['height']) && is_numeric($_GET['height']) ? (int)$_GET['height']   : null;


// Define some constant values, append slash
// Use DIRECTORY_SEPARATOR to make it work on both windows and unix.
define('IMG_PATH', __DIR__ . DIRECTORY_SEPARATOR . 'img' . DIRECTORY_SEPARATOR);

// Define some constant values, append slash
define('CACHE_PATH', __DIR__  . DIRECTORY_SEPARATOR . 'cache' . DIRECTORY_SEPARATOR);


//
// Calculate new width and height for the image
//
$aspectRatio = $width / $height;
if($newWidth && !$newHeight) {
    $newHeight = round($newWidth / $aspectRatio);
  //  if($verbose) { verbose("New width is known {$newWidth}, height is calculated to {$newHeight}."); }
}
else if(!$newWidth && $newHeight) {
    $newWidth = round($newHeight * $aspectRatio);
  //  if($verbose) { verbose("New height is known {$newHeight}, width is calculated to {$newWidth}."); }
}
else if($newWidth && $newHeight) {
    $ratioWidth  = $width  / $newWidth;
    $ratioHeight = $height / $newHeight;
    $ratio = ($ratioWidth > $ratioHeight) ? $ratioWidth : $ratioHeight;
    $newWidth  = round($width  / $ratio);
    $newHeight = round($height / $ratio);
  //  if($verbose) { verbose("New width & height is requested, keeping aspect ratio results in {$newWidth}x{$newHeight}."); }
}
else {
    $newWidth = $width;
    $newHeight = $height;
  //  if($verbose) { verbose("Keeping original width & heigth."); }
}

if(!is_null($newWidth) && !is_null($newHeight) && !($newWidth == $width && $newHeight == $height)) {
    $imageResized = imagecreatetruecolor($newWidth, $newHeight);
    imagecopyresampled($imageResized, $image, 0, 0, 0, 0, $newWidth, $newHeight, $width, $height);
    $image  = $imageResized;
    $width  = $newWidth;
    $height = $newHeight;

}