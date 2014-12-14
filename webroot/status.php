<?php

include(__DIR__.'/config.php');

$statusMessage = "";


$cUser = new CUser($mapo['database']);

$isLoggedIn = $cUser->IsAuthenticated();

if($isLoggedIn == true){
    $name = $cUser->GetName();
    $statusMessage = "Grattis! $name är inloggad!";
}
else {
    $statusMessage = "Du är utloggad!";
}


$mapo['title'] = "Logout";

$mapo['header'] = Template::Header();

$mapo['main'] = <<< TEMPLATE
<h2>Login status</h2>
<p>$statusMessage</p>
TEMPLATE;


$mapo['footer'] = Template::Footer();


include(MAPO_THEME_PATH);