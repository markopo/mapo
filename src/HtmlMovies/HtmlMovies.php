<?php
/**
 * Created by PhpStorm.
 * User: marko
 * Date: 27/11/2014
 * Time: 20:07
 */

class HtmlMovies {

    public static function SearchForm($genres, $params) {

        $title = Helpers::IsNullOrEmpty($params->title);
        $startyear = Helpers::IsNullOrEmpty($params->startyear);
        $endyear = Helpers::IsNullOrEmpty($params->endyear);
        $genre = Helpers::IsNullOrEmpty($params->genre);
        $orderdir = Helpers::IsNullOrEmpty($params->orderdir);
        $ordercol = Helpers::IsNullOrEmpty($params->ordercol);
        $hits_per_page = Helpers::IsNullOrEmpty($params->hits_per_page);
        $page = Helpers::IsNullOrEmpty($params->page);


        return "<form id='search-form' name='search-form' action='movies.php' method='get' >
        <input type='hidden' id='genre' name='genre' value='$genre' >
        <input type='hidden' id='order_dir' name='order_dir' value='$orderdir' >
        <input type='hidden' id='order_col' name='order_col' value='$ordercol' >
        <input type='hidden' id='hits_per_page' name='hits_per_page' value='$hits_per_page' >
        <input type='hidden' id='page' name='page' value='$page' >
        <table class='search-list' >
        <tr>
            <td>
                <label for='title'>Titel:</label>
            </td>
            <td>
                <input type='text' id='titel' name='titel' value='$title' >
            </td>
        </tr>
        <tr>
            <td>
                <label>Välj genre:</label>
            </td>
            <td>
                {$genres}
            </td>
        </tr>
        <tr>
            <td>
                <label>Skapad mellan åren:</label>
            </td>
            <td>
                <input type='text' id='startyear' name='startyear' value='$startyear' >
                <span>-</span>
                <input type='text' id='endyear' name='endyear' value='$endyear' >
            </td>
        </tr>
        <tr>
             <td>
                 <input class='btn' type='submit' id='sokBtn' value='Sök' >
             </td>
             <td>
                 <button class='btn'  id='clearBtn' >Rensa</button>
             </td>
        </tr>
        <tr>
            <td><a href='movies.php?action=visaalla'>Visa alla</a></td>
            <td></td>
        </tr>
        </table>";
    }



    public static function SearchTable($res, $params){
        $html = "";
        if(count($res) > 0) {
            $html .= "<table class='search-result'>";
            $html .= "<thead><tr>";
            $html .= "<th><a class='sort-links' data-sort='id' data-order='".HtmlMovies::orderDir($params->orderdir, $params->ordercol, "id")."' href='#id'>Id <span class='".HtmlMovies::orderArrow($params->orderdir, $params->ordercol, "id")."'></span></a></th>";
            $html .= "<th>Bild</th>";
            $html .= "<th><a class='sort-links' data-sort='title' data-order='".HtmlMovies::orderDir($params->orderdir, $params->ordercol, "title")."' href='#title'> Titel<span class='".HtmlMovies::orderArrow($params->orderdir, $params->ordercol, "title")."'></span></a></th>";
            $html .= "<th><a class='sort-links' data-sort='year' data-order='".HtmlMovies::orderDir($params->orderdir, $params->ordercol, "year")."' href='#YEAR'>År<span class='".HtmlMovies::orderArrow($params->orderdir, $params->ordercol, "year")."'></span></a></th>";
            $html .= "<th>Genre</th>";
            $html .= "</tr></thead>";

            $html .= "<tbody>";

            foreach ($res as $r) {
                $html .= "<tr>";
                $html .= "<td>{$r->id}</td>";
                $html .= "<td><img src='{$r->image}' alt='{$r->title}' ></td>";
                $html .= "<td>{$r->title}</td>";
                $html .= "<td>{$r->YEAR}</td>";
                $html .= "<td>{$r->genre}</td>";
                $html .= "</tr>";
            }

            $html .= "</tbody>";

            $html .= "</table>";
        }
        return $html;
    }

    public static function HitsPerPageLinks($selHits){
        $html = "";
        $html .= "<span>Träffar per sida:</span>";
        for($i=2;$i<=8;$i+=2){
            $selected = $selHits == $i ? "selected" : "";
            $html .= "<a class='hits-per-page $selected' hits-per-page='$i' href='#$i'>$i</a>";
        }
        return $html;
    }

    public static function PagingLinks($total, $hitsperpage, $selectedPage){

        $selectedFirst = $selectedPage == 0 ? "selected" : "";

        $html = "";
        $count = round($total/$hitsperpage, 0, PHP_ROUND_HALF_UP);
        $html .= "<a data-page='0' class='$selectedFirst' href='#1'>&lt;</a>";
        $html .= "<a data-page='-1' href='#'>&lt; &lt;</a>";
        for($i=1;$i<$count+1;$i++){
            $selected = $selectedPage == $i ? "selected" : "";
            $html .= "<a class='$selected' data-page='$i' href='#$i'>$i</a>";
        }
        $html .= "<a data-page='+1' href='#$'>&gt; &gt;</a>";
        $html .= "<a data-page='$count' href='#$count'> &gt; </a>";
        return $html;
    }

    public static function GenresLinks($genres, $selectedGenre){
        $html = "";
        $selectedGenre = Helpers::IsNullOrEmpty($selectedGenre);

        if(count($genres) > 0){
            foreach($genres as $g){
                $selected = $selectedGenre == $g->name ? "selected" : "";
                $html .= "<a  class='genres-links $selected' data-genre='{$g->name}' href='#{$g->name}' >$g->name</a>";
            }
        }
        return $html;
    }


    private static function orderDir($dir, $col, $whichCol){
        if($col == $whichCol) {
            return $dir == "ASC" ? "ASC" : "DESC";
        }
        return "ASC";
    }

    private static function orderArrow($dir, $col, $whichCol){
        if($col == $whichCol) {
            return $dir == "ASC" ? "arrow-up" : "arrow-down";
        }
        return "arrow-down";
    }

} 