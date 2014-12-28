<?php
/**
 * Created by PhpStorm.
 * User: marko
 * Date: 21/12/2014
 * Time: 19:18
 */

/**
 * Class HtmlAdmin
 */
class HtmlAdmin {

    /**
     * @return string
     */
    public static function AdminLinks(){
        $html = "<ul>";
        $html .= "<li><a href='content.php'>content</a></li>";
        $html .= "<li><a href='page.php'>page</a></li>";
        $html .= "<li><a href='blog.php'>blog</a></li>";
        $html .= "</ul>";
        return $html;
    }

}