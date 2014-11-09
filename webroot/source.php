<?php

include(__DIR__.'/config.php');

// Add style for csource
$mapo['stylesheets'][] = 'css/source.css';

$source = new CSource(array('secure_dir' => '..', 'base_dir' => '..'));

$mapo['title'] = "Visa källkod";

$mapo['header'] =  <<< TEMPLATE
<img class='sitelogo' src='img/mapo.png' alt='Mapo Logo'/> <div class='sitetitle'> - Mapo webbtemplate</div>
<br style='clear:both;' />
<div class='siteslogan'>Återanvändbara moduler för webbutveckling med PHP</div>
TEMPLATE;

$mapo['main'] = "<h1>Visa källkod</h1>\n" . $source->View();

$mapo['footer'] = <<< TEMPLATE
<div>
<span class='sitefooter'>Copyright (c) Marko Poikkimäki |
<a href='https://github.com/markopo/mapo' >Mapo på GitHub</a> |
<a href='http://validator.w3.org/unicorn/check?ucn_uri=referer&amp;ucn_task=conformance'>Unicorn</a></span>
</div>
TEMPLATE;


include(MAPO_THEME_PATH);