<?php

include(__DIR__.'/config.php');

$cUser = new CUser($mapo['database']);
$isLoggedIn = $cUser->IsAuthenticated();
if(!$isLoggedIn){
    HtmlLogin::LogoutRedirect();
}


$mapo['title'] = "Blog";


$mapo['header'] = Template::Header();


$mapo['main'] = <<< TEMPLATE
<h2>Blog</h2>


TEMPLATE;


$mapo['footer'] = Template::Footer();


include(MAPO_THEME_PATH);