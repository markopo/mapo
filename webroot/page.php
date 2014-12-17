<?php

include(__DIR__.'/config.php');


$mapo['title'] = "Page";


$mapo['header'] = Template::Header();

$cContent = new CContent($mapo['database']);

$cContent->Create();



$mapo['main'] = <<< TEMPLATE
<h2>Page</h2>


TEMPLATE;


$mapo['footer'] = Template::Footer();


include(MAPO_THEME_PATH);