<?php

include(__DIR__.'/config.php');

$mapo['title'] = "Filmdatabasen";

$mapo['header'] = Template::Header();

/** MOVIES SEARCH */

$error = "";
$params = new StdClass();

/** image */
$host = "http://".$_SERVER['HTTP_HOST'];
$url = pathinfo($_SERVER["PHP_SELF"])["dirname"];
$ucUrl = "$host$url/img/uc.png";
/* end image */

/** START DB instance */
$db = new CDatabase($mapo['database'], true);
$genres = $db->GetGenres();

//echo var_dump($genres);


/** GET to params */
/** show all */
if(isset($_GET["action"]) && $_GET["action"] == "showall"){
    $params->title = null;
    $params->startyear = null;
    $params->endyear = null;
    $params->genre = null;
    $params->ordertitle = null;
    $params->orderyear = null;
}
else {
    $params->title = Helpers::GetIsSetOrNull("titel");
    $params->startyear = Helpers::GetIsSetOrNull("startyear");
    $params->endyear = Helpers::GetIsSetOrNull("endyear");
    $params->genre = Helpers::GetIsSetOrNull("genre");
    $params->ordertitle = Helpers::GetIsSetOrNull("order_title");
    $params->orderyear = Helpers::GetIsSetOrNull("order_year");

    $_SESSION["order_title"] = $params->ordertitle == "ASC" ? "ASC" : "DESC";
    $_SESSION["order_year"] = $params->orderyear == "ASC" ? "ASC" : "DESC";
}

/**
 * VALIDATE genres
 */
$params->genre = Helpers::HasGenre($genres, $params->genre);

/** @var $htmlGenres
 *  create links of genres
    */
$htmlGenres = HtmlMovies::GenresLinks($genres, $params->genre);

echo var_dump($params);



$res = $db->GetMovies($params);

$debugMessage = $db->debugMessage;


if(!empty($db->errorMessage)) {
    $error = $db->errorMessage;
}

$searchForm = HtmlMovies::SearchForm($htmlGenres, $params);
$htmlTable = HtmlMovies::SearchTable($res);



$mapo['main'] = "<div class='movies-wrapper'>
<h2>Internet film databas</h2>
<div class='search-form-wrapper' >
$searchForm
</div>
<br style='clear:both;' >
<div class='htmltable-wrapper'>
$htmlTable
</div>
<p>$error</p>
<p>$debugMessage</p>
<p><img src='$ucUrl' alt='under construction' ></p>
</div>
";


$mapo['footer'] = Template::Footer();



$mapo["pagescript"] = <<< TEMPLATE
    appendScript("js/movies.js");

TEMPLATE;


include(MAPO_THEME_PATH);