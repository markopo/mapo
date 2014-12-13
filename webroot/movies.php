<?php

include(__DIR__.'/config.php');

$mapo['title'] = "Filmdatabasen";

$mapo['header'] = Template::Header();

/** MOVIES SEARCH */

$error = "";
$params = new StdClass();

/** image */
/*
$host = "http://".$_SERVER['HTTP_HOST'];
$url = pathinfo($_SERVER["PHP_SELF"])["dirname"];
$ucUrl = "$host$url/img/uc.png";
*/
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
    $params->orderdir = null;
    $params->ordercol = null;
    $params->hits_per_page = 2;
    $params->page = 0;
}
else {
    $params->title = Helpers::GetIsSetOrNull("titel");
    $params->startyear = Helpers::GetIsSetOrNull("startyear");
    $params->endyear = Helpers::GetIsSetOrNull("endyear");
    $params->genre = Helpers::GetIsSetOrNull("genre");
    $params->orderdir = Helpers::GetIsSetOrNull("order_dir");
    $params->ordercol = Helpers::GetIsSetOrNull("order_col");
    $params->hits_per_page = Helpers::GetIsSetOrNull("hits_per_page");
    $params->page = Helpers::GetIsSetOrNull("page");

    if($params->hits_per_page == null){
        $params->hits_per_page = 2;
    }

    if($params->page == null){
        $params->page = 0;
    }


    /** @var  orderdir */
    $params->orderdir = $params->orderdir == "ASC" ? "ASC" : "DESC";
}

/**
 * VALIDATE genres
 */
$params->genre = Helpers::HasGenre($genres, $params->genre);

/** @var $htmlGenres
 *  create links of genres
    */
$htmlGenres = HtmlMovies::GenresLinks($genres, $params->genre);

// echo var_dump($params);

$res = $db->GetMovies($params);
$moviesCount = $db->GetMoviesCount();


$searchForm = HtmlMovies::SearchForm($htmlGenres, $params);
$hitsPerPageLinks = HtmlMovies::HitsPerPageLinks((int)$params->hits_per_page);
$htmlTable = HtmlMovies::SearchTable($res, $params);
$pagingLinks = HtmlMovies::PagingLinks($moviesCount, (int)$params->hits_per_page);


$mapo['main'] = "<div class='movies-wrapper'>
<h2>Internet film databas</h2>
<div class='search-form-wrapper' >
$searchForm
</div>
<br style='clear:both;' >
<div class='htmltable-wrapper'>
<div class='hitsperpage-wrapper' >
$hitsPerPageLinks
</div>
<br style='clear:both;' />
$htmlTable
</div>
<div class='paging-links-wrapper'>
$pagingLinks
</div>
<br style='clear:both;' />
</div>
";


$mapo['footer'] = Template::Footer();



$mapo["pagescript"] = <<< TEMPLATE
    appendScript("js/movies.js");

TEMPLATE;


include(MAPO_THEME_PATH);