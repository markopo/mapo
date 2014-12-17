<?php
/**
 * Created by PhpStorm.
 * User: marko
 * Date: 15/12/2014
 * Time: 20:46
 */

class CContent {

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



    public function Create() {
        $this->db->beginTransaction();
        $sql = "CREATE TABLE Content(
                    id INT AUTO_INCREMENT PRIMARY KEY NOT NULL,
                    slug CHAR(80) UNIQUE,
                    type CHAR(80),
                    title VARCHAR(80),
                    data TEXT,
                    filter CHAR(80),
                    published DATETIME,
                    created DATETIME,
                    updated DATETIME,
                    deleted DATETIME
                )	ENGINE INNODB CHARACTER SET utf8;";
        $this->db->exec($sql);
        $this->db->commit();
    }


    public function Drop() {
        $this->db->beginTransaction();
        $sql = "DROP TABLE IF EXISTS Content;";
        $this->db->exec($sql);
        $this->db->commit();
    }

    /**
     *
     */
    public function DeleteAll() {
        $this->db->beginTransaction();
        $sql = "DELETE FROM Content";
        $this->db->exec($sql);
        $this->db->commit();
    }

    /**
     * @param $id
     */
    public function DeleteById($id) {
        $this->db->beginTransaction();
        $sql = "DELETE FROM Content WHERE id = :id";
        $this->stmt = $this->db->prepare($sql);
        $this->stmt->bindParam(":id", $id);
        $this->db->commit();
    }

    /**
     * @param $param stdClass
     *
     */
    public function Update($param){
        $this->db->beginTransaction();
        $sql = "UPDATE Content SET
                title = :title,
                slug = :slug,
                url = :url,
                data = :data,
                type = :type,
                filter = :filter,
                published = :published,
                updated = NOW()
                WHERE id = :id
                ";
        $this->stmt = $this->db->prepare($sql);

        $this->stmt->bindParam(":title", $param->title);
        $this->stmt->bindParam(":slug", $param->slug);
        $this->stmt->bindParam(":url", $param->url);
        $this->stmt->bindParam(":data", $param->data);
        $this->stmt->bindParam(":type", $param->type);
        $this->stmt->bindParam(":filter", $param->filter);
        $this->stmt->bindParam(":published", $param->published);
        $this->stmt->execute();
        $this->db->commit();
    }



    public function SelectOne($param = array()) {
        $sql = "SELECT * FROM Content";


    }

    public function SelectMultiple($param = array()){
        $sql = "SELECT * FROM Content";
        $res = $this->Query($sql, $param);
        return $res->fetchAll();
    }

}