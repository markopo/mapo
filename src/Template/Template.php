<?php
/**
 * Created by PhpStorm.
 * User: marko
 * Date: 13/11/2014
 * Time: 19:10
 */

/**
 * Class Template
 */
class Template {

    /**
     * @return string
     */
    public static function Header() {
        $header = "
            <img class='sitelogo' src='img/mapo.png' alt='Mapo Logo'/> <div class='sitetitle'> - Mapo - Objektorienterad PHP</div>
            <br style='clear:both;' />
            <div class='siteslogan'>Återanvändbara moduler för webbutveckling med PHP</div>
            ";
        return $header;
    }

    /**
     * @return string
     */
    public static function Footer() {
        $footer = "
            <div>
            <span class='sitefooter'>Copyright (c) Marko Poikkimäki |
            <a href='https://github.com/markopo/mapo' >Mapo på GitHub</a> |
            <a href='http://validator.w3.org/unicorn/check?ucn_uri=referer&amp;ucn_task=conformance'>Unicorn</a></span>
            </div>";
        return $footer;
    }



} 