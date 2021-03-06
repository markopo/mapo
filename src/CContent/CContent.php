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

        $sql = "CREATE TABLE `content`(
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
        $sql = "DROP TABLE IF EXISTS `content`;";
        parent::Execute($sql);
    }

    /**
     *
     */
    public function DeleteAllContent() {
        $sql = "DELETE FROM `content`";
        parent::Execute($sql);
    }

    /**
     * @param $id
     * @param bool $reallyDelete
     */
    public function DeleteById($id, $reallyDelete = false) {

        $sql = "UPDATE `content` SET
                deleted = NOW()
                WHERE id = :id";

        if($reallyDelete == true) {
            $sql = "DELETE FROM `content` WHERE id = :id";
        }

        $params = array();
        $params[":id"] = array($id);
        parent::ExecuteWithParams($sql, $params);
    }

    /**
     * @param $param
     */
    public function Insert($param){

        $sql = "insert into `content`(slug,type,title,data,filter,published) values(:slug,:type,:title,:data,:filter, now())";

        $params =  array();
        $params[":title"] = array($param->title);
        $params[":slug"] = array($param->slug);
        $params[":data"] = array($param->data);
        $params[":type"] = array($param->type);
        $params[":filter"] = array($param->filter);

        parent::ExecuteWithParams($sql, $params);
    }

    /**
     * @param $param
     */
    public function Update($param){

        $deleteVal = $param->deleted == true ? "NOW()" : "null";

        $sql = "UPDATE `content` SET
                title = :title,
                slug = :slug,
                data = :data,
                type = :type,
                filter = :filter,
                updated = NOW(),
                deleted = $deleteVal
                WHERE id = :id
                ";

            $params =  array();
            $params[":id"] = array($param->id);
            $params[":title"] = array($param->title);
            $params[":slug"] = array($param->slug);
            $params[":data"] = array($param->data);
            $params[":type"] = array($param->type);
            $params[":filter"] = array($param->filter);

         parent::ExecuteWithParams($sql, $params);
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
        $sql = "SELECT * FROM `content` WHERE deleted is null and type = 'blog' ORDER BY id DESC";
        return parent::FetchAll($sql);
    }


    public function SelectOneBySlug($slug) {
        $sql = "SELECT * FROM `content` WHERE slug = :slug AND deleted is null LIMIT 1";
        $param = array();
        $param[":slug"] = array($slug);
        return parent::Fetch($sql, $param);
    }

}