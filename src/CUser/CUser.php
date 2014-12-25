<?php
/**
 * Created by PhpStorm.
 * User: marko
 * Date: 24/11/2014
 * Time: 13:35
 */

/**
 * Class CUser
 */
class CUser extends CDatabase {

    CONST ACRONYM_LOGGEDIN = "acronym_loggedin";
    CONST NAME_LOGGEDIN = "name_loggedin";

    public function __construct($options, $debug=false){
        parent::__construct($options, $debug);
    }

    /**
     * @param $acronym
     * @param $password
     */
    public function Login($acronym, $password){
        $sql = "SELECT acronym, name FROM `user` WHERE acronym = :acronym AND password = md5(concat(:password, salt))";
        $params = array();
        $params[":acronym"] = array($acronym);
        $params[":password"] = array($password);

        $res = parent::Fetch($sql, $params);

        if($res != null && $res->acronym == $acronym){
            $_SESSION[CUser::ACRONYM_LOGGEDIN] = $res->acronym;
            $_SESSION[CUser::NAME_LOGGEDIN] = $res->name;
        }
    }

    /**
     *
     */
    public function Logout() {
        unset($_SESSION[CUser::ACRONYM_LOGGEDIN]);
        unset($_SESSION[CUser::NAME_LOGGEDIN]);
    }

    /**
     * @return bool
     */
    public function IsAuthenticated() {
        return isset($_SESSION[CUser::ACRONYM_LOGGEDIN]);
    }

    /**
     * @return mixed
     */
    public function GetAcronym() {
        return $_SESSION[CUser::ACRONYM_LOGGEDIN];
    }

    /**
     * @return mixed
     */
    public function GetName() {
        return $_SESSION[CUser::NAME_LOGGEDIN];
    }



} 