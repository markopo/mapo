<?php

include(__DIR__.'/config.php');


$mapo['title'] = "Hello World";


$mapo['header'] =  <<< TEMPLATE
<img class='sitelogo' src='img/mapo.png' alt='Mapo Logo'/> <div class='sitetitle'> - Mapo webbtemplate</div>
<br style='clear:both;' />
<div class='siteslogan'>Återanvändbara moduler för webbutveckling med PHP</div>
TEMPLATE;

$mapo['main'] = <<< TEMPLATE
<h2>Hej Världen</h2>
<p>Detta är en exempelsida som visar hur Mapo ser ut och fungerar.</p>
TEMPLATE;


$mapo['footer'] = <<< TEMPLATE
<div>
<span class='sitefooter'>Copyright (c) Marko Poikkimäki |
<a href='https://github.com/markopo/mapo' >Mapo på GitHub</a> |
<a href='http://validator.w3.org/unicorn/check?ucn_uri=referer&amp;ucn_task=conformance'>Unicorn</a></span>
</div>
TEMPLATE;


include(MAPO_THEME_PATH);