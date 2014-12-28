<?php

/**
 * Class CNavigation
 */
class CNavigation {

    /**
     * @param $menu
     * @return string
     */
    public static function GenerateMenu($menu) {

        if(isset($menu['callback'])) {
            $items = call_user_func($menu['callback'], $menu['items']);
        }

        $html = "<nav>\n";
        foreach($items as $item) {
            $class = $item['class'] == null ? "" : $item['class'];
            $html .= "<a href='{$item['url']}' class='{$class}' >{$item['text']}</a>\n";
        }
        $html .= "</nav>\n";
        return $html;
    }
};
