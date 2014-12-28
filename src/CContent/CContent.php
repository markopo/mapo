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
    public function DeleteAllContent() {
        $sql = "DELETE FROM Content";
        parent::Execute($sql);
    }

    /**
     * @param $id
     * @param bool $reallyDelete
     * @return int
     */
    public function DeleteById($id, $reallyDelete = false) {

        $sql = "UPDATE Content SET
                deleted = NOW()
                WHERE id = :id";

        if($reallyDelete == true) {
            $sql = "DELETE FROM Content WHERE id = :id";
        }


        $params = array();
        $params[":id"] = array($id);
        return parent::ExecuteWithParams($sql, $params);
    }

    /**
     * @param $param
     * @return int
     */
    public function Insert($param){

        $sql = "insert into Content(slug,type,title,data,filter,published) values(:slug,:type,:title,:data,:filter, now())";

        $params =  array();
        $params[":title"] = array($param->title);
        $params[":slug"] = array($param->slug);
        $params[":data"] = array($param->data);
        $params[":type"] = array($param->type);
        $params[":filter"] = array($param->filter);

        return parent::ExecuteWithParams($sql, $params);
    }

    /**
     * @param $param
     * @return int
     */
    public function Update($param){
        $sql = "UPDATE Content SET
                title = :title,
                slug = :slug,
                data = :data,
                type = :type,
                filter = :filter,
                updated = NOW()
                WHERE id = :id
                ";

            $params =  array();
            $params[":id"] = array($param->id);
            $params[":title"] = array($param->title);
            $params[":slug"] = array($param->slug);
            $params[":data"] = array($param->data);
            $params[":type"] = array($param->type);
            $params[":filter"] = array($param->filter);

         return parent::ExecuteWithParams($sql, $params);
    }

    /**
     * @param $id
     * @return mixed
     */
    public function SelectOne($id) {
        $sql = "SELECT * FROM `content` WHERE id = :id";
        $param = array();
        $param[":id"] = array($id);
        return parent::Fetch($sql, $param);
    }

    /**
     * @return array
     */
    public function SelectAll(){
        $sql = "SELECT * FROM `content` ORDER BY id ASC";
        return parent::FetchAll($sql);
    }

    /**
     * @return array
     */
    public function SelectAllPages(){
        $sql = "SELECT * FROM `content` WHERE deleted is null and type = 'page' ORDER BY id ASC";
        return parent::FetchAll($sql);
    }

    /**
     * @return array
     */
    public function SelectAllBlog(){
        $sql = "SELECT * FROM `content` WHERE deleted is null and type = 'blog' ORDER BY id ASC";
        return parent::FetchAll($sql);
    }

}