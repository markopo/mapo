<?php
/**
 * Created by PhpStorm.
 * User: marko
 * Date: 24/11/2014
 * Time: 13:34
 */

/**
 * Class CDatabase
 */
class CDatabase {

    /**
     * Members
     */
    protected $options;                   // Options used when creating the PDO object
    protected $db   = null;               // The PDO object
    protected $stmt = null;               // The latest statement used to execute a query

    public $debug;

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

    /**
     * @param $sql
     */
    protected function Execute($sql){
        $this->db->beginTransaction();
        $this->db->exec($sql);
        $this->db->commit();
    }

    /**
     * @param $sql
     * @param array $params
     *
     */
    protected function ExecuteWithParams($sql, $params=array()){
        $this->db->beginTransaction();
        $this->stmt = $this->db->prepare($sql);

        if(count($params) > 0) {
            foreach ($params as $key => $value) {
                $this->stmt->bindParam($key, $value);
            }
        }

        $this->stmt->execute();
        $this->db->commit();
    }

    /**
     * @param $sql
     * @param array $params
     * @return array
     */
    protected function FetchAll($sql, $params=array()){
        $this->stmt = $this->db->prepare($sql);
        try {
            $this->bindParams($params);

            $this->stmt->execute();
        }
        catch (PDOException $e)
        {
            $this->errorMessage = __METHOD__. ": ".$e->getMessage();

        }
        return $this->stmt->fetchAll();
    }

    /**
     * @param $sql
     * @param array $params
     * @return mixed
     */
    protected function Fetch($sql, $params=array()){
        try {

            $this->stmt = $this->db->prepare($sql);

            $this->bindParams($params);

            $this->stmt->execute();
            $res = $this->stmt->fetch();
        }
        catch (PDOException $e)
        {
            $this->errorMessage = __METHOD__. ": ".$e->getMessage();

        }
        return $res;
    }

    /**
     * @param $params
     */
    private function bindParams($params){
        if(count($params) > 0) {
            foreach ($params as $key => $value) {
                if(count($value) == 1) {
                    $this->stmt->bindParam($key, $value[0]);
                }
                else if(count($value) == 2) {
                    $this->stmt->bindParam($key, $value[0], $value[1]);
                }
            }
        }
    }

    /**
     * @param $sql
     * @return string
     */
    protected function HasWhereInSql($sql){
        if(strpos($sql, "WHERE") == false){
            $sql .= "WHERE ";
        }
        else {
            $sql .= "AND ";
        }
        return $sql;
    }

} 