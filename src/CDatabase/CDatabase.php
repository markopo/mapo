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
    private static $numQueries = 0;     // Count all queries made
    private static $queries = array();  // Save all queries for debugging purpose
    private static $params = array();   // Save all parameters for debugging purpose

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
            //throw $e; // For debug purpose, shows all connection details
        //    $this->errorMessage = $e->getCode()." ".$e->getMessage();
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
     * Execute a select-query with movies arguments and return the resultset.
     *
     * @param StdClass $params stdClass which contains the arguments.
     * @return array of Objects with resultset.
     */
    public function GetMovies($params) {

         /*
        self::$queries[] = $query;
        self::$params[]  = $params;
        self::$numQueries++;
        */

        $sql = "SELECT image, title, genre, image, YEAR FROM `vmovie` ";


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


        if($params->ordertitle != null){
            $titleorder = $params->ordertitle == "ASC" ? "ASC" : "DESC";
            $sql .= "ORDER BY title ".$titleorder;
        }

        if($params->orderyear != null){
            $yearorder = $params->orderyear == "ASC" ? "ASC" : "DESC";
            if($this->HasOrderByInSql($sql) == true){
                $sql .= ", YEAR ".$yearorder;
            }
            else {
                $sql .= "ORDER BY YEAR ".$yearorder;
            }

        }



        /** DEBUG INFO */
        if($this->debug == true) {
            $this->debugMessage = "<p>Query = <br/><pre>{$sql}</pre></p></p>";
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

            $this->stmt->execute();

        }
        catch (PDOException $e)
        {
          $this->errorMessage = __METHOD__. ": ".$e->getMessage();

        }
        return $this->stmt->fetchAll();
    }

    /**
     * Get a html representation of all queries made, for debugging and analysing purpose.
     *
     * @return string with html.
     */
    /*
    public function Dump() {
        $html  = '<p><i>You have made ' . self::$numQueries . ' database queries.</i></p><pre>';
        foreach(self::$queries as $key => $val) {
            $params = empty(self::$params[$key]) ? null : htmlentities(print_r(self::$params[$key], 1)) . '<br/></br>';
            $html .= $val . '<br/></br>' . $params;
        }
        return $html . '</pre>';
    }
    */

        private function HasOrderByInSql($sql){
            if(strpos($sql, "ORDER BY") == false){
                return false;
            }
            return true;
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