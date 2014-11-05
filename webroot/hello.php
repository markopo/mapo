<?php

include(__DIR__.'/config.php');


$mapo['title'] = "Hello World";


$mapo['header'] =  <<<EOD
<img class='sitelogo' src='img/mapo.png' alt='Mapo Logo'/> <div class='sitetitle'> - Mapo webbtemplate</div>
<br style='clear:both;' />
<div class='siteslogan'>Återanvändbara moduler för webbutveckling med PHP</div>
EOD;

$mapo['main'] = <<<EOD
<h2>Hej Världen</h2>
<p>Detta är en exempelsida som visar hur Mapo ser ut och fungerar.</p>
EOD;


$mapo['footer'] = <<<EOD
<div>
<span class='sitefooter'>Copyright (c) Marko Poikkimäki |
<a href='https://github.com/markopo/mapo' >Mapo på GitHub</a> |
<a href='http://validator.w3.org/unicorn/check?ucn_uri=referer&amp;ucn_task=conformance'>Unicorn</a></span>
</div>
EOD;


// Finally, leave it all to the rendering phase of Anax.
include(MAPO_THEME_PATH);