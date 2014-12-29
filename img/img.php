<?php

// Ensure error reporting is on

// Define some constant values, append slash
// Use DIRECTORY_SEPARATOR to make it work on both windows and unix.
define('IMG_PATH', __DIR__ . DIRECTORY_SEPARATOR . 'img' . DIRECTORY_SEPARATOR);

// Define some constant values, append slash
define('CACHE_PATH', __DIR__ . '/cache/');

// Get the incoming arguments
$src      = isset($_GET['src'])     ? $_GET['src']      : null;
$verbose  = isset($_GET['verbose']) ? true              : null;

// Get the incoming arguments
$saveAs   = isset($_GET['save-as']) ? $_GET['save-as']  : null;
$quality  = isset($_GET['quality']) ? $_GET['quality']  : 60;

$pathToImage = realpath(IMG_PATH . $src);
$width = 850;
$height = 480;


if($src != null && $saveAs != null){

    $displayableImage = true;

    // Validate incoming arguments
    if(!in_array($saveAs, array('png', 'jpg', 'jpeg'))){
        echo 'Not a valid extension to save image as';
        $displayableImage = false;
    }

    if(is_null($quality) || (is_numeric($quality) && ($quality < 1 || $quality > 100))){
        echo 'Quality out of range';
        $displayableImage = false;
    }


  if($displayableImage == true) {
    // Start displaying log if verbose mode & create url to current image

    // Get information on the image

    // Creating a filename for the cache
            $parts = pathinfo($pathToImage);
            $saveAs = is_null($saveAs) ? $fileExtension : $saveAs;
            $quality_ = is_null($quality) ? null : "_q{$quality}";
            $dirName = preg_replace('/\//', '-', dirname($src));
            $cacheFileName = CACHE_PATH . "-{$dirName}-{$parts['filename']}_{$width}_{$height}{$quality_}.{$saveAs}";
            $cacheFileName = preg_replace('/^a-zA-Z0-9\.-_/', '', $cacheFileName);


    // Open up the image from file
            $fileExtension = pathinfo($pathToImage, PATHINFO_EXTENSION);
            switch ($fileExtension) {
                case 'jpg':
                case 'jpeg':
                    $image = imagecreatefromjpeg($pathToImage);
                    break;

                case 'png':
                    $image = imagecreatefrompng($pathToImage);
                    break;
            }


    // Save the image
            switch ($saveAs) {
                case 'jpeg':
                case 'jpg':
                    imagejpeg($image, $cacheFileName, $quality);
                    break;

                case 'png':
                    imagepng($image, $cacheFileName);
                    break;
            }


    // Output the resulting image
            $info = getimagesize($cacheFileName);
            $mime = $info['mime'];
            header('Content-type: ' . $mime);
            readfile($cacheFileName);
    }
}
else if($src != null) {

  //  echo IMG_PATH;



   // echo var_dump($pathToImage);

    //exit;
// Validate incoming arguments

// Start displaying log if verbose mode & create url to current image

// Get information on the image

    $imgInfo = list($width, $height, $type, $attr) = getimagesize($pathToImage);
    $mime = $imgInfo['mime'];

// Output the resulting image
    header('Content-type: ' . $mime);
    readfile($pathToImage);

}



else {
    echo "Nice try!";
}