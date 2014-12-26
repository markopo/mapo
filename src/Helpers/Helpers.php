<?php
/**
 * Created by PhpStorm.
 * User: marko
 * Date: 09/11/2014
 * Time: 22:58
 */

/**
 * Class Helpers
 */
class Helpers {

    /**
     * @param $array
     */
    public static  function dump($array) {
        echo "<pre>" . htmlentities(print_r($array, 1)) . "</pre>";
    }

    /**
     * @param $str
     * @return string
     */
    public static function strip($str){
        return htmlentities(trim(strip_tags($str)));
    }

    /**
     * @param $val
     * @return null|string
     */
    public static function GetIsSetOrNull($val){
        if(isset($_GET[$val]) && !empty($_GET[$val])){
            return Helpers::strip($_GET[$val]);
        }
        return null;
    }

    /**
     * @param $val
     * @return null|string
     */
    public static function PostIsSetOrNull($val){
        if(isset($_POST[$val]) && !empty($_POST[$val])){
            return Helpers::strip($_POST[$val]);
        }
        return null;
    }

    /**
     * @param $str
     * @return string
     */
    public static function  IsNullOrEmpty($str){
        if($str != null){
            return $str;
        }
        return "";
    }

    /**
     * @param array $array
     * @param string $class
     * @return mixed
     */
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

    /**
     * @param $genres
     * @param $genre
     * @return null
     */
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

    /**
     * @param $sort
     * @return mixed
     */
    public static function Sort($sort){
        $_SESSION["sort"] = $sort;
        return $_SESSION["sort"];
    }

    /**
     * @param $id
     * @return int
     */
    public static function ParseInt($id){
        return (int)$id;
    }

    /**
     * @param $id
     * @return bool
     */
    public static function IsInt($id){
       return is_integer($id);
    }



} 