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
        $ordertitle = Helpers::IsNullOrEmpty($params->ordertitle);
        $orderyear = Helpers::IsNullOrEmpty($params->orderyear);


        return "<form id='search-form' name='search-form' action='movies.php' method='get' >
        <input type='hidden' id='genre' name='genre' value='$genre' >
        <input type='hidden' id='order_title' name='order_title' value='$ordertitle' >
        <input type='hidden' id='order_year' name='order_year' value='$orderyear' >
        <input type='hidden' id='hits_per_page' name='hits_per_page' value='' >
        <input type='hidden' id='page' name='page' value='' >
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
                 <input type='submit' id='sokBtn' value='Sök' >
             </td>
             <td></td>
        </tr>
        <tr>
            <td><a href='movies.php?action=visaalla'>Visa alla</a></td>
            <td></td>
        </tr>
        </table>";
    }

    private static function orderArrow($order){
        return $order == "ASC" ? "arrow-up" : "arrow-down";
    }

    public static function SearchTable($res){
        $html = "";
        if(count($res) > 0) {
            $html .= "<table class='search-result'>";
            $html .= "<thead><tr>";
            $html .= "<th>Bild</th>";
            $html .= "<th><a class='sort-links' data-sort='title' data-order='{$_SESSION["order_title"]}' href='#title'> Titel<span class='".HtmlMovies::orderArrow($_SESSION["order_title"])."'></span></a></th>";
            $html .= "<th><a class='sort-links' data-sort='year' data-order='{$_SESSION["order_year"]}' href='#YEAR'>År<span class='".HtmlMovies::orderArrow($_SESSION["order_year"])."'></span></a></th>";
            $html .= "<th>Genre</th>";
            $html .= "</tr></thead>";

            foreach ($res as $r) {
                $html .= "<tr>";
                $html .= "<td><img src='{$r->image}' alt='{$r->title}' ></td>";
                $html .= "<td>{$r->title}</td>";
                $html .= "<td>{$r->YEAR}</td>";
                $html .= "<td>{$r->genre}</td>";
                $html .= "</tr>";
            }

            $html .= "</table>";
        }
        return $html;
    }

    public static function HitsPerPage(){
        $html = "";
        for($i=2;$i<=8;$i+=2){
            $html .= "<a class='hits-per-page' hits-per-page='$i' href='#$i'>$i</a>";
        }
        return $html;
    }

    public static function PagingLinks($total, $hitsperpage){
        $html = "";
        $count = round($total/$hitsperpage, 0, PHP_ROUND_HALF_UP);
        for($i=1;$i<$count+1;$i++){
            $html .= "<a data-page='$i' href='#$i'>$i</a>";
        }
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

} 