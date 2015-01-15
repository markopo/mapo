<?php
/**
 * Created by PhpStorm.
 * User: marko
 * Date: 05/08/14
 * Time: 20:02
 */

class AppData {

    private $name = "Marko";
    private $message = "Hello World";

    public function GetName() {
        return $this->name;
    }

    public function GetMessage() {
        return $this->message;
    }
} 