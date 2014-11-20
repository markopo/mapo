<?php

include(__DIR__.'/config.php');


$mapo['title'] = "Kalender | Månadens babe";

$mapo['header'] =  Template::Header();

$calendar = new HtmlCalendar();
$year = null;
$month = null;

if(isset($_GET["month"]) && isset($_GET["year"])){
    $year = (int)Helpers::strip($_GET["year"]);
    $month = (int)Helpers::strip($_GET["month"]);
}

$monthName = $calendar->getMonthName($month);
// $calendarData = $calendar->getCalendar($year, $month);

//$i = $calendar->firstIndexOfDayInMonth(2014, 11, 1);

//echo var_dump(date('t', mktime(0, 0, 0, $month-1, 1, $year)));

// echo var_dump($calendarData);


// $monthBabe = $calendar->getMonthBabe($month);

/*
 * <div class='babe'>
  $monthBabe
</div>
 */

$htmlCalendar = $calendar->getHtmlCalendar($year, $month);

$mapo['main'] = <<< TEMPLATE
<div class='calendar-wrapper'>
<h2>Kalender | Månadens babe : <span class='year'>$year</span> : $monthName</h2>
$htmlCalendar

</div>
TEMPLATE;


$mapo['footer'] = Template::Footer();


include(MAPO_THEME_PATH);