<?php
/**
 * Created by PhpStorm.
 * User: marko
 * Date: 16/11/2014
 * Time: 17:04
 */

class CalendarDay {

     public $Year;
     public $Month;
     public $Day;

     public $DayName;

     public $NameDay;

     public $Week;

     public $IsOnMonth;

     public function __construct($year, $month, $day, $dayname, $nameday, $week, $isonmonth){
        $this->Year = $year;
        $this->Month = $month;
        $this->Day = $day;
        $this->DayName = $dayname;
        $this->NameDay = $nameday;
        $this->Week = $week;
        $this->IsOnMonth = $isonmonth;
     }

} 