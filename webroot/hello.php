<?php

include(__DIR__.'/config.php');


$mapo['title'] = "Hello World";


$mapo['header'] = Template::Header();


$mapo['main'] = <<< TEMPLATE
<h2>Hej Världen</h2>
<p>Detta är en exempelsida som visar hur Mapo ser ut och fungerar.</p>
TEMPLATE;


$mapo['footer'] = Template::Footer();


include(MAPO_THEME_PATH);