<?php
/**
 * Created by PhpStorm.
 * User: marko
 * Date: 28/12/2014
 * Time: 17:55
 */

/**
 * Class DateFormat
 */
class DateFormat {

    /**
     * @param $dateStr
     * @return bool|string
     */
    public static function Ymd_Hi($dateStr){
        if(!empty($dateStr)) {
            return date("Y-m-d H:i", strtotime($dateStr));
        }
        return "-";
    }

}