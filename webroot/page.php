<?php

include(__DIR__.'/config.php');



$mapo['title'] = "Page";


$mapo['header'] = Template::Header();

$cContent = new CContent($mapo['database']);
$cPage = new CPage();

$slug = Helpers::GetIsSetOrNull("slug");
$slugPage = "";
if($slug != null){
    $page = $cContent->SelectOneBySlug($slug);
    $slugPage = $cPage->ShowSlugPage($page);
}

$pages = $cContent->SelectAllPages();
$htmlAllpages = $slug == null ? $cPage->ShowAllPages($pages) : "";


$mapo['main'] = <<< TEMPLATE
<h2>Page</h2>
<div>$htmlAllpages</div>
<div>$slugPage</div>
TEMPLATE;


$mapo['footer'] = Template::Footer();


include(MAPO_THEME_PATH);