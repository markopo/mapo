<?php
/**
 * Created by PhpStorm.
 * User: marko
 * Date: 21/12/2014
 * Time: 18:42
 */

/**
 * Class HtmlCContent
 */
class HtmlCContent {

    /**
     * @param $res
     * @return string
     */
    public static function HtmlTable($res){
        $html = "";
        if(count($res) > 0) {
            $html .= "<table class='ccontent-table'>";
            $html .= "<thead><tr>";
            $html .= "<th>id</th>";
            $html .= "<th>type</th>";
            $html .= "<th>title</th>";
            $html .= "<th>published</th>";
            $html .= "<th>created</th>";
            $html .= "<th>updated</th>";
            $html .= "<th>deleted</th>";
            $html .= "<th></th>";
            $html .= "<th></th>";
            $html .= "</tr></thead>";

            $html .= "<tbody>";

            foreach ($res as $r) {
                $html .= "<tr>";
                $html .= "<td><span>{$r->id}</span></td>";
                $html .= "<td><span>{$r->type}</span></td>";
                $html .= "<td><span>{$r->title}</span></td>";
                $html .= "<td><span>{$r->published}</span></td>";
                $html .= "<td><span>{$r->created}</span></td>";
                $html .= "<td><span>{$r->updated}</span></td>";
                $html .= "<td><span>{$r->deleted}</span></td>";
                $html .= "<td><a class='edit-content-link' href='?editcontent=<".$r->id."'>edit</a></td>";
                $html .= "<td><a class='delete-content-link' href='?deletecontent=<".$r->id."'>delete</a></td>";
                $html .= "</tr>";
            }

            $html .= "</tbody>";

            $html .= "</table>";
        }
        return $html;

    }



    /**
     * @param $content
     * @return string
     */
    public static function EditContent($content){
        $html = "";
        $html .= "<table>";
     //   $html .= HtmlCContent::TableRowHidden()

        $html .= "</table>";
        return $html;
    }

    /**
     * id
    slug
    type
    title
    data
    filter
    published
    created
    updated
    deleted
     */

    /**
     * @param $content
     * @return string
     */
    public static function DeleteContent($content){
        $html = "";
        $html .= "<table>";


        $html .= "</table>";
        return $html;
    }

    /**
     * @return string
     */
    public static function AddContent() {
        $html = "";
        $html .= "<table>";


        $html .= "</table>";
        return $html;
    }
}