<?php

include(__DIR__.'/config.php');


$mapo['title'] = "Gallery";


$mapo['header'] = Template::Header();


// Define the basedir for the gallery
define('GALLERY_PATH', __DIR__ . DIRECTORY_SEPARATOR . 'img');
define('GALLERY_BASEURL', '');

echo var_dump(GALLERY_PATH);

echo var_dump(GALLERY_BASEURL);

$mapo['main'] = <<< TEMPLATE
<h2>Gallery</h2>



TEMPLATE;


$mapo['footer'] = Template::Footer();


include(MAPO_THEME_PATH);