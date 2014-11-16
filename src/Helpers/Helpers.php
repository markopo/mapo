<?php
/**
 * Created by PhpStorm.
 * User: marko
 * Date: 09/11/2014
 * Time: 22:58
 */

class Helpers {

    public static  function dump($array) {
        echo "<pre>" . htmlentities(print_r($array, 1)) . "</pre>";
    }

    public static function strip($str){
        return trim(strip_tags($str));
    }

} 