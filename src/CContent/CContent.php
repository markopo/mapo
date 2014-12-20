<?php
/**
 * Created by PhpStorm.
 * User: marko
 * Date: 15/12/2014
 * Time: 20:46
 */

class CContent extends CDatabase {

    /*
    private $options;                   // Options used when creating the PDO object
    private $db   = null;               // The PDO object
    private $stmt = null;               // The latest statement used to execute a query

    private $debug;

    public $errorMessage = "";
    public $debugMessage = "";
    */

    public function __construct($options, $debug=false){

        parent::__construct($options, $debug);

    }



    public function Create() {

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
         parent::Execute($sql);
    }


    public function Drop() {
        $sql = "DROP TABLE IF EXISTS Content;";
        parent::Execute($sql);
    }

    /**
     *
     */
    public function DeleteAll() {
        $sql = "DELETE FROM Content";
        parent::Execute($sql);
    }

    /**
     * @param $id
     */
    public function DeleteById($id) {
        $sql = "DELETE FROM Content WHERE id = :id";
        parent::ExecuteWithParams($sql, array(":id"=>$id));
    }

    /**
     * @param $param stdClass
     *
     */
    public function Update($param){
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

         $params =  array(":title" => $param->title,
              ":slug" => $param->slug,
              ":url" => $param->url,
              ":data" => $param->data,
              ":type" => $param->type,
              ":filter" => $param->filter,
              ":published" => $param->published
             );

         parent::ExecuteWithParams($sql, $params);
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