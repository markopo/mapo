<?php
/**
 * Created by PhpStorm.
 * User: marko
 * Date: 13/11/2014
 * Time: 19:05
 */

class Calendar {


    private $SwedishMonthNames = array("Jan"=>"Januari","Feb"=>"Februrari","Mar"=>"Mars","Apr"=>"April","May"=>"Maj","Jun"=>"Juni","Jul"=>"Juli","Aug"=>"Augusti","Sep"=>"September","Oct"=>"Oktober","Nov"=>"November","Dec"=>"December");
    private $SwedishDayNames = array("Mon"=>"Måndag", "Tue"=>"Tisdag", "Wed"=>"Onsdag", "Thu"=>"Torsdag", "Fri"=>"Fredag", "Sat"=>"Lördag", "Sun"=>"Söndag");


    public $currentYear;
    public $currentMonth;
    public $currentDay;
    public $currentWeek;

    private $CalendarDays;


    public function __construct(){

        $this->currentYear = date("Y");
        $this->currentMonth = date("m");
        $this->currentDay = date("d");
        $this->currentWeek = date("W");

        $this->CalendarDays = array();

    }

    private function createDate($year, $month, $day, $iscurrentMonth){
        $day = date("d", mktime(0, 0, 0, $month, $day, $year));
        $month = date("m", mktime(0, 0, 0, $month, $day, $year));
        $year = date("Y", mktime(0, 0, 0, $month, $day, $year));
        $dayname = date("D", mktime(0, 0, 0, $month, $day, $year));
        $week = date("W", mktime(0, 0, 0, $month, $day, $year));

        return new CalendarDay($year, $month, $day, $this->SwedishDayNames[$dayname], $week, $iscurrentMonth);
    }

    private function firstIndexOfDayInMonth($year, $month, $day) {
       $dayname = date("D", mktime(0, 0, 0, $month, $day, $year));
       return array_search($dayname, array_keys($this->SwedishDayNames));
    }

    private function getDaysOfPreviousMonth($year, $month, $firstday){
        $daysInMonth = (int)date('t', mktime(0, 0, 0, $month, 1, $year));
        $daysPrevMonth = array();
        for($i=$firstday;$i>0;$i--){
            array_push($daysPrevMonth, $daysInMonth-($i-1));
        }
        return $daysPrevMonth;
    }

    private function getDaysInMonth($year, $month){
        return (int)date('t', mktime(0, 0, 0, $month, 1, $year));
    }

    public function getMonthName($month){
        $monthName = date("M", mktime(0, 0, 0, $month, 1, $this->currentYear));
        return $this->SwedishMonthNames[$monthName];
    }


    public function getMonthBabe($month) {
        $monthName = strtolower(date("M", mktime(0, 0, 0, $month, 1, $this->currentYear)));
        $host = "http://".$_SERVER['HTTP_HOST'];
        $url = pathinfo($_SERVER["PHP_SELF"])["dirname"];
        return "$host$url/img/babes/$monthName.jpg";
    }

    public function getCalendar($year, $month){

        if($year == null) {
            $year = $this->currentYear;
        }

        if($month == null){
            $month = $this->currentMonth;
        }

        // PREVIOUS MONTH DAYS IN FIRST ROW
        $firstDay = $this->firstIndexOfDayInMonth($year, $month, 1);
        if($firstDay > 0){
            $prevMonth = $month-1;
            $prevYear = $year;

            if($prevMonth < 1){
                $prevYear -= 1;
            }

            $daysOfPrevMonth = $this->getDaysOfPreviousMonth($prevYear, $prevMonth, $firstDay);

            for($i=0;$i<$firstDay;$i++){
                array_push($this->CalendarDays, $this->createDate($prevYear, $prevMonth, $daysOfPrevMonth[$i], false));
            }
        }

        $daysInMonth = $this->getDaysInMonth($year, $month);

        for($d=1;$d<$daysInMonth+1;$d++){
            array_push($this->CalendarDays, $this->createDate($year, $month, $d, true));
        }

        // NEXT MONTH DAYS
        $nextMonth = abs(count($this->CalendarDays) % 7 - 7);
        if($nextMonth > 0){
            $month += 1;

            if($month > 12) {
                $year += 1;
                $month = 1;
            }

            for($n=1;$n<$nextMonth+1;$n++) {
                array_push($this->CalendarDays, $this->createDate($year, $month, $n, false));
            }
        }


        return $this->CalendarDays;
    }



} 