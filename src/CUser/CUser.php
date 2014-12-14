<?php
/**
 * Created by PhpStorm.
 * User: marko
 * Date: 24/11/2014
 * Time: 13:35
 */

class CUser {

    CONST ACRONYM_LOGGEDIN = "acronym_loggedin";
    CONST NAME_LOGGEDIN = "name_loggedin";

    private $options;                   // Options used when creating the PDO object
    private $db   = null;               // The PDO object
    private $stmt = null;               // The latest statement used to execute a query

    private $debug;


    public function __construct($options, $debug=false){
        $default = array(
            'dsn' => null,
            'username' => null,
            'password' => null,
            'driver_options' => null,
            'fetch_style' => PDO::FETCH_OBJ,
        );
        $this->options = array_merge($default, $options);

        $this->debug = $debug;

        try {
            $this->db = new PDO($this->options['dsn'], $this->options['username'], $this->options['password'], $this->options['driver_options']);
        }
        catch(Exception $e) {
            throw new PDOException('Could not connect to database, hiding connection details.'); // Hide connection details.
        }

        $this->db->SetAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, $this->options['fetch_style']);
        $this->db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_WARNING);

    }

    public function Login($acronym, $password){
        try {
            $sql = "SELECT acronym, name FROM `user` WHERE acronym = :acronym AND password = md5(concat(:password, salt))";

            $this->stmt = $this->db->prepare($sql);

            $this->stmt->bindParam(":acronym", $acronym);
            $this->stmt->bindParam(":password", $password);

            $this->stmt->execute();
            $res = $this->stmt->fetch();
            if($res->acronym == $acronym){
                $_SESSION[CUser::ACRONYM_LOGGEDIN] = $res->acronym;
                $_SESSION[CUser::NAME_LOGGEDIN] = $res->name;
            }
        }
        catch(PDOException $e){
           $error = "class: ".__CLASS__." ,method: ".__METHOD__." ,message:".$e->getMessage();
           ErrorLog::Write($error);
        }

    }


    public function Logout() {
        unset($_SESSION[CUser::ACRONYM_LOGGEDIN]);
        unset($_SESSION[CUser::NAME_LOGGEDIN]);
    }

    public function IsAuthenticated() {
        return isset($_SESSION[CUser::ACRONYM_LOGGEDIN]);
    }

    public function GetAcronym() {
        return $_SESSION[CUser::ACRONYM_LOGGEDIN];
    }

    public function GetName() {
        return $_SESSION[CUser::NAME_LOGGEDIN];
    }



} 