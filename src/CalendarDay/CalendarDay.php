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



     public $Week;

     public $IsSunday;

     public $IsOnMonth;

     public function __construct($year, $month, $day, $dayname, $week, $isonmonth){
        $this->Year = $year;
        $this->Month = $month;
        $this->Day = $day;
        $this->DayName = $dayname;
        $this->Week = $week;
        $this->IsSunday = $dayname == "Söndag" ? true : false;


        $this->IsOnMonth = $isonmonth;
     }

} 