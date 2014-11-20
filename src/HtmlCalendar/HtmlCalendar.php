<?php
/**
 * Created by PhpStorm.
 * User: marko
 * Date: 16/11/2014
 * Time: 22:56
 */

class HtmlCalendar extends Calendar {

    public function __construct(){
        parent::__construct();

    }

    public function getHtmlMonthName($month) {
        $monthName = parent::getMonthName($month);
        return "<span class='month'>$monthName</span>";
    }

    public function getHtmlMonthBabe($month) {
        $monthbabe = parent::getMonthBabe($month);


    }

    public function getHtmlCalendar($year, $month) {
        $calendar = parent::getCalendar($year, $month);

        $htmlCal = "<div class='calendar'></div>";
        foreach($calendar as $cal){
            $htmlCal .= "<div class='calendarday' data-year='$cal->Year' data-month='$cal->Month' data-day='$cal->Day' >";
            $htmlCal .= "<span class='day'>$cal->Day</span>";
      //      $htmlCal .= "";
            $htmlCal .= "</div>";

        }
        $htmlCal .= "</div>";

        return $htmlCal;
    }



} 