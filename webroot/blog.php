<?php

include(__DIR__.'/config.php');



$mapo['title'] = "Blog";


$mapo['header'] = Template::Header();


$cContent = new CContent($mapo['database']);
$cBlog = new CBlog();

$slug = Helpers::GetIsSetOrNull("slug");
$slugPage = "";
if($slug != null){
    $page = $cContent->SelectOneBySlug($slug);
    $slugPage = $cBlog->ShowSlugBlog($page);
}

$blogs = $cContent->SelectAllBlog();
$htmlAllBlog = $slug == null ? $cBlog->ShowAllBlogs($blogs) : "";


$mapo['main'] = <<< TEMPLATE
<h2>Page</h2>
<div>$htmlAllBlog</div>
<div>$slugPage</div>
TEMPLATE;


$mapo['footer'] = Template::Footer();


include(MAPO_THEME_PATH);