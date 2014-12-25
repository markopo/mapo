<?php
/**
 * Created by PhpStorm.
 * User: marko
 * Date: 15/12/2014
 * Time: 20:46
 */

/**
 * Class CContent
 */
class CContent extends CDatabase {


    public function __construct($options, $debug=false){
        parent::__construct($options, $debug);
    }

    /**
     *
     */
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

    /***
     *
     */
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
        $params = array();
        $params[":id"] = array($id);
        parent::ExecuteWithParams($sql, $params);
    }

    /**
     * @param $param
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

            $params =  array();
            $params[":title"] = array($param->title);
            $params[":slug"] = array($param->slug);
            $params[":url"] = array($param->url);
            $params[":data"] = array($param->data);
            $params[":type"] = array($param->type);
            $params[":filter"] = array($param->filter);
            $params[":published"] = array($param->published);

            parent::ExecuteWithParams($sql, $params);
    }

    /**
     * @param $id
     * @return mixed
     */
    public function SelectOne($id) {
        $sql = "SELECT * FROM Content WHERE id = :id";
        $param = array();
        $param[":id"] = array($id);
        return parent::Fetch($sql, $param);
    }

    /**
     * @return array
     */
    public function SelectAll(){
        $sql = "select id,type,title,published,created,updated,deleted from `content` order by id asc ";
        return parent::FetchAll($sql);
    }

}