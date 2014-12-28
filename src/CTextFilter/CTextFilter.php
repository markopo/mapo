<?php
/**
 * Created by PhpStorm.
 * User: marko
 * Date: 28/12/2014
 * Time: 18:54
 */


/**
 * Class CTextFilter
 */
class CTextFilter {

     CONST BBCODE = 'bbcode';
     CONST LINK = 'link';
     CONST MARKDOWN = 'markdown';
     CONST NL2BR = 'nl2br';


    public function __construct(){


    }

    /**
     * @return array
     */
    public static function getFilters() {
        return array(CTextFilter::BBCODE, CTextFilter::LINK, CTextFilter::MARKDOWN, CTextFilter::NL2BR);
    }


    /**
     * @param $filter
     * @param $text
     * @return string
     */
    public function Filter($filter, $text){

        switch($filter){
            case CTextFilter::BBCODE:
                $text = $this->bbcode2html($text);
                break;
            case CTextFilter::LINK:
                $text = $this->make_clickable($text);
                break;
            case CTextFilter::MARKDOWN:
                $text = $this->markdown($text);
                break;
            case CTextFilter::NL2BR:
                $text = nl2br($text);
                break;
        }

        return $text;
    }


    /**
     * Helper, BBCode formatting converting to HTML.
     *
     * @param string text The text to be converted.
     * @return string the formatted text.
     * @link http://dbwebb.se/coachen/reguljara-uttryck-i-php-ger-bbcode-formattering
     */
    public function bbcode2html($text) {
        $search = array(
            '/\[b\](.*?)\[\/b\]/is',
            '/\[i\](.*?)\[\/i\]/is',
            '/\[u\](.*?)\[\/u\]/is',
            '/\[img\](https?.*?)\[\/img\]/is',
            '/\[url\](https?.*?)\[\/url\]/is',
            '/\[url=(https?.*?)\](.*?)\[\/url\]/is'
        );
        $replace = array(
            '<strong>$1</strong>',
            '<em>$1</em>',
            '<u>$1</u>',
            '<img src="$1" />',
            '<a href="$1">$1</a>',
            '<a href="$1">$2</a>'
        );
        return preg_replace($search, $replace, $text);
    }



    /**
     * Make clickable links from URLs in text.
     *
     * @param string $text the text that should be formatted.
     * @return string with formatted anchors.
     * @link http://dbwebb.se/coachen/lat-php-funktion-make-clickable-automatiskt-skapa-klickbara-lankar
     */
    public function make_clickable($text) {
        return preg_replace_callback(
            '#\b(?<![href|src]=[\'"])https?://[^\s()<>]+(?:\([\w\d]+\)|([^[:punct:]\s]|/))#',
            create_function(
                '$matches',
                'return "<a href=\'{$matches[0]}\'>{$matches[0]}</a>";'
            ),
            $text
        );
    }

    /**
     * Format text according to Markdown syntax.
     *
     * @link http://dbwebb.se/coachen/skriv-for-webben-med-markdown-och-formattera-till-html-med-php
     * @param string $text the text that should be formatted.
     * @return string as the formatted html-text.
     */
    public function markdown($text) {
        require_once(__DIR__ . '/php-markdown/Michelf/Markdown.php');
        require_once(__DIR__ . '/php-markdown/Michelf/MarkdownExtra.php');
        return \Michelf\MarkdownExtra::defaultTransform($text);
    }
}