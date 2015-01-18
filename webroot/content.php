<?php

include(__DIR__.'/config.php');

 // echo var_dump($_POST);

$alterMode = false;
$editcontentId = Helpers::GetIsSetOrNull("editcontent");
$deletecontentId = Helpers::GetIsSetOrNull("deletecontent");


$cUser = new CUser($mapo['database']);
$isLoggedIn = $cUser->IsAuthenticated();
if(!$isLoggedIn){
    HtmlLogin::LogoutRedirect();
}

/**
 * cContent instance
 */
$cContent = new CContent($mapo['database']);


/** update -- post */
$editcontent_save = Helpers::PostIsSetOrNull("editcontent_save");
if($editcontent_save != null){
    $updateParam = new StdClass;
    $updateParam->id = Helpers::PostIsSetOrNull("id");
    $updateParam->type = Helpers::PostIsSetOrNull("type");
    $updateParam->title = Helpers::PostIsSetOrNull("title");
    $updateParam->slug = Helpers::MakeSlug($updateParam->title);
    $updateParam->data = Helpers::PostOrEmpty("data");
    $updateParam->filter = Helpers::PostArrayIsSetOrNull("filter");
    $updateParam->deleted = Helpers::PostIsSetOrNull("deleted");
    $updateParam->deleted = $updateParam->deleted == '1' ? true : false;

    $cContent->Update($updateParam);

    $_POST = array();
}

/** delete -- post */
$deletecontent_save = Helpers::PostIsSetOrNull("deletecontent_save");
if($deletecontent_save != null){
    $deleteid = Helpers::PostIsSetOrNull("id");
    if($deleteid != null){
       $deleteid = Helpers::ParseInt($deleteid);
       if(Helpers::IsInt($deleteid)){
           $cContent->DeleteById($deleteid);
       }
    }
    $_POST = array();
}

/** insert -- post */
$addcontent_save = Helpers::PostIsSetOrNull("addcontent_save");
if($addcontent_save != null){
    $saveParam = new StdClass;
    $saveParam->type = Helpers::PostIsSetOrNull("type");
    $saveParam->title = Helpers::PostIsSetOrNull("title");
    $saveParam->slug = Helpers::MakeSlug($saveParam->title);
    $saveParam->data = Helpers::PostOrEmpty("data");
    $saveParam->filter = Helpers::PostIsSetOrNull("filter");

    $cContent->Insert($saveParam);
    $_POST = array();
}

/**
 * Add
 */
$addContent = "";
$addAction = Helpers::GetIsSetOrNull("action");
if($addAction == "add"){
    $addContent = HtmlCContent::AddContent();
    $alterMode = true;
}


/**
 * edit & delete content
 */
$action = "";
$content = null;
$editContent = "";
$deleteContent = "";


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

$errormessage = !empty($cContent->errorMessage) ? '<p class="error-message">'.$cContent->errorMessage.'</p><br>' : "";

//$debugMessage = $cContent->debugMessage;


$mapo['main'] = <<< TEMPLATE
<h2><a href='content.php'>Content</a></h2>
<div>
<a href="?action=add">Lägg till ny</a>
</div>
$errormessage
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

$mapo["pagescript"] = <<< TEMPLATE
    appendScript("js/content.js");
TEMPLATE;



include(MAPO_THEME_PATH);