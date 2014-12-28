<?php
/**
 * Created by PhpStorm.
 * User: marko
 * Date: 28/12/2014
 * Time: 09:20
 */

/**
 * Class FormHelper
 */
class FormHelper {

    /**
     * @param string $action
     * @param string $method
     * @return string
     */
    public static function FormStart($action = "content.php", $method = "post"){
        return "<form action='{$action}' method='{$method}'>";
    }

    /**
     * @return string
     */
    public static function FormEnd() {
       return "</form>";
    }
}