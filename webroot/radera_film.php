<?php

include(__DIR__.'/config.php');


$mapo['title'] = "Radera film";


$mapo['header'] = Template::Header();

$mapo['main'] = <<< TEMPLATE
<h2>Hej Världen</h2>

TEMPLATE;


$mapo['footer'] = Template::Footer();


include(MAPO_THEME_PATH);