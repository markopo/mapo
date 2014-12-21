<?php

include(__DIR__.'/config.php');


$cUser = new CUser($mapo['database']);

$isLoggedIn = $cUser->IsAuthenticated();
if(!$isLoggedIn){
    HtmlLogin::LogoutRedirect();
    exit;
}

$contentTable = "";

$mapo['title'] = "Content";


$mapo['header'] = Template::Header();


$cContent = new CContent($mapo['database']);

$res = $cContent->SelectAll();
if(count($res) > 0){
    $contentTable = HtmlCContent::HtmlTable($res);
}





$mapo['main'] = <<< TEMPLATE
<h2>Content</h2>
<div>
<a href="#add">Lägg till ny</a>
</div>
<div class="content-wrapper">
$contentTable
</div>
TEMPLATE;


$mapo['footer'] = Template::Footer();


include(MAPO_THEME_PATH);