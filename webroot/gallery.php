<?php

include(__DIR__.'/config.php');


$mapo['title'] = "Gallery";


$mapo['header'] = Template::Header();

$cGalleryImagePath = str_replace("webroot", "img/", Helpers::HostUrl());
$cGallery = new CGallery($cGalleryImagePath);

// Define the basedir for the gallery
$path = str_replace("webroot","img", __DIR__);
define('GALLERY_PATH', $path . DIRECTORY_SEPARATOR . 'img');
define('GALLERY_BASEURL', '');

$path =  Helpers::GetIsSetOrNull('path');
$pathToGallery = realpath(GALLERY_PATH . DIRECTORY_SEPARATOR . $path);

// Validate incoming arguments
is_dir(GALLERY_PATH) or  Helpers::DisplayError404Message('The gallery dir is not a valid directory.');
substr_compare(GALLERY_PATH, $pathToGallery, 0, strlen(GALLERY_PATH)) == 0 or Helpers::DisplayError404Message('Security constraint: Source gallery is not directly below the directory GALLERY_PATH.');


// Read and present images in the current directory
if(is_dir($pathToGallery)) {
    $gallery = $cGallery->readAllItemsInDir($pathToGallery);
}
else if(is_file($pathToGallery)) {
    $gallery = $cGallery->readItem($pathToGallery);
}

$breadcrumb = $cGallery->createBreadcrumb($pathToGallery);

$mapo['main'] = <<< TEMPLATE
<h2>Gallery</h2>
<div class='breadcrumb-container'>
$breadcrumb
</div>
<br style="clear:both;" >
<div class='gallery-container' >
$gallery
</div>
TEMPLATE;


$mapo['footer'] = Template::Footer();


include(MAPO_THEME_PATH);