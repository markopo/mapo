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
            $error = "class: ".__CLASS__." ,method: ".__METHOD__." ,message:".$e->getMessage();
            ErrorLog::Write($error);

            throw new PDOException('Could not connect to database, hiding connection details.'); // Hide connection details.

        }

        $this->db->SetAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, $this->options['fetch_style']);
        $this->db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_WARNING);

    }

    /**
     * Execute a select-query with movies-genres arguments and return the resultset.
     *
     * @param array $params array which contains the argument to replace ?.
     * @return array with resultset.
     */
     public function GetGenres() {

         $sql = "SELECT name FROM `genre` ORDER BY name ASC";

         $this->stmt = $this->db->prepare($sql);
         try {
             $this->stmt->execute();
         }
         catch (PDOException $e)
         {
             $this->errorMessage = __METHOD__. ": ".$e->getMessage();

         }
         return $this->stmt->fetchAll();
     }

    /**
     * Execute a select-query with movies count.
     *
     * @return count of movies.
     */
    public function GetMoviesCount() {
        $res = null;
        try {
            $sql = "SELECT COUNT(id) as antal FROM `vmovie`";
            $this->stmt = $this->db->prepare($sql);
            $this->stmt->execute();
            $res = $this->stmt->fetch();
        }
        catch (PDOException $e)
        {
            $this->errorMessage = __METHOD__. ": ".$e->getMessage();

        }
        return $res->antal;
    }


    /**
     * Execute a select-query with movies arguments and return the resultset.
     *
     * @param StdClass $params stdClass which contains the arguments.
     * @return array of Objects with resultset.
     */
    public function GetMovies($params) {

        $ordercol = null;
        $orderdir = null;

        $hitsperpage = null;
        $page = null;

        $sql = "SELECT id, image, title, genre, image, YEAR FROM `vmovie` ";


        if($params->title != null){
            $sql .= "WHERE title LIKE :title ";
        }

        if($params->genre != null){
            $sql = $this->HasWhereInSql($sql);
            $sql .= "genre LIKE :genre ";
        }


        if($params->startyear != null && $params->endyear != null){
            $sql = $this->HasWhereInSql($sql);
            $sql .= "year BETWEEN :startyear and :endyear ";
        }
        elseif($params->startyear != null && $params->endyear == null){
            $sql = $this->HasWhereInSql($sql);
            $sql .= "year => :startyear ";
        }
        elseif($params->startyear == null && $params->endyear != null) {
            $sql = $this->HasWhereInSql($sql);
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

            $this->stmt = $this->db->prepare($sql);

            // TITLE
            if ($params->title != null) {
                $title = "%".$params->title."%";
                $this->stmt->bindParam(":title", $title);
            }

            // GENRE
            if($params->genre != null){
               $genre = "%".$params->genre."%";
               $this->stmt->bindParam(":genre", $genre);
            }

            // YEAR
            if($params->startyear != null && $params->endyear != null){
                $this->stmt->bindParam(":startyear", $params->startyear);
                $this->stmt->bindParam(":endyear", $params->endyear);
            }
            elseif($params->startyear != null && $params->endyear == null){
                $this->stmt->bindParam(":startyear", $params->startyear);
            }
            elseif($params->startyear == null && $params->endyear != null) {
                $this->stmt->bindParam(":endyear", $params->endyear);
            }

            // PAGING
            if($hitsperpage != null && $page != null) {
                $this->stmt->bindParam(":hitsperpage", $hitsperpage, PDO::PARAM_INT);

                if($page > 1) {
                    $this->stmt->bindParam(":page", $page, PDO::PARAM_INT);
                }
            }

            /** DEBUG INFO */
            if($this->debug == true) {
                $this->debugMessage = "<p>Query = <br/><pre>{$sql}</pre></p></p>";
            }


            $this->stmt->execute();

        }
        catch (PDOException $e)
        {
          $this->errorMessage = __METHOD__. ": ".$e->getMessage();


        }
        return $this->stmt->fetchAll();
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