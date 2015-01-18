<?php

include(__DIR__.'/config.php');



$mapo['title'] = "Blog";


$mapo['header'] = Template::Header();

$htmlAllBlog = "";

$cContent = new CContent($mapo['database']);
$cBlog = new CBlog();

$slug = Helpers::GetIsSetOrNull("slug");
$slugPage = "";
if($slug != null){
    $page = $cContent->SelectOneBySlug($slug);
    $slugPage = $cBlog->ShowSlugBlog($page);
}
else {
    $blogs = $cContent->SelectAllBlog();
    $htmlAllBlog = $cBlog->ShowAllBlogs($blogs);
}

$mapo['main'] = <<< TEMPLATE
<h2>Blog</h2>
<div>$htmlAllBlog</div>
<div>$slugPage</div>
TEMPLATE;


$mapo['footer'] = Template::Footer();


include(MAPO_THEME_PATH);