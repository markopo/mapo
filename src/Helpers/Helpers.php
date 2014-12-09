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
        return htmlentities(trim(strip_tags($str)));
    }

    public static function GetIsSetOrNull($val){
        if(isset($_GET[$val]) && !empty($_GET[$val])){
            return Helpers::strip($_GET[$val]);
        }
        return null;
    }

    public static function  IsNullOrEmpty($str){
        if($str != null){
            return $str;
        }
        return "";
    }

    public static function ToObject(array $array, $class = 'stdClass')
    {
        $object = new $class;
        foreach ($array as $key => $value)
        {
            if (is_array($value))
            {
                // Convert the array to an object
                $value = arr::to_object($value, $class);
            }
            // Add the value to the object
            $object->{$key} = $value;
        }
        return $object;
    }


    public static function HasGenre($genres, $genre){
        if($genre != null && count($genres) > 0) {
            foreach ($genres as $g) {
                if($g->name == $genre){
                    return $g->name;
                }
            }
        }
        return null;
    }

    public static function Sort($sort){
        $_SESSION["sort"] = $sort;
        return $_SESSION["sort"];
    }



} 