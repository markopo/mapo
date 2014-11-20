<?php

include(__DIR__.'/config.php');


$mapo['title'] = "Kalender | Månadens babe";

$mapo['header'] =  Template::Header();

$calendar = new HtmlCalendar();
$year = $calendar->currentYear;
$month = $calendar->currentMonth;

if(isset($_GET["month"]) && isset($_GET["year"])){
    $year = (int)Helpers::strip($_GET["year"]);
    $month = (int)Helpers::strip($_GET["month"]);
}


$navigationLinks = $calendar->getNavigationLinks($year, $month);
$monthName = $calendar->getMonthName($month);
$monthBabe = $calendar->getMonthBabe($month);
$htmlCalendar = $calendar->getCalendar($year, $month);

$mapo['main'] = <<< TEMPLATE
<div class='calendar-wrapper'>
<h2>Kalender | Månadens babe : <span class='year'>$year</span> : $monthName
<br>
$navigationLinks
</h2>
$monthBabe
$htmlCalendar
</div>
TEMPLATE;




$mapo['footer'] = Template::Footer();


include(MAPO_THEME_PATH);