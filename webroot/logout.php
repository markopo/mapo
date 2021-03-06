<?php

include(__DIR__.'/config.php');

$statusMessage = "";

$cUser = new CUser($mapo['database']);
$cUser->Logout();

$isLoggedIn = $cUser->IsAuthenticated();

if($isLoggedIn == true){
    $statusMessage = "Du är inloggad!";
}
else {
    $statusMessage = "Du är utloggad!";
}

$mapo['title'] = "Logout";


$mapo['header'] = Template::Header();

$mapo['main'] = <<< TEMPLATE
<h2>Logout</h2>
<p>$statusMessage</p>
TEMPLATE;


$mapo['footer'] = Template::Footer();


include(MAPO_THEME_PATH);