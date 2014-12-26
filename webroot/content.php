<?php

include(__DIR__.'/config.php');


$cUser = new CUser($mapo['database']);
$isLoggedIn = $cUser->IsAuthenticated();
if(!$isLoggedIn){
    HtmlLogin::LogoutRedirect();
}

/**
 * cContent instance
 */
$cContent = new CContent($mapo['database']);


/**
 * Add
 */
$addContent = "";
$addAction = Helpers::GetIsSetOrNull("action");
if($addAction == "add"){
    $addContent = HtmlCContent::AddContent();
}


/**
 * edit & delete content
 */
$editcontentId = Helpers::GetIsSetOrNull("editcontent");
$deletecontentId = Helpers::GetIsSetOrNull("deletecontent");
$action = "";
$content = null;
$editContent = "";
$deleteContent = "";
$alterMode = false;


if($editcontentId != null){
    $id = Helpers::ParseInt($editcontentId);
    if(Helpers::IsInt($id)){
       $content = $cContent->SelectOne($id);
    }

    if($content != null){
        $editContent = HtmlCContent::EditContent($content);
        $alterMode = true;
    }
}

if($deletecontentId != null){
    $id = Helpers::ParseInt($deletecontentId);
    if(Helpers::IsInt($id)){
        $content = $cContent->SelectOne($id);
    }

    if($content != null){
        $deleteContent = HtmlCContent::DeleteContent($content);
        $alterMode = true;
    }
}




$contentTable = "";

$mapo['title'] = "Content";

$mapo['header'] = Template::Header();

if($alterMode == false) {
    $res = $cContent->SelectAll();
    if (count($res) > 0) {
        $contentTable = HtmlCContent::HtmlTable($res);
    }
}





$mapo['main'] = <<< TEMPLATE
<h2>Content</h2>
<div>
<a href="?action=add">Lägg till ny</a>
</div>
<div class="content-wrapper">
$contentTable
</div>
<div class='add-content-wrapper'>
$addContent
</div>
<div class='edit-content-wrapper'>
$editContent
</div>
<div class='delete-content-wrapper'>
$deleteContent
</div>
TEMPLATE;


$mapo['footer'] = Template::Footer();


include(MAPO_THEME_PATH);