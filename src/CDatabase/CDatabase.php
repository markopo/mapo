<?php
/**
 * Created by PhpStorm.
 * User: marko
 * Date: 24/11/2014
 * Time: 13:34
 */

class CDatabase {

    /**
     * Members
     */
    private $options;                   // Options used when creating the PDO object
    private $db   = null;               // The PDO object
    private $stmt = null;               // The latest statement used to execute a query

    private $debug;

    public $errorMessage = "";
    public $debugMessage = "";

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






    private function HasWhereInSql($sql){
        if(strpos($sql, "WHERE") == false){
            $sql .= "WHERE ";
        }
        else {
            $sql .= "AND ";
        }
        return $sql;
    }

} 