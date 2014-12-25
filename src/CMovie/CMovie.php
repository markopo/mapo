<?php
/**
 * Created by PhpStorm.
 * User: marko
 * Date: 24/11/2014
 * Time: 13:34
 */

/**
 * Class CMovie
 */
class CMovie extends CDatabase {

    /**
     * Members
     */
    /*
    private $options;                   // Options used when creating the PDO object
    public $db   = null;               // The PDO object
    private $stmt = null;               // The latest statement used to execute a query

    private $debug;

    public $errorMessage = "";
    public $debugMessage = "";
    */

    public function __construct($options, $debug=false){
        parent::__construct($options, $debug);
    }

    /**
     * Execute a select-query with movies-genres arguments and return the resultset.
     *
     * @param array $params array which contains the argument to replace ?.
     * @return array with resultset.
     */
    public function GetGenres() {
        $sql = "SELECT name FROM `genre` ORDER BY name ASC";
        return parent::FetchAll($sql);
    }

    /**
     * Execute a select-query with movies count.
     *
     * @return count of movies.
     */
    public function GetMoviesCount() {

        $sql = "SELECT COUNT(id) as antal FROM `vmovie`";
        $res = parent::Fetch($sql);
        return $res != null ?  $res->antal : 0;
    }


    /**
     * Execute a select-query with movies arguments and return the resultset.
     *
     * @param StdClass $params stdClass which contains the arguments.
     * @return array of Objects with resultset.
     */
    public function GetMovies($params) {

        $res = null;
        $sql = "SELECT id, title, genre, image, YEAR FROM `vmovie` ";
        $bindParams = array();

        $ordercol = null;
        $orderdir = null;

        $hitsperpage = null;
        $page = null;


        if($params->title != null){
            $sql .= "WHERE title LIKE :title ";
        }

        if($params->genre != null){
            $sql = parent::HasWhereInSql($sql);
            $sql .= "genre LIKE :genre ";
        }


        if($params->startyear != null && $params->endyear != null){
            $sql = parent::HasWhereInSql($sql);
            $sql .= "year BETWEEN :startyear and :endyear ";
        }
        elseif($params->startyear != null && $params->endyear == null){
            $sql = parent::HasWhereInSql($sql);
            $sql .= "year >= :startyear ";
        }
        elseif($params->startyear == null && $params->endyear != null) {
            $sql = parent::HasWhereInSql($sql);
            $sql .= "year <= :endyear ";
        }

        if($params->ordercol != null && $params->orderdir != null){
            $ordercol = in_array($params->ordercol, array("title", "year", "id")) ? $params->ordercol : "id";
            $orderdir = $params->orderdir == "ASC" ? "ASC" : "DESC";
            $sql .= "ORDER BY $ordercol $orderdir ";
        }


        if($params->hits_per_page != null && $params->page != null){
            $hitsperpage = (int)$params->hits_per_page;
            $page =  (int)$params->page;

            $sql .= "LIMIT :hitsperpage ";

            if($page > 1){
                $page = $hitsperpage * ($page-1);
                $sql .= "OFFSET :page ";
            }
        }


        try {

            // TITLE
            if ($params->title != null) {
                $title = "%".$params->title."%";
            //    parent::$stmt->bindParam(":title", $title);
                $bindParams[":title"] = array($title);
            }

            // GENRE
            if($params->genre != null){
                $genre = "%".$params->genre."%";
                $bindParams[":genre"] = array($genre);
            }

            // YEAR
            if($params->startyear != null && $params->endyear != null){
                $bindParams[":startyear"] = array($params->startyear);
                $bindParams[":endyear"] = array($params->endyear);
            }
            elseif($params->startyear != null && $params->endyear == null){
                $bindParams[":startyear"] = array($params->startyear);
            }
            elseif($params->startyear == null && $params->endyear != null) {
                $bindParams[":endyear"] = array($params->endyear);
            }


            // PAGING
            if($hitsperpage != null && $page != null) {
                $bindParams[":hitsperpage"] = array($hitsperpage, PDO::PARAM_INT);

                if($page > 1) {
                    $bindParams[":page"] = array($page, PDO::PARAM_INT);
                }
            }


            /** DEBUG INFO */
          /*  if(parent::$debug == true) {
                parent::$debugMessage = "<p>Query = <br/><pre>{$sql}</pre></p></p>";
            }
          */

            $res = parent::FetchAll($sql, $bindParams);

        }
        catch (PDOException $e)
        {
            $this->errorMessage = __METHOD__. ": ".$e->getMessage();
        }
        return $res;
    }

    /*
    private function HasWhereInSql($sql){
        if(strpos($sql, "WHERE") == false){
            $sql .= "WHERE ";
        }
        else {
            $sql .= "AND ";
        }
        return $sql;
    }
    */
}