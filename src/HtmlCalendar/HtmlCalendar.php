<?php
/**
 * Created by PhpStorm.
 * User: marko
 * Date: 16/11/2014
 * Time: 22:56
 */

class HtmlCalendar extends Calendar {

    CONST DAYS = 7;

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
        $index = 0;
        foreach($calendar as $cal){
            if($index % HtmlCalendar::DAYS == 0){
                $htmlCal .= "<div class='calendar-row'>";
            }

            $htmlCal .= "<div class='calendar-day' data-year='$cal->Year' data-month='$cal->Month' data-day='$cal->Day' >";
            $htmlCal .= "<div class='calendar-day-container'>";
            $htmlCal .= "<span class='day'>$cal->Day</span>";
      //      $htmlCal .= "";
            $htmlCal .= "</div>";
            $htmlCal .= "</div>";

            if($index % HtmlCalendar::DAYS == HtmlCalendar::DAYS-1){
                $htmlCal .= "</div>";
            }

            $index += 1;
        }
        $htmlCal .= "</div>";

        return $htmlCal;
    }



} 