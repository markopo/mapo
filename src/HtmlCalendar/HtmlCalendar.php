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

    public function getNavigationLinks($year, $month) {

        $prevMonth = $month-1;
        $prevYear = $year;
        if($prevMonth < 1){
            $prevMonth = 12;
            $prevYear -= 1;
        }

        $nextMonth = $month+1;
        $nextYear = $year;
        if($nextMonth > 12){
            $nextMonth = 1;
            $nextYear += 1;
        }

        $page = basename($_SERVER['PHP_SELF']);
        $prevUrl = "$page?year=$prevYear&month=$prevMonth";
        $nextUrl = "$page?year=$nextYear&month=$nextMonth";

        return "<div class='calendar-navigation'>
                <a href='$prevUrl'>Previous</a>
                <a href='$nextUrl'>Next</a>
                </div>";
    }


    public function getMonthName($month) {
        $monthName = parent::getMonthName($month);
        return "<span class='month'>$monthName</span>";
    }

    public function getMonthBabe($month) {
        $monthbabe = parent::getMonthBabe($month);
        return "<div class='babe'><img src='$monthbabe' alt='$month' ></div>";
    }

    public function getCalendar($year, $month) {
        $calendar = parent::getCalendar($year, $month);

        $htmlCal = "<div class='calendar'>";
        $index = 0;
        foreach($calendar as $cal){

            $date = "Dag: ".$cal->Year."-".$cal->Month."-".$cal->Day."";
            $week = "Vecka: $cal->Week";

            if($index % HtmlCalendar::DAYS == 0){
                $htmlCal .= "<div class='calendar-row' data-week='$cal->Week'  >";
            }

            $htmlCal .= "<div class='calendar-day' title='$date, $week' data-year='$cal->Year' data-month='$cal->Month' data-day='$cal->Day' data-week='".$cal->Week."' >";

            $notCurrentMonth = "";
            if($cal->IsOnMonth == false){
                $notCurrentMonth = "not-month";
            }

            $classSunday = "";
            if($cal->IsSunday == true){
                $classSunday = "sunday";
            }

            $htmlCal .= "<div class='calendar-day-container $notCurrentMonth $classSunday' >";
            $htmlCal .= "<span class='day'>$cal->Day</span>";
            $htmlCal .= "<span class='day-name'>$cal->DayName</span>";

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